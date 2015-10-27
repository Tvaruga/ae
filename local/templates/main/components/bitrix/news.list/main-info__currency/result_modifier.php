<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(!empty($arResult['ITEMS'])){

    foreach($arResult['ITEMS'] as $key=>$arItem){
        $found = false;

        if(!empty($arItem['CODE'])){
            $rows = CInc::getCBRDynamic($arItem['CODE']);
            if(!empty($rows)){
                $found = true;
                $rows = array_reverse(array_values($rows));
                $arResult['ITEMS'][$key]['VALUE'] = array(
                    'LAST'=>current($rows),
                    'PREV'=>count($rows>1)?$rows[1]:false
                );
            }
        }

        if(!$found)
            unset($arResult['ITEMS'][$key]);
    }
}