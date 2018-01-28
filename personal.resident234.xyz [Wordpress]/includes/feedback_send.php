<?php

/**************************/
/*ob_start();


echo "<pre>";
print_r($_POST);
echo "</pre>";


$dump = ob_get_clean();


$filename = $_SERVER['DOCUMENT_ROOT'] . '/dump2.txt';
if (!file_exists($filename)) {
    $f = fopen($filename, 'w+');
    fclose($f);
}
file_put_contents($filename, $dump, FILE_APPEND);//*/
/**************************/

if($_POST["_wpcf7_is_ajax_call"]){

$attachments = array();
$headers = 'From: Персональный сайт <null@'.$_SERVER["SERVER_NAME"].'>' . "\r\n";
$body = "Имя: ".$_POST["your-name"]."\r\n";
$body = $body."E-mail: ".$_POST["email-771"]."\r\n";
$body = $body."Сообщение: ".$_POST["your-message"]."\r\n";


wp_mail('gsu1234@mail.ru', 'Сообщение с формы обратной связи', $body, $headers, $attachments);

die();

}
