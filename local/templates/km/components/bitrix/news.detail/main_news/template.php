<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="coctail_block js_show_after_slider">
	<img src="<?=SITE_TEMPLATE_PATH?>/static/images/coctail_icon.png" alt="coctail_icon">
<?if(!empty($arResult["PROPERTIES"]["COCTAIL_TEXT"]["VALUE"])):?>
	<p><?=$arResult["PROPERTIES"]["COCTAIL_TEXT"]["~VALUE"]?></p>
<?endif?>
</div>
<div class="actions_block js_show_after_slider">
	<div class="inner_wrap_actions_block">
	<?if(!empty($arResult["PREVIEW_PICTURE"])):?>
		<img src="<?=ResizeImage($arResult["PREVIEW_PICTURE"], 405, 405, true)?>" alt=""/>
	<?endif?>
		<a href="/news/" class="btn"><?=$arResult["~NAME"]?></a>
	</div>
<?if(!empty($arResult["PROPERTIES"]["BIG_TEXT"]["VALUE"])):?>
	<h2><?=$arResult["PROPERTIES"]["BIG_TEXT"]["~VALUE"]?></h2>
	<div class="black_rectangle"></div>
<?endif?>
</div>