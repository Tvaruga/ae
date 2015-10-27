<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}
?>

<div class="b-group m_b30">
	<h2 class="b-group__title b-group__title_with-border">Темы</h2>
	<div class="b-group__holder">
		<div class="b-categories-filter m_t15">
			<? foreach($arResult['rows'] as $arItem){?>
				 <a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('CURSE='.$arItem['UF_XML_ID'], array('CURSE'));?>" class="b-categories-filter__item <? if ($_REQUEST['CURSE']==$arItem['UF_XML_ID']) print 'b-categories-filter__item_selected';?>">
			      	<span class="b-categories-filter__title"><?=$arItem['UF_NAME'];?></span>
			     </a>
			<?}?>
		</div>
	</div>
</div>
