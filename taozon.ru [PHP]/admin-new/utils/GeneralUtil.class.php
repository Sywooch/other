<?php

OTBase::import('system.lib.Cache');
OTBase::import('system.lib.cache.Key');
OTBase::import('system.lib.cache.adapter.*');
OTBase::import('system.admin-new.lib.otapi_providers.LanguageSettings');
OTBase::import('system.admin-new.lib.RightsManager');

class GeneralUtil
{
    protected $_cache = false; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = ''; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = ''; //- путь к шаблону
    /**
     * @var HSTemplateDisplay
     */
    protected $tpl;
    protected $defaulAction = null;
    public $inMulti = false;            // Находится ли контроллер в вызове мультикурла
    protected $continuedMulti = false;  // Находится ли контроллер в вызове мультикурла после прерывания

    protected static $rightsDependencies = array();   // Список прав, необходимых для доступа к контроллеру

    /**
     * @var CMS
     */
    protected $cms;
    /**
     * @var OTAPILib
     */
    protected $otapilib;

    protected $authenticationListener;
    /**
     * @var LanguageRepository
     */
    protected $langRepository;
    /**
     * @var LanguageSettings
     */
    protected $languagesProvider;
    /**
     * @var ErrorHandler
     */
    protected $errorHandler;

    /**
     * @var AdminUrlWrapper
     */
    protected $pageUrl;

    private $availableLanguages;
    private $CMSLanguages;

    public function __construct($basicInit = false)
    {
        $this->initOTAPILib();
        $this->initTemplateEngine();
        $this->initCMS();
        $this->authenticationListener = new AuthenticationListener();
        $this->errorHandler = new ErrorHandler($this->authenticationListener);
        $this->pageUrl = new AdminUrlWrapper();
        $this->pageUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $cacher = new Cache('CMSLanguages');
        if (! $cacher->has() && CMS::IsFeatureEnabled('MultipleLanguages')) {
            $this->langRepository = new LanguageRepository($this->cms);
            $cacher->set($this->langRepository->GetLanguages());
        }
        $this->CMSLanguages = $cacher->has() ? $cacher->get() : array();

        $this->languagesProvider = new LanguageSettings($this->getOtapilib());

        $this->availableLanguages = $this->languagesProvider->GetActiveLanguages();

    }

    protected function getWebUISettings()
    {
        return $this->languagesProvider->GetLanguages();
    }

    public function onBeforeAction($action)
    {
        if (! $this->_template) {
            $this->_template = strtolower($action);
        }
        if (! $this->_template_path) {
            $this->_template_path = strtolower(get_called_class()) . '/';
        }
    }

    public function getDefaultAction()
    {
        return $this->defaulAction;
    }

    private function initOTAPILib()
    {
        global $otapilib;
        $this->otapilib = $otapilib;
        $this->otapilib->setErrorsAsExceptionsOn();
        $this->otapilib->setUseAdminLangOn();
    }

    private function initTemplateEngine()
    {
        $HSTemplate_options = array(
            'template_path' => TPL_DIR,
            'cache_path'    => TPL_DIR . 'cache',
            'debug'         => false,
        );
        $HSTemplate = new HSTemplate($HSTemplate_options);
        $this->tpl = $HSTemplate->getDisplay($this->_template, true);
    }

    private function initCMS()
    {
        $this->cms = new CMS();
        if (! $this->cms->Check()) {
            throw new DBException('Connection error', DBException::CONNECTION_ERROR);
        }
    }

    public function checkAuth()
    {
        return true;
        $login = Login::auth();
        if(!$login || Session::isSessionExpired()){
            Session::clearError();
            header('Location: index.php?cmd=login');
            return false;
        }
        return true;
    }

    public function respondAjaxError($e, $supressDebug = false)
    {
        $response = array(
            'error' => 1,
        );
        if (is_array($e)) {
            $response['errors'] = $e;
        } elseif ($e instanceof Exception) {
            $response['message'] = $e->getMessage();
        } elseif ($supressDebug && ! (OTBase::isTest() || RequestWrapper::get('debug'))) {
            $response['message'] = $e->getMessage();
        } else {
            $response['message'] = $e;
        }
        if (! $supressDebug && (OTBase::isTest() || RequestWrapper::get('debug'))) {
            $response['debugLog'] = $this->generateDebugReport(true);
        }

        header('Content-type: application/json');
        echo json_encode($response);
        die();
    }

    public function sendAjaxResponse(array $response = array(), $checkForOpera = false, $supressDebug = false)
    {
        if (! $supressDebug && (OTBase::isTest() || RequestWrapper::get('debug'))) {
            $response['debugLog'] = $this->generateDebugReport(true);
        }

        // http://jira.rkdev.ru/browse/OTDEMO-752
        // При загрузке файла аяксом Опера не отправляет заголовок application/json
        if ($checkForOpera && (BrowserHelper::isOpera() && !BrowserHelper::isJsonAcceptable())) {
            header('Content-Type: text/plain; charset=utf-8');
        } else {
            header('Content-Type: application/json; charset=utf-8');
        }

        echo json_encode($response);
        die();
    }

