<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)):
	?><div class="b-group m_b20"><?
	if(!empty($arParams['TITLE']))
		echo '<h2 class="b-group__title b-group__title_with-border">'.$arParams['TITLE'].'</h2>';
	?><div class="b-group__holder"><div class="b-categories-filter m_t15"><?
foreach($arResult as $arItem):
	if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1) 
		continue;
	?><a href="<?=$arItem['LINK']?>" class="b-categories-filter__item<?if($arItem['SELECTED']) echo ' b-categories-filter__item_selected';?>"><span class="b-categories-filter__title"><?=$arItem['TEXT']?></span><?
		if(!empty($arItem['PARAMS']['ITEM_QUANTITY']))
			echo '<span class="b-categories-filter__count">'.$arItem['PARAMS']['ITEM_QUANTITY'].'</span>';
	?></a><?
endforeach;
	?></div></div></div><?
endif;