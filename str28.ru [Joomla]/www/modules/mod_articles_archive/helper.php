<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_archive
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

class modArchiveHelper
{
	static function getList(&$params)
	{
		//get database
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select('MONTH(created) AS created_month, created, id, title, YEAR(created) AS created_year');
		$query->from('#__content');
		$query->where('state = 2 AND checked_out = 0');
		$query->group('created_year DESC, created_month DESC');

		// Filter by language
		if (JFactory::getApplication()->getLanguageFilter()) {
			$query->where('language in ('.$db->quote(JFactory::getLanguage()->getTag()).','.$db->quote('*').')');
		}

		$db->setQuery($query, 0, intval($params->get('count')));
		$rows = (array) $db->loadObjectList();

		$app	= JFactory::getApplication();
		$menu	= $app->getMenu();
		$element	= $menu->getelements('link', 'index.php?option=com_content&view=archive', true);
		$elementid = isset($element) ? '&elementid='.$element->id : '';

		$i		= 0;
		$lists	= array();
		foreach ($rows as $row) {
			$date = JFactory::getDate($row->created);

			$created_month	= $date->format('n');
			$created_year	= $date->format('Y');

			$created_year_cal	= JHTML::_('date', $row->created, 'Y');
			$month_name_cal	= JHTML::_('date', $row->created, 'F');

			$lists[$i] = new stdClass;

			$lists[$i]->link	= JRoute::_('index.php?option=com_content&view=archive&year='.$created_year.'&month='.$created_month.$elementid);
			$lists[$i]->text	= RText::sprintf('MOD_ARTICLES_ARCHIVE_DATE', $month_name_cal, $created_year_cal);

			$i++;
		}
		return $lists;
	}
}
