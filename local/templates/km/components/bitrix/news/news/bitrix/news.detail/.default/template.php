<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news_content">
	<h2 class="inner_title"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></h2>
	<?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?><p class="txt"><?endif?><?=str_replace(array("<p", "<h2"), array("<p class=\"txt\"", "<h2 class=\"inner_title\""), $arResult["PREVIEW_TEXT"]);?><?if($arResult["PREVIEW_TEXT_TYPE"] == "text"):?></p><?endif?>
<?if(!empty($arResult["DISPLAY_PROPERTIES"]["PHOTOS_ARCHIVE"]["VALUE"])):?>
</div>
<div class="loading_news_gallery_block">
	<a href="<?=$arResult["DISPLAY_PROPERTIES"]["PHOTOS_ARCHIVE"]["FILE_VALUE"]["SRC"]?>" class="loading_link" target="_blank">Не нашли себя на фото? скачать полную версию <?=FileFormatSize($arResult["DISPLAY_PROPERTIES"]["PHOTOS_ARCHIVE"]["FILE_VALUE"]["FILE_SIZE"])?></a>
</div>
<div class="news_content">
<?endif?>
<?if(!empty($arResult["PROPERTIES"]["PHOTOS"]["VALUE"]))
if($arResult["PROPERTIES"]["PHOTOS_VIEW"]["VALUE_XML_ID"] != "GALLERY"):?>
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
<?else:?>
</div>
<div class="news_gallery slow_show">
<?foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $key => $photo):?>
	<div class="news_gallery_item slow_show_block"<?if($key > 11):?> style="display:none;"<?endif?>>
		<a href="<?=ResizeImage($photo)?>" class="news_box_link gallery_link" rel="news_gallery">
			<div class="hover_layer_catalog">
				<img src="<?=SITE_TEMPLATE_PATH?>/static/images/icon_eye.png"/>
			</div>
			<img class="slow_show_block_image"<?if($key > 11):?> data-image="<?=ResizeImage($photo, 248, 181, true)?>"<?endif?> src="<?if($key > 11):?><?=SITE_TEMPLATE_PATH?>/static/images/icon_eye.png<?else:?><?=ResizeImage($photo, 248, 181, true)?><?endif?>" alt=""/>
		</a>
	</div>
<?endforeach?>		
</div>
<div class="news_content">
<?endif?>
<?if(!empty($arResult["PROPERTIES"]["SUBTITLE"]["VALUE"])):?>
	<h2 class="inner_title"><?=$arResult["PROPERTIES"]["SUBTITLE"]["~VALUE"]?></h2>
<?endif?>
	<?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?><p class="txt"><?endif?><?=str_replace(array("<p", "<h2"), array("<p class=\"txt\"", "<h2 class=\"inner_title\""), $arResult["DETAIL_TEXT"]);?><?if($arResult["DETAIL_TEXT_TYPE"] == "text"):?></p><?endif?>
<?if(!empty($arResult["PROPERTIES"]["VIDEO"]["VALUE"])):?>
	<div class="video_block">
		<iframe width="100%" height="500px" src="<?=GetVideoUrl($arResult["PROPERTIES"]["VIDEO"]["VALUE"])?>" frameborder="0" allowfullscreen></iframe>
	</div>
<?endif?>
	<?if($arResult["PROPERTIES"]["LAST_TEXT"]["VALUE"]["TYPE"] == "text"):?><p class="txt"><?endif?><?=str_replace(array("<p", "<h2"), array("<p class=\"txt\"", "<h2 class=\"inner_title\""), $arResult["PROPERTIES"]["LAST_TEXT"]["VALUE"]["TEXT"]);?><?if($arResult["PROPERTIES"]["LAST_TEXT"]["VALUE"]["TYPE"] == "text"):?></p><?endif?>
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
		<span class="inner_wrap_nav_link">вернуться в раздел новости</span>
	</a>
</div>