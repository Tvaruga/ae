<? class CInc
{
    public static function getHLClass($filter)
    {
        $HLBlock = Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>$filter))->fetch();
        $HLEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($HLBlock);
        return $HLEntity->getDataClass();
    }


    public static function getCBRDynamic($vCode,$timestamp=false){
        if(empty($timestamp))
            $timestamp = time();
        /*$client = new \SoapClient('http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?WSDL',array('soap_version' => SOAP_1_2));
        $params = array(
            'FromDate'=>date('Y-m-d', strtotime('-1 day',$timestamp)),
            'ToDate'=>date('Y-m-d',$timestamp),
            'ValutaCode'=> $vCode
        );
        $xml = $client->GetCursDynamicXML($params);
        unset($client);
        $xml = simplexml_load_string($xml->GetCursDynamicXMLResult->any);*/
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1='.date('d/m/Y', strtotime('-1 month',$timestamp)).'&date_req2='.date('d/m/Y',$timestamp).'&VAL_NM_RQ='.$vCode);
        $arResult = array();
        if(!empty($xml) && is_object($xml)){
            foreach($xml->children() as $row){
                $row = (array)$row;
                $row['Value'] = (float)str_replace(',','.',$row['Value']);
                $arResult[]=$row;
            }
        }

        return $arResult;
    }

    public static function getCBRDaily($timestamp=false){
        if(empty($timestamp))
            $timestamp = time();
        $xml = simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp?date_req='.date('d/m/Y',$timestamp));
        $arResult = array();
        if(!empty($xml) && is_object($xml)){
            foreach($xml->children() as $row)
                $arResult[(string)$row['ID']]=(array)$row;
        }
        return $arResult;
    }

    public static function getJobName($id){
        if(empty($id))
            return false;

        $result = false;
        $obCache = new CPHPCache();
        $dir = '/companies/names';
        if ($obCache->InitCache(9999999999, md5($id), $dir)){
            $result = $obCache->GetVars();
        }elseif ($obCache->StartDataCache() && \Bitrix\Main\Loader::includeModule('iblock')){
            if($result=CIBlockElement::GetByID($id)->Fetch()){
                if (defined('BX_COMP_MANAGED_CACHE')){
                    $GLOBALS['CACHE_MANAGER']->StartTagCache($dir);
                    $GLOBALS['CACHE_MANAGER']->RegisterTag('iblock_id_' . $result['IBLOCK_ID']);
                }
                $result = $result['NAME'];
                if(defined('BX_COMP_MANAGED_CACHE'))
                    $GLOBALS['CACHE_MANAGER']->EndTagCache();
            }

            $obCache->EndDataCache($result);
        }

        return $result;
    }
}