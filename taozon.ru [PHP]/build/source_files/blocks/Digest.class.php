<?php

class Digest extends GenerateBlock {

    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'digestnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct() {
        parent::__construct(true);
    }

    protected function setVars() {

        $cms = new CMS();
        $status = $cms->Check();
        if ($status) {
            $allBlogs = array();
            if (@$_GET['p'] == 'digest') {
								$allCats = $cms->GetAllDigestCategories();
								if (@$_GET['cat'])
									$allPosts = $cms->GetPostsByCat($_GET['cat']);
								else
									$allPosts = $cms->GetAllPosts();
            }
            $GLOBALS['pagetitle'] = Lang::get('digest');
            $this->tpl->assign('digest', $allPosts);
            $this->tpl->assign('digestCats', $allCats);

            $ssid = @$_SESSION['sid'];
            if ($ssid != '') {
                global $otapilib;
                $webui = $otapilib->GetWebUISettings($ssid);
                if ($otapilib->error_message !== 'SessionExpired') {
                    $this->tpl->assign('admin', true);
                    $admin = true;
                    if (isset($_GET['edit']))
                        $this->tpl->assign('show_editor', true);
                } else {
                    $this->tpl->assign('admin', false);
                    $admin = false;
                }
            }
        }
        $this->tpl->assign('status', $status);
    }

}

?>
