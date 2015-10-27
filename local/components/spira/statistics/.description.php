<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SPIRA_STAT_NAME"),
	"DESCRIPTION" => GetMessage("SPIRA_STAT_DESC"),
	"ICON" => "/images/vacancies_list.png",
	"SORT" => 20,
	"CACHE_PATH" => "Y",
	"PATH" => array(
        "ID" => "statistics",
        "NAME" => GetMessage("SPIRA_STAT_SECTION"),
        "SORT" => 10
	),
);

?>