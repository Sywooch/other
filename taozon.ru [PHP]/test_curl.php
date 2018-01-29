<?php
// 1. инициализация
$ch = curl_init();

// 2. указываем параметры, включая url
//curl_setopt($ch, CURLOPT_URL, "http://ya.ru");
curl_setopt($ch, CURLOPT_URL, "http://otapi.net");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

// 3. получаем HTML в качестве результата
$output = curl_exec($ch);
if ($output === FALSE) {
    echo "cURL Error: " . curl_error($ch);
} else {
	echo time() . ': cURL ';
}

// 4. закрываем соединение
curl_close($ch);
