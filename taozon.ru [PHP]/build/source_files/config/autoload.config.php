<?php
//Загрузка классов
$GLOBALS['CFG_CLASS_FILE'] = array (

    // OTAPIlib
    'OTAPIlib'          => CFG_APP_ROOT.'/otapilib.php',

    'TAOlib'          => CFG_APP_ROOT.'/taolib.php',

    // Zakaz
    'Zakaz'             => CFG_APP_ROOT.'/Zakaz.php',

    //
    'axapta'            => CFG_APP_ROOT.'/axapta.php',

    // Классы ядра
    'timer'             => CFG_LIB_ROOT.'/timer.php',
);

// Функция для автозагрузки классов
function  opentao__autoload($class_name)
{
    if (file_exists(CFG_APP_ROOT.'/blockscustom/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/blockscustom/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_APP_ROOT.'/blocks/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/blocks/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_APP_ROOT.'/blocks/order/'.$class_name.'.class.php'))
    {
        include_once(CFG_APP_ROOT.'/blocks/order/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/'.$class_name.'.class.php');
    }
	//Интерфейсы
	elseif (file_exists(CFG_LIB_ROOT.'/interfaces/'.$class_name.'.interface.php'))
    {
        include_once(CFG_LIB_ROOT.'/interfaces/'.$class_name.'.interface.php');
    }
	
    elseif (file_exists(CFG_LIB_ROOT.'/exceptions/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/exceptions/'.$class_name.'.class.php');
    }
    elseif (file_exists(CFG_LIB_ROOT.'/arca/'.$class_name.'.class.php'))
    {
        include_once(CFG_LIB_ROOT.'/arca/'.$class_name.'.class.php');
    }
    elseif ((isset($GLOBALS['CFG_CLASS_FILE'][$class_name])) && (file_exists($GLOBALS['CFG_CLASS_FILE'][$class_name])))
    {
        include_once($GLOBALS['CFG_CLASS_FILE'][$class_name]);
    }
    else
    {
        die('Невозможно загрузить класс '.$class_name);
    }
}

spl_autoload_register('opentao__autoload');
?>