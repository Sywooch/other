<?php
/**
 * @package SjClass
 * @subpackage SjK2Reader
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_REXEC') or die;
defined('_YTOOLS') or die;

if (!class_exists('SjK2Reader')){
	class SjK2Reader extends SjAbstractReader{

		public function __construct(){

			$this->addelementFieldToSelect('id');
			$this->addelementFieldToSelect('title');
			$this->addelementFieldToSelect('alias');
			$this->addelementFieldToSelect(array('introtext'=>'description'));
			$this->addelementFieldToSelect('created');
			$this->addelementFieldToSelect('modified');
			$this->addelementFieldToSelect('hits');
			$this->addelementFieldToSelect('featured');
			$this->addelementFieldToSelect(array('catid'=>'catid'));
			$this->addelementFieldToSelect(array('created_by'=>'author_id'));
			$this->addelementFieldToSelect('catid');
			$this->addelementFieldToSelect(array('(SELECT count(count_table.id) FROM #__k2_comments AS count_table WHERE count_table.elementID = e.id)' => 'comments'));

			$this->addCategoryFieldToSelect('id');
			$this->addCategoryFieldToSelect('name');
			$this->addCategoryFieldToSelect('alias');
			$this->addCategoryFieldToSelect('description');
			$this->addCategoryFieldToSelect('params');
			$this->addCategoryFieldToSelect(array('image'=>'images'));
			$this->addCategoryFieldToSelect('parent');
			$this->addCategoryFieldToSelect(array('(SELECT COUNT(count_table.id) FROM #__k2_elements AS count_table WHERE e.id=count_table.catid)' => 'news_count'));

		}

		public function getelementsFromDb($ids, $overload = false){
			if (!is_array($ids)){
				$ids = array((int)$ids);
			}

			$db = &JFactory::getDbo();
			$query = "SELECT " . $this->getelementFields() . " FROM #__k2_elements AS e WHERE e.id IN (" . implode(',', $ids)  . ") GROUP BY e.id;";
			// YTools::dump($query);
			$db->setQuery($query);
			$rows = $db->loadObjectList();
			$element_count = 0;
			if ( !is_null($rows) ){
				foreach($rows as $element){
					if ($overload || !isset($this->_elements[$element->id])){
						$this->_elements[$element->id] = $element;
						$element_count++;
					}
				}
			}

			return $element_count;
		}

		public function getelementsIn($cids, $params){
			$db = &JFactory::getDbo();
			$now = JFactory::getDate()->toMySQL();
			$nulldate = $db->getNullDate();

			if (is_array($cids)){
				$category_filter_set = implode(',', $cids);
			}

			$query = "
			SELECT e.id
			FROM #__k2_elements AS e
			WHERE
			e.published IN (1)
			AND e.trash IN (0)
			AND e.catid IN ($category_filter_set)
			" . ($this->_getContentAccessFilter() ? 'AND '.$this->_getContentAccessFilter() : '') . " -- Access condition
			AND (e.publish_up   = {$db->quote($nulldate)} OR e.publish_up   <= {$db->quote($now)})
			AND (e.publish_down = {$db->quote($nulldate)} OR e.publish_down >= {$db->quote($now)})
			AND e.language IN ({$db->quote(JFactory::getLanguage()->getTag())} , {$db->quote('*')})
			{$this->_elementFilter($params)}
			GROUP BY e.id
			ORDER BY {$this->_elementOrders($params)}
			{$this->_queryLimit($params)}
			";
			$db->setQuery($query);
			$ids = $db->loadResultArray();
			return $ids;
		}

		public function getCategoriesFromDb(){
			if (is_null($this->_categories)){
				$db = &JFactory::getDbo();
				$query = "
				SELECT " . $this->getCategoryFields() . "
				FROM #__k2_categories AS e
				WHERE
				e.published IN (1)
				AND e.trash IN (0)
				AND e.parent >= 0
				" . ($this->_getContentAccessFilter() ? 'AND '.$this->_getContentAccessFilter() : '') . " -- Access condition
				AND e.language IN ({$db->quote(JFactory::getLanguage()->getTag())} , {$db->quote('*')})
				GROUP BY e.id
				";
				$db->setQuery($query);
				$rows = $db->loadObjectList();
				if ( !is_null($rows) ){
					foreach($rows as $category){
						$category->child_category = array();
						$this->_categories[$category->id] = $category;
					}
					$this->buildCategoriesTree();
				}
			}
			return $this->_categories;
		}

		protected function _elementFilter($params, $alias='e'){
			$join_filter="";
			if ( isset($params['source_filter']) ){
				// frontpage filter.
				switch ($params['source_filter']){
					default:
					case '0':
						$join_filter = "";
					break;
					case '1':
						$join_filter = "AND $alias.featured=0";
						break;
					case '2':
						$join_filter = "AND $alias.featured=1";
						break;
				}
			}
			return $join_filter;
		}

		public function buildCategoriesTree(){
			if(count($this->_categories)){
				foreach ($this->_categories as $cid => $category) {
					if (isset($this->_categories[$category->parent])){
						$parent_category = &$this->_categories[$category->parent];
						if (!isset($parent_category->child_category[$category->id])){
							$parent_category->child_category[$category->id] = $category;
						}
					}
				}
			}
		}

		protected function _elementOrders($params, $alias='e'){
			// set order by default
			$element_order_by = "$alias.ordering";

			if ( isset($params['source_order_by']) ){
				$string_order_by = trim($params['source_order_by']);
				switch ($string_order_by){
					default:
					case 'ordering':
						$element_order_by = "$alias.ordering";
					break;
					case 'mostview':
					case 'hits':
						$element_order_by = "$alias.hits DESC";
						break;
					case 'recently_add':
					case 'created':
						$element_order_by = "$alias.created DESC";
						break;
					case 'recently_mod':
					case 'modified':
						$element_order_by = "$alias.modified DESC";
						break;
					case 'title':
						$element_order_by = "$alias.title";
						break;
					case 'random':
						$element_order_by = 'rand()';
						break;
				}
			}
			return $element_order_by;
		}

		protected function _queryLimit($params){
			$source_limit = '';
			if (isset($params['source_limit']) && (int)$params['source_limit']>0){
				$source_limit_start = 0;
				if (isset($params['source_limit_start']) && (int)$params['source_limit_start']){
					$source_limit_start = (int)$params['source_limit_start'];
				}
				$source_limit_total = (int)$params['source_limit'];
				$source_limit = "LIMIT $source_limit_start, $source_limit_total";
			}
			return $source_limit;
		}

		protected function _getContentAccessFilter($alias='e'){
			$condition = false;
			$app  = &JFactory::getApplication();
			$params = $app->getParams();
			if ($params instanceof JRegistry && !$params->get('show_noauth', 0)){
				$user = &JFactory::getUser();
				$condition = $alias . '.access IN (' . implode(',', $user->getAuthorisedViewLevels()) . ')';
			}
			return $condition;
		}

		/**
		 * Old function
		 * @var object
		 */
		public function getelementUrl(&$element){
			if (!class_exists('K2HelperRoute')){
				include_once RPATH_SITE . DS . 'components' . DS . 'com_k2' . DS . 'helpers' . DS . 'route.php';
			}
			if (!isset($element->url)){
				$element->url = JRoute::_(K2HelperRoute::getelementRoute($element->id.':'.urlencode($element->alias), $element->catid.':'.urlencode($element->alias)));
			}
			return true;
		}

		protected $_images4 = array();
		public function elementImages(&$element){
			if (is_int($element)){
				$element = $this->getelement($element);
			}
			if (!isset($this->_images4[$element->id])){
				$this->_images4[$element->id] = array();

				// image extract
				if (JFile::exists(RPATH_SITE.DS.'media'.DS.'k2'.DS.'elements'.DS.'src'.DS.md5("Image".$element->id).'.jpg'))   {
					array_push($this->_images4[$element->id], 'media/k2/elements/src/'.md5("Image".$element->id).'.jpg');
				}
				if (!isset($element->image_extracted)){
					$element_images = YTools::extractImages($element->description);
					$element->image_extracted = true;
				}

				if (isset($element_images) && count($element_images)){
					// get first exists image
					foreach ($element_images as $i => $image_url) {
						if (YTools::isUrl($image_url) || file_exists($image_url)){
							array_push($this->_images4[$element->id], $image_url);
						}
					}
				}
			}
			return $this->_images4[$element->id];
		}

		public function getelementImage(&$element){
			$images = $this->elementImages($element);
			$has_image = count($images)>0;
			if ($has_image){
				$element->image = $images[0];
			}
			return $has_image;
		}

	}
}