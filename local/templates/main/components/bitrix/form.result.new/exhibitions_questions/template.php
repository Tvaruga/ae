<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="b-invite-order m_t30 m_b40">
	<? if ($arResult["isFormNote"] != "Y"){?>
		<div class="b-invite-order__title"><?=$arResult["FORM_TITLE"]?></div>
		
		<?=$arResult["FORM_HEADER"]?>
		
			<?if ($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>
			
			<?
			foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion){
				if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'){
					echo $arQuestion["HTML_CODE"];
				}else{
				?>
				<div class="b-invite-order__field c-form__item">
					<div class="row t-3">
						<div class="cell s-2">
							<label class="c-form__label m_t10"><?=$arQuestion["CAPTION"]?></label>
						</div>
						<div class="cell s-4">
							<?=$arQuestion["HTML_CODE"]?>
						</div>
					</div>
				</div>
				<?
				}
			} //endwhile
			?>
			
			<? if($arResult["isUseCaptcha"] == "Y"){?>
				<div class="b-invite-order__field c-form__item">
					<div class="row t-3">
						<div class="cell s-2">
							<label class="c-form__label m_t10"><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></label>
						</div>
						<div class="cell s-4">
							<input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" />
							<?=$arQuestion["HTML_CODE"]?>
						</div>
					</div>
				</div>
				
				<div class="b-invite-order__field c-form__item">
					<div class="row t-3">
						<div class="cell s-2">
							<label class="c-form__label m_t10"><?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?></label>
						</div>
						<div class="cell s-4">
							<input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" />
						</div>
					</div>
				</div>
			<? }?>
			
			<div class="row t-3 m_t25">
				<div class="offset_2 cell s-4">
					<input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" class="button" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" />
				</div>
			</div>
			
		<?=$arResult["FORM_FOOTER"]?>
    <? } else {?>
    	<div class="b-thank-message m_t30 m_b40">Спасибо за обращение! Заявка на получение приглашения на выставку успешно отправлена, организатор ответит вам личным сообщением в ближайшее время.</div>
    <? }?>
</div>