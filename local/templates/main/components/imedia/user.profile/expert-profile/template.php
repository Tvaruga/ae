<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$this->SetViewTarget('pre_page-head__title');
    if(!empty($arResult['PERSONAL_PHOTO'])){
        $img = CFile::ResizeImageGet(
            $arResult['PERSONAL_PHOTO'],
            array('width'=>100, 'height'=>100),
            BX_RESIZE_IMAGE_EXACT
        );
        ?><img src="<?=$img['src']?>" alt="<?=$arResult['FULL_NAME']?>" class="b-page-head__image"><div class="b-page-head__author"><?
    }
$this->EndViewTarget('pre_page-head__title');

$this->SetViewTarget('after_page-head__title');
        $arResult['POST'] = $arResult['WORK_POSITION'];
        if(!empty($arResult['UF_JOB']) && \Bitrix\Main\Loader::includeModule('iblock') && $row = CIBlockElement::GetByID($arResult['UF_JOB'])->Fetch()){
            if(!empty($arResult['POST']))
                $arResult['POST'] .=', ';
            $arResult['POST'] .= $row['NAME'];
        }
        if(!empty($arResult['POST']))
            echo '<div class="b-page-head__post">'.$arResult['POST'].'</div>';
    ?></div><?
    if(in_array(COMMUNITY_GROUP_ID, $arResult['GROUPS'])):
    ?><div class="b-page-head__tools">
        <div class="b-page-head__links m_r20 m_t10"><i class="ico i_person-gray m_r10"></i><?=GetMessage('USER_PROFILE_EXPERT_LABEL')?></div>
        <!--div class="b-page-head__buttons">
            <a href="#" class="button block">задать вопрос</a>
            <a href="#" class="button button_gray block m_t15"><i class="ico i_plus-white"></i>подписаться</a>
        </div-->
    </div><?
    endif;
$this->EndViewTarget('after_page-head__title');
?><div class="c-separator-line"></div>
<div class="b-profile m_t30"><?
    $address = $arResult['PERSONAL_COUNTRY_STR'];
    if(!empty($arResult['PERSONAL_STATE'])){
        if(!empty($address))
            $address.=', ';
        $address.=$arResult['PERSONAL_STATE'];
    }
    if(!empty($arResult['PERSONAL_CITY'])){
        if(!empty($address))
            $address.=', ';
        $address.=$arResult['PERSONAL_CITY'];
    }
    if(!empty($address)):
        ?><div class="b-profile__item">
            <div class="b-profile__label"><?=GetMessage('USER_PROFILE_ADDRESS')?>:</div>
            <div class="b-profile__text"><?=$address?></div>
        </div><?
    endif;
    if(!empty($arResult['PERSONAL_NOTES'])):
        ?><div class="b-profile__item">
            <div class="b-profile__label"><?=GetMessage('USER_PROFILE_ABOUT')?>:</div>
            <div class="b-profile__text"><?=$arResult['PERSONAL_NOTES']?></div>
        </div><?
    endif;
    if(!empty($arResult['PERSONAL_NOTES'])):
        ?><div class="b-profile__item">
            <div class="b-profile__label"><?=GetMessage('USER_PROFILE_PHONE')?>:</div>
            <div class="b-profile__text"><?=$arResult['PERSONAL_PHONE']?></div>
        </div><?
    endif;
    if(!empty($arResult['PERSONAL_WWW'])):
        ?><div class="b-profile__item">
            <div class="b-profile__label"><?=GetMessage('USER_PROFILE_WWW')?>:</div>
            <div class="b-profile__text"><?=$arResult['PERSONAL_WWW']?></div>
        </div><?
    endif;
    if(!empty($arResult['UF_EXPERT_SECTION']) && \Bitrix\Main\Loader::includeModule('iblock')):
        $arSections = array();
        $db = CIBlockSection::GetList(
            array('ID'=>'DESC'),
            array(
                'IBLOCK_ID'=>COMMUNITY_ID,
                'CNT_ACTIVE'=>'Y',
                'ACTIVE'=>'Y',
                'GLOBAL_ACTIVE'=>'Y'
            ),
            true,
            array('ID','IBLOCK_ID','NAME','SECTION_PAGE_URL')
        );
        while($row = $db->GetNext(false,false)){
            if(empty($row['ELEMENT_CNT']))
                continue;
            if(in_array($row['ID'],$arResult['UF_EXPERT_SECTION']))
                $row['SELECTED'] = true;
            $arSections[] = $row;
        }
        if(!empty($arSections)):
            ?><div class="b-profile__item">
                <div class="b-profile__label"><?=GetMessage('USER_PROFILE_EXPERT_SECTIONS')?>:</div>
                <div class="b-profile__text">
                    <div class="c-separator-line"></div>
                    <div class="b-page-tags"><?
                        foreach($arSections as $section):
                            ?><a href="<?=$section['SECTION_PAGE_URL']?>" class="b-page-tags__item<?if($section['SELECTED']) echo ' b-page-tags__item_selected';?>"><?=$section['NAME']?></a><?
                        endforeach;
                    ?></div>
                </div>
            </div><?
        endif;
    endif;
    if(!empty($arResult['DATE_REGISTER'])):
        ?><div class="b-profile__item">
            <div class="b-profile__label"><?=GetMessage('USER_PROFILE_REGISTER_DATE')?>:</div>
            <div class="b-profile__text"><?=FormatDate('x',MakeTimeStamp($arResult['DATE_REGISTER']))?></div>
        </div><?
    endif;
    if(!empty($arResult['LAST_LOGIN'])):
        ?><div class="b-profile__item">
            <div class="b-profile__label"><?=GetMessage('USER_PROFILE_ACTIVE')?>:</div>
            <div class="b-profile__text"><?=GetMessage('USER_PROFILE_LAST_LOGIN').' '.FormatDate('x',MakeTimeStamp($arResult['LAST_LOGIN']))?></div>
        </div><?
    endif;
?></div>
