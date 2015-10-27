<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вебинары");
?>
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
?>	


		
<?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"webinars", 
	array(
		"COMPONENT_TEMPLATE" => "webinars",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "2",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "TAGS_FILTER",
		"SORT_BY1" => "PROPERTY_START_DATA",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "N",
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
		"SET_LAST_MODIFIED" => "Y",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"USE_PERMISSIONS" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"PREVIEW_TRUNCATE_LEN" => "400",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.y G:i",
		"LIST_FIELD_CODE" => array(
			0 => "DETAIL_PICTURE",
			1 => "SHOW_COUNTER",
			2 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "SPEAKER",
			1 => "TAGS",
			2 => "PRICE",
			3 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.M.Y g:i A",
		"DETAIL_FIELD_CODE" => array(
			0 => "SHOW_COUNTER",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "SPEAKER",
			1 => "TAGS",
			2 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
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
		"SEF_FOLDER" => "/webinars/",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
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