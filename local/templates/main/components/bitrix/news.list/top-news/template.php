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
	?><div class="b-group m_b20" ><h2 class="b-group__title"><?=GetMessage('TOP_NEWS_SINGLE_LABEL')?></h2>
		<div class="b-group__holder"><div class="c-list t-1"><?
	foreach($arResult['ITEMS'] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?><div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
				if($arParams['DISPLAY_PICTURE']!="N" && (!empty($arItem['PREVIEW_PICTURE'])||!empty($arItem['DETAIL_PICTURE']))):
					if(!empty($arItem['PREVIEW_PICTURE'])){
						$alt = $arItem['PREVIEW_PICTURE']['ALT'];
						$title = $arItem['PREVIEW_PICTURE']['TITLE'];
					}else{
						$alt = $arItem['DETAIL_PICTURE']['ALT'];
						$title = $arItem['DETAIL_PICTURE']['TITLE'];
					}
					if(empty($alt))
						$alt = $arItem['NAME'];
					$img = CFile::ResizeImageGet(empty($arItem['PREVIEW_PICTURE'])?$arItem['DETAIL_PICTURE']:$arItem['PREVIEW_PICTURE'],array('width'=>500,'height'=>500),BX_RESIZE_IMAGE_PROPORTIONAL);
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="c-list__link"><img src="<?=$img['src']?>" alt="<?=$alt?>" class="c-list__image"<?if(!empty($title)) echo ' title="'.$title.'"';?>></a><?
					if($arParams['DISPLAY_DATE']!="N" && !empty($arItem['ACTIVE_FROM'])):
						$timestamp = MakeTimeStamp($arItem['ACTIVE_FROM']);
						$day = date('j',$timestamp);
						$mounth = date('n',$timestamp);
						$year = date('Y',$timestamp);
						?><div class="c-list__date">
						<div class="c-list__time"><?=date('G:i',$timestamp)?></div><?
						if($date!==date('j')||$mounth!=date('n')||$year!=date('Y')):
							?><div class="c-list__day"><?=$day.' '.GetMessage('MONTH_'.$mounth.'_S').(date('Y')!=$year?' '.$year:'')?></div><?
						endif;
						?></div><?
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
				if($arParams['DISPLAY_NAME']!="N"):
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="c-list__title"><?=$arItem['NAME']?></a><?
				endif;
				if($arParams['DISPLAY_PREVIEW_TEXT']!="N" && !empty($arItem['PREVIEW_TEXT']))
					echo '<div class="c-list__text">'.$arItem['PREVIEW_TEXT'].'</div>';
			?></div><?
	endforeach;
?></div></div></div><?
	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
endif;
