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
?><!--noindex--><div class="b-social m_t5"><div class="b-social__title"><?=empty($arResult['DESCRIPTION'])?$arResult['NAME']:$arResult['DESCRIPTION']?></div><?
	if($arParams['DISPLAY_TOP_PAGER'])
		echo $arResult['NAV_STRING'];
	?><div class="b-social__links"><?
	foreach($arResult['ITEMS'] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		if(empty($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'])):
			?><span id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="b-social__item"><i class="ico<?if(!empty($arItem['CODE'])) echo ' '.$arItem['CODE'];?>"></i></span><?
		else:
			?><a href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>" rel="nofollow" id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="b-social__item"><i class="ico<?if(!empty($arItem['CODE'])) echo ' '.$arItem['CODE'];?>"></i></a><?
		endif;
	endforeach;
	?></div><?
	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
?></div><!--/noindex--><?
endif;
