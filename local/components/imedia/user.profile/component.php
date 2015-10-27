<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if(!isset($arParams['CACHE_TIME']))
	$arParams['CACHE_TIME'] = 36000000;

$arParams['ID'] = intval($arParams['~ID']);
if(empty($arParams['ID']))
{
	\Bitrix\Iblock\Component\Tools::process404(
		trim($arParams["MESSAGE_404"]) ?: GetMessage("T_USER_NOT_FOUND")
		,true
		,$arParams["SET_STATUS_404"] === "Y"
		,$arParams["SHOW_404"] === "Y"
		,$arParams["FILE_404"]
	);

	return 0;
}


$arParams['META_KEYWORDS']=trim($arParams['META_KEYWORDS']);
$arParams['META_DESCRIPTION']=trim($arParams['META_DESCRIPTION']);
$arParams['BROWSER_TITLE']=trim($arParams['BROWSER_TITLE']);

$arParams["USE_PERMISSIONS"] = $arParams["USE_PERMISSIONS"]=="Y";
if(!is_array($arParams["GROUP_PERMISSIONS"]))
	$arParams["GROUP_PERMISSIONS"] = array(1);

$bUSER_HAVE_ACCESS = !$arParams["USE_PERMISSIONS"];
if($arParams["USE_PERMISSIONS"] && isset($USER) && is_object($USER))
{
	$arUserGroupArray = $USER->GetUserGroupArray();
	foreach($arParams["GROUP_PERMISSIONS"] as $PERM)
	{
		if(in_array($PERM, $arUserGroupArray))
		{
			$bUSER_HAVE_ACCESS = true;
			break;
		}
	}
}
if(!$bUSER_HAVE_ACCESS)
{
	ShowError(GetMessage("T_USER_PERM_DEN"));
	return 0;
}


if($this->StartResultCache(false, array(($arParams['CACHE_GROUPS']==='N'? false: $USER->GetGroups()),$bUSER_HAVE_ACCESS)))
{
	if(empty($arParams['USER_PROPERTY']))
		$arResult = CUser::GetByID($arParams['ID'])->Fetch();
	else
		$arResult = CUser::GetList($by='ID',$order='DESC',array('ID'=>$arParams['ID']),array('SELECT'=>$arParams['USER_PROPERTY']))->Fetch();

	if(!empty($arResult['ID'])){
		if (defined('BX_COMP_MANAGED_CACHE')){
			$GLOBALS['CACHE_MANAGER']->StartTagCache($this->__cachePath);
			$GLOBALS['CACHE_MANAGER']->RegisterTag('USER_NAME_' . $arResult['ID']);
		}

		$arResult['FULL_NAME'] = trim(trim($arResult['NAME'].' '.$arResult['SECOND_NAME']).' '.$arResult['LAST_NAME']);
		$arResult['GROUPS'] = CUser::GetUserGroup($arResult['ID']);
		$arCountries = GetCountryArray();
		$arResult['PERSONAL_COUNTRY_STR'] = '';
		if(!empty($arResult['PERSONAL_COUNTRY']) && !empty($arCountries)){
			$key = array_search($arResult['PERSONAL_COUNTRY'], $arCountries['reference_id']);
			if($key!==false)
				$arResult['PERSONAL_COUNTRY_STR'] = $arCountries['reference'][$key];
		}

		$templateVarPattern = '/#([^\s]+)#/';
		if(!empty($arParams['TITLE']) && preg_match_all($templateVarPattern, $arParams['TITLE'], $matches)){
			$arResult['TITLE'] = $arParams['TITLE'];
			foreach(array_unique($matches[1]) as $key)
				$arResult['TITLE'] = str_replace('#'.$key.'#',$arResult[$key],$arResult['TITLE']);
		}
		if(!empty($arParams['BROWSER_TITLE']) && preg_match_all($templateVarPattern, $arParams['BROWSER_TITLE'], $matches)){
			$arResult['BROWSER_TITLE'] = $arParams['BROWSER_TITLE'];
			foreach(array_unique($matches[1]) as $key)
				$arResult['BROWSER_TITLE'] = str_replace('#'.$key.'#',$arResult[$key],$arResult['BROWSER_TITLE']);
		}
		if(!empty($arParams['META_KEYWORDS']) && preg_match_all($templateVarPattern, $arParams['META_KEYWORDS'], $matches)){
			$arResult['META_KEYWORDS'] = $arParams['META_KEYWORDS'];
			foreach(array_unique($matches[1]) as $key)
				$arResult['META_KEYWORDS'] = str_replace('#'.$key.'#',$arResult[$key],$arResult['META_KEYWORDS']);
		}
		if(!empty($arParams['META_DESCRIPTION']) && preg_match_all($templateVarPattern, $arParams['META_DESCRIPTION'], $matches)){
			$arResult['META_DESCRIPTION'] = $arParams['META_DESCRIPTION'];
			foreach(array_unique($matches[1]) as $key)
				$arResult['META_DESCRIPTION'] = str_replace('#'.$key.'#',$arResult[$key],$arResult['META_DESCRIPTION']);
		}

		$this->SetResultCacheKeys(array(
			'ID',
			'FULL_NAME',
			'TITLE',
			'BROWSER_TITLE',
			'META_KEYWORDS',
			'META_DESCRIPTION'
		));

		if(defined('BX_COMP_MANAGED_CACHE'))
			$GLOBALS['CACHE_MANAGER']->EndTagCache();

		$this->IncludeComponentTemplate();
	}else{
		$this->AbortResultCache();
		\Bitrix\Iblock\Component\Tools::process404(
			trim($arParams["MESSAGE_404"]) ?: GetMessage("T_USER_NOT_FOUND")
			,true
			,$arParams["SET_STATUS_404"] === "Y"
			,$arParams["SHOW_404"] === "Y"
			,$arParams["FILE_404"]
		);
	}
}

if(isset($arResult['ID'])){
	if(!empty($arResult['TITLE']))
		$APPLICATION->SetTitle($arResult['TITLE'], null);

	if (!empty($arResult['BROWSER_TITLE']))
		$APPLICATION->SetPageProperty('title', $arResult['BROWSER_TITLE'], null);

	if (!empty($arResult['META_KEYWORDS']))
		$APPLICATION->SetPageProperty('keywords', $arResult['META_KEYWORDS'], null);

	if (!empty($arResult['META_DESCRIPTION']))
		$APPLICATION->SetPageProperty('description', $arResult['META_DESCRIPTION'], null);

	return $arResult['ID'];
}else{
	return 0;
}