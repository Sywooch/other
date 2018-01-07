<?

/*
 * достать для региона первый попавшийся город
 *
 */

$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
set_time_limit(0);
//define("LANG", "ru");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;  
CModule::IncludeModule('iblock');
CModule::IncludeModule('main');
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");

//$_POST["loc"] - регион


$db_vars = CSaleLocation::GetList(
    array(
        "SORT" => "ASC",
        "COUNTRY_NAME_LANG" => "ASC",
        "CITY_NAME_LANG" => "ASC"
    ),
    array("LID" => LANGUAGE_ID, "REGION_ID" => $_POST["loc"]),
    false,
    false,
    array()
);

$i = 0;
while ($vars = $db_vars->Fetch()):

    $CITY_ID = $vars["CITY_ID"];
    if($i == 1){
        break;
    }

$i++;
endwhile;


echo $CITY_ID;






include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>