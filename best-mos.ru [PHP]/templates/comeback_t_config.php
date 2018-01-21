<?php
#
#        инициализация служебных переменных для работы статических страниц
#
#  Modified         :
#  Version          : 1.0
#  Programmer                : Kormishin Vladimir
#


// адреса
$_comeback_email["form"] = "admin@mail.ru";
$_comeback_email_from_name = "company";
$_comeback_email_from_mail = 'info@mail.ru';


// письма


// маленькое
$_comeback_mailbody["form"] = <<<EOF
Cообщение от формы обратной связи.

Имя и фамилия:	{name}

Email:		{mail}

Вопрос: 		{your_q}


EOF;

// темплейты для ошибок
$_comeback_error['name'] = <<<EOF
Вы не заплнили поле имени и фамилии
EOF;

$_comeback_error['mail'] = <<<EOF
Вы не заплнили поле Email
EOF;

$_comeback_error['your_q'] = <<<EOF
Задайте вопрос
EOF;


// общий темплейт для вывода ошибок
$_comeback_error['error'] = <<<EOF

<span style='color:red;'><li> {ERROR} </span>

EOF;

?>