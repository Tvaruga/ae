<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)):
	?><nav class="b-menu"><ul class="b-menu__holder"><?
	foreach($arResult as $arItem):
		if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1)
			continue;
		?><li class="b-menu__item<?if($arItem['SELECTED']) echo ' b-menu__item_selected';?>"><a href="<?=$arItem['LINK']?>" class="b-menu__link"><?=$arItem['TEXT']?></a></li><?
	endforeach;
	?></ul></nav><?
endif;