<?php

class MultilingualSettings extends GeneralUtil
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'multi';
    protected $_template_path = 'lang/';

    public function __construct()
    {
        parent::__construct();
        $this->cms->checkTable('site_langs');
    }

    public function defaultAction($request)
    {
        try {
            $this->tpl->assign('WebUI', $this->languagesProvider->GetLanguages());
        } catch(ServiceException $e) {
            $this->errorHandler->CheckSessionExpired($e, $request);

            $this->tpl->assign('ServiceError', $e);
            $this->_template = 'error';
            $this->_template_path = '/';
        }
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function addLangToShowcaseAction($request)
    {
        $this->languagesProvider->AddLanguageToWebUI($request->getValue('new_language'));
        if (file_exists(CFG_APP_ROOT . '/cache/GetLanguageInfoList.dat')) {
            unlink(CFG_APP_ROOT . '/cache/GetLanguageInfoList.dat');
        }
        $request->RedirectToReferrer();
    }

    /**
     * @param RequestWrapper $request
     */
    public function deleteLangFromShowcaseAction($request)
    {
        $this->languagesProvider->DeleteLanguageFromWebUI($request->getValue('delete_language'));
        if (file_exists(CFG_APP_ROOT . '/cache/GetLanguageInfoList.dat')) {
            unlink(CFG_APP_ROOT . '/cache/GetLanguageInfoList.dat');
        }
        $request->RedirectToReferrer();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveLangOrderAction ($request)
    {
        try {
            $this->languagesProvider->SaveLanguagesOrder($request->getValue('langs'));
            if (file_exists(CFG_APP_ROOT . '/cache/GetLanguageInfoList.dat')) {
                unlink(CFG_APP_ROOT . '/cache/GetLanguageInfoList.dat');
            }
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }

        $this->sendAjaxResponse();
    }
}
