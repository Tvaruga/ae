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

if ($arParams['IBLOCK_ID']==2)
	$dataCode = 'START_DATA';
elseif($arParams['IBLOCK_ID']==8)
	$dataCode = 'START_DATE';
?>
<? 
if (empty($arResult['ITEMS']))
	return;
?>


<div class="b-group m_b30">
	<? if ($arParams['BLOCK_NAME']!=''){?>
		<h2 class="b-group__title"><?=$arParams['BLOCK_NAME'];?></h2>
	<?}?>
	
	<div class="b-group__holder">
		<?foreach($arResult['ITEMS'] as $arItem){?>			
		<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="c-list t-4"  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="c-list__item">
					<div class="c-list__holder">
						<? if ($arItem['DATA_PRINT']!=''){?>
							<div class="c-list__date"><?=$arItem['DATA_PRINT'];?></div>	
						<?}?>
						
						<? if ($arItem['DISPLAY_PROPERTIES']['CITY']['VALUE']!=''){?>
							<div class="c-list__place"><?=$arItem['DISPLAY_PROPERTIES']['CITY']['DISPLAY_VALUE'];?></div>	
						<?}?>
					</div>
					
					<? if ($arItem['PRINT_PICTURE']['src']!=''){?>
						<div class="image-wrapper">
							<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="c-list__title">
								<?
								 if ($arItem['PRINT_PICTURE']['height']>$arItem['PRINT_PICTURE']['width']){?>
									<img src="<?=$arItem['PRINT_PICTURE']['src'];?>" alt="" height="<?=$arItem['PRINT_PICTURE']['height']?>"/>
								<?} else {?>
									<img src="<?=$arItem['PRINT_PICTURE']['src'];?>" alt="" width="<?=$arItem['PRINT_PICTURE']['width']?>"/>
								<?}?>
							</a>
						</div>
					<?}?>
					
					<div class="c-list__info">
						<div class="c-list__stat">
							<? if ($arItem['SHOW_COUNTER']!=''){?>
								<div class="c-list__stat__item"><i class="ico i_views-gray"></i><?=$arItem['SHOW_COUNTER'];?></div>	
							<?}?>
							<? if ($arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']!=''){?>
								<div class="c-list__stat__item"><i class="ico i_bubble-gray"></i><?=$arItem['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];?></div>
							<?}?>
							<? if ($arItem['PROPERTIES']['vote_count']['VALUE']!=''){?>
								<div class="c-list__stat__item"><i class="ico i_like-gray"></i><?=$arItem['PROPERTIES']['LIKE_QUANTITY']['VALUE'];?></div>
							<?}?>
						</div>
						<div class="c-list__types"></div>
					</div>
					<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="c-list__title"><?=$arItem['NAME'];?></a>
					
					<? if (!empty($arItem['PROPERTIES']['SPEAKER']['DISPLAY_VALUE'])){?>
						<div class="c-list__author">
							<? if ($arItem['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['NAME']!=''){?>
								<div class="c-list__name"><?=$arItem['PROPERTIES']['SPEAKER']['NAME'];?>: <b><?=$arItem['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['NAME'];?></b></div>	
							<?}?>
							<? if ($arItem['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['WORK_POSITION']!=''){?>
								<div class="c-list__post"><?=$arItem['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['WORK_POSITION'];?></div>
							<?}?>
						</div>	
					<?}?>
					
					<? if ($arItem['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']){?>
						<div class="c-list__tags">
							<? if (is_array($arItem['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']) && !empty($arItem['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'])){?>
								<? foreach($arItem['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'] as $keyTag=>$tag){?>
									<a href="<?=$arItem['LIST_PAGE_URL'].'?tags='.strtolower($arItem['DISPLAY_PROPERTIES']['TAGS']['VALUE'][$keyTag]);?>" class="c-list__tags__item"><?=$tag;?></a>
								<?}?>
							<?} else {?>
								<? $tag = $arItem['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'];?>
								<a href="<?=$arItem['LIST_PAGE_URL'].'?tags='.$arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'];?>" class="c-list__tags__item"><?=$tag;?></a>
							<?}?>
						</div>	
					<?}?>
				</div>
			</div>
		<?}?>
	</div>
</div>