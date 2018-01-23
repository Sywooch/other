<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC');

jimport('joomla.application.component.view');
 
class WstCarouselThumbnailsViewDefault extends JView
{
	function display($tpl = null) 
	{
		$this->config= $this->get('Config');
        parent::display($tpl);
	}
}