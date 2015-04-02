<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?if (!empty($arResult['ITEMS'])):
	$arResult['ITEMS'] = array_values($arResult['ITEMS']);?>
<div class="seen_goods_slider_block js_show">
	<h3 class="title_slider_block">вы смотрели</h3>
	<div id="popular_slider"  class="flexslider">
		<ul class="slides">
			<li>
			<?foreach($arResult['ITEMS'] as $keyItem => $arItem):?>
				<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));?>
		<?if($keyItem && !($keyItem % 2)):?>
			</li>
			<li>
		<?endif?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="single_slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="inner_wrap_slider_img">
						<div class="hover_layer"></div>
						<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], 287, 217)?>" alt="<?=$arItem["NAME"]?>"/>
					</div>	
					<span class="name_goods"><?=$arItem["NAME"]?></span>
					<span class="price_goods">
					<?if($arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE'] != $arItem['MIN_PRICE']['PRINT_VALUE']):?>
						<span class="line_through_span"><span class="old_price_goods"><?=$arItem['MIN_PRICE']['PRINT_VALUE']?></span></span>
						<span class="new_price_goods"><?=$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
					<?else:?>
						<span class="current_price_goods"><?=$arItem['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
					<?endif?>
					</span>
				</a>
			<?endforeach?>												
			</li>
		</ul>				
	</div>
</div>
<?endif?>