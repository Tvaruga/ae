<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Экспертное сообщество");?>
<?$GLOBALS['expertsFilter'] = array('GROUPS_ID'=>array(COMMUNITY_GROUP_ID));?>
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
<?$APPLICATION->IncludeComponent(
    "imedia:users.list",
    "b-experts__item",
    Array(
        "USERS_COUNT" => "10",
        "SORT_BY" => "ACTIVE_FROM",
        "SORT_ORDER" => "DESC",
        "FILTER_NAME" => "expertsFilter",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "Y",
        "PAGER_TEMPLATE" => "/local/php_interface/include/pager.php",
        "DISPLAY_TOP_PAGER" => "Y",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Пользователи",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>