<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!CModule::IncludeModule("iblock"))
	return;

$arIBlock=array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
{
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
}

$site = ($_REQUEST["site"] <> ''? $_REQUEST["site"] : ($_REQUEST["src_site"] <> ''? $_REQUEST["src_site"] : false));
$arFilter = Array("TYPE_ID" => "FEEDBACK_FORM", "ACTIVE" => "Y");
if($site !== false)
	$arFilter["LID"] = $site;

$arEvent = Array();
$dbType = CEventMessage::GetList($by="ID", $order="DESC", $arFilter);
while($arType = $dbType->GetNext())
	$arEvent[$arType["ID"]] = "[".$arType["ID"]."] ".$arType["SUBJECT"];

$arCaptcha = $arCurrentValues["USE_CAPTCHA"] != "N" ? array(
		"CAPTCHA" => Array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MFP_CAPTCHA_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => Array("C" => "Captcha", "H" => "Honeypot"),
			"DEFAULT" => "C",
		)
	) : Array();

$arDefaultFields = Array("NAME" => GetMessage("MFP_NAME"), "EMAIL" => "E-mail", "PHONE" => GetMessage("MFP_PHONE"), "MESSAGE" => GetMessage("MFP_MESSAGE"));
$arFields = is_array($arCurrentValues["FIELDS"]) ? $arCurrentValues["FIELDS"] : array_keys($arDefaultFields);
$arRequiredFields = Array("NONE" => GetMessage("MFP_ALL_REQ"));

$arParamsField = $arGroups = $arParamsSaveIBlock = array();
foreach($arFields as $field)
	if(strlen($field))
	{
		$arRequiredFields[$field] = $name = strlen($arCurrentValues[$field."_NAME"]) ? $arCurrentValues[$field."_NAME"]." [".$field."]" : $field;
		$group_code = "FIELD_GROUP_".$field;
		$arGroups[$group_code] = array(
			"NAME" => "Поле \"".$name."\"",
		);
		$arParamsField[$field."_NAME"] = Array(
			"NAME" => GetMessage("MFP_FIELD_NAME"), 
			"TYPE" => "STRING",
			"DEFAULT" => "", 
			"PARENT" => $group_code,
			"REFRESH" => "Y",
		);
		$arParamsField[$field."_TYPE"] = Array(
			"NAME" => "Тип поля", 
			"TYPE"=>"LIST",
			"VALUES" => Array("STRING" => "Текст", "LIST" => "Список", "IBLOCK_ELEMENTS" => "Элементы инфоблока", "HIDDEN" => "Скрытое поле"),
			"DEFAULT"=>"", 
			"DEFAULT" => "STRING", 
			"PARENT" => $group_code,
			"REFRESH" => "Y",
		);
		switch ($arCurrentValues[$field."_TYPE"]) {
			case "STRING":
				$arParamsField[$field."_PLACEHOLDER"] = Array(
					"NAME" => "Подсказка", 
					"TYPE" => "STRING",
					"DEFAULT" => "", 
					"PARENT" => $group_code,
					"REFRESH" => "Y",
				);
				$arParamsField[$field."_TYPE_CHECK"] = Array(
					"NAME" => "Дополнительная проверка типа", 
					"TYPE" => "LIST",
					"VALUES" => Array("NONE" => "Нет", "PHONE" => "Телефон", "EMAIL" => "E-mail", "DATE" => "Дата"),
					"DEFAULT" => "NONE", 
					"DEFAULT" => "STRING", 
					"PARENT" => $group_code,
				);

				$arFormFields = array(
					"NAME"=>1,
					"SECOND_NAME"=>1,
					"LAST_NAME"=>1,
					"EMAIL"=>1,
					"AUTO_TIME_ZONE"=>1,
					"PERSONAL_PROFESSION"=>1,
					"PERSONAL_WWW"=>1,
					"PERSONAL_ICQ"=>1,
					"PERSONAL_GENDER"=>1,
					"PERSONAL_BIRTHDAY"=>1,
					"PERSONAL_PHOTO"=>1,
					"PERSONAL_PHONE"=>1,
					"PERSONAL_FAX"=>1,
					"PERSONAL_MOBILE"=>1,
					"PERSONAL_PAGER"=>1,
					"PERSONAL_STREET"=>1,
					"PERSONAL_MAILBOX"=>1,
					"PERSONAL_CITY"=>1,
					"PERSONAL_STATE"=>1,
					"PERSONAL_ZIP"=>1,
					"PERSONAL_COUNTRY"=>1,
					"PERSONAL_NOTES"=>1,
					"WORK_COMPANY"=>1,
					"WORK_DEPARTMENT"=>1,
					"WORK_POSITION"=>1,
					"WORK_WWW"=>1,
					"WORK_PHONE"=>1,
					"WORK_FAX"=>1,
					"WORK_PAGER"=>1,
					"WORK_STREET"=>1,
					"WORK_MAILBOX"=>1,
					"WORK_CITY"=>1,
					"WORK_STATE"=>1,
					"WORK_ZIP"=>1,
					"WORK_COUNTRY"=>1,
					"WORK_PROFILE"=>1,
					"WORK_LOGO"=>1,
					"WORK_NOTES"=>1,
				);
				if(!CTimeZone::Enabled())
					unset($arFormFields["AUTO_TIME_ZONE"]);
				$arUserFields = array();
				foreach ($arFormFields as $value=>$dummy)
				{
					$arUserFields[$value] = "[".$value."] ".GetMessage("USER_FIELD_".$value);
				}
				$arParamsField[$field."_TYPE_USER"] = Array(
					"NAME" => "Подставлять из пользователя",
					"TYPE" => "LIST",
					"ADDITIONAL_VALUES" => "Y",
					"VALUES" => $arUserFields,
					"PARENT" => $group_code,
				);
				break;
			case "LIST":
				$arParamsField[$field."_LIST"] = Array(
					"NAME" => "Список", 
					"TYPE"=>"STRING", 
					"MULTIPLE"=>"Y", 
					"DEFAULT" => "", 
					"COLS"=>25, 
					"PARENT" => $group_code,
					"ADDITIONAL_VALUES" => "Y",
				);
				break;
			case "IBLOCK_ELEMENTS":
				$arParamsField[$field."_IBLOCK_ID"] = array(
					"PARENT" => $group_code,
					"NAME" => "Инфоблок",
					"TYPE" => "LIST",
					"VALUES" => $arIBlock,
					"ADDITIONAL_VALUES" => "Y",
				);
				$arParamsField[$field."_ACTIVE"] = array(
					"PARENT" => $group_code,
					"NAME" => "Только активные",
					"TYPE" => "CHECKBOX",
					"DEFAULT" => "Y",
				);
				break;
			default:
				break;
		}
	}

