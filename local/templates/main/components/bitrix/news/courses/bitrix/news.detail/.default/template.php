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

<div class="b-page-head b-page-head_event">
	<div class="b-page-head__row">
		<? if ($arResult['DATA_PRINT']!=''){?>
			<div class="b-page-head__date"><?=$arResult['DATA_PRINT'];?></div>	
		<?}?>
		<h1 class="b-page-head__title"><?=$arResult['NAME'];?></h1>
		
		<? if ($arResult['PROPERTIES']['REGISTER_URL']['VALUE']!='' && $arResult['ACTIVE_REG']=='Y'){?>
			<div class="b-page-head__tools">
				<a href="<?=$arResult['PROPERTIES']['REGISTER_URL']['VALUE'];?>" class="button"><?=GetMessage('REGESTER_URL');?></a>
			</div>
		<?}?>
		<?if ($arResult['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE']!='' && $arResult['ACTIVE_REG']=='N'){ ?>
			<div class="b-page-head__tools">
				<a href="<?=$arResult['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE'];?>" class="button"><?=GetMessage('WEBINAR_VIDEO_LINK');?></a>
			</div>
		<?}?>
	</div>
	<div class="b-page-head__row m_t10">
		<? if ($arResult['TIME']!=''){?>
			<div class="b-page-head__info">
				<div class="b-page-head__info__item"><?=GetMessage('START_AT');?><b><?=$arResult['TIME'];?></b></div>
			</div>	
		<?}?>
		<div class="b-page-head__tools">
			<div class="b-page-head__stat">
				<? if ($arResult['SHOW_COUNTER']!=''){?>
					<div class="b-page-head__stat__item"><i class="ico i_views-gray"></i><?=$arResult['SHOW_COUNTER'];?></div>
				<?}?>
				<? if ($arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE']!=''){?>
					<div class="b-page-head__stat__item"><i class="ico i_bubble-gray"></i><?=$arResult['PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];?></div>
				<?}?>
				<? if ($arResult['PROPERTIES']['LIKE_QUANTITY']['VALUE']!=''){?>
					<div class="b-page-head__stat__item"><i class="ico i_like-gray"></i><?=$arResult['PROPERTIES']['vote_count']['VALUE'];?></div>
				<?}?>
			</div>
		</div>
	</div>
</div>
<div class="c-separator-line m_t25"></div>

<? if ($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']){?>
	<div class="b-page-tags">
		<? if (is_array($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']) && !empty($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'])){?>
			<? foreach($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'] as $keyTag=>$tag){?>
				<a href="<?=$arResult['LIST_PAGE_URL'].'?tags='.strtolower($arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'][$keyTag]);?>" class="c-list__tags__item"><?=$tag;?></a>
			<?}?>
		<? } else {?>
			<? $tag = $arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'];?>
			<a href="<?=$arResult['LIST_PAGE_URL'].'?tags='.$arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'];?>" class="c-list__tags__item"><?=$tag;?></a>
		<? }?>
	</div>
	
	 <div class="c-separator-line"></div>	
<?}?>
 


<div class="b-exhibition m_t25">
	<? if ($arResult['PRINT_PICTURE']['src']!=''){?>
		<div class="image-wrapper">
			<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="c-list__title">
				<?
				 if ($arResult['PRINT_PICTURE']['height']>$arResult['PRINT_PICTURE']['width']){?>
					<img src="<?=$arResult['PRINT_PICTURE']['src'];?>" alt="" height="<?=$arResult['PRINT_PICTURE']['height']?>"  class="b-exh-about__image"/>
				<?} else {?>
					<img src="<?=$arResult['PRINT_PICTURE']['src'];?>" alt="" width="<?=$arResult['PRINT_PICTURE']['width']?>"  class="b-exh-about__image"/>
				<?}?>
			</a>
		</div>
	<?}?>
	<? if ($arResult['DETAIL_TEXT']!=''){?>
		<div class="b-exhibition__text">
			<?if ($arResult['DETAIL_TEXT_TYPE']=='html'){?>
				<?=$arResult['~DETAIL_TEXT'];?>
			<?} else {?>
				<p><?=$arResult['DETAIL_TEXT'];?></p>
			<?}?>
			<div class="c-separator-line m_t20"></div>
		</div>	
	<?} elseif ($arResult['PREVIEW_TEXT']!=''){?>
		<div class="b-exhibition__text">
			<?if ($arResult['PREVIEW_TEXT_TYPE']=='html'){?>
				<?=$arResult['~PREVIEW_TEXT'];?>
			<?} else {?>
				<p><?=$arResult['PREVIEW_TEXT'];?></p>
			<?}?>
			<div class="c-separator-line m_t20"></div>
		</div>		
	<?}?>
