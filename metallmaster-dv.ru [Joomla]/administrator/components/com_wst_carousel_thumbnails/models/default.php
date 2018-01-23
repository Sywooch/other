<?php
/**
 * WST Carousel Thumbnails - Extension for Joomla!
 * @package    Joomla
 * @license    GNU/GPL
 * @author NenadT & GoranR <nenadt@gmail.com>
*/
defined('_JEXEC') or die;
 
jimport('joomla.application.component.modellist');
 
class WstCarouselThumbnailsModelDefault extends JModelList
{
    var $_total;
    var $_pagination;
    
    function __construct()
    {
     	parent::__construct();
    	$mainframe = JFactory::getApplication();
     
    	$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
    	$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
     
    	$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
     
    	$this->setState('limit', $limit);
    	$this->setState('limitstart', $limitstart);
        
    }
    
    protected function populateState($ordering = null, $direction = null)
	{
		$app = JFactory::getApplication();

		if ($layout = JRequest::getVar('layout')) {
			$this->context .= '.'.$layout;
		}

		$order = $app->getUserStateFromRequest($this->context.'.ordercol', 'filter_order', $ordering);
		$this->setState('list.ordering', $order);

		$dir = $app->getUserStateFromRequest($this->context.'.orderdirn', 'filter_order_Dir', $direction);
		$this->setState('list.direction', $dir);
            
        if(empty($order))
            parent::populateState('ordering', 'asc');
        else
            parent::populateState($order, $dir);
	}
    
    function getImages() 
    {
     	if (empty($this->_data)) {
     	    $query = $this->_buildQuery();
            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));	
     	}
     	return $this->_data;
    }
    function getTotal()
    {
     	if (empty($this->_total)) {
     	    $query = $this->_buildQuery();
     	    $this->_total = $this->_getListCount($query);	
     	}
     	return $this->_total;
    }
  
    function getPagination()
    {
     	if (empty($this->_pagination)) {
     	    jimport('joomla.html.pagination');
     	    $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
     	}
     	return $this->_pagination;
    }
  
 
   function _buildQuery()
   {
        $uslov=false;
        $query = 'SELECT * FROM #__wst_carousel_thumbnails';
                
        $orderCol	= $this->state->get('list.ordering');
		$orderDirn	= $this->state->get('list.direction');
 
        $query .=' ORDER BY '.$orderCol.' '.$orderDirn;
        return $query;
   }
   
   function getConfig()
   {
        $id=1;
        $table = $this->getTable('WstCarouselThumbnailsConfig', 'Table');
        if(!$table->load($id))
            return false;
        return $table;
   }
   
   function getImage($id)
   {
        $table = $this->getTable('WstCarouselThumbnails', 'Table');
        if(!$table->load($id))
            return false;
        return $table;
   }
   
   function getAllImages()
   {
        $db	=& JFactory::getDBO();
 		$db->setQuery("SELECT * FROM #__wst_carousel_thumbnails WHERE published=1");
    	$rows = $db->loadObjectList();
        return $rows;    
   }
   
   function delete($cids)
   {
        $table = $this->getTable('WstCarouselThumbnails', 'Table');
        foreach($cids as $id){
            if(!$table->delete($id))
                return false;
        }
        return true;
   }
   
   function save($data)
   {
        $table = $this->getTable('WstCarouselThumbnails', 'Table');
        if(!$table->bind($data))
            return false;
        if(!$table->check())
            return false;
        if(!$table->store())
            return false;
        else
            return true;
   }
   
   function saveConfig($data)
   {
        $table = $this->getTable('WstCarouselThumbnailsConfig', 'Table');
        if(!$table->bind($data))
            return false;
        if(!$table->check())
            return false;
        if(!$table->store())
            return false;
        else
            return true;
   }
}

?>