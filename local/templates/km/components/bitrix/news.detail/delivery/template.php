<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="inner_page_title_block">
	<h1 class="main_title_center"><?=$APPLICATION->GetTitle(false)?></h1>
</div>
<div class="delivery_content">
	<div class="left_block">
		<span class="delivery_icon"></span>
	<?if(!empty($arResult["PROPERTIES"]["TITLE1"]["VALUE"])):?>
		<p class="txt_expanded"><?=$arResult["PROPERTIES"]["TITLE1"]["~VALUE"]?></p>
	<?endif?>
	<?if(!empty($arResult["PROPERTIES"]["TEXT11"]["VALUE"])):?>
		<p class="txt"><?=$arResult["PROPERTIES"]["TEXT11"]["~VALUE"]?></p>
	<?endif?>
	<?if(!empty($arResult["PROPERTIES"]["LIST11"]["VALUE"])):?>
		<ul class="delivery_advantages">
		<?foreach($arResult["PROPERTIES"]["LIST11"]["VALUE"] as $text):?>
			<li class="txt_gold">— <?=$text?></li>
		<?endforeach?>
		</ul>
	<?endif?>
	<?if(!empty($arResult["PROPERTIES"]["TEXT12"]["VALUE"])):?>
		<p class="txt"><?=$arResult["PROPERTIES"]["TEXT12"]["~VALUE"]?></p>
	<?endif?>
	</div>
	<div class="right_block">
		<div class="service_box">
		<?if(!empty($arResult["PROPERTIES"]["TITLE2"]["VALUE"])):?>
			<h3 class="service_box_title"><?=$arResult["PROPERTIES"]["TITLE2"]["~VALUE"]?></h3>
		<?endif?>
		<?if(!empty($arResult["PROPERTIES"]["TEXT21"]["VALUE"])):?>
			<p class="txt"><?=$arResult["PROPERTIES"]["TEXT21"]["~VALUE"]?></p>
		<?endif?>
		</div>
		<div class="service_box">	
		<?if(!empty($arResult["PROPERTIES"]["TITLE3"]["VALUE"])):?>
			<a href="/delivery/fitting_furniture.php" class="iframe_fitting_furniture js_modal link_fitting"><h3 class="service_box_title"><?=$arResult["PROPERTIES"]["TITLE3"]["~VALUE"]?></h3></a>
		<?endif?>
		<?if(!empty($arResult["PROPERTIES"]["TEXT31"]["VALUE"])):?>
			<p class="txt"><?=$arResult["PROPERTIES"]["TEXT31"]["~VALUE"]?></p>
		<?endif?>
		</div>
		<div class="service_box">
		<?if(!empty($arResult["PROPERTIES"]["TITLE4"]["VALUE"])):?>
			<h3 class="service_box_title"><?=$arResult["PROPERTIES"]["TITLE4"]["~VALUE"]?></h3>
		<?endif?>
		<?if(!empty($arResult["PROPERTIES"]["TEXT41"]["VALUE"])):?>
			<p class="txt"><?=$arResult["PROPERTIES"]["TEXT41"]["~VALUE"]?></p>
		<?endif?>
		</div>					
		
	</div>
	<div class="clearfix"></div>
</div>