<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="popular_category">
	<h3>популярные категории</h3>
<?foreach ($arResult['SECTIONS'] as $keySection => $arSection):?>
	<?if($keySection > 0):?><span class="division_comma">,</span><?endif?>
	<a href="<?=$arSection["SECTION_PAGE_URL"]?>"><?=$arSection["~NAME"]?><span class="quantity_elements"><?=$arSection["ELEMENT_CNT"]?></span></a>
<?endforeach?>	
</div>