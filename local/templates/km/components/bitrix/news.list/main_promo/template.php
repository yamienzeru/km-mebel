<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="promo_slider_block">
	<div id="promo_slider"  class="flexslider">
		<ul class="slides">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<li>
				<div class="promo_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
					<img src="<?=ResizeImage($arItem["PREVIEW_PICTURE"])?>" alt="">
				<?endif?>
					<div class="promo_txt_layer">
						<h1><?=$arItem["~NAME"]?></h1>
					<?if(!empty($arItem["PROPERTIES"]["URL"]["VALUE"])):?>
						<a href="<?=$arItem["PROPERTIES"]["URL"]["VALUE"]?>" class="btn">узнать больше</a>
					<?endif?>
						<span class="icon_promo_lbl icon_down_scroll"></span>
					</div>
				</div>
			</li>
		<?endforeach?>
		</ul>
	</div>
</div>