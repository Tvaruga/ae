<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
	return;
	
if(!CModule::IncludeModule("blog"))
	return;

//Get a list of all groups
$rsGroups = CGroup::GetList($by = "id", $order = "asc", array("ACTIVE" => "Y"));
if(intval($rsGroups->SelectedRowsCount()) > 0) {
   while($arGroups = $rsGroups->Fetch()) {
      $arUsersGroups[$arGroups["ID"]] = $arGroups["NAME"]. " [".$arGroups["ID"]."]";
   }
}

//Get a list of IBlocks
$arIBlock = array();
$rsIBlock = CIBlock::GetList(array("sort" => "asc"), array("ACTIVE"=>"Y"));
while($arEl = $rsIBlock->Fetch()) {
    $arIBlock[$arEl["ID"]] = $arEl["NAME"]." [".$arEl["ID"]."]";
}

//Get a list of groups blogs
$arFilter = array();	
$arSelectedFields = array("ID", "NAME");
$dbBlogs = CBlog::GetList(array(), $arFilter, false, false, $arSelectedFields);
while ($arBlog = $dbBlogs->Fetch()) {
	$arBlogs[$arBlog["ID"]] = $arBlog["NAME"]." [".$arBlog["ID"]."]";
}

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS" => array(
		"EXPERTS_GROUP" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SPIRA_STAT_EXPERTS_GROUP"),
			"TYPE" => "LIST",
			"VALUES" => $arUsersGroups,
		),
		"QUESTIONS_IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SPIRA_STAT_QUESTIONS_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
		),
		"CATEGORIES_IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SPIRA_STAT_CATEGORIES_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
		),
		"WORK_IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SPIRA_STAT_WORK_IBLOCK_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlock,
		),
		"BLOG_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("SPIRA_STAT_BLOG_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arBlogs,
		),
		"CACHE_TIME"  =>  array("DEFAULT" => 3600),
		"CACHE_FILTER" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("IBLOCK_CACHE_FILTER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BNL_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
	),
);

?>