<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<form id="order_call" class="order_call_form popup_form" action="<?=POST_FORM_ACTION_URI?><?if($_REQUEST["ajax"] == "y"):?>&ajax=y<?endif?>" method="POST">
	<?=bitrix_sessid_post()?>
	<h1>Бесплатная услуга <br> обратный звонок</h1>
<?if(strlen($arResult["OK_MESSAGE"]) > 0):?>
	<p class="p-btm"><?=$arResult["OK_MESSAGE"]?></p>
<?else:?>
<?if(!empty($arResult["ERROR_MESSAGE"]))
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);?>
	<p>Вы не можете до нас дозвониться или ограничены во времени? Тогда воспользуйтесь новым сервисом — «Обратный звонок». Услуга полностью бесплатная! Наши специалисты работают для Вас ежедневно с понедельника по пятницу с 9:00 до 17:30 часов. Для заказа звонка нашего специалиста, просто заполните специальную форму ниже и наш менеджер сам перезвонит Вам, ответит на все вопросы или оформит заказ за Вас.</p>

<?foreach($arParams["FIELDS"] as $field) if(!empty($field))
	if($arParams[$field."_TYPE"] == "LIST" || $arParams[$field."_TYPE"] == "IBLOCK_ELEMENTS"):?>
	<label class="order_call_form_label">
		<span class="order_call_form_descr"><?=(!empty($arParams[$field."_NAME"]) ? $arParams[$field."_NAME"] : $field)?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array($field, $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>:</span>
		<select class="order_call_form_select" name="<?=$field?>">
		<?foreach($arResult[$field."_VALUE"] as $value)
			if(!empty($value)):?>
			<option<?if($value == $arResult[$field]):?> selected<?endif?>><?=$value?></option>
			<?endif?>
		</select>
	</label>
	<?elseif($arParams[$field."_TYPE"] == "HIDDEN"):?>
	<input type="hidden" name="<?=$field?>" value="<?=$arResult[$field]?>">
	<?else:?>
	<label class="order_call_form_label">
		<span class="order_call_form_descr"><?=(!empty($arParams[$field."_NAME"]) ? $arParams[$field."_NAME"] : $field)?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array($field, $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>:</span>
	<?if($field != "MESSAGE"):?>
		<input type="<?if($field == "PHONE"):?>tel<?else:?>text<?endif?>" class="order_call_form_input<?if($field == "PHONE"):?> phone_number_js<?endif?>" placeholder="<?=$arParams[$field."_PLACEHOLDER"]?>"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array($field, $arParams["REQUIRED_FIELDS"])):?> required=""<?endif?> name="<?=$field?>"<?if($field == "PHONE"):?> pattern="[\+]\d{1}[\(]\d{3}[\)]\d{3}[\-]\d{2}[\-]\d{2}" maxlength="16" autocomplete="off" id="phone_number"<?endif?>>
	<?else:?>
		<textarea class="order_call_form_input_textarea" name="<?=$field?>" placeholder="<?=$arParams[$field."_PLACEHOLDER"]?>"<?if(empty($arParams["REQUIRED_FIELDS"]) || in_array($field, $arParams["REQUIRED_FIELDS"])):?> required=""<?endif?>><?=$arResult[$field]?></textarea>
	<?endif?>
	</label>
	<?endif?>

<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<?if($arParams["CAPTCHA"] == "C"):?>
	<label class="order_call_form_label capcha_lbl">
		<span class="order_call_form_descr"></span>
		<img src="<?=SITE_TEMPLATE_PATH?>/static/images/arc_icon.png" alt=""/>
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" alt=""/>
	</label>				
	<label class="order_call_form_label">
		<span class="order_call_form_descr">Введите код с картинки<span class="mf-req">*</span>:</span>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<input type="text" name="captcha_word" maxlength="50" value="" class="order_call_form_input" placeholder="" required="">
	</label>
	<?elseif($arParams["CAPTCHA"] == "H"):?>
	<label class="order_call_form_label" style="display:none;">
		<input type="text" name="name" value="">
	</label>
	<?endif;?>
<?endif;?>		
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="hidden" name="submit" value="Y">
	<input type="submit" value="заказать" class="order_call_form_btn_order">	
<?endif?>			
</form>