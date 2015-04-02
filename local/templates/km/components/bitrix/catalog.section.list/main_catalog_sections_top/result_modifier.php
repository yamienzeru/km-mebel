<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arSections = array();
foreach ($arResult["SECTIONS"] as $arSection) 
	$arSections[$arSection["ID"]] = $arSection;
$arResult["SECTIONS"] = array();

$arSectionItems = array();
$rsSectionItems = CIBlockElement::GetList(Array("SORT" => "ASC"), Array("IBLOCK_ID" => 13, "ACTIVE"=>"Y"), false, false, array("ID", "NAME", "PROPERTY_CATALOG_SECTION"));
while($arSection = $rsSectionItems->GetNext())
	if(array_key_exists($arSection["PROPERTY_CATALOG_SECTION_VALUE"], $arSections))
	{
		$arSections[$arSection["PROPERTY_CATALOG_SECTION_VALUE"]]["NAME"] = $arSection["NAME"];
		$arSections[$arSection["PROPERTY_CATALOG_SECTION_VALUE"]]["~NAME"] = $arSection["~NAME"];
		$arResult["SECTIONS"][] = $arSections[$arSection["PROPERTY_CATALOG_SECTION_VALUE"]];
	}
?>