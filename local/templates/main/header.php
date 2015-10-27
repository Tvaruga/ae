<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
global $USER;
$curPage = $APPLICATION->GetCurPage(false);
$dirProps = $APPLICATION->GetDirPropertyList();
$arCurPage = explode($curPage);
if ($arCurPage[1]=='webinars' && $arCurPage[2]!='')
	$dirProps['WIDE_TITLE'] = true;
	
if ($arCurPage[1]=='courses' && $arCurPage[2]!='')
	$dirProps['WIDE_TITLE'] = true;	 
	
if ($arCurPage[1]=='exhibitions' && $arCurPage[2]!='')
	$dirProps['WIDE_TITLE'] = true;	 
	
$is404 = defined('ERROR_404');?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title><?$APPLICATION->ShowTitle()?></title>
        <meta name="viewport" content="width=device-width">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

        <?
        \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style.css');
        \Bitrix\Main\Page\Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/extra.css');
        \Bitrix\Main\Page\Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/main.js');

        $APPLICATION->ShowHead();?>
    </head>
<body>
<?$APPLICATION->ShowPanel();?>
<div class="l-page">
<aside class="l-sidebar">
    <div class="b-sidebar">
        <div class="b-logo"><?
            if($curPage!='/'):
                ?><a href="/" class="b-logo__link"><img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="<?=Loc::getMessage('HEAD_LOGO_ALT')?>" class="b-logo_image"></a><?
            else:
                ?><img src="<?=SITE_TEMPLATE_PATH?>/img/logo.png" alt="<?=Loc::getMessage('HEAD_LOGO_ALT')?>" class="b-logo_image"><?
            endif;
        ?></div>
        <?$APPLICATION->IncludeComponent("bitrix:menu","b-menu",Array(
                "ROOT_MENU_TYPE" => "left",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "360000",
                "MENU_CACHE_USE_GROUPS" => "N"
            )
        );?>
        <?$APPLICATION->IncludeComponent("bitrix:menu","b-menu-category",Array(
                "TITLE_CLASS"=>'i_screen',
                "ROOT_MENU_TYPE" => "service",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "360000",
                "MENU_CACHE_USE_GROUPS" => "N"
            )
        );?>
        <?$APPLICATION->IncludeComponent("bitrix:menu","b-menu-category",Array(
                "TITLE_CLASS"=>'i_bubble',
                "ROOT_MENU_TYPE" => "communion",
                "MAX_LEVEL" => "1",
                "CHILD_MENU_TYPE" => "",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "N",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "360000",
                "MENU_CACHE_USE_GROUPS" => "N"
            )
        );?>
        <?$APPLICATION->IncludeComponent("bitrix:menu","b-menu-category",Array(
                "TITLE_CLASS"=>'i_bubble',
                "LINK_CLASS"=>'b-menu-category__item_gray',
                "ROOT_MENU_TYPE" => "about",
                "MAX_LEVEL" => "2",
                "CHILD_MENU_TYPE" => "about2",
                "USE_EXT" => "N",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_TIME" => "360000",
                "MENU_CACHE_USE_GROUPS" => "N"
            )
        );?>
        <div class="b-copyright">
            <div class="b-copyright__year"><?$APPLICATION->IncludeFile('/include/areas/copyr_year.php', array(), array('MODE'=>'text'));?></div>
            <div class="b-copyright__title"><?$APPLICATION->IncludeFile('/include/areas/copyr_content.php', array(), array('MODE'=>'text'));?></div>
        </div>
    </div>
</aside>
<div class="l-wrapper">
    <header class="b-header">
        <div class="b-header__top-line">
            <div class="b-main-advert">
            <?$APPLICATION->IncludeComponent(
	"sator:news.line", 
	"advert_1", 
	array(
		"COMPONENT_TEMPLATE" => "advert_1",
		"IBLOCKS" => array(
			0 => "2",
			1 => "8",
			2 => "12",
		),
		"NEWS_COUNT" => "1",
		"FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PROPERTY_START_DATA",
			2 => "PROPERTY_LOCATION",
			3 => "PROPERTY_THEMES",
		),
		"SORT_BY1" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "300",
		"CACHE_GROUPS" => "Y",
		"ACTIVE_DATE_FORMAT" => "j F Y g:i A"
	),
	false
);?>
                <!--
<div class="b-main-advert__title"><a href="/courses/">обучение и практикум</a></div>
                <div class="b-main-advert__row">
                    <div class="b-main-advert__col b-main-advert__col_theme">
                        <div class="b-main-advert__theme"><span class="b-main-advert__label">Тема. </span>Практикум по предохранительной трубопроводной арматуре</div>
                    </div>
                    <div class="b-main-advert__col b-main-advert__col_text">
                        <div class="b-main-advert__text">Правильность выбора и применения различных типов предохранительных клапанов</div>
                    </div>
                    <div class="b-main-advert__col b-main-advert__col_info">
                        <div class="b-main-advert__city">Санкт-Петербург</div>
                        <div class="b-main-advert__date">29 октября в 11.00</div>
                    </div>
                </div>
