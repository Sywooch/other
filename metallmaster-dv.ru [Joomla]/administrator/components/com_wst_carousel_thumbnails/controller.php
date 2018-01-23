<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
jimport('joomla.application.component.controller');
 
class WstCarouselThumbnailsController extends JController
{
    function display($tpl = false) 
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'Default')); 
        parent::display($tpl);
    }
}

?>