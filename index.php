<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ARM Expert"); ?>
<?$APPLICATION->IncludeComponent("bitrix:news.list","b-blog-slider",Array(
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "AJAX_MODE" => "Y",
        "IBLOCK_TYPE" => "experts",
        "IBLOCK_ID" => "5",
        "NEWS_COUNT" => "10",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_ORDER1" => "DESC",
        "SORT_BY2" => "SORT",
        "SORT_ORDER2" => "ASC",
        "FIELD_CODE" => Array('SHOW_COUNTER','CREATED_BY','DETAIL_PICTURE'),
        "PROPERTY_CODE" => Array('vote_count','VIDEO','VIDEO_LINK','MORE_PHOTO'),
        "CHECK_DATES" => "Y",
        "DETAIL_URL" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "ACTIVE_DATE_FORMAT" => "x",
        "SET_TITLE" => "N",
        "SET_BROWSER_TITLE" => "N",
        "SET_META_KEYWORDS" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_LAST_MODIFIED" => "N",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "PARENT_SECTION" => empty($_REQUEST['EXP_SLIDER_SECTION'])?"":$_REQUEST['EXP_SLIDER_SECTION'],
        "PARENT_SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "N",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_ADDITIONAL" => ""
    )
);?>


<div class="c-wrapper m_b5">
    <?$APPLICATION->IncludeComponent(
	"sator:news.line", 
	"webinar_on_main", 
	array(
		"COMPONENT_TEMPLATE" => "webinar_on_main",
		"IBLOCKS" => array(
			0 => "2",
			1 => "8",
			2 => "12",
		),
		"NEWS_COUNT" => "20",
		"FIELD_CODE" => array(
			0 => "",
			1 => "PROPERTY_START_DATA",
			2 => "",
		),
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.M.y g:i A"
	),
	false
);?>
</div>

