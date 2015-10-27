<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>
 <form class="b-main-search__form" action="<?=$arResult['FORM_ACTION']?>">
    <input type="text" name="q" value=""  placeholder="Поиск"  class="b-main-search__input"/>
    <button class="b-main-search__button"><i class="ico i_search"></i></button>
    <script>
    	$('.b-main-search__button').on('click', function(){
    		$(this).parents('form').submit();	
    	});
    </script>
    <? if ($arResult['IBLCOKS']){?>
	    <div class="b-main-search__select-holder">
	        <select name="iblock_id" data-cont-class="b-main-search__select" class="js-select">
	            <option <?if ($_REQUEST['iblock_id']=='') print 'selected';?>><?=GetMessage('EVERYWHERE');?></option>
	            <? foreach($arResult['IBLCOKS'] as $key=>$arBlock){?>
					<option value="<?=$key;?>" <?if ($_REQUEST['iblock_id']==$key) print 'selected';?>><?=$arBlock;?></option>	
				<?}?>
	        </select>
	    </div>		
	<?}?>
</form>
