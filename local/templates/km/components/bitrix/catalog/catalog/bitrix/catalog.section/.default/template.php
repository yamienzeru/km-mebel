<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?function ShowItem($arItem){?>
<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="catalog_box_link" id="<?=$arItem["ACTION_ID"]?>">
	<div class="inner_wrap_catalog_box">
	<?$status_class = array("new" => "new_goods", "hit" => "hits_goods", "%" => "actions_goods");
	if(!empty($arItem["PROPERTIES"]["STATUS"]["VALUE_XML_ID"]))
		foreach($arItem["PROPERTIES"]["STATUS"]["VALUE_XML_ID"] as $status):?><span class="<?=$status_class[$status]?>"><?=$status?></span><?endforeach?>					
		<div class="hover_layer_catalog">
			<img src="<?=SITE_TEMPLATE_PATH?>/static/images/icon_eye.png"/>
		</div>
	<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
		<img src="<?=ResizeImage($arItem["PREVIEW_PICTURE"], 287, 217, true)?>" alt="<?=$arItem["NAME"]?>"/>
	<?elseif(!empty($arItem["DETAIL_PICTURE"])):?>
		<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], 287, 217, true)?>" alt="<?=$arItem["NAME"]?>"/>
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
</a>
<?}?>

<div class="catalog_boxes">	
<?foreach($arResult["ITEMS"] as $arGroup):?>
<?if(!empty($arGroup)):
	$arItems = array_slice($arGroup, 0, $arParams["LINE_ELEMENT_COUNT"]);
	$arGroup = array_slice($arGroup, $arParams["LINE_ELEMENT_COUNT"]);?>
	<div class="row_catalog_box">
	<?foreach($arItems as $arItem):?>
		<div class="catalog_box">
			<?ShowItem($arItem);?>
		</div>
	<?endforeach?>
		<div class="clearfix"></div>
	</div>
<?endif?>
<?if(!empty($arGroup)):?>
	<div class="row_catalog_box">
	<?if($arParams["LINE_ELEMENT_COUNT"] == 4):
		$arItems = array_slice($arGroup, 0, 2);
		$arGroup = array_slice($arGroup, 2);?>
		<div class="catalog_box">
		<?foreach($arItems as $arItem):?>
			<?ShowItem($arItem);?>
		<?endforeach?>
		</div>
	<?endif?>	
	<?if(!empty($arGroup)):
		$arItems = array_slice($arGroup, 0, 1);
		$arGroup = array_slice($arGroup, 1);?>										
		<div class="catalog_box  double_catalog_box">
			<?ShowItem($arItem);?>
		</div>	
	<?endif?>		

	<?if(!empty($arGroup)):
		$arItems = array_slice($arGroup, 0, 2);
		$arGroup = array_slice($arGroup, 2);?>
		<div class="catalog_box">
		<?foreach($arItems as $arItem):?>
			<?ShowItem($arItem);?>
		<?endforeach?>
		</div>
	<?endif?>	
		<div class="clearfix"></div>
	</div>
<?endif?>
<?if(!empty($arGroup)):
	$arItems = array_slice($arGroup, 0, $arParams["LINE_ELEMENT_COUNT"]);
	$arGroup = array_slice($arGroup, $arParams["LINE_ELEMENT_COUNT"]);?>
	<div class="row_catalog_box">
	<?foreach($arItems as $arItem):?>
		<div class="catalog_box">
			<?ShowItem($arItem);?>
		</div>
	<?endforeach?>
		<div class="clearfix"></div>
	</div>
<?endif?>
<?endforeach?>
</div>
<? echo $arResult["NAV_STRING"]; ?>