<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
/**
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @var array $arParams
 * @var array $arResult
 */
if (empty($arResult["TOPIC"]))
	return 0;
// ************************* Input params***************************************************************
$arParams["SHOW_NAV"] = (is_array($arParams["SHOW_NAV"]) ? $arParams["SHOW_NAV"] : array());
$arParams["SHOW_COLUMNS"] = (is_array($arParams["SHOW_COLUMNS"]) ? $arParams["SHOW_COLUMNS"] : array());
$arParams["SHOW_SORTING"] = ($arParams["SHOW_SORTING"] == "Y" ? "Y" : "N");
$arParams["SEPARATE"] = (empty($arParams["SEPARATE"]) ? GetMessage("FTP_IN_FORUM") : $arParams["SEPARATE"]);
// *************************/Input params***************************************************************

?>
<?foreach($arResult["TOPIC"] as $arTopic){?>
<div class="c-list__item">
    <div class="c-list__date"><?=$arTopic["LAST_POST_DATE"]?></div>
    <div class="c-list__holder"><a href="<?=$arTopic["URL"]["READ"]?>" class="c-list__title"><?=$arTopic["TITLE"]?></a>
        <div class="c-list__stat">
            <div class="c-list__stat__item"><i class="ico i_views-gray"></i><?=$arTopic["VIEWS"]?></div>
        </div>
    </div>
</div>
<?}?>
                            