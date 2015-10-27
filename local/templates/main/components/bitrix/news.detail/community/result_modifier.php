<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(\Bitrix\Main\Loader::includeModule('iblock')){
    if(!empty($arResult['PROPERTIES']['AUTHORSHIP']['VALUE']))
        $arResult['AUTHORSHIP'] = CUser::GetList($by='ID',$order='DESC',
            array('ID'=>$arResult['PROPERTIES']['AUTHORSHIP']['VALUE']),
            array('SELECT'=>array('UF_*'))
        )->Fetch();
    elseif(!empty($arResult['CREATED_BY']))
        $arResult['AUTHORSHIP'] = CUser::GetList($by='ID',$order='DESC',
            array('ID'=>$arResult['CREATED_BY']),
            array('SELECT'=>array('UF_*'))
        )->Fetch();

    if(!empty($arResult['AUTHORSHIP']['ID'])){
        if(!empty($arResult['AUTHORSHIP']['UF_JOB']) && $row = CIBlockElement::GetByID($arResult['AUTHORSHIP']['UF_JOB'])->Fetch())
            $arResult['AUTHORSHIP']['UF_JOB'] = $row['NAME'];
        $arResult['AUTHORSHIP']['GROUPS'] = CUser::GetUserGroup($arResult['AUTHORSHIP']['ID']);
        $arResult['AUTHORSHIP']['POST'] = $arResult['AUTHORSHIP']['WORK_POSITION'];
        if(!empty($arResult['AUTHORSHIP']['UF_JOB'])){
            if(!empty($arResult['AUTHORSHIP']['POST']))
                $arResult['AUTHORSHIP']['POST'].=',<br>';
            $arResult['AUTHORSHIP']['POST'].=$arResult['AUTHORSHIP']['UF_JOB'];
        }
        $arResult['AUTHORSHIP']['FULL_NAME'].=trim(trim($arResult['AUTHORSHIP']['NAME'].' '.$arResult['AUTHORSHIP']['SECOND_NAME']).' '.$arResult['AUTHORSHIP']['LAST_NAME']);
    }

    if(!empty($arResult['IBLOCK_SECTION_ID'])){
        $arResult['SECTIONS'] = array();
        $db = CIBlockElement::GetElementGroups($arResult['ID'],false,array('ID','NAME','IBLOCK_ID','SECTION_PAGE_URL'));
        while($row = $db->GetNext(false,false))
            $arResult['SECTIONS'][]=$row;
    }
    $arResult['MEDIA'] = array();
    if(!empty($arResult['DETAIL_PICTURE']))
        $arResult['MEDIA'][]=$arResult['DETAIL_PICTURE'];
    if(!empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE']))
        foreach($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $imgId)
            $arResult['MEDIA'][] = CFile::GetFileArray($imgId);
}