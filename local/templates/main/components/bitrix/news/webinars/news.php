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
$this->setFrameMode(true);
?>

<?if($arParams["USE_RSS"]=="Y"):?>
	<?
	if(method_exists($APPLICATION, 'addheadstring'))
		$APPLICATION->AddHeadString('<link rel="alternate" type="application/rss+xml" title="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" href="'.$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"].'" />');
	?>
	<a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["rss"]?>" title="rss" target="_self"><img alt="RSS" src="<?=$templateFolder?>/images/gif-light/feed-icon-16x16.gif" border="0" align="right" /></a>
<?endif?>

<?if($arParams["USE_SEARCH"]=="Y"):?>
<?=GetMessage("SEARCH_LABEL")?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	"flat",
	Array(
		"PAGE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["search"]
	),
	$component
);?>
<br />
<?endif?>
<?if($arParams['USE_FILTER']=='Y'):
	$this->SetViewTarget('pre_page-head__title');
	?>
	<?$APPLICATION->IncludeComponent("bitrix:highloadblock.list",
			"tags-list", Array(
			"BLOCK_ID" => "3",	// ID инфоблока
			"COMPONENT_TEMPLATE" => "tags-list",
			"DETAIL_URL" => "",	// Путь к странице просмотра записи
		),
		false
	);?>
	<?$this->EndViewTarget('pre_page-head__title');?>
