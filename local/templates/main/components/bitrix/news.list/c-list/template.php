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
if(!empty($arResult['ITEMS'])):
	if($arParams['DISPLAY_TOP_PAGER'])
		echo $arResult['NAV_STRING'];
	?><div class="c-list t-6 m_t40"><div class="c-list__main-title"><?=GetMessage('EL_LIST_ELEMENT_FOUND')?> <b><?=$arResult['NAV_RESULT']->NavRecordCount?></b></div><?
	foreach($arResult['ITEMS'] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?><div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
			if($arParams['DISPLAY_PICTURE']!="N" && is_array($arItem['PREVIEW_PICTURE'])):
				$img = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'],array('width'=>105,'height'=>105),BX_RESIZE_IMAGE_PRAPORTIONAL);
				if(!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])):
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="c-list__link"><img
						class="c-list__image"
						src="<?=$img['src']?>"
						alt="<?=empty($arItem['PREVIEW_PICTURE']['ALT'])?$arItem['NAME']:$arItem['PREVIEW_PICTURE']['ALT']?>"
						<?if(!empty($arItem['PREVIEW_PICTURE']['TITLE'])) echo 'title="'.$arItem['PREVIEW_PICTURE']['TITLE'].'"';?>
					/></a><?
				else:
					?><span class="c-list__link"><img
						class="c-list__image"
						src="<?=$img['src']?>"
						alt="<?=empty($arItem['PREVIEW_PICTURE']['ALT'])?$arItem['NAME']:$arItem['PREVIEW_PICTURE']['ALT']?>"
						<?if(!empty($arItem['PREVIEW_PICTURE']['TITLE'])) echo 'title="'.$arItem['PREVIEW_PICTURE']['TITLE'].'"';?>
					/></span><?
				endif;
			endif;
			?><div class="c-list__holder"><?
				if($arParams['DISPLAY_DATE']!="N" && $arItem['DISPLAY_ACTIVE_FROM'])
					echo '<span class="news-date-time">'.$arItem['DISPLAY_ACTIVE_FROM'].'</span>';
				if($arParams['DISPLAY_NAME']!="N" && $arItem['NAME']):
					if(!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])):
						?><a class="c-list__title" href="<?echo $arItem['DETAIL_PAGE_URL']?>"><?echo $arItem['NAME']?><?/*<i class="ico i_star-blue"></i>*/?></a><?
					else:
						?><b class="c-list__title"><?= $arItem['NAME']?><?/*<i class="ico i_star-blue"></i>*/?></b><?
					endif;
				endif;
				if($arParams['DISPLAY_PREVIEW_TEXT']!="N" && $arItem['PREVIEW_TEXT'])
					echo '<div class="c-list__text">'.$arItem['PREVIEW_TEXT'].'</div>';
				?><div class="c-list__stat"><?
					if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
						?><div class="c-list__stat__item"><i class="ico i_views-black"></i><?=(int)$arItem['SHOW_COUNTER']?></div><?
					endif;
					?><div class="c-list__stat__item"><i class="ico i_like-black"></i><?=(int)$arItem['PROPERTIES']['vote_count']['VALUE']?></div>
                </div>
            </div>
        </div><?
	endforeach;
	?></div><?
	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
endif;