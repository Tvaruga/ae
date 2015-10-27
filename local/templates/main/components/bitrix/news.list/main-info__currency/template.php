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
?><div class="b-main-info__currency"><?
	if($arParams['DISPLAY_TOP_PAGER'])
		echo $arResult['NAV_STRING'];
	foreach($arResult['ITEMS'] as $arItem):
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?><div class="b-main-info__currency__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$arItem['NAME']?> — <?=number_format($arItem['VALUE']['LAST']['Value'],4).(empty($arItem['VALUE']['PREV']['Value'])||$arItem['VALUE']['PREV']['Value']==$arItem['VALUE']['LAST']['Value']?'':($arItem['VALUE']['PREV']['Value']<$arItem['VALUE']['LAST']['Value']?'  ↑':' ↓'))?></div><?
	endforeach;
	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
?></div><?
endif;
