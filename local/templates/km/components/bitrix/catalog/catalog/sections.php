<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?if(strlen($_REQUEST["q"])):
	$APPLICATION->AddChainItem("Поиск \"".$_REQUEST["q"]."\"", $APPLICATION->GetCurPageParam("", array()));?>
	<h3 class="search_lbl">вы искали</h3>
	<form id="search_form">
		<div class="search_form_area">			
			<input type="input" name="q" value="<?=$_REQUEST["q"]?>" placeholder="">
			<input type="submit" class="search_btn search_results_btn">
		</div>
	</form>
	<div class="inner_page_title_block">
		<h1 class="title_catalog">
			<span class="main_title_catalog main_title_catalog_seacrh"><?if (empty($arResult["SEARCH_ELEMENTS"]) || !is_array($arResult["SEARCH_ELEMENTS"])):?>к сожалению ничего <br> не найдено<?else:?>результаты поиска<?endif?></span>
		<?if (!empty($arResult["SEARCH_ELEMENTS"])):?>
			<span class="quantity_goods">
				<span class="number"><?=count($arResult["SEARCH_ELEMENTS"])?></span>
				<span class="lbl_goods"><?=getWord(count($arResult["SEARCH_ELEMENTS"]), array("товар", "товара", "товаров"));?></span>
			</span>
		<?endif?>
			<div class="clearfix"></div>
		</h1>
	</div>
<?else:?>
	<div class="inner_page_title_block"<?if(!empty($arResult["CURRENT_SECTION"]["PREVIEW_INFO"])):?> id="<?=$this->GetEditAreaId($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["ID"])?>"<?endif?>>
		<h1 class="title_catalog">
			<span class="main_title_catalog"><?$APPLICATION->ShowTitle(false)?></span>
		<?if($arResult["CURRENT_SECTION"]["SUB_ELEMENTS_CNT"]):?>
			<span class="quantity_goods">
				<span class="number"><?=$arResult["CURRENT_SECTION"]["SUB_ELEMENTS_CNT"]?></span>
				<span class="lbl_goods"><?=getWord($arResult["CURRENT_SECTION"]["SUB_ELEMENTS_CNT"], array("товар", "товара", "товаров"));?></span>
			</span>
		<?endif?>
			<div class="clearfix"></div>
		</h1>
	<?if(strlen($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PREVIEW_TEXT"]) || strlen($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["DETAIL_TEXT"])):?>
		<div class="txt_block">
			<?if($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PREVIEW_TEXT_TYPE"] != "html"):?><p><?endif?><?=$arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PREVIEW_TEXT"]?><?if($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PREVIEW_TEXT_TYPE"] != "html"):?></p><?endif?>
			<?if($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["DETAIL_TEXT_TYPE"] != "html"):?><p><?endif?><?=$arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["DETAIL_TEXT"]?><?if($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["DETAIL_TEXT_TYPE"] != "html"):?></p><?endif?>
			<span class="show_all_txt show_all_txt_js">показать полностью</span>
		</div>
	<?endif?>
	</div>
<?endif?>
<?if($APPLICATION->GetCurPage() != $arResult["FOLDER"] && (empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) || $arResult["CURRENT_SECTION"]["ELEMENTS_CNT"] > 0)):?>
	<div class="left_sidebar">
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"panel",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => !empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) ? $arResult["VARIABLES"]["SECTION_ID"] : $arResult["CURRENT_SECTION"]["IBLOCK_SECTION_ID"],
				"SECTION_CODE" => !empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) ? $arResult["VARIABLES"]["SECTION_CODE"] : "",
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
				"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
				"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
				"CURRENT_SECTION" => $arResult["CURRENT_SECTION"]["ID"]
			),
			$component,
			array("HIDE_ICONS" => "Y")
		);?>
		<div class="filter_section">
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.smart.filter",
				"filter",
				Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arResult["CURRENT_SECTION"]["ID"],
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "36000000",
					"CACHE_NOTES" => "",
					"CACHE_GROUPS" => "Y",
					"SAVE_IN_SESSION" => "N",
					"XML_EXPORT" => "Y",
					"SECTION_TITLE" => "NAME",
					"SECTION_DESCRIPTION" => "DESCRIPTION",
				),
				$component,
				array('HIDE_ICONS' => 'Y')
			);?>
		</div>
	</div>
