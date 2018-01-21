<?php

 /* Здесь проверяется существование переменных */
 if (isset($_POST['q1_input1'])) {$name = $_POST['q1_input1'];}
 if (isset($_POST['q3_input3'])) {$phone = $_POST['q3_input3'];}
$email="null@yigong.su";

/* Сюда впишите свою эл. почту */
 $address = "info@yigong.su";
// $address = "gsu1234@mail.ru";
//
/* А здесь прописывается текст сообщения, \n - перенос строки */
 $mes = "Имя: $name \n \nТелефон: $phone";

/* А эта функция как раз занимается отправкой письма на указанный вами email */
 $send = mail ($address,"Заказ звонка из формы обратной связи",$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$email");
 if ($send == 'true')
 {
 echo'
 <script type="text/javascript">
 location.href="/";
 </script>
 ';
 }
 else 
 {
 echo'
 <script type="text/javascript">
 location.href="/";
 </script>
 ';
 
 }


?>
