<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курсы обучения");?>

<?if(!empty($_REQUEST['tags']))
	$GLOBALS['TAGS_FILTER']['PROPERTY_TAGS']=explode(',',$_REQUEST['tags']); ?>
	
<?if(!empty($_REQUEST['CURSE']))
	$GLOBALS['TAGS_FILTER']['PROPERTY_THEMES'] =$_REQUEST['CURSE']; ?>	
	
<?if(!empty($_REQUEST['COUNTRY']))
	$GLOBALS['TAGS_FILTER']['PROPERTY_CONTRY'] = $_REQUEST['COUNTRY']; ?>
	
<?if(!empty($_REQUEST['CITIES']))
	$GLOBALS['TAGS_FILTER']['PROPERTY_CITY'] = $_REQUEST['CITIES']; ?>
	
<?if(!empty($_REQUEST['NAME']))
	$GLOBALS['TAGS_FILTER']['NAME'] = '%'.$_REQUEST['NAME'].'%'; ?>	

<?
$now = date('d.m.Y');
if(empty($_REQUEST['CHECK_DATES']) && $_REQUEST['CHECK_DATES']!='Y')
	$GLOBALS['TAGS_FILTER']['>=PROPERTY_START_DATA'] = ConvertDateTime($now, "YYYY-MM-DD");
	
?><?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"courses2", 
	array(
		"COMPONENT_TEMPLATE" => "courses2",
		"IBLOCK_TYPE" => "courses",
		"IBLOCK_ID" => "12",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "Y",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.y G:i",
		"LIST_FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "SHOW_COUNTER",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "EXTERNAL_SITE_URL",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.y G:i",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "EXTERNAL_SITE_URL",
			1 => "CITY",
			2 => "START_DATA",
			3 => "LIKE_QUANTITY",
			4 => "BLOG_COMMENTS_CNT",
			5 => "CONTACT_PERSON",
			6 => "COURSE_LOCATION",
			7 => "INVITATION_TYPE",
			8 => "INVITATION",
			9 => "VIDEO_LINK",
			10 => "PRICE",
			11 => "COUNTRY",
			12 => "REPORT",
			13 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => "b-pagination",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SEF_FOLDER" => "/courses/",
		"FILTER_NAME" => "TAGS_FILTER",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "EXTERNAL_SITE_URL",
			1 => "VIDEO",
			2 => "CITY",
			3 => "START_DATA",
			4 => "LIKE_QUANTITY",
			5 => "vote_count",
			6 => "CONTACT_PERSON",
			7 => "COURSE_LOCATION",
			8 => "INVITATION_TYPE",
			9 => "INVITATION",
			10 => "VIDEO_LINK",
			11 => "PRICE",
			12 => "REPORT",
			13 => "",
		),
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "#SECTION_CODE#/",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>