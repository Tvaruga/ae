<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$arResult["COUNT"] = CIBlockElement::GetList(Array("SORT"=>"ASC"),
 Array("IBLOCK_ID"=>$arParams["IBLOCKS"], "ACTIVE"=>"Y"),
 array(),
 false,
 Array());
?>