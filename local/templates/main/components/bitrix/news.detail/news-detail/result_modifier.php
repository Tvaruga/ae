<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON']['VALUE']) && $user = CUser::GetByID($arResult['PROPERTIES']['INTERVIEWED_PERSON']['VALUE'])->Fetch()){
    if(in_array(COMMUNITY_GROUP_ID,CUser::GetUserGroup($user['ID'])))
        $arResult['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE'] = '/community/experts/'.$user['ID'].'/';

    $arResult['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE'] = $user['PERSONAL_PHOTO'];
    $arResult['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE'] = $user['WORK_POSITION'];

    if(!empty($user['UF_JOB']) && \Bitrix\Main\Loader::includeModule('iblock') && $row = CIBlockElement::GetByID($user['UF_JOB'])->Fetch())
        $arResult['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'] = $row['NAME'];

    $arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'] = trim(trim($user['LAST_NAME'].' '.$user['NAME']).' '.$user['SECOND_NAME']);
}