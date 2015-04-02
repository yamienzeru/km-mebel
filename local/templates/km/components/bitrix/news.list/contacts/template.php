<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div class="inner_page_title_block">
	<h1 class="main_title_center"><?=$APPLICATION->GetTitle(false)?></h1>
</div>
<div class="working_times_block">			
	<span class="clock_icon"></span>
	<span class="working_times">10:00-19:00</span>
	<span>Салоны работают в будние дни </span>
</div>
<div class="cities_blocks">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
	<div class="city_block" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if(!empty($arItem["PROPERTIES"]["CITY"]["VALUE"])):?><h3 class="city_name"><?=$arItem["PROPERTIES"]["CITY"]["~VALUE"]?></h3><?endif?>
		<ul class="contact_info_list">
			<?if(!empty($arItem["PROPERTIES"]["ADDRESS"]["VALUE"])):?><li>Адрес:  <?=$arItem["PROPERTIES"]["ADDRESS"]["~VALUE"]?><li><?endif?>
			<?if(!empty($arItem["PROPERTIES"]["PHONE"]["VALUE"])):?><li>Телефоны:  <?=$arItem["PROPERTIES"]["PHONE"]["~VALUE"]?><li><?endif?>
			<?if(!empty($arItem["PROPERTIES"]["EMAIL"]["VALUE"])):?><li>E-mail: <a href="mailto:<?=$arItem["PROPERTIES"]["EMAIL"]["~VALUE"]?>" class="email_link"><?=$arItem["PROPERTIES"]["EMAIL"]["~VALUE"]?></a><li><?endif?>
			<?if(!empty($arItem["PROPERTIES"]["ICQ"]["VALUE"])):?><li>ICQ<?if(!empty($arItem["PROPERTIES"]["ICQ"]["DESCRIPTION"])):?> <?=$arItem["PROPERTIES"]["ICQ"]["~DESCRIPTION"]?><?endif?>:  <?=$arItem["PROPERTIES"]["ICQ"]["~VALUE"]?><li><?endif?>
			<?if(!empty($arItem["PROPERTIES"]["DIRECTOR"]["VALUE"])):?><li>Директор:  <?=$arItem["PROPERTIES"]["DIRECTOR"]["~VALUE"]?><li><?endif?>
		</ul>
	<?if(!empty($arItem["PROPERTIES"]["PANORAMAS"]["VALUE"])):?>
		<div class="panorama_boxes">
		<?foreach($arItem["PROPERTIES"]["PANORAMAS"]["VALUE"] as $key => $panorama):?>
			<a href="<?=$panorama?>" class="panorama_box js_panorama">
				<div class="wrap_panorama_picture">
					<img src="<?=$panorama?>/preview.png" alt="">								
				</div>
				<span class="panorama_name">3D-панорама<?if(!empty($arItem["PROPERTIES"]["PANORAMAS"]["DESCRIPTION"][$key])):?> <br> «<?=$arItem["PROPERTIES"]["PANORAMAS"]["~DESCRIPTION"][$key]?>»<?endif?></span>
			</a>
		<?endforeach?>					
		</div>
	<?endif?>
	<?if(!empty($arItem["PROPERTIES"]["MAP"]["VALUE"])):
		list($coord_y, $coord_x) = explode(",", $arItem["PROPERTIES"]["MAP"]["VALUE"]);?>
		<div data-x="<?=$coord_x?>" data-y="<?=$coord_y?>" class="contact_block_map contact_block_map_canvas" data-nameBalloon="<?=$arItem["PROPERTIES"]["CITY"]["~VALUE"]?>"  data-descriptionBalloon="<?=$arItem["PROPERTIES"]["ADDRESS"]["~VALUE"]?>"></div>
	<?endif?>
	</div>
<?endforeach?>
	<?/*<div class="city_block">
		<h3 class="city_name">Краснодар</h3>
		<ul class="contact_info_list">
			<li>Адрес:  ул.Тургенева, 76<li>
			<li>Телефоны:  8 (861) 201 5062	</li>
			<li>E-mail: <a href="#" class="email_link"> vlada_basalko@krasnodar.km-union.ru	</a></li>
			<li>ICQ в торговом зале:  647-738-740	</li>
			<li>Директор:  Басалко Влада Ивановна</li>
		</ul>
		<div class="panorama_boxes">
			<a class="panorama_box">
				<div class="wrap_panorama_picture">
					<img src="images/panorama3.png" alt="">								
				</div>
				<span class="panorama_name">3D-панорама</span>
			</a>						
		</div>
		<div id="contact_block_map_canvas2" data-x="39.72328" data-y="47.23135" class="contact_block_map contact_block_map_canvas" data-nameBalloon="Ростов-на-Дону"  data-descriptionBalloon="чудесный город">
		</div>					
	</div>*/?>
	<div class="clearfix"></div>
</div>
<script src="http://api-maps.yandex.ru/1.1/index.xml" type="text/javascript"></script>