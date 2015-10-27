<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(CModule::IncludeModule("iblock")){
	
	$arIBlockType = CIBlockParameters::GetIBlockTypes();
	
	$arTypes = array();
	$arIBlock = array();
	
	foreach ($arIBlockType as $keyType=>$arType)
		$arTypes[] = $keyType;
	
	$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arTypes, "ACTIVE"=>"Y"));
	
	while($arr=$rsIBlock->Fetch())
		$arIBlock[$arr["ID"]] = $arr["NAME"];
	
		
		
	
}

$arTemplateParameters = array(
	"IBLOCKS_LIST" => Array(
		"NAME" => GetMessage("IBLOCKS_LIST"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
  		"VALUES" => $arIBlock
	),
	"USE_SUGGEST" => Array(
		"NAME" => GetMessage("TP_BSF_USE_SUGGEST"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
);
?>
