<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/community/experts/(\\d+)/\\?{0,1}([^/]*)\$#",
		"RULE" => "EXPERT_ID=\$1&\$2",
		"ID" => "",
		"PATH" => "/community/experts/detail/index.php",
	),
	array(
		"CONDITION" => "#^/community/(blogs|categories)/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/community/blogs/index.php",
	),
	array(
		"CONDITION" => "#^/bitrix/services/ymarket/#",
		"RULE" => "",
		"ID" => "",
		"PATH" => "/bitrix/services/ymarket/index.php",
	),
	array(
		"CONDITION" => "#^/exhibitions/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/exhibitions/index.php",
	),
	array(
		"CONDITION" => "#^/companies/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/companies/index.php",
	),
	array(
		"CONDITION" => "#^/webinars/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/webinars/index.php",
	),
	array(
		"CONDITION" => "#^/courses/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/courses/index.php",
	),
	array(
		"CONDITION" => "#^/brands/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/brands/index.php",
	),
	array(
		"CONDITION" => "#^/news/#",
		"RULE" => "",
		"ID" => "bitrix:news",
		"PATH" => "/news/index.php",
	),
);

?>