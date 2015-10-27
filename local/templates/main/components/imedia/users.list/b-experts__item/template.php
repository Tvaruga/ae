<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();
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

if(!empty($arResult['USERS'])){
	if($arParams['DISPLAY_TOP_PAGER'])
		echo $arResult['NAV_STRING'];

	?><div class="row t-1"><?
	foreach($arResult['USERS'] as $key=>$user){
		if($key!=0 && $key%2==0)
			echo '</div><div class="row t-1">';
		?><div class="cell s-6 m_t15">
			<div class="b-experts__item">
				<div class="b-experts__header">
					<a href="/community/experts/<?=$user['ID']?>/" class="clearfix"><?
						if(!empty($user['PERSONAL_PHOTO'])):
							$img = CFile::ResizeImageGet($user['PERSONAL_PHOTO'],array('width'=>69,'height'=>69),BX_RESIZE_IMAGE_EXACT);
							?><img src="<?=$img['src']?>" alt="<?=$user['FULL_NAME']?>" class="b-experts__image"><?
						endif;
						?><div class="b-experts__info">
							<div class="b-experts__name"><?=$user['FULL_NAME']?></div><?
							if(!empty($user['POST']))
								echo '<div class="b-experts__post">'.$user['POST'].'</div>';
						?></div>
					</a>
					<!--
					<div class="b-experts__sub-count m_t15"><i class="ico i_like-green m_r5"></i><?=GetMessage('EXPERT_LIKE_QUANTITY_LABEL')?> <span class="b-experts__num"><?=$user['LIKE_QUANTITY']?></span></div>
					-->
				</div><?
				if(!empty($user['WORKS_COUNT'])):
					?><div class="b-experts__holder">
						<div class="b-experts__row">
							<div class="b-experts__left">
								<div class="b-experts__sub-count"><i class="ico i_blogs-small-green m_r5"></i><?=GetMessage('EXPERT_WORKS_COUNT_LABEL')?> <span class="b-experts__num"><?=(int)$user['WORKS_COUNT'];?></span></div>
								<!--<div class="b-experts__sub-count"><i class="ico i_person-green m_r5"></i>подписчиков <span class="b-experts__num">14</span></div>-->
							</div>
							<!--
							<div class="b-experts__right"><a href="#" class="button m_b10">подписаться</a></div>
							-->
						</div><?
						if(!empty($user['LATEST_WORK'])):
							?><div class="b-experts__label"><?=GetMessage('EXPERT_LATEST_WORK_LABEL')?></div><div class="b-experts__text"><a href="<?=$user['LATEST_WORK']['DETAIL_PAGE_URL']?>"><?=$user['LATEST_WORK']['NAME']?></a></div><?
						endif;
					?></div><?
				endif;
				if(!empty($user['QUESTION_COUNT'])):
					/*!!!*/
					?><div class="b-experts__holder">
						<div class="b-experts__row">
							<div class="b-experts__left">
								<div class="b-experts__sub-count"><i class="ico i_question-small-green m_r5"></i><?=GetMessage('EXPERT_QUESTIONS_LABEL')?> <span class="b-community-categories__num"><?=$user['QUESTION_COUNT']?></span></div>
								<!--<div class="b-experts__sub-count"><i class="ico i_person-green m_r5"></i>подписчиков <span class="b-community-categories__num">14</span></div>-->
							</div>
							<!--
							<div class="b-experts__right"><a href="#" class="button m_b10">подписаться</a></div>
							-->
						</div><?
						if(!empty($user['LATEST_QUESTION'])):
							?><div class="b-experts__label"><?=GetMessage('EXPERT_LATEST_WORK_LABEL')?></div><div class="b-experts__text"><a href="<?=$user['LATEST_QUESTION']['DETAIL_PAGE_URL']?>"><?=$user['LATEST_QUESTION']['NAME']?></a></div><?
						endif;
					?></div><?
				endif;?>
			</div>
		</div><?
	}
	?></div><?

	if($arParams['DISPLAY_BOTTOM_PAGER'])
		echo $arResult['NAV_STRING'];
}

