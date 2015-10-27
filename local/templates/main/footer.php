<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
        if($curPage!='/'):
            ?></div></div><div class="b-content__right">
                <?$APPLICATION->ShowViewContent('right_col');?>
                <?$APPLICATION->IncludeComponent(
					"bitrix:main.include", 
					".default", 
					array(
						"AREA_FILE_SHOW" => "sect",
						"AREA_FILE_SUFFIX" => "right",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE" => "",
						"COMPONENT_TEMPLATE" => ".default"
					),
					false
				);?>
            </div><?
        endif;?>
    </div>
    <div class="b-promo"><div class="c-wrapper"><a href="http://www.valverus.info/ " target="_blank" class="b-promo__link"><img src="<?=SITE_TEMPLATE_PATH?>/upload/banner_TPA_1010_120.gif" alt="" class="b-promo__image"></a></div></div>
    <a href="#" class="button b-up-button js-scroll-top"><?=Loc::getMessage('FOOT_TOP_LABEL')?></a>
    <footer class="b-footer">
        <div class="b-footer__holder">
            <?$APPLICATION->IncludeComponent("bitrix:news.list","b-social",Array(
                    "AJAX_MODE" => "N",
                    "IBLOCK_TYPE" => "other",
                    "IBLOCK_ID" => "16",
                    "NEWS_COUNT" => "5",
                    "SORT_BY2" => "ID",
                    "SORT_ORDER2" => "DESC",
                    "SORT_BY1" => "SORT",
                    "SORT_ORDER1" => "ASC",
                    "PROPERTY_CODE" => Array("LINK"),
                    "CHECK_DATES" => "Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "360000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N"
                )
            );?>
        </div>
    </footer>
</div>
</div>
<?$APPLICATION->IncludeComponent("bitrix:im.messenger", "", Array());?>
</body>
</html>