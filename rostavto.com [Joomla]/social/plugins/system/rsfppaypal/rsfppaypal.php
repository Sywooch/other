<?php
/**
* @version 1.3.0
* @package RSform!Pro 1.3.0
* @copyright (C) 2007-2010 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * RSForm! Pro system plugin
 */
class plgSystemRSFPPayPal extends JPlugin
{
	var $componentId 	= 500;
	var $componentValue = 'paypal';
	
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
	function plgSystemRSFPPayPal( &$subject, $config )
	{
		parent::__construct( $subject, $config );
		$this->newComponents = array(500);
	}
	
	function rsfp_bk_onAfterShowComponents()
	{		
		$lang = JFactory::getLanguage();
		$lang->load( 'plg_system_rsfppaypal' );
		
		$mainframe 	= JFactory::getApplication();
		$db 		= JFactory::getDBO();
		$formId 	= JRequest::getInt('formId');
		
		$link = "displayTemplate('".$this->componentId."')";
		if ($components = RSFormProHelper::componentExists($formId, $this->componentId))
			$link = "displayTemplate('".$this->componentId."', '".$components[0]."')";
		?>
		<li><a href="javascript: void(0);" onclick="<?php echo $link;?>;return false;" id="rsfpc<?php echo $this->componentId; ?>"><span id="paypal"><?php echo JText::_('RSFP_PAYPAL_COMPONENT'); ?></span></a></li>
		<?php
	}
	
	function rsfp_getPayment(&$items, $formId)
	{
		if ($components = RSFormProHelper::componentExists($formId, $this->componentId))
		{
			$data = RSFormProHelper::getComponentProperties($components[0]);
			
			$item 			= new stdClass();
			$item->value 	= $this->componentValue;
			$item->text 	= $data['LABEL'];
			
			// add to array
			$items[] = $item;
		}
	}
	
	function rsfp_doPayment($payValue, $formId, $SubmissionId, $price, $products, $code)
	{
		// execute only for our plugin
		if ($payValue != $this->componentValue) return;
		
		$mainframe   = JFactory::getApplication();
		$paypal_link = RSFormProHelper::getConfig('paypal.test') ? 'https://www.paypal.com/cgi-bin/webscr' : 'https://www.sandbox.paypal.com/';
		$cancel_link = RSFormProHelper::getConfig('paypal.cancel');
		$cancel_link = !empty($cancel_link) ? '&cancel_return='.urlencode($cancel_link) : '';
		$currency	 = RSFormProHelper::getConfig('payment.currency');
		$language	 = RSFormProHelper::getConfig('paypal.language');
		$language	 = !empty($language) ? '&lc='.urlencode($language) : '&lc=US';
		$tax		 = RSFormProHelper::getConfig('paypal.tax.value');
		$tax		 = !empty($tax) ? $tax : 0;
		$taxtype	 = RSFormProHelper::getConfig('paypal.tax.type');
		$products	 = implode(', ', $products);
		
		if ($tax)
			$tax_code = $taxtype ? '&tax='.urlencode($tax) : '&tax_rate='.urlencode($tax);
		else
			$tax_code = '';
		
		if ($price > 0)
		{
			$price = number_format($price, 2, '.', '');
			$link = $paypal_link . '?cmd=_xclick&business=' . urlencode(RSFormProHelper::getConfig('paypal.email')) . '&item_name=' . urlencode($products) . '&currency_code=' . urlencode($currency). '&amount=' . urlencode($price) . '&return_url='.urlencode(JURI::root().'index.php?option=com_rsform&formId='.$formId.'&task=plugin&plugin_task=paypal.return&code='.$code).'&notify_url='.urlencode(JURI::root().'index.php?option=com_rsform&formId='.$formId.'&task=plugin&plugin_task=paypal.notify&code='.$code).'&return='.urlencode(RSFormProHelper::getConfig('paypal.return')).'&charset=utf-8'.$cancel_link.$language.$tax_code;
			$mainframe->redirect($link);
		}
	}
	
