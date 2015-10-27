<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['ITEMS'])){
    $arModules = array();
    if(!empty($arResult['SECTION']['PATH'])){
        $arResult['CUR_SECTION'] = end($arResult['SECTION']['PATH']);
        if(\Bitrix\Main\Loader::includeModule('iblock')){
            $arModules[] = 'iblock';
            $props=$GLOBALS['USER_FIELD_MANAGER']->GetUserFields('IBLOCK_'.$arResult['ID'].'_SECTION',$arResult['CUR_SECTION']['ID']);
            if(!empty($props['UF_PERSON_TEMPLATE']['VALUE']))
                $arResult['PERSON_MODE'] = true;
        }
    }
    if($arResult['PERSON_MODE']){
        foreach($arResult['ITEMS'] as $key=>$arItem){
            if(!empty($arItem['PROPERTIES']['INTERVIEWED_PERSON']['VALUE']) && $user = CUser::GetByID($arItem['PROPERTIES']['INTERVIEWED_PERSON']['VALUE'])->Fetch()){
                if(in_array(COMMUNITY_GROUP_ID,CUser::GetUserGroup($user['ID'])))
                    $arResult['ITEMS'][$key]['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE'] = '/community/experts/'.$user['ID'].'/';

                $arResult['ITEMS'][$key]['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE'] = $user['PERSONAL_PHOTO'];
                $arResult['ITEMS'][$key]['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE'] = $user['WORK_POSITION'];

                if(!empty($user['UF_JOB']) && (in_array('iblock',$arModules) || \Bitrix\Main\Loader::includeModule('iblock')) && $row = CIBlockElement::GetByID($user['UF_JOB'])->Fetch())
                    $arResult['ITEMS'][$key]['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'] = $row['NAME'];

                $arResult['ITEMS'][$key]['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'] = trim(trim($user['LAST_NAME'].' '.$user['NAME']).' '.$user['SECOND_NAME']);
            }
        }
    }
}