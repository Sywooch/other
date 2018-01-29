<?php

class Update extends GeneralUtil {
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'update';
    protected $_template_path = 'site_config/update/';

    public function defaultAction(){
        $versions = $this->getLatestInfo();

        $C = new Curl('http://support.opentao.net/ru/test_site_speed/update_silent_check/'.$versions->Version[0]->Number);
        $C->setReferer('http://' . $_SERVER['HTTP_HOST'] . '/admin-new/');
        $C->connect();

        $allowUpdate = $C->connect() ? $C->getWebPage() : LangAdmin::get('Cant_connect_to_server');
        // отформатировать историю изменений в виде ненумерованного списка
        $history = $versions->Version[0]->Description;
        $updateNotice = '';
        if (preg_match("#^.*?[\n\r]#si", $history, $m) && !empty($m[0])) {
            preg_match_all("/<a href=\"(.*)\" target=\"_blank\">/isU", $m[0], $matches_url, PREG_PATTERN_ORDER);
            if (! empty($matches_url[1][0])) {
                $tmp = substr($m[0], 0, mb_stripos($m[0], 'ссылке'));
                $updateNotice = $tmp . '<a href="' . $matches_url[1][0] . '" target="_blank">ссылке</a></span>';
            } else {
                $updateNotice = $m[0];
            }
            $history = str_replace($m[0], '', $history);
            $history = str_replace("href=", "target=\"blank\" href=", $history);
            $history = '<ul>' . preg_replace("#[\n\r]+#si", '</li><li>', $history) . '</li></ul>';
            $versions->Version[0]->Description = $history;
        }

        $this->tpl->assign('updateNotice', $updateNotice);
        $this->tpl->assign('allowUpdate', $allowUpdate);
        $this->tpl->assign('versions', $versions);
        $this->tpl->assign('currentVersion', self::getCurrentVersion());

        print $this->fetchTemplate();
    }

    public function downloadAction($request) {
        try{
            $this->authenticationListener->CheckAuthenticationWithException($request);
            $versions = $this->getLatestInfo();
            $res = $this->downloadFile('http://tools.opentao.net/update_rep/zips/opentao_'.$versions->Version[0]->Revision.'.zip', BASE_DIR.'../updates/opentao.zip');
        } catch(Exception $e){            
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('res' => $res));
    }

    public function extractAction() {
        try{
            require dirname(dirname(__FILE__)).'/lib/pclzip/pclzip.lib.php';
            $path = dirname(dirname(dirname(__FILE__))).'/updates/opentao.zip';
            $archive = new PclZip($path);
            chdir(dirname(dirname(dirname(__FILE__))));

            if (file_exists('install')) {
                General::rrmdir('install');
            }
            $archive->extract(PCLZIP_OPT_BY_PREG, "/^install.*/");

            $zip = new ZipArchive;
            if ($zip->open($path) === TRUE) {
                $zip->extractTo('updates');
                $zip->close();
            }
        } catch(Exception $e){            
            $this->respondAjaxError($e->getMessage());
        }
        if (file_exists('install')) {
            $this->sendAjaxResponse(array('res' => 'Ok'));
        } else {
            $this->respondAjaxError(LangAdmin::get('There_is_no_archive_of_updates'));
        }
    }

    public static function getCurrentVersion() {
        $path = dirname(dirname(dirname(__FILE__))) . '/updates/version.xml';
        return file_exists($path) ? simplexml_load_file($path) : 0;
    }

    private function getLatestInfo() {
        $path = 'http://tools.opentao.net/update_rep/info/info.php';
        $info = simplexml_load_string(trim(file_get_contents($path)));
        return $info;
    }

    private function downloadFile($url, $path) {
        $file = @fopen($url, "rb");
        if ($file) {
            $newFile = @fopen($path, "wb");

            if ($newFile)
                while (!feof($file))
                    fwrite($newFile, fread($file, 1024 * 8), 1024 * 8);
            else{
                throw new Exception(LangAdmin::get('Update_folder_not_writable'));
            }
        }
        else{
            throw new Exception(LangAdmin::get('There_is_no_archive_of_updates'));
        }

        if ($file)
            fclose($file);

        if ($newFile)
            fclose($newFile);
    }
}