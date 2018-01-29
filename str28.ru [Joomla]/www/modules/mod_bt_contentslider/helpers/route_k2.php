<?php
/**
 * Modified from route.php of k2
 * @version		$Id: route.php 1339 2011-11-25 16:00:20Z lefteris.kavadas $
 * @package		K2
 * @author		retinaWorks http://www.retinaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 retinaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access 2
defined('_REXEC') or die('Restricted access');

jimport('retina.application.component.helper');

class BTContentSliderK2Route
{

	function getelementRoute($id, $catid = 0, $elementid = 0)
	{
		$needles = array('element' => (int) $id, 'category' => (int) $catid,);
		$link = 'index.php?option=com_k2&view=element&id=' . $id;
		if ($element = self::_findelement($needles))
		{
			$link .= '&elementid=' . $element->id;
		}
		else
		{
			$link .= '&elementid=' . $elementid;
		}
		return $link;
	}

	function getCategoryRoute($catid, $elementid = 0)
	{
		$needles = array('category' => (int) $catid);
		$link = 'index.php?option=com_k2&view=elementlist&task=category&id=' . $catid;
		if ($element = self::_findelement($needles))
		{
			$link .= '&elementid=' . $element->id;
		}
		else
		{
			$link .= '&elementid=' . $elementid;
		}
		return $link;
	}

	function getUserRoute($userID)
	{
		$needles = array('user' => (int) $userID);
		$user = &JFactory::getUser($userID);
		if (K2_RVERSION == '16' && JFactory::getConfig()->get('unicodeslugs') == 1)
		{
			$alias = JApplication::stringURLSafe($user->name);
		}
		else if (JPluginHelper::isEnabled('main', 'unicodeslug') || JPluginHelper::isEnabled('main', 'jw_unicodeSlugsExtended'))
		{
			$alias = JFilterOutput::stringURLSafe($user->name);
		}
		else
		{
			mb_internal_encoding("UTF-8");
			mb_regex_encoding("UTF-8");
			$alias = trim(mb_strtolower($user->name));
			$alias = str_replace('-', ' ', $alias);
			$alias = mb_ereg_replace('[[:space:]]+', ' ', $alias);
			$alias = trim(str_replace(' ', '', $alias));
			$alias = str_replace('.', '', $alias);

			$stripthese = ',|~|!|@|%|^|(|)|<|>|:|;|{|}|[|]|&|`|â€ž|â€¹|â€™|â€˜|â€œ|â€�|â€¢|â€º|Â«|Â´|Â»|Â°|«|»|…';
			$strips = explode('|', $stripthese);
			foreach ($strips as $strip)
			{
				$alias = str_replace($strip, '', $alias);
			}
			$params = &K2HelperUtilities::getParams('com_k2');
			$SEFReplacements = array();
			$elements = explode(',', $params->get('SEFReplacements', NULL));
			foreach ($elements as $element)
			{
				if (!empty($element))
				{
					@list($src, $dst) = explode('|', trim($element));
					$SEFReplacements[trim($src)] = trim($dst);
				}
			}
			foreach ($SEFReplacements as $key => $value)
			{
				$alias = str_replace($key, $value, $alias);
			}
			$alias = trim($alias, '-.');
			if (trim(str_replace('-', '', $alias)) == '')
			{
				$datenow = &JFactory::getDate();
				$alias = $datenow->toFormat("%Y-%m-%d-%H-%M-%S");
			}
		}
		$link = 'index.php?option=com_k2&view=elementlist&task=user&id=' . $userID . ':' . $alias;
		if ($element = self::_findelement($needles))
		{
			$link .= '&elementid=' . $element->id;
		}
		return $link;
	}

	function getTagRoute($tag)
	{
		$needles = array('tag' => $tag);
		$link = 'index.php?option=com_k2&view=elementlist&task=tag&tag=' . urlencode($tag);
		if ($element = self::_findelement($needles))
		{
			$link .= '&elementid=' . $element->id;
		}
		return $link;
	}

	function _findelement($needles)
	{
		$component = &JComponentHelper::getComponent('com_k2');
		$menus = &JApplication::getMenu('site', array());
		if (K2_RVERSION == '16')
		{
			$elements = $menus->getelements('component_id', $component->id);
		}
		else
		{
			$elements = $menus->getelements('componentid', $component->id);
		}
		$match = null;
		foreach ($needles as $needle => $id)
		{
			if (count($elements))
			{
				foreach ($elements as $element)
				{
					if ($needle == 'user' || $needle == 'category')
					{
						if ((@$element->query['task'] == $needle) && (@$element->query['id'] == $id))
						{
							$match = $element;
							break;
						}
					}
					else if ($needle == 'tag')
					{
						if ((@$element->query['task'] == $needle) && (@$element->query['tag'] == $id))
						{
							$match = $element;
							break;
						}
					}
					else
					{
						if ((@$element->query['view'] == $needle) && (@$element->query['id'] == $id))
						{
							$match = $element;
							break;
						}
					}
					if (!is_null($match))
					{
						break;
					}
				}
				// Second pass [START]
				// Only for multiple categories links. Triggered only if we do not have find any match (link to direct category)
				if (is_null($match))
				{
					foreach ($elements as $element)
					{
						if ($needle == 'category')
						{
							if (!isset($element->K2Categories))
							{
								if (K2_RVERSION == '15')
								{
									$menuparams = explode("\n", $element->params);
									foreach ($menuparams as $param)
									{
										if (strpos($param, 'categories=') === 0)
										{
											$array = explode('categories=', $param);
											$element->K2Categories = explode('|', $array[1]);
										}
									}
								}
								else
								{
									$menuparams = json_decode($element->params);
									$element->K2Categories = isset($menuparams->categories) ? $menuparams->categories : array();
								}
							}
							if (isset($element->K2Categories) && is_array($element->K2Categories))
							{
								foreach ($element->K2Categories as $catid)
								{
									if ((@$element->query['view'] == 'elementlist') && (@$element->query['task'] == '') && (@(int) $catid == $id))
									{
										$match = $element;
										break;
									}
								}
							}
						}
						if (!is_null($match))
						{
							break;
						}
					}
				}
				// Second pass [END]
			}
			if (!is_null($match))
			{
				break;
			}
		}
		return $match;
	}
}
