<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arUGroupsEx = array();
$dbUGroups = CGroup::GetList($by = 'c_sort', $order = 'asc');
while($arUGroups = $dbUGroups -> Fetch())
	$arUGroupsEx[$arUGroups['ID']] = $arUGroups['NAME'];

$arRes = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("USER", 0, LANGUAGE_ID);
$userProp = array();
if (!empty($arRes))
	foreach ($arRes as $key => $val)
		$userProp[$val["FIELD_NAME"]] = (strLen($val["EDIT_FORM_LABEL"]) > 0 ? $val["EDIT_FORM_LABEL"] : $val["FIELD_NAME"]);


$arComponentParameters = array(
	'GROUPS' => array(
	),
	'PARAMETERS' => array(
		'AJAX_MODE' => array(),
		'ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('T_IBLOCK_DESC_USER_ID'),
			'TYPE' => 'STRING',
			'DEFAULT' => '',
		),
		"USER_PROPERTY"=>array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("USER_PROPERTY"),
			"TYPE" => "LIST",
			"VALUES" => $userProp,
			"MULTIPLE" => "Y",
			"DEFAULT" => array(),
		),
		'TITLE' => array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => GetMessage('CP_BND_TITLE'),
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		),
		'BROWSER_TITLE' => array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => GetMessage('CP_BND_BROWSER_TITLE'),
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		),
		'META_KEYWORDS' =>array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => GetMessage('T_IBLOCK_DESC_KEYWORDS'),
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		),
		'META_DESCRIPTION' =>array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => GetMessage('T_IBLOCK_DESC_DESCRIPTION'),
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		),
		'USE_PERMISSIONS' => array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => GetMessage('T_IBLOCK_DESC_USE_PERMISSIONS'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			'REFRESH' => 'Y',
		),
		'GROUP_PERMISSIONS' => array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => GetMessage('T_IBLOCK_DESC_GROUP_PERMISSIONS'),
			'TYPE' => 'LIST',
			'VALUES' => $arUGroupsEx,
			'DEFAULT' => array(1),
			'MULTIPLE' => 'Y',
		),
		'CACHE_TIME'  =>  array('DEFAULT'=>36000000),
		'CACHE_GROUPS' => array(
			'PARENT' => 'CACHE_SETTINGS',
			'NAME' => GetMessage('CP_BND_CACHE_GROUPS'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
	),
);

CIBlockParameters::Add404Settings($arComponentParameters, $arCurrentValues);

if($arCurrentValues['USE_PERMISSIONS']!='Y')
	unset($arComponentParameters['PARAMETERS']['GROUP_PERMISSIONS']);