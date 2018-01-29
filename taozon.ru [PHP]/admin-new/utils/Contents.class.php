<?php

OTBase::import('system.uploader.php.UploadHandler');
OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');


class Contents extends GeneralUtil
{
    protected $_template = 'pages';
    protected $_template_path = 'contents/';
    protected $contentsProvider;

    protected $_cache = false;
    protected $_life_time = 3600;
    /**
     * @var bannersRepository
     */
    protected $bannersRepository;

    public function __construct()
    {
        parent::__construct(true);
        $this->contentsProvider = new ContentsProvider($this->cms, $this->getOtapilib());
        $this->cms->checkTable('site_config');
        $this->cms->checkTable('site_langs');
        $this->cms->checkTable('pages');
        $this->bannersRepository = new BannerRepository($this->cms);
    }

    public function defaultAction($request)
    {
        $pages = array();
        $adminPages = array();
        $sid = Session::get('sid');
        try {
            $language = Session::get('active_lang_' . strtolower($request->get('cmd')));
            if (empty($language)) {
                $language = Session::getActiveLang();
                Session::set('active_lang_contents', $language);
            }

            $allPages = $this->contentsProvider->getPages($language);
            $allPages = $this->checkServicePagesExist($allPages, $language);

            foreach ($allPages as $key => $page) {
                if (isset($page['is_service']) && $page['is_service']==1 ) {
                    $adminPages[] = $page;
                } else {
                    $pages[] = $page;
                }
            }

        } catch (Exception $e) {
                ErrorHandler::registerError($e);
        }
        $this->tpl->assign('pages', $pages);
        $this->tpl->assign('adminPages', $adminPages);

        print $this->fetchTemplate();
    }

    function addNewPageAction($request)
    {
        $this->_template_path = 'contents/pages/';
        $this->_template = 'crud';
        $pages = array();
        $languages = array();
        $language = Session::get('active_lang_' . strtolower($request->get('cmd')));
        if (empty($language)) {
            $language = Session::getActiveLang();
            Session::set('active_lang_contents', $language);
        }

        $sid = Session::get('sid');
        try {
            $parentId = intval($request->getValue('parentId'), 0);
            if ($parentId > 0){
                $parent = $this->contentsProvider->getPageInfo($parentId);
                if ($parent) {
                    $language = $parent['lang_code'];
                }
            }
            $type = $request->getValue('type', 'page');
            $pagesList = $this->contentsProvider->getPages($language);
            foreach ($pagesList as $key => $ppage) {
                if (array_key_exists('is_service', $ppage) && $ppage['is_service'] == 1) {
                    continue;
                }
                $pages[] = $ppage;
            }
            $languages = $this->contentsProvider->GetLanguageInfoList();
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }

        $this->tpl->assign('pages', $pages);
        $this->tpl->assign('languages', $languages);
        $this->tpl->assign('language', $language);
        $this->tpl->assign('isService', 0);
        $this->tpl->assign('pageId', 0);
        $this->tpl->assign('parentId', $parentId);
        $this->tpl->assign('pageType', $type);

        print $this->fetchTemplate();
    }

