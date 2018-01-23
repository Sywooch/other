<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
 
class WstCarouselThumbnailsViewDefault extends JView
{
        function display($tpl = null) 
        {
            $layout = JRequest::getvar("layout");
            switch($layout)
            {
                case "config":
                    $this->config=$this->get("Config");
                    $this->addConfigToolBar();
                    break;
                case "new":
                    $model = JModel::getInstance('Default','WstCarouselThumbnailsModel');
                    $this->item=$model->getImage(JRequest::getvar("id"));
                    $this->addNewToolBar();
                    break;
                default:
                    $this->addDefaultToolBar();
                    $this->state		= $this->get('State');
                    $this->items = $this->get('Images');
                    
                    $this->pagination = $this->get('Pagination');
                    break;
            }
            
            parent::display($tpl);
        }
               
        protected function addDefaultToolBar(){
            JToolBarHelper::title( JText::_('WST_CAROUSEL_THUMBNAILS_LIST_IMAGES'), 'cpanel.png');
            JToolBarHelper::publish();
            JToolBarHelper::unpublish();
            JToolBarHelper::divider();
            JToolBarHelper::custom('config','options.png','options_f2.png',JText::_('WST_CAROUSEL_THUMBNAILS_LIST_IMAGES_CONFIG'),false);
            JToolBarHelper::divider();
            JToolBarHelper::custom('newImage','new.png','new_f2.png',JText::_('WST_CAROUSEL_THUMBNAILS_LIST_IMAGES_NEW'),false);
            JToolBarHelper::custom('deleteImage','delete.png','delete_f2.png',JText::_('WST_CAROUSEL_THUMBNAILS_LIST_IMAGES_DELETE'),false);
            JToolBarHelper::divider();
            JToolBarHelper::custom('upload','upload.png','upload_f2.png',JText::_('WST_CAROUSEL_THUMBNAILS_LIST_IMAGES_UPLOAD'),false);
        }
        
        protected function addConfigToolBar()
        {
            JToolBarHelper::title( JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_TITLE'),'config.png');
            JToolBarHelper::back();
            JToolBarHelper::custom('saveConfig','save.png','save_f2.png',JText::_('WST_CAROUSEL_THUMBNAILS_CONFIG_SAVE'),false);
        }
        
        protected function addNewToolBar()
        {
            JToolBarHelper::title(JText::_('WST_CAROUSEL_THUMBNAILS_NEW_TITILE'),'article-add.png');
            JToolBarHelper::back();
            JToolBarHelper::custom('save','save.png','save_f2.png',JText::_('WST_CAROUSEL_THUMBNAILS_NEW_SAVE'),false);
        }
}

?>