if($arCurrentValues["SAVE_TO_IBLOCK"] == "Y")
	$arParamsSaveIBlock["SAVE_IBLOCK"] = array(
		"NAME" => "Инфоблок",
		"TYPE" => "LIST",
		"VALUES" => $arIBlock,
		"ADDITIONAL_VALUES" => "Y",
	);

$arComponentParameters = array(
	"GROUPS" => $arGroups,
	"PARAMETERS" => array_merge(array(
		"USE_CAPTCHA" => Array(
			"NAME" => GetMessage("MFP_CAPTCHA"), 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y", 
			"PARENT" => "BASE",
		),
		), $arCaptcha, array(
		"OK_TEXT" => Array(
			"NAME" => GetMessage("MFP_OK_MESSAGE"), 
			"TYPE" => "STRING",
			"DEFAULT" => GetMessage("MFP_OK_TEXT"), 
			"PARENT" => "BASE",
		),
		"EMAIL_TO" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TO"), 
			"TYPE" => "STRING",
			"DEFAULT" => htmlspecialcharsbx(COption::GetOptionString("main", "email_from")), 
			"PARENT" => "BASE",
		),
		"EVENT_MESSAGE_ID" => Array(
			"NAME" => GetMessage("MFP_EMAIL_TEMPLATES"), 
			"TYPE"=>"LIST", 
			"VALUES" => $arEvent,
			"DEFAULT"=>"", 
			"MULTIPLE"=>"Y", 
			"COLS"=>25, 
			"PARENT" => "BASE",
		),
		"FIELDS" => Array(
			"NAME" => GetMessage("MFP_FIELDS"), 
			"TYPE"=>"STRING", 
			"MULTIPLE"=>"Y", 
			"VALUES" => $arFields,
			"DEFAULT" => array_keys($arDefaultFields), 
			"COLS"=>25, 
			"PARENT" => "BASE",
			"REFRESH" => "Y",
			"ADDITIONAL_VALUES" => "Y",
		),
		"REQUIRED_FIELDS" => Array(
			"NAME" => GetMessage("MFP_REQUIRED_FIELDS"), 
			"TYPE"=>"LIST", 
			"MULTIPLE"=>"Y", 
			"VALUES" => $arRequiredFields,
			"DEFAULT"=>"", 
			"COLS"=>25, 
			"PARENT" => "BASE",
		),
		), $arParamsField, array(

		"SAVE_TO_IBLOCK" => Array(
			"NAME" => "Сохранить в инфоблок", 
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "", 
			"REFRESH" => "Y",
		),

		), $arParamsSaveIBlock, array(

		)
	)
);


?>