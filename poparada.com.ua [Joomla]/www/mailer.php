<?php
    // список получателей
    $to  = 'maltsev.valerii@gmail.com';

    // Тема сообщения
    $subject = 'Новости сайта';

    // Сообщение в виде HTML-формате
    $message =   '
<html>
<head>
<title>Новости сайта</title>
</head>
<body>
 <p>Новости на сегодня:</p>
 <table>
   <tr>
       <th>Номер</th><th>Содержание</th>
        <th>Автор</th><th>Опубликовано</th>
    </tr>
   <tr>
       <td>1</td><td>первая новость</td>
        <td>Администратор</td><td>вчера</td>
   </tr>
   <tr>
       <td>2</td><td>вторая новость</td>
        <td>Администратор</td><td>сегодня</td>
   </tr>
 </table>
</body>
</html>
';

    // Указываем правильный MIME-тип сообщения:
    $headers  =   'MIME-Version: 1.0' . "\r\n";
    $headers   .= 'Content-type: text/html; 
            charset=iso-8859-1' . "\r\n";

    // Добавляем необходимые заголовки
    $headers .= 
        'To: Клиент №1 <maltsev.valerii@server.com>, ';
    $headers .= 
        'From: News Robot <news@server.com>' . "\r\n";
    $headers .= 
        'Cc: News Archive <newsarc@server.com' . "\r\n";
    $headers .= 
        'Bcc: newscheck@server.com' . "\r\n";

    // Отправляем сообщение
    mail($to, $subject,   $message, $headers);

?>