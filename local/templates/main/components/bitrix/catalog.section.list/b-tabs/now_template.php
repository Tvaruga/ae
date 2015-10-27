<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?><div class="cell s-4"><?
    $GLOBALS['topFilter'] = $GLOBALS[$arParams['FILTER_NAME']];
    $GLOBALS['topFilter']['!PROPERTY_TOP']=false;
    ?><?$topID=$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "top-news",
        Array(
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => 'N',
            "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "NEWS_COUNT" => 1,
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "DESC",
            "FIELD_CODE" => array("SHOW_COUNTER"),
            "PROPERTY_CODE" => array("vote_count",'VIDEO','MORE_PHOTO','VIDEO_LINK'),
            "CHECK_DATES" => "Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N",
            "FILTER_NAME"=>'topFilter',
        ),false,array('HIDE_ICONS' => 'Y')
    );?><?
    if(!empty($topID)){
        $GLOBALS[$arParams['FILTER_NAME']]['!ID']=$topID;
        echo '</div><div class="cell s-4">';
    }?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "b-group",
        Array(
            "PARENT_SECTION" => 1,
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => 'N',
            "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "NEWS_COUNT" => 3,
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "DESC",
            "FIELD_CODE" => array("SHOW_COUNTER"),
            "PROPERTY_CODE" => array("vote_count",'VIDEO','MORE_PHOTO','VIDEO_LINK'),
            "CHECK_DATES" => "Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N"
        )
    );?>
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "b-group",
        Array(
            "PARENT_SECTION" => 3,
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => 'N',
            "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "NEWS_COUNT" => 2,
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "DESC",
            "FIELD_CODE" => array("SHOW_COUNTER"),
            "PROPERTY_CODE" => array("vote_count",'VIDEO','MORE_PHOTO','VIDEO_LINK'),
            "CHECK_DATES" => "Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N"
        )
    );?>
</div>
<div class="cell s-4">
    <?$APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "b-group",
        Array(
            "PARENT_SECTION" => 4,
            "DISPLAY_DATE" => "Y",
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "AJAX_MODE" => 'N',
            "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
            "IBLOCK_ID" => $arParams['IBLOCK_ID'],
            "NEWS_COUNT" => 1,
            "SORT_BY1" => "ACTIVE_FROM",
            "SORT_ORDER1" => "DESC",
            "SORT_BY2" => "ID",
            "SORT_ORDER2" => "DESC",
            "FIELD_CODE" => array("SHOW_COUNTER"),
            "PROPERTY_CODE" => array("vote_count",'VIDEO','MORE_PHOTO','VIDEO_LINK'),
            "CHECK_DATES" => "Y",
            "SET_TITLE" => "N",
            "SET_BROWSER_TITLE" => "N",
            "SET_META_KEYWORDS" => "N",
            "SET_META_DESCRIPTION" => "N",
            "SET_LAST_MODIFIED" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",
            "CACHE_TYPE" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "SET_STATUS_404" => "N",
            "SHOW_404" => "N"
        )
    );?>
    <?$APPLICATION->IncludeComponent(
        "asd:subscribe.quick.form",
        "b-subscribe-field",
        Array(
            "FORMAT" => "html",
            "INC_JQUERY" => "N",
            "NOT_CONFIRM" => "Y",
            "RUBRICS" => array("1"),
            "SHOW_RUBRICS" => "N"
        )
    );?>
</div>
