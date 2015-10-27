<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}
if ($_REQUEST[$arParams['PROPERTY_CODE']]!='')
	
?>

<select name="<?=$arParams['PROPERTY_CODE'];?>" data-cont-class="select b-filter__fields__select" class="js-select" id="select-filter-<?=$arParams['BLOCK_ID'];?>">
	<option value='' <?if ($_REQUEST[$arParams['PROPERTY_CODE']]=='') print 'selected';?> rel="<?=$APPLICATION->GetCurPageParam('', array($arParams['PROPERTY_CODE']));?>">Все</option>
	<? foreach($arResult['rows'] as $arItem){?>
		<option value="<?=strtolower($arItem['UF_XML_ID']);?>" <?if ($_REQUEST[$arParams['PROPERTY_CODE']]==$arItem['UF_XML_ID']) print 'selected';?> rel="<?=$APPLICATION->GetCurPageParam($arParams['PROPERTY_CODE'].'='.strtolower($arItem['UF_XML_ID']), array($arParams['PROPERTY_CODE']));?>"><?=$arItem['UF_NAME'];?></option>
	<?}?>
</select>
<script>
	$("#select-filter-<?=$arParams['BLOCK_ID'];?>").on('change', function(){
	var $href=$(this).find(':selected').attr('rel');	
		window.location.href=$href;
	});
</script> 