	function rsfp_bk_onAfterCreateComponentPreview($args = array())
	{
		if ($args['ComponentTypeName'] == 'paypal')
		{
			$args['out'] = '<td>&nbsp;</td>';
			$args['out'].= '<td><img src="'.JURI::root(true).'/administrator/components/com_rsform/assets/images/icons/paypal.png" /> '.$args['data']['LABEL'].'</td>';	
		}
	}
	
	function rsfp_bk_onAfterShowConfigurationTabs($tabs)
	{
		$lang = JFactory::getLanguage();
		$lang->load( 'plg_system_rsfppaypal' );
		
		$tabs->addTitle(JText::_('RSFP_PAYPAL_LABEL'), 'form-paypal');
		$tabs->addContent($this->paypalConfigurationScreen());
	}
	
	function rsfp_f_onSwitchTasks()
	{
		//Notification receipt from Paypal
		if (JRequest::getVar('plugin_task') == 'paypal.notify')
		{
			$db 	= JFactory::getDBO();
			$code 	= JRequest::getVar('code');
			$formId = JRequest::getInt('formId');
			$db->setQuery("SELECT SubmissionId FROM #__rsform_submissions s WHERE s.FormId='".$formId."' AND MD5(CONCAT(s.SubmissionId,s.DateSubmitted)) = '".$db->escape($code)."'");
			if ($SubmissionId = $db->loadResult())
			{
				$db->setQuery("UPDATE #__rsform_submission_values sv SET sv.FieldValue=1 WHERE sv.FieldName='_STATUS' AND sv.FormId='".$formId."' AND sv.SubmissionId = '".$SubmissionId."'");
				$db->execute();
				
				$mainframe = JFactory::getApplication();
				$mainframe->triggerEvent('rsfp_afterConfirmPayment', array($SubmissionId));
			}
			jexit('ok');
		}
	}
	
	function paypalConfigurationScreen()
	{
		ob_start();
		
		?>
		<div id="page-paypal" class="com-rsform-css-fix">
			<table  class="admintable">
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="currency"><?php echo JText::_( 'RSFP_PAYPAL_EMAIL' ); ?></label></td>
					<td><input type="text" name="rsformConfig[paypal.email]" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('paypal.email')); ?>" size="100" maxlength="64"></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="return"><?php echo JText::_( 'RSFP_PAYPAL_RETURN' ); ?></label></td>
					<td><input type="text" name="rsformConfig[paypal.return]" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('paypal.return'));  ?>" size="100"></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="cancel"><?php echo JText::_( 'RSFP_PAYPAL_CANCEL' ); ?></label></td>
					<td><input type="text" name="rsformConfig[paypal.cancel]" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('paypal.cancel'));  ?>" size="100"></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="currency"><?php echo JText::_( 'RSFP_PAYPAL_TEST' ); ?></label></td>
					<td><?php echo JHTML::_('select.booleanlist', 'rsformConfig[paypal.test]' , '' , RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('paypal.test')));?></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="tax.type"><?php echo JText::_( 'RSFP_PAYPAL_TAX_TYPE' ); ?></label></td>
					<td><?php echo JHTML::_('select.booleanlist', 'rsformConfig[paypal.tax.type]' , '' , RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('paypal.tax.type')), JText::_('RSFP_PAYPAL_TAX_TYPE_FIXED'), JText::_('RSFP_PAYPAL_TAX_TYPE_PERCENT'));?></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="tax.value"><?php echo JText::_( 'RSFP_PAYPAL_TAX_VALUE' ); ?></label></td>
					<td><input type="text" name="rsformConfig[paypal.tax.value]" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('paypal.tax.value'));  ?>" size="4" maxlength="5"></td>
				</tr>
				<tr>
					<td width="200" style="width: 200px;" align="right" class="key"><label for="language"><?php echo JText::_( 'RSFP_PAYPAL_LANGUAGE' ); ?></label></td>
					<td>
						<input type="text" name="rsformConfig[paypal.language]" value="<?php echo RSFormProHelper::htmlEscape(RSFormProHelper::getConfig('paypal.language'));  ?>" size="4" maxlength="2">
						<?php echo JText::_('PAYPAL_LANGUAGES_CODES') ?>
					</td>
				</tr>
			</table>
		</div>
		<?php
		
		$contents = ob_get_contents();
		ob_end_clean();
		return $contents;
	}
}