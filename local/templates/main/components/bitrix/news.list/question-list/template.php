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

	foreach($arResult['ITEMS'] as $key=>$arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?><div class="c-list t-10 m_t10"><div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
			if(count($arItem['ANSWERS'])>0)
				echo '<div class="c-list__top">';
			?><div class="c-list__left"><?
			if(($arParams['DISPLAY_DATE']!="N" && $arItem['DISPLAY_ACTIVE_FROM']) || !empty($arItem['AUTHORSHIP']['PERSONAL_PHOTO'])):
					if(!empty($arItem['AUTHORSHIP']['PERSONAL_PHOTO'])):
						$img = CFile::ResizeImageGet($arItem['AUTHORSHIP']['PERSONAL_PHOTO'], array('width'=>100,'height'=>100), BX_RESIZE_IMAGE_EXACT);
						if(in_array(COMMUNITY_GROUP_ID,$arItem['AUTHORSHIP']['GROUPS'])):
							?><a href="/community/experts/<?=$arItem['AUTHORSHIP']['ID']?>/" class="c-list__link"><img class="c-list__image" src="<?=$img['src']?>" alt="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>" title="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>"></a><?
						else:
							?><img src="<?=$img['src']?>" alt="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>" title="<?=$arItem['AUTHORSHIP']['FULL_NAME']?>" class="c-list__image"><?
						endif;
					endif;
					if($arParams['DISPLAY_DATE']!="N" && $arItem['DISPLAY_ACTIVE_FROM']):
						?><div class="c-list__date"><?=strtoupper($arItem['DISPLAY_ACTIVE_FROM'])?></div><?
					endif;
			endif;
			?></div><?
			?><div class="c-list__holder">
				<div class="c-list__header m_t10">
					<div class="clearfix">
						<?if(!empty($arItem['AUTHORSHIP'])):
							echo '<div class="f_left">';
							if(in_array(COMMUNITY_GROUP_ID,$arItem['AUTHORSHIP']['GROUPS']))
								echo '<a href="/community/experts/'.$arItem['AUTHORSHIP']['ID'].'/" class="link c-list__name">'.$arItem['AUTHORSHIP']['FULL_NAME'].'</a>';
							else
								echo '<span class="link c-list__name">'.$arItem['AUTHORSHIP']['FULL_NAME'].'</span>';
							?><span class="c-list__disc">задает вопрос:</span><?
							if(!empty($arItem['AUTHORSHIP']['POST']))
								echo '<div class="c-list__disc">'.$arItem['AUTHORSHIP']['POST'].'</div>';
							echo '</div>';
						endif;
						?><div class="c-list__stat f_right"><?
							if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
								?><div class="c-list__stat__item m_r10"><i class="ico i_views-gray"></i><?=(int)$arItem['SHOW_COUNTER']?></div><?
							endif;
							?><div class="c-list__stat__item m_r10"><i class="ico i_bubble-gray"></i><?=count($arItem['ANSWERS'])?></div><?
							if(isset($arItem['PROPERTIES']['LIKE_QUANTITY'])):
								?><div class="c-list__stat__item"><i class="ico i_like-gray"></i><?=(int)$arItem['PROPERTIES']['LIKE_QUANTITY']['VALUE']?></div><?
							endif;
						?></div>
					</div>
					<div class="c-list__title"><!--<a href="<?=$arItem['DETAIL_PAGE_URL']?>">--><?=$arItem['NAME']?><!--</a>--></div>
				</div>
				<?if(!empty($arItem['PREVIEW_TEXT']))
					echo '<div class="c-list__text">'.$arItem['PREVIEW_TEXT'].'</div>';
				if(!empty($arItem['DISPLAY_PROPERTIES']['EXPERT_SECTION']['DISPLAY_VALUE'])):
					$arItem['DISPLAY_PROPERTIES']['EXPERT_SECTION']['DISPLAY_VALUE'] = is_array($arItem['DISPLAY_PROPERTIES']['EXPERT_SECTION']['DISPLAY_VALUE'])?$arItem['DISPLAY_PROPERTIES']['EXPERT_SECTION']['DISPLAY_VALUE']:array($arItem['DISPLAY_PROPERTIES']['EXPERT_SECTION']['DISPLAY_VALUE']);
					?><div class="b-page-tags"><?
						foreach($arItem['DISPLAY_PROPERTIES']['EXPERT_SECTION']['DISPLAY_VALUE'] as $val)
							echo str_replace('<a','<a class="b-page-tags__item"',$val);
					?></div><?
				endif;
			if(count($arItem['ANSWERS'])>0):
				echo '</div></div>';
				foreach($arItem['ANSWERS'] as $answer):
					?><div class="c-list__bottom"><div class="c-list__left"><?
						if(($arParams['DISPLAY_DATE']!="N" && !empty($answer['DATE_ACTIVE_FROM'])) || !empty($answer['AUTHORSHIP']['PERSONAL_PHOTO'])):
								if(!empty($answer['AUTHORSHIP']['PERSONAL_PHOTO'])):
									$img = CFile::ResizeImageGet($answer['AUTHORSHIP']['PERSONAL_PHOTO'], array('width'=>100,'height'=>100), BX_RESIZE_IMAGE_EXACT);
									?><a href="/community/experts/<?=$answer['AUTHORSHIP']['ID']?>/"><img src="<?=$img['src']?>" alt="<?=$answer['AUTHORSHIP']['NAME']?>" class="c-list__image"></a><?
								endif;
								if($arParams['DISPLAY_DATE']!="N" && !empty($answer['DATE_ACTIVE_FROM'])):
									?><div class="c-list__date"><?=strtoupper(FormatDate($arParams['ACTIVE_DATE_FORMAT'], MakeTimeStamp($answer['DATE_ACTIVE_FROM'])))?></div><?
								endif;
						endif;
						?></div><div class="c-list__holder">
							<div class="clearfix"><?
								if(!empty($answer['AUTHORSHIP'])):
									echo '<div class="f_left">';
									?><span class="c-list__text-title m_r5">Отвечает:</span><?
//if(in_array(COMMUNITY_GROUP_ID,$arItem['AUTHORSHIP']['GROUPS']))
										echo '<a href="/community/experts/'.$answer['AUTHORSHIP']['ID'].'/" class="link c-list__name">'.$answer['AUTHORSHIP']['FULL_NAME'].'</a>';
//else
//echo '<span class="link c-list__name">'.$answer['AUTHORSHIP']['FULL_NAME'].'</span>';

									if(!empty($answer['AUTHORSHIP']['POST']))
										echo '<div class="c-list__disc">'.$answer['AUTHORSHIP']['POST'].'</div>';
									echo '</div>';
								endif;
								?><div class="c-list__stat f_right"><?
									if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
										?><div class="c-list__stat__item m_r10"><i class="ico i_views-gray"></i><?=(int)$answer['SHOW_COUNTER']?></div><?
									endif;
									?><div class="c-list__stat__item m_r10"><i class="ico i_bubble-gray"></i><?=count($answer['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE'])?></div><?
									if(isset($answer['PROPERTIES']['vote_count'])):
										?><div class="c-list__stat__item"><i class="ico i_like-gray"></i><?=(int)$answer['PROPERTIES']['vote_count']['VALUE']?></div><?
									endif;
								?></div>
							</div><?
							if(!empty($answer['PREVIEW_TEXT']))
								echo '<div class="c-list__text m_t10">'.$answer['PREVIEW_TEXT'].'</div>';
							/*!!!*/?>
							<!--
<div class="row">
								<div class="cell s-1"><a href="#" title="К первому вопросу" class="f_right m_t10"><i class="ico i_share-gray"></i></a></div>
							</div>
-->
			<?$APPLICATION->IncludeComponent(
				"imedia:iblock.vote",
				"im_like",
				Array(
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"COMPONENT_TEMPLATE" => "flat",
					"DISPLAY_AS_RATING" => "rating",
					"ELEMENT_CODE" => $answer['CODE'],
					"ELEMENT_ID" => $answer['ID'],
					"IBLOCK_ID" => $answer['IBLOCK_ID'],
					"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
					"MAX_VOTE" => "1",
					"MESSAGE_404" => "",
					"SET_STATUS_404" => "N",
					"SHOW_RATING" => "N",
					"VOTE_NAMES" => array("1")
				)
			);?>
						</div>
					</div><?
				endforeach;
			else:
				if(empty($arItem['DISPLAY_PROPERTIES']['EXPERT_SECTION']['DISPLAY_VALUE']))
					echo '<div class="m_t10">Пока ответов нет</div>';
				else
					echo '<span>Пока ответов нет</span>';
				echo '</div>';
			endif;
		?></div></div><?
	endforeach;
	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
endif;
