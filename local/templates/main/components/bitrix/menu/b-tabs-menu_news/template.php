<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)):
	?><div class="b-tabs-menu <?=empty($arParams['CLASS'])?'b-tabs-menu_news':$arParams['CLASS'];?>"><ul class="b-tabs-menu__holder"><?
	foreach($arResult as $arItem):
		if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1)
			continue;
		?><li class="b-tabs-menu__item<?if($arItem['SELECTED']) echo ' active';?>"><a href="<?=$arItem['LINK']?>" class="b-tabs-menu__link"><?=$arItem['TEXT']?></a></li><?
	endforeach;
	?></ul></div><?
endif;