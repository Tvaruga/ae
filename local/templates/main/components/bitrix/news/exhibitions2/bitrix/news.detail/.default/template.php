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
		
		<? if ($arResult['PROPERTIES']['REGISTER_URL']['VALUE']!='' && $arResult['ACTIVE_REG']!='Y'){?>
			<div class="b-page-head__tools">
				<a href="<?=$arResult['PROPERTIES']['REGISTER_URL']['VALUE'];?>" class="button"><?=GetMessage('REGESTER_URL');?></a>
			</div>
		<?}?>
		
		<? if ($arResult['PROPERTIES']['INVITATION']['VALUE_XML_ID']=='Y' && $arResult['ACTIVE_REG']=='Y'){?>
			<div class="b-page-head__tools">
				<? if ($arResult['PROPERTIES']['INVITATION_TYPE']['VALUE_XML_ID']=='self'){?>
					<a href="#" class="button show_form"><i class="ico i_ticket-white m_r5"></i><?=GetMessage('INVITATION');?></a>
				<? } else {?>
					<? if ($arResult['PROPERTIES']['EXTERNAL_SITE_UR']['VALUE']!=''){?>
						<a href="<?=$arResult['PROPERTIES']['EXTERNAL_SITE_UR']['VALUE'];?>" class="button" target="blank"><i class="ico i_ticket-white m_r5"></i><?=GetMessage('INVITATION');?></a>
					<?}?>	
				<?}?>
				
			</div>	
		<?}?>
		
		

	</div>
	<div class="b-page-head__row m_t10">
		<? if ($arResult['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['DISPLAY_VALUE']!=''){?>
			<div class="b-page-head__info">
				<div class="b-page-head__info__item"><?=$arResult['DISPLAY_PROPERTIES']['EXIBITION_LOCATION']['DISPLAY_VALUE']?></div>
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
<div class="tabs-wrapper">
	<div class="b-tabs-menu m_t20">
		<ul class="b-tabs-menu__holder">
			<? if ($arResult['PRINT_PICTURE']['src']!='' || $arResult['DETAIL_TEXT']!=''){?>
				<li class="b-tabs-menu__item active"><a href="#tab-0" class="b-tabs-menu__link">О выставке</a></li>
			<?}?>
			<? if (!empty($arResult['DISPLAY_PROPERTIES']['COMPANIES']['DISPLAY_VALUE'])){?>
				 <li class="b-tabs-menu__item"><a href="#tab-1" class="b-tabs-menu__link">Участники</a></li>	
			<?}?>
			<? if ($arResult['PROPERTIES']['REPORT']['VALUE']['TEXT']!='' || !empty($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'])){?>   
			<li class="b-tabs-menu__item"><a href="#tab-2" class="b-tabs-menu__link">Отчет о выставке</a></li>
			<?}?>
		<li class="b-tabs-menu__item"><a href="#tab-3" class="b-tabs-menu__link">Вопрос организатору</a></li>
		</ul>
	</div>
	<? if ($arResult['PRINT_PICTURE']['src']!='' || $arResult['DETAIL_TEXT']!=''){?>
		<div class="b-exhibition m_t25">
			<? if ($arResult['PRINT_PICTURE']['src']!=''){?>
				<div class="image-wrapper">
					<?
					 if ($arResult['PRINT_PICTURE']['height']>$arResult['PRINT_PICTURE']['width']){?>
						<img src="<?=$arResult['PRINT_PICTURE']['src'];?>" alt="" height="<?=$arResult['PRINT_PICTURE']['height']?>"  class="b-exh-about__image"/>
					<?} else {?>
						<img src="<?=$arResult['PRINT_PICTURE']['src'];?>" alt="" width="<?=$arResult['PRINT_PICTURE']['width']?>"  class="b-exh-about__image"/>
					<?}?>
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
	<?}?>
	<? if (!empty($arResult['DISPLAY_PROPERTIES']['COMPANIES']['DISPLAY_VALUE'])){?>
		<div class="b-exhibition companies">
			<? foreach($arResult['DISPLAY_PROPERTIES']['COMPANIES']['DISPLAY_VALUE'] as $company){?>
				<div class="company"><?=$company;?></div>
			<?}?>
		</div>
	<?}?>
	<? if ($arResult['PROPERTIES']['REPORT']['VALUE']['TEXT']!='' || !empty($arResult['PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE'])){?>   
		<div class="b-exhibition">
			<? if (!empty($arResult['PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE'])){?>
				<div class="b-gallery-slider m_b20">
					<div class="b-gallery-slider__holder js-slick-slider-for-2">
						<? foreach($arResult['PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE'] as $arPhoto){?>
							<div class="b-gallery-slider__item">
								
								<? if (!empty($arPhoto['BIG_PHOTO'])){?>
									<? if ($arPhoto['BIG_PHOTO']['width']<=$arPhoto['BIG_PHOTO']['height']){?>
										<img src="<?=$arPhoto['BIG_PHOTO']['src'];?>" width="<?=$arPhoto['BIG_PHOTO']['width'];?>" alt="" class="b-gallery-slider__image"/>	
									<? } else {?>
										<img src="<?=$arPhoto['BIG_PHOTO']['src'];?>" height="<?=$arPhoto['BIG_PHOTO']['height'];?>" alt="" class="b-gallery-slider__image"/>
									<? }?>
								<? }?>
							</div>	
						<?}?>
					</div>
					<div class="b-gallery-slider__nav js-slick-slider-nav-2">
						<? foreach($arResult['PROPERTIES']['MORE_PHOTO']['DISPLAY_VALUE'] as $arPhoto){?>
							<div class="b-gallery-slider__nav__item">
								<? if (!empty($arPhoto['SMALL_PHOTO'])){?>
									<? if ($arPhoto['BIG_PHOTO']['width']<=$arPhoto['SMALL_PHOTO']['height']){?>
										<img src="<?=$arPhoto['SMALL_PHOTO']['src'];?>" width="<?=$arPhoto['SMALL_PHOTO']['width'];?>" alt="" class="b-gallery-slider__nav__image"/>	
									<? } else {?>
										<img src="<?=$arPhoto['SMALL_PHOTO']['src'];?>" height="<?=$arPhoto['SMALL_PHOTO']['height'];?>" alt="" class="b-gallery-slider__nav__image"/>
									<? }?>
								<? }?>
							</div>
						<? }?>
					</div>
				</div>
			<? }?>
			<? if ($arResult['PROPERTIES']['REPORT']['VALUE']['TEXT']!=''){?>
				<div class="b-exhibition__text">
					<? if ($arResult['PROPERTIES']['REPORT']['VALUE']['TYPE']=='html'){?>
						<?=$arResult['PROPERTIES']['REPORT']['~VALUE']['TEXT'];?>
					<? } else {?>
						<?=$arResult['PROPERTIES']['REPORT']['VALUE']['TEXT'];?>
					<? }?>
			 		<div class="c-separator-line m_t20"></div>
				</div>	
			<?}?>
		</div>
	<?}?>
	<? if ($arResult['PROPERTIES']['INVITATION']['VALUE_XML_ID']=='Y' && $arResult['PROPERTIES']['INVITATION_TYPE']['VALUE_XML_ID']=='self'){?>
		<div id="form-innovetion">
			<?$APPLICATION->IncludeComponent(
				"bitrix:form.result.new",
				"exhibitions_questions",
				Array(
					"CACHE_TIME" => "3600",
					"CACHE_TYPE" => "A",
					"CHAIN_ITEM_LINK" => "",
					"CHAIN_ITEM_TEXT" => "",
					"COMPONENT_TEMPLATE" => ".default",
					"EDIT_URL" => "",
					"IGNORE_CUSTOM_TEMPLATE" => "N",
					"LIST_URL" => "",
					"SEF_MODE" => "N",
					"SUCCESS_URL" => "",
					"USE_EXTENDED_ERRORS" => "N",
					"VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
					"WEB_FORM_ID" => "1"
				),
				$component
			);?>
			
		</div>
	<?}?>
	<div class="b-exhibition">
		<?$APPLICATION->IncludeComponent(
			"bitrix:iblock.element.add.form",
			"exhibitions_questions",
			Array(
				"COMPONENT_TEMPLATE" => "exhibitions_questions",
				"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
				"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
				"CUSTOM_TITLE_DETAIL_PICTURE" => "",
				"CUSTOM_TITLE_DETAIL_TEXT" => "",
				"CUSTOM_TITLE_IBLOCK_SECTION" => "",
				"CUSTOM_TITLE_NAME" => "Заголовок",
				"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
				"CUSTOM_TITLE_PREVIEW_TEXT" => "Вопрос",
				"CUSTOM_TITLE_TAGS" => "",
				"DEFAULT_INPUT_SIZE" => "30",
				"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
				"ELEMENT_ASSOC" => "CREATED_BY",
				"GROUPS" => array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16"),
				"IBLOCK_ID" => "10",
				"IBLOCK_TYPE" => "exhibitions",
				"LEVEL_LAST" => "Y",
				"LIST_URL" => "",
				"MAX_FILE_SIZE" => "0",
				"MAX_LEVELS" => "100000",
				"MAX_USER_ENTRIES" => "100000",
				"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
				"PROPERTY_CODES" => array("NAME", "PREVIEW_TEXT"),
				"PROPERTY_CODES_REQUIRED" => array(),
				"RESIZE_IMAGES" => "Y",
				"SEF_MODE" => "N",
				"STATUS" => "ANY",
				"STATUS_NEW" => "N",
				"USER_MESSAGE_ADD" => "Ваш вопрос принят к рассмотрению",
				"USER_MESSAGE_EDIT" => "Ваш вопрос принят к рассмотрению",
				"USE_CAPTCHA" => "N"
			),
		$component
		);?>
	</div>
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