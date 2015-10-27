<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$aMenuLinksExt = array();

$aMenuLinksExt = $APPLICATION->IncludeComponent("bitrix:menu.sections", "", array(
    "IS_SEF" => "Y",
    "SEF_BASE_URL" => "",
    "SECTION_PAGE_URL" => '',
    "DETAIL_PAGE_URL" => '',
    "IBLOCK_TYPE" => 'content',
    "IBLOCK_ID" => 1,
    "DEPTH_LEVEL" => "1",
    "CACHE_TYPE" => "N",
), false, Array('HIDE_ICONS' => 'Y'));

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);