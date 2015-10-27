<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)):
	?><div class="b-group m_b20">
	<h2 class="b-group__title b-group__title_with-border"><?=GetMessage('SECTION_ACTIVITY_LABEL')?></h2>
	<div class="b-group__holder">
		<div class="b-categories-activity m_t15"><?
foreach($arResult as $arItem):
	if($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1) 
		continue;
	?><a href="<?=$arItem['LINK']?>" class="b-categories-activity__item<?if($arItem['SELECTED']) echo ' b-categories-activity__item_selected';?>">
		<div style="width: <?=!empty($arItem['PARAMS']['ITEM_QUANTITY'])&&!empty($arItem['PARAMS']['USER_ACTIVITY'])?round((int)$arItem['PARAMS']['USER_ACTIVITY']/(int)$arItem['PARAMS']['ITEM_QUANTITY']*100):0?>%" class="b-categories-activity__bar"></div>
		<div class="b-categories-activity__holder">
			<span class="b-categories-activity__title"><?=$arItem['TEXT']?></span><?
			if(!empty($arItem['PARAMS']['ITEM_QUANTITY']))
				echo '<span class="b-categories-activity__count">'.$arItem['PARAMS']['ITEM_QUANTITY'].'</span>';
		?></div>
	</a><?
endforeach;
	?></div></div></div><?
endif;