<?endif?>
<?if($APPLICATION->GetCurPage() != $arResult["FOLDER"] && (empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) || $arResult["CURRENT_SECTION"]["ELEMENTS_CNT"] > 0) || strlen($_REQUEST["q"])):?>
	<div class="container_with_filter">	
<?endif?>	
	<?if(is_array($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PHOTOS"]["VALUE"]) && count($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PHOTOS"]["VALUE"])):?>
		<div class="slider_gift_block">	
			<div id="slider_gift" class="flexslider">				
				<ul class="slides">
				<?foreach($arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PHOTOS"]["VALUE"] as $keyPhoto => $photo):?>
					<li class="gift_slider_item">						
						<span class="gift_name"><?=$arResult["CURRENT_SECTION"]["PREVIEW_INFO"]["PHOTOS"]["DESCRIPTION"][$keyPhoto]?></span>
						<img src="<?=ResizeImage($photo, 83, 69, true)?>" alt="" class="gift_icon"/>
					</li>
				<?endforeach?>					
				</ul>				
			</div>
		</div>	
	<?endif?>
	<?if($APPLICATION->GetCurPage() != $arResult["FOLDER"] && (empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) || $arResult["CURRENT_SECTION"]["ELEMENTS_CNT"] > 0) || (strlen($_REQUEST["q"]) && !empty($arResult["SEARCH_ELEMENTS"]))):?>
		<div class="sorted_block">
			<div class="sorted_item">
				<label class="sorted__label">Сортировать по</label>
				<div class="sorted__select">
					<select class="styled sort_select" onchange="location.href='?'+this.options[this.selectedIndex].value">
					<?foreach($arResult["ELEMENT_SORT"] as $arSort):?>
						<option value="<?=$arSort["LINK"]?>"<?if($arSort["SELECTED"] == "Y"):?> selected<?endif?>><?=$arSort["NAME"]?></option>
					<?endforeach?>							
					</select>
				</div>
			</div>
			<div class="sorted_item">
				<label class="sorted__label">Показать по</label>
				<div class="sorted__select">
					<select class="styled sort_select" onchange="location.href='?'+this.options[this.selectedIndex].value">
					<?foreach($arResult["ELEMENT_COUNTS"] as $count => $link):?>
						<option value="<?=$link?>"<?if($count == $arParams["PAGE_ELEMENT_COUNT"]):?> selected<?endif?>><?=$count?></option>
					<?endforeach?>						
					</select>
				</div>
			</div>					
		</div>
<?if(strlen($_REQUEST["q"])):?>
	</div>
	<div class="container_search_results">	
