<?
/**
* Сортировка для берндов по алфавиту
* @param $array - массив элементов которые андо отсортировать
* @param $rus  - русский алфавит
* @param $num - цифренные названия
* 
* @return
*/
function sorting(&$array, $rus=false, $num=false){
    # "Память"
    $memory = NULL;
    
    # Новый массив
    $sorting = array();
    $arRus = array();
    $arNum = array();
    # Обходим массив
    foreach( $array as $key=>$item ){
        # Получаем первую букву
        $letter = mb_substr($item['NAME'], 0, 1, 'utf-8' );
        # Если текущая буква не равна предыдущей
        if( $letter != $memory ){
            # Заносим букву в "память"
            $memory = $letter;
            

            if ($num && $letter>0)
            	$memory = 'NUM';
            elseif ($rus && preg_match("/^[".chr(0x7F)."-".chr(0xff)."_-]+$/",$letter))
        		$memory =$letter;
        	else
        		$memory = $letter;
        }
		
        	if ($memory=='RUS')
				$arRus[$key] = $item;
			elseif ($memory=='NUM')
				$arNum[$key] = $item;
			else
				$sorting[$memory][$key] = $item;
        
    }
    if (is_array($arRus) && !empty($arRus))
    	$sorting['RUS'] = $arRus;
    	
    if (is_array($arRus) && !empty($arRus))
    	$sorting['NUM'] = $arNum;


    # Назвачаем массив
    return $sorting;
}



function format_by_count($count, $form1, $form2, $form3){
    $count = abs($count) % 100;
    $lcount = $count % 10;
    if ($count >= 11 && $count <= 19) return($form3);
    if ($lcount >= 2 && $lcount <= 4) return($form2);
    if ($lcount == 1) return($form1);
    return $form3;
}
