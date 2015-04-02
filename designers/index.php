<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Дизайнерам");
?>
<?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "designers_index", array(
	"REGISTER_URL" => "/designers",
	"PROFILE_URL" => "/designers/profile.php",
	"SHOW_ERRORS" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>