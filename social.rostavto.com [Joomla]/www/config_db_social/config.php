<?php
// Сервер базы данных 
if (!defined("DB_SERVER_S"))  define ( "DB_SERVER_S", "localhost" ); 

// База данных 
if (!defined("DB_BASE_S")) define ( "DB_BASE_S", "db_avtoportal" ); 

// Пользователь, от имени которого производится подключение к базе.
if (!defined("DB_USER_S")) define ( "DB_USER_S", "root" ); 

//Пароль для доступа к базе.
if (!defined("DB_PASS_S")) define ( "DB_PASS_S", "");

//Адрес сайта-соцсети
if (!defined("ADRESS_SOCIAL")) define ( "ADRESS_SOCIAL","http://192.168.0.100/");

?>