<div class="b-filter">
	<form name="filter">
		<div class="b-filter__title"><?=GetMessage('WEBINAR_SEARCH');?></div>
		<div class="b-filter__holder">
			<div class="b-filter__search-field">
				<label class="b-filter__input-label"><?=GetMessage('WEBINAR_SEARCH_NAME');?></label>
				<input placeholder="Название вебинара" name="NAME" value="<?=$_REQUEST['NAME'];?>" class="b-filter__input">
			</div>
			<a href="#" class="b-filter__clear js-form-clear"><i class="ico i_reset-gray"></i></a>
			<div class="b-filter__fields m_t20">
				<div class="b-filter__fields__item b-filter__fields__item_col-1">
					<?$APPLICATION->IncludeComponent("bitrix:highloadblock.list", "filter_select", Array(
							"BLOCK_ID" => "7",	// ID инфоблока
							"COMPONENT_TEMPLATE" => "curse-list",
							"DETAIL_URL" => "",	// Путь к странице просмотра записи
							"PROPERTY_CODE"=>'COUNTRY'
						),
						false
					);?>
				</div>
				<div class="b-filter__fields__item b-filter__fields__item_col-2">
					<?$APPLICATION->IncludeComponent("bitrix:highloadblock.list", "filter_select", Array(
							"BLOCK_ID" => "8",	// ID инфоблока
							"COMPONENT_TEMPLATE" => "curse-list",
							"DETAIL_URL" => "",	// Путь к странице просмотра записи
							"PROPERTY_CODE"=>'CITIES'
						),
						false
					);?>
				</div>
				<div class="b-filter__fields__item b-filter__fields__item_col-3">
					<? 
					if ($_REQUEST['SORT_DIR']!='')
						$sort_dir=$_REQUEST['SORT_DIR'];
					else
						$sort_dir=$arParams["SORT_ORDER1"];
					?>
					<div class="b-filter__sort">
						<div class="b-filter__sort__label"><?=GetMessage('WEBINAR_SORT_BY');?></div>
						<div class="b-filter__sort__holder">
						<a href="<?=$APPLICATION->GetCurPageParam('SORT_DIR=ASC', array('SORT_DIR'));?>" class="b-filter__sort__btn <?if ($sort_dir=='ASC') print 'b-filter__sort__btn_selected';?>"><i class="ico i_arr-up-gray"></i></a>
						<a href="<?=$APPLICATION->GetCurPageParam('SORT_DIR=DESC', array('SORT_DIR'));?>" class="b-filter__sort__btn <?if ($sort_dir=='DESC') print 'b-filter__sort__btn_selected';?>"><i class="ico i_arr-down-gray"></i></a></div>
					</div>
				</div>
				<div class="b-filter__fields__item b-filter__fields__item_col-4">
					<? if ($_REQUEST['SORT_BY']!='')
						$sort_by = $_REQUEST['SORT_BY'];
					else
						$sort_by = $arParams["SORT_BY1"];
					?>
					<select name="SORT_BY" data-cont-class="select b-filter__fields__select" class="js-select" id="select-filter-sort">
						<option value="PROPERTY_RAITING" rel="<?=$APPLICATION->GetCurPageParam('SORT_BY=PROPERTY_RAITING', array('SORT_BY'));?>" <? if ($sort_by=='PROPERTY_RAITING') print 'selected';?>><?=GetMessage('WEBINAR_SORT_BY_RAITING');?></option>
						<option value="SHOW_COUNTER" rel="<?=$APPLICATION->GetCurPageParam('SORT_BY=SHOW_COUNTER', array('SORT_BY'));?>" <? if ($sort_by=='SHOW_COUNTER') print 'selected';?>><?=GetMessage('WEBINAR_SORT_BY_SHOW_COUNTER');?></option>
						
						<option value="PROPERTY_START_DATA" rel="<?=$APPLICATION->GetCurPageParam('SORT_BY=PROPERTY_START_DATA', array('SORT_BY'));?>" <? if ($sort_by=='PROPERTY_START_DATA' ) print 'selected';?>><?=GetMessage('WEBINAR_SORT_BY_PROPERTY_START_DATA');?></option>
					</select>
					<script>
						$("#select-filter-sort").on('change', function(){
						var $href=$(this).find(':selected').attr('rel');	
							window.location.href=$href;
						});
					</script> 
				</div> 
				<div class="b-filter__fields__item b-filter__fields__item_col-6">
					<label class="checkbox b-filter__checkbox">
						<input type="checkbox" name="CHECK_DATES" value="Y" <? if ($_REQUEST['CHECK_DATES']=='Y') print 'checked';?> class="e-checkup" id="close-check"/><?=GetMessage('WEBINAR_SHOW_PAST_WEBINARS');?>
					</label>
					
					<script>
						$("input[name=CHECK_DATES]").click(function(){
							if ($(this).is(':checked')){
								var $href="<?=$APPLICATION->GetCurPageParam('CHECK_DATES=Y', array('CHECK_DATES'));?>";
							} else {
								var $href="<?=$APPLICATION->GetCurPageParam('', array('CHECK_DATES'));?>";
							}
							window.location.href=$href;
						}); 
					</script>
				</div>
			</div>
		</div>
	</form>
</div>

<?endif;
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"NEWS_COUNT" => $arParams["NEWS_COUNT"],
		"SORT_BY1" => $sort_by,
		"SORT_ORDER1" => $sort_dir,
		"SORT_BY2" => $arParams["SORT_BY2"],
		"SORT_ORDER2" => $arParams["SORT_ORDER2"],
		"FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
		"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["detail"],
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
		"IBLOCK_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"],
		"DISPLAY_PANEL" => $arParams["DISPLAY_PANEL"],
		"SET_TITLE" => $arParams["SET_TITLE"],
		"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
		"MESSAGE_404" => $arParams["MESSAGE_404"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],
		"SHOW_404" => $arParams["SHOW_404"],
		"FILE_404" => $arParams["FILE_404"],
		"INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_FILTER" => $arParams["CACHE_FILTER"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
		"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
		"PAGER_TITLE" => $arParams["PAGER_TITLE"],
		"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
		"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
		"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
		"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
		"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
		"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
		"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
		"DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
		"PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
		"ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
		"USE_PERMISSIONS" => $arParams["USE_PERMISSIONS"],
		"GROUP_PERMISSIONS" => $arParams["GROUP_PERMISSIONS"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
		"CHECK_DATES" => $arParams["CHECK_DATES"],
	),
	$component
);?>
