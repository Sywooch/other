<?php
/**
 * @package SjCore
 * @subpackage Elements
 * @version 1.0
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2012 YouTech Company. All Rights Reserved.
 * @author YouTech Company http://www.smartaddons.com
 *
 */
defined('_REXEC') or die;

class _Core_Field_Custom extends JFormField{
	
	public function  getInput(){
		$this->default = $this->parseAttributes();
		$keyfield = null;
		foreach($this->default as $f0 => $val){
			$keyfield = $f0;
			break;
		}
		$hasData = is_array($this->value) && count($this->value);
		$html = array();
		$html[] = '<div class="sj-custom" style="border:1px solid #c0c0c0; clear: both;padding: 5px 0;">';
		if ($hasData){
			$this->_i = 0;
			foreach ($this->value as $element) {
				if (is_array($element)){
					$element = JArrayHelper::toObject($element);
				}
				if (!$this->isValidate($element)){
					continue;
				}
					
				$element_css = '';
				if (isset($element->$keyfield)){
					$element_css .= 'element-' . $element->$keyfield;
				}
				if ($this->_i % 2 == 0){
					$element_css .= ' even';
				} else {
					$element_css .= ' odd';
				}
				
				$html[] = $this->getelementBlock($element, $element_css);
				$this->_i++;
			}
		} else {
			$this->_i = 0;
			$html[] = $this->getelementBlock($this->default);
			$this->_i++;
		}
			$html[] = '<div class="element last">';
				$html[] = '<div class="element-field">';
					$html[] = '<div class="element-field-label">&nbsp;</div>';
					$html[] = '<div class="element-field-input">';
						$html[] = '<div class="element-add-button">';
							$html[] = '<a href="#" class="next-' . $this->_i . '"><span>ADD element</span></a>';
						$html[] = '</div>';
					$html[] = '</div>';
				$html[] = '</div>';
				$html[] = '<div class="element-separator"></div>';
			$html[] = '</div>';
			
			$this->_i = 'NEXTINDEX';
			$html[] = $this->getelementBlock($this->default, 'default');
			
		$html[] = '</div>';
		$this->addStylesheet();
		$this->addJavascript();
		return implode("\n", $html);
	}
	
	protected function parseAttributes(){
		$sampleObj = new stdClass();
		if (isset($this->element['fields']) && !empty($this->element['fields'])){
			$fields = explode(',', $this->element['fields']);
			
			if (count($fields)){
				foreach ($fields as $f){
					$f = trim($f);
					$f = strtolower($f);
					if (!isset($sampleObj->$f)){
						$sampleObj->$f = null;
					}
				}
			} else {
				$sampleObj->id			= null;
				$sampleObj->title		= null;
				$sampleObj->image		= null;
				$sampleObj->url			= null;
				$sampleObj->description	= null;
			}
		} else {
			$sampleObj->id			= null;
			$sampleObj->title		= null;
			$sampleObj->image		= null;
			$sampleObj->url			= null;
			$sampleObj->description	= null;
		}
		return $sampleObj;
	}
	
	protected function isValidate($element){
		$keyfield = false;
		$i = 0;
		foreach ($this->default as $f => $null){
			++$i;
			if ($i==1){
				if (!property_exists($element, $f) || empty($element->$f)){
					return false;
				}
			}
			if (!property_exists($element, $f)){
				$element->$f = '';
			}
		}
		return true;
	}
	
	protected function getelementBlock($element, $class_suffix=''){
		$html = array();
		$html[] = '<div class="element ' . $class_suffix . '">';
			foreach ($element as $f => $val){
				$f = strtolower($f);
				if (!property_exists($this->default, $f)){
					continue;
				}
				$html[] = '<div class="element-field">';
					$html[] = '<div class="element-field-label">' . RText::_( ucfirst($f) ) . '</div>';
					$html[] = '<div class="element-field-input element-field-' . $f . '">';
					if ($f=='description'){
						//$html[] = '<input value="' . $value . '" name="' . $this->name . "[{$this->_index}][$field]" . '" />';
						$html[] = '<textarea rows="3" name="' . $this->name . "[{$this->_i}][$f]" . '">' . $val . '</textarea>';
					} else {
						$html[] = '<input value="' . $val . '" name="' . $this->name . "[{$this->_i}][$f]" . '" />';
					}
					$html[] = '</div>';
				$html[] = '</div>';
			}
			$html[] = '<div class="element-separator"></div>';
		$html[] = '</div>';
		return implode("\n", $html);
	}

	protected function addStylesheet(){
		$document = &JFactory::getDocument();
		$document->addStyleDeclaration("
				.sj-custom .element{
					padding:0 5px;
				}
				.sj-custom .element.default{
					display: none;
				}
				.sj-custom .element-field{
					clear:both;
					padding: 0 0 5px 0;
				}
				.sj-custom .element-field-label{
					width: 25%;
					float: left;
				}
				.sj-custom .element-field-input{
					width: 74%;
					float: left;
				}
				.sj-custom .element-field-input input,
				.sj-custom .element-field-input textarea{
					margin: 0;
					width: 90%;
				}
				.sj-custom .element.recently .element-field-input input,
				.sj-custom .element.recently .element-field-input textarea{
					background: #FFEEDD;
				}
				.sj-custom .element-separator{
					clear:both;
					height: 5px;
					border-top: dashed 1px #ddd;
				}
				.sj-custom .element-add-button{
					text-align: right;
					width: 90%;
				}
				.sj-custom .element-add-button a{
					font-weight: 700;
					
				}
				.sj-custom .element-field:after {
					content: '.';
					display: block;
					height: 0;
					clear: both;
					visibility: hidden;
					overflow: hidden;
				}
				.sj-custom .element-field {
					display: block;
				}
		");
		return true;
	}
	
	protected function addJavascript(){
		$document = &JFactory::getDocument();
		$document->addScriptDeclaration("
				window.addEvent('domready', function(){
					try{
						var customDiv = $(document.body).getElement('.sj-custom');
						customDiv.getElement('.element-add-button a').addEvent('click', function(){
							var nextid		= $(this).get('class').replace('next-', '');
							var template	= customDiv.getElement('.default');
							var newTemplate	= template.clone(true, true);
							var newHtml		= $(newTemplate).get('html').replace(/NEXTINDEX/g, nextid);
		
							$(this).set('class', 'next-' + (nextid-(-1)));
							$(newTemplate).removeClass('default').addClass('recently');
							$(newTemplate).set('html', newHtml);
							$(newTemplate).inject( customDiv.getElement('.last'), 'before');
							return false;
						});
					} catch(e){
						console.log(e);
					}
		
				});
		");
		return true;
	}
	
}
