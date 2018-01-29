<?php
class Translations extends GeneralUtil {
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'list';
    protected $_template_path = 'translation/';
    /**
     * @var TranslationsRepository
     */
    private $translationsRepository;

    public function __construct(){
        parent::__construct();
        $this->cms->checkTable('site_langs');
        $this->translationsRepository = new TranslationsRepository($this->cms);
    }

    /**
     * @param RequestWrapper $request
     */
    public function defaultAction($request)
    {
        $this->authenticationListener->CheckAuthentication($request);

        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function getTranslationsJSONAction($request){
        $this->authenticationListener->CheckAuthentication($request);

        $this->_template = 'list_json';
        $translations = $this->translationsRepository->GetAllTranslationsByKeys();
        $this->tpl->assign('activeLang', $request->getValue('lang') ? $request->getValue('lang') : 'ru');
        $this->tpl->assign('translations', $translations);
        print $this->fetchTemplateWithoutHeaderAndFooter();
    }

    /**
     * @param RequestWrapper $request
     */
    public function deleteAction($request){
        $this->authenticationListener->CheckAuthentication($request);

        try{
            $this->translationsRepository->DeleteTranslationsByKeyFromDB($request->getValue('key'));
        }
        catch(Exception $e){
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    /**
     * @param RequestWrapper $request
     */
    public function editAction($request){
        $this->authenticationListener->CheckAuthentication($request);

        $this->_template = 'crud';

        $this->tpl->assign('key', $request->getValue('key'));
        $translations = $this->translationsRepository->GetTranslationsByKey($request->getValue('key'));
        $translationsByLangCodes = array();
        foreach($translations as $v){
            $translationsByLangCodes[$v['lang_code']] = $v['translation'];
        }
        $translations = $this->translationsRepository->GetAllTranslationsByKeys();
        $translation = $translations[$request->getValue('key')];
        foreach ($translation as $lang => $value) {
            if (! array_key_exists($lang, $translationsByLangCodes) && is_array($value) && count($value)>0 ) {
                $translationsByLangCodes[$lang] = $value['translation'];
            }
        } 
        
        $this->tpl->assign('translation', $translationsByLangCodes);

        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveKeyAction($request){
        $this->authenticationListener->CheckAuthentication($request);

        $this->translationsRepository->AddTranslation($request->post('key'), $request->post('translation'));

        //$this->pageUrl->Add('key', $request->post('key'))->Add('do', 'edit');
        $request->LocationRedirect($this->pageUrl->DeleteKey('do')->Get());
    }
}