</div>

<?$this->SetViewTarget('detail_webinar_info_header');?>
<? if (!empty($arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']) || $arResult['PROPERTIES']['DURATION']['VALUE']!=''){?>
	<div class="b-right-sidebar">
		<div class="b-group">
			<h2 class="b-group__title b-group__title_with-border"><?=GetMessage('WEBINAR_INFO');?></h2>
			<div class="b-group__holder">
				<div class="b-right-info m_t20">
					<? if (!empty($arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE'])){?>
						<div class="b-right-info__item">
							<?if ($arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['NAME']!=''){?>
								<div class="b-right-info__label"><?=GetMessage('WEBINAR_READER');?></div><a href="#" class="b-right-info__name link"><?=$arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['NAME'];?></a>	
							<?}?>
							<?if ($arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['WORK_POSITION']!=''){?>
								<div class="b-right-info__post"><?=$arResult['PROPERTIES']['SPEAKER']['DISPLAY_VALUE']['WORK_POSITION'];?></div>
							<?}?>
						</div>
					<? }?>
					<?if ($arResult['PROPERTIES']['DURATION']['VALUE']!=''){?>	
						<div class="b-right-info__item">
							<div class="b-right-info__label"><?=GetMessage('WEBINAR_TIME');?></div>
							<div class="b-right-info__text"><?=$arResult['PROPERTIES']['DURATION']['VALUE'];?></div>
						</div>
					<?}?>
					<? /**
					   * 
					   * Нет в ТЗ данного блока
					   * 
					   */
					/*   
					<div class="b-right-info__item">
						<div class="b-right-info__text">25 участников</div>
					</div>
					*/?>
				</div>
			</div>
		</div>
	</div>
<?}?>
<? if ($arResult['PROPERTIES']['PRICE']['VALUE']!=''){?>
	<div class="b-right-sidebar b-right-sidebar_blue">							
		<div class="b-right-cost">
			<div class="b-right-cost__label"><?=GetMessage('WEBINAR_PRICE');?></div>
			<div class="b-right-cost__val">
			<?if ($arResult['PROPERTIES']['PRICE']['VALUE']>0){?>
				<?=number_format($arResult['PROPERTIES']['PRICE']['VALUE'], 0, '.', ' ');?><span class="c-rub">a</span>
			<? } else {?>
				Бесплатно
			<? }?>
			</div>
		</div>
	</div>
<?}?>
<? if ($arResult['PROPERTIES']['REGISTER_URL']['VALUE']!='' && $arResult['ACTIVE_REG']=='Y'){?>
	<a href="<?=$arResult['PROPERTIES']['REGISTER_URL']['VALUE'];?>" class="button block"><?=GetMessage('REGESTER_URL');?></a>
<?}?>
<?if ($arResult['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE']!='' && $arResult['ACTIVE_REG']=='N'){ ?>
	<a href="<?=$arResult['PROPERTIES']['WEBINAR_VIDEO_LINK']['VALUE'];?>" class="button block"><?=GetMessage('WEBINAR_VIDEO_LINK');?></a>
<?}?>
<?$this->EndViewTarget();?> 