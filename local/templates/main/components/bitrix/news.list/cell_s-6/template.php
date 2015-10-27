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

if($arParams['DISPLAY_TOP_PAGER'])
		echo $arResult['NAV_STRING'];

if(!empty($arResult['ITEMS'])):
	$delimiter = count($arResult['ITEMS']);
	$delimiter = ($delimiter>1)?ceil($delimiter/2):$delimiter;

	if(!empty($arParams['TOP_NEWS']))
		$delimiter = $delimiter>1 ? $delimiter-1 : 0;

	/*?><div class="cell s-6"><?*/
	?><div class="c-list t-<?=$arResult['PERSON_MODE']?3:2?>"><?
	foreach($arResult['ITEMS'] as $key=>$arItem):
		if($delimiter!==false && ($key>0 || $delimiter==0) && $key%$delimiter==0){
			echo '</div></div><div class="cell s-6"><div class="c-list t-'.($arResult['PERSON_MODE']?3:2).'">';
			$delimiter = false;
		}
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?><div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
		if($arResult['PERSON_MODE']){
			if(($arParams['DISPLAY_DATE']!="N" && !empty($arItem['ACTIVE_FROM'])) || !empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE']) || !empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE']) || !empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE']) || !empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'])):
			?><div class="c-list__header"><?
				if(!empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE'])):
					$img = CFile::ResizeImageGet($arItem['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE'],array('width'=>100,'height'=>130),BX_RESIZE_IMAGE_PROPORTIONAL);
					if(empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE'])):
						?><img src="<?=$img['src']?>"<?if(!empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'])) echo ' alt="'.$arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'].'"';?> class="c-list__image"><?
					else:
						?><a href="<?=$arItem['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE']?>" class="c-list__link"><img src="<?=$img['src']?>"<?if(!empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'])) echo ' alt="'.$arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'].'"';?> class="c-list__image"></a><?
					endif;
				endif;
				?><div class="c-list__holder"><?
					if($arParams['DISPLAY_DATE']!="N" && !empty($arItem['ACTIVE_FROM'])):
						$timestamp = MakeTimeStamp($arItem['ACTIVE_FROM']);
						$day = date('j',$timestamp);
						$mounth = date('n',$timestamp);
						$year = date('Y',$timestamp);
						echo '<div class="c-list__date">';
						?><div class="c-list__time"><?=date('G:i',$timestamp)?></div><?
						if($date!==date('j')||$mounth!=date('n')||$year!=date('Y')):
							?><div class="c-list__day"><?=$day.' '.GetMessage('MONTH_'.$mounth.'_S').(date('Y')!=$year?' '.$year:'')?></div><?
						endif;
						echo '</div>';
					endif;
					?><div class="c-list__author"><?
						if(!empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'])):
							if(empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE'])):
								?><span class="c-list__name"><?=$arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE']?></span><?
							else:
								?><a href="<?=$arItem['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE']?>" class="c-list__name"><?=$arItem['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE']?></a><?
							endif;
						endif;
						$position = '';
						if(!empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE']))
							$position.=$arItem['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE'];
						if(!empty($arItem['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'])){
							if(!empty($position))
								$position.=', ';
							$position.=$arItem['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'];
						}
						if(!empty($position))
							echo '<div class="c-list__post">'.$position.'</div>';
					?></div>
				</div>
			</div><?
			endif;
			?><div class="c-list__stat"><?
				if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
					?><div class="c-list__stat__item"><i class="ico i_views-gray"></i><?=(int)$arItem['SHOW_COUNTER']?></div><?
				endif;
				if(isset($arItem['PROPERTIES']['BLOG_COMMENTS_CNT'])):
					?><div class="c-list__stat__item"><i class="ico i_bubble-gray"></i><?=(int)$arItem['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE']?></div><?
				endif;
				if(isset($arItem['PROPERTIES']['vote_count'])):
					?><div class="c-list__stat__item"><i class="ico i_like-gray"></i><?=(int)$arItem['PROPERTIES']['vote_count']['VALUE']?></div><?
				endif;
			?></div><?
			if($arParams['DISPLAY_NAME']!="N" && $arItem['NAME']):
				if(!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])):
					?><a class="c-list__title" href="<?echo $arItem['DETAIL_PAGE_URL']?>"><?echo $arItem['NAME']?></a><?
				else:
					?><span class="c-list__title"><?echo $arItem['NAME']?></span><?
				endif;
			endif;
			if($arParams['DISPLAY_PREVIEW_TEXT']!="N" && !empty($arItem['PREVIEW_TEXT']))
				echo '<div class="c-list__text">'.$arItem['PREVIEW_TEXT'].'</div>';

		}else{
			if($arParams['DISPLAY_DATE']!="N" && !empty($arItem['ACTIVE_FROM'])):
				$timestamp = MakeTimeStamp($arItem['ACTIVE_FROM']);
				$day = date('j',$timestamp);
				$mounth = date('n',$timestamp);
				$year = date('Y',$timestamp);
				?><div class="c-list__time"><?=date('G:i',$timestamp)?></div><?
				if($date!==date('j')||$mounth!=date('n')||$year!=date('Y')):
					?><div class="c-list__date"><?=$day.' '.GetMessage('MONTH_'.$mounth.'_S').(date('Y')!=$year?' '.$year:'')?></div><?
				endif;
			endif;
			if(!empty($arItem['DISPLAY_PROPERTIES']['VIDEO']['DISPLAY_VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['VIDEO_LINK']['DISPLAY_VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE'])):
				?><div class="c-list__types"><?
				if(!empty($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE']))
					echo '<i class="ico i_image-gray c-list__types__item"></i>';
				if(!empty($arItem['DISPLAY_PROPERTIES']['VIDEO']['DISPLAY_VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['VIDEO_LINK']['DISPLAY_VALUE']))
					echo '<i class="ico i_video-gray c-list__types__item"></i>';
				?></div><?
			endif;
			if($arParams['DISPLAY_NAME']!="N" && $arItem['NAME']):
				if(!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])):
					?><a class="c-list__title" href="<?echo $arItem['DETAIL_PAGE_URL']?>"><?echo $arItem['NAME']?></a><?
				else:
					?><span class="c-list__title"><?echo $arItem['NAME']?></span><?
				endif;
			endif;
			?><div class="c-list__stat"><?
				if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
					?><div class="c-list__stat__item"><i class="ico i_views-gray"></i><?=(int)$arItem['SHOW_COUNTER']?></div><?
				endif;
				if(isset($arItem['PROPERTIES']['BLOG_COMMENTS_CNT'])):
					?><div class="c-list__stat__item"><i class="ico i_bubble-gray"></i><?=(int)$arItem['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE']?></div><?
				endif;
				if(isset($arItem['PROPERTIES']['vote_count'])):
					?><div class="c-list__stat__item"><i class="ico i_like-gray"></i><?=(int)$arItem['PROPERTIES']['vote_count']['VALUE']?></div><?
				endif;
			?></div><?
		}
		?></div><?
	endforeach;
	?></div><?
endif;

	?></div></div><? //row t-1 m_b10 //cell s-6
if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];

