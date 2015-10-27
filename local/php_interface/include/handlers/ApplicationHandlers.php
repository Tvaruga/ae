<?
use Bitrix\Main;
use Bitrix\Main\Entity;
$eventManager = Main\EventManager::getInstance();

$eventManager->addEventHandler('search', 'BeforeIndex', Array('ApplicationHandlers', 'BeforeIndexHandler'));

class ApplicationHandlers
{
    public static function BeforeIndexHandler($arFields){
        if($arFields['MODULE_ID'] == 'iblock' && $arFields['PARAM2'] == NEWS_ID && !empty($arFields['ITEM_ID']) && \Bitrix\Main\Loader::includeModule('iblock')){
            $db = CIBlockElement::GetProperty($arFields['PARAM2'],$arFields['ITEM_ID'],array(),array('CODE'=>'TAGS'));
            while($row = $db->Fetch()){
                if(is_array($row['VALUE'])){
                    foreach($row['VALUE'] as $val)
                        $arFields['BODY'] .= 'tag_search_'.$val;
                }else{
                    $arFields['BODY'] .= 'tag_search_'.$row['VALUE'];
                }
            }
        }
        return $arFields;
    }
}