    public function throwAjaxError($e, $code = 500)
    {
        $errorCode = $e instanceof ServiceException ? $e->getErrorCode() : ($e->getCode() ? $e->getCode() : 'Internal error');
        header('HTTP/1.1 '. $code .' ' . $errorCode);
        die($e->getMessage());
    }

    public function setErrorAndRedirect($error, $redirectUrl)
    {
        Session::set('error', $error);
        header('Location: '.$redirectUrl);
        throw new Exception($error);
    }

    /**
     * @return \OTAPILib
     */
    public function getOtapilib()
    {
        return $this->otapilib;
    }


    public function setAdminPerPageCookie($perPageValue)
    {
        Cookie::set('__otAdmin_perPageValue', $perPageValue, time()+86400*30, '/');
    }

    public function getAdminPerPageCookie()
    {
        return Cookie::get('__otAdmin_perPageValue');
    }

    public function getTemplateInfo()
    {
        $info = new stdClass();
        $info->template = $this->_template;
        $info->template_path = $this->_template_path;
        return $info;
    }

    public function fetchTemplate()
    {
        $tpl = TPL_DIR . $this->_template_path;

        $this->pageUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $this->tpl->assign('PageUrl', $this->pageUrl);
        $this->tpl->assign('CMSLanguages', $this->CMSLanguages);
        $this->tpl->assign('AvailableLanguages', $this->availableLanguages);

        $this->tpl->addTemplate($this->_template, $this->_template.'.html', $tpl);
        $body = $this->tpl->fetch($this->_template);
        $header = $this->fetchHeaderBlock();
        $footer = $this->fetchFooterBlock();

        return $header . $body . $footer;
    }

    public function fetchTemplateWithoutHeaderAndFooter($use_tpl_stack = true)
    {
        $tpl = TPL_DIR . $this->_template_path;

        $this->pageUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $this->tpl->assign('PageUrl', $this->pageUrl);
        $this->tpl->assign('CMSLanguages', $this->CMSLanguages);
        $this->tpl->assign('AvailableLanguages', $this->availableLanguages);

        $this->tpl->addTemplate($this->_template, $this->_template.'.html', $tpl, $use_tpl_stack);
        return $this->tpl->fetch();
    }

    public function fetchBlock($blockName, array $blockVars = array(), $extension = 'php')
    {
        $file = TPL_DIR . $this->_template_path . $blockName.'.'.$extension;
        if (file_exists($file)) {
            $tpl = TPL_DIR . $this->_template_path;
        } else {
            $tpl = file_exists(TPL_DIR . 'blocks' . $blockName.'.'.$extension) ? TPL_DIR . 'blocks' : TPL_DIR;
        }

        $this->tpl->addTemplate($blockName, $blockName.'.'.$extension, $tpl);

        $this->pageUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $this->tpl->assign('PageUrl', $this->pageUrl);
        $this->tpl->assign('CMSLanguages', $this->CMSLanguages);
        $this->tpl->assign('AvailableLanguages', $this->availableLanguages);

        if (! empty($blockVars)) {
            foreach ($blockVars as $key => $value) {
                $this->tpl->assign($key, $value, $blockName);
            }
        }

        return $this->tpl->fetch($blockName);
    }

    public function fetchHeaderBlock()
    {
        $adminLanguage = new AdminLanguage(true);

        return $this->fetchBlock('header', array(
            'activeLanguages' => $adminLanguage->getActiveLanguages($this->availableLanguages)
        ));
    }

    public function fetchFooterBlock()
    {
        $debugLog = '';
        if (OTBase::isTest() || RequestWrapper::get('debug')) {
            $debugLog = $this->generateDebugReport();
        }

        return $this->fetchBlock('footer', array(
            'debugLog' => $debugLog
        ));
    }

    public function showErrorPage()
    {
        $tpl = TPL_DIR . 'error';
        $this->assign('header');
        $this->assign('footer');
        $this->tpl->addTemplate('error', 'error.html', $tpl);
        return $this->tpl->fetch();
    }

    /**
     * @return \AdminUrlWrapper
     */
    public function getPageUrl()
    {
        return $this->pageUrl;
    }

