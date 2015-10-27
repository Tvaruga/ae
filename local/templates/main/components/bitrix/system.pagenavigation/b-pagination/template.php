<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?><div class="b-pagination"><?

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

if($arResult["bDescPageNumbering"] === true):

	if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if($arResult["bSavePage"]):
			?><a class="b-pagination__begin" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span class="b-pagination__begin__arr"><i class="ico i_crumbs-arr-prev-black"></i></span><?=GetMessage("b_nav_prev")?></a><?
		else:
			if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):
				?><a class="b-pagination__begin" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span class="b-pagination__begin__arr"><i class="ico i_crumbs-arr-prev-black"></i></span><?=GetMessage("b_nav_prev")?></a><?
			else:
				?><a class="b-pagination__begin" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span class="b-pagination__begin__arr"><i class="ico i_crumbs-arr-prev-black"></i></span><?=GetMessage("b_nav_prev")?></a><?
			endif;
		endif;

		?><ul class="b-pagination__holder"><?
		if ($arResult["nStartPage"] < $arResult["NavPageCount"]):
			?><li class="b-pagination__item"><?
			if($arResult["bSavePage"]):
				?><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>">1</a><?
			else:
				?><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a><?
			endif;
			?></li><?
			if ($arResult["nStartPage"] < ($arResult["NavPageCount"] - 1)):
				?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=intVal($arResult["nStartPage"] + ($arResult["NavPageCount"] - $arResult["nStartPage"]) / 2)?>">...</a></li><?
			endif;
		endif;
	else:
		?><ul class="b-pagination__holder"><?
	endif;
	do
	{
		$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;
		
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
			?><li class="b-pagination__item b-pagination__item_selected"><b class="b-pagination__link"><?=$NavRecordGroupPrint?></b></li><?
		elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):
			?><li class="b-pagination__item"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="b-pagination__link"><?=$NavRecordGroupPrint?></a></li><?
		else:
			?><li class="b-pagination__item"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="b-pagination__link"><?=$NavRecordGroupPrint?></a></li><?
		endif;
		
		$arResult["nStartPage"]--;
	} while($arResult["nStartPage"] >= $arResult["nEndPage"]);
	
	if ($arResult["NavPageNomer"] > 1):
		if ($arResult["nEndPage"] > 1):
			if ($arResult["nEndPage"] > 2):
				?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] / 2)?>">...</a></li><?
			endif;
			?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=$arResult["NavPageCount"]?></a></li><?
		endif;
		?></ul><?
		?><a class="b-pagination__end" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("b_nav_next")?><span class="b-pagination__end__arr"><i class="ico i_crumbs-arr-black"></i></span></a><?
	else:
		?></ul><?
	endif;

else:
	if ($arResult["NavPageNomer"] > 1):
		if($arResult["bSavePage"]):
			?><a class="b-pagination__begin" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span class="b-pagination__begin__arr"><i class="ico i_crumbs-arr-prev-black"></i></span><?=GetMessage("b_nav_prev")?></a><?
		else:
			if ($arResult["NavPageNomer"] > 2):
				?><a class="b-pagination__begin" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span class="b-pagination__begin__arr"><i class="ico i_crumbs-arr-prev-black"></i></span><?=GetMessage("b_nav_prev")?></a><?
			else:
				?><a class="b-pagination__begin" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span class="b-pagination__begin__arr"><i class="ico i_crumbs-arr-prev-black"></i></span><?=GetMessage("b_nav_prev")?></a><?
			endif;
		endif;
		
		?><ul class="b-pagination__holder"><?
		if ($arResult["nStartPage"] > 1):
			?><li class="b-pagination__item"><?
			if($arResult["bSavePage"]):
				?><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1">1</a><?
			else:
				?><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a><?
			endif;
			?></li><?

			if ($arResult["nStartPage"] > 2):
				?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nStartPage"] / 2)?>">...</a></li><?
			endif;
		endif;
	else:
		?><ul class="b-pagination__holder"><?	
	endif;

	do
	{
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):
			?><li class="b-pagination__item b-pagination__item_selected"><b class="b-pagination__link"><?=$arResult["nStartPage"]?></b></li><?
		elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):
			?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a></li><?
		else:
			?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a></li><?
		endif;
		$arResult["nStartPage"]++;
	} while($arResult["nStartPage"] <= $arResult["nEndPage"]);
	
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):
		if ($arResult["nEndPage"] < $arResult["NavPageCount"]):
			if ($arResult["nEndPage"] < ($arResult["NavPageCount"] - 1)):
				?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=round($arResult["nEndPage"] + ($arResult["NavPageCount"] - $arResult["nEndPage"]) / 2)?>">...</a></li><?
			endif;
			?><li class="b-pagination__item"><a class="b-pagination__link" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a></li><?
		endif;
		?></ul><?
		?><a class="b-pagination__end" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=GetMessage("b_nav_next")?><span class="b-pagination__end__arr"><i class="ico i_crumbs-arr-black"></i></span></a><?
	else:
		?></ul><?
	endif;
endif;

if ($arResult["bShowAll"]):
	if ($arResult["NavShowAll"]):
		?><a class="b-pagination__all" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0"><?=GetMessage("nav_paged")?></a><?
	else:
		?><a class="b-pagination__all" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_all")?></a><?
	endif;
endif
?></div><?