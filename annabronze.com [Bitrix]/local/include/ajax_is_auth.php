<?php
define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
GLOBAL $USER;
if($USER->IsAuthorized()){
    echo true;
}
else{
    echo false;
}
?>
