<?php
require_once ROOT_PATH.'cms/classes/cmssiteapp.class.php';
class Console extends CMS_SiteApp
{
	public function loadConf()
	{
		$site_conf = parent::loadConf(ROOT_PATH.'site/conf/app.conf.yml');
		$fileName  = func_get_arg(0);
		$app_conf  = parent::loadConf($fileName);
		foreach ($app_conf as $key => $val) {
			$site_conf[$key] = $val;
		}
        return $site_conf;
	}
}