<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(CUser::IsAuthorized()){?>
	<div class="clearfix">
		<div class="f_right">
			<?$APPLICATION->IncludeComponent(
				"imedia:iblock.vote",
				"im_like",
				Array(
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"COMPONENT_TEMPLATE" => "flat",
					"DISPLAY_AS_RATING" => "rating",
					"ELEMENT_CODE" => $arResult['CODE'],
					"ELEMENT_ID" => $arResult['ID'],
					"IBLOCK_ID" => $arParams['IBLOCK_ID'],
					"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
					"MAX_VOTE" => "1",
					"MESSAGE_404" => "",
					"SET_STATUS_404" => "N",
					"SHOW_RATING" => "N",
					"VOTE_NAMES" => array("1")
				)
			);?>
	        <a href="#" class="button m_b10 m_l15">обсудить на форуме</a>
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
<?}?>


