<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//кол-во элементов
$arParams["PAGE_ELEMENT_COUNT"] = strlen($_REQUEST["q"]) ? 13 : 9;
$arParams["LINE_ELEMENT_COUNT"] = strlen($_REQUEST["q"]) ? 4 : 3;

$current_count = $default_count = IntVal($arParams["PAGE_ELEMENT_COUNT"]);
$arElementCounts = array(1, 2, 3, 4, 5);
$arResult["ELEMENT_COUNTS"] = array();
foreach($arElementCounts as $koef)
	$arResult["ELEMENT_COUNTS"][$default_count * $koef] = str_replace($APPLICATION->GetCurPage()."?", "", $APPLICATION->GetCurPageParam("page_count=".$default_count * $koef, array("page_count", "PAGEN_1")));
if(array_key_exists($_REQUEST["page_count"], $arResult["ELEMENT_COUNTS"]))
	$current_count = $_SESSION["CURRENT_COUNT"] = $_REQUEST["page_count"];
elseif(array_key_exists($_SESSION["CURRENT_COUNT"], $arResult["ELEMENT_COUNTS"]))
	$current_count = $_SESSION["CURRENT_COUNT"];
$arParams["PAGE_ELEMENT_COUNT"] = $arResult["CURRENT_COUNT"] = $current_count;

//сортировка
$arParams["ELEMENT_SORT_FIELD"] = trim($arParams["ELEMENT_SORT_FIELD"]);
if(strlen($arParams["ELEMENT_SORT_FIELD"])<=0)
	$arParams["ELEMENT_SORT_FIELD"] = "shows";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["ELEMENT_SORT_ORDER"]))
	$arParams["ELEMENT_SORT_ORDER"]="desc";
	
$default_by = $arParams["ELEMENT_SORT_FIELD"];
$default_order = $arParams["ELEMENT_SORT_ORDER"];
$current_sort = 0;
$arResult["ELEMENT_SORT"] = array(
	array(
		"NAME" => "популярности",
		"SORT_FIELD" => "shows",
		"SORT_ORDER" => "desc",
		"BY" => "show",
		"ORDER" => "desc",
	),
	/*array(
		"NAME" => "дате начиная с новых",
		"SORT_FIELD" => "created",
		"SORT_ORDER" => "desc",
		"BY" => "date",
		"ORDER" => "desc",
	),*/
	array(
		"NAME" => "цене начиная с меньшей",
		"SORT_FIELD" => "CATALOG_PRICE_1",
		"SORT_ORDER" => "asc",
		"BY" => "price",
		"ORDER" => "asc",
	),
	array(
		"NAME" => "цене начиная с большей",
		"SORT_FIELD" => "CATALOG_PRICE_1",
		"SORT_ORDER" => "desc",
		"BY" => "price",
		"ORDER" => "desc",
	),
	array(
		"NAME" => "названию",
		"SORT_FIELD" => "name",
		"SORT_ORDER" => "asc",
		"BY" => "name",
		"ORDER" => "asc",
	),
	/*array(
		"NAME" => "По наличию",
		"SORT_FIELD" => "catalog_quantity",
		"SORT_ORDER" => "desc",
		"BY" => "quantity",
		"ORDER" => "desc",
	),*/
);
foreach($arResult["ELEMENT_SORT"] as $keySort => $arSort)
	$arResult["ELEMENT_SORT"][$keySort]["LINK"] = str_replace($APPLICATION->GetCurPage()."?", "", $APPLICATION->GetCurPageParam("by=".$arSort["BY"]."&order=".$arSort["ORDER"], array("by", "order")));
	//$arResult["ELEMENT_SORT"][$keySort]["LINK"] = $APPLICATION->GetCurPageParam("by=".$arSort["BY"]."&order=".$arSort["ORDER"], array("by", "order"));
	

if(strlen($_REQUEST["by"]) && strlen($_REQUEST["order"]))
{
	foreach($arResult["ELEMENT_SORT"] as $keySort => $arSort)
		if($_REQUEST["by"] == $arSort["BY"] && $_REQUEST["order"] == $arSort["ORDER"])
		{
			$current_sort = $keySort;
			$_SESSION["SORT_FIELD"] = $arSort["SORT_FIELD"];
			$_SESSION["SORT_ORDER"] = $arSort["SORT_ORDER"];
			break;
		}
}
elseif(strlen($_SESSION["SORT_FIELD"]) && strlen($_SESSION["SORT_ORDER"]))
{
	foreach($arResult["ELEMENT_SORT"] as $keySort => $arSort)
		if($_SESSION["SORT_FIELD"] == $arSort["SORT_FIELD"] && $_SESSION["SORT_ORDER"] == $arSort["SORT_ORDER"])
		{
			$current_sort = $keySort;
			break;
		}
}
$arResult["ELEMENT_SORT"][$current_sort]["SELECTED"] = "Y";
$arParams["ELEMENT_SORT_FIELD"] = $arResult["ELEMENT_SORT"][$current_sort]["SORT_FIELD"];
$arParams["ELEMENT_SORT_ORDER"] = $arResult["ELEMENT_SORT"][$current_sort]["SORT_ORDER"];

