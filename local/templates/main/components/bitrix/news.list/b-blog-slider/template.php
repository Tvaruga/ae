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
	?><div data-holder=".b-blog-slider__teaser" data-list=".b-blog-slider__themes__list" data-list-item-class="b-blog-slider__themes__item" data-append=".b-blog-slider__title, .b-blog-slider__views, .b-blog-slider__types" data-slice-el=".b-blog-slider__title" class="b-blog-slider js-gearslider"><div class="b-blog-slider__teaser"><?
	foreach($arResult['ITEMS'] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?><div class="b-blog-slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="b-blog-slider__holder">
					<div class="b-blog-slider__crumbs"><a href="<?=$arItem['LIST_PAGE_URL']?>"><?=GetMessage('BLOG_SLIDER_BLOGS_LABEL')?></a><?
						if(!empty($arItem['SECTION_PATH'])) {
							foreach ($arItem['SECTION_PATH'] as $key => $sec)
								echo '<i class="ico i_crumbs-arr-white b-blog-slider__crumbs__sep"></i><a href="'.$sec['SECTION_PAGE_URL'].'">'.$sec['NAME'].'</a>';
						}
					?></div><?
					if($arParams['DISPLAY_DATE']!="N" && $arItem['DISPLAY_ACTIVE_FROM'])
						echo '<div class="b-blog-slider__date">'.$arItem['DISPLAY_ACTIVE_FROM'].'</div>';
					if($arParams['DISPLAY_NAME']!="N" && $arItem['NAME']):
						if(!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])):
							?><a href="<?echo $arItem['DETAIL_PAGE_URL']?>" class="b-blog-slider__title"><?= $arItem['NAME']?></a><?
						else:
							?><span class="b-blog-slider__title"><?= $arItem['NAME']?></span><?
						endif;
					endif;
					if(!empty($arItem['AUTHORSHIP'])):
						if(in_array(COMMUNITY_GROUP_ID,$arItem['AUTHORSHIP']['GROUPS'])):
							?><a href="/community/experts/<?=$arItem['AUTHORSHIP']['ID']?>/" class="b-blog-slider__author"><?=$arItem['AUTHORSHIP']['FULL_NAME']?></a><?
						else:
							?><span class="b-blog-slider__author"><?=$arItem['AUTHORSHIP']['FULL_NAME']?></span><?
						endif;
						if(!empty($arItem['AUTHORSHIP']['POST']))
							echo '<div class="b-blog-slider__post">'.$arItem['AUTHORSHIP']['POST'].'</div>';
					endif;
				?></div>
                <div class="b-blog-slider__bottom"><?
					if(!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])):
						?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="button b-blog-slider__button"><?=GetMessage('BLOG_SLIDER_BLOGS_DETAIL_LABEL')?></a><?
					endif;
					?><div class="b-blog-slider__stat"><?
						if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
							?><div class="b-blog-slider__stat__item b-blog-slider__views"><i class="b-blog-slider__views__ico"></i><?=(int)$arItem['SHOW_COUNTER']?></div><?
						endif;
						if(isset($arItem['PROPERTIES']['BLOG_COMMENTS_CNT'])):
							?><div class="b-blog-slider__stat__item"><i class="ico i_bubble-white"></i><?=(int)$arItem['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE']?></div><?
						endif;
						if(isset($arItem['PROPERTIES']['vote_count'])):
							?><div class="b-blog-slider__stat__item"><i class="ico i_like-white"></i><?=(int)$arItem['PROPERTIES']['vote_count']['VALUE']?></div><?
						endif;
					?></div>
                </div><?

				?><div class="b-blog-slider__types"><?
				if(!empty($arItem['DISPLAY_PROPERTIES']['VIDEO']['DISPLAY_VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['VIDEO_LINK']['DISPLAY_VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE'])):
					if(!empty($arItem['DISPLAY_PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE']))
						echo '<i class="ico i_video-gray b-blog-slider__types__item"></i>';
					if(!empty($arItem['DISPLAY_PROPERTIES']['VIDEO']['DISPLAY_VALUE']) || !empty($arItem['DISPLAY_PROPERTIES']['VIDEO_LINK']['DISPLAY_VALUE']))
						echo '<i class="ico i_image-gray b-blog-slider__types__item"></i>';
				endif;
				?></div><?

				if($arParams['DISPLAY_PICTURE']!="N"):
					$alt = $arItem['NAME'];
					$src = SITE_TEMPLATE_PATH.'/upload/img8.jpg';
					$title = '';

					if(!empty($arItem['DETAIL_PICTURE'])){
						$src = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'],array('width'=>715,'height'=>320),BX_RESIZE_IMAGE_EXACT);
						$src = $src['src'];
						$alt = $arItem['DETAIL_PICTURE']['ALT'];
						$title = $arItem['DETAIL_PICTURE']['TITLE'];
					}elseif(!empty($arItem['PREVIEW_PICTURE'])){
						$src = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'],array('width'=>715,'height'=>320),BX_RESIZE_IMAGE_EXACT);
						$src = $src['src'];
						$alt = $arItem['PREVIEW_PICTURE']['ALT'];
						$title = $arItem['PREVIEW_PICTURE']['TITLE'];
					}
					?><img src="<?=$src?>" alt="<?=$alt?>"<?if(!empty($title)) echo ' title="'.$title.'"';?> class="b-blog-slider__image"><?
				endif;
		?></div><?
	endforeach;
	?></div><?
	?><div class="b-blog-slider__themes"><?
		if(!empty($arResult['SECTIONS'])):
			?><form action="" method="post"><div class="b-blog-slider__themes__title"><?=GetMessage('BLOG_SLIDER_BLOGS_TITLE')?></div>
			<select onchange="BX.submit(this.form)" data-cont-class="b-blog-slider__themes__filter" name="EXP_SLIDER_SECTION" class="js-select"><option value=""><?=GetMessage('BLOG_SLIDER_BLOGS_ALL_CATEGORIES_LABEL')?></option><?
            	foreach($arResult['SECTIONS'] as $section):
            		?><option<?if(!empty($arResult['CUR_SECTION']) && $section['ID']==$arResult['CUR_SECTION']['ID']) echo ' selected="selected"';?> value="<?=$section['ID']?>"><?=$section['NAME']?></option><?
            	endforeach;
            ?></select>
			</form><?
		endif;
		?><div class="b-blog-slider__themes__list js-scroll"></div><a href="<?=$arItem['LIST_PAGE_URL']?>" class="button"><?=GetMessage('BLOG_SLIDER_BLOGS_ALL_BLOGS_LABEL')?></a>
    </div><?
	?></div><?
	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
endif;
