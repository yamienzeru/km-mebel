<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="action_content">
	<h2 class="inner_title">Срок действия <?=$arResult["DISPLAY_ACTIVE_FROM"]?><?if(strlen($arResult["DISPLAY_ACTIVE_TO"])):?><?if(strlen($arResult["DISPLAY_ACTIVE_FROM"])):?> - <?else:?>до <?endif?><?=$arResult["DISPLAY_ACTIVE_TO"]?><?endif?><?if(strlen($arResult["DISPLAY_ACTIVE_TO"])):?> (<?if($arResult["TIME_ACTIVE_TO"] > 0):?> <?=getWord($arResult["TIME_ACTIVE_TO"], array("остался", "осталось", "осталось"))?> <?=$arResult["TIME_ACTIVE_TO"]?> <?=getWord($arResult["TIME_ACTIVE_TO"], array("день", "дня", "дней"))?><?else:?>Акция завершена<?endif?>)<?endif?></h2>
	<?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?><p class="txt"><?endif?><?=str_replace(array("<p", "<h2"), array("<p class=\"txt\"", "<h2 class=\"inner_title\""), $arResult["PREVIEW_TEXT"]);?><?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?></p><?endif?>
<?if(!empty($arResult["PROPERTIES"]["PHOTOS"]["VALUE"])):?>
	<div class="promo_slider_block">
		<div id="promo_slider"  class="flexslider">
			<ul class="slides">
			<?foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $photo):?>
				<li>
					<div class="promo_item">
						<img src="<?=ResizeImage($photo, 3*400, 400)?>" alt="">
					</div>
				</li>
			<?endforeach?>
			</ul>
		</div>
	</div>
<?endif?>
	<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?><p class="txt"><?endif?><?=str_replace(array("<p", "<h2"), array("<p class=\"txt\"", "<h2 class=\"inner_title\""), $arResult["DETAIL_TEXT"]);?><?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?></p><?endif?>
</div>			
<div class="action_navigation">
<?if(!empty($arResult["PAGINATION"]["PREV"])):?>
	<a href="<?=$arResult["PAGINATION"]["PREV"][0]["DETAIL_PAGE_URL"]?>" class="action_nav_link action_nav_link_prev">
		<span class="inner_wrap_nav_link"><?=$arResult["PAGINATION"]["PREV"][0]["NAME"]?></span>
	</a>
<?endif?>
<?if(!empty($arResult["PAGINATION"]["NEXT"])):?>
	<a href="<?=$arResult["PAGINATION"]["NEXT"][0]["DETAIL_PAGE_URL"]?>" class="action_nav_link action_nav_link_next">
		<span class="inner_wrap_nav_link"><?=$arResult["PAGINATION"]["NEXT"][0]["NAME"]?></span>
	</a>
<?endif?>
	<div class="clearfix"></div>
	<a href="<?=$arResult["LIST_PAGE_URL"]?>" class="action_nav_link to_list_action">
		<span class="inner_wrap_nav_link">вернуться в раздел акции</span>
	</a>
</div>