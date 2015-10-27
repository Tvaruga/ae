<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->IncludeComponent(
    "bitrix:menu","b-tabs-menu_news",
    Array(
        "CLASS"=>'b-tabs-menu_inline',
        "ROOT_MENU_TYPE" => "tabs-inner",
        "MAX_LEVEL" => "1",
        "CHILD_MENU_TYPE" => "",
        "USE_EXT" => "Y",
        "DELAY" => "N",
        "ALLOW_MULTI_SELECT" => "N",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_TIME" => "",
        "MENU_CACHE_USE_GROUPS" => "N",
        "MENU_CACHE_GET_VARS" => ""
    )
);
?>
<?$APPLICATION->IncludeComponent(
    "imedia:user.profile",
    "expert-profile",
    Array(
        "AJAX_MODE" => "N",
        "TITLE" => "#LAST_NAME# #NAME# #SECOND_NAME#",
        "BROWSER_TITLE" => "Эксперт #FULL_NAME#",
        "META_DESCRIPTION" => "",
        "META_KEYWORDS" => "",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "ID" => $_REQUEST['EXPERT_ID'],
        "MESSAGE_404" => "",
        "SET_STATUS_404" => "Y",
        "SHOW_404" => "N",
        "USER_PROPERTY" => array('UF_*'),
        "USE_PERMISSIONS" => "N"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
