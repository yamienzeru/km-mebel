<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["FILE"] <> ''):?>
<div class="error_page_content">
	<div class="error_icon">
		<img src="<?=SITE_TEMPLATE_PATH?>/static/images/icon_error404.png" alt="">
	</div>
	<p class="error_description"><?include($arResult["FILE"]);?></p>
	<a href="/" class="error_link">Перейти на главную</a>
</div>
<?endif?>