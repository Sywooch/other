<?php
session_start();
$secret = 'ds#$%#Tdfdsfdfd';

define('CFG_APP_ROOT', dirname(dirname(dirname(__FILE__))));

require_once dirname(dirname(dirname(__FILE__))) . '/config.php';
require_once dirname(dirname(__FILE__)) . '/startup_scripts/UsersVisits.php';
require_once dirname(dirname(__FILE__)) . '/General.class.php';
require_once dirname(dirname(__FILE__)) . '/Session.class.php';
require_once dirname(dirname(__FILE__)) . '/RequestWrapper.class.php';
require_once dirname(__FILE__) . '/UsersVisitsInfo.class.php';
if (!defined('TS_HOST_NAME'))
    define('TS_HOST_NAME', preg_replace( '~:[0-9]+$~', '', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '' ));

UsersVisitsInfo::$sessionsDir = dirname(dirname(dirname(__FILE__))) . '/cache/sessions/';
if (!file_exists(UsersVisitsInfo::$sessionsDir)) {
    mkdir(UsersVisitsInfo::$sessionsDir, 0777);
}

if (!empty($_SERVER["HTTP_IF_NONE_MATCH"])) {
    $eTag = substr(str_replace(".", "", str_replace("/", "", str_replace("\\", "", $_SERVER["HTTP_IF_NONE_MATCH"]))), 0, 18);
}
else {
    $eTag = substr(sha1($secret . sha1($_SERVER["REMOTE_ADDR"]) . sha1($_SERVER["HTTP_USER_AGENT"])), 0, 18);
}
UsersVisitsInfo::initSession($eTag);

if (empty($_SERVER["HTTP_IF_NONE_MATCH"])) {
    @unlink(UsersVisitsInfo::$sessionsDir . $eTag);
    unset($session);
    UsersVisitsInfo::initsession($eTag);
}
UsersVisitsInfo::updateSession();
UsersVisitsInfo::storeSession($eTag);

UsersVisits::saveVisit(substr($eTag, 0, 18), UsersVisitsInfo::$session);

header("Cache-Control: private, must-revalidate, proxy-revalidate");
header("ETag: " . substr($eTag, 0, 18));
header('Content-Type: image/png');
header("Content-length: " . strlen(base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=')));
// single pixel transparent png
echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABAQMAAAAl21bKAAAAA1BMVEUAAACnej3aAAAAAXRSTlMAQObYZgAAAApJREFUCNdjYAAAAAIAAeIhvDMAAAAASUVORK5CYII=');
