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

if (!class_exists('SjZooReader')){
	class SjZooReader extends SjAbstractReader{

		protected $app = null;

		public function __construct(){

			$this->addelementFieldToSelect('id');
			$this->addelementFieldToSelect('application_id');
			$this->addelementFieldToSelect(array('name'=>'title'));
			$this->addelementFieldToSelect('type');
			$this->addelementFieldToSelect('alias');
			$this->addelementFieldToSelect('elements');
			$this->addelementFieldToSelect('created');
			$this->addelementFieldToSelect('modified');
			$this->addelementFieldToSelect('hits');
			$this->addelementFieldToSelect(array('created_by'=>'author_id'));
			$this->addelementFieldToSelect(array('EXISTS (SELECT TRUE FROM #__zoo_category_element WHERE element_id=e.id AND category_id = 0)'=>'frontpage'));
			$this->addelementFieldToSelect('params');
            $this->addelementFieldToSelect(array('(SELECT count(cm.id) FROM #__zoo_comment AS cm WHERE cm.element_id=e.id AND cm.state=1)' => 'comments'));

			$this->addCategoryFieldToSelect('id');
			$this->addCategoryFieldToSelect('application_id');
			$this->addCategoryFieldToSelect(array('name'=>'title'));
			$this->addCategoryFieldToSelect('alias');
			$this->addCategoryFieldToSelect('description');
			$this->addCategoryFieldToSelect('parent');
			$this->addCategoryFieldToSelect('ordering');
			$this->addCategoryFieldToSelect('params');
			
			$this->_getZooApplication();
		}

		public function getelementsFromDb($ids, $overload = false){
			if (!is_array($ids)){
				$ids = array((int)$ids);
			}

			$db = &JFactory::getDbo();
			$query = "SELECT " . $this->getelementFields() . " FROM #__zoo_element AS e WHERE e.id IN (" . implode(',', $ids)  . ") GROUP BY e.id;";
			// YTools::dump($query);
			$db->setQuery($query);
			if (!class_exists('element')){
				require_once(RPATH_admin . DS . 'components' . DS . 'com_zoo' . DS .'classes' . DS . 'element.php');
			}
			$rows = $db->loadObjectList('id', 'element');
			$element_count = 0;
			if ( !is_null($rows) ){
				foreach($rows as $element){
					if ($overload || !isset($this->_elements[$element->id])){
						// decorate data as object
						$element->params = $this->app->parameter->create($element->params);
						
						// decorate data as object
						$element->elements = $this->app->data->create($element->elements);
						
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
			SELECT e.id, EXISTS (SELECT TRUE FROM #__zoo_category_element WHERE element_id=e.id AND category_id=0) AS frontpage
			FROM #__zoo_element as e
			INNER JOIN #__zoo_category_element AS ci ON ci.element_id=e.id AND ci.category_id IN ($category_filter_set)
			WHERE
			e.state IN(1)
			" . ($this->_getContentAccessFilter() ? 'AND '.$this->_getContentAccessFilter() : '') . "
			AND (e.publish_up   = {$db->quote($nulldate)} OR e.publish_up   <= {$db->quote($now)})
			AND (e.publish_down = {$db->quote($nulldate)} OR e.publish_down >= {$db->quote($now)})
			GROUP BY e.id
			{$this->_elementFilter($params)}
			ORDER BY {$this->_elementOrders($params)}
			{$this->_queryLimit($params)}
			";
				
			$db->setQuery($query);
			$elements = $db->loadObjectList();
			$ids = array();
			if (isset($elements) && count($elements)){
				foreach ($elements as $i => $element) {
					array_push($ids, $element->id);
				}
			}
			return $ids;
		}

		public function getCategoriesFromDb(){
			if (is_null($this->_categories)){
				$db = &JFactory::getDbo();
				$query = "
				SELECT " . $this->getCategoryFields() . "
				FROM #__zoo_category AS e
				WHERE
				e.published IN (1)
				AND e.parent >= 0
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

		protected function _elementFilter($params, $alias='e', $catit='ci'){
			$join_filter="";
			if ( isset($params['source_filter']) ){
				// frontpage filter.
				switch ($params['source_filter']){
					default:
					case '0':
						$join_filter = "";
					break;
					case '1':
						$join_filter = "HAVING frontpage=0";
						break;
					case '2':
						$join_filter = "HAVING frontpage=1";
						break;
				}
			}
			return $join_filter;
		}

		protected function _elementOrders($params, $alias='e'){
			// set order by default
			$element_order_by = "$alias.priority";

			if ( isset($params['source_order_by']) ){
				$string_order_by = trim($params['source_order_by']);
				switch ($string_order_by){
					default:
					case 'ordering':
						$element_order_by = "$alias.priority";
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
						$element_order_by = "$alias.name";
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
			$source_limit_start = 0;
			if (isset($params['source_limit']) && (int)$params['source_limit']){
				//$source_limit_start = 0;
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

		protected function _getZooApplication(){
			if (is_null($this->app)){
				// load config
				require_once(RPATH_admin.'/components/com_zoo/config.php');

				// get zoo instance
				$this->app = &App::getInstance('zoo');
			}
			return $this->app;
		}

		public function getCategoryImage(&$category){
			$image = false;
			if (is_int($category)){
				$category = &$this->getCategory($category);
			}
			if (is_object($category) && isset($category->params) && !empty($category->params)){
				$cparams = json_decode($category->params, true);
				if (isset($cparams['content.image'])){
					$image = $cparams['content.image'];
				}
			}
			return $image;
		}

		protected $_image4=array();
		public function getelementImage(&$element, $params){
// 			if (is_int($element)){
// 				$element = &$this->getelement($element);
// 			}
// 			$elements = isset($params['media_elements']) ? trim($params['media_elements']) : 'image';
			
// 			if (!isset($this->_image4[$element->id][$elements])){
// 				if (!isset($element->app)){
// 					// set application refer
// 					$element->app = &$this->_getZooApplication();
// 					is_string($element->params) && ($element->params = $element->app->parameter->create($element->params));
// 					is_string($element->elements) && ($element->elements = $element->app->data->create($element->elements));
// 				}
// 				$media_elements = $this->_parseValues($elements);
// 				$media_elements['_current'] = count($media_elements);
// 				$element_elements = $element->getElements();
// 				if ($element_elements){
// 					foreach ($element_elements as $element){
// 						$element_class = get_class($element);
// 						$eclass_suffix = substr($element_class, 7);
// 						$eclass_suffix = strtolower($eclass_suffix);
// 						if ( array_key_exists($eclass_suffix, $media_elements) ){
// 							// image
// 							if ($media_elements[$eclass_suffix]<$media_elements['_current']){
// 								$image = $element->hasValue('file') ? $element->get('file') : false;
// 								if($image !== false  && file_exists($image) ){
// 									$element->image = $element->hasValue('file') ? $element->get('file') : false;
// 									$media_elements['_current'] = $media_elements[$eclass_suffix];
// 								}
// 							}
// 						}
// 					}
// 				}
// 				if ($this->getelementDescription($element, $params)){
// 					$inline_images = YTools::extractImages($element->description);
// 					if(!isset($element->image) or $element->image === false) {
// 						$element->image = count($inline_images) ? array_shift($inline_images) : null;
// 					}
// 				}
// 				$this->_image4[$element->id][$elements] = isset($element->image);
// 			}
// 			return $this->_image4[$element->id][$elements];
			$images = &$this->getelementMultiImage($element, $params);
			$has_image = count($images)>0;
			if ($has_image){
				$element->image = $images[0];
			}
			return $has_image;
		}
		
		protected $_images4 = array();
		public function getelementMultiImage(&$element, $params){
			
			if (is_int($element)){
				$element = &$this->getelement($element);
			}
			$elements = isset($params['media_elements']) ? trim($params['media_elements']) : 'image';
			
			if (!isset($this->_images4[$element->id])){
				$this->_images4[$element->id] = array();
				if (!isset($element->app)){
					// set application refer
					$element->app = &$this->_getZooApplication();
					is_string($element->params) && ($element->params = $element->app->parameter->create($element->params));
					is_string($element->elements) && ($element->elements = $element->app->data->create($element->elements));
				}
				$media_elements = $this->_parseValues($elements);
				// $media_elements['_current'] = count($media_elements);
				$element_elements = $element->getElements();
				if ($element_elements){
					foreach ($element_elements as $element){
						$element_class 	= get_class($element);
						$eclass_suffix 	= substr($element_class, 7);
						$eclass_suffix 	= strtolower($eclass_suffix);
						if ( array_key_exists($eclass_suffix, $media_elements) ){
							if ( !is_array($media_elements[$eclass_suffix]) ){
								$media_elements[$eclass_suffix] = array();
							}
							if ( $element->hasValue('file') ){
								$tmp_url = $element->get('file');
								if (YTools::isUrl($tmp_url) || file_exists($tmp_url)){
									array_push($media_elements[$eclass_suffix], $tmp_url);
								}
							}
						}
					}
					foreach($media_elements as $element_images){
						if (is_array($element_images) && count($element_images)){
							foreach($element_images as $i => $image_url){
								array_push($this->_images4[$element->id], $element_images[$i]);
							}
						}
					}
				}

				if ($this->getelementDescription($element, $params)){
					$inline_images = YTools::extractImages($element->description);
					if (!empty($inline_images)){
						foreach($inline_images as $i => $image_url){
							if (YTools::isUrl($image_url) || file_exists($image_url)){
								array_push($this->_images4[$element->id], $inline_images[$i]);
							}
						}
					}
				}
			}
			return $this->_images4[$element->id];
		}

		public function getelementDescription(&$element, $params){
			if (is_int($element)){
				$element = &$this->getelement($element);
			}
			$elements = isset($params['description_elements']) ? trim($params['description_elements']) : 'description,text,textarea';
			if (!isset($this->_desc4[$element->id][$elements])){
				if (!isset($element->app)){
					// set application refer
					$element->app = &$this->_getZooApplication();
					is_string($element->params) && ($element->params = $element->app->parameter->create($element->params));
					is_string($element->elements) && ($element->elements = $element->app->data->create($element->elements));
				}
				$description_elements = $this->_parseValues($elements);
				$description_elements['_current'] = count($description_elements);
				$element_elements = $element->getElements();
				if ($element_elements)
					foreach ($element_elements as $element){
					$element_class = get_class($element);
					$eclass_suffix = substr($element_class, 7);
					$eclass_suffix = strtolower($eclass_suffix);
						
					if ( array_key_exists($eclass_suffix, $description_elements) ){
						// image
						if ($description_elements[$eclass_suffix]<$description_elements['_current']){
							$element->description = $element->hasValue('value') ? $element->get('value') : '';
							$description_elements['_current'] = $description_elements[$eclass_suffix];
						}
					}
				}
					
					
				$this->_desc4[$element->id][$elements] = isset($element->description);
			}
			return $this->_desc4[$element->id][$elements];
		}

		public function getelementUrl(&$element){
			if (is_int($element)){
				$element = &$this->getelement($element);
			}
			if (!isset($element->url)){
				//$element->url = JRoute::_( 'index.php?option=com_zoo&task=element&element_id='. $element->id);
				$element->url = $this->app->route->element($element);
			}
			return $element->url;
		}

		public function _parseValues($paramString=null){
			$array = array();
			if ( isset($paramString) && is_string($paramString)){
				$keys = explode(',', $paramString);
				$keys = array_map('trim', $keys);
				$i=0;
				foreach ($keys as $key){
					$array[$key] = $i++;
				}
			}
			return $array;
		}

	}
}