<?php

ini_set('display_errors',1);
error_reporting(E_ALL);



$tovar_link=$_POST['tovar_link'];
$tovar_name=$_POST['tovar_name'];
$phone=$_POST['phone'];



$dir=str_replace("/ajax","",dirname(__FILE__));
$dir=str_replace("\ajax","",$dir);
 
  
define('_JEXEC', 1);
define('JPATH_BASE', $dir);
define('DS', DIRECTORY_SEPARATOR);

 
/* Required files */
/*
require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
require_once JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php';
//require_once JPATH_BASE.DS.'libraries'.DS.'import.php';
//require_once JPATH_BASE.DS.'administratior'.'/components/com_zoo/config.php';
require_once ( JPATH_LIBRARIES.DS.'import.php');
require_once JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'mail'.DS.'mail.php';
require_once JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'config.php';
$app = JFactory::getApplication('site')->initialise();
*/


 
/* Required files */
require_once JPATH_BASE . DS . 'includes' . DS . 'defines.php';
require_once JPATH_BASE . DS . 'includes' . DS . 'framework.php';
 
/* Create the Application */
$app = JFactory::getApplication('site')->initialise();



$mailer = JFactory::getMailer();

//установка отправителя письма
$config = JFactory::getConfig();

//$sender = array($config->getValue('config.mailfrom'), $config->getValue('config.fromname') );
$sender = "info@poparada.com.ua";


$mailer->setSender($sender);





//установка получателей
$recipient = array('gsu1234@mail.ru', 'tmp_gsu5@mail.ru');
$mailer->addRecipient($recipient);


//формирование письма
$body   = '<h2>Заказ обратного звонка</h2>'
         .'<p>Телефон: '.$phone.'</p><p>Наименование товара: '.$tovar_name.'</p><p>Ссылка на страницу: '.$tovar_link.'</p>';
$mailer->isHTML(true);
$mailer->setBody($body);
$mailer->setSubject('Заказ обратного звонка');


$send =& $mailer->Send();
if ($send !== true) {
   // echo 'Error sending email: '.$send->message;
} else {
   
}







?>