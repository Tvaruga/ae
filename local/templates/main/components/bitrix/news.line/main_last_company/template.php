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
?>
<div class="b-company-group__header">
	<div class="b-company-group__title"><?=GetMessage("LAST_ADDED_COMPANIES");?></div>
	<div class="b-company-group__title"><?=GetMessage("COMPANIES_COUNT");?><b class="b-company-group__count"><?=$arResult["COUNT"]?></b></div>
</div>
<div class="b-company-group__holder">
	<div class="b-company-group__list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="b-company-group__item"><?echo $arItem["NAME"]?></a>
	<?endforeach;?>
</div><a href="/companies/" class="button"><?=GetMessage("ALL_COMPANIES");?></a>
</div>