<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_breadcrumbs
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

class modBreadCrumbsHelper
{
	public static function getList(&$params)
	{
		// Get the PathWay object from the application
		$app		= JFactory::getApplication();
		$pathway	= $app->getPathway();
		$elements		= $pathway->getPathWay();

		$count = count($elements);
		for ($i = 0; $i < $count; $i ++)
		{
			$elements[$i]->name = stripslashes(htmlspecialchars($elements[$i]->name, ENT_COMPAT, 'UTF-8'));
			$elements[$i]->link = JRoute::_($elements[$i]->link);
		}

		if ($params->get('showHome', 1))
		{
			$element = new stdClass();
			$element->name = htmlspecialchars($params->get('homeText', RText::_('MOD_BREADCRUMBS_HOME')));
			$element->link = JRoute::_('index.php?elementid='.$app->getMenu()->getDefault()->id);
			array_unshift($elements, $element);
		}

		return $elements;
	}

	/**
	 * Set the breadcrumbs separator for the breadcrumbs display.
	 *
	 * @param	string	$custom	Custom xhtml complient string to separate the
	 * elements of the breadcrumbs
	 * @return	string	Separator string
	 * @since	1.5
	 */
	public static function setSeparator($custom = null)
	{
		$lang = JFactory::getLanguage();

		// If a custom separator has not been provided we try to load a template
		// specific one first, and if that is not present we load the default separator
		if ($custom == null) {
			if ($lang->isRTL()){
				$_separator = JHtml::_('image', 'main/arrow_rtl.png', NULL, NULL, true);
			}
			else{
				$_separator = JHtml::_('image', 'main/arrow.png', NULL, NULL, true);
			}
		} else {
			$_separator = htmlspecialchars($custom);
		}

		return $_separator;
	}
}
