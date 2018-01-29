<?
//ajax && referer checkout
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	if (substr($_SERVER['HTTP_REFERER'],0,13) == 'http://taozon'){

		$name = htmlspecialchars($_POST['name']);
		$contacts = htmlspecialchars($_POST['contacts']);
		$mes = htmlspecialchars($_POST['message']);
		
		if ($name && $contacts) {
			
			$to      = 'taozon@mail.ru, taozon_market@mail.ru, leftli@yandex.ru'; 
			$subject = 'Обратный звонок';
			$message = 'Новый заказ обратного звонка'."\r\n\r\n".'Имя: '.$name."\r\n".'Контакты: '.$contacts."\r\n".'Сообщение: '.$mes."\r\n";
			

			$headers   = array();
			$headers[] = "Content-type: text/plain; charset=utf-8";
			$headers[] = "From: Admin Taozon <admin@taozon.ru>";

			if (mail($to, $subject, $message, implode("\r\n",$headers))){
				echo "success";
			}
			else echo "error";
		
		}		
	
	}	
}
?>