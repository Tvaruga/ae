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
<? 
if (empty($arResult['ITEMS']))
	return;
?>


<div class="row t-1 m_b10 m_t20" id="webinars">
	<?foreach($arResult["COLUMNS"] as $arColumn){?>
		<div class="cell s-6">
			<div class="c-list t-4">
			<?foreach($arColumn["ITEMS"] as $arItem){?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="c-list__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="c-list__holder">
						<? if ($arItem['DATA_PRINT']!=''){?>
							<div class="c-list__date"><?=$arItem['DATA_PRINT'];?></div>	
						<?}?>
						<? if ($arItem['TIME']!=''){?>
							<div class="c-list__time"><?=$arItem['TIME'];?></div>
						<?}?>
						<? if ($arItem['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE']!=''){?>
							<div class="c-list__place"><?=$arItem['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE'];?><span class="c-rub">a</span></div>	
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
						<? if ($arItem['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE']!=''){?>
							<div class="c-list__types"><a href="<?=$arItem['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE'];?>" target="blank"><i class="ico i_video-gray c-list__types__item"></i></a></div>
						<?}?>
					</div>
					<div class="title-container">
						<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="c-list__title"><?=$arItem['NAME'];?></a>
						<div class="c-list__item c-list__item_with-border">
							<div class="c-list__main-holder">
								<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="c-list__title"><?=$arItem['NAME'];?></a>
								<? if (strlen($arItem['PREVIEW_TEXT'])>0){?>
									<div class="c-list__text">
										<?if ($arItem['PREVIEW_TEXT_TYPE']=='html'){?>
											<?=$arItem['~PREVIEW_TEXT'];?>
										<?} else {?>
											<p><?=$arItem['PREVIEW_TEXT'];?></p>
										<?}?>
									</div>	
								<?}?>
								<? if ($arItem['PROPERTIES']['REGISTER_URL']['VALUE']!='' && $arItem['ACTIVE_REG']=='Y'){?>
									<a href="<?=$arItem['PROPERTIES']['REGISTER_URL']['VALUE'];?>" class="button m_t20"><?=GetMessage('REGESTER_URL');?></a>
								<?}?>
								<?if ($arItem['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE']!='' && $arItem['ACTIVE_REG']=='N'){ ?>
									<a href="<?=$arItem['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE'];?>" class="button m_t20"><?=GetMessage('WEBINAR_VIDEO_LINK');?></a>
								<?}?>
							</div>
					    </div>
					</div>
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
			<?}?>	
			</div>
		</div>
	<?}?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>