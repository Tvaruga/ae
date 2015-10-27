<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $USER;

if ($USER->IsAuthorized()){?>
<div class="b-main-links__enter">
	<i class="ico i_person"></i> <a class="b-main-links__enter__link" href="<?=$arParams['PROFILE_URL'].$arResult['User']['ID']?>"<?=($arParams["SEO_USER"] == "Y" ? ' rel="nofollow"' : '')?>><?=$arResult["User"]["NAME_FORMATTED"]?></a>
	(<a href="<?echo $APPLICATION->GetCurPageParam('logout=yes', array(
     'login',
     'logout',
     'register',
     'forgot_password',
     'change_password'));?>">Выход</a>)
</div>
<?} else {?>
	<? if ($arParams['AUTH_LINK']!='' || $arParams['REG_LINK']!=''){?>
		<div class="b-main-links__enter">
			<i class="ico i_person"></i>
			<? if ($arParams['AUTH_LINK']!=''){?>
				<a href="<?=$arParams['AUTH_LINK']?>" class="b-main-links__enter__link"><?=GetMessage('ENTER');?></a>	
			<?}?>
			<? if ($arParams['AUTH_LINK']!='' && $arParams['REG_LINK']!=''){?>
				<span class="b-main-links__enter__separator">|</span>
			<?}?>
			<? if ($arParams['REG_LINK']!=''){?>
				<a href="<?=$arParams['REG_LINK']?>" class="b-main-links__enter__link"><?=GetMessage('REG');?></a>
			<?}?>
		</div>
	<?}?>
<?}?>