<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list","b-tabs",
    Array(
        "IBLOCK_TYPE" => "content",
        "IBLOCK_ID" => 1,
        "SECTION_ID" => '',
        "SECTION_CODE" => "",
        "SECTION_URL" => "",
        "COUNT_ELEMENTS" => "Y",
        "TOP_DEPTH" => "1",
        "SECTION_FIELDS" => "",
        "SECTION_USER_FIELDS" => '',
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "3600000",
        "CACHE_NOTES" => "N",
        "CACHE_GROUPS" => "N"
    )
);?>
	<?/*
    <div class="c-wrapper">
		<div class="b-promo"><a href="http://valve-expert.ru/" target="_blank" class="b-promo__link"><img src="<?=SITE_TEMPLATE_PATH?>/upload/banner_TPA_1010_120.gif" alt="" class="b-promo__image"></a></div>
    </div>*/?>
    <div class="c-wrapper">
        <div class="row t-1 m_b10">
            <div class="cell s-4">
                <div class="b-group">
                    <h2 class="b-group__title">виртуальные презентации</h2>
                    <div class="b-group__holder">
                    <?$arCompanyFilter["!PROPERTY_TOP"]=false;?>
                    <?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"slider_on_main",
						array(
							"COMPONENT_TEMPLATE" => "slider_on_main",
							"IBLOCK_TYPE" => "content",
							"IBLOCK_ID" => "3",
							"NEWS_COUNT" => "4",
							"SORT_BY1" => "ACTIVE_FROM",
							"SORT_ORDER1" => "DESC",
							"SORT_BY2" => "SORT",
							"SORT_ORDER2" => "ASC",
							"FILTER_NAME" => "arCompanyFilter",
							"FIELD_CODE" => array(
								0 => "SHOW_COUNTER",
								1 => "",
							),
							"PROPERTY_CODE" => array(
								0 => "",
								1 => "",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"AJAX_OPTION_ADDITIONAL" => "",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
							"CACHE_FILTER" => "N",
							"CACHE_GROUPS" => "Y",
							"PREVIEW_TRUNCATE_LEN" => "",
							"ACTIVE_DATE_FORMAT" => "d.m.Y",
							"SET_TITLE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_META_KEYWORDS" => "N",
							"SET_META_DESCRIPTION" => "N",
							"SET_LAST_MODIFIED" => "N",
							"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
							"ADD_SECTIONS_CHAIN" => "N",
							"HIDE_LINK_WHEN_NO_DETAIL" => "N",
							"PARENT_SECTION" => "",
							"PARENT_SECTION_CODE" => "",
							"INCLUDE_SUBSECTIONS" => "N",
							"DISPLAY_DATE" => "Y",
							"DISPLAY_NAME" => "Y",
							"DISPLAY_PICTURE" => "Y",
							"DISPLAY_PREVIEW_TEXT" => "Y",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "N",
							"PAGER_TITLE" => "Новости",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"PAGER_BASE_LINK_ENABLE" => "N",
							"SET_STATUS_404" => "N",
							"SHOW_404" => "N",
							"MESSAGE_404" => ""
						),
						false
					);?>
                 </div>       
                </div>
            </div>
            <div class="cell s-4">
                <div class="b-group">
                    <h2 class="b-group__title">выставки</h2>
                    <div class="b-group__holder">
                    <?$arExhibFilter["PROPERTY_TOP_VALUE"]="да"?>
                    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider_on_main", 
	array(
		"COMPONENT_TEMPLATE" => "slider_on_main",
		"IBLOCK_TYPE" => "exhibitions",
		"IBLOCK_ID" => "8",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arExhibFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "LIKE_QUANTITY",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
					</div>
                </div>
            </div>
            <div class="cell s-4">
                <div class="b-group">
                    <h2 class="b-group__title">Вебинары</h2>
                    <div class="b-group__holder">
                    <?$arWebinarFilter["PROPERTY_TOP_VALUE"]="да"?>
                    <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"slider_on_main", 
	array(
		"COMPONENT_TEMPLATE" => "slider_on_main",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "arWebinarFilter",
		"FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "BLOG_COMMENTS_CNT",
			1 => "FORUM_MESSAGE_CNT",
			2 => "vote_count",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="c-separator"></div>

    <div class="c-wrapper">
        <div class="row t-1">
            <div class="cell s-4">
                <div class="b-group">
                    <h2 class="b-group__title">новые компании</h2>
                    <div class="b-group__holder">
                        <div class="b-company-group">
                        <?$APPLICATION->IncludeComponent("bitrix:news.line", "main_last_company", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "content",	// Тип информационного блока
		"IBLOCKS" => array(	// Код информационного блока
			0 => "3",
		),
		"NEWS_COUNT" => "10",	// Количество новостей на странице
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"DETAIL_URL" => "",	// URL, ведущий на страницу с содержимым элемента раздела
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "300",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	),
	false
);?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell s-4">
                <div class="b-group">
                    <h2 class="b-group__title b-group__title_with-border">темы в форуме</h2>
                    <div class="b-group__holder">
                        <div class="c-list t-5">
                        <?$APPLICATION->IncludeComponent(
	"bitrix:forum.topic.last", 
	"forum_main", 
	array(
		"CACHE_TAG" => "Y",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "forum_main",
		"DATE_TIME_FORMAT" => "j M",
		"FID" => array(
			0 => "1",
		),
		"SEPARATE" => "в форуме #FORUM#",
		"SET_NAVIGATION" => "N",
		"SET_TITLE" => "N",
		"SHOW_COLUMNS" => array(
			0 => "VIEWS",
		),
		"SHOW_FORUM_ANOTHER_SITE" => "N",
		"SHOW_SORTING" => "N",
		"SHOW_TOPIC_POST_MESSAGE" => "NONE",
		"SORT_BY" => "LAST_POST_DATE",
		"SORT_BY_SORT_FIRST" => "N",
		"SORT_ORDER" => "DESC",
		"TOPICS_PER_PAGE" => "10",
		"URL_TEMPLATES_INDEX" => "/forum/index.php",
		"URL_TEMPLATES_LIST" => "/forum/list.php?FID=#FID#",
		"URL_TEMPLATES_MESSAGE" => "/forum/?PAGE_NAME=read&FID=#FID#&TID=#TID#&MID=#MID#",
		"URL_TEMPLATES_PROFILE_VIEW" => "/forum/profile_view.php?UID=#UID#",
		"URL_TEMPLATES_READ" => "/forum/read.php?FID=#FID#&TID=#TID#"
	),
	false
);?>
                            </div>
                        <div class="b-group__sep m_t20 m_b15"></div><a href="/forum/" class="button">все темы</a>
                    </div>
                </div>
            </div>
            <div class="cell s-4">
                <div class="b-group">
                <?$APPLICATION->IncludeComponent("bitrix:voting.current", "voting_main", Array(
	"COMPONENT_TEMPLATE" => ".default",
		"CHANNEL_SID" => "MAIN_AE",	// Группа опросов
		"VOTE_ID" => "",	// ID опроса
		"VOTE_ALL_RESULTS" => "N",	// Показывать варианты ответов для полей типа Text и Textarea
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" => "undefined",	// Дополнительный идентификатор
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	),
	false
);?>
                </div>
            </div>
        </div>
    </div>

    <div class="c-separator"></div>
	<? $GLOBALS['arMainPageBrendFilter'] =array('PROPERTY_MODERATION_STATUS'=>'published'); ?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:news.list", 
		"main_page_brend_list", 
		array(
			"ACTIVE_DATE_FORMAT" => "d.m.Y",
			"ADD_SECTIONS_CHAIN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_ADDITIONAL" => "",
			"AJAX_OPTION_HISTORY" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"BREND_PAGE_URL" => "/brands/",
			"CACHE_FILTER" => "N",
			"CACHE_GROUPS" => "Y",
			"CACHE_TIME" => "36000000",
			"CACHE_TYPE" => "A",
			"CHECK_DATES" => "Y",
			"COMPONENT_TEMPLATE" => "main_page_brend_list",
			"DETAIL_URL" => "",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"DISPLAY_DATE" => "Y",
			"DISPLAY_NAME" => "Y",
			"DISPLAY_PICTURE" => "Y",
			"DISPLAY_PREVIEW_TEXT" => "Y",
			"DISPLAY_TOP_PAGER" => "N",
			"FIELD_CODE" => array(
				0 => "",
				1 => "",
			),
			"FILTER_NAME" => "arMainPageBrendFilter",
			"HIDE_LINK_WHEN_NO_DETAIL" => "N",
			"IBLOCK_ID" => "4",
			"IBLOCK_TYPE" => "content",
			"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
			"INCLUDE_SUBSECTIONS" => "Y",
			"MESSAGE_404" => "",
			"NEWS_COUNT" => "200",
			"PAGER_BASE_LINK_ENABLE" => "N",
			"PAGER_DESC_NUMBERING" => "N",
			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
			"PAGER_SHOW_ALL" => "N",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => ".default",
			"PAGER_TITLE" => "Новости",
			"PARENT_SECTION" => "",
			"PARENT_SECTION_CODE" => "",
			"PREVIEW_TRUNCATE_LEN" => "",
			"PROPERTY_CODE" => array(
				0 => "SITE",
				1 => "",
			),
			"SET_BROWSER_TITLE" => "N",
			"SET_LAST_MODIFIED" => "N",
			"SET_META_DESCRIPTION" => "N",
			"SET_META_KEYWORDS" => "N",
			"SET_STATUS_404" => "N",
			"SET_TITLE" => "N",
			"SHOW_404" => "N",
			"SORT_BY1" => "SORT",
			"SORT_BY2" => "SORT",
			"SORT_ORDER1" => "DESC",
			"SORT_ORDER2" => "ASC"
		),
		false
	);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>