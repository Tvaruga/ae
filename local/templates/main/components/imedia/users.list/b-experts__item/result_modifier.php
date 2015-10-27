<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['USERS']) && \Bitrix\Main\Loader::includeModule('iblock')){
    foreach($arResult['USERS'] as $key=>$user){
        $arFilter = array(
            'IBLOCK_ID'=>COMMUNITY_ID,
            'ACTIVE'=>'Y',
            'ACTIVE_DATE'=>'Y',
            array(
                'LOGIC'=>'OR',
                array('PROPERTY_AUTHORSHIP'=>$user['ID']),
                array('PROPERTY_AUTHORSHIP'=>false, 'CREATED_BY'=>$user['ID'])
            )
        );
        $arSort = array(
            'DATE_ACTIVE_FROM'=>'DESC',
            'ID'=>'DESC'
        );


        $arResult['USERS'][$key]['LIKE_QUANTITY'] = 0;
        $arResult['USERS'][$key]['FULL_NAME'] = trim(trim($user['NAME'].' '.$user['SECOND_NAME']).' '.$user['LAST_NAME']);
        $arResult['USERS'][$key]['POST'] = $user['WORK_POSITION'];
        if(!empty($user['UF_JOB']) && $row = CIBlockElement::GetByID($user['UF_JOB'])->Fetch()){
            if(!empty($arResult['USERS'][$key]['POST']))
                $arResult['USERS'][$key]['POST'] .=', ';
            $arResult['USERS'][$key]['POST'] .=$row['NAME'];
        }

        $arResult['USERS'][$key]['WORKS_COUNT'] = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            array()
        );

        if(!empty($arResult['USERS'][$key]['WORKS_COUNT'])){
            if($arResult['USERS'][$key]['LATEST_WORK'] = CIBlockElement::GetList(
                $arSort,
                $arFilter,
                false,
                array('nTopCount'=>1),
                array('ID','NAME','IBLOCK_ID','DETAIL_PAGE_URL','PROPERTY_vote_count')
            )->GetNext(false,false)){
                $arFilter['!ID']=$arResult['USERS'][$key]['LATEST_WORK']['ID'];
                $arResult['USERS'][$key]['LIKE_QUANTITY']+=(int)$arResult['USERS'][$key]['LATEST_WORK']['PROPERTY_vote_count_VALUE'];
            }

            //works like quantity
            $db = CIBlockElement::GetList($arSort,$arFilter,false,false,array('ID','IBLOCK_ID','PROPERTY_vote_count'));
            while($row=$db->Fetch())
                $arResult['USERS'][$key]['LIKE_QUANTITY']+=(int)$row['PROPERTY_vote_count_VALUE'];
        }

        $arResult['USERS'][$key]['QUESTION_COUNT'] = array();
        $arResult['USERS'][$key]['LATEST_QUESTION'] = false;

        //answers like quantity
        //questions count
        $arFilter['IBLOCK_ID'] = COMMUNITY_ANSWERS_ID;
        if(isset($arFilter['!ID']))
            unset($arFilter['!ID']);

        $db = CIBlockElement::GetList(
            $arSort,
            $arFilter,
            false,false,
            array('ID','IBLOCK_ID','PROPERTY_vote_count','PROPERTY_QUESTION')
        );
        while($row=$db->Fetch()){
            $arResult['USERS'][$key]['LIKE_QUANTITY']+=(int)$row['PROPERTY_vote_count_VALUE'];
            if(!empty($row['PROPERTY_QUESTION_VALUE'])){
                if(!in_array($row['PROPERTY_QUESTION_VALUE'],$arResult['USERS'][$key]['QUESTION_COUNT']))
                    $arResult['USERS'][$key]['QUESTION_COUNT'][]=$row['PROPERTY_QUESTION_VALUE'];
                if(empty($arResult['USERS'][$key]['LATEST_QUESTION']))
                    $arResult['USERS'][$key]['LATEST_QUESTION'] = CIBlockElement::GetByID($row['PROPERTY_QUESTION_VALUE'])->GetNext(false,false);
            }
        }
        $arResult['USERS'][$key]['QUESTION_COUNT'] = empty($arResult['USERS'][$key]['QUESTION_COUNT']) ? 0 : count($arResult['USERS'][$key]['QUESTION_COUNT']);
    }
}