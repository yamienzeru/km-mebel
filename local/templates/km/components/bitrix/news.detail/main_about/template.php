<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="history_success">
<?if(!empty($arResult["PROPERTIES"]["OLD"]["VALUE"]) || !empty($arResult["PROPERTIES"]["OLD_TEXT"]["VALUE"])):?>
	<div class="working_years"> 
	<?if(!empty($arResult["PROPERTIES"]["OLD"]["VALUE"])):?>
		<span class="number_17"><?=$arResult["PROPERTIES"]["OLD"]["~VALUE"]?></span>
	<?endif?>
	<?if(!empty($arResult["PROPERTIES"]["OLD_TEXT"]["VALUE"])):?>
		<p><?=$arResult["PROPERTIES"]["OLD_TEXT"]["~VALUE"]?></p>
	<?endif?>
	</div>
<?endif?>
	<h3 class="sub_title"><?=$arResult["~NAME"]?></h3>
	<?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?><p><?endif?><?=$arResult["PREVIEW_TEXT"]?><?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?></p><?endif?>
	<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?><p><?endif?><?=$arResult["DETAIL_TEXT"]?><?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?></p><?endif?>
	<a href="/about/" class="learn_more">узнать больше</a>
</div>