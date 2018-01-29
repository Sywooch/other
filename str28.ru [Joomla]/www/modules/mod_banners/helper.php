<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_banners
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.component.model');

class modBannersHelper
{
	static function &getList(&$params)
	{
		jimport('retina.application.component.model');
		JModel::addIncludePath(RPATH_ROOT.'/components/com_banners/models', 'BannersModel');
		$document	= JFactory::getDocument();
		$app		= JFactory::getApplication();
		$keywords	= explode(',', $document->getMetaData('keywords'));

		$model = JModel::getInstance('Banners', 'BannersModel', array('ignore_request'=>true));
		$model->setState('filter.client_id', (int) $params->get('cid'));
		$model->setState('filter.category_id', $params->get('catid', array()));
		$model->setState('list.limit', (int) $params->get('count', 1));
		$model->setState('list.start', 0);
		$model->setState('filter.ordering', $params->get('ordering'));
		$model->setState('filter.tag_search', $params->get('tag_search'));
		$model->setState('filter.keywords', $keywords);
		$model->setState('filter.language', $app->getLanguageFilter());

		$banners = $model->getelements();
		$model->impress();

		return $banners;
	}
}
