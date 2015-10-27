<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$aMenuLinksExt = array();
if(!empty($_REQUEST['EXPERT_ID'])) {
    $obCache = new CPHPCache();
    $arFilter = array(
        'IBLOCK_ID' => COMMUNITY_ID,
        'GLOBAL_ACTIVE' => 'Y',
        'ACTIVE' => 'Y',
        'DEPTH_LEVEL' => 1,
        'CNT_ACTIVE' => 'Y'
    );
    $dir = '/iblock/menu_ext';
    if ($obCache->InitCache(0, md5(serialize($arFilter).'-'.$_REQUEST['EXPERT_ID']), $dir)) {
        $aMenuLinksExt = $obCache->GetVars();
    } elseif ($obCache->StartDataCache() && \Bitrix\Main\Loader::includeModule('iblock')) {
        $db = CIBlockSection::GetList(
            array('element_cnt' => 'DESC', 'NAME' => 'ASC'),
            $arFilter,
            true,
            array(
                'ID',
                'NAME',
                'SECTION_PAGE_URL')
        );
        if (defined('BX_COMP_MANAGED_CACHE')) {
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($dir);
            $CACHE_MANAGER->RegisterTag('iblock_id_' . $arFilter['IBLOCK_ID']);
        }

        while ($row = $db->GetNext(false, false)) {
            if (empty($row['ELEMENT_CNT']))
                continue;

            $aMenuLinksExt[] = array(
                $row['NAME'],
                $row['SECTION_PAGE_URL'],
                array(),
                array(
                    'FROM_IBLOCK' => true,
                    'DEPTH_LEVEL' => 1,
                    'ITEM_QUANTITY' => (int)$row['ELEMENT_CNT'],
                    'USER_ACTIVITY' => CIBlockElement::GetList(
                        array('ID'=>'ASC'),
                        array(
                            'IBLOCK_ID'=>$arFilter['IBLOCK_ID'],
                            'SECTION_ID'=>$row['ID'],
                            'INCLUDE_SUBSECTIONS'=>'Y',
                            'ACTIVE'=>'Y',
                            'ACTIVE_DATE'=>'Y',
                            array(
                                'LOGIC'=>'OR',
                                array(
                                    'PROPERTY_AUTHORSHIP'=>false,
                                    'CREATED_BY'=>$_REQUEST['EXPERT_ID']
                                ),
                                array(
                                    'PROPERTY_AUTHORSHIP'=>$_REQUEST['EXPERT_ID']
                                ),
                            )
                        ),
                        array()
                    )
                )
            );
        }

        if (defined('BX_COMP_MANAGED_CACHE'))
            $CACHE_MANAGER->EndTagCache();

        $obCache->EndDataCache($aMenuLinksExt);
    }
}
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);