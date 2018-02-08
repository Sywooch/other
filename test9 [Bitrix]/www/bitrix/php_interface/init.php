<?


CModule::IncludeModule('main');
CModule::IncludeModule("iblock");
CModule::IncludeModule("sale");




\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnBeforeSaleBasketItemSetField',
    'roundPrice'
);


//функция будет реагировать на изменение поля в корзине
function roundPrice(\Bitrix\Main\Event $event)
{


	
    $name = $event->getParameter('NAME');
    $value = $event->getParameter('VALUE');


   if ($name === 'QUANTITY'){
		$q_tmp=$value;
		$GLOBALS['QUANTITY']=$q_tmp;
   }
   

   if ($name === 'PRICE')
   {

	///////////////////////////////////
	
	$text="";

	//вытаскиваем сведения об акции из инфоблока
	$arFilter = array(
				"FUSER_ID" => CSaleBasket::GetBasketUserID(),
				"ORDER_ID" => NULL
				);
	$res = CSaleBasket::GetList(array(), $arFilter);

	while($arItems = $res->Fetch())
	{

		$catalog_price = CPrice::GetBasePrice($arItems["PRODUCT_ID"]);
		$basket_prices[$arItems["ID"]]=$catalog_price["PRICE"];
		$basket_q[$arItems["ID"]]=$arItems["QUANTITY"];
	
	}
	asort($basket_prices);
	
	$N=0;
	$X=0;

	$arSelect = Array("ID");
	$arFilter = Array("IBLOCK_ID"=>"4");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement())
	{	
		$arFields = $ob->GetFields();
		$arFilter = Array("IBLOCK_ID"=>"4", "ID"=>$arFields["ID"]);
		$res = CIBlockElement::GetList(Array(), $arFilter);
		if ($ob = $res->GetNextElement()){ 
		    $arProps = $ob->GetProperties();
			$START = $arProps['START']['VALUE'];//дата начала акции
			$END = $arProps['START']['VALUE'];//дата окончания акции

			$today= date("d.m.Y h:i:s");
		
			$M_START=strtotime($START);
			$M_END=strtotime($END);
			$M_today=strtotime($today);
	
			//допускается, что в инфоблоке может быть несколько акций, но активной будет только одна.
			if( ($M_START <= $M_today) && ($M_today >= $M_END) ){//если текущая дата лежит в иннтервале между датой начала 
			//и датой окончания акции, то акция активна
 				$N=$arProps['N']['VALUE'];// N - каждый N-й товар будет иметь цену
				$X=$arProps['X']['VALUE'];// равную X
				break;
			}else{
				continue;
		
			}
	
	
	
   		}


	}//while($ob = $res->GetNextElement())



	if($N!=0 && $X!=0){	
		$count=0;

		//список цен товаров из каталога
		foreach($basket_prices as $k=>$v){
			$count=$count+$basket_q[$k];
		}


		$N1=floor($count/$N);// первый N1 товаров будут иметь цену X, в отсортированной по возрастанию цен списке в корзине	

		unset($basket_prices2);
		unset($basket_q2);

		$i=0;
		
		//список ценников, которые нужно заменить на X
		foreach($basket_prices as $k => $v){

			$v += 0;
			if( $v == $X){
				continue;	
			}

			for($i3=0;$i3<$basket_q[$k];$i3++){
				if($i>=$N1){ break; };
				$basket_prices2[]=(float)$v;
				$i++;
			}

			$basket_q2[$k]=$basket_q[$k];


		}
		
	///////////////////////////////////	
		
		if(!isset($GLOBALS['basket_prices2'])){
			$GLOBALS['basket_prices2']=$basket_prices2;	
		}else{
			$basket_prices2=$GLOBALS['basket_prices2'];
		}
  		
		
		
		
		
		if( in_array($value, $basket_prices2)  ){
        	$GLOBALS['temp_values'][]=$value;
		}
		
		asort($GLOBALS['temp_values']);
		$basket_prices2_tmp=array_unique($basket_prices2);
		
		if( in_array($value, $basket_prices2)  ){
			$key = array_search($value, $basket_prices2);
			$tmp_price=$value;
			$q_tmp = $GLOBALS['QUANTITY'];
			$value_old=$value;
			if($q_tmp > count($basket_prices2)){//например имеется товар в кол-ве 2. Один из товаров нужно сделать 
			//с ценой = 1 , другой оставить с прежней ценой (749). Общая цена этих двух товаров будет равна = (749 + 1) = 750
			// тогда ценник каждого из двух товаров нужно сделать = 750/2 = 375
				$value= (( $X * count($basket_prices2) ) + ( ($q_tmp - count($basket_prices2)) * $tmp_price)) / $q_tmp;
			}else{
				$value = $X;// ситуация, при которой имеется товар в количестве >=1, и цены всех товаров из этой пачки 
				// нужно сделать = X
			}
				
			for($i4=0;$i4<$q_tmp;$i4++){
				unset($basket_prices2[$key]);
				$key = array_search($value_old, $basket_prices2);
			}
			//цены , которые заменили на X, выбрасываем из массива
			$GLOBALS['basket_prices2']=$basket_prices2;
		}
		


	

		$event->addResult(
            new Bitrix\Main\EventResult(
                Bitrix\Main\EventResult::SUCCESS, array('VALUE' => $value)
            )
        );
		
	
	}//if($N!=0 && $X!=0)	
		
    }//if ($name === 'PRICE')





}




?>