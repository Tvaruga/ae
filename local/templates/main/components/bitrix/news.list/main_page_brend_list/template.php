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
<? if (!empty($arResult['LETTERS']) || !empty($arResult['ITEMS'])){?>
<div class="c-wrapper">
	<div class="b-group">
		<h2 class="b-group__title"><?=GetMessage('BREND_LIST_NAME');?></h2>
		<div class="b-group__holder">
			<div class="b-filter b-filter_main">
				<div class="b-filter__holder">
					<form action="<?=$arParams['BREND_PAGE_URL'];?>" method="GET" class="b-filter__form">
						<input class="b-filter__input" name="brend_name" value=""/>
						<a href="#" class="b-filter__clear js-form-clear"><i class="ico i_reset-gray"></i></a>
					</form>
					<script>
						jQuery(function(){
							$('.b-filter__clear').on('click', function()){
								$(this).parents('form').find('input').val('');
								return false;
							}
						});
					</script>
					<? if (!empty($arResult['LETTERS'])){?>
						<div class="b-filter__letters">
							<? foreach($arResult['LETTERS'] as $arLang){?>
								<ul class="b-filter__letters__list">
									<?foreach($arLang as $arLetter){?>
										<? if ($arLetter['EMPTY']=='Y'){?>
											<li class="b-filter__letters__item b-filter__letters__item_disabled">
											<span class="b-filter__letters__link"><?=$arLetter['LETTER'];?></span>
											</li>
										<?} else {?>
											<li class="b-filter__letters__item"><a href="<?=$arParams['BREND_PAGE_URL'];?>?SORT_LETTER=<?=$arLetter['VALUE'];?>" class="b-filter__letters__link"><?=$arLetter['LETTER'];?></a></li>
										<?}?>								
									<?}?>
								</ul>
							<?}?>
						</div>
					<?}?>
					
					<? if (!empty($arResult['ITEMS'])){ ?>
						<div class="b-filter__result">
							<? for($i=0; $i<=5; $i++){?>
								<? $arItem = $arResult['ITEMS'][$i];?>
								<div class="b-filter__result__item">
									<? if ($arItem['PICTURE']['src']!=''){?>
										<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="b-filter__result__link">
											<? if ($arItem['PICTURE']['width']<=$arItem['PREVIEW_PICTURE']['height']){?>
												<img src="<?=$arItem['PICTURE']['src'];?>" width="<?=$arItem['PICTURE']['width'];?>" alt="<?=$arItem['NAME'];?>" class="b-filter__result__image"/>
											<?} else {?>
												<img src="<?=$arItem['PICTURE']['src'];?>" height="<?=$arItem['PICTURE']['height'];?>" alt="<?=$arItem['NAME'];?>" class="b-filter__result__image"/>
											<?}?>
										</a>
									<? }?>
									
									<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="b-filter__result__title"><?=$arItem['NAME'];?></a>
									
									<? if ($arItem['PROPERTIES']['SITE']['VALUE']!=''){?>
										<a href="http://.<?=$arItem['PROPERTIES']['SITE']['VALUE']?>" class="b-filter__result__site" rel="nofollow" target="blank"><?=$arItem['PROPERTIES']['SITE']['VALUE']?></a>
									<? }?>
									
								</div>
							<?}?>
						</div>
					<?}?>
				</div>
			</div>
		</div>
	</div>
<a href="<?=$arParams['BREND_PAGE_URL'];?>" class="button m_t15"><?=GetMessage('ALL_BRANDS');?></a>
</div>
<?}?>

