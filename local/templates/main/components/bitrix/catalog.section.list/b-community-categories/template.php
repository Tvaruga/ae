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

$strSectionEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

if (0 < $arResult['SECTIONS_COUNT'])
{
	?><div class="b-community-categories m_t30"><?

	foreach ($arResult['SECTIONS'] as &$arSection)
	{
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

		?><div class="b-community-categories__item" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
			<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="b-community-categories__header"><?
				if(!empty($arSection['UF_CSS_ICON']))
					echo '<div class="b-community-categories__icon"><i class="ico-cat '.$arSection['UF_CSS_ICON'].'"></i></div>';

				?><div class="b-community-categories__title"><?=$arSection['NAME']?></div>
			</a>
			<div class="b-community-categories__holder">
				<div class="b-community-categories__row">
					<div class="b-community-categories__left"><?
						if($arParams['COUNT_ELEMENTS']):
							?><div class="b-community-categories__main-count"><i class="ico i_blogs-green m_r10"></i><?=GetMessage('COMMUNITY_WORKS_COUNT_LABEL')?> <span class="b-community-categories__num"><?=(int)$arSection['ELEMENT_CNT']?></span></div><?
						endif;
						/*!!!*/?><div class="b-community-categories__sub-count"><i class="ico i_person-green m_r5"></i>подписчиков <span class="b-community-categories__num">367</span></div>
					</div><?
					/*!!!*/?><div class="b-community-categories__right"><a href="#" class="button m_b10">подписаться</a></div>
				</div>
				<?if(!empty($arSection['LAST_ITEM'])):
					?><div class="b-community-categories__label"><?=GetMessage('COMMUNITY_LATEST_WORK_LABEL')?></div><div class="b-community-categories__text"><a href="<?=$arSection['LAST_ITEM']['DETAIL_PAGE_URL']?>"><?=$arSection['LAST_ITEM']['NAME']?></a></div><?
				endif;
			?></div><?
			if(!empty($arSection['QUESTION_COUNT'])):
				/*!!!*/
				?><div class="b-community-categories__holder">
					<div class="b-community-categories__row">
						<div class="b-community-categories__left">
							<div class="b-community-categories__main-count"><i class="ico i_question-green m_r10"></i><?=GetMessage('COMMUNITY_QUESTION_COUNT_LABEL')?> <span class="b-community-categories__num"><?=(int)$arSection['QUESTION_COUNT']?></span></div>
							<div class="b-community-categories__sub-count"><i class="ico i_person-green m_r5"></i>подписчиков <span class="b-community-categories__num">367</span></div>
						</div>
						<div class="b-community-categories__right"><a href="#" class="button m_b10">подписаться</a></div>
					</div><?
					if(!empty($arSection['LATEST_QUESTION'])):
						?><div class="b-community-categories__label"><?=GetMessage('COMMUNITY_LATEST_QUESTION_LABEL')?></div><div class="b-community-categories__text"><a href="<?=$arSection['LATEST_QUESTION']['DETAIL_PAGE_URL']?>"><?=$arSection['LATEST_QUESTION']['NAME']?></a></div><?
					endif;
				?></div><?
				endif;?>
		</div><?
	}
	?></div><?
}
