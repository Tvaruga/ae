<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

if(CUser::IsAuthorized()):?>
	<div class="clearfix">
		<div class="f_right">
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
		</div>
	</div>
<?endif;?>