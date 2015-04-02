<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<span class="quantity_actions"><?=$arResult["ITEMS_COUNT"]?></span>
<span class="lbl_actions"> <?=getWord($arResult["ITEMS_COUNT"], array("акция", "акции", "акций"));?></span>
<a href="<?=$arResult["LIST_PAGE_URL"]?>" class="btn_actions">все акции</a>
<div class="slider_actions_block">
	<div id="slider_action" class="flexslider">
		<ul class="slides">
		<?foreach($arResult["ITEMS"] as $keyItem => $arItem):?>
			<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>			
			<li>
			<?if(!empty($arItem["DETAIL_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], 1245, 278)?>" alt=""/>
			<?endif?>
				<span class="date_interval"><?=$arItem["DISPLAY_ACTIVE_FROM"]?><?if(strlen($arItem["DISPLAY_ACTIVE_TO"])):?><?if(strlen($arItem["DISPLAY_ACTIVE_FROM"])):?> - <?else:?>до <?endif?><?=$arItem["DISPLAY_ACTIVE_TO"]?><?endif?><?if(strlen($arItem["DISPLAY_ACTIVE_TO"])):?>  (<?if($arItem["TIME_ACTIVE_TO"] > 0):?> <?=getWord($arItem["TIME_ACTIVE_TO"], array("остался", "осталось", "осталось"))?> <?=$arItem["TIME_ACTIVE_TO"]?> <?=getWord($arItem["TIME_ACTIVE_TO"], array("день", "дня", "дней"))?><?else:?>акция завершена<?endif?>)<?endif?></span>
			</li>
		<?endforeach;?>					
		</ul>
	</div>
</div>