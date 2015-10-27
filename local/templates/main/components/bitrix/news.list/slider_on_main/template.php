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

<div class="c-list t-4 js-slick-slider-2"><?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
        <div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <!--
<div class="c-list__holder">
                <div class="c-list__date">6.09 - 7.09</div>
                <div class="c-list__place"><?=$arItem["DISPLAY_PROPERTIES"]["LOCATION"]["VALUE"]?></div>
            </div>
-->
            <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_IMG"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<!--
<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>"
						alt="<?=$arItem["PREVIEW_IMG"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_IMG"]["TITLE"]?>"
						class="c-list__image"
						/></a>
-->
			<?else:?>
				<!--
<img
					src="<?=$arItem["PREVIEW_IMG"]["SRC"]?>"
					alt="<?=$arItem["PREVIEW_IMG"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_IMG"]["TITLE"]?>"
					class="c-list__image"
					/>
-->
			<?endif;?>
			<?endif?>
            <div class="c-list__info">
                <div class="c-list__stat">
                    <div class="c-list__stat__item"><i class="ico i_views-gray"></i><?=$arItem["FIELDS"]["SHOW_COUNTER"]?></div>
                    <div class="c-list__stat__item"><i class="ico i_bubble-gray"></i><?=$arItem["DISPLAY_PROPERTIES"]["vote_count"]["VALUE"]?></div>
                    <div class="c-list__stat__item"><i class="ico i_like-gray"></i><?=$arItem["DISPLAY_PROPERTIES"]["BLOG_COMMENTS_CNT"]["VALUE"]?></div>
                </div>
                <div class="c-list__types">
                </div>
            </div><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="c-list__title"><?=$arItem["NAME"]?></a>
            <div class="c-list__tags">
            <?=$arItem["PREVIEW_TEXT"]?>
            <!-- <a href="#" class="c-list__tags__item">Нефть и газ</a><a href="#" class="c-list__tags__item">Энергетика</a><a href="#" class="c-list__tags__item">ЖКХ</a><a href="#" class="c-list__tags__item">Промышленность</a><a href="#" class="c-list__tags__item">Экономика</a><a href="#" class="c-list__tags__item">Политика</a><a href="#" class="c-list__tags__item">НТД и стандартизация</a><a href="#" class="c-list__tags__item">Происшествия</a><a href="#" class="c-list__tags__item">Экономика</a><a href="#" class="c-list__tags__item">Политика</a> -->
            </div>
        </div>
	<?endforeach;?>
</div>
