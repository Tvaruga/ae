<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Contacts");
?>
<div class="c-wrapper c-wrapper_no-padding">
	<div class="b-owner-card">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include", 
			".default", 
			array(
				"AREA_FILE_SHOW" => "sect",
				"AREA_FILE_SUFFIX" => "owner_card",
				"AREA_FILE_RECURSIVE" => "Y",
				"EDIT_TEMPLATE" => "",
				"COMPONENT_TEMPLATE" => ".default"
			),
			false
		);?>
	</div>
	<div class="b-contacts-menu clearfix">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include", 
			".default", 
			array(
				"AREA_FILE_SHOW" => "sect",
				"AREA_FILE_SUFFIX" => "owner_menu",
				"AREA_FILE_RECURSIVE" => "Y",
				"EDIT_TEMPLATE" => "",
				"COMPONENT_TEMPLATE" => ".default"
			),
			false
		);?>
	</div>
	<div class="c-separator-line"></div>
	<div class="c-content m_b50">
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include", 
			".default", 
			array(
				"AREA_FILE_SHOW" => "page",
				"AREA_FILE_SUFFIX" => "rus_about",
				"EDIT_TEMPLATE" => "",
				"COMPONENT_TEMPLATE" => ".default"
			),
			false
		);?>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>