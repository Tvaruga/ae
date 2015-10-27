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

	?><div class="c-list t-9"><?
	foreach($arResult['ITEMS'] as $key=>$arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?><div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
			if(($arParams['DISPLAY_DATE']!="N" && !empty($arItem['DISPLAY_ACTIVE_FROM'])) || !empty($arItem['AUTHORSHIP']['PERSONAL_PHOTO'])):
				?><div class="c-list__left"><?
					if(!empty($arItem['AUTHORSHIP']['PERSONAL_PHOTO'])):
						$img = CFile::ResizeImageGet($arItem['AUTHORSHIP']['PERSONAL_PHOTO'], array('width'=>50,'height'=>50), BX_RESIZE_IMAGE_EXACT);
						if(in_array(COMMUNITY_GROUP_ID,$arItem['AUTHORSHIP']['GROUPS'])):
							?><a href="/community/experts/<?=$arItem['AUTHORSHIP']['ID']?>/" class="c-list__link"><img class="c-list__image" src="<?=$img['src']?>" alt="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>" title="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>"></a><?
						else:
							?><img src="<?=$img['src']?>" alt="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>" title="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>" class="c-list__image"><?
						endif;
					endif;
					if($arParams['DISPLAY_DATE']!="N" && !empty($arItem['DISPLAY_ACTIVE_FROM']))
						echo '<div class="c-list__date">'.strtoupper($arItem['DISPLAY_ACTIVE_FROM']).'</div>';
				?></div><?
			endif;
			?><div class="c-list__holder">
				<div class="c-list__header"><?
					if($arParams['DISPLAY_NAME']!="N" && $arItem['NAME']):
						if(!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])):
							?><a class="c-list__title" href="<?echo $arItem['DETAIL_PAGE_URL']?>"><?echo $arItem['NAME']?></a><?
						else:
							?><span class="c-list__title"><?echo $arItem['NAME']?></span><?
						endif;
					endif;
					?><div class="c-list__stat m_t10 f_right"><?
						if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
							?><div class="c-list__stat__item"><i class="ico i_views-gray"></i><?=(int)$arItem['SHOW_COUNTER']?></div><?
						endif;
						if(isset($arItem['PROPERTIES']['BLOG_COMMENTS_CNT'])):
							?><div class="c-list__stat__item"><i class="ico i_bubble-gray"></i><?=(int)$arItem['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE']?></div><?
						endif;
						if(isset($arItem['PROPERTIES']['vote_count'])):
							?><div class="c-list__stat__item"><i class="ico i_like-gray"></i><?=(int)$arItem['PROPERTIES']['vote_count']['VALUE']?></div><?
						endif;
					?></div>
				</div><?
				if($arParams['DISPLAY_PREVIEW_TEXT']!="N" && !empty($arItem['PREVIEW_TEXT']))
					echo '<div class="c-list__text">'.$arItem['PREVIEW_TEXT'].'</div>';
				if(!empty($arItem['SECTIONS'])):
					?><div class="c-separator-line m_t30"></div><div class="b-page-tags"><?
						foreach($arItem['SECTIONS'] as $section):
							?><a href="<?=$section['SECTION_PAGE_URL']?>" class="b-page-tags__item"><?=$section['NAME']?></a><?
						endforeach;
					?></div><?
				endif;
			?></div>
		</div><?
	endforeach;
	?></div><?

	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
endif;

