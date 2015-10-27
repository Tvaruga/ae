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
	$delimiter = count($arResult['ITEMS']);
	$delimiter = ($delimiter>1)?ceil($delimiter/2):$delimiter;

?><div class="row t-1 m_b10 m_t20"><div class="cell s-6"><div class="c-list t-4"><?
	foreach($arResult['ITEMS'] as $key=>$arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		if($key>0 && $key%$delimiter==0)
			echo '</div></div><div class="cell s-6"><div class="c-list t-4">';
		if($arParams['DISPLAY_PICTURE']!="N" && !empty($arItem['PREVIEW_PICTURE'])):
			?><div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
				if(!empty($arItem['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['VALUE']) || ($arParams['DISPLAY_DATE']!="N" && (!empty($arItem['DISPLAY_ACTIVE_FROM'])||!empty($arItem['PROPERTIES']['START_DATE']['VALUE'])))):
					?><div class="c-list__holder"><?
						if($arParams['DISPLAY_DATE']!="N" && (!empty($arItem['DISPLAY_ACTIVE_FROM'])||!empty($arItem['PROPERTIES']['START_DATE']['VALUE']))):
							$strDate = empty($arItem['PROPERTIES']['START_DATE']['VALUE'])?$arItem['DISPLAY_ACTIVE_FROM']:FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arItem['PROPERTIES']['START_DATE']['VALUE']));
							?><div class="c-list__date"><?=$strDate?></div><?
						endif;
						if(!empty($arItem['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['VALUE'])):
							?><div class="c-list__place"><?=strip_tags($arItem['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['DISPLAY_VALUE'])?></div><?
						endif;
					?></div><?
				endif;
				?><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=empty($arItem['PREVIEW_PICTURE']['ALT'])?$arItem['NAME']:$arItem['PREVIEW_PICTURE']['ALT']?>" class="c-list__image"<?if(!empty($arItem['PREVIEW_PICTURE']['TITLE'])) echo ' title="'.$arItem['PREVIEW_PICTURE']['TITLE'].'"';?>>
				<div class="c-list__info">
					<div class="c-list__stat"><?
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
					<div class="c-list__types"><?
						if(!empty($arItem['DISPLAY_PROPERTIES']['VIDEO_LINK']['DISPLAY_VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['VIDEO']['DISPLAY_VALUE']))
							echo '<i class="ico i_video-gray c-list__types__item"></i>';
						if(!empty($arItem['PROPERTIES']['INVITATION']['VALUE']))
							echo '<i class="ico i_ticket-gray c-list__types__item"></i>';
					?></div>
				</div><?
				if($arParams['DISPLAY_NAME']!="N"):
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="c-list__title"><?=$arItem['NAME']?></a><?
				endif;
				if(!empty($arItem['DISPLAY_PROPERTIES']['THEMES']['VALUE'])):
					$arItem['DISPLAY_PROPERTIES']['THEMES']['DISPLAY_VALUE'] = is_array($arItem['DISPLAY_PROPERTIES']['THEMES']['DISPLAY_VALUE'])?$arItem['DISPLAY_PROPERTIES']['THEMES']['DISPLAY_VALUE']:array($arItem['DISPLAY_PROPERTIES']['THEMES']['DISPLAY_VALUE']);
					echo '<div class="c-list__tags">';
					foreach($arItem['DISPLAY_PROPERTIES']['THEMES']['DISPLAY_VALUE'] as $val)
						echo '<a href="#" class="c-list__tags__item">'.$val.'</a>';
					echo '</div>';
				endif;
			?></div><?
		else:
			?><div class="c-list__item c-list__item_with-border" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
				if(!empty($arItem['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['VALUE']) || ($arParams['DISPLAY_DATE']!="N" && (!empty($arItem['DISPLAY_ACTIVE_FROM'])||!empty($arItem['PROPERTIES']['START_DATE']['VALUE'])))):
					?><div class="c-list__holder"><?
					if($arParams['DISPLAY_DATE']!="N" && (!empty($arItem['DISPLAY_ACTIVE_FROM'])||!empty($arItem['PROPERTIES']['START_DATE']['VALUE']))):
						$strDate = empty($arItem['PROPERTIES']['START_DATE']['VALUE'])?$arItem['DISPLAY_ACTIVE_FROM']:FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($arItem['PROPERTIES']['START_DATE']['VALUE']));
						?><div class="c-list__date"><?=$strDate?></div><?
					endif;
					if(!empty($arItem['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['VALUE'])):
						?><div class="c-list__place"><?=strip_tags($arItem['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['DISPLAY_VALUE'])?></div><?
					endif;
					?></div><?
				endif;
				?><div class="c-list__main-holder"><?
					if($arParams['DISPLAY_NAME']!="N"):
						?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="c-list__title"><?=$arItem['NAME']?></a><?
					endif;
					if($arParams['DISPLAY_PREVIEW_TEXT']!="N" && !empty($arItem['PREVIEW_TEXT']))
						echo '<div class="c-list__text">'.$arItem['PREVIEW_TEXT'].'</div>';
					/*<a href="#" class="button m_t20"><i class="ico i_ticket-white m_r5"></i>Получить приглашение</a>*/?>
				</div>
			</div><?
		endif;
endforeach;
		?></div></div></div><?
		if($arParams['DISPLAY_BOTTOM_PAGER'])
			echo $arResult['NAV_STRING'];
endif;
