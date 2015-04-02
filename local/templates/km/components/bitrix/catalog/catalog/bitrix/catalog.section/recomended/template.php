<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="interesting_goods_slider_block js_show">
	<h3 class="title_slider_block">вас могут <br> заинтересовать</h3>
	<div id="best_variant_slider" class="flexslider">
		<ul class="slides">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<li>	
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="single_slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">						
					<div class="inner_wrap_slider_img">
						<div class="hover_layer"></div>
					<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
						<img src="<?=ResizeImage($arItem["PREVIEW_PICTURE"], 606, 541, true)?>" alt="<?=$arItem["NAME"]?>"/>
					<?elseif(!empty($arItem["DETAIL_PICTURE"])):?>
						<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], 606, 541, true)?>" alt="<?=$arItem["NAME"]?>"/>
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
			</li>
		<?endforeach?>					
		</ul>	
	</div>
</div>