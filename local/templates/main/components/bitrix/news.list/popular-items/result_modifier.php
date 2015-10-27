<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['ITEMS']) && \Bitrix\Main\Loader::includeModule('iblock')){
    $arUsers = array();
    foreach($arResult['ITEMS'] as $key=>$arItem){
        $sId = false;
        if(!empty($arItem['PROPERTIES']['AUTHORSHIP']['VALUE']))
            $sId = $arItem['PROPERTIES']['AUTHORSHIP']['VALUE'];
        elseif(!empty($arItem['CREATED_BY']))
            $sId = $arItem['CREATED_BY'];
        if(!empty($sId)){
            $arResult['ITEMS'][$key]['AUTHORSHIP'] = $sId;
            if(!in_array($sId,$arUsers))
                $arUsers[]=$sId;
        }
    }
    if(!empty($arUsers)){
        $db = CUser::GetList($by='ID',$order='ASC',array('ID'=>$arUsers));
        $arUsers = array();
        while($row = $db->Fetch()){
            $row['FULL_NAME'] = trim(trim($row['NAME'].' '.$row['SECOND_NAME']).' '.$row['LAST_NAME']);
            $row['GROUPS'] = CUser::GetUserGroup($row['ID']);
            $arUsers[$row['ID']] = $row;
        }
    }
    $arResult['USERS'] = $arUsers;
    foreach($arResult['ITEMS'] as $key=>$arItem){
        if(!empty($arItem['AUTHORSHIP'])){
            if(!empty($arResult['USERS'][$arItem['AUTHORSHIP']]))
                $arResult['ITEMS'][$key]['AUTHORSHIP'] = &$arResult['USERS'][$arItem['AUTHORSHIP']];
            else
                $arResult['ITEMS'][$key]['AUTHORSHIP'] = false;
        }
    }
}