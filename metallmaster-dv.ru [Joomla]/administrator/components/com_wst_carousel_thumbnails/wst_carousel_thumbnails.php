<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
require_once( JPATH_COMPONENT.DS.'controller.php' );

if(!$controller = JRequest::getWord('controller')) {
    $controller = 'default';
}

$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
if (file_exists($path)) {
    require_once $path;
} 
else {
    $controller = '';
}

$classname    = 'WstCarouselThumbnailsController'.ucFirst($controller);
$controller   = new $classname( );
$controller->execute( JRequest::getVar( 'task' ) );
$controller->redirect();

?>