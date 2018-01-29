<?php

class SitemapGenerator
{
	protected $cms;
	protected $repository;

	function __construct()
	{
		$this->cms = new CMS();
		$this->repository =  new SitemapGeneratorRepository($this->cms);
	}
		
	public function generateSiteMap()
	{
		$pages = $this->getPages();
		$categories = $this->getCategories();

		$url_base = 'http://'.$_SERVER['SERVER_NAME'].'/';
		
		// Generate site map
		$xml = new SimpleXMLElement('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

		if($pages) foreach($pages as $page) {
			$el = $xml->addChild('url');
						
			$el->addChild('loc', $url_base.UrlGenerator::generateContentUrl($page['alias']) );

			if($page['subpages']) foreach($page['subpages'] as $childPage) {
				$el = $xml->addChild('url');
				$el->addChild('loc', $url_base.UrlGenerator::generateContentUrl($childPage['alias']) );
			}
		}

		foreach($categories as $category) {
			$el = $xml->addChild('url');
			$el->addChild('loc', str_replace('&', '&amp;',
					$url_base.UrlGenerator::generateSubcategoryUrl($category)));

			if($category['children']) foreach($category['children'] as $child) {
				$el = $xml->addChild('url');
				$el->addChild('loc', str_replace('&', '&amp;',
						$url_base.UrlGenerator::generateSubcategoryUrl($child)));
			}
		}

		$newXML = Plugins::invokeEvent('onGenerateSiteMap', array('xml' => $xml, 'cms' => $this->cms));

		$result = $newXML ? $newXML->asXML(CFG_APP_ROOT.'/sitemap.xml') : $xml->asXML(CFG_APP_ROOT.'/sitemap.xml');

		return $result;
	}

	private function getPages()
	{
		$menu = array();
        $topMenu = $this->repository->getBlock('top_menu_'.$_SESSION['active_lang']);
        if($topMenu){
            $topMenuFull = json_decode($topMenu);

            foreach($topMenuFull as $m){
                $isContentPage = is_numeric($m);
                $page = $isContentPage ? $this->repository->GetPageByID($m) : array('alias'=>$m,'title'=>Lang::get($m));
                if($page)
                    $menu[] = $page;
            }
        }

        $leftMenu = $this->repository->getBlock('left_menu_'.$_SESSION['active_lang']);
        if($leftMenu){
            $leftMenuFull = json_decode($leftMenu);

            if(!is_array($menu))
                $menu = array();

            foreach($leftMenuFull as $m){
                $isContentPage = is_numeric($m);
                $page = $isContentPage ? $this->repository->GetPageByID($m) : array('alias'=>$m,'title'=>Lang::get($m));
                if($page)
                    $menu[] = $page;
            }
        }

		foreach($menu as $key=>$m) {
			$menu[$key]['subpages'] = false;
			if(isset($m['id'])){
				$menu[$key]['subpages'] = $this->getChildrenPages($m['id']);
			}
		}

		return $menu;
	}

	private function getChildrenPages($id)
	{
		$this->repository->Check();
		$this->repository->checkTable('site_pages_parents');
		$parents = $this->repository->getSitePagesParents($id);

		$children = array();
		foreach($parents as $parent) {
			$children[] = $this->repository->GetPageByID($parent['page_id']);
		}
		return $children;
	}

	private function getCategories()
	{
		global $otapilib;

		$otapilib->curl_timeout = 600;
        $otapilib->setErrorsAsExceptionsOn();
		$categories = $otapilib->GetTwoLevelRootCategoryInfoList();
		if(CMS::IsFeatureEnabled('Seo2')){
            $SeoCatsRepository = new SeoCategoryRepository($this->cms);
            foreach($categories as &$category){
                $category['alias'] = $SeoCatsRepository->getCategoryAlias($category['Id'], true, $category['Name']);
            }
		}

		$treeCats = array();
		if ($categories) foreach($categories as $category) {
			if(!$category['ParentId']) {
				$treeCats[$category['Id']] = array_merge($category, array('children' => array()));
			} else {
				$treeCats[$category['ParentId']]['children'][] = $category;
			}
		}

		return $treeCats;
	}

}
