<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult['PROPERTIES']['START_DATA']['VALUE']){
	$arDataInfo = explode(' ', $arResult['PROPERTIES']['START_DATA']['VALUE']);
	
	if ($arDataInfo[0]!=''){
		$startDataSTAMP = MakeTimeStamp($arDataInfo[0], "DD.MM.YYYY");
		$arResult['DATA_PRINT']= FormatDate("d M Y", $startDataSTAMP);
	}
	
	if ($arDataInfo[1]!=''){
		$arTime = explode(':', $arDataInfo[1]);
		$arResult['TIME']= $arTime[0].':'.$arTime[1];
	}
	
	$startSTAMP = MakeTimeStamp($arResult['PROPERTIES']['START_DATA']['VALUE'], "DD.MM.YYYY HH:MI:SS");
	$now = time();
	
	if ($startSTAMP>=$now)
		$arResult['ACTIVE_REG']='Y';
	else
		$arResult['ACTIVE_REG']='N';			
}

if ($arResult['SHOW_COUNTER']=='')
	$arResult['SHOW_COUNTER']='0';
	
if ($arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']=='')
	$arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']='0';

if ($arResult['PROPERTIES']['LIKE_QUANTITY']['VALUE']=='')
	$arResult['PROPERTIES']['LIKE_QUANTITY']['VALUE']='0';
	
if ($arResult['DETAIL_PICTURE']['ID']>0){
	$file = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>657, 'height'=>316), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	$arResult['PRINT_PICTURE']=$file;
}	

if ($arResult['PROPERTIES']['SPEAKER']['VALUE']!=''){
	$rsUser = CUser::GetByID($arResult['PROPERTIES']['SPEAKER']['VALUE']);
	if ($arUser = $rsUser->Fetch()){
		$arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['NAME'] = $arUser['NAME'].' '.$arUser['LAST_NAME'];
		$arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['WORK_POSITION'] = $arUser['WORK_POSITION'];
	}			
}