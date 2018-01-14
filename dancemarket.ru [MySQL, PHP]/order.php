<?
include("../../connect_db.php");
include("../function.php");
check_login($ip);

$table='`order`';
$id = $_POST['id'];
$all = $_POST['all'];
$p = $_POST['p'];

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($p=='delete') {
if ($all=='1') {
$pieces = explode(",",$id);
foreach ($pieces as $val) {
$trigg=$mysqli->query("DELETE FROM $table where id_o='$val' limit 1");
}
if ($trigg===false) {
echo '<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>';
exit;
} else {
echo '<script>location.reload();</script>';
exit;
}} else {
$trigg=$mysqli->query("DELETE FROM $table where id_o='$id' limit 1");
if ($trigg===false) {
echo '<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>';
exit;
} else {
echo '<script>location.reload();</script>';
exit;
}}}

if ($p=='add') {
$title = htmlspecialchars($_POST['title']);
$id_e = addslashes($_POST['id_e']);
$text = $_POST['text'];
$krat = $_POST['krat'];
$ad = $_POST['ad'];
if ($title=='') {
echo '<script>$().toastmessage(\'showErrorToast\', "Введите место проведения");</script>';
exit;
}

if (empty($id_e)) {
$fawq=time();
$trigg=$mysqli->query("INSERT INTO $table (`title`,`date`,`ad`) VALUES('$title','$fawq','$ad')");
} else {
$trigg=$mysqli->query("UPDATE $table SET `title`='$title',`ad`='$ad' WHERE `id`='$id_e' LIMIT 1");
}
if ($trigg===false) {
echo '<script>$().toastmessage(\'showErrorToast\', "Ошибка, повторите попытку");</script>';
exit;
} else {
echo '<script>window.location.href = "index.php?a=order"</script>';
exit;
}}
?>
