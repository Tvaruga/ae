<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}
?>
<div class="b-page-head__tools">
	<div class="b-page-tags b-page-tags_no-padding"><!--noindex-->
		<? $arSelected = explode(',', $_REQUEST['tags']);?>
		<? foreach($arResult['rows'] as $arItem){?>
			<? $url = $APPLICATION->GetCurPageParam('tags='.$arItem['UF_XML_ID'], array('tags'));?>
			<? 
				$selected = false;
				if (in_array($arItem['UF_XML_ID'], $arSelected))
					$selected=true;
			?>
			<a rel="nofollow" href="<?=$url?>" class="b-page-tags__item<?if($selected) echo ' b-page-tags__item_selected';?>"><?=$arItem['UF_NAME']?></a>
		<?}?>
	</div>
</div>
