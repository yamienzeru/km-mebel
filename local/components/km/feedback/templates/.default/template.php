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
<div class="mfeedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>

<?foreach($arParams["FIELDS"] as $field) if(!empty($field))
	if($arParams[$field."_TYPE"] == "LIST" || $arParams[$field."_TYPE"] == "IBLOCK_ELEMENTS"):?>
	<div class="mf-message">
		<div class="mf-text">
			<?=(!empty($arParams[$field."_NAME"]) ? $arParams[$field."_NAME"] : $field)?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array($field, $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<select class="order_call_form_select" name="<?=$field?>">
		<?foreach($arResult[$field."_VALUE"] as $value):?>
			<option<?if($value == $arResult[$field]):?> selected<?endif?>><?=$value?></option>
		<?endforeach?>
		</select>
	</div>
	<?elseif($arParams[$field."_TYPE"] == "HIDDEN"):?>
	<div class="mf-hname">
		<input type="text" name="<?=$field?>" value="<?=$arResult[$field]?>">
	</div>
	<?else:?>
	<div class="mf-message">
		<div class="mf-text">
			<?=(!empty($arParams[$field."_NAME"]) ? $arParams[$field."_NAME"] : $field)?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array($field, $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<textarea name="<?=$field?>" rows="5" cols="40" placeholder="<?=$arParams[$field."_PLACEHOLDER"]?>"><?=$arResult[$field]?></textarea>
	</div>
	<?endif?>

<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<?if($arParams["CAPTCHA"] == "C"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?elseif($arParams["CAPTCHA"] == "H"):?>
	<div class="mf-hname">
		<input type="text" name="name" value="">
	</div>
	<?endif;?>
<?endif;?>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
</form>
</div>