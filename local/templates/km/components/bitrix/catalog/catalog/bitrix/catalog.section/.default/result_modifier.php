<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"] as $keyItem => $arItem)
{
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$arResult["ITEMS"][$keyItem]["ACTION_ID"] = $this->GetEditAreaId($arItem['ID']);
}
$arResult["ITEMS"] = array_chunk($arResult["ITEMS"], $arParams["LINE_ELEMENT_COUNT"] == 4 ? 13 : 9);
?>