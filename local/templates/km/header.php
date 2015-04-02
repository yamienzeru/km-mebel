<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST["ajax"] != "y"):?>
<!DOCTYPE html>
<html>
<head>
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
	<?/*echo '<meta http-equiv="Content-Type" content="text/html; charset='.LANG_CHARSET.'"'.(true ? ' /':'').'>'."\n";
	$APPLICATION->ShowMeta("robots", false, true);
	$APPLICATION->ShowMeta("keywords", false, true);
	$APPLICATION->ShowMeta("description", false, true);
	$APPLICATION->ShowCSS(true, true);*/?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/static/css/reset.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/static/css/style.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/static/css/flexslider.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/static/css/component.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/static/css/colorbox.css");?>
	<?$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/static/css/jcarousel.responsive.css");?>
</head>
<body>
<div class="wrapper<?if($APPLICATION->GetCurPage() !== "/"):?> inner_page_wrapper<?endif?>">
	<div class="search_block morphsearch" id="morphsearch">
		<a href="#" class="search_block_link morphsearch_link"></a>
		<div class="search_body morphsearch-content">
			<span class="morphsearch-close"></span>
			<div class="search_form_container">
				<div class="inner_wrap_container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:search.form", 
						"search_panel", 
						array(
							"USE_SUGGEST" => "N",
							"PAGE" => "/catalog/"
						),
						false
					);?>
				</div>	
			</div>	
			<div class="popular_goods_search">
				<div class="inner_wrap_container">
					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section", 
						"catalog_popular_search", 
						array(
							"TEMPLATE_THEME" => "",
							"ADD_PICT_PROP" => "-",
							"LABEL_PROP" => "-",
							"PRODUCT_SUBSCRIPTION" => "N",
							"SHOW_DISCOUNT_PERCENT" => "Y",
							"SHOW_OLD_PRICE" => "Y",
							"ADD_TO_BASKET_ACTION" => "ADD",
							"SHOW_CLOSE_POPUP" => "N",
							"MESS_BTN_BUY" => "Купить",
							"MESS_BTN_ADD_TO_BASKET" => "В корзину",
							"MESS_BTN_SUBSCRIBE" => "Подписаться",
							"MESS_BTN_COMPARE" => "Сравнить",
							"MESS_BTN_DETAIL" => "Подробнее",
							"MESS_NOT_AVAILABLE" => "Нет в наличии",
							"AJAX_MODE" => "N",
							"IBLOCK_TYPE" => "catalog",
							"IBLOCK_ID" => "2",
							"SECTION_ID" => "",
							"SECTION_CODE" => "",
							"SECTION_USER_FIELDS" => array(
								0 => "",
								1 => "",
							),
							"ELEMENT_SORT_FIELD" => "shows",
							"ELEMENT_SORT_ORDER" => "desc",
							"ELEMENT_SORT_FIELD2" => "id",
							"ELEMENT_SORT_ORDER2" => "desc",
							"FILTER_NAME" => "arrFilter",
							"INCLUDE_SUBSECTIONS" => "Y",
							"SHOW_ALL_WO_SECTION" => "Y",
							"SECTION_URL" => "/catalog/#SECTION_CODE#/",
							"DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
							"SECTION_ID_VARIABLE" => "SECTION_CODE",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"BROWSER_TITLE" => "-",
							"SET_META_KEYWORDS" => "N",
							"META_KEYWORDS" => "-",
							"SET_META_DESCRIPTION" => "N",
							"META_DESCRIPTION" => "-",
							"ADD_SECTIONS_CHAIN" => "N",
							"DISPLAY_COMPARE" => "N",
							"SET_STATUS_404" => "N",
							"PAGE_ELEMENT_COUNT" => "12",
							"LINE_ELEMENT_COUNT" => "3",
							"PROPERTY_CODE" => array(
								0 => "",
								1 => "",
							),
							"OFFERS_LIMIT" => "5",
							"PRICE_CODE" => array(
								0 => "BASE",
							),
							"USE_PRICE_COUNT" => "N",
							"SHOW_PRICE_COUNT" => "1",
							"PRICE_VAT_INCLUDE" => "Y",
							"BASKET_URL" => "/personal/basket.php",
							"ACTION_VARIABLE" => "action",
							"PRODUCT_ID_VARIABLE" => "id",
							"USE_PRODUCT_QUANTITY" => "N",
							"PRODUCT_QUANTITY_VARIABLE" => "quantity",
							"ADD_PROPERTIES_TO_BASKET" => "Y",
							"PRODUCT_PROPS_VARIABLE" => "prop",
							"PARTIAL_PRODUCT_PROPERTIES" => "N",
							"PRODUCT_PROPERTIES" => array(
							),
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "3600",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"PAGER_TITLE" => "Товары",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"HIDE_NOT_AVAILABLE" => "N",
							"CONVERT_CURRENCY" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => ""
						),
						false
					);?>
				</div>
			</div>
		</div>	
	</div>
	<header class="header_fixed">
		<div class="logo_wrap">
			<a href="/" class="logo_link">
				<!--<img src="<?=SITE_TEMPLATE_PATH?>/static/images/logo_icon_header.png" alt="logo_icon_header" class="logo_icon_header"/>-->
					<div class="inner_wrap_logo">
						<img src="<?=SITE_TEMPLATE_PATH?>/static/images/square_icon_logo.png" alt="logo_icon_header" class="logo_icon_header square"/>
						<img src="<?=SITE_TEMPLATE_PATH?>/static/images/logo_txt.png" alt="logo_icon_header" class="logo_icon_header"/>
					</div>	
			</a>
		</div>
		<div class="nav_block<?if($APPLICATION->GetCurPage() !== "/"):?> inner_page_nav_block<?endif?>">
			<?$APPLICATION->IncludeComponent('bitrix:menu', "left_menu", array(
					"ROOT_MENU_TYPE" => "left",
					"MENU_CACHE_TYPE" => "Y",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(),
					"MAX_LEVEL" => "1",
					"USE_EXT" => "N",
					"ALLOW_MULTI_SELECT" => "N"
				)
			);?>
			<?$APPLICATION->IncludeComponent('bitrix:menu', "top_menu", array(
					"ROOT_MENU_TYPE" => "top",
					"MENU_CACHE_TYPE" => "Y",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(),
					"MAX_LEVEL" => "1",
					"USE_EXT" => "N",
					"ALLOW_MULTI_SELECT" => "N"
				)
			);?>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</header>
	<div class="main_container<?if($APPLICATION->GetCurPage() !== "/"):?> inner_page<?endif?>">
	<?if($APPLICATION->GetCurPage() !== "/" && !(defined("ERROR_404") && ERROR_404 == "Y")):?>
		<div class="inner_wrap_container">
			<?$APPLICATION->IncludeComponent(
				"bitrix:breadcrumb",
				"",
				Array(
					"START_FROM" => "0", 
					"PATH" => "", 
					"SITE_ID" => "" 
				)
			);?>
	<?endif?>
<?else: $APPLICATION->RestartBuffer(); endif;?>