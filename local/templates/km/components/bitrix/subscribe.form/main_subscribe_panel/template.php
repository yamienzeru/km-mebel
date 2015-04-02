<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="discount_block js_show_after_slider">
	<h2>узнайте<br>о скидках<br>первыми</h2>
	<div class="black_rectangle"></div>
	<p>Будте в курсе всех скидок и выгодных предложений от Мебель-КМ</p>
	<form id="subscribe_form" method="post" class="popup_form" action="<?=$arResult["FORM_ACTION"]?>">
		<?=bitrix_sessid_post()?>
	<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
		<input type="hidden" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" />
	<?endforeach;?>
		<div class="subscriber">			
			<input type="email" placeholder="Ваш e-mail..." required="" name="EMAIL" value="">
			<input type="submit" class="subscriber_btn" name="OK">
		</div>
	</form>
</div>