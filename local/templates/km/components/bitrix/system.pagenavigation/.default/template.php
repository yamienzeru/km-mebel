<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>";

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

?>

<?if($arResult["NavPageCount"] > 1):?>
<div class="paging_box">
<?if($arResult["nStartPage"] > 1):?>
	<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="page_number">1</a> 
	<a href="#" class="page_number">...</a>
<?endif?>
<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
	<a href="<?if($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?><?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?><?else:?><?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?><?endif?>" class="page_number<?if($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>  active_number_page<?endif?>"><?=$arResult["nStartPage"]?></a>
	<?$arResult["nStartPage"]++?>
<?endwhile?>
	<?if($arResult["nEndPage"] < $arResult["NavPageCount"]):?>
		<a href="#" class="page_number">...</a>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" class="page_number"><?=$arResult["NavPageCount"]?></a>
	<?endif?>
</div>
<?endif;?>