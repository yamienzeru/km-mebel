<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?$arResult["SECTIONS"] = SectionTree($arResult["SECTIONS"]);?>

<ul class="sub_menu">
<?foreach ($arResult["SECTIONS"] as $arSection):?>				
	<li<?if(!empty($arSection["SECTIONS"])):?> class="has_sub_sub_menu"<?endif?>>
		<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="sub_menu_link"><?=$arSection["~NAME"]?> <span class="menu_link_number"><?=$arSection["ELEMENT_CNT"]?></span></a>
	<?if(!empty($arSection["SECTIONS"])):?>
		<ul class="sub_sub_menu">
		<?foreach ($arSection["SECTIONS"] as $arSubSection):?>
			<li>
				<a href="<?=$arSubSection["SECTION_PAGE_URL"]?>" class="sub_menu_link"><?=$arSubSection["~NAME"]?> <span class="menu_link_number"><?=$arSubSection["ELEMENT_CNT"]?></span></a>
			</li>
		<?endforeach?>		
		</ul>
	<?endif?>							
	</li>
<?endforeach?>
</ul>