<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult)):
	?><div class="b-menu-category"><?
	if(!empty($arParams['ROOT_MENU_TYPE'])){
		$types = GetMenuTypes();
		if(!empty($types[$arParams['ROOT_MENU_TYPE']])):
			?><div class="b-menu-category__title"><?
			if(!empty($arParams['TITLE_CLASS']))
				echo '<i class="ico '.$arParams['TITLE_CLASS'].'"></i>';
			echo $types[$arParams['ROOT_MENU_TYPE']];
			?></div><?
		endif;
	}?><ul class="b-menu-category__holder"><?
$previousLevel = 0;
foreach($arResult as $arItem):
	if ($previousLevel && $arItem['DEPTH_LEVEL']==1 && $previousLevel>1)
		echo '</li>';

	if ($arItem['IS_PARENT']):
		if ($arItem['DEPTH_LEVEL'] == 1):
			?><li class="b-menu-category__item<?if(!empty($arParams['LINK_CLASS'])) echo ' '.$arParams['LINK_CLASS']; if($arItem['SELECTED']) echo ' b-menu-category__item_selected';?>"><a href="<?=$arItem['LINK']?>" class="b-menu-category__link"><?=$arItem['TEXT']?></a> <?
		else:
			if($previousLevel!=1)
				echo ' | ';
			?><a href="<?=$arItem['LINK']?>" class="b-menu-category__link"><?=$arItem['TEXT']?></a><?
		endif;
	else:
		if ($arItem['PERMISSION'] > "D"):
			if ($arItem['DEPTH_LEVEL'] == 1):
				?><li class="b-menu-category__item<?if(!empty($arParams['LINK_CLASS'])) echo ' '.$arParams['LINK_CLASS']; if($arItem['SELECTED']) echo ' b-menu-category__item_selected';?>"><a href="<?=$arItem['LINK']?>" class="b-menu-category__link"><?=$arItem['TEXT']?></a></li><?
			else:
				if($previousLevel!=1)
					echo ' | ';
				?><a href="<?=$arItem['LINK']?>" class="b-menu-category__link"><?=$arItem['TEXT']?></a><?
			endif;
		else:
			if ($arItem['DEPTH_LEVEL'] == 1):
				?><li class="b-menu-category__item<?if(!empty($arParams['LINK_CLASS'])) echo ' '.$arParams['LINK_CLASS']; if($arItem['SELECTED']) echo ' b-menu-category__item_selected';?>"><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" class="b-menu-category__link"><?=$arItem['TEXT']?></a></li><?
			else:
				if($previousLevel!=1)
					echo ' | ';
				?><a href="" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>" class="b-menu-category__link"><?=$arItem['TEXT']?></a><?
			endif;
		endif;
	endif;
	$previousLevel = $arItem['DEPTH_LEVEL'];
endforeach;
	if ($previousLevel > 1)
		echo '</li>';
	?></ul></div><?
endif;