-->
            </div>
        </div>
        <div class="b-header__bottom-line">
            <div class="b-main-info">
                <div class="b-main-info__date"><?=date('j').' '.strtolower(Loc::getMessage('MONTH_'.date('n').'_S')).', '.date('H:i')?></div>
                <?$APPLICATION->IncludeComponent("bitrix:news.list","main-info__currency",Array(
                        "AJAX_MODE" => "N",
                        "IBLOCK_TYPE" => "other",
                        "IBLOCK_ID" => "17",
                        "NEWS_COUNT" => "3",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER2" => "DESC",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "CHECK_DATES" => "Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N"
                    )
                );?>
            </div>
            <div class="b-main-search">
            	<?$APPLICATION->IncludeComponent(
					"bitrix:search.form",
					"header_search",
					Array(
						"COMPONENT_TEMPLATE" => "header_search",
						"IBLOCKS_LIST" => array(0=>"1",1=>"2",2=>"3",3=>"6",4=>"8",5=>"12",),
						"PAGE" => "#SITE_DIR#search/index.php",
						"USE_SUGGEST" => "N"
					)
				);?>
            </div>
            <div class="b-main-links">
                <div class="b-main-links__community">
                	<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						".default",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"COMPONENT_TEMPLATE" => ".default",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/areas/expert-society-link.php"
						)
					);?>
                </div>
                
                <?
                $APPLICATION->IncludeComponent(
					"bitrix:main.user.link", 
					"ae", 
					array(
						"CACHE_TIME" => "7200",
						"CACHE_TYPE" => "A",
						"COMPONENT_TEMPLATE" => "ae",
						"DATE_TIME_FORMAT" => "d.m.Y H:i:s",
						"ID" => $USER->GetID(),
						"NAME_TEMPLATE" => "#LAST_NAME# #NAME#",
						"PATH_TO_SONET_USER_PROFILE" => "/forum/?PAGE_NAME=profile_view&UID=",
						"PROFILE_URL" => "/forum/?PAGE_NAME=profile_view&UID=",
						"SHOW_FIELDS" => array(
							0 => "WORK_POSITION",
						),
						"SHOW_LOGIN" => "Y",
						"SHOW_YEAR" => "N",
						"USER_PROPERTY" => array(
						),
						"USE_THUMBNAIL_LIST" => "N",
						"AUTH_LINK" => "/login/",
						"REG_LINK" => "/login/?register=yes"
					),
					false
				);?>
                
            </div>
        </div>
    </header>
    <div class="b-content"><?
        if($curPage!='/'):
            if(!empty($dirProps['WIDE_TITLE'])):
                ?><div class="c-wrapper">
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","b-breadcrumbs",Array());?>
                    <div class="b-page-head">
                        <?$APPLICATION->ShowViewContent('pre_page-head__title');?>
                        <?$arCurPage = explode('/',$curPage);?>
                        <? if (($arCurPage[1]=='webinars' && $arCurPage[2]!='') 
                        	|| ($arCurPage[1]=='exhibitions' && $arCurPage[2]!='') 
                        	|| ($arCurPage[1]=='courses' && $arCurPage[2]!='')){?>							
						<?} else {?>
							<h1 class="b-page-head__title"><?
	                            if(empty($dirProps['H1_TITLE']))
	                                $APPLICATION->ShowTitle(false);
	                            else
	                                echo $dirProps['H1_TITLE'];
	                        ?></h1>	
						<?}?>
                    </div>
                </div>
                <?if(!empty($dirProps['TABS_MENU'])):?>
                    <?$APPLICATION->IncludeComponent("bitrix:menu","b-tabs-menu_news",Array(
                            "ROOT_MENU_TYPE" => "tabs",
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "360000",
                            "MENU_CACHE_USE_GROUPS" => "N",
                            "MENU_CACHE_GET_VARS" => ""
                        )
                    );?>
                <?endif;?>
                <div class="b-content__center"><div class="c-wrapper"><?
            else:
                ?><div class="b-content__center"><div class="c-wrapper">
                    <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","b-breadcrumbs",Array());?>
                    <div class="b-page-head m_b25">
                        <?$APPLICATION->ShowViewContent('pre_page-head__title');?>
                        <h1 class="b-page-head__title"><?$APPLICATION->ShowTitle(false)?></h1>
                        <?$APPLICATION->ShowViewContent('after_page-head__title');?>
                        <?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "sect",
		"AREA_FILE_SUFFIX" => "page-head__title",
		"AREA_FILE_RECURSIVE" => "N",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
                    </div><?
            endif;
        endif;