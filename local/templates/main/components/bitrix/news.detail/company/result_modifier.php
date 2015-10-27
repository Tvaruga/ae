<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!empty($arResult['DISPLAY_PROPERTIES']['LOCATION']['VALUE']) && \Bitrix\Main\Loader::includeModule('sale'))

    $arResult['DISPLAY_PROPERTIES']['LOCATION']['DISPLAY_VALUE'] = CSaleLocation::GetByID($arResult['DISPLAY_PROPERTIES']['LOCATION']['VALUE']);
    
if ($arResult['PROPERTIES']['vote_count']['VALUE']=='')
	$arResult['PROPERTIES']['vote_count']['VALUE']=0;