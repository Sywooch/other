<?php

class Digest extends GenerateBlock {

    protected $_cache = CFG_CACHED; //- кэшируем или нет.
    protected $_life_time = 3600; //- время на которое будем кешировать
    protected $_template = 'digestnew'; //- шаблон, на основе которого будем собирать блок
    protected $_template_path = '/main/';
	
	/**
     * @var digest
     */
    protected $digest;

    public function __construct() {
		
        parent::__construct(true);
		$this->digest = new DigestRepository(new CMS());		
    }

    protected function setVars() { 
		if ($this->request->valueExists('page')) {
			$page = $this->request->getValue('page')-1;
		} else {
			$page = 0;
		}			
		$page_count = General::getNumConfigValue('blog_posts') ? General::getNumConfigValue('blog_posts') : 20;
		if ($this->request->getValue('perpage')) {
		    $page_count = $this->request->getValue('perpage');
		} 
        if ($this->request->getValue('p') == 'digest') {
			try {
				if ($this->request->getValue('cat')) {
					$cat = $this->digest->GetCategoryByAlias($this->request->getValue('cat'));
					$allPosts = $this->digest->GetPostsByCat($cat[0]['id'], $page * $page_count, $page_count);
					$CountPosts = $this->digest->GetCountPostsByCat($cat[0]['id']);
                    $GLOBALS['pagetitle'] = $cat[0]['title'];
				}	else {
					$allPosts = $this->digest->GetPostsByLang(Session::get('active_lang'), $page*$page_count, $page_count);
					$CountPosts = $this->digest->GetCountPostsByLang(Session::get('active_lang'));
                    $GLOBALS['pagetitle'] = Lang::get('digest');
				}
			} catch (DBException $e) {
           		Session::setError($e->getMessage(), 'DBError');                
          	}
        }

        $this->tpl->assign('digest', $allPosts);
		$this->tpl->assign('cur_cat', $this->request->getValue('cat'));
        $this->tpl->assign('page', $page);	
		$this->tpl->assign('per_page', $page_count);			
		$this->tpl->assign('CountPosts', $CountPosts);
		$this->tpl->assign('paginator', new Paginator($CountPosts, $page+1, $page_count));
    }

}
