<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (!empty($arParams['IBLOCKS_LIST']) && CModule::IncludeModule("iblock")){
	$arIBlockType = CIBlockParameters::GetIBlockTypes();
	
	$arTypes = array();
	$arIBlock = array();
	
	foreach ($arIBlockType as $keyType=>$arType)
		$arTypes[] = $keyType;
	
	$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array('ID' =>$arParams['IBLOCKS_LIST'] ,"TYPE" => $arTypes, "ACTIVE"=>"Y"));
	
	while($arr=$rsIBlock->Fetch())
		$arResult['IBLCOKS'][$arr['ID']]=$arr['NAME'];
}