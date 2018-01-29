<?php
/**
 * @package SjClass
 * @subpackage SjModule
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_REXEC') or die;
defined('_YTOOLS') or die;

if (!class_exists('SjModule')){
	abstract class SjModule {
		protected $_params = null;
		protected $_elements  = null;
		protected $_reader = null;

		abstract function getReader();
		abstract static function getList();
		abstract static function getInstance();

		public function setParams($params){
			if ($params instanceof JRegistry) {
				$params = $params->toArray();
			}
			$this->_params = $params;
		}

		public function getParams($key=null){
			if (is_null($key)){
				return $this->_params;
			} else {
				if (isset($this->_params[$key])){
					return $this->_params[$key];
				}
				return null;
			}
		}

		protected function getelements(){
			if (is_null($this->_elements)){
				$this->_elements = array();
			}
			$identify = md5(serialize($this->_params));
			if (!isset($this->_elements[$identify])){
				$this->_elements[$identify] = $this->getReader()->getList($this->_params);
			}
			return $this->_elements[$identify];
		}
	}
}