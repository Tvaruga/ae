<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$abc = array();
foreach(range('A', 'Z') as $letter){
	$arLetter['LETTER'] = iconv('CP1251', 'UTF-8', $letter);
	$arLetter['VALUE'] = iconv('CP1251', 'UTF-8', $letter);
	if ($_GET['SORT_LETTER']==iconv('CP1251', 'UTF-8', $letter))
		$arLetter['ACTIVE'] = 'active';
	$abc[] = $arLetter;
}

$arLetterRus=array();
$arLetterNum=array();
$arLetterRus['LETTER'] = 'А-Я';
$arLetterRus['VALUE'] = 'RUS';
if ($_GET['SORT_LETTER']=='RUS')
		$arLetterRus['ACTIVE'] = 'active'; 
		
$abc[]=$arLetterRus;

$arLetterNum=array();
$arLetterNum['LETTER'] = iconv('CP1251', 'UTF-8', '123');
$arLetterNum['VALUE'] = 'NUM';
if ($_GET['SORT_LETTER']=='NUM')
	$arLetterNum['ACTIVE'] = 'active';
$abc[]=$arLetterNum;


$arResult['LETTERS'] = $abc;

$arNew=sorting($arResult['ITEMS'], true, true);

if (is_array($arNew) && !empty($arNew)){
	if ($_GET['SORT_LETTER']!='')
		foreach($arNew as $key=>$arLetterItems)
			if ($_GET['SORT_LETTER']!=$key)
				unset($arNew[$key]);
	
	$arResult['ITEMS']=$arNew;
}
$arIds = array();

foreach ($arResult['ITEMS'] as $arLetter)
	if (!empty($arLetter))
		foreach ($arLetter as $arItem)
			$arIds[]=$arItem['ID'];
			
if (!empty($arIds))
{
	$arFilter=array();
	$arFilter=array(
		'IBLOCK_ID'=>4,
		'ACTIVE'=>'Y',
		'PROPERTY_BRAND_VALUE'=>$arIds
	);
	$arSelect=array();
	$arSelect = array('ID', 'IBLOCK_SECTION_ID', 'PROPERTY_BRAND.ID');
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	$arSectionIDs=array();
	$arBrends = array();
	while($arElement = $res->GetNext())
	{
		if ($arElement['PROPERTY_BRAND_ID']>0 && $arElement['IBLOCK_SECTION_ID']>0 && $arBrends[$arElement['PROPERTY_BRAND_ID']][$arElement['IBLOCK_SECTION_ID']]=='')
		{
			$arBrends[$arElement['PROPERTY_BRAND_ID']][$arElement['IBLOCK_SECTION_ID']] = $arElement['IBLOCK_SECTION_ID'];
			$arSectionIDs[$arElement['IBLOCK_SECTION_ID']]=$arElement['IBLOCK_SECTION_ID'];
		}			
	}	
	

	
	if (!empty($arSectionIDs))
	{
		$arFilter=array();
		$arFilter=array(
			'IBLOCK_ID'=>4,
			'ACTIVE'=>'Y',
			'ID'=>$arSectionIDs
		);
		$arSelect=array();
		$arSelect = array('ID', 'NAME', 'SECTION_PAGE_URL');
		$arSections= array();
		$db_list = CIBlockSection::GetList(Array('id'=>'asc'), $arFilter, false, $arSelect);
		while($arSection = $db_list->GetNext())
		{
			$arSections[$arSection['ID']]['NAME']=$arSection['NAME'];
			$arSections[$arSection['ID']]['SECTION_PAGE_URL']=$arSection['SECTION_PAGE_URL'];
		}
		
		if (!empty($arSections))
		{
			foreach($arBrends as $keyBrend=>$arBrend)
				foreach($arBrend as $keySection=>$sectionId)
					if (is_array($arSections[$sectionId]) && !empty($arSections[$sectionId]))
						$arBrends[$keyBrend][$keySection] = $arSections[$sectionId];

			foreach ($arResult['ITEMS'] as $keyLetter=>$arLetter)
				if (!empty($arLetter))
					foreach ($arLetter as $keyItem=>$arItem)
						if (!empty($arBrends[$arItem['ID']]))
							$arResult['ITEMS'][$keyLetter][$keyItem]['SECTIONS']=$arBrends[$arItem['ID']];
		}
	}
	
}