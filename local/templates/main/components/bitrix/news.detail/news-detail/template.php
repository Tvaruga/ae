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
if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE']) || !empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE']) || !empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE']) || !empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'])):
	?><div class="b-person"><?
		if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE'])):
			$img = CFile::ResizeImageGet($arResult['PROPERTIES']['INTERVIEWED_PERSON_PHOTO']['VALUE'],array('width'=>77,'height'=>87),BX_RESIZE_IMAGE_PROPORTIONAL);
			if(empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE'])):
				?><img src="<?=$img['src']?>"<?if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'])) echo ' alt="'.$arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'].'"';?> class="b-person__image"><?
			else:
				?><a href="<?=$arResult['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE']?>"><img src="<?=$img['src']?>"<?if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'])) echo ' alt="'.$arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'].'"';?> class="b-person__image"></a><?
			endif;
		endif;
		?><div class="b-person__holder"><?
			if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'])){
				if(empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE']))
					echo '<div class="b-person__name">'.$arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'].'</div>';
				else
					echo '<a href="'.$arResult['PROPERTIES']['INTERVIEWED_PERSON_LINK']['VALUE'].'" class="b-person__name">'.$arResult['PROPERTIES']['INTERVIEWED_PERSON_FIO']['VALUE'].'</a>';
			}
			$position = '';
			if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE']))
				$position.=$arResult['PROPERTIES']['INTERVIEWED_PERSON_POSITION']['VALUE'];
			if(!empty($arResult['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'])){
				if(!empty($position))
					$position.=', ';
				$position.=$arResult['PROPERTIES']['INTERVIEWED_PERSON_COMPANY']['VALUE'];
			}
			if(!empty($position))
				echo '<div class="b-person__post">'.$position.'</div>';
		?></div>
	</div><?
endif;
?><div class="c-content m_t20"><?
	if($arParams['DISPLAY_NAME']!="N" && $arResult['NAME'])
		echo '<h2>'.$arResult['NAME'].'</h2>';

	if($arParams['DISPLAY_PICTURE']!="N" && (!empty($arResult['DETAIL_PICTURE'])||!empty($arResult['PREVIEW_PICTURE']))):
		if(empty($arResult['DETAIL_PICTURE']) && empty($arResult['PREVIEW_PICTURE']['SRC']))
			$arResult['PREVIEW_PICTURE']['SRC'] = CFile::GetPath($arResult['PREVIEW_PICTURE']);
		?><img src="<?=empty($arResult['DETAIL_PICTURE'])?$arResult['PREVIEW_PICTURE']['SRC']:$arResult['DETAIL_PICTURE']['SRC']?>" alt="<?=empty($arResult['DETAIL_PICTURE']['ALT'])?$arResult['NAME']:$arResult['DETAIL_PICTURE']['ALT']?>"<?if(!empty($arResult['DETAIL_PICTURE']['TITLE'])) echo ' title="'.$arResult['DETAIL_PICTURE']['TITLE'].'"';?> class="m_t20"><?
	endif;
	if($arResult['NAV_RESULT']) {
		if ($arParams['DISPLAY_TOP_PAGER'])
			echo $arResult['NAV_STRING'];
		echo $arResult['NAV_TEXT'];
		if ($arParams['DISPLAY_BOTTOM_PAGER'])
			echo $arResult['NAV_STRING'];
	}elseif(strlen($arResult['DETAIL_TEXT'])>0){
		echo $arResult['DETAIL_TEXT'];
	}else{
		echo $arResult['PREVIEW_TEXT'];
	}
	if($arParams['DISPLAY_DATE']!="N" && $arResult['DISPLAY_ACTIVE_FROM'])
		echo '<br><div class="b-page-head__date inline m_r20">'.strtolower($arResult['DISPLAY_ACTIVE_FROM']).'</div>';
	?><div class="b-page-head__stat m_b20 inline"><?
		if(in_array('SHOW_COUNTER',$arParams['FIELD_CODE'])):
			?><div class="b-page-head__stat__item"><i class="ico i_views-gray"></i><?=(int)$arResult['SHOW_COUNTER']?></div><?
		endif;
		if(isset($arResult['PROPERTIES']['BLOG_COMMENTS_CNT'])):
			?><div class="b-page-head__stat__item"><i class="ico i_bubble-gray"></i><?=(int)$arResult['PROPERTIES']['BLOG_COMMENTS_CNT']['VALUE']?></div><?
		endif;
		if(isset($arResult['PROPERTIES']['vote_count'])):
			?><div class="b-page-head__stat__item"><i class="ico i_like-gray"></i><?=(int)$arResult['PROPERTIES']['vote_count']['VALUE']?></div><?
		endif;
	?></div><?
	if(!empty($arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'])):
		?><div class="c-separator-line"></div><div class="b-page-tags"><!--noindex--><?
			$url =/* empty($arResult['SECTION_URL'])?*/$arResult['LIST_PAGE_URL']/*:$arResult['SECTION_URL']*/;
			foreach(is_array($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE'])?$arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']:array($arResult['DISPLAY_PROPERTIES']['TAGS']['DISPLAY_VALUE']) as $key=>$tag):
				?><a rel="nofollow" href="<?=$url?>?tags=<?=strtolower($arResult['DISPLAY_PROPERTIES']['TAGS']['VALUE'][$key])?>" class="b-page-tags__item"><?=$tag?></a><?
			endforeach;
		?><!--/noindex--></div><?
	endif;?>
	<div class="c-separator-line"></div><?


	//sim items
$templateData['simId'] = array();
$templateData['simCount'] = 2;
if(empty($arResult['PROPERTIES']['TAGS']['VALUE'])){
	if(\Bitrix\Main\Loader::includeModule('iblock')){
		$arFilter = array(
			'!ID'=>$arResult['ID'],
			'IBLOCK_ID'=>$arParams['IBLOCK_ID'],
			'ACTIVE'=>'Y',
			'ACTIVE_DATE'=>'Y',
			'SECTION_GLOBAL_ACTIVE'=>'Y',
			'SECTION_ID'=>$arResult['IBLOCK_SECTION_ID']
		);

		$db = CIBlockElement::GetList(
			array('ACTIVE_FROM'=>'DESC','ID'=>'DESC'),
			$arFilter,
			false,array('nTopCount'=>$templateData['simCount']),
			array('ID','IBLOCK_ID')
		);
		while($row = $db->Fetch())
			$templateData['simId'][] = $row['ID'];
	}
}elseif(\Bitrix\Main\Loader::includeModule('search')){
	$q = '';
	foreach($arResult['PROPERTIES']['TAGS']['VALUE'] as $val){
		if(!empty($q))
			$q.= ' | ';
		$q.='tag_search_'.$val;
	}

	$obSearch = new CSearch;
	$obSearch->Search(
		array(
			'QUERY' => $q,
			'SITE_ID' => SITE_ID,
			'MODULE_ID' => 'iblock',
			'PARAM2'=> $arResult['IBLOCK_ID'],
			'!ITEM_ID'=>$arResult['ID']
		),
		array(
			'RANK'=>'DESC'
		)
	);
	if ($obSearch->errorno==0){
		while($row = $obSearch->GetNext()){
			$templateData['simId'][]=$row['ITEM_ID'];
			if(count($templateData['simId'])>=$templateData['simCount'])
				break;
		}
	}
}