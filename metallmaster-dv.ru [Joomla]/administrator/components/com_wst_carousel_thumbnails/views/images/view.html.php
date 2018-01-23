<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
 
class WstCarouselThumbnailsViewImages extends JView
{
        function display($tpl = null) 
        {
            $layout = JRequest::getvar("layout");
            $this->addImagesToolBar();
            $this->images = $this->get('Images');
            parent::display($tpl);
        }
               
        protected function addImagesToolBar(){
            JToolBarHelper::title( JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES'), 'cpanel.png');
            JToolBarHelper::custom('img','back.png','back_f2.png',JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_BACK'),false);
            JToolBarHelper::custom( 'delete', 'delete.png','delete_f2.png', JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_DELETE_IMAGE'),false );
            JToolBarHelper::custom( 'upload', 'upload.png','upload_f2.png',  JText::_('WST_CAROUSEL_THUMBNAILS_ALL_IMAGES_UPLOAD'),false );
        }
}

?>