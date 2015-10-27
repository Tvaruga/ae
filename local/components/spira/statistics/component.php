<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

//Set default cache time 
if(!isset($arParams["CACHE_TIME"]))
	$arParams["CACHE_TIME"] = 3600;

$arParams["IBLOCK_ID"] = intval($arParams["IBLOCK_ID"]);
$arParams["EXPERTS_GROUP"] = intval($arParams["EXPERTS_GROUP"]);
$arParams["QUESTIONS_IBLOCK_ID"] = intval($arParams["QUESTIONS_IBLOCK_ID"]);
$arParams["CATEGORIES_IBLOCK_ID"] = intval($arParams["CATEGORIES_IBLOCK_ID"]);
$arParams["WORK_IBLOCK_ID"] = intval($arParams["CATEGORIES_IBLOCK_ID"]);
$arParams["BLOG_ID"] = intval($arParams["BLOG_ID"]);

//Cache on
if($this->StartResultCache(false, ($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups()))) {
    
    //Plug-in IBlocks
    if(!CModule::IncludeModule("iblock"))
    {
        $this->AbortResultCache();
        ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
        return;
    }
    
     //Plug-in Blogs
    if(!CModule::IncludeModule("blog"))
    {
        $this->AbortResultCache();
        ShowError(GetMessage("BLOG_MODULE_NOT_INSTALLED"));
        return;
    }
    
    //Get the number of participants
    $participantsCount = CUser::GetCount();
    $arResult["PARTICIPANTS"] = $participantsCount;
    
    //Get the number of experts
    $groupId = $arParams["EXPERTS_GROUP"];
	$arExperts = CGroup::GetGroupUser($groupId); //Alternative CGroup::GetList with SHOW_USERS_AMOUNT
	$arResult["EXPERTS"] = count($arExperts);

	//Get the number of questions
	$arFilter = array("IBLOCK_ID" => $arParams["QUESTIONS_IBLOCK_ID"], "ACTIVE" => "Y");
	$arResult["QUESTIONS"] = CIBlockElement::GetList(array(), $arFilter, array(), false, array());
	
	//Get the number of categoties
	$arFilter = array("IBLOCK_ID" => $arParams["CATEGORIES_IBLOCK_ID"], "ACTIVE" => "Y", "DEPTH_LEVEL" => 1);
	$arResult["CATEGORIES"] = CIBlockSection::GetCount($arFilter);
	
	//Get the number of work
	$arFilter = array("IBLOCK_ID" => $arParams["WORK_IBLOCK_ID"], "ACTIVE" => "Y");
	$arResult["WORK"] = CIBlockElement::GetList(array(), $arFilter, array(), false, array());
	
	//Get the number of comments
	$arFilter = array("BLOG_ID" => $arParams["BLOG_ID"]);
	$arResult["COMMENTS"] = CBlogComment::GetList(array(), $arFilter, array(), false, array());

    //Plug-in tenplate
    $this->IncludeComponentTemplate();
}
?>