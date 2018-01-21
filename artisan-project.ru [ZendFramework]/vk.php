<?php



$link = 'oid=334537331&id=171544794&hash=7852c6af935597fd&hd=1';
// Далее идет магия по извлечению прямой ссылки с вконтакта
$val = $link;

$valex = explode('&', $val);

$oidexp = explode('=', $valex[0]);

if (!isset ($oidexp[1])) return Response::json(array('success' => "false", "message" => "error oidexp"), 200);
$oid = $oidexp[1];

$idexp = explode('=', $valex[1]);
if (!isset($idexp[1])) return Response::json(array('success' => "false", "message" => "error  idexp"), 200);


$id = $idexp[1];

$hashexp = explode('=', $valex[2]);
$hash = $hashexp[1];

$nameexp = explode('=', $valex[3]);
$name = $nameexp[1];


$page_up = file_get_contents('http://vk.com/video_ext.php?oid=' . $oid . '&id=' . $id . '&hash=' . $hash . '&hd=1');
preg_match('<param name="flashvars" value="(.*)">', $page_up, $matches);


if (count($matches) < 1) return Response::json(array('success' => "false", "message" => "error  matches"), 200);

$buf = $matches[1];

$res = array();

foreach (explode('&amp;', $buf) as $tmp) {
    $tmp2 = explode('=', $tmp);
    $key = $tmp2[0];
    unset ($tmp2[0]);
    $res[$key] = implode('=', $tmp2);
}

echo '<pre>';
print_r($res);
echo '</pre>';




?>
