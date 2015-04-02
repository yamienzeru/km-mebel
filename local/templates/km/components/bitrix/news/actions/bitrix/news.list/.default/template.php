<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="action_boxes">
<?foreach($arResult["ITEMS"] as $keyItem => $arItem):?>
	<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>			
	<div class="action_box" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="action_box_link">
			<div class="inner_wrap_action_box">
			<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["PREVIEW_PICTURE"], 2*220, 220)?>" alt="<?echo $arItem["NAME"]?>"/>							
			<?elseif(!empty($arItem["DETAIL_PICTURE"])):?>
				<img src="<?=ResizeImage($arItem["DETAIL_PICTURE"], 2*220, 220, true)?>" alt="<?=$arItem["NAME"]?>"/>
			<?endif?>
			</div>
			<div class="action_item_descr">
				<span class="action_item_name"><?echo $arItem["NAME"]?></span>
				<span class="action_item_date"><?=$arItem["DISPLAY_ACTIVE_FROM"]?><?if(strlen($arItem["DISPLAY_ACTIVE_TO"])):?><?if(strlen($arItem["DISPLAY_ACTIVE_FROM"])):?> - <?else:?>до <?endif?><?=$arItem["DISPLAY_ACTIVE_TO"]?><?endif?><?if(strlen($arItem["DISPLAY_ACTIVE_TO"])):?>  (<?if($arItem["TIME_ACTIVE_TO"] > 0):?> <?=getWord($arItem["TIME_ACTIVE_TO"], array("остался", "осталось", "осталось"))?> <?=$arItem["TIME_ACTIVE_TO"]?> <?=getWord($arItem["TIME_ACTIVE_TO"], array("день", "дня", "дней"))?><?else:?>акция завершена<?endif?>)<?endif?></span>
			</div>
		</a>
	</div>
<?endforeach;?>
	<!--<div class="clearfix"></div>-->
</div>

<?=$arResult["NAV_STRING"]?>