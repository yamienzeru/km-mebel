<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="inner_page_title_block">
	<h1 class="title_catalog">
		<span class="main_title_catalog"><?=$APPLICATION->GetTitle(false)?></span>
	<?if(!empty($arResult["PROPERTIES"]["FACTORIES"]["VALUE"])):?>
		<span class="quantity_goods">
			<span class="number"><?=count($arResult["PROPERTIES"]["FACTORIES"]["VALUE"])?></span>
			<span class="lbl_goods"><?=getWord(count($arResult["PROPERTIES"]["FACTORIES"]["VALUE"]), array("брендовая <br> фабрика", "брендовых <br> фабрики", "брендовых <br> фабрик"));?> мира</span>
		</span>
	<?endif?>
		<div class="clearfix"></div>
	</h1>
	<div class="txt_block">
		<?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?><p><?endif?><?=$arResult["PREVIEW_TEXT"]?><?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?></p><?endif?>
		<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?><p><?endif?><?=$arResult["DETAIL_TEXT"]?><?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?></p><?endif?>
		<span class="show_all_txt show_all_txt_js">показать полностью</span>
	</div>
</div>
<?if(!empty($arResult["PROPERTIES"]["FACTORIES"]["VALUE"])):?>
<div class="factories_boxes">
<?foreach($arResult["PROPERTIES"]["FACTORIES"]["VALUE"] as $key => $photo):
	$link = $arResult["PROPERTIES"]["FACTORIES"]["DESCRIPTION"][$key];?>
	<div class="factory_box">
		<<?if(empty($link)):?>div<?else:?>a href="<?=$link?>" target="_blank"<?endif?> class="factory_link">
			<img src="<?=ResizeImage($photo, 246, 124)?>" alt=""/>
		</<?if(empty($link)):?>div<?else:?>a<?endif?>>
	</div>
<?endforeach?>
</div>
<?endif?>