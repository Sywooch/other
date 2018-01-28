<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * RSEvents! system plugin
 */
class plgSystemRSEproPDF extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatibility we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access	protected
	 * @param	object	$subject The object to observe
	 * @param 	array   $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	public function __construct(&$subject, $config) {
		parent::__construct($subject, $config);
	}
	
	protected function canRun() {
		if (file_exists(JPATH_SITE.'/components/com_rseventspro/rseventspro.php'))
		{
			require_once JPATH_SITE.'/components/com_rseventspro/helpers/rseventspro.php';
			JFactory::getLanguage()->load('plg_system_rsepropdf',JPATH_ADMINISTRATOR);
			return true;
		}
		
		return false;
	}
	
	public function rsepro_activationEmail($vars) {
		if (!$this->canRun()) 
			return;
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$id		= $vars['id'];
		$layout = $vars['layout'];
		$tmp	= $this->_getTmp();
		$tid	= $this->_createId('activation');
		
		$query->clear()
			->select($db->qn('ticket_pdf'))
			->from($db->qn('#__rseventspro_events'))
			->where($db->qn('id').' = '.(int) $id);
		
		$db->setQuery($query);
		$pdf = $db->loadResult();
		
		if ($pdf) {
			jimport('joomla.filesystem.file');
			
			$filename = 'Ticket';
			$activation_filename = $this->_getFilename($filename);
			
			require_once JPATH_SITE.'/components/com_rseventspro/helpers/pdf.php';
			$pdf = new RSEventsProPDF();
			$buffer = $pdf->write($layout);
			$path 	= $tmp.'/'.$tid.'/'.$activation_filename;
			if (JFile::write($path, $buffer))
				$vars['attachment'][] = $path;
		}
	}
	
	public function rsepro_activationEmailCleanup($vars) {
		if (!$this->canRun()) 
			return;
		
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$id		= $vars['id'];
		
		$query->clear()
			->select($db->qn('ticket_pdf'))
			->from($db->qn('#__rseventspro_events'))
			->where($db->qn('id').' = '.(int) $id);
		
		$db->setQuery($query);
		$pdf = $db->loadResult();
		
		if ($pdf) {
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			
			$tmp = $this->_getTmp();
			$tid = $this->_createId('activation');
			$dir = $tmp.'/'.$tid;
			
			if (is_dir($dir))
				JFolder::delete($dir);
		}
	}
	
	protected function _getFilename($filename) {
		$filename = str_replace(array('\\', '/'), '', $filename);
		if (empty($filename))
			$filename = 'attachment';
		
		return $filename.'.pdf';
	}
	
	protected function _createId($suffix) {
		static $hash;
		if (!$hash) {
			$session = JFactory::getSession();
			$hash = md5($session->getId());
		}
		
		return $hash.'_'.$suffix;
	}
	
	protected function _getTmp() {
		static $tmp;
		if (!$tmp) {
			$config = JFactory::getConfig();
			$tmp = $config->get('tmp_path');
		}
		
		return $tmp;
	}
}