    function editPageAction($request)
    {
        $this->_template_path = 'contents/pages/';
        $this->_template = 'crud';
        $pages = array();
        $languages = array();
        $sid = Session::get('sid');
        $pageId = 0;
        $language = Session::get('active_lang_' . strtolower($request->get('cmd')));
        if (empty($language)) {
            $language = Session::getActiveLang();
            Session::set('active_lang_contents', $language);
        }

        $page = array('is_service' => 0, 'parentId' => 0, 'lang_code' => $language );
        try {
            $pageId = intval($request->getValue('id'));
            $page = $this->contentsProvider->getPageInfo($pageId);
            if (! array_key_exists('is_service', $page)) {
                $page['is_service'] = 0;
            }

            $page['parentId'] = $this->contentsProvider->getPageParentId($pageId);
            $page['menu'] = $this->contentsProvider->getPageMenu($page);
            $page['content'] = $this->contentsProvider->getPageContent($pageId);
            if (! array_key_exists('parentId', $page)) {
                $page['parentId'] = 0;
            }

            $pagesList = $this->contentsProvider->getPages($language);
            // skip services pages
            foreach ($pagesList as $key => $ppage) {
                if (array_key_exists('is_service', $ppage) && $ppage['is_service'] == 1) {
                    continue;
                }
                $pages[] = $ppage;
            }
            $languages = $this->contentsProvider->GetLanguageInfoList();
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }

        $this->tpl->assign('pages', $pages);
        $this->tpl->assign('languages', $languages);
        $this->tpl->assign('language', $page['lang_code']);
        $this->tpl->assign('isService', $page['is_service']);
        $this->tpl->assign('page', $page);
        $this->tpl->assign('pageId', $pageId);

        $this->tpl->assign('parentId', $page['parentId']);
        $this->tpl->assign('pageType', $page['parentId'] ? 'sub_page' : 'page');

        print $this->fetchTemplate();
    }


    public function savePageAction($request)
    {
        $sid = Session::get('sid');
        try {
            $id = intval($request->getValue('id'));
            $isService = intval($request->getValue('is_service'));
            $title = $request->getValue('title');
            $titleh1 = $request->getValue('titleh1');
            $alias = $request->getValue('alias');
            $pageLevel = $request->getValue('page-level');
            $pageMenu = $request->getValue('page-menu');
            $pageParent = $request->getValue('page-parent');
            $pageLanguage = $request->getValue('page-language');
            $pageTitle = $request->getValue('page-title');
            $pageKeywords = $request->getValue('page-keywords');
            $pageDescription = $request->getValue('page-description');
            $pageContent = $request->getValue('page-content');

            //validate

            $validator = new Validator(array(
                'title' => trim($title),
                'content' => trim($pageContent),
                'alias' => trim($alias),
            ));
            $validator->addRule(new NotEmptyString(), 'title', LangAdmin::get('Title_cannot_be_empty'));
            if (! $isService) {
                $validator->addRule(new NotEmptyString(), 'content', LangAdmin::get('contents::Content_cannot_be_empty'));
                $validator->addRule(new NotEmptyString(), 'alias', LangAdmin::get('contents::Alias_cannot_be_empty'));
                $validator->addRule(new PageAliasString($this->contentsProvider, $pageLanguage, $id), 'alias', LangAdmin::get('contents::Alias_already_in_use'));
            }
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }

            //save
            if ($id != 0 ) {
                // update
                $pageId = $id;
                $this->contentsProvider->updatePage($pageId, $alias, $title, $isService, $titleh1);
            } else {
                // add page
                $pageId = $this->contentsProvider->addPage($alias, $title, $isService, $titleh1);
            }

            $this->contentsProvider->setPageContent($pageId, $pageContent);

            if (! $isService) {
                // set page language
                $langId = $this->contentsProvider->setPageLang($pageId, $pageLanguage);
                // set page data

                $this->contentsProvider->setPageData($langId, $alias, $pageTitle, $pageKeywords, $pageDescription);

                if ($pageLevel == 'page') {
                    //set page menu
                    $this->contentsProvider->clearPageParent($pageId);
                    if ($pageMenu != 'without_menu') {
                        // remove page from menu
                        $this->contentsProvider->deletePageFromMenu($pageId);
                        //add to new menu
                        $menuType = $pageMenu . '_' . $pageLanguage;
                        $this->contentsProvider->addPageToMenu($pageId, $menuType);
                    } else {
                        //remove from menu
                        $this->contentsProvider->deletePageFromMenu($pageId);
                    }
                } else {
                    $this->contentsProvider->deletePageFromMenu($pageId);
                    //set page parent
                    $this->contentsProvider->clearPageParent($pageId);
                    if ( $pageLevel == 'sub_page' && $pageParent) {
                        $this->contentsProvider->setPageParent($pageId, $pageParent);
                    }
                }
            }

        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'), true);
    }

