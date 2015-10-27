<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['ITEMS']) && \Bitrix\Main\Loader::includeModule('iblock')){
    $arUsers = array();
    foreach($arResult['ITEMS'] as $key=>$arItem){
        if(!empty($arItem['PROPERTIES']['AUTHORSHIP']['VALUE']))
            $arUsers[] = $arResult['ITEMS'][$key]['AUTHORSHIP'] = $arItem['PROPERTIES']['AUTHORSHIP']['VALUE'];
        $arResult['ITEMS'][$key]['ANSWERS'] = array();

        $db = CIBlockElement::GetList(
            array('DATE_ACTIVE_FROM'=>'DESC','ID'=>'DESC'),
            array('IBLOCK_ID'=>COMMUNITY_ANSWERS_ID, 'PROPERTY_QUESTION'=>$arItem['ID'],"ACTIVE"=>"Y", "ACTIVE_DATE"=>"Y"),
            false,false,array('ID','IBLOCK_ID','NAME','PREVIEW_TEXT','SHOW_COUNTER', 'DATE_ACTIVE_FROM', 'PROPERTY_*')
        );
        while($row = $db->GetNextElement()){
            $fields = $row->GetFields();
            $fields['PROPERTIES'] = $row->GetProperties();
            if(!empty($fields['PROPERTIES']['AUTHORSHIP']['VALUE']))
                $arUsers[] = $fields['AUTHORSHIP'] = $fields['PROPERTIES']['AUTHORSHIP']['VALUE'];

            $arResult['ITEMS'][$key]['ANSWERS'][] = $fields;
        }
    }
    if(!empty($arUsers)){
        $db = CUser::GetList($by='ID',$order='ASC',array('ID'=>array_unique($arUsers)),array('SELECT'=>array('UF_*')));
        $arUsers = array();
        while($row = $db->Fetch()){
            $row['FULL_NAME'] = trim(trim($row['NAME'].' '.$row['SECOND_NAME']).' '.$row['LAST_NAME']);
            $row['GROUPS'] = CUser::GetUserGroup($row['ID']);
            $row['POST'] = '';
            $row['POST'] = $row['WORK_POSITION'];
            if(!empty($row['UF_JOB']) && $job = CIBlockElement::GetByID($row['UF_JOB'])->Fetch()){
                if(!empty($row['POST']))
                    $row['POST'].=', ';
                $row['POST'].=$job['NAME'];
            }
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
        if(!empty($arItem['ANSWERS'])){
            foreach($arItem['ANSWERS'] as $akey=>$answer){
                if(!empty($answer['AUTHORSHIP'])){
                    if(!empty($arResult['USERS'][$answer['AUTHORSHIP']]))
                        $arResult['ITEMS'][$key]['ANSWERS'][$akey]['AUTHORSHIP'] = &$arResult['USERS'][$answer['AUTHORSHIP']];
                    else
                        $arResult['ITEMS'][$key]['ANSWERS'][$akey]['AUTHORSHIP'] = false;
                }
            }
        }
    }
}