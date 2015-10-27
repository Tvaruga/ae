<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->ShowViewContent('detail_webinar_info_header');?>
<div class="b-right-sidebar">
	<?$APPLICATION->IncludeComponent(
	"bitrix:highloadblock.list", 
	"curse-list", 
	array(
		"BLOCK_ID" => "6",
		"COMPONENT_TEMPLATE" => "curse-list",
		"DETAIL_URL" => "/webinars/"
	),
	false
);?>
</div>
<?$APPLICATION->ShowViewContent('detail_webinar_info_footer');?>
