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
?><div class="b-page-head__tools">
	<div class="b-page-head__stat"><?
		if(isset($arResult['SHOW_COUNTER'])):
			?><div class="b-page-head__stat__item"><i class="ico i_views-gray"></i><?=(int)$arResult['SHOW_COUNTER']?></div><?
		endif;?>
		<?if(isset($arResult['PROPERTIES']['vote_count'])):
			?><div class="b-page-head__stat__item"><i class="ico i_like-gray"></i><?=(int)$arResult['PROPERTIES']['vote_count']['VALUE']?></div><?
		endif;
	?></div>
</div><?
if($arParams['DISPLAY_PICTURE']!="N" && (!empty($arResult['DETAIL_PICTURE'])||!empty($arResult['PREVIEW_PICTURE']))):
	$img = CFile::ResizeImageGet(empty($arResult['DETAIL_PICTURE'])?$arResult['PREVIEW_PICTURE']:$arResult['DETAIL_PICTURE'],array('width'=>103,'height'=>51),BX_RESIZE_IMAGE_PROPORTIONAL);
	?><div class="b-page-head__logo"><img src="<?=$img['src']?>" alt="<?=empty($arResult['DETAIL_PICTURE']['ALT'])?$arResult['NAME']:$arResult['DETAIL_PICTURE']['ALT']?>"<?
		if(!empty($arResult['DETAIL_PICTURE']['TITLE'])) echo ' title="'.$arResult['DETAIL_PICTURE']['TITLE'].'"';?>></div><?
endif;
$this->EndViewTarget();

$this->SetViewTarget('right_col');
	?><div class="b-right-sidebar">
		<div class="b-group m_b20">
			<div class="b-sidebar-stat"><?
				if(isset($arResult['SHOW_COUNTER'])):
					?><div class="b-sidebar-stat__item">
						<div class="b-sidebar-stat__icon"><i class="ico i_views-blue"></i></div>
						<div class="b-sidebar-stat__count"><?=(int)$arResult['SHOW_COUNTER']?></div>
						<div class="b-sidebar-stat__label"><?=GetMessage('VIEW_COUNT_LABEL')?> </div>
						<?/*<div class="b-sidebar-stat__point">+15</div>*/?>
					</div><?
				endif;
				if(isset($arResult['PROPERTIES']['vote_count'])):
					?><div class="b-sidebar-stat__item">
						<div class="b-sidebar-stat__icon"><i class="ico i_like-blue"></i></div>
						<div class="b-sidebar-stat__count"><?=(int)$arResult['PROPERTIES']['vote_count']['VALUE']?></div>
						<div class="b-sidebar-stat__label"><?=GetMessage('RECOMMEND_COUNT_LABEL')?> </div>
						<?/*<div class="b-sidebar-stat__point">+13</div>*/?>
					</div><?
				endif;
			?></div><?/*<a href="#" class="button m_t10">рекомендовать компанию</a>*/?>
		</div>
		<?if(!empty($arResult['DISPLAY_PROPERTIES'])):
		?><div class="b-group m_b20">
			<h2 class="b-group__title b-group__title_with-border"><?=GetMessage('CONTACT_PROPS_TITLE')?></h2>
			<div class="b-group__holder">
				<div class="b-contacts-info"><?
					foreach($arResult['DISPLAY_PROPERTIES'] as $prop):
						if($prop['CODE']=='LOCATION'):
							if(empty($prop['DISPLAY_VALUE']['ID']))
								continue;
							if(!empty($prop['DISPLAY_VALUE']['COUNTRY_NAME_LANG'])):
								?><div class="b-contacts-info__item">
									<div class="b-contacts-info__label"><?=GetMessage('COUNTRY_LABEL')?></div>
									<div class="b-contacts-info__text"><?=$prop['DISPLAY_VALUE']['COUNTRY_NAME_LANG']?></div>
								</div><?
							endif;
							if(!empty($prop['DISPLAY_VALUE']['REGION_NAME_LANG'])):
								?><div class="b-contacts-info__item">
									<div class="b-contacts-info__label"><?=GetMessage('REGION_LABEL')?></div>
									<div class="b-contacts-info__text"><?=$prop['DISPLAY_VALUE']['REGION_NAME_LANG']?></div>
								</div><?
							endif;
							if(!empty($prop['DISPLAY_VALUE']['CITY_NAME_LANG'])):
								?><div class="b-contacts-info__item">
									<div class="b-contacts-info__label"><?=GetMessage('CITY_LABEL')?></div>
									<div class="b-contacts-info__text"><?=$prop['DISPLAY_VALUE']['CITY_NAME_LANG']?></div>
								</div><?
							endif;
						/*elseif($prop['CODE']=='POST_ADDRESS'):
							?><div class="b-contacts-info__item">
								<div class="b-contacts-info__label"><?=$prop['NAME']?></div>
								<div class="b-contacts-info__text"><?if(!empty($arResult['PROPERTIES']['POST_CODE']['VALUE'])) echo $arResult['PROPERTIES']['POST_CODE']['VALUE'].', '; echo $prop['DISPLAY_VALUE'];?></div>
							</div><?
						*/elseif($prop['CODE']=='CONTACT_PERSON_FIO'):
							?><div class="b-contacts-info__item">
								<div class="b-contacts-info__label"><?=$prop['NAME']?></div>
								<div class="b-contacts-info__text"><?=$prop['DISPLAY_VALUE']?></div><?
								if(!empty($arResult['PROPERTIES']['CONTACT_PERSON_POSITION']['VALUE']))
									echo '<div class="b-contacts-info__small">'.$arResult['PROPERTIES']['CONTACT_PERSON_POSITION']['VALUE'].'</div>';
							?></div><?
						else:
							?><div class="b-contacts-info__item">
								<div class="b-contacts-info__label"><?=$prop['NAME']?></div>
								<div class="b-contacts-info__text"><?=is_array($prop['DISPLAY_VALUE'])?implode('</div><div class="b-contacts-info__text">',$prop['DISPLAY_VALUE']):$prop['DISPLAY_VALUE']?></div>
							</div><?
						endif;
					endforeach;
				?></div>
			</div>
		</div><?
		endif;
	?></div><?
