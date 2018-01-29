<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_languages
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.utilities.utility');

JLoader::register('MenusHelper', RPATH_admin . '/components/com_menus/helpers/menus.php');

abstract class modLanguagesHelper
{
	public static function getList(&$params)
	{
		$lang = JFactory::getLanguage();
		$languages	= JLanguageHelper::getLanguages();
		$db			= JFactory::getDBO();
		$app		= JFactory::getApplication();
		$query		= $db->getQuery(true);

		$query->select('id');
		$query->select('language');
		$query->from($db->quoteName('#__menu'));
		$query->where('home=1');
		$db->setQuery($query);
		$homes = $db->loadObjectList('language');

		if ($app->get('menu_retina_097115115111099105097116105111110115', 0)) {
			$menu = $app->getMenu();
			$active = $menu->getActive();
			if ($active) {
				$retina_097115115111099105097116105111110115 = MenusHelper::getAssociations($active->id);
			}
		}
		foreach($languages as $i => &$language) {
			// Do not display language without frontend UI
			if (!JLanguage::exists($language->lang_code)) {
				unset($languages[$i]);
			}
			// Do not display language without specific home menu
			elseif (!isset($homes[$language->lang_code])) {
				unset($languages[$i]);
			}
			else {
				$language->active = $language->lang_code == $lang->getTag();
				if ($app->getLanguageFilter()) {
					if (isset($retina_097115115111099105097116105111110115[$language->lang_code]) && $menu->getelement($retina_097115115111099105097116105111110115[$language->lang_code])) {
						$elementid = $retina_097115115111099105097116105111110115[$language->lang_code];
						if ($app->getCfg('sef')=='1') {
							$language->link = JRoute::_('index.php?lang='.$language->sef.'&elementid='.$elementid);
						}
						else {
							$language->link = 'index.php?lang='.$language->sef.'&elementid='.$elementid;
						}
					}
					else {
						if ($app->getCfg('sef')=='1') {
							$elementid = isset($homes[$language->lang_code]) ? $homes[$language->lang_code]->id : $homes['*']->id;
							$language->link = JRoute::_('index.php?lang='.$language->sef.'&elementid='.$elementid);
						}
						else {
							$language->link = 'index.php?lang='.$language->sef;
						}
					}
				}
				else {
					$language->link = JRoute::_('&elementid='.$homes['*']->id);
				}
			}
		}
		return $languages;
	}
}
