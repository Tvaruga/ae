<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arLeftColumn=array();
$arRightColumn=array();
/**
* 
* @var TODO:
* Каунтер комментариве не сопрягается с блогом
* 
*/
/*if (!empty($arResult['ELEMENTS']) && CModule::IncludeModule("blog"))
{
		$arOrder = Array(
	        "ID" => "ASC"
	    );
		$arFilter = Array(
	        "BLOG_ID "=>$arResult['ELEMENTS']
	    );
	    
	    $dbComment = CBlogComment::GetList($arOrder, $arFilter);
	    
		while ($arComment = $dbComment->Fetch())
		{
		   kpr($arComment);
		}
}*/
	

if (!empty($arResult['ITEMS'])){
	foreach($arResult['ITEMS'] as $key=>$arItem){
		if ($arItem['PROPERTIES']['START_DATA']['VALUE']!=''){
			
			$arDataInfo = explode(' ', $arItem['PROPERTIES']['START_DATA']['VALUE']);
			if ($arDataInfo[0]!=''){
				$arData = explode('.', $arDataInfo[0]);
				unset($arData[2]);
				$arItem['DATA_PRINT']= implode('.', $arData);
			}
			
			if ($arDataInfo[1]!=''){
				$arTime = explode(':', $arDataInfo[1]);
				
				$arItem['TIME']= $arTime[0].':'.$arTime[1];
			}
				
				
				$startSTAMP = MakeTimeStamp($arItem['PROPERTIES']['START_DATA']['VALUE'], "DD.MM.YYYY HH:MI:SS");
				$now = time();
				
				if ($startSTAMP>=$now)
					$arItem['ACTIVE_REG']='Y';
				else
					$arItem['ACTIVE_REG']='N';
		}
		
		if ($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']>0)
			$arItem['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE']=number_format($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE'], 0, '.', ' ');
		
		if ($arItem['DETAIL_PICTURE']['ID']>0){
			$file = CFile::ResizeImageGet($arItem['DETAIL_PICTURE']['ID'], array('width'=>316, 'height'=>197), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$arItem['PRINT_PICTURE']=$file;
		}
		
		if ($arItem['SHOW_COUNTER']=='')
			$arItem['SHOW_COUNTER']='0';
			
		
		
			
		if ($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']=='')
			$arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']='0';
		
		if ($arItem['PROPERTIES']['LIKE_QUANTITY']['VALUE']=='')
			$arItem['PROPERTIES']['LIKE_QUANTITY']['VALUE']='0';
			
		if ($arItem['PROPERTIES']['SPEAKER']['VALUE']!=''){
			$rsUser = CUser::GetByID($arItem['PROPERTIES']['SPEAKER']['VALUE']);
			if ($arUser = $rsUser->Fetch()){
				$arItem['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['NAME'] = $arUser['NAME'].' '.$arUser['LAST_NAME'];
				$arItem['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['WORK_POSITION'] = $arUser['WORK_POSITION'];
			}			
		}
			$arItem['PROPERTIES']['LIKE_QUANTITY']['VALUE']='0';		
		
		if ($key%2>0)
			$arLeftColumn['ITEMS'][]=$arItem;
		else
			$arRightColumn['ITEMS'][]=$arItem;
	}	
}
	
			
if (!empty($arLeftColumn))
	$arResult['COLUMNS']['LEFT']=$arLeftColumn;
	
if (!empty($arRightColumn))
	$arResult['COLUMNS']['RIGHT']=$arRightColumn;
	
?>