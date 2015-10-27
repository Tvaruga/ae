<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Экспертное сообщество");?>

<?$APPLICATION->IncludeComponent("bitrix:menu","b-tabs-menu_news",Array(
        "ROOT_MENU_TYPE" => "tabs",
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "A",
        "MENU_CACHE_TIME" => "360000",
        "MENU_CACHE_USE_GROUPS" => "N",
        "MENU_CACHE_GET_VARS" => ""
    )
);?>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list","b-community-categories",
    Array(
        "IBLOCK_TYPE" => "experts",
        "IBLOCK_ID" => "5",
        "COUNT_ELEMENTS" => "Y",
        "TOP_DEPTH" => "1",
        "SECTION_USER_FIELDS" => array('UF_CSS_ICON'),
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_NOTES" => "",
        "CACHE_GROUPS" => "N"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>