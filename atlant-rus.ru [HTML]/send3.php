<?php

 /* Здесь проверяется существование переменных */
 if (isset($_POST['q1_input1'])) {$name = $_POST['q1_input1'];}
 if (isset($_POST['q3_Email'])) {$mail = $_POST['q3_Email'];}
 if (isset($_POST['q4_input4'])) {$mes = $_POST['q4_input4'];}
$email="null@yigong.su";

/* Сюда впишите свою эл. почту */
 $address = "info@yigong.su";
// $address = "gsu1234@mail.ru";
//info@yigong.su
/* А здесь прописывается текст сообщения, \n - перенос строки */
 $mes = "Имя: $name \n E-mail: $mail \n Сообщение: $mes";

/* А эта функция как раз занимается отправкой письма на указанный вами email */
 $send = mail ($address,"Сообщение из формы обратной связи",$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$email");
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
