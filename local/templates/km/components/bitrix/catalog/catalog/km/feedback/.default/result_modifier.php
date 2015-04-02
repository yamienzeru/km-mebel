<?if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
if($_REQUEST["id"] > 0)
{
	$arProduct = CIBlockElement::GetByID($_REQUEST["id"])->GetNext();
	$arResult["PRODUCT"] = $arProduct["NAME"];
}
?>