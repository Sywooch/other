<?php

OTBase::import('system.lib.DBCache');

class CacheSettings extends GeneralUtil
{
    protected $_template = 'cache_settings';
    protected $_template_path = 'site_config/system/';

    public function defaultAction()
    {
        print $this->fetchTemplate();
    }

    public function cacheCleanAction()
    {
        try {
            $this->otapilib->ResetInstanceCaches();
            Cacher::rRmDir(CFG_APP_ROOT . '/cache/', false);

            $dbCache = new DBCache();
            $dbCache->ClearDBCache();
        } catch (ServiceException $e) {
            $this->respondAjaxError(LangAdmin::get('reset_cache_fail') . ' ' . $e->getMessage());
        }

        $this->sendAjaxResponse(array(
            'message' => LangAdmin::get('reset_cache_success')
        ));
    }
}
