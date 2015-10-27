<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="b-group">
    <h2 class="b-group__title b-group__title_with-border"><?=$arParams["TITLE"]?></h2>
    <div class="b-group__holder">
	    <div class="b-line-stat">
		    <div class="b-line-stat__item"><span class="b-line-stat__title"><?=GetMessage("SPIRA_STAT_TM_PARTICIPANTS")?></span><span class="b-line-stat__count"><?=$arResult["PARTICIPANTS"]?></span></div>
			<div class="b-line-stat__item"><span class="b-line-stat__title"><?=GetMessage("SPIRA_STAT_TM_EXPERTS")?></span><span class="b-line-stat__count"><?=$arResult["EXPERTS"]?></span></div>
			<div class="b-line-stat__item"><span class="b-line-stat__title"><?=GetMessage("SPIRA_STAT_TM_CATEGORIES")?></span><span class="b-line-stat__count"><?=$arResult["CATEGORIES"]?></span></div>
			<div class="b-line-stat__item"><span class="b-line-stat__title"><?=GetMessage("SPIRA_STAT_TM_QUESTIONS")?></span><span class="b-line-stat__count"><?=$arResult["QUESTIONS"]?></span></div>
			<div class="b-line-stat__item"><span class="b-line-stat__title"><?=GetMessage("SPIRA_STAT_TM_WORK")?></span><span class="b-line-stat__count"><?=$arResult["WORK"]?></span></div>
			<div class="b-line-stat__item"><span class="b-line-stat__title"><?=GetMessage("SPIRA_STAT_TM_COMMENTS")?></span><span class="b-line-stat__count"><?=$arResult["COMMENTS"]?></span></div>
        </div>
    </div>
</div>