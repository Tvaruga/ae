<div class="b-right-sidebar b-right-sidebar_blue">
        <?$APPLICATION->IncludeComponent(
            "spira:statistics",
            ".default",
            Array(
                "BLOG_ID" => "2",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CATEGORIES_IBLOCK_ID" => "5",
                "EXPERTS_GROUP" => "14",
                "IBLOCK_ID" => "",
                "IBLOCK_TYPE" => "content",
                "QUESTIONS_IBLOCK_ID" => "6",
                "TITLE" => "Статистика сообщества",
                "WORK_IBLOCK_ID" => "5"
            )
        );?>
        <?$APPLICATION->IncludeComponent("bitrix:menu","section-activity",Array(
                "ROOT_MENU_TYPE" => "section.activity",
                "MAX_LEVEL" => "1",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600000",
                "MENU_CACHE_USE_GROUPS" => "N",
                "MENU_CACHE_GET_VARS" => ""
            )
        );?>
</div>