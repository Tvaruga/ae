<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['FULL_NAME']))
    $GLOBALS['APPLICATION']->AddChainItem($arResult['FULL_NAME'], '');