$this->EndViewTarget();


if($arParams['DISPLAY_DATE']!="N" && $arResult['DISPLAY_ACTIVE_FROM']):
	?><div class="c-separator-line"></div><span class="news-date-time"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span><?
endif;

if(!empty($arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'])):
	?><div class="c-separator-line"></div><div class="b-page-tags"><?
		foreach(is_array($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'])?$arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']:array($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']) as $val):
			?><a href="#" class="b-page-tags__item"><?=$val?></a><?
		endforeach;
	?></div><?
endif;

?><div class="c-separator-line"></div><?


	?><div class="b-page-links b-file-links"><?
		if(!empty($arResult['PROPERTIES']['PRICE_LIST_FILE']['VALUE'])):
			?><a href="<?=CFile::GetPath($arResult['PROPERTIES']['PRICE_LIST_FILE']['VALUE'])?>" class="b-page-links__item"><span class="b-file-links__icon"><i class="ico i_doc-xls-blue"></i></span><span class="b-file-links__title"><?=GetMessage('DOWNLOAD_PRICELIST_LABEL')?></span></a><?
		endif;
		if(!empty($arResult['PROPERTIES']['PRESENTATION_FILE']['VALUE'])):
			?><a href="<?=CFile::GetPath($arResult['PROPERTIES']['PRESENTATION_FILE']['VALUE'])?>" class="b-page-links__item"><span class="b-file-links__icon"><i class="ico i_doc-pdf-blue"></i></span><span class="b-file-links__title"><?=GetMessage('DOWNLOAD_PDF_LABEL')?></span></a><?
		endif;
		/*<a href="#" class="b-page-links__item"><span class="b-file-links__icon"><i class="ico i_doc-video-blue"></i></span><span class="b-file-links__title">Виртуальная презентация</span></a>*/
	?></div><?

if(!empty($arResult['DETAIL_TEXT']) || !empty($arResult['PREVIEW_TEXT'])):
	?><div class="b-page-group">
		<h3 class="b-page-group__title"><?=GetMessage('ABOUT_INFO_TITLE')?></h3>
		<div class="b-page-group__holder"><?=empty($arResult['DETAIL_TEXT'])?$arResult['PREVIEW_TEXT']:$arResult['DETAIL_TEXT']?></div>
	</div><?
endif;

if(!empty($arResult['DISPLAY_PROPERTIES']['CATALOG']['VALUE'])):
	?><div class="b-page-group">
		<h3 class="b-page-group__title"><?=$arResult['PROPERTIES']['CATALOG']['NAME']?></h3>
		<div class="b-page-group__holder">
			<div class="c-content">
				<ul class="m_t20"><?
					foreach(is_array($arResult['DISPLAY_PROPERTIES']['CATALOG']['DISPLAY_VALUE'])?$arResult['DISPLAY_PROPERTIES']['CATALOG']['DISPLAY_VALUE']:array($arResult['DISPLAY_PROPERTIES']['CATALOG']['DISPLAY_VALUE']) as $val):
						?><li><?=$val?></li><?
					endforeach;
				?></ul>
			</div>
		</div>
	</div><?
endif;