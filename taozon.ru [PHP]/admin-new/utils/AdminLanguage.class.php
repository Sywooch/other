<?php
class AdminLanguage extends GeneralUtil
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'lang_js';
    protected $_template_path = 'translation/';

    /**
     * @param RequestWrapper $request
     */
    public function setSiteLangAction($request)
    {
        Session::set('active_lang', $request->getValue('lang'));
        $retpath = $request->getValue('retpath');
        $retpath = !empty($retpath) ? $retpath : RequestWrapper::env('HTTP_REFERER', '/admin/');
        $this->redirect($retpath);
    }

    /**
     * @param RequestWrapper $request
     */
    public function setAdminLangAction($request)
    {
        Session::set('active_lang_admin', $request->getValue('lang'));
        $retpath = $request->getValue('retpath');
        $retpath = !empty($retpath) ? $retpath : RequestWrapper::env('HTTP_REFERER', '/admin/');
        $this->redirect($retpath);
    }

    /**
     * @param RequestWrapper $request
     */
    public function setPageLangAction($request)
    {
        $referer = new UrlWrapper();
        $cmd = $referer->Set($_SERVER['HTTP_REFERER'])->GetKey('cmd');
        if (! $cmd) {
            $cmd = Permission::default_cmd();
        }
        Session::set('active_lang_' . strtolower($cmd), $request->getValue('lang'));

        $retpath = $request->getValue('retpath');
        $retpath = !empty($retpath) ? $retpath : RequestWrapper::env('HTTP_REFERER', '/admin/');
        $this->redirect($retpath);
    }

    public function getTranslationsAction()
    {
        header('Content-type: text/javascript');
        $M = new FileAndMysqlMemoryCache(new CMS());
        if (! OTBase::isTest() && $M->Exists('admin_new:translations')) {
            $this->tpl->assign('translations', $M->GetCacheEl('admin_new:translations'));
        }
        else {
            $translations = json_encode(LangAdmin::getAllTranslations());
            $M->AddCacheEl('admin_new:translations', 3600, $translations);
            $this->tpl->assign('translations', $translations);
        }
        print $this->fetchTemplateWithoutHeaderAndFooter();
    }

    public function getActiveLanguages($availableLanguages = null)
    {
        $this->_template_path = 'lang/';
        $this->_template = 'active';
        try {
            if (is_null($availableLanguages)) {
                $availableLanguages = $this->otapilib->GetLanguageInfoList();
            }
            $this->tpl->assign('languages', $availableLanguages);
            return $this->fetchTemplateWithoutHeaderAndFooter();
        }
        catch (ServiceException $e) {
            return $this->errorHandler->showErrorWithPNotify($e);
        }
    }
}