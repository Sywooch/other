<?php
require_once 'cms/classes/cmssiteapp.class.php';
class Site extends CMS_SiteApp
{
	public function run()
	{
		$this->page->addPluginsDir('site/smarty_plugins/');
		parent::run();
	}
}