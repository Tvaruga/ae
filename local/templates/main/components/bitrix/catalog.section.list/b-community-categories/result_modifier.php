<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (0 < $arResult['SECTIONS_COUNT'] && \Bitrix\Main\Loader::includeModule('iblock'))
{
    $questFilter = array(
        'PROPERTY_EXPERT_SECTION'=>false,
        'ACTIVE'=>'Y',
        'ACTIVE_DATE'=>'Y',
        'IBLOCK_ID'=>COMMUNITY_QUESTIONS_ID
    );
    $arSort = array(
        'DATE_ACTIVE_FROM'=>'DESC',
        'ID'=>'DESC'
    );

    foreach($arResult['SECTIONS'] as $key=>$section){
        if($arParams['COUNT_ELEMENTS'] && empty($section['ELEMENT_CNT'])){
            unset($arResult['SECTIONS'][$key]);
        }else{
            if($row = CIBlockElement::GetList(
                $arSort,
                array(
                    'SECTION_ID'=>$section['ID'],
                    'IBLOCK_ID'=>$section['IBLOCK_ID'],
                    'ACTIVE'=>'Y',
                    'ACTIVE_DATE'=>'Y'
                ),
                false,
                array('nTopCount'=>1),
                array('ID','IBLOCK_ID','NAME','DETAIL_PAGE_URL')
            )->GetNext(false,false))
                $arResult['SECTIONS'][$key]['LAST_ITEM'] = $row;
            else
                unset($arResult['SECTIONS'][$key]);
        }
        if(isset($arResult['SECTIONS'][$key])){
            $questFilter['PROPERTY_EXPERT_SECTION'] = array($section['ID']);
            $arResult['SECTIONS'][$key]['QUESTION_COUNT'] = CIBlockElement::GetList($arSort,$questFilter,array());
            if(!empty($arResult['SECTIONS'][$key]['QUESTION_COUNT']))
                $arResult['SECTIONS'][$key]['LATEST_QUESTION'] = CIBlockElement::GetList(
                    $arSort,
                    $questFilter,
                    false,
                    array('nTopCount'=>1),
                    array('ID','IBLOCK_ID','NAME','DETAIL_PAGE_URL')
                )->GetNext(false,false);
        }
    }
    $arResult['SECTIONS'] = array_values($arResult['SECTIONS']);
    $arResult['SECTIONS_COUNT'] = count($arResult['SECTIONS_COUNT']);
}