<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form class="order_call_form popup_form" action="<?=$arResult["FORM_ACTION"]?><?if($_REQUEST["ajax"] == "y"):?>?ajax=y<?endif?>" method="POST">
	<?=bitrix_sessid_post()?>
<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
	<input type="hidden" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" />
<?endforeach;?>
	<h1>Подписка</h1>
<?if($arResult["ID"] > 0):?>
	<p class="p-btm">На введенный электронный адрес <?=$_REQUEST["EMAIL"]?> <br/> оформлена подписка.</p>
<?else:?>
	<?if(strlen($arResult["ERROR"])):?><p><?=$arResult["ERROR"]?></p><?endif?>
	<label class="order_call_form_label">
		<span class="order_call_form_descr">E-mail:</span>
		<input type="email" class="order_call_form_input" placeholder="Ваш e-mail..." required="" name="EMAIL" value="<?=$_REQUEST["EMAIL"]?>">
	</label>		
	<input type="submit" value="заказать" class="order_call_form_btn_order" name="OK">	
<?endif?>			
</form>