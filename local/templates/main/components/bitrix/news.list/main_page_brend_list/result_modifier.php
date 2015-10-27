<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


$abc = array();
$arLetter=array();
foreach(range('A', 'Z') as $letter){
	$arLetter['LETTER'] = iconv('CP1251', 'UTF-8', $letter);
	$arLetter['VALUE'] = iconv('CP1251', 'UTF-8', $letter);
	if ($_GET['SORT_LETTER']==iconv('CP1251', 'UTF-8', $letter))
		$arLetter['ACTIVE'] = 'active';
	$abc['EN'][] = $arLetter;
}

$arLetterRus=array();

foreach(range(chr(0xC0), chr(0xDF)) as $letter){
	$arLetter['LETTER'] = iconv('CP1251', 'UTF-8', $letter);
	$arLetter['VALUE'] = iconv('CP1251', 'UTF-8', $letter);
	if ($_GET['SORT_LETTER']==iconv('CP1251', 'UTF-8', $letter))
		$arLetter['ACTIVE'] = 'active';
	$abc['RUS'][] = $arLetter;
}

		
//$abc['RUS']=$arLetterRus;

/*$arLetterNum=array();
$arLetterNum['LETTER'] = iconv('CP1251', 'UTF-8', '123');
$arLetterNum['VALUE'] = 'NUM';
if ($_GET['SORT_LETTER']=='NUM')
	$arLetterNum['ACTIVE'] = 'active';
$abc['NUM']=$arLetterNum;*/


$arResult['LETTERS'] = $abc;

$arNew=sorting($arResult['ITEMS'], true, false);

if (is_array($arNew) && !empty($arNew)){
	
	if ($_GET['SORT_LETTER']!='')
		foreach($arNew as $key=>$arLetterItems)
			if ($_GET['SORT_LETTER']!=$key)
				unset($arNew[$key]);
	
foreach($arResult['LETTERS'] as $langKey=>$arLang)
 	foreach($arLang as $keyLetter=>$arLetter)
		if (empty($arNew[$arLetter['VALUE']]))
		$arResult['LETTERS'][$langKey][$keyLetter]['EMPTY']='Y';
	
	
//$arResult['ITEMS']=$arNew;
	
}

for($i=0; $i<=5; $i++){
	if ($arResult['ITEMS'][$i]['PREVIEW_PICTURE']['ID']>0)
		$arResult['ITEMS'][$i]['PICTURE'] = CFile::ResizeImageGet($arResult['ITEMS'][$i]['PREVIEW_PICTURE']['ID'], array('width'=>118, 'height'=>65), BX_RESIZE_IMAGE_PROPORTIONAL, true);       	
}
	
/*foreach (range(chr(0xC0), chr(0xDF)) as $b)
	$abc[] = iconv('CP1251', 'UTF-8', $b);*/
  
  
