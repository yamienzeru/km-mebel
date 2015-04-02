<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (empty($arResult)) return;?>

<nav class="main_menu">
	<ul>
	<?foreach($arResult as $itemIdex => $arItem):?>
		<li<?if($arItem["LINK"] == "/catalog/"):?> class="has_sub_menu"<?endif?>>
			<a href="<?=$arItem["LINK"]?>" class="main_menu_link"><?if($arItem["LINK"] == "/catalog/"):?> <span class="icon_submenu"></span><?endif?><?=$arItem["TEXT"]?></a>
		<?if($arItem["LINK"] == "/catalog/"):?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"menu_catalog_sections",
				Array(
					"VIEW_MODE" => "LIST",
					"SHOW_PARENT_NAME" => "Y",
					"IBLOCK_TYPE" => "catalog",
					"IBLOCK_ID" => "2",
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_URL" => "/catalog/#SECTION_CODE#/",
					"COUNT_ELEMENTS" => "Y",
					"TOP_DEPTH" => "2",
					"SECTION_FIELDS" => array(),
					"SECTION_USER_FIELDS" => array(),
					"ADD_SECTIONS_CHAIN" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_GROUPS" => "Y"
				),
			false
			);?>
		<?endif?>
		</li>
	<?endforeach;?>
		<div class="clearfix"></div>
	</ul>			
</nav>