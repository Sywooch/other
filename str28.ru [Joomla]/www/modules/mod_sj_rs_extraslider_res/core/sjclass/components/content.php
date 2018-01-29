<?php
/**
 * @package SjClass
 * @subpackage SjContentReader
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_REXEC') or die;
defined('_YTOOLS') or die;

if (!class_exists('SjContentReader')){
	class SjContentReader extends SjAbstractReader{

		public function __construct(){

			$this->addelementFieldToSelect('id');
			$this->addelementFieldToSelect('title');
			$this->addelementFieldToSelect('alias');
			$this->addelementFieldToSelect(array('introtext'=>'description'));
			$this->addelementFieldToSelect('created');
			$this->addelementFieldToSelect('modified');
			$this->addelementFieldToSelect('hits');
			$this->addelementFieldToSelect('featured');
			$this->addelementFieldToSelect(array('catid'=>'category_id'));
			$this->addelementFieldToSelect(array('created_by'=>'author_id'));
			$this->addelementFieldToSelect('images');
			//$this->addelementFieldToSelect('*');

			$this->addCategoryFieldToSelect('id');
			$this->addCategoryFieldToSelect('title');
			$this->addCategoryFieldToSelect('level');
			$this->addCategoryFieldToSelect('alias');
			$this->addCategoryFieldToSelect('description');
			$this->addCategoryFieldToSelect('params');
			$this->addCategoryFieldToSelect(array('created_user_id'=>'author_id'));
			$this->addCategoryFieldToSelect(array('created_time' => 'created'));
			$this->addCategoryFieldToSelect('hits');
			$this->addCategoryFieldToSelect('parent_id');
			$this->addCategoryFieldToSelect(array('(SELECT COUNT(count_table.id) FROM #__content AS count_table WHERE e.id=count_table.catid)' => 'news_count'));

		}

		public function getelementsFromDb($ids, $overload = false){
			if (!is_array($ids)){
				$ids = array((int)$ids);
			}

			$db = &JFactory::getDbo();
			$query = "SELECT " . $this->getelementFields() . " FROM #__content AS e WHERE e.id IN (" . implode(',', $ids)  . ") GROUP BY e.id;";
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
			FROM #__content as e
			WHERE
			e.state IN(1)
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
				FROM #__categories AS e
				WHERE
				e.published IN (1)
				AND e.extension = 'com_content'
				AND e.parent_id > 0
				" . ($this->_getContentAccessFilter() ? 'AND '.$this->_getContentAccessFilter() : '') . " -- Access condition
				AND e.language IN ({$db->quote(JFactory::getLanguage()->getTag())} , {$db->quote('*')})
				GROUP BY e.id
				ORDER BY e.lft
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

		public function buildCategoriesTree(){
			if(count($this->_categories)){
				foreach ($this->_categories as $cid => $category) {
					if (isset($this->_categories[$category->parent_id])){
						$parent_category = &$this->_categories[$category->parent_id];
						if (!isset($parent_category->child_category[$category->id])){
							$parent_category->child_category[$category->id] = $category;
						}
					}
					//$title = $category->title . ' <b style="color:red">(' . $category->id . ')</b> <b style="color:blue">[' . $category->parent_id . ']</b>  <b style="color:green">[' . $category->news_count . ']</b>';
					//$title = str_repeat('- - ', $category->level) . $title;
					//echo "<br>$title";
				}
				//echo "<hr>";
			}
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
			if (isset($params['source_limit']) && (int)$params['source_limit']>=0){
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
		protected $_image4 = array();
		public function _getelementImage(&$element){
			if (is_int($element)){
				$element = $this->getelement($element);
			}
			if (!isset($this->_image4[$element->id])){
				// image extract
				if (strpos($element->images, '{')!==false){
					$element_images = json_decode($element->images);
					$element->images = null;
					if (isset($element_images->image_intro)
							&& (YTools::isUrl($element_images->image_intro)
									|| file_exists($element_images->image_intro))){
						$element->image = $element_images->image_intro;
					} else if (isset($element_images->image_fulltext)
							&& (YTools::isUrl($element_images->image_fulltext)
									|| file_exists($element_images->image_fulltext))){
						$element->image = $element_images->image_fulltext;
					}
				}

				if (!isset($element->image_extracted)){
					$element_images = YTools::extractImages($element->description);
					$element->image_extracted = true;
				}

				if (!isset($element->image) && count($element_images)){
					// get first exists image
					foreach ($element_images as $i => $image_url) {
						if (YTools::isUrl($image_url) || file_exists($image_url)){
							$element->image = $image_url;
							break;
						}
					}
				}
				$this->_image4[$element->id] = isset($element->image);
			}
			return $this->_image4[$element->id];
		}
		public function getelementUrl(&$element){
			if (!class_exists('ContentHelperRoute')){
				include_once RPATH_SITE . DS . 'components' . DS . 'com_content' . DS . 'helpers' . DS . 'route.php';
			}
			if (!isset($element->url)){
				$element->url = JRoute::_(ContentHelperRoute::getArticleRoute($element->id, $element->category_id));
			}
			return $element->url;
		}

		protected $_images4 = array();
		public function elementImages(&$element){
			if (is_int($element)){
				$element = $this->getelement($element);
			}
			if (!isset($this->_images4[$element->id])){
				$this->_images4[$element->id] = array();

				// image extract
				if (strpos($element->images, '{')!==false || strpos($element->images, '[')!==false){
					$json = json_decode($element->images, true);
					if (isset($json['image_intro'])){
						if (YTools::isUrl($json['image_intro']) || file_exists($json['image_intro'])){
							array_push($this->_images4[$element->id], $json['image_intro']);
						}
					}
					if (isset($json['image_fulltext'])){
						if (YTools::isUrl($json['image_fulltext']) || file_exists($json['image_fulltext'])){
							array_push($this->_images4[$element->id], $json['image_fulltext']);
						}
					}
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