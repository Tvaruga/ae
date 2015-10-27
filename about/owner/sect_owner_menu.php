<?
$page = $APPLICATION->GetCurPage(true);
$arPage = explode('/', $page);
?>
<ul class="b-contacts-menu__holder f_left">
	<li class="b-contacts-menu__item <? if ($arPage[3]=='index.php') print 'active';?>"><a href="/about/owner/" class="b-contacts-menu__link">О владельце</a></li>
	<li class="b-contacts-menu__item <? if ($arPage[3]=='contacts.php') print 'active';?>"><a href="/about/owner/contacts.php" class="b-contacts-menu__link">Контакты</a></li>
</ul>
<ul class="b-contacts-menu__holder f_right">
	<li class="b-contacts-menu__item  <? if ($arPage[3]=='en.php') print 'active';?>"><a href="/about/owner/en.php" class="b-contacts-menu__link">About us</a></li>
	<li class="b-contacts-menu__item  <? if ($arPage[3]=='contacts_en.php') print 'active';?>"><a href="/about/owner/contacts_en.php" class="b-contacts-menu__link">Сontacts</a></li>
</ul>