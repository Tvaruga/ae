<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="c-separator-line m_t20 m_b20"></div>
<div class="clearfix">
	<div class="f_right">
		<?$APPLICATION->IncludeComponent("imedia:iblock.vote","im_like",Array(
				"IBLOCK_TYPE" => $arResult['IBLOCK']['IBLOCK_TYPE_ID'],
				"IBLOCK_ID" => $arResult['IBLOCK_ID'],
				"ELEMENT_ID" => $arResult['ID'],
				"ELEMENT_CODE" => '',
				"MAX_VOTE" => "1",
				"VOTE_NAMES" => array("1"),
				"SET_STATUS_404" => "N",
				"MESSAGE_404" => "",
				"CACHE_TYPE" => $arParams['CACHE_TYPE'],
				"CACHE_TIME" => $arParams['CACHE_TIME']
			)
		);?>
		<?/*<a href="#" class="button f_right m_b10">обсудить на форуме</a>*/?>
	</div>
</div>
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
</div>