    private function renderBlock($blockName)
    {
        ob_start();
        $this->pageUrl->Set("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        $PageUrl = $this->pageUrl;
        $CMSLanguages = $this->CMSLanguages;
        $AvailableLanguages = $this->availableLanguages;
        require TPL_ABSOLUTE_PATH.$blockName.'.php';
        $block = ob_get_contents();
        ob_end_clean();
        return $block;
    }

    private function assign($part)
    {
        ob_start();
        require TPL_ABSOLUTE_PATH.$part.'.php';
        $header = ob_get_contents();
        $this->tpl->assign(ucfirst($part), $header);
        ob_end_clean();
    }

    public function setActiveLanguageForCurrentPage($request, $language)
    {
        Session::set('active_lang_admin_'.$request->get('cmd'), $language);
    }

    public function getActiveLanguageForCurrentPage($request)
    {
        return Session::get('active_lang_admin_'.$request->get('cmd'));
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        die();
    }

    public function escape($string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }

    public function startMulti($continued = false)
    {
        $this->otapilib->InitMulti();
        $this->inMulti = true;
        Session::set('isMultiCurlRunning', true);
        $this->continuedMulti = $continued;
    }

    public function doMulti()
    {
        $this->otapilib->MultiDo();
        $this->inMulti = false;
        Session::clear('isMultiCurlRunning');
    }

    public function stopMulti()
    {
        $this->otapilib->StopMulti();
        $this->inMulti = false;
        Session::clear('isMultiCurlRunning');
        $this->continuedMulti = false;
    }

    public function getMultiCurlActions()
    {
        if (isset($this->multiCurlActions) && is_array($this->multiCurlActions)) {
            return $this->multiCurlActions;
        }
        return array();
    }

    protected function generateDebugReport($returnAsBlocks = false)
    {
        $runtime = round(microtime(true) - $GLOBALS['script_start_time'], 5);

        $blockTitle = '<div class="debug-title">Время основной сборки страницы: ' . $runtime . ' сек.</div><br>';
        $blockBody = '<div class="debug-body">';
        $other = $runtime;
        if (isset($GLOBALS['trace'])) {
            krsort($GLOBALS['trace']);
            foreach($GLOBALS['trace'] as $time => $line) {
                $blockBody .= '    ' . str_replace("\n", '<br>', $line) . '<br>';
                $other -= $time;
            }
        }
        $other = round($other, 5);
        $blockBody .= "    прочее — $other сек.<br>";

        if (isset($GLOBALS['trace'])) {
            $logs = General::GetArrayLogs($GLOBALS['trace']);
        }
        $toecho = '';
        for ($i = 1; $i <= count($logs); $i++) {
            $toecho .= "<br>" . $i . ". - {$logs[$i]['method']} - Время - {$logs[$i]['time']}<br>";

            for ($j = 1; $j < count($logs[$i])-1; $j++) {
                $overhead = '';
                if (! empty($logs[$i][$j]['overtime'])) {
                    $overhead = ' - Время(overhead) : ' . $logs[$i][$j]['overtime'];
                }
                $toecho.="  -->>   {$logs[$i][$j]['method']} - Время : {$logs[$i][$j]['time']}" . $overhead . "<br>";
            }
        }
        $blockBody .= $toecho;

        $blockBody .= "</div>";

        if ($returnAsBlocks) {
            $result = array(
                'title' => $blockTitle,
                'body' => $blockBody,
            );
        } else {
            $result = '<div class="debug-log">' . $blockTitle . $blockBody . '</div>';
        }

        return $result;
    }

    protected function getPageDisplayParams($request, $defaultItemsPerPage = 10)
    {
        $perpageCookie = $this->getAdminPerPageCookie();
        $perpage = $request->getValue('perpage', $perpageCookie);
        $perpage = $perpage ? $perpage : $defaultItemsPerPage;
        $this->setAdminPerPageCookie($perpage);
        $page = $request->getValue('page', 0);
        if (! $this->inMulti) {
            if ($perpageCookie && $perpage > $perpageCookie && $page > 0) {
                $this->redirect($this->pageUrl->deleteKey('page')->get());
            }
        }
        $offset = ($page > 1) ? ($page - 1) * $perpage : 0;
        return array(
            'number'    => $page,
            'offset'    => $offset,
            'limit'     => $perpage,
        );
    }

    protected function getFrameLimits($page, $perpage, $totalCount)
    {
        if ($page <= 0) {
            $page = 1;
        }
        $start = ($page - 1) * $perpage + 1;
        $end = ($page * $perpage >= $totalCount || $totalCount < $perpage) ? $totalCount : $page * $perpage;
        return array(
            'start' => $start,
            'end'   => $end,
        );
    }

    protected function parseTextWithUrl($text)
    {
        return preg_replace(
            array(
                '/(^|\s|>)(www.[^<> \n\r]+)/iex',
                '/(^|\s|>)([_A-Za-z0-9-]+(\\.[A-Za-z]{2,3})?\\.[A-Za-z]{2,4}\\/[^<> \n\r]+)/iex',
                '/(?(?=<a[^>]*>.+<\/a>)(?:<a[^>]*>.+<\/a>)|([^="\']?)((?:https?):\/\/([^<> \n\r]+)))/iex'
            ),
            array(
                "stripslashes((strlen('\\2')>0?'\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>&nbsp;\\3':'\\0'))",
                "stripslashes((strlen('\\2')>0?'\\1<a href=\"http://\\2\" target=\"_blank\">\\2</a>&nbsp;\\4':'\\0'))",
                "stripslashes((strlen('\\2')>0?'\\1<a href=\"\\2\" target=\"_blank\">http://\\3</a>&nbsp;':'\\0'))",
            ),
            $text
        );
    }

    protected static function isActionAllowed()
    {
        if (RightsManager::isSuperAdmin()) {
            return true;
        }

        foreach (static::$rightsDependencies as $right) {
            if (! RightsManager::hasRight($right)) {
                return false;
            }
        }
        return true;
    }
}
