<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */

CModule::IncludeModule("iblock");

$arResult["PARAMS_HASH"] = md5(serialize($arParams).$this->GetTemplateName());

$arParams["USE_CAPTCHA"] = (($arParams["USE_CAPTCHA"] != "N" && !$USER->IsAuthorized()) ? "Y" : "N");
$arParams["EVENT_NAME"] = trim($arParams["EVENT_NAME"]);
if($arParams["EVENT_NAME"] == '')
	$arParams["EVENT_NAME"] = "FEEDBACK_FORM";
$arParams["EMAIL_TO"] = trim($arParams["EMAIL_TO"]);
if($arParams["EMAIL_TO"] == '')
	$arParams["EMAIL_TO"] = COption::GetOptionString("main", "email_from");
$arParams["OK_TEXT"] = trim($arParams["OK_TEXT"]);
if($arParams["OK_TEXT"] == '')
	$arParams["OK_TEXT"] = GetMessage("MF_OK_MESSAGE");

foreach($arParams["FIELDS"] as $field)
	if(strlen($field))
		switch ($arParams[$field."_TYPE"]) 
		{
			case "LIST":
				$arResult[$field."_VALUE"] = $arParams[$field."_LIST"];
				break;
			case "IBLOCK_ELEMENTS":
				if($arParams[$field."_IBLOCK_ID"] > 0)
				{
					$arFilter = Array("IBLOCK_ID" => IntVal($arParams[$field."_IBLOCK_ID"]));
					if($arParams[$field."_ACTIVE"] == "Y") $arFilter["ACTIVE"] = "Y";
					$res = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, array("ID", "CODE", "NAME"));
					while($arFields = $res->GetNext())
						$arResult[$field."_VALUE"][$arFields["ID"]] = $arFields["NAME"];
				}
				break;
			default:
				break;
		}

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] <> '' && (!isset($_POST["PARAMS_HASH"]) || $arResult["PARAMS_HASH"] === $_POST["PARAMS_HASH"]))
{
	$arResult["ERROR_MESSAGE"] = array();
	if(check_bitrix_sessid())
	{
		if(empty($arParams["REQUIRED_FIELDS"]) || !in_array("NONE", $arParams["REQUIRED_FIELDS"]))
		{
			foreach($arParams["FIELDS"] as $field)
				if(!in_array($field, $arDefaultFields) && !empty($field) && ((empty($arParams["REQUIRED_FIELDS"]) || in_array($field, $arParams["REQUIRED_FIELDS"])) && strlen($_POST[$field]) <= 1))
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_REQ").'"'.(!empty($arParams[$field."_NAME"]) ? $arParams[$field."_NAME"] : $field).'".';
		}

		foreach($arParams["FIELDS"] as $field)
			if(strlen($_POST[$field]) <= 1)
			{
				if($arParams[$field."_TYPE_CHECK"] == "EMAIL" && !check_email($_POST[$field]))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_EMAIL_NOT_VALID");
				if($arParams[$field."_TYPE_CHECK"] == "PHONE" && !preg_match("/^[-+() 0-9]+$/", $_POST[$field]))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_PHONE_NOT_VALID");
				if($arParams[$field."_TYPE_CHECK"] == "EMAIL" && !CheckDateTime($_POST[$field]))
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_DATE_NOT_VALID");
			}

		if($arParams["USE_CAPTCHA"] == "Y")
		{
			if($arParams["CAPTCHA"] == "C")
			{
				include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
				$captcha_code = $_POST["captcha_sid"];
				$captcha_word = $_POST["captcha_word"];
				$cpt = new CCaptcha();
				$captchaPass = COption::GetOptionString("main", "captcha_password", "");
				if (strlen($captcha_word) > 0 && strlen($captcha_code) > 0)
				{
					if (!$cpt->CheckCodeCrypt($captcha_word, $captcha_code, $captchaPass))
						$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
				}
				else
					$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTHCA_EMPTY");
			}
			elseif($arParams["CAPTCHA"] == "H" && $_POST["name"] != "")
				$arResult["ERROR_MESSAGE"][] = GetMessage("MF_CAPTCHA_WRONG");
		}	
	
		if(empty($arResult["ERROR_MESSAGE"]))
		{
			$arFields = Array(
				"EMAIL_TO" => $arParams["EMAIL_TO"],
			);

			foreach($arParams["FIELDS"] as $field) $arFields[$field] = htmlspecialcharsEx($_POST[$field]);

			if($arParams["SAVE_IBLOCK"] > 0)
			{
				$save_text = "";
				foreach($arFields as $field => $value)
					if(!empty($field) && !empty($value) && $field != "EMAIL_TO")
					{
						$save_text .= (!empty($arParams[$field."_NAME"]) ? $arParams[$field."_NAME"] : $field).": ".$value."
";
					}

				$event = CEventType::GetByID($arParams["EVENT_NAME"], "ru")->Fetch();

				$el = new CIBlockElement;

				$arLoadProductArray = Array(
					"IBLOCK_SECTION_ID" => false,
					"IBLOCK_ID"      => $arParams["SAVE_IBLOCK"],
					"NAME"           => $event["NAME"],
					"ACTIVE"         => "Y",
					"DETAIL_TEXT"    => $save_text
				);

				$el->Add($arLoadProductArray);
			}

			if(!empty($arParams["EVENT_MESSAGE_ID"]))
			{
				foreach($arParams["EVENT_MESSAGE_ID"] as $v)
					if(IntVal($v) > 0)
						CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields, "N", IntVal($v));
			}
			else
				CEvent::Send($arParams["EVENT_NAME"], SITE_ID, $arFields);

			foreach($arParams["FIELDS"] as $field) $_SESSION["MF_".$field] = htmlspecialcharsbx($_POST[$field]);

			LocalRedirect($APPLICATION->GetCurPageParam("success=".$arResult["PARAMS_HASH"]/*.($_REQUEST["ajax"] == "y" ? "&ajax=y" : "")*/, Array("success")));
		}
		
		foreach($arParams["FIELDS"] as $field) $arResult[$field] = htmlspecialcharsEx($_POST[$field]);
	}
	else
		$arResult["ERROR_MESSAGE"][] = GetMessage("MF_SESS_EXP");
}
elseif($_REQUEST["success"] == $arResult["PARAMS_HASH"])
{
	$arResult["OK_MESSAGE"] = $arParams["OK_TEXT"];
}

if(empty($arResult["ERROR_MESSAGE"]))
{
	if($USER->IsAuthorized())
	{
		$arUser = $USER->GetByID($USER->GetId())->Fetch();
		foreach($arParams["FIELDS"] as $field)
			if(strlen($arParams[$field."_TYPE_USER"]) && strlen($arUser[$arParams[$field."_TYPE_USER"]]))
				$arResult[$field] = htmlspecialcharsbx($arUser[$arParams[$field."_TYPE_USER"]]);
			elseif($arParams[$field."_TYPE_USER"] == "NAME")
				$arResult[$field] = $USER->GetFormattedName(false);
	}
	else
	{
		foreach($arParams["FIELDS"] as $field) 
			if(strlen($_SESSION["MF_".$field]) > 0)
				$arResult[$field] = htmlspecialcharsbx($_SESSION["MF_".$field]);
	}
}

if($arParams["USE_CAPTCHA"] == "Y" && $arParams["CAPTCHA"] == "C")
	$arResult["capCode"] =  htmlspecialcharsbx($APPLICATION->CaptchaGetCode());

$this->IncludeComponentTemplate();
