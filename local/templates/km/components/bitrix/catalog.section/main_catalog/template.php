<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<ul class="slides">
	<li>
	<?foreach($arResult["ITEMS"] as $keyItem => $arItem):?>
<?if($keyItem && !($keyItem % $arParams["LINE_ELEMENT_COUNT"])):?>
	</li>
	<li>
<?endif?>
		<div href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="single_slide">
		<?$status_class = array("new" => "new_goods", "hit" => "hits_goods", "%" => "actions_goods");
		if(!empty($arItem["PROPERTIES"]["STATUS"]["VALUE_XML_ID"]))
			foreach($arItem["PROPERTIES"]["STATUS"]["VALUE_XML_ID"] as $status):?><span class="<?=$status_class[$status]?>"><?=$status?></span><?endforeach?>	
			<div class="inner_wrap_slider_img">
				<div class="hover_layer"></div>
			<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["PREVIEW_PICTURE"], $arParams["IMAGE_WIDTH"], $arParams["IMAGE_HEIGHT"], true)?>" alt="<?=$arItem["NAME"]?>"/>
			<?elseif(!empty($arItem["DETAIL_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], $arParams["IMAGE_WIDTH"], $arParams["IMAGE_HEIGHT"], true)?>" alt="<?=$arItem["NAME"]?>"/>
			<?endif?>	
			</div>	
			<span class="name_goods"><?=$arItem["NAME"]?></span>
		<?if(!empty($arItem['MIN_PRICE'])):?>
			<span class="price_goods">
			<?if($arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] != $arItem['MIN_PRICE']['PRINT_VALUE']):?>
				<span class="line_through_span"><span class="old_price_goods"><?=$arItem['MIN_PRICE']['PRINT_VALUE']?></span></span>
				<span class="new_price_goods"><?=$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
			<?else:?>
				<span class="current_price_goods"><?=$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
			<?endif?>
			</span>	
		<?endif?>	
		</div>
	<?endforeach?>
	</li>
</ul>