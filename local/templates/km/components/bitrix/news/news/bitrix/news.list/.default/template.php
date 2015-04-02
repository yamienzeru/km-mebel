<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"]) < 1) return;?>

<div class="news_boxes">	
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));?>		
	<div class="news_box" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="news_box_link">
			<div class="inner_wrap_catalog_box">
				<div class="hover_layer_catalog">
					<img src="<?=SITE_TEMPLATE_PATH?>/static/images/icon_eye.png"/>
				</div>
			<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["PREVIEW_PICTURE"], 315, 230, true)?>" alt="<?=$arItem["NAME"]?>"/>
			<?elseif(!empty($arItem["DETAIL_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], 315, 230, true)?>" alt="<?=$arItem["NAME"]?>"/>
			<?endif?>							
			</div>
			<div class="news_item_descr">
				<span class="news_item_date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?></span>
				<span class="news_item_name"><?=$arItem["NAME"]?></span>
				<?if(!empty($arItem["PROPERTIES"]["PREVIEW_TEXT"]["VALUE"])):?><p class="news_item_adding_info"><?=$arItem["PROPERTIES"]["PREVIEW_TEXT"]["~VALUE"]?></p><?endif?>
			</div>
		</a>
	</div>	
<?endforeach?>
	<!--<div class="clearfix"></div>-->
</div>
<?=$arResult["NAV_STRING"]?>