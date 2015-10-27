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
if(!empty($arResult['ITEMS'])):
	?><div class="b-page-head__tools"><?
		foreach($arResult['ITEMS'] as $arItem):
			if(empty($arItem['VALUES']))
				continue;
			$propCode = strtolower($arItem['CODE']);
			$arCurr = array();
			if(!empty($_REQUEST[$propCode]))
				$arCurr = explode(',',$_REQUEST[$propCode]);

			?><div class="b-page-tags b-page-tags_no-padding"><!--noindex--><?
				foreach($arItem['VALUES'] as $val):
					$url = $arCurr;
					$selected = !empty($arCurr) && in_array($val['URL_ID'],$arCurr);
					if($selected  && ($key = array_search($val['URL_ID'], $url)) !== false)
						unset($url[$key]);
					else
						$url[]=$val['URL_ID'];
					if(!empty($url))
						$url = $propCode.'='.implode(',',$url);
					else
						$url = '';

					if(empty($arParams['BASE_URL']))
						$url = $GLOBALS['APPLICATION']->GetCurPageParam($url, array('clear_cache','back_url_pub','back_url_abmit',$propCode),false);
					else
						$url = $arParams['BASE_URL'].(!empty($url)&&strpos($url,'?')===false?'?':'').$url;

					?><a rel="nofollow" href="<?=$url?>" class="b-page-tags__item <?if($selected) echo ' b-page-tags__item_selected';?>"><?=$val['VALUE']?></a><?
				endforeach;
			?><!--/noindex--></div><?
		endforeach;
	?></div><?
endif;