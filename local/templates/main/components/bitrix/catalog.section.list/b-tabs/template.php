<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


$strSectionEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));


if (0 < $arResult['SECTIONS_COUNT'])
{
	?><div class="b-tabs-menu"><ul class="b-tabs-menu__holder"><li class="b-tabs-menu__item active"><a href="#tab-0" class="b-tabs-menu__link js-tab"><?=GetMessage('NOW_LABEL')?></a></li><?
	foreach ($arResult['SECTIONS'] as $key=>$arSection)
	{
		if($arParams['COUNT_ELEMENTS'] && empty($arSection['ELEMENT_CNT']))
			continue;
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		?><li class="b-tabs-menu__item"><a href="#tab-<?=$key+1?>" class="b-tabs-menu__link js-tab" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>"><?= $arSection['NAME']; ?></a></li><?
	}
	?></ul></div><?
	?><div class="c-wrapper"><?
		?><div id="tab-0" class="tab-holder row t-1"><?include('now_template.php')?></div><?
		foreach ($arResult['SECTIONS'] as $key=>$arSection)
		{
			if($arParams['COUNT_ELEMENTS'] && empty($arSection['ELEMENT_CNT']))
				continue;

			?><div id="tab-<?=$key+1?>" class="tab-holder row t-1">
				<?$APPLICATION->IncludeComponent("bitrix:news.list","cell_s-4",Array(
						"DISPLAY_DATE" => "Y",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"AJAX_MODE" => 'N',
						"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
						"IBLOCK_ID" => $arParams['IBLOCK_ID'],
						"NEWS_COUNT" => "12",
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
						"PARENT_SECTION" => $arSection['ID'],
						"PARENT_SECTION_CODE" => "",
						"INCLUDE_SUBSECTIONS" => "Y",
						"CACHE_TYPE" => "N",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"SET_STATUS_404" => "N",
						"SHOW_404" => "N",
					),false,array('HIDE_ICONS' => 'Y')
				);?>
			</div><?
		}
	/*?></div>
	<div class="c-wrapper">
		<div class="b-promo"><a href="http://valve-expert.ru/" target="_blank" class="b-promo__link"><img src="<?=SITE_TEMPLATE_PATH?>/upload/banner_TPA_1010_120.gif" alt="" class="b-promo__image"></a></div>
	</div><?*/
	if(!empty($arResult['IBLOCK'])):
		?><div class="b-more-line"><a href="<?=$arResult['IBLOCK']['LIST_PAGE_URL']?>" class="b-more-line__button"><i class="ico i_more-gray"></i><?=GetMessage('SHOW_MORE_NEWS_LABEL')?></a></div><?
	endif;
}