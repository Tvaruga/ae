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
	?><div class="b-page-head b-page-head_profile m_b25"><?
		if(!empty($arResult['AUTHORSHIP'])):
			if(!empty($arResult['AUTHORSHIP']['PERSONAL_PHOTO'])):
				$img = CFile::ResizeImageGet($arResult['AUTHORSHIP']['PERSONAL_PHOTO'], array('width'=>100,'height'=>100), BX_RESIZE_IMAGE_EXACT);
				if(in_array(COMMUNITY_GROUP_ID,$arResult['AUTHORSHIP']['GROUPS'])):
					?><a href="/community/experts/<?=$arResult['AUTHORSHIP']['ID']?>/"><img src="<?=$img['src']?>" alt="<?=$arResult['AUTHORSHIP']['FULL_NAME']?>" title="<?=$arResult['AUTHORSHIP']['FULL_NAME']?>" class="b-page-head__image"></a><?
				else:
					?><img src="<?=$img['src']?>" alt="<?=$arResult['AUTHORSHIP']['FULL_NAME']?>" title="<?=$arResult['AUTHORSHIP']['FULL_NAME']?>" class="b-page-head__image"><?
				endif;
			endif;
			?><div class="b-page-head__author"><?
				if(in_array(COMMUNITY_GROUP_ID,$arResult['AUTHORSHIP']['GROUPS'])):
					?><a href="/community/experts/<?=$arResult['AUTHORSHIP']['ID']?>/" class="b-page-head__title"><?=$arResult['AUTHORSHIP']['FULL_NAME']?></a><?
				else:
					?><div class="b-page-head__title"><?=$arResult['AUTHORSHIP']['FULL_NAME']?></div><?
				endif;
				if(!empty($arResult['AUTHORSHIP']['POST']))
					echo '<div class="b-page-head__post">'.$arResult['AUTHORSHIP']['POST'].'</div>';
			?></div><?
		endif;
		/*?><div class="b-page-head__tools">
			<div class="b-page-head__buttons"><a href="#" class="button button_gray block"><i class="ico i_plus-white"></i>Подписаться</a></div>
		</div>*/
	?></div>

	<div class="c-list t-9">
		<div class="c-list__item c-list__item_no-hover"><?
			if($arParams['DISPLAY_DATE']!="N" && !empty($arResult['DISPLAY_ACTIVE_FROM']))
				echo '<div class="c-list__left"><div class="c-list__date">'.strtoupper($arResult['DISPLAY_ACTIVE_FROM']).'</div></div>';
			?><div class="c-list__holder">
				<div class="c-list__header">
					<?if($arParams['DISPLAY_DATE']!="N"):
						$timestamp = MakeTimeStamp($arResult['ACTIVE_FROM']);
						?><div class="c-list__time"><?=date('h:i',$timestamp)?></div><?
					endif;
					if($arParams['DISPLAY_NAME']!='N'):
						?><h2 class="c-list__title"><?=$arResult['NAME']?></h2><?
					endif;
					?><div class="c-list__stat m_t10 f_right"><?
						if(isset($arResult['SHOW_COUNTER']))
							echo '<div class="c-list__stat__item"><i class="ico i_views-gray"></i>'.(int)$arResult['SHOW_COUNTER'].'</div>';
						if(isset($arResult['PROPERTIES']['BLOG_COMMENTS_CNT']))
							echo '<div class="c-list__stat__item"><i class="ico i_bubble-gray"></i>'.(int)$arResult['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE'].'</div>';
						if(isset($arResult['PROPERTIES']['vote_count']))
							echo '<div class="c-list__stat__item"><i class="ico i_like-gray"></i>'.(int)$arResult['PROPERTIES']['vote_count']['VALUE'].'</div>';
					?></div>
				</div><?
				if($arParams['DISPLAY_PREVIEW_TEXT']=='Y' && !empty($arResult['PREVIEW_TEXT']))
					echo '<div class="c-list__text">'.$arResult['PREVIEW_TEXT'].'</div>';
			?></div><?
			if($arParams['DISPLAY_PICTURE']!='N' && !empty($arResult['MEDIA'])):
				if(count($arResult['MEDIA'])>1):
					?><div class="c-list__media"><div class="b-gallery-slider m_t20 m_b20"><div class="b-gallery-slider__holder js-slick-slider-for"><?
					foreach($arResult['MEDIA'] as $img):
						?><div class="b-gallery-slider__item"><img src="<?=$img['SRC']?>" alt="" class="b-gallery-slider__image"></div><?
					endforeach;
					?></div><div class="b-gallery-slider__nav js-slick-slider-nav"><?
					foreach($arResult['MEDIA'] as $img):
						$img = CFile::ResizeImageGet($img['ID'],array('width'=>87,'height'=>87),BX_RESIZE_IMAGE_PROPORTIONAL);
						?><div class="b-gallery-slider__nav__item"><img src="<?=$img['src']?>" class="b-gallery-slider__nav__image"></div><?
					endforeach;
					?></div></div></div><?
				else:
					?><img src="<?=$arResult['MEDIA'][0]['SRC']?>" alt="<?=empty($arResult['MEDIA'][0]['ALT'])?$arResult['NAME']:$arResult['MEDIA'][0]['ALT'];?>"<?if(!empty($arResult['MEDIA'][0]['TITLE'])) echo ' title="'.$arResult['MEDIA'][0]['TITLE'].'"';?> class="m_t20 m_b20"><?
				endif;
			else:
				?><div class="m_t30"></div><?
			endif;
			?><div class="c-list__holder">
				<div class="c-list__text"><?=$arResult['DETAIL_TEXT']?></div>
				<?if(!empty($arResult['SECTIONS'])):
					?><div class="c-separator-line m_t30"></div><div class="b-page-tags"><?
					foreach($arResult['SECTIONS'] as $section):
						?><a href="<?=$section['SECTION_PAGE_URL']?>" class="b-page-tags__item"><?=$section['NAME']?></a><?
					endforeach;
					?></div><?
				endif;
				/*<div class="c-separator-line m_b20"></div>
				<a href="#" class="button button_gray"><i class="ico i_edit m_r5 m_b5"></i>отправить вопрос	</a>*/?>
			</div><?