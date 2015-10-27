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


if($arResult['VOTED'] || $arParams['READ_ONLY']==="Y"):
		?><div id="vote_<?echo $arResult['ID']?>" class="inlineblock m_r15 m_t20"><span class="button button_blue-border button_with-badges"><?=empty($arParams['BTN_LABEL'])?GetMessage('T_IBLOCK_VOTE_BTN_LABEL'):$arParams['BTN_LABEL']?><div class="button__badges"><i class="ico i_like-blue"></i><?=(int)$arResult['PROPERTIES']['vote_count']['VALUE']?></div></span></div><?
else:
		$vote = current($arResult['VOTE_NAMES']);
		?><div id="vote_<?echo $arResult['ID']?>" class="inlineblock m_r15 m_t20"><a href="javascript:void(0)" onclick="<?echo htmlspecialcharsbx("voteScript.do_vote(this, 'vote_".$arResult['ID']."', ".$arResult['AJAX_PARAMS'].")")?>" id="vote_<?echo $arResult['ID']?>_0" class="button button_blue-border button_with-badges"><?=empty($arParams['BTN_LABEL'])?GetMessage('T_IBLOCK_VOTE_BTN_LABEL'):$arParams['BTN_LABEL']?><div class="button__badges"><i class="ico i_like-blue"></i><?=(int)$arResult['PROPERTIES']['vote_count']['VALUE']?></div></a></div><?
		CJSCore::Init(array("ajax"));
		?><script type="text/javascript">
			if(!window.voteScript) window.voteScript =
			{
				do_vote: function(div, parent_id, arParams)
				{
					var r = div.id.match(/^vote_(\d+)_(\d+)$/);

					var vote_id = r[1];
					var vote_value = r[2];

					function __handler(data)
					{
						var obContainer = document.getElementById(parent_id);
						if (obContainer){
							var obResult = document.createElement("DIV");
							obResult.innerHTML = data;
							obContainer.innerHTML = BX.findChild(obResult,{attribute:{id:parent_id}}).innerHTML;
						}
					}

					arParams['vote'] = 'Y';
					arParams['vote_id'] = vote_id;
					arParams['rating'] = vote_value;

					BX.ajax.post(
						'<?=$componentPath?>/component.php',
						arParams,
						__handler
					);
				}
			}
		</script><?
endif;
