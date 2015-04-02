<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Где купить");
?><?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"contacts",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "shops",
		"IBLOCK_ID" => "6",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => "",
		"PROPERTY_CODE" => array(0=>"*",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N"
	)
);?><?$APPLICATION->IncludeComponent("km:feedback", "contacts", Array(
	"USE_CAPTCHA" => "Y",	// Использовать защиту от автоматических сообщений для неавторизованных пользователей
		"CAPTCHA" => "C",	// Тип защиты от автоматических сообщений
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",	// Сообщение, выводимое пользователю после отправки
		"EMAIL_TO" => "testruformat@yandex.ru",	// E-mail, на который будет отправлено письмо
		"EVENT_MESSAGE_ID" => array(	// Почтовые шаблоны для отправки письма
			0 => "7",
		),
		"FIELDS" => array(	// Поля для заполнения
			0 => "NAME",
			1 => "CITY",
			2 => "PHONE",
			3 => "MESSAGE",
		),
		"REQUIRED_FIELDS" => array(	// Обязательные поля для заполнения
			0 => "NAME",
			1 => "PHONE",
		),
		"NAME_NAME" => "Имя",	// Заголовок для переменной 
		"NAME_TYPE" => "STRING",	// Тип поля
		"NAME_PLACEHOLDER" => "Например, Иван Петрович",	// Подсказка
		"NAME_TYPE_CHECK" => "NONE",	// Дополнительная проверка типа
		"NAME_TYPE_USER" => "NAME",	// Подставлять из пользователя
		"CITY_NAME" => "Город",	// Заголовок для переменной 
		"CITY_TYPE" => "IBLOCK_ELEMENTS",	// Тип поля
		"CITY_IBLOCK_ID" => "6",	// Инфоблок
		"CITY_ACTIVE" => "Y",	// Только активные
		"PHONE_NAME" => "Телефон",	// Заголовок для переменной 
		"PHONE_TYPE" => "STRING",	// Тип поля
		"PHONE_PLACEHOLDER" => "+70000000000",	// Подсказка
		"PHONE_TYPE_CHECK" => "NONE",	// Дополнительная проверка типа
		"PHONE_TYPE_USER" => "PERSONAL_PHONE",	// Подставлять из пользователя
		"MESSAGE_NAME" => "Текст сообщения",	// Заголовок для переменной 
		"MESSAGE_TYPE" => "STRING",	// Тип поля
		"MESSAGE_PLACEHOLDER" => "",	// Подсказка
		"MESSAGE_TYPE_CHECK" => "NONE",	// Дополнительная проверка типа
		"MESSAGE_TYPE_USER" => "",	// Подставлять из пользователя
		"SAVE_TO_IBLOCK" => "N",	// Сохранить в инфоблок
	),
	false
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>