<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

	if(CUser::IsAuthorized()):
    ?><div class="clearfix">
		<div class="f_right">
			<?/*$APPLICATION->IncludeComponent("imedia:iblock.vote","im_like",Array(
					"IBLOCK_TYPE" => $arResult['IBLOCK']['IBLOCK_TYPE_ID'],
					"IBLOCK_ID" => $arResult['IBLOCK_ID'],
					"ELEMENT_ID" => $arResult['ID'],
					"ELEMENT_CODE" => '',
					"MAX_VOTE" => "1",
					"VOTE_NAMES" => array("1"),
					"SET_STATUS_404" => "N",
					"MESSAGE_404" => "",
					"CACHE_TYPE" => 'N',
					"CACHE_TIME" => '',
				)
			);*/?>
			<?$APPLICATION->IncludeComponent(
				"imedia:iblock.vote",
				"im_like",
				Array(
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"COMPONENT_TEMPLATE" => "im_like",
					"DISPLAY_AS_RATING" => "rating",
					"ELEMENT_CODE" => $arResult['CODE'],
					"ELEMENT_ID" => $arResult['ID'],
					"IBLOCK_ID" => $arResult['IBLOCK_ID'],
					"IBLOCK_TYPE" => $arResult['IBLOCK']['IBLOCK_TYPE_ID'],
					"MAX_VOTE" => "1",
					"MESSAGE_404" => "",
					"SET_STATUS_404" => "N",
					"SHOW_RATING" => "N",
					"VOTE_NAMES" => array("1")
				)
			);?>
			
			<?/*<a href="#" class="button m_t20">Обсудить на форуме</a>*/?>
		</div>
	</div>
	<?endif;?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.comments",
		"b-comments",
		array(
			"ELEMENT_ID" => $arResult['ID'],
			"ELEMENT_CODE" => "",
			"IBLOCK_ID" => $arParams['IBLOCK_ID'],
			"SHOW_DEACTIVATED" => '',
			"URL_TO_COMMENT" => '',
			"WIDTH" => "",
			"COMMENTS_COUNT" => "2",
			"BLOG_USE" => 'Y',
			"FB_USE" => 'N',
			"FB_APP_ID" => 'N',
			"VK_USE" => 'N',
			"CACHE_TYPE" => $arParams['CACHE_TYPE'],
			"CACHE_TIME" => $arParams['CACHE_TIME'],
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
			"BLOG_TITLE" => "",
			"BLOG_URL" => 'news_comments',
			"PATH_TO_SMILE" => "",
			"EMAIL_NOTIFY" => '',
			"AJAX_POST" => "Y",
			"SHOW_SPAM" => "Y",
			"SHOW_RATING" => "N"
		),false,array("HIDE_ICONS" => "Y")
	);?>
</div>
<?if(!empty($templateData['simId'])):
	$GLOBALS['SIM_FILTER'] = array('ID'=>$templateData['simId']);?>
	<div class="b-group m_t30 m_b40">
		<h2 class="b-group__title b-group__title_with-border"><?=Loc::getMessage('SIM_NEWS_LABEL')?></h2>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list",
			"sim-news",
			Array(
				"FILTER_NAME"=>'SIM_FILTER',
				"DISPLAY_DATE" => $arParams['DISPLAY_DATE'],
				"DISPLAY_NAME" => $arParams['DISPLAY_NAME'],
				"DISPLAY_PICTURE" => $arParams['DISPLAY_PICTURE'],
				"DISPLAY_PREVIEW_TEXT" => $arParams['DISPLAY_PREVIEW_TEXT'],
				"AJAX_MODE" => $arParams['AJAX_MODE'],
				"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"NEWS_COUNT" => $templateData['simCount'],
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "ID",
				"SORT_ORDER2" => "DESC",
				"FIELD_CODE" => $arParams['FIELD_CODE'],
				"PROPERTY_CODE" => $arParams['PROPERTY_CODE'],
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
				"CACHE_TYPE" => $arParams['CACHE_TYPE'],
				"CACHE_TIME" => $arParams['CACHE_TIME'],
				"CACHE_FILTER" => 'Y',
				"CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"SET_STATUS_404" => "N",
				"SHOW_404" => "N",
			),false,array('HIDE_ICONS' => 'Y')
		);?>
	</div><?
endif;