<?php

class ContentData extends GenerateBlock
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'content'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
        $cms = new CMS();
        $status = $cms->Check();
        $cms->checkSiteUnavailablePageExists();

        if ($status) {
            $alias = @General::$siteConf['site_temporary_unavailable'] ? 'site_unavailable' : SCRIPT_NAME;

            if(@$_GET['pid']){
                $page = $cms->GetFullPageById((int)$_GET['pid']);
            } else {
                $page = $cms->GetPageByAlias($alias);
            }
            $this->tpl->assign('page', $page);

            $ssid = @$_SESSION['sid'];
            if ($ssid != '')
            {
                global $otapilib;
                $webui = $otapilib->GetWebUISettings($ssid);
                if ($otapilib->error_message !== 'SessionExpired')
                {
                    $this->tpl->assign('admin', true);
                    $admin = true;
                    if (isset($_GET['edit'])) $this->tpl->assign('show_editor', true);
                } else {
                    $this->tpl->assign('admin', false);
                    $admin = false;
                }
            }

            // получить все левое меню
            $left_menu_json = $cms->getBlock('left_menu_'.$_SESSION['active_lang']);
            $left_menu_ids = $left_menu_json ? json_decode($left_menu_json) : array();
            $left_menu = array();

            foreach ($left_menu_ids as $pid) {
                $pageCurrent = $cms->GetPageByID($pid);
                // если по умолчанию OR текущая страница == текущий раздел  OR родитель страницы == текущий раздел
                if ((General::getSiteConfig('show_all_page')) or ($page['id'] == $pid) or ($cms->get_parent_id_site_pages_parents_page_id($page['id'])) == $pid) {
                    $pageCurrent['children'] = $this->getChildrenPages($pid);
                } else {
                    $pageCurrent['children'] = Array();
                }
                $left_menu[] = $pageCurrent;
            }
            $this->tpl->assign('left_menu', $left_menu);

            $text = $page['text'];
            $this->tpl->assign('text', $text);
        } else {
            //
        }
        $this->tpl->assign('status', $status);
    }

    public function getChildrenPages($id)
    {
        $cms = new CMS();
        $cms->Check();
        $cms->checkTable('site_pages_parents');
        $q = mysql_query("SELECT * FROM `site_pages_parents` WHERE `parent_id`='$id'");
        $children = array();
        if(!$q){
            show_error(mysql_error());
            return;
        }
        if(!mysql_num_rows($q))
            return array();
        while($row = mysql_fetch_assoc($q)){
            $children[] = $cms->GetPageByID($row['page_id']);
        }
        return $children;
    }

}

?>