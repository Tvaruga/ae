<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?$APPLICATION->IncludeComponent(
	"spira:statistics",
	"",
	Array(
		"BLOG_ID" => "2",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CATEGORIES_IBLOCK_ID" => "1",
		"COMPONENT_TEMPLATE" => ".default",
		"EXPERTS_GROUP" => "1",
		"QUESTIONS_IBLOCK_ID" => "1",
		"TITLE" => "",
		"WORK_IBLOCK_ID" => "1"
	)
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>