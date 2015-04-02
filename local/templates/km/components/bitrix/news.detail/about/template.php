<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="inner_page_title_block">
	<h1 class="main_title_center about_company_title"><?=$APPLICATION->GetTitle(false)?></h1>
</div>
<div class="about_company_content">
	<?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?><p class="txt"><?endif?><?=str_replace(array("<p", "<h2"), array("<p class=\"txt\"", "<h2 class=\"inner_title\""), $arResult["PREVIEW_TEXT"]);?><?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?></p><?endif?>
	<?if(!empty($arResult["PROPERTIES"]["UPPER_TEXT"]["VALUE"])):?><p class="txt_expanded"><?=$arResult["PROPERTIES"]["UPPER_TEXT"]["~VALUE"]?></p><?endif?>				
	<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?><p class="txt"><?endif?><?=str_replace(array("<p", "<h2"), array("<p class=\"txt\"", "<h2 class=\"inner_title\""), $arResult["DETAIL_TEXT"]);?><?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?></p><?endif?>
</div>	
<?if(!empty($arResult["PROPERTIES"]["BIG_TEXT"]["VALUE"])):?>
<div class="inner_page_title_block">
	<h1 class="bottom_title_center"><?=$arResult["PROPERTIES"]["BIG_TEXT"]["~VALUE"]?></h1>
</div>
<?endif?>