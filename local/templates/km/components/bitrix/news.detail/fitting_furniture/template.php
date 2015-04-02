<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="wrapper inner_page_wrapper">
<div class="main_container inner_page fitting_page">
	<div class="inner_page_title_block">
			<span class="fitting_icon"></span>
			<h1 class="main_title_center"><?=$APPLICATION->GetTitle(false)?></h1>
	</div>
	<div class="fitting_content">
		<?=str_replace(array("<p", "<h3"), array("<p class=\"txt\"", "<h3 class=\"service_box_title\""), $arResult["DETAIL_TEXT"]);?>
	</div>
</div>
</div>