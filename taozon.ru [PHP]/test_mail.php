<?php
$title = 'TEST';
$mess =  'TEST<b>123</b> <a href="http://opentao.net">link</a> text';
// $to - кому отправляем
$to = 'blondincheg@yandex.ru';
// $from - от кого
$from='noreply@opentao.com';

if (mail($to, $title, $mess, 'from:'.$from, '-f'.$from)) {
	echo '1';
} else {
	echo '0';
}
echo '<br />' . time();
?>