<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<h3>популярные</h3>
<div class="popular_seacrh_boxes">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="popular_seacrh_box">
		<div class="popular_seacrh_box_hover">
			<div class="wrap_seacrh_box_icon">
			<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["PREVIEW_PICTURE"], 52, 52, true)?>" alt="<?=$arItem["NAME"]?>"/>
			<?elseif(!empty($arItem["DETAIL_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], 52, 52, true)?>" alt="<?=$arItem["NAME"]?>"/>
			<?endif?>	
			</div>
			<div class="descr_seacrh_box">
				<div class="name_seacrh_box"><?=$arItem["NAME"]?></div>
			<?if(!empty($arItem['MIN_PRICE'])):?>
				<div class="price_seacrh_box">
					<?if($arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] != $arItem['MIN_PRICE']['PRINT_VALUE']):?><span class="old_price_seacrh_box"><?=$arItem['MIN_PRICE']['PRINT_VALUE']?></span><?endif?>
					<span class="current_price_seacrh_box"><?=$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
				</div>
			<?endif?>
			</div>
		</div>
	</a>
<?endforeach?>
	<div class="clearfix"></div>	
</div>