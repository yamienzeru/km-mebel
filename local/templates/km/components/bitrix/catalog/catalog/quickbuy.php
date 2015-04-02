<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->IncludeComponent(
	"km:feedback", 
	".default", 
	array(
		"USE_CAPTCHA" => "Y",
		"CAPTCHA" => "C",
		"OK_TEXT" => "Спасибо за заказ! Наши специалисты перезвонят Вам, сообщат условия доставки, наличие товара и ответят на все вопросы.",
		"EMAIL_TO" => "testruformat@yandex.ru",
		"EVENT_MESSAGE_ID" => array(
			0 => "37",
		),
		"FIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
			2 => "CITY",
			3 => "TIME",
			4 => "MESSAGE",
			5 => "PRODUCT",
			6 => "",
		),
		"REQUIRED_FIELDS" => array(
			0 => "NAME",
			1 => "PHONE",
			2 => "PRODUCT",
		),
		"NAME_NAME" => "Имя",
		"NAME_TYPE" => "STRING",
		"EMAIL_NAME" => "",
		"EMAIL_TYPE" => "STRING",
		"PHONE_NAME" => "Телефон",
		"PHONE_TYPE" => "STRING",
		"MESSAGE_NAME" => "Дополнительная информация",
		"MESSAGE_TYPE" => "STRING",
		"NAME_PLACEHOLDER" => "Например, Иван Петрович",
		"NAME_TYPE_CHECK" => "NONE",
		"NAME_TYPE_USER" => "NAME",
		"EMAIL_PLACEHOLDER" => "",
		"EMAIL_TYPE_CHECK" => "NONE",
		"EMAIL_TYPE_USER" => "undefined",
		"PHONE_PLACEHOLDER" => "+70000000000",
		"PHONE_TYPE_CHECK" => "PHONE",
		"PHONE_TYPE_USER" => "PERSONAL_PHONE",
		"MESSAGE_PLACEHOLDER" => "... Хотела бы сделать заказ мой тел. +7 (903) 777-77-77",
		"MESSAGE_TYPE_CHECK" => "NONE",
		"MESSAGE_TYPE_USER" => "undefined",
		"CITY_NAME" => "Город",
		"CITY_TYPE" => "IBLOCK_ELEMENTS",
		"CITY_PLACEHOLDER" => "",
		"CITY_TYPE_CHECK" => "NONE",
		"CITY_TYPE_USER" => "",
		"TIME_NAME" => "Время звонка",
		"TIME_TYPE" => "LIST",
		"TIME_PLACEHOLDER" => "",
		"TIME_TYPE_CHECK" => "NONE",
		"TIME_TYPE_USER" => "",
		"TIME_LIST" => array(
			0 => "Сейчас",
			1 => "Через 30 минут",
			2 => "Через 1 час",
			3 => "Через 2 часа",
			4 => "",
		),
		"CITY_IBLOCK_ID" => "6",
		"CITY_ACTIVE" => "Y",
		"PRODUCT_NAME" => "Продукт",
		"PRODUCT_TYPE" => "HIDDEN",
		"SAVE_TO_IBLOCK" => "Y",
		"SAVE_IBLOCK" => "7"
	),
	$component
);?>
<?/*<form id="order_call" class="order_call_form popup_form" action="<?=$APPLICATION->GetCurPageParam("", array("quick_order"))?>">
	<h1>Бесплатная услуга <br> обратный звонок</h1>
<?if($_REQUEST["success"] == "y"):?>
	<p class="p-btm">Спасибо за заказ!<br /> Наши специалисты перезвонят Вам, <br /> сообщат условия доставки, наличие <br /> товара и ответят на все вопросы.</p>
<?else:?>
	<p>Вы не можете до нас дозвониться или ограничены во времени? Тогда воспользуйтесь новым сервисом — «Обратный звонок». Услуга полностью бесплатная! Наши специалисты работают для Вас ежедневно с понедельника по пятницу с 9:00 до 17:30 часов. Для заказа звонка нашего специалиста, просто заполните специальную форму ниже и наш менеджер сам перезвонит Вам, ответит на все вопросы или оформит заказ за Вас.</p>
	<label class="order_call_form_label">
		<span class="order_call_form_descr">Имя:</span>
		<input type="text" class="order_call_form_input" placeholder="Например, Иван Петрович" required="" name="name">
	</label>
	<label class="order_call_form_label">
		<span class="order_call_form_descr">Телефон:</span>
		<input id="phone_number" type="tel" class="order_call_form_input phone_number_js" placeholder="+70000000000" name="phone" pattern="[\+]\d{1}[\(]\d{3}[\)]\d{3}[\-]\d{2}[\-]\d{2}" required="" maxlength="16" autocomplete="off">
	</label>
	<?$cities = array("Ростов-на-Дону", "Краснодар");?>
	<label class="order_call_form_label">
		<span class="order_call_form_descr">Город:</span>
		<select class="order_call_form_select" name="city">
		<?foreach($cities as $city):?>
			<option<?if($city == $_REQUEST["city"]):?> selected=""<?endif?>><?=$city?></option>
		<?endforeach?>
		</select>
	</label>				
	<?$times = array("Сейчас", "Через 30 минут", "Через 1 час", "Через 2 часа");?>
	<label class="order_call_form_label">
		<span class="order_call_form_descr">Время звонка:</span>
		<select class="order_call_form_select" name="time">
		<?foreach($times as $time):?>
			<option<?if($time == $_REQUEST["time"]):?> selected=""<?endif?>><?=$time?></option>
		<?endforeach?>
		</select>
	</label>
	<label class="order_call_form_label">
		<span class="order_call_form_descr">Дополнительная информация:</span>
		<textarea class="order_call_form_input_textarea" placeholder="... Хотела бы сделать заказ мой тел. +7 (903) 777-77-77" required="" name="text">
		</textarea>
	</label>
	<label class="order_call_form_label capcha_lbl">
		<span class="order_call_form_descr"></span>
		<img src="images/arc_icon.png" alt=""/>
		<img src="images/capcha_icon.png" alt=""/>
	</label>				
	<label class="order_call_form_label">
		<span class="order_call_form_descr">Введите код с картинки:</span>
		<input type="text" class="order_call_form_input" placeholder="" required="">
	</label>				
	<input type="submit" value="заказать" class="order_call_form_btn_order" name="quick_order">	
<?endif?>			
</form>*/?>