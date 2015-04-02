<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Профайл");
$APPLICATION->SetTitle("Дизайнерам");
?> <?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"profile",
	Array(
		"REGISTER_URL" => "/designers",
		"PROFILE_URL" => "/designers/profile.php",
		"SHOW_ERRORS" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>