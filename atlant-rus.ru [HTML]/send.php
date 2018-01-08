<?php

 /* Здесь проверяется существование переменных */
 if (isset($_POST['name'])) {$name = $_POST['name'];}
 if (isset($_POST['email'])) {$email = $_POST['email'];}
 if (isset($_POST['phone'])) {$sub = $_POST['phone'];}


/* Сюда впишите свою эл. почту */
 $address = "info@atlant-rus.ru";

/* А здесь прописывается текст сообщения, \n - перенос строки */
 $mes = "Имя: $name \nE-mail: $email \nТелефон: $phone";

/* А эта функция как раз занимается отправкой письма на указанный вами email */
 $send = mail ($address,"Заявка на бесплатную консультацию",$mes,"Content-type:text/plain; charset = utf-8\r\nFrom:$email");
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
