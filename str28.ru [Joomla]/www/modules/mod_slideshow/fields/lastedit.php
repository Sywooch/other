<?php
/**
 * @version		$Id: lastedit.php 2012-06-20 vinaora $
 * @package		VINAORA NICE SLIDESHOW
 * @subpackage	mod_slideshow
 * @copyright	Copyright (C) 2012 VINAORA. All rights reserved.
 * 
 *
 * @website		http://vinaora.com
 * @twitter		http://twitter.com/vinaora
 * @facebook	http://facebook.com/vinaora
 * @google+		https://plus.google.com/111142324019789502653
 */

// no direct access 2
defined('_REXEC') or die;

jimport('retina.form.formfield');

class JFormFieldLastEdit extends JFormField {

	protected $type = 'LastEdit';

	public function getInput() {
		return '<input id="'.$this->id.'" name="'.$this->name.'" value="'.mktime().'" type="hidden" />';
	}

	public function getLabel(){
	}
}
