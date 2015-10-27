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

<div class="b-ints-slider js-slick-slider-1">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
				<div class="b-ints-slider__item">
                <div class="b-ints-slider__type"><?=$arResult["IBLOCKS"][$arItem["IBLOCK_ID"]]["NAME"]?></div>
                <div class="b-ints-slider__holder"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="b-ints-slider__title"><?=$arItem["NAME"]?></a>
                    <div class="b-ints-slider__date">
                        <div class="b-ints-slider__day"><?=$arItem["DATE"]["DD"]?></div>
                        <div class="b-ints-slider__date__holder">
                            <div class="b-ints-slider__month">	<?=$arItem["DATE"]["MM"]?></div>
                            <div class="b-ints-slider__time">	<?=$arItem["DATE"]["HH"]?>:<?=$arItem["DATE"]["MI"]?></div>
                        </div>
                    </div>
                </div>
            </div>
	<?endforeach;?>
</div>
