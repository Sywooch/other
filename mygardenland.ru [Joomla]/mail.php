<?php


$res=mail("gsu1234@mail.ru", "the subject", "the message",
 "From: gsu4306@gmail.com\r\n"
."Reply-To: gsu4306@gmail.com\r\n"
."X-Mailer: PHP/" . phpversion());

echo $res;

?>
