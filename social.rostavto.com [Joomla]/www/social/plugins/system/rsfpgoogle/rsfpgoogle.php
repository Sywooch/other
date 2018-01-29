<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * RSForm! Pro system plugin
 */
class plgSystemRSFPGoogle extends JPlugin
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
	function plgSystemRSFPGoogle( &$subject, $config )
	{
		parent::__construct( $subject, $config );
	}
	
	function canRun()
	{
		if (class_exists('RSFormProHelper')) return true;
		
		$helper = JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/rsform.php';
		if (file_exists($helper))
		{
			require_once($helper);
			RSFormProHelper::readConfig();
			return true;
		}
		
		return false;
	}
	
	function rsfp_bk_onAfterShowConfigurationTabs($tabs)
	{
		if (!$this->canRun()) return;
		
		$lang = JFactory::getLanguage();
		$lang->load( 'plg_system_rsfpgoogle' );
	
		$tabs->addTitle(JText::_('RSFP_GOOGLE_LABEL'), 'form-google');
		$tabs->addContent($this->googleConfigurationScreen());
	}
	
	function rsfp_f_onBeforeFormDisplay($args)
	{
		if (!$this->canRun()) return;
		$code = RSFormProHelper::getConfig('google.code');
		if (empty($code))
			return;
			
		$args['formLayout'] .= "\n".'<script type="text/javascript">';
		$args['formLayout'] .= "\t".'var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");'."\n";
		$args['formLayout'] .= "\t".'document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));'."\n";
		$args['formLayout'] .= "\t".'</script>'."\n";
		$args['formLayout'] .= "\t".'<script type="text/javascript">'."\n";
		$args['formLayout'] .= "\t".'try {'."\n";
		$args['formLayout'] .= "\t".'var pageTracker = _gat._getTracker("'.$code.'");'."\n";
		$args['formLayout'] .= "\t"."pageTracker._trackPageview();"."\n";
		$args['formLayout'] .= "\t".'} catch(err) {}'."\n";
		$args['formLayout'] .= '</script>';
	}
	
	function rsfp_f_onAfterShowThankyouMessage($args)
	{
		if (!$this->canRun()) return;
		$code = RSFormProHelper::getConfig('google.code');
		if (empty($code))
			return;
		
		$db = JFactory::getDBO();
		$db->setQuery("SELECT FormName FROM #__rsform_forms WHERE FormId = '".(int) $args['formId']."'");
		$formName = $db->loadResult();
		
		$args['output'] .= "\n".'<script type="text/javascript">'."\n";
		$args['output'] .= "\t".'var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");'."\n";
		$args['output'] .= "\t".'document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));'."\n";
		$args['output'] .= "\t".'</script>'."\n";
		$args['output'] .= "\t".'<script type="text/javascript">'."\n";
		$args['output'] .= "\t".'try {'."\n";
		$args['output'] .= "\t".'var pageTracker = _gat._getTracker("'.$code.'");'."\n";
		$args['output'] .= "\t"."pageTracker._trackPageview('".addslashes(RSFormProHelper::htmlEscape($formName))."');"."\n";
		$args['output'] .= "\t".'} catch(err) {}'."\n";
		$args['output'] .= '</script>';
	}

	/*
		Additional Functions
	*/
	
	function googleConfigurationScreen()
	{
		ob_start();
		$code = RSFormProHelper::getConfig('google.code');
		
		?>
		<div id="page-google">
		<table class="admintable">
			<tr>
				<td width="200" style="width: 200px;" align="right" class="key"><label for="code"><?php echo JText::_('RSFP_GOOGLE_CODE'); ?></label></td>
				<td><input type="text" size="100" name="rsformConfig[google.code]" value="<?php echo RSFormProHelper::htmlEscape($code); ?>" /></td>
			</tr>
		</table>
		</div>
		<?php
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}
}