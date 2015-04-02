<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arResult["PAGER"] = getNextPrevByID($arResult["ID"], array($arParams["ELEMENT_SORT_FIELD"] => $arParams["ELEMENT_SORT_ORDER"]), $arFilter);
$arResult["~QUICK_BUY"] = $arResult["DETAIL_PAGE_URL"].(stripos($arResult["DETAIL_PAGE_URL"], '?') === false ? '?' : '&').$arParams["ACTION_VARIABLE"]."=QUICKBUY&".$arParams["PRODUCT_ID_VARIABLE"]."=".$arResult["ID"];
$arResult["QUICK_BUY"] = htmlspecialcharsbx($arResult['~QUICK_BUY']);
$rsShops = CIBlockElement::GetList(Array("SORT" => "ASC"), array("IBLOCK_ID" => $arResult["PROPERTIES"]["SHOP_ISSET"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y"));
while($obShops = $rsShops->GetNextElement())
{
	$arShop = $obShops->GetFields();
	$arShop["PROPERTIES"] = $obShops->GetProperties();
	if(in_array($arShop["ID"], $arResult["PROPERTIES"]["SHOP_ISSET"]["VALUE"]))
		$arShop["ISSET"] = "Y";
	$arResult["SHOPS"][] = $arShop;
}
?>