<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');
$controller = JController::getInstance('WstCarouselThumbnails');
$controller->execute(JRequest::getCmd('task'));
$controller->redirect();

?>