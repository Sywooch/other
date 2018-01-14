<?php
//include("../../connect_db.php");
//include("../function.php");

session_start();


include('/home/virtwww/w_dancemarket_231f1fe5/http/adm/function.php');
include('/home/virtwww/w_dancemarket_231f1fe5/http/db.php');


$id=$_SESSION['admin_id'];

//check_login($ip);
//echo "====".$id."----";


$gl_p  = $mysqli->query("SELECT `ip`,`session`,email FROM `administrators` where `id`='$id' limit 1");
$glo_p = $gl_p->fetch_row();
$ip_m = $glo_p[0];
$ses_m = $glo_p[1];
$em = $glo_p[2];

$pas = str_replace(' ', '',$_POST['pass']);
$pass = str_replace(' ', '',$_POST['pass1']);
$email = str_replace(' ', '',$_POST['email']);
$cena = str_replace(',', '.',str_replace(' ', '',$_POST['cena']));
$fio = addslashes($_POST['fio']);
$dom = str_replace(' ', '',$_POST['dom']);

/*
if ($fio=='' or !preg_match("/^[a-z,A-Z,0-9]+$/",$fio)) {
echo '<script>$().toastmessage(\'showErrorToast\', "Системное имя должно состоять из букв латинского алфавита и цифр без пробелов");</script>';
exit;
}
*/

/*
if (!preg_match("/^[0-9.]+$/",$cena)) {
echo '<script>$().toastmessage(\'showErrorToast\', "Неверно указана цена фотографии");</script>';
exit;
}
*/

if ($email=='' or !preg_match("/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$/",$email)) {
echo '<script>$().toastmessage(\'showErrorToast\', "Неверно указан Е-mail");</script>';
exit;} 
if ($email!==$em) {
$gl_p  = $mysqli->query("SELECT id FROM `administrators` where `email`='$email' limit 1");
$glo_p = $gl_p->fetch_row();
$em_m = $glo_p[0];
if(!empty($em_m)) {
echo '<script>$().toastmessage(\'showErrorToast\', "E-mail зарегистрирован ранее");</script>';
exit;}
}
if ($pas!=='' or $pass!=='') {
if ($pas!==$pass) {
echo '<script>$().toastmessage(\'showErrorToast\', "Пароли не совпадают");</script>';
exit;}
if ($pas=='' or preg_match("/^[0-9]+$/",$pas) or !preg_match("/^[a-z,A-Z,0-9]+$/",$pas) or mb_strlen(trim($pas), "UTF-8")<10 or mb_strlen(trim($pas), "UTF-8")>15) {
echo '<script>$().toastmessage(\'showErrorToast\', "Слишком легки пароль! От 10 до 15 знаков латинскими буквами и цифрами");</script>';
exit;} 
$pass=md5(md5($pass));
}

if ($pas!=='' or $pass!=='') {
//$trigg=$mysqli->query("UPDATE `administrators` SET `password`='$pass',`email`='$email',`cena`='$cena',`fio`='$fio',`dom`='$dom' WHERE `id`='$id' LIMIT 1");
$trigg=$mysqli->query("UPDATE `administrators` SET `password`='$pass',`email`='$email' WHERE `id`='$id' LIMIT 1");

} else {
//$trigg=$mysqli->query("UPDATE `administrators` SET `email`='$email',`fio`='$fio',`dom`='$dom',`cena`='$cena' WHERE `id`='$id' LIMIT 1");
$trigg=$mysqli->query("UPDATE `administrators` SET `email`='$email' WHERE `id`='$id' LIMIT 1");

}
if ($trigg===true) {
echo '<script>$().toastmessage(\'showSuccessToast\', "Данные успешно сохранены");</script>';
} else {
echo '<script>$().toastmessage(\'showErrorToast\', "Ошибка, обновите страницу и повторите попытку");</script>';
}



?>
