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
</div>
<div class="b-right-sidebar">
  <?$APPLICATION->IncludeComponent("bitrix:menu","sections",Array(
          "TITLE"=>'Категории сообщества',
          "ROOT_MENU_TYPE" => "section.list",
          "MAX_LEVEL" => "1",
          "USE_EXT" => "Y",
          "DELAY" => "N",
          "ALLOW_MULTI_SELECT" => "N",
          "MENU_CACHE_TYPE" => "A",
          "MENU_CACHE_TIME" => "3600000",
          "MENU_CACHE_USE_GROUPS" => "N",
          "MENU_CACHE_GET_VARS" => ""
      )
  );?>
  <?$APPLICATION->IncludeComponent("bitrix:news.list","popular-items",Array(
          "TITLE"=>'Популярные посты экспертов',
          "DISPLAY_DATE" => "Y",
          "DISPLAY_NAME" => "Y",
          "DISPLAY_PREVIEW_TEXT" => "N",
          "AJAX_MODE" => "N",
          "IBLOCK_TYPE" => "experts",
          "IBLOCK_ID" => COMMUNITY_ID,
          "NEWS_COUNT" => "10",
          "SORT_BY2" => "ACTIVE_FROM",
          "SORT_ORDER2" => "DESC",
          "SORT_BY1" => "show_counter",
          "SORT_ORDER1" => "DESC",
          "FIELD_CODE" => array("SHOW_COUNTER","CREATED_BY"),
          "PROPERTY_CODE" => array("vote_count"),
          "CHECK_DATES" => "Y",
          "PREVIEW_TRUNCATE_LEN" => "",
          "ACTIVE_DATE_FORMAT" => "j M Y",
          "SET_TITLE" => "N",
          "SET_BROWSER_TITLE" => "N",
          "SET_META_KEYWORDS" => "N",
          "SET_META_DESCRIPTION" => "N",
          "SET_LAST_MODIFIED" => "N",
          "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
          "ADD_SECTIONS_CHAIN" => "N",
          "HIDE_LINK_WHEN_NO_DETAIL" => "N",
          "PARENT_SECTION" => $GLOBALS['PARENT_SECTION'],
          "PARENT_SECTION_CODE" => $GLOBALS['PARENT_SECTION_CODE'],
          "INCLUDE_SUBSECTIONS" => "Y",
          "CACHE_TYPE" => "A",
          "CACHE_TIME" => "360000",
          "CACHE_FILTER" => "N",
          "CACHE_GROUPS" => "N",
          "DISPLAY_TOP_PAGER" => "N",
          "DISPLAY_BOTTOM_PAGER" => "N",
          "SET_STATUS_404" => "N",
          "SHOW_404" => "N"
      )
  );?>
</div>