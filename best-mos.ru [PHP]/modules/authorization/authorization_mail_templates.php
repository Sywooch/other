<?php
#
#  Инициализация класса SiteMapClass
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) «Мастерская Водопьянова»
#

$mail_auth_template['subject_1'] = "Регистрация на {$host}";

$mail_auth_template['body_1'] = <<<EOF

Здравствуйте!
Вы стали пользователем нашей системы.

Ваши регистрационные данные:

Логин: {LOGIN}
Пароль: {PASS}
E-mail: {MAIL}

--
С уважением, «Мастерская Водопьянова»
http://{$host}/

EOF;

$mail_auth_template['subject_2'] = "Ваш пароль на {$host}";

$mail_auth_template['body_2'] = <<<EOF

Здравствуйте!
По Вашему запросу сообщаем Ваши данные в нашей системе.

Логин:  {LOGIN}
Пароль: {PASS}

--
С уважением, «Мастерская Водопьянова»
http://{$host}/

EOF;


$mail_auth_template['subject_6'] = "Подтверждение регистрации на сайте {$host}";

$mail_auth_template['body_6'] = <<<EOF

Пожалуйста, подтвердите регистрацию «Мастерская Водопьянова».
Для этого пройдите по нижеприведенной ссылке:
http://{$host}/authorization/approve/{REGKEY}/

Если это сообщение пришло к Вам по ошибке или Вы
не хотите подтверждать регистрацию - просто удалите его.

--
С уважением, «Мастерская Водопьянова»
http://{$host}/

EOF;


?>