    public function deletePageAction($request)
    {
        try {
            $pageId = intval($request->getValue('id'));
            $this->contentsProvider->deletePage($pageId);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'), true);
    }

    function navigationAction($request)
    {
        $this->_template = 'nav';
        $sid = Session::get('sid');
        $allDocs = array();
        $top_menu = array();
        $bottom_menu = array();
        $left_menu = array();
        try {
            $current_lang = Session::get('active_lang_' . strtolower($request->get('cmd')));
            if (empty($current_lang)) {
                $current_lang = Session::getActiveLang();
                Session::set('active_lang_contents', $current_lang);
            }
            $all_docs = $this->contentsProvider->getPagesByLang($current_lang);

            $top_menu = $this->contentsProvider->getMenu('top_menu_' . $current_lang);
            $bottom_menu = $this->contentsProvider->getMenu('bottom_menu_' . $current_lang);
            $left_menu = $this->contentsProvider->getMenu('left_menu_' . $current_lang);
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }

        $this->tpl->assign('allDocs', $all_docs);
        $this->tpl->assign('topMenu', $top_menu);
        $this->tpl->assign('bottomMenu', $bottom_menu);
        $this->tpl->assign('leftMenu', $left_menu);

        print $this->fetchTemplate();
    }

    function saveMenuAction($request)
    {
        try {
            $type = $request->getValue('type');
            $ids = $request->getValue('ids');
            if (!is_array($ids)) {
                $ids = array();
            }

            $current_lang = Session::get('active_lang_' . strtolower($request->get('cmd')));
            if (empty($current_lang)) {
                $current_lang = Session::getActiveLang();
                Session::set('active_lang_contents', $language);
            }

            $this->contentsProvider->saveMenu($type . '_' . $current_lang, $ids);

            $this->sendAjaxResponse(array('result' => 'ok'), true);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'), true);
    }

    public function newsAction($request)
    {
        $this->_template = 'news';
        $sid = Session::get('sid');
        $news = array('count' => 0, 'rows' => array());
        try {
            $page = $this->getPageDisplayParams($request);

            $perpage = $page['limit'];
            $pageNum = $page['number'];
            $from = $page['offset'];

            //get selected language
            $current_lang = Session::get('active_lang_' . strtolower($request->get('cmd')));
//             if (empty($current_lang)) {
//                 $current_lang = Session::getActiveLang();
//             }

            //get news
            $news = $this->contentsProvider->getAllNews($current_lang, $from, $perpage);
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }

        $this->tpl->assign('newsList', $news['rows']);
        $this->tpl->assign('paginator', new Paginator($news['count'], $pageNum, $perpage));
        print $this->fetchTemplate();
    }


    /**
     * @param RequestWrapper $request
     */
    public function bannersAction($request)
    {
        $this->_template = 'banners';
        try {
            if ($request->getValue('lang')) {
                $current_lang = $request->getValue('lang');
            } else {
                $current_lang = false;
            }
            $this->tpl->assign('banners', $this->bannersRepository->GetBanners($current_lang));
            $this->tpl->assign('languages', $this->languagesProvider->GetActiveLanguages());
            $this->tpl->assign('current_lang', $current_lang);
        } catch (DBException $e) {
            $this->errorHandler->registerError($e);
        }
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function deleteBannerAction($request)
    {
        try {
            $this->bannersRepository->DelBanner($request->getValue('bannerId'));
            $this->sendAjaxResponse();
        } catch (DBException $e) {
            $this->respondAjaxError($e->getMessage());
        }
    }

    /**
     * @param RequestWrapper $request
     */
    public function bannerFormAction($request)
    {
        $this->_template = 'banner_form';
        try {
            if ($request->getValue('bannerId')) {
                $bennerData = $this->bannersRepository->GetOneBanner($request->getValue('bannerId'));
            } else {
                $bennerData = array();
            }
            $this->tpl->assign('bennerData', $bennerData);
            $this->tpl->assign('languages', $this->languagesProvider);
        } catch (DBException $e) {
            $this->errorHandler->registerError($e);
        }
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveBannerAction($request)
    {
        try {
            $logoUrl = $this->getNameUploadImage();
            if (! $logoUrl) {
                $logoUrl = $request->getValue('existing_logo');
            }
            $validator = new Validator(array(
                'name'        => $request->getValue('bannerName')
            ));
            $validator->addRule(new NotEmptyString(), 'name', LangAdmin::get('You_must_set_the_bannername'));
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }
            $saveData = array(
                'id' => $request->getValue('bannerId'),
                'desc' => $request->getValue('bannerName'),
                'link' => $request->getValue('bannerUrl'),
                'language' => $request->getValue('bannerLang'),
            );
            if ($request->getValue('bannerId')) {
                $this->bannersRepository->EditBanner($saveData, $logoUrl);
            } else {
                $this->bannersRepository->AddBanner($saveData, $logoUrl);
            }
            $this->sendAjaxResponse();
        } catch (DBException $e) {
            $this->respondAjaxError($e->getMessage());
        }
    }

    /**
     * @param RequestWrapper $request
     */
    public function saveBannerSortAction($request)
    {
        try {
            $sort = $request->getValue('sort');
            foreach ($sort as $i => $id) {
                $this->bannersRepository->UpdateBanner($id, $i);
            }
            $this->sendAjaxResponse();
        } catch (DBException $e) {
            $this->respondAjaxError($e->getMessage());
        }
    }

    private function uploadImage()
    {
        $uploader = new UploadHandler(array(
            'param_name' => 'uploaded_logo',
            'image_versions' => array(
                '' => array(
                    'max_width' => 1200,
                    'max_height' => 600,
                    'jpeg_quality' => 95,
                    'crop' => true
                ),
            ),
        ), false, null, '/uploaded/banners/');
        return $uploader->post(false);
    }

    private function uploadNewsImage($id)
    {
        $uploader = new UploadHandler(array(
            'param_name' => 'new_image',
            'image_versions' => array(
                'large' => array(
                    'max_width' => 800,
                    'max_height' => 600,
                    'jpeg_quality' => 95,
                    'name' => 'large'
                ),
                'big' => array(
                    'max_width' => 300,
                    'max_height' => 200,
                    'jpeg_quality' => 95,
                    'name' => 'big'
                ),
                'thumb' => array(
                    'max_width' => 100,
                    'max_height' => 100,
                    'jpeg_quality' => 90,
                    'name' => 'thumb'
                )
            ),
        ), false, null, '/uploaded/news/' . $id . '/');
        return $uploader->post(false);
    }

    private function getNameUploadImage()
    {
        if (! empty($_FILES['uploaded_logo']['tmp_name'])) {
            $uploadResult = $this->uploadImage();
            if (isset($uploadResult['uploaded_logo'][0])) {
                if (isset($uploadResult['uploaded_logo'][0]->url)) {
                    $logoUrl = $uploadResult['uploaded_logo'][0]->url;
                } else if (isset($uploadResult['uploaded_logo'][0]->error)) {
                    $this->respondAjaxError($uploadResult['uploaded_logo'][0]->error);
                }
            } else {
                $this->respondAjaxError('Unknown error occured while uploading image. Try again.');
            }
        } else {
            $logoUrl = '';
        }
        return $logoUrl;
    }

    private function getNameUploadNewsImage($id)
    {
        $imageUrl = '';
        if (! empty($_FILES['new_image']['tmp_name'])) {
            $uploadResult = $this->uploadNewsImage($id);
            if (isset($uploadResult['new_image'][0])) {
                if (isset($uploadResult['new_image'][0]->url)) {
                    $path_info = pathinfo($uploadResult['new_image'][0]->url);
                    $imageUrl = '/uploaded/news/' . $id . '/thumb.' . $path_info['extension'];
                } else if (isset($uploadResult['new_image'][0]->error)) {
                    $this->respondAjaxError($uploadResult['new_image'][0]->error);
                }
            } else {
                $this->respondAjaxError('Unknown error occured while uploading image. Try again.');
            }
        } else {
            $imageUrl = '';
        }
        return $imageUrl;
    }

    public function deleteNewsAction($request)
    {
        try {
            $newsId = intval($request->getValue('id'));
            $this->contentsProvider->deleteNews($newsId);
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'), true);

    }

    public function editNewsAction($request)
    {
        $this->_template_path = 'contents/news/';
        $this->_template = 'crud';
        $news = array();
        $languages = array();
        try {
            $newsId = intval($request->getValue('id'));
            $news = $this->contentsProvider->getNews($newsId);
            $languages = $this->contentsProvider->GetLanguageInfoList();
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }
        $this->tpl->assign('news', $news);
        $this->tpl->assign('languages', $languages);
        print $this->fetchTemplate();
    }

    public function addNewsAction($request)
    {
        $this->_template_path = 'contents/news/';
        $this->_template = 'crud';
        $language = Session::get('active_lang_' . strtolower($request->get('cmd')));
        if (empty($language)) {
            $language = Session::getActiveLang();
        }

        $news = array('id' => '0', 'title' => '', 'text' => '', 'brief' => '', 'lang-code' => $language);
        $languages = array();
        try {
            $newsId = intval($request->getValue('id'));
            $news = $this->contentsProvider->getNews($newsId);
            $languages = $this->contentsProvider->GetLanguageInfoList();
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }
        $this->tpl->assign('news', $news);
        $this->tpl->assign('languages', $languages);
        print $this->fetchTemplate();
    }

    public function saveNewsAction($request) {
        $sid = Session::get('sid');
        try {
            $id = intval($request->getValue('id'));
            $title = $request->getValue('news-title');
            $preview = $request->getValue('news-preview');
            $content = $request->getValue('news-content');
            $lang = $request->getValue('news-language');
            $image = $request->getValue('image');

            //validate
            $validator = new Validator(array(
                'news-title' => trim($title),
                'news-content' => trim($content),
                'news-preview' => trim($preview),
            ));

            $validator->addRule(new NotEmptyString(), 'news-content', LangAdmin::get('contents::Content_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(), 'news-preview', LangAdmin::get('contents::Brief_cannot_be_empty'));
            $validator->addRule(new NotEmptyString(), 'news-title', LangAdmin::get('Title_cannot_be_empty'));
            if (! $validator->validate()) {
                $this->respondAjaxError($validator->getErrors());
            }

            //add new if need
            if ( !$id) {
                $id = $this->contentsProvider->createNews($title, $preview, $content, '', $lang);
            }

            //file
            $newImage = $this->getNameUploadNewsImage($id);
            if ($newImage) {
                $image = $newImage;
            }

            //update
            settype($id, 'int');
            $this->contentsProvider->updateNewsById($id, $title, $preview, $content, $image, $lang);

        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse(array('result' => 'ok'), true);
    }

    private function checkServicePagesExist($allPages, $language)
    {
        $languages = $this->contentsProvider->GetLanguageInfoList();
        $lang_name = '';
        foreach ($languages as $lang) {
            if ($lang['Name'] == $language) {
                $lang_name = $lang['Description'];
                break;
            }
        }        
        if (! $this->arraySearch('404', $allPages)) {
            $pageId = $this->contentsProvider->addPage('404', LangAdmin::get('404'), 1);
            $this->contentsProvider->setPageLang($pageId, $language);
            $allPages[] = array(
                'id'         => $pageId,
                'alias'      => '404',
                'title'      => LangAdmin::get('404'),
                'is_service' => 1,
                'lang_name'  => $lang_name,
                'lang_code'  => $language,
                'menu'       => '',
                'children'   => array()
            );
        }
        return $allPages;
    }

    private function arraySearch($value, $array)
    {
        $result = false;
        foreach ($array as $param) {
            if (array_search($value, $param) !== false) {
                return true;
            }
        }
        return $result;
    }
}
