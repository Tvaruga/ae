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
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
             <div class="b-main-advert__title"><?=$arResult["IBLOCKS"][$arItem["IBLOCK_ID"]]["NAME"]?></div>
                <div class="b-main-advert__row">
                    <div class="b-main-advert__col b-main-advert__col_theme">
                        <div class="b-main-advert__theme"><span class="b-main-advert__label">Тема. </span><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["DISPLAY_VALUE"]["THEMES"]["DISPLAY_VALUE"]["UF_NAME"]?></a></div>
                    </div>
                    <div class="b-main-advert__col b-main-advert__col_text">
                        <div class="b-main-advert__text"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
                    </div>
                    <div class="b-main-advert__col b-main-advert__col_info">
                        <div class="b-main-advert__city"><?=$arItem["PROPERTY_LOCATION_VALUE"]?></div>
                        <div class="b-main-advert__date"><?=$arItem["DATE"]["DD"]?> <?=$arItem["DATE"]["MM"]?> в <?=$arItem["DATE"]["HH"]?>.<?=$arItem["DATE"]["MI"]?></div>
                    </div>
                </div>
	<?endforeach;?>

