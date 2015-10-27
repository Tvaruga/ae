<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CIntranetToolbar $INTRANET_TOOLBAR */
global $INTRANET_TOOLBAR;

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 36000000;

$arParams["SORT_BY"] = trim($arParams["SORT_BY"]);
if(strlen($arParams["SORT_BY"])<=0)
	$arParams["SORT_BY"] = "ACTIVE_FROM";
if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER"]))
	$arParams["SORT_ORDER"]="DESC";

if(strlen($arParams["FILTER_NAME"])<=0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["FILTER_NAME"]))
{
	$arrFilter = array();
}
else
{
	$arrFilter = $GLOBALS[$arParams["FILTER_NAME"]];
	if(!is_array($arrFilter))
		$arrFilter = array();
}

$arParams["USERS_COUNT"] = intval($arParams["USERS_COUNT"]);
if($arParams["USERS_COUNT"]<=0)
	$arParams["USERS_COUNT"] = 20;

$arParams["CACHE_FILTER"] = $arParams["CACHE_FILTER"]=="Y";
if(!$arParams["CACHE_FILTER"] && count($arrFilter)>0)
	$arParams["CACHE_TIME"] = 0;

$arParams["DISPLAY_TOP_PAGER"] = $arParams["DISPLAY_TOP_PAGER"]=="Y";
$arParams["DISPLAY_BOTTOM_PAGER"] = $arParams["DISPLAY_BOTTOM_PAGER"]!="N";
$arParams["PAGER_TITLE"] = trim($arParams["PAGER_TITLE"]);
$arParams["PAGER_SHOW_ALWAYS"] = $arParams["PAGER_SHOW_ALWAYS"]!="N";
$arParams["PAGER_TEMPLATE"] = trim($arParams["PAGER_TEMPLATE"]);
$arParams["PAGER_DESC_NUMBERING"] = $arParams["PAGER_DESC_NUMBERING"]=="Y";
$arParams["PAGER_DESC_NUMBERING_CACHE_TIME"] = intval($arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]);
$arParams["PAGER_SHOW_ALL"] = $arParams["PAGER_SHOW_ALL"]!=="N";

if($arParams["DISPLAY_TOP_PAGER"] || $arParams["DISPLAY_BOTTOM_PAGER"])
{
	$arNavParams = array(
		"nPageSize" => $arParams["USERS_COUNT"],
		"bDescPageNumbering" => $arParams["PAGER_DESC_NUMBERING"],
		"bShowAll" => $arParams["PAGER_SHOW_ALL"],
	);
	$arNavigation = CDBResult::GetNavParams($arNavParams);
	if($arNavigation["PAGEN"]==0 && $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"]>0)
		$arParams["CACHE_TIME"] = $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"];
}
else
{
    if($arParams["SORT_BY"]!=='RAND')
	    $arNavParams = array("nTopCount" => $arParams["USERS_COUNT"]);
    else
        $arNavParams = array();
	$arNavigation = false;
}

if($this->StartResultCache(false, array($arNavigation, $arrFilter)))
{
    $arFilter = array ("ACTIVE" => "Y");
	$arResult["USERS"] = array();
    $db = CUser::GetList($i=$arParams["SORT_BY"], $arParams["SORT_ORDER"], array_merge($arFilter, $arrFilter), array('SELECT'=>array('UF_*')));

    if($arParams["DISPLAY_TOP_PAGER"] || $arParams["DISPLAY_BOTTOM_PAGER"]){
        $db->NavStart($arParams["USERS_COUNT"]);
        $arResult['NAV_STRING'] = $db->GetNavPrint($arParams["PAGER_TITLE"], $arParams["PAGER_SHOW_ALWAYS"], '', empty($arParams['PAGER_TEMPLATE'])?false:$arParams['PAGER_TEMPLATE']);
    }

    while($row = $db->GetNext())
        $arResult["USERS"][]=$row;

    if($arParams["SORT_BY"]=='RAND'){
        shuffle($arResult["USERS"]);
        if(count($arResult["USERS"])>$arParams["USERS_COUNT"] && !$arParams["DISPLAY_TOP_PAGER"] && !$arParams["DISPLAY_BOTTOM_PAGER"])
            $arResult["USERS"] = array_slice($arResult["USERS"],0,$arParams["USERS_COUNT"]);
    }
	$this->IncludeComponentTemplate();
}