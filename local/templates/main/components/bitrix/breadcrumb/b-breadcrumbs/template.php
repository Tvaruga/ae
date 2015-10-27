<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;


if(empty($arResult))
	return "";

$strReturn = '';


$strReturn .= '<div class="b-breadcrumbs">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]['TITLE']);

	if($index>0)
		$strReturn.='<i class="ico i_crumbs-arr-black b-breadcrumbs__sep"></i>';

	if($arResult[$index]['LINK'] <> "" && $index != $itemSize-1)
		$strReturn .= '<a href="' . $arResult[$index]['LINK'] . '" class="b-breadcrumbs__link">' . $title . '</a>';
	else
		$strReturn .= '<div class="b-breadcrumbs__text">'.$title.'</div>';
}

$strReturn .= '</div>';

return $strReturn;
