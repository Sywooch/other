<?php
/**
 * @version		$Id$
 * @author		Joomlaites
 * @package		Joomlaites
 * @subpackage	mod_jrotator
 * @copyright	Copyright (C) 2015 Joomlaites. All rights reserved.
 * @license		License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once JPATH_SITE . '/components/com_content/helpers/route.php';

JModelLegacy::addIncludePath(JPATH_SITE . '/components/com_content/models', 'ContentModel');

abstract class modjImagerotatorHelper {

	public static function getList(&$params) {
		$data = array();
		$display_form = strtolower($params->get('display_form', 'joomla_content'));
		if ($display_form == 'joomla_content') {
			if ($params->get('enable_cache')) {
				$cache = JFactory::getCache();
				$cache->setCaching(true);
				$cache->setLifeTime($params->get('cache_time', 30) * 60);
				$rows = $cache->get(array((new self()), 'getListArticles'), array($params));
			} else {
				$data = self::getListArticles($params);
			}
		
		}
		return $data;
	}

	
	

	
	
	public static function getListArticles(&$params) {

		$dispatcher = JEventDispatcher::getInstance();

		// Get the dbo
		$db = JFactory::getDbo();

		// Get an instance of the generic articles model
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$model->setState('params', $appParams);

		// Set the filters based on the module params
		$model->setState('list.start', 0);
		$model->setState('list.limit', (int) $params->get('count', 5));
		$model->setState('filter.published', 1);
		
		//Feature filter
		if($params->get('feature',0)){
			$model->setState('filter.featured','only');
		}
		
		// Access filter
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$model->setState('filter.access', $access);

		// Category filter
		$model->setState('filter.category_id', $params->get('catid', array()));

		// Filter by language
		$model->setState('filter.language', $app->getLanguageFilter());

		$ordering = $params->get('sort_order_field', 'created');
		//$dir = $params->get('sort_order', 'DESC');
		switch ($ordering)
		{

			case 'date' :
				$orderby = 'a.created';
				$dir = 'ASC';
				break;

			case 'rdate' :
				$orderby = 'a.created';
				$dir = 'DESC';
				break;

			case 'alpha' :
				$orderby = 'a.title';
				$dir = 'ASC';
				break;

			case 'ralpha' :
				$orderby = 'a.title';
				$dir = 'DESC';
				break;

			case 'order' :
				$orderby = 'a.ordering';
				$dir = 'ASC';
				break;

			case 'rorder' :
				$orderby = 'a.ordering';
				$dir = 'DESC';
				break;

			case 'hits' :
				$orderby = 'a.hits';
				$dir = 'DESC';
				break;

			case 'rand' :
				$orderby = 'RAND()';
				$dir = '';
				break;
				
			case 'modified' :
				$orderby = 'modified';
				$dir = 'DESC';
				break;

			case 'publish_up' :
				$orderby = 'a.publish_up';
				$dir = 'DESC';
				break;
				
			case 'id':
			default :
				$orderby = 'a.id';
				$dir = 'DESC';
			break;
		}
			
		$model->setState('list.ordering',$orderby);
		$model->setState('list.direction', $dir);

		$items = $model->getItems();

		foreach ($items as $item) {
			$item->text = $item->introtext;
			
			$item->num_comments = '';
			$item->num_votes = '';
			$item->votingPercentage = '';
			
			//$dispatcher->trigger('onContentPrepare', array ('com_content.article', &$item, &$paramms));
			$item->introtext = $item->text;

			$item->slug = $item->id . ':' . $item->alias;
			$item->catslug = $item->catid . ':' . $item->category_alias;

			if ($access || in_array($item->access, $authorised)) {
				// We know that user has the privilege to view the article
				$item->link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug, $item->catslug));
			} else {
				$item->link = JRoute::_('index.php?option=com_users&view=login');
			}
			$item->image = '';
			if ($params->get('show_image', 1)) {
				$image = self::parseImages($item, $params);
				if ($image) {
					$item->image = self::renderImage($item->title, $item->link, $image, $params, $params->get('image_width'), $params->get('image_height'));
				} else {
					$item->image = '';
				}
			}
			$item->rtitle = self::trimChar($item->title,$params->get('title_max_char',-1));
			$item->description = self::trimChar($item->introtext, $params->get('description_max_chars', 60));
		}

		return $items;
	}
public static function parseImages(&$row, $params, $context = 'joomla_content') {

		//check if there is image intro or image fulltext  
		$images = "";
		if (isset($row->images)) {
			$images = json_decode($row->images);
		}
		if ((isset($images->image_fulltext) and !empty($images->image_fulltext)) || (isset($images->image_intro) and !empty($images->image_intro))) {
			$image = (isset($images->image_intro) and !empty($images->image_intro)) ? $images->image_intro : ((isset($images->image_fulltext) and !empty($images->image_fulltext)) ? $images->image_fulltext : "");
			return $image;
		} else {
			$text = $row->introtext;
			$regex = "/\<img.+?src\s*=\s*[\"|\']([^\"]*)[\"|\'][^\>]*\>/";
			preg_match($regex, $text, $matches);
			$images = (count($matches)) ? $matches : array();
			if (count($images)) {
				return $images[1];
			}
		}
		return false;
	}
public static function trimChar($string, $maxChar = 50) {

		if ($maxChar == '-1')
			return strip_tags($string);

		if ($maxChar == 0)
			return '';

		if (strlen($string) > $maxChar)
			return JString::substr(strip_tags($string), 0, $maxChar) . ' ...';

		return $string;
	}



	
}