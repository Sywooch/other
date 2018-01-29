<?php
/**
 * 
 * 
 */

//defined('_REXEC') or die;

/**
 * Retina udpate notification plugin
 *
 * @package		retina.Plugin
 * @subpackage	Quickicon.retina
 * @since		2.5
 */
//class plgQuickiconretinaupdate extends JPlugin
//{
	/**
	 * Constructor
	 *
	 * @param       object  $subject The object to observe
	 * @param       array   $config  An array that holds the plugin configuration
	 *
	 * @since       2.5
	 */
//	public function __construct(& $subject, $config)
//	{
//		parent::__construct($subject, $config);
//		$this->loadLanguage();
//	}

	/**
	 * This method is called when the Quick Icons module is constructing its set
	 * of icons. You can return an array which defines a single icon and it will
	 * be rendered right after the stock Quick Icons.
	 *
	 * @param  $context  The calling context
	 *
	 * @return array A list of icon definition associative arrays, consisting of the
	 *				 keys link, image, text and access.
	 *
	 * @since       2.5
	 */
//	public function onGetIcons($context)
//	{
//		if ($context != $this->params->get('context', 'mod_quickicon') || !JFactory::getUser()->authorise('core.manage', 'com_installer')) {
//			return;
//		}

//		$cur_template = JFactory::getApplication()->getTemplate();
//		$ajax_url = JURI::base().'index.php?option=com_installer&view=update&task=update.ajax';
//		$script = "var plg_quickicon_retinaupdate_ajax_url = '$ajax_url';\n";
//		$script .= 'var plg_quickicon_jupdatecheck_jversion = "'.RVERSION.'";'."\n";
//		$script .= 'var plg_quickicon_retinaupdate_text = {"UPTODATE" : "'.
//			RText::_('PLG_QUICKICON_retinaUPDATE_UPTODATE').'", "UPDATEFOUND": "'.
//			RText::_('PLG_QUICKICON_retinaUPDATE_UPDATEFOUND').'", "ERROR": "'.
//			RText::_('PLG_QUICKICON_retinaUPDATE_ERROR')."\"};\n";
//		$script .= 'var plg_quickicon_retinaupdate_img = {"UPTODATE" : "'.
//			JURI::base(true) .'/design1/'. $cur_template .'/images/header/icon-48-jupdate-uptodate.png'.'", "ERROR": "'.
//			JURI::base(true) .'/design1/'. $cur_template .'/images/header/icon-48-deny.png'.'", "UPDATEFOUND": "'.
//			JURI::base(true) .'/design1/'. $cur_template .'/images/header/icon-48-jupdate-updatefound.png'."\"};\n";
//		$document = JFactory::getDocument();
//		$document->addScriptDeclaration($script);
//		$document->addScript(JURI::base().'../media/plg_quickicon_retinaupdate/jupdatecheck.js');

//		return array(array(
//			'link' => 'index.php?option=com_installer&view=update',
//			'image' => 'header/icon-48-download.png',
//			'text' => RText::_('PLG_QUICKICON_retinaUPDATE_CHECKING'),
//			'id' => 'plg_quickicon_retinaupdate'
//		));
//	}
//}
