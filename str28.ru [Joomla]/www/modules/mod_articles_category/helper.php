<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_articles_category
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.application.component.model');

$com_path = RPATH_SITE.'/components/com_content/';
require_once $com_path.'router.php';
require_once $com_path.'helpers/route.php';

jimport('retina.application.component.model');

JModel::addIncludePath($com_path . '/models', 'ContentModel');

abstract class modArticlesCategoryHelper
{
	public static function getList(&$params)
	{
		// Get an instance of the generic articles model
		$articles = JModel::getInstance('Articles', 'ContentModel', array('ignore_request' => true));

		// Set application parameters in model
		$app = JFactory::getApplication();
		$appParams = $app->getParams();
		$articles->setState('params', $appParams);

		// Set the filters based on the module params
		$articles->setState('list.start', 0);
		$articles->setState('list.limit', (int) $params->get('count', 0));
		$articles->setState('filter.published', 1);

		// Access filter
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));
		$articles->setState('filter.access', $access);

		// Prep for Normal or Dynamic Modes
		$mode = $params->get('mode', 'normal');
		switch ($mode)
		{
			case 'dynamic':
				$option = JRequest::getCmd('option');
				$view = JRequest::getCmd('view');
				if ($option === 'com_content') {
					switch($view)
					{
						case 'category':
							$catids = array(JRequest::getInt('id'));
							break;
						case 'categories':
							$catids = array(JRequest::getInt('id'));
							break;
						case 'article':
							if ($params->get('show_on_article_page', 1)) {
								$article_id = JRequest::getInt('id');
								$catid = JRequest::getInt('catid');

								if (!$catid) {
									// Get an instance of the generic article model
									$article = JModel::getInstance('Article', 'ContentModel', array('ignore_request' => true));

									$article->setState('params', $appParams);
									$article->setState('filter.published', 1);
									$article->setState('article.id', (int) $article_id);
									$element = $article->getelement();

									$catids = array($element->catid);
								}
								else {
									$catids = array($catid);
								}
							}
							else {
								// Return right away if show_on_article_page option is off
								return;
							}
							break;

						case 'featured':
						default:
							// Return right away if not on the category or article views
							return;
					}
				}
				else {
					// Return right away if not on a com_content page
					return;
				}

				break;

			case 'normal':
			default:
				$catids = $params->get('catid');
				$articles->setState('filter.category_id.include', (bool) $params->get('category_filtering_type', 1));
				break;
		}

		// Category filter
		if ($catids) {
			if ($params->get('show_child_category_articles', 0) && (int) $params->get('levels', 0) > 0) {
				// Get an instance of the generic categories model
				$categories = JModel::getInstance('Categories', 'ContentModel', array('ignore_request' => true));
				$categories->setState('params', $appParams);
				$levels = $params->get('levels', 1) ? $params->get('levels', 1) : 9999;
				$categories->setState('filter.get_children', $levels);
				$categories->setState('filter.published', 1);
				$categories->setState('filter.access', $access);
				$additional_catids = array();

				foreach($catids as $catid)
				{
					$categories->setState('filter.parentId', $catid);
					$recursive = true;
					$elements = $categories->getelements($recursive);

					if ($elements)
					{
						foreach($elements as $category)
						{
							$condition = (($category->level - $categories->getParent()->level) <= $levels);
							if ($condition) {
								$additional_catids[] = $category->id;
							}

						}
					}
				}

				$catids = array_unique(array_merge($catids, $additional_catids));
			}

			$articles->setState('filter.category_id', $catids);
		}

		// Ordering
		$articles->setState('list.ordering', $params->get('article_ordering', 'a.ordering'));
		$articles->setState('list.direction', $params->get('article_ordering_direction', 'ASC'));

		// New Parameters
		$articles->setState('filter.featured', $params->get('show_front', 'show'));
		$articles->setState('filter.author_id', $params->get('created_by', ""));
		$articles->setState('filter.author_id.include', $params->get('author_filtering_type', 1));
		$articles->setState('filter.author_alias', $params->get('created_by_alias', ""));
		$articles->setState('filter.author_alias.include', $params->get('author_alias_filtering_type', 1));
		$excluded_articles = $params->get('excluded_articles', '');

		if ($excluded_articles) {
			$excluded_articles = explode("\r\n", $excluded_articles);
			$articles->setState('filter.article_id', $excluded_articles);
			$articles->setState('filter.article_id.include', false); // Exclude
		}

		$date_filtering = $params->get('date_filtering', 'off');
		if ($date_filtering !== 'off') {
			$articles->setState('filter.date_filtering', $date_filtering);
			$articles->setState('filter.date_field', $params->get('date_field', 'a.created'));
			$articles->setState('filter.start_date_range', $params->get('start_date_range', '1000-01-01 00:00:00'));
			$articles->setState('filter.end_date_range', $params->get('end_date_range', '9999-12-31 23:59:59'));
			$articles->setState('filter.relative_date', $params->get('relative_date', 30));
		}

		// Filter by language
		$articles->setState('filter.language', $app->getLanguageFilter());

		$elements = $articles->getelements();

		// Display options
		$show_date = $params->get('show_date', 0);
		$show_date_field = $params->get('show_date_field', 'created');
		$show_date_format = $params->get('show_date_format', 'Y-m-d H:i:s');
		$show_category = $params->get('show_category', 0);
		$show_hits = $params->get('show_hits', 0);
		$show_author = $params->get('show_author', 0);
		$show_introtext = $params->get('show_introtext', 0);
		$introtext_limit = $params->get('introtext_limit', 100);

		// Find current Article ID if on an article page
		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');

		if ($option === 'com_content' && $view === 'article') {
			$active_article_id = JRequest::getInt('id');
		}
		else {
			$active_article_id = 0;
		}

		// Prepare data for display using display options
		foreach ($elements as &$element)
		{
			$element->slug = $element->id.':'.$element->alias;
			$element->catslug = $element->catid ? $element->catid .':'.$element->category_alias : $element->catid;

			if ($access || in_array($element->access, $authorised)) {
				// We know that user has the privilege to view the article
				$element->link = JRoute::_(ContentHelperRoute::getArticleRoute($element->slug, $element->catslug));
			}
			 else {
				// Angie Fixed Routing
				$app	= JFactory::getApplication();
				$menu	= $app->getMenu();
				$menuelements	= $menu->getelements('link', 'index.php?option=com_users&view=login');
			if(isset($menuelements[0])) {
					$elementid = $menuelements[0]->id;
				} elseif (JRequest::getInt('elementid') > 0) { //use elementid from requesting page only if there is no existing menu
					$elementid = JRequest::getInt('elementid');
				}

				$element->link = JRoute::_('index.php?option=com_users&view=login&elementid='.$elementid);
				}

			// Used for styling the active article
			$element->active = $element->id == $active_article_id ? 'active' : '';

			$element->displayDate = '';
			if ($show_date) {
				$element->displayDate = JHTML::_('date', $element->$show_date_field, $show_date_format);
			}

			if ($element->catid) {
				$element->displayCategoryLink = JRoute::_(ContentHelperRoute::getCategoryRoute($element->catid));
				$element->displayCategoryTitle = $show_category ? '<a href="'.$element->displayCategoryLink.'">'.$element->category_title.'</a>' : '';
			}
			else {
				$element->displayCategoryTitle = $show_category ? $element->category_title : '';
			}

			$element->displayHits = $show_hits ? $element->hits : '';
			$element->displayAuthorName = $show_author ? $element->author : '';
			if ($show_introtext) {
				$element->introtext = JHtml::_('content.prepare', $element->introtext, '', 'mod_articles_category.content');
				$element->introtext = self::_cleanIntrotext($element->introtext);
			}
			$element->displayIntrotext = $show_introtext ? self::truncate($element->introtext, $introtext_limit) : '';
			// added Angie show_unauthorizid
			$element->displayReadmore = $element->alternative_readmore;

		}

		return $elements;
	}

	public static function _cleanIntrotext($introtext)
	{
		$introtext = str_replace('<p>', ' ', $introtext);
		$introtext = str_replace('</p>', ' ', $introtext);
		$introtext = strip_tags($introtext, '<a><em><strong>');

		$introtext = trim($introtext);

		return $introtext;
	}

	/**
	* This is a better truncate implementation than what we
	* currently have available in the library. In particular,
	* on index.php/Banners/Banners/site-map.html JHtml's truncate
	* method would only return "Article...". This implementation
	* was taken directly from the Stack Overflow thread referenced
	* below. It was then modified to return a string rather than
	* print out the output and made to use the relevant JString
	* methods.
	*
	* @link http://stackoverflow.com/questions/1193500/php-truncate-html-ignoring-tags
	* @param mixed $html
	* @param mixed $maxLength
	*/
	public static function truncate($html, $maxLength = 0)
	{
		$printedLength = 0;
		$position = 0;
		$tags = array();

		$output = '';

		if (empty($html)) {
			return $output;
		}

		while ($printedLength < $maxLength && preg_match('{</?([a-z]+)[^>]*>|&#?[a-zA-Z0-9]+;}', $html, $match, PREG_OFFSET_CAPTURE, $position))
		{
			list($tag, $tagPosition) = $match[0];

			// Print text leading up to the tag.
			$str = JString::substr($html, $position, $tagPosition - $position);
			if ($printedLength + JString::strlen($str) > $maxLength) {
				$output .= JString::substr($str, 0, $maxLength - $printedLength);
				$printedLength = $maxLength;
				break;
			}

			$output .= $str;
			$lastCharacterIsOpenBracket = (JString::substr($output, -1, 1) === '<');

			if ($lastCharacterIsOpenBracket) {
				$output = JString::substr($output, 0, JString::strlen($output) - 1);
			}

			$printedLength += JString::strlen($str);

			if ($tag[0] == '&') {
				// Handle the entity.
				$output .= $tag;
				$printedLength++;
			}
			else {
				// Handle the tag.
				$tagName = $match[1][0];

				if ($tag[1] == '/') {
					// This is a closing tag.
					$openingTag = array_pop($tags);

					$output .= $tag;
				}
				elseif ($tag[JString::strlen($tag) - 2] == '/') {
					// Self-closing tag.
					$output .= $tag;
				}
				else {
					// Opening tag.
					$output .= $tag;
					$tags[] = $tagName;
				}
			}

			// Continue after the tag.
			if ($lastCharacterIsOpenBracket) {
				$position = ($tagPosition - 1) + JString::strlen($tag);
			}
			else {
				$position = $tagPosition + JString::strlen($tag);
			}

		}

		// Print any remaining text.
		if ($printedLength < $maxLength && $position < JString::strlen($html)) {
			$output .= JString::substr($html, $position, $maxLength - $printedLength);
		}

		// Close any open tags.
		while (!empty($tags))
		{
			$output .= sprintf('</%s>', array_pop($tags));
		}

		$length = JString::strlen($output);
		$lastChar = JString::substr($output, ($length - 1), 1);
		$characterNumber = ord($lastChar);

		if ($characterNumber === 194) {
			$output = JString::substr($output, 0, JString::strlen($output) - 1);
		}

		$output = JString::rtrim($output);

		return $output.'&hellip;';
	}

	public static function groupBy($list, $fieldName, $article_grouping_direction, $fieldNameToKeep = null)
	{
		$grouped = array();

		if (!is_array($list)) {
			if ($list == '') {
				return $grouped;
			}

			$list = array($list);
		}

		foreach($list as $key => $element)
		{
			if (!isset($grouped[$element->$fieldName])) {
				$grouped[$element->$fieldName] = array();
			}

			if (is_null($fieldNameToKeep)) {
				$grouped[$element->$fieldName][$key] = $element;
			}
			else {
				$grouped[$element->$fieldName][$key] = $element->$fieldNameToKeep;
			}

			unset($list[$key]);
		}

		$article_grouping_direction($grouped);

		return $grouped;
	}

	public static function groupByDate($list, $type = 'year', $article_grouping_direction, $month_year_format = 'F Y')
	{
		$grouped = array();

		if (!is_array($list)) {
			if ($list == '') {
				return $grouped;
			}

			$list = array($list);
		}

		foreach($list as $key => $element)
		{
			switch($type)
			{
				case 'month_year':
					$month_year = JString::substr($element->created, 0, 7);

					if (!isset($grouped[$month_year])) {
						$grouped[$month_year] = array();
					}

					$grouped[$month_year][$key] = $element;
					break;

				case 'year':
				default:
					$year = JString::substr($element->created, 0, 4);

					if (!isset($grouped[$year])) {
						$grouped[$year] = array();
					}

					$grouped[$year][$key] = $element;
					break;
			}

			unset($list[$key]);
		}

		$article_grouping_direction($grouped);

		if ($type === 'month_year') {
			foreach($grouped as $group => $elements)
			{
				$date = new JDate($group);
				$formatted_group = $date->format($month_year_format);
				$grouped[$formatted_group] = $elements;
				unset($grouped[$group]);
			}
		}

		return $grouped;
	}
}
