<?php
/**
 * @package SjCore
 * @subpackage Fields
 * @version 1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_REXEC') or die;
defined('_CORE') or die;
JFormHelper::loadFieldClass('list');

class _Core_Field_rsCategories extends JFormFieldList{
	protected $categories = null;
	
	public function getInput(){
		if ( $this->rs_require() ){
			$categories = &$this->getCategories();
			if ( !count($categories) ){
				$input = '<div style="margin: 5px 0;float: left;font-size: 1.091em;">You have no category to select.</div>';
			} else {
				$input = parent::getInput();
			}
		} else {
			$input = '<div style="margin: 5px 0;float: left;font-size: 1.091em;">Maybe your component (retinashop) has been installed incorrectly. <br/>Please sure your component work properly. <br/>If you still get errors, please contact us via our <a href="http://www.smartaddons.com/forum/" target="_blank">forum</a> or <a href="http://www.smartaddons.com/tickets/" target="_blank">ticket main</a></div>';
		}
		return $input;
	}

	protected function rs_require(){
		if ( !class_exists('rsConfig') ){
			if ( file_exists(RPATH_admin.'/components/com_retinashop/helpers/config.php') ){
				require RPATH_admin.'/components/com_retinashop/helpers/config.php';
			} else {
				$this->error = 'Could not find rsConfig helper';
				return false;
			}
		}
		if ( !class_exists('rsModel') ){
			if ( defined('RPATH_rs_admin') && file_exists(RPATH_rs_admin.'/helpers/rsmodel.php') ){
				require RPATH_rs_admin.'/helpers/rsmodel.php';
			} else {
				$this->error = 'Could not find rsModel helper';
				return false;
			}
		}
		if ( defined('RPATH_rs_admin') ){
			JTable::addIncludePath(RPATH_rs_admin.'/tables');
		}
		return true;
	}

	protected function getCategories(){
		if ( is_null($this->categories) ){
			$this->categories = array();
			
			// set user language
			// $lang = JFactory::getLanguage();
			// JRequest::setVar( 'rslang', $lang->getTag() );

			$categoryModel = rsModel::getModel('category');
			$categoryModel->_noLimit = true;
			$categories = $categoryModel->getCategories( 0 );
			if (!count($categories)) return $this->categories;
			
			// render tree
			usort($categories, create_function('$a, $b', 'return $a->ordering > $b->ordering;'));
	
			$_categories = array();
			$_children = array();
			foreach ($categories as $i => $category){
				$_categories[$category->retinashop_category_id] = &$categories[$i];
			}
			foreach ($categories as $i => $category){
				$cid = $category->retinashop_category_id;
				$pid = $category->category_parent_id;
				if (isset($_categories[$pid])){
					if (!isset($_children[$pid])){
						$_children[$pid] = array();
					}
					$_children[$pid][$cid] = $cid;
				}
			}
			if (!count($_categories)) return $this->categories;
			
			$__categories = array();
			$__levels = array();
			foreach ($_categories as $cid => $category){
				$pid = $category->category_parent_id;
				if ( !isset($_categories[$pid]) ){
					$queue = array($cid);
					$_categories[$cid]->level = 1;
					while ( count($queue) > 0 ){
						$qid = array_shift($queue);
						$__categories[$qid] = &$_categories[$qid];
						if (isset($_children[$qid])){
							foreach ($_children[$qid] as $child){
								$_categories[$child]->level = $_categories[$qid]->level + 1;
								array_push($queue, $child);
							}
						}
					}
				}
			}
			$this->categories = $__categories;
		}
		return $this->categories;
	}

	public function getOptions(){
		$options = parent::getOptions();

		// sorted categories
		$categories = $this->getCategories();
		if ( count($categories) ){
			foreach ($categories as $category){
				$multiplier = $category->level - 1;
				$indent = $multiplier ? str_repeat('- - ', $multiplier) : '';
				$value = $category->retinashop_category_id;
				$text  = $indent.$category->category_name;
				$options[] = JHtml::_('select.option', $value, $text);
			}
		}
		return $options;
	}

}