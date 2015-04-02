<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST["ajax"] != "y"):?>
	<?if($APPLICATION->GetCurPage() !== "/" && !(defined("ERROR_404") && ERROR_404 == "Y")):?>
		</div>
	<?endif?>	
	</div>
<?if($APPLICATION->GetCurPage() !== "/"):?>
	<?$APPLICATION->IncludeComponent("bitrix:subscribe.form", "subscribe_panel", Array(
		"USE_PERSONALIZATION" => "Y",
			"PAGE" => "/subscribe/",
			"SHOW_HIDDEN" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_NOTES" => ""
		),
		false
	);?>
<?endif?>
	<footer<?if($APPLICATION->GetCurPage() !== "/"):?> class="inner_page_footer"<?endif?>>

		<div class="top_footer">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "footer_vk_group", array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_TEMPLATE_PATH."/include_areas/vk_group.php",
				"EDIT_TEMPLATE" => ""
				),
				false
			);?>
			<div class="shared_block">
				<span class="shared_lbl">Поделиться</span>
				<a href="#" class="shared_link">вконтакте <span class="shared_numder">197 <span class="triangle"></span></span> </a>
				<a href="#" class="shared_link">facebook  <span class="shared_numder">55 <span class="triangle"></span></span> </a>
				<a href="#" class="shared_link">twitter <span class="shared_numder">78 <span class="triangle"></span></span>  </a> 
			</div>
			<div class="phone_block">
				<span>Ждем ваших звонков</span>
				<span class="phone_number"><?$APPLICATION->IncludeFile($APPLICATION->GetTemplatePath("include_areas/phone.php"), Array(), Array("MODE"=>"text", "NAME" => "телефон"));?></span>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="bottom_footer">
			<span>©2010-2014  «КМ-мебель». Все права защищены </span>
			<a href="http://ruformat.ru/" class="developer_company" target="_blank">Разработка интернет магазина —<span class="Ru">Ру</span><span class="format">формат</span></a>
		</div>
	  
	</footer>

</div>
<?/*$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jquery-1.10.2.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jquery.flexslider.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jquery.carouFredSel-6.2.1.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jquery.jcarousel.min.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jcarousel.responsive.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/skrollr.min.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jquery.scrollTo.js");?>
<?$APPLICATION->AddHeadScript("//yastatic.net/share/share.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jquery.colorbox.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/jquery.customSelect.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/classie.js");?>
<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/static/js/script.js");*/?>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.carouFredSel-6.2.1.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jcarousel.responsive.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/skrollr.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.scrollTo.js"></script>
<script type="text/javascript" src="//yastatic.net/share/share.js" charset="utf-8"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.customSelect.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/jquery.form.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/classie.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/static/js/script.js"></script>
<?/*$APPLICATION->ShowHeadStrings();
$APPLICATION->ShowHeadScripts();*/?>
<?$APPLICATION->ShowPanel();?>
</body>
</html>
<?else: die(); endif;?>