<?endif?>
		<?$intSectionID = $APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			"",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
				"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
				"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
				"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

				"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
				'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
				'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
				'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
				'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"ADD_SECTIONS_CHAIN" => "N",
				'ADD_TO_BASKET_ACTION' => $basketAction,
				'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
				'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],

				"SHOW_ALL_WO_SECTION" => "Y",
			),
			$component
		);?>
	<?if(empty($_REQUEST["q"])):?>
		<div class="adding_catalog_boxes">
			<?$intSectionID = $APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"recomended",
				array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"ELEMENT_SORT_FIELD" => "shows",
					"ELEMENT_SORT_ORDER" => "desc",
					"ELEMENT_SORT_FIELD2" => "id",
					"ELEMENT_SORT_ORDER2" => "desc",
					"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
					"INCLUDE_SUBSECTIONS" => "Y",
					"SHOW_ALL_WO_SECTION" => "Y",
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
					"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
					"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
					"FILTER_NAME" => $arParams["FILTER_NAME"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_FILTER" => $arParams["CACHE_FILTER"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SET_TITLE" => $arParams["SET_TITLE"],
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],
					"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
					"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
					"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
					"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
					"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
					"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

					"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
					"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],
					"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
					"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
					"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
					"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
					"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

					"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
					"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
					"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

					//"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					//"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

					'LABEL_PROP' => $arParams['LABEL_PROP'],
					'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
					'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

					'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
					'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
					'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
					'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
					'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
					'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
					'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
					'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
					'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
					'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

					'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
					"ADD_SECTIONS_CHAIN" => "N",
					'ADD_TO_BASKET_ACTION' => $basketAction,
					'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
					'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],

					"SHOW_ALL_WO_SECTION" => "Y",
				),
				$component
			);?>
			<?$APPLICATION->IncludeComponent(
				"bitrix:catalog.viewed.products",
				"",
				Array(
					"LINE_ELEMENT_COUNT" => 2,
					"TEMPLATE_THEME" => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
					"BASKET_URL" => $arParams["BASKET_URL"],
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
					"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
					"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
					"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
					"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
					"SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
					"SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
					"PRICE_CODE" => $arParams["PRICE_CODE"],
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
					"PRODUCT_SUBSCRIPTION" => $arParams['PRODUCT_SUBSCRIPTION'],
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
					"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
					"SHOW_NAME" => "Y",
					"SHOW_IMAGE" => "Y",
					"MESS_BTN_BUY" => $arParams['MESS_BTN_BUY'],
					"MESS_BTN_DETAIL" => $arParams['MESS_BTN_DETAIL'],
					"MESS_BTN_SUBSCRIBE" => $arParams['MESS_BTN_SUBSCRIBE'],
					"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
					"SHOW_FROM_SECTION" => "Y",
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => "",
					"SECTION_CODE" => "",
					"SECTION_ELEMENT_ID" => "",
					"SECTION_ELEMENT_CODE" => "",
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_NOTES" => "",
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"SHOW_PRODUCTS_2" => "Y",
					"PROPERTY_CODE_2" => array(),
					"CART_PROPERTIES_2" => array(),
					"ADDITIONAL_PICT_PROP_2" => "MORE_PHOTO",
					"LABEL_PROP_2" => "-",
					"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
					"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
					"CURRENCY_ID" => $arParams["CURRENCY_ID"],
				),
				$component
			);?>
			<div class="clearfix"></div>
		</div>
	<?endif?>
	<?endif?>
<?if($APPLICATION->GetCurPage() != $arResult["FOLDER"] && (empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) || $arResult["CURRENT_SECTION"]["ELEMENTS_CNT"] > 0) || strlen($_REQUEST["q"])):?>
	</div>
	<div class="clearfix"></div>
<?endif?>
<?if(empty($_REQUEST["q"])):?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section.list",
		"",
		array(
			"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
			"IBLOCK_ID" => $arParams["IBLOCK_ID"],
			"SECTION_ID" => !empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) || $arResult["CURRENT_SECTION"]["ELEMENTS_CNT"] > 0 ? $arResult["VARIABLES"]["SECTION_ID"] : $arResult["CURRENT_SECTION"]["IBLOCK_SECTION_ID"],
			"SECTION_CODE" => !empty($arResult["CURRENT_SECTION"]["SUBSECTIONS"]) || $arResult["CURRENT_SECTION"]["ELEMENTS_CNT"] > 0 ? $arResult["VARIABLES"]["SECTION_CODE"] : "",
			"CACHE_TYPE" => $arParams["CACHE_TYPE"],
			"CACHE_TIME" => $arParams["CACHE_TIME"],
			"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
			"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
			"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
			"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
			"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
			"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
			"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
		),
		$component,
		array("HIDE_ICONS" => "Y")
	);?>
<?endif?>