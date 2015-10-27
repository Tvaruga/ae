<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
?><div class="b-subscribe-field m_t20 m_b30">
	<div class="b-subscribe-field__title"><?=GetMessage('ASD_SUBSCRIBEQUICK_TITLE')?></div><?
	if ($arResult['ACTION']['status']=='error')
		ShowError($arResult['ACTION']['message']);
	elseif ($arResult['ACTION']['status']=='ok')
		ShowNote($arResult['ACTION']['message']);
	?><form action="<?= POST_FORM_ACTION_URI?>" method="post" id="asd_subscribe_form" class="b-subscribe-field__form">
		<?= bitrix_sessid_post()?>
		<input type="hidden" name="asd_subscribe" value="Y" />
		<input type="hidden" name="charset" value="<?= SITE_CHARSET?>" />
		<input type="hidden" name="site_id" value="<?= SITE_ID?>" />
		<input type="hidden" name="asd_rubrics" value="<?= $arParams['RUBRICS_STR']?>" />
		<input type="hidden" name="asd_format" value="<?= $arParams['FORMAT']?>" />
		<input type="hidden" name="asd_show_rubrics" value="<?= $arParams['SHOW_RUBRICS']?>" />
		<input type="hidden" name="asd_not_confirm" value="<?= $arParams['NOT_CONFIRM']?>" />
		<input type="hidden" name="asd_key" value="<?= md5($arParams['JS_KEY'].$arParams['RUBRICS_STR'].$arParams['SHOW_RUBRICS'].$arParams['NOT_CONFIRM'])?>" />
		<input placeholder="<?=GetMessage('ASD_SUBSCRIBEQUICK_EMAIL_PLACEHOLDER')?>" class="b-subscribe-field__input" required="required" type="email" name="asd_email" value="" />
		<input type="submit" class="b-subscribe-field__button" name="asd_submit" id="asd_subscribe_submit" value="<?=GetMessage('ASD_SUBSCRIBEQUICK_PODPISATQSA')?>" />
		<?if (isset($arResult['RUBRICS'])):?>
			<br/>
			<?foreach($arResult['RUBRICS'] as $RID => $title):?>
				<input type="checkbox" name="asd_rub[]" id="rub<?= $RID?>" value="<?= $RID?>" />
				<label for="rub<?= $RID?>"><?= $title?></label><br/>
			<?endforeach;?>
		<?endif;?>
	</form>
	<div id="asd_subscribe_res" style="display: none;"></div>
</div>