if(strlen($_REQUEST["q"]))
{
	$arResult["SEARCH_ELEMENTS"] = $APPLICATION->IncludeComponent(
		"bitrix:search.page",
		".default",
		Array(
			"RESTART" => "N",
			"NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
			"USE_LANGUAGE_GUESS" => "Y",
			"CHECK_DATES" => "Y",
			"arrFILTER" => array("iblock_".$arParams["IBLOCK_TYPE"]),
			"arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
			"USE_TITLE_RANK" => "N",
			"DEFAULT_SORT" => "rank",
			"FILTER_NAME" => "",
			"SHOW_WHERE" => "N",
			"arrWHERE" => array(),
			"SHOW_WHEN" => "N",
			"PAGE_RESULT_COUNT" => 50,
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "N",
		),
		$this->__component
	);

	global ${$arParams["FILTER_NAME"]};
	${$arParams["FILTER_NAME"]}["=ID"] = $arResult["SEARCH_ELEMENTS"];
}

if($_REQUEST[$arParams["ACTION_VARIABLE"]] == "QUICKBUY" && IntVal($_REQUEST[$arParams["PRODUCT_ID_VARIABLE"]]) > 0)
{
	$rsProduct = CIBlockElement::GetByID($_REQUEST[$arParams["PRODUCT_ID_VARIABLE"]]);
	if($obProduct = $rsProduct->GetNextElement())
	{
		$arProduct = $obProduct->GetFields();
		$arProduct["PROPERTIES"] = $obProduct->GetProperties();
		$this->__page = "quickbuy";
		$this->__file = $this->__folder."/quickbuy.php";
	}
}

/******************************************/
if(stripos($this->GetFile(), "sections.php") !== false || stripos($this->GetFile(), "section.php") !== false)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
	{
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	}
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
	{
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
	}

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (CModule::IncludeModule("iblock") && (0 < intval($arResult["VARIABLES"]["SECTION_ID"]) || '' != $arResult["VARIABLES"]["SECTION_CODE"]))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter);

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
				{
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
				}
				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}

			if($arCurSection["ID"] || !strlen($arCurSection["CODE"]))
			{
				$arCurSection["SUBSECTIONS"] = array();
				$arCurSection["ELEMENTS_CNT"] = CIBlockElement::GetList(Array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arCurSection["ID"], "SECTION_ACTIVE" => "Y", "ACTIVE" => "Y"))->SelectedRowsCount();
				$arCurSection["SUB_ELEMENTS_CNT"] = CIBlockElement::GetList(Array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arCurSection["ID"], "SECTION_ACTIVE" => "Y", "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y"))->SelectedRowsCount();
				CIBlockSection::GetSectionElementsCount($arCurSection["ID"], array("CNT_ACTIVE" => "Y", ""));
				$rsSections = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "SECTION_ID" => $arCurSection["ID"]));
				while($arSections = $rsSections->Fetch())
					$arCurSection["SUBSECTIONS"][] = $arSections;

				if($arCurSection["ID"] && $obSectionInfo = CIBlockElement::GetList(Array(), array("IBLOCK_ID" => 4, "ACTIVE" => "Y", "PROPERTY_CATALOG_SECTION" => $arCurSection["ID"]))->GetNextElement())
				{
					$arCurSection["PREVIEW_INFO"] = $obSectionInfo->GetFields();
					$arCurSection["PREVIEW_INFO"]["PHOTOS"] = $obSectionInfo->GetProperty("PHOTOS");
				}
			}
		}
		else
		{
			$arCurSection["SUB_ELEMENTS_CNT"] = CIBlockElement::GetList(Array(), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "INCLUDE_SUBSECTIONS" => "Y"))->SelectedRowsCount();
		}

		if(empty($arCurSection["PREVIEW_INFO"]))
		{
			if($obSectionInfo = CIBlockElement::GetList(Array(), array("IBLOCK_ID" => 5, "ACTIVE" => "Y", "CODE" => "catalog_main_promo"))->GetNextElement())
			{
				$arCurSection["PREVIEW_INFO"] = $obSectionInfo->GetFields();
				$arCurSection["PREVIEW_INFO"]["PHOTOS"] = $obSectionInfo->GetProperty("PHOTOS");
			}
		}
		$obCache->EndDataCache($arCurSection);
	}

	$arResult["CURRENT_SECTION"] = $arCurSection;
	if(!empty($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]))
	{
		$arElement = array("IBLOCK_ID" => $arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["IBLOCK_ID"], "ID" => $arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["ID"]);
		$arButtons = CIBlock::GetPanelButtons($arElement["IBLOCK_ID"], $arElement["ID"], 0, array("SECTION_BUTTONS"=>false, "SESSID"=>false));
		$arElement["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
		$arElement["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];
		$this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	}
	if(strlen($arResult["CURRENT_SECTION"]["NAME"])) $APPLICATION->SetTitle($arResult["CURRENT_SECTION"]["NAME"]);
}
?>
