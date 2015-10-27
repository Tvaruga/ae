<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult["ERROR_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-error">
	<div class="vote-note-box-text"><?=ShowError($arResult["ERROR_MESSAGE"])?></div>
</div>
<?
endif;

if (!empty($arResult["OK_MESSAGE"])): 
?>
<div class="vote-note-box vote-note-note">
	<div class="vote-note-box-text"><?=ShowNote($arResult["OK_MESSAGE"])?></div>
</div>
<?
endif;

if (empty($arResult["VOTE"]) || empty($arResult["QUESTIONS"]) ):
	return true;
endif;

?>
<ol class="vote-items-list vote-question-list voting-result-box">

<?
$iCount = 0;
foreach ($arResult["QUESTIONS"] as $arQuestion):
	$iCount++;

?>
	<li class="vote-item-vote <?=($iCount == 1 ? "vote-item-vote-first " : "")?><?
				?><?=($iCount == count($arResult["QUESTIONS"]) ? "vote-item-vote-last " : "")?><?
				?><?=($iCount%2 == 1 ? "vote-item-vote-odd " : "vote-item-vote-even ")?><?
				?>">
		<div class="vote-item-header">

<?
	if ($arQuestion["IMAGE"] !== false):
?>
			<div class="vote-item-image"><img src="<?=$arQuestion["IMAGE"]["SRC"]?>" width="30" height="30" /></div>
<?
	endif;

?>
			<h2 class="b-group__title b-group__title_with-border"><?=$arQuestion["QUESTION"]?><?if($arQuestion["REQUIRED"]=="Y"){echo "<span class='starrequired'>*</span>";}?>
                        <div class="b-group__type">Опрос</div>
                    </h2>
		</div>
<?
	if ($arQuestion["DIAGRAM_TYPE"] == "circle"):
?>
			
			<img width="150" height="150" src="<?=$componentPath?>/draw_chart.php?qid=<?=$arQuestion["ID"]?>&dm=150" />
					
				<?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
				<div class="b-question__result__item">
				<div class="b-question__title"><?=$arAnswer["MESSAGE"]?></div>
				<div class="b-question__holder">
                                        <div class="b-question__info">
                                            <div class="b-question__count"><?=$arAnswer["COUNTER"]?></div>
                                            <div class="b-question__percent">(<?=$arAnswer["PERCENT"]?>)%</div>
                                        </div>
                                        <div class="b-question__progress">
                                            <div style="width: <?=$arAnswer["PERCENT"]?>%" class="b-question__bar"></div>
                                        </div>
                                    </div>
                </div>
				<?endforeach?>
						

<?
	else://histogram
?>

			
			<?foreach ($arQuestion["ANSWERS"] as $arAnswer):?>
			<div class="b-question__result__item">
				<div class="b-question__title"><?=$arAnswer["MESSAGE"]?></div>
				<div class="b-question__holder">
                <div class="b-question__info">
                    <div class="b-question__count"><?=$arAnswer["COUNTER"]?></div>
                    <div class="b-question__percent">(<?=$arAnswer["PERCENT"]?>)%</div>
                </div>
                <div class="b-question__progress">
                    <div style="width: <?=$arAnswer["PERCENT"]?>%" class="b-question__bar"></div>
                </div>
            </div>
            </div>
			<?endforeach?>
<?
	endif;
?>
	</li>
<?
endforeach;

?>
</ol>