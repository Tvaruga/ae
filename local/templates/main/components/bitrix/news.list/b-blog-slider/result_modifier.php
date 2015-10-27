<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['ITEMS']) && \Bitrix\Main\Loader::includeModule('iblock')){
    $arResult['SECTIONS'] = array();
    $db = CIBlockSection::GetList(
        array('SORT'=>'ASC','NAME'=>'ASC'),
        array(
            'IBLOCK_ID' => $arResult['ID'],
            'ACTIVE'=>'Y',
            'GLOBAL_ACTIVE'=>'Y',
            'CNT_ACTIVE'=>'Y'
        ),true,
        array('ID','IBLOCK_ID','NAME')
    );
    while($row = $db->Fetch())
        if(!empty($row['ELEMENT_CNT']))
            $arResult['SECTIONS'][]=$row;

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
            $row['POST'] = '';
            $row['POST'] = $row['WORK_POSITION'];
            $row['GROUPS'] = CUser::GetUserGroup($row['ID']);
            if(!empty($row['UF_JOB']) && $job = CIBlockElement::GetByID($row['UF_JOB'])->Fetch()){
                if(!empty($row['POST']))
                    $row['POST'].=', ';
                $row['POST'].=$job['NAME'];
            }
            $arUsers[$row['ID']] = $row;
        }
    }
    $arResult['USERS'] = $arUsers;
    $arResult['CUR_SECTION'] = false;
    if(!empty($arResult['SECTION']['PATH']))
        $arResult['CUR_SECTION'] = end($arResult['SECTION']['PATH']);
    foreach($arResult['ITEMS'] as $key=>$arItem){
        if(!empty($arItem['AUTHORSHIP'])){
            if(!empty($arResult['USERS'][$arItem['AUTHORSHIP']]))
                $arResult['ITEMS'][$key]['AUTHORSHIP'] = &$arResult['USERS'][$arItem['AUTHORSHIP']];
            else
                $arResult['ITEMS'][$key]['AUTHORSHIP'] = false;
        }
        $secId = false;
        if(!empty($arResult['CUR_SECTION']))
            $secId = $arResult['CUR_SECTION']['ID'];
        elseif(!empty($arItem['IBLOCK_SECTION_ID']))
            $secId = $arItem['IBLOCK_SECTION_ID'];
        if(!empty($secId)){
            $arResult['ITEMS'][$key]['SECTION_PATH'] = array();
            $db = CIBlockSection::GetNavChain($arResult['ID'],$secId,array('ID','NAME','CODE','SECTION_PAGE_URL'));
            while($row = $db->GetNext(false,false)){
                $arResult['ITEMS'][$key]['SECTION_PATH'][]=$row;
            }
        }
    }
}