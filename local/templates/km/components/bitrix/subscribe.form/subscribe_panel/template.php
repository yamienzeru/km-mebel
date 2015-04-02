<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="sale_following">
	<form id="subscribe_form" method="post" class="popup_form" action="<?=$arResult["FORM_ACTION"]?>">
		<?=bitrix_sessid_post()?>
	<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
		<input type="hidden" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" />
	<?endforeach;?>
		<span class="subscriber_sale_title">узнайте первыми о выгодных предложениях</span>
		<div class="subscriber_sale">			
			<input type="email" name="EMAIL" value="" placeholder="Ваш e-mail..." required="">
			<input type="submit" class="subscriber_sale_btn" name="OK" value="подписаться &#10; на скидки">
		</div>
	</form>
</div>