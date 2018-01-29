<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2011 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * RSForm! Pro system plugin
 */
class plgSystemRSFPPDF extends JPlugin
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
	function plgSystemRSFPPDF(&$subject, $config)
	{
		parent::__construct($subject, $config);
		$this->params = $config;
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
	
	function rsfp_onFormSave($form)
	{
		$post = JRequest::get('post', JREQUEST_ALLOWRAW);
		$post['form_id'] = $post['formId'];
		
		$row = JTable::getInstance('RSForm_PDFs', 'Table');
		if (!$row)
			return;
		if (!$row->bind($post))
		{
			JError::raiseWarning(500, $row->getError());
			return false;
		}
		
		$db = JFactory::getDBO();
		$db->setQuery("SELECT form_id FROM #__rsform_pdfs WHERE form_id='".(int) $post['form_id']."'");
		if (!$db->loadResult())
		{
			$db->setQuery("INSERT INTO #__rsform_pdfs SET form_id='".(int) $post['form_id']."'");
			$db->execute();
		}
		
		if ($row->store())
		{
			return true;
		}
		else
		{
			JError::raiseWarning(500, $row->getError());
			return false;
		}
	}
	
	function _createPDF($type, $args, $output=false)
	{
		$id  = $this->_createId($type, $args['submissionId']);
		$tmp = $this->_getTmp();
		
		// $args['form'], $args['placeholders'], $args['values'], $args['submissionId'], $args['userEmail']
		require_once JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/pdf/pdf.php';
		
		$cached_info = $this->_getInfo($args['form']->FormId);
		if (!empty($cached_info))
		{
			$info = clone $cached_info;
			jimport('joomla.filesystem.file');
			
			$pdf = new RSFormPDF();
			
			if (!empty($info->{$type.'email_php'}))
				eval($info->{$type.'email_php'});
			
			$info->{$type.'email_layout'}   = str_replace($args['placeholders'], $args['values'], $info->{$type.'email_layout'});
			$info->{$type.'email_filename'} = $this->_getFilename($info->{$type.'email_filename'}, $args['placeholders'], $args['values']);
			
			// sitepath
			$info->{$type.'email_layout'} = str_replace('{sitepath}', JPATH_SITE, $info->{$type.'email_layout'});
			
			if ($output) {
				$pdf->write($info->{$type.'email_filename'}, $info->{$type.'email_layout'}, true);
				jexit();
			}
			elseif ($info->{$type.'email_send'})
			{
				$path 	= $tmp.'/'.$id.'/'.$info->{$type.'email_filename'};
				$buffer = $pdf->write($info->{$type.'email_filename'}, $info->{$type.'email_layout'});
				if (JFile::write($path, $buffer))
					$args[$type.'Email']['files'][] = $path;
			}
		}
	}
	
	function rsfp_beforeUserEmail($args)
	{
		$this->_createPDF('user', $args);
	}
	
	function rsfp_beforeAdminEmail($args)
	{
		$this->_createPDF('admin', $args);
	}
	
	function _getInfo($formId)
	{
		static $cache;
		if (!is_array($cache))
			$cache = array();
		
		$formId = (int) $formId;
		
		if (!isset($cache[$formId]))
		{
			$db = JFactory::getDBO();
			$db->setQuery("SELECT * FROM #__rsform_pdfs WHERE form_id='".(int) $formId."'");
			$cache[$formId] = $db->loadObject();
		}
		
		return $cache[$formId];
	}
	
	function _getFilename($filename, $replace, $with)
	{
		$filename = str_replace($replace, $with, $filename);
		$filename = str_replace(array('\\', '/'), '', $filename);
		if (empty($filename))
			$filename = 'attachment';
		
		return $filename.'.pdf';
	}
	
	function _createId($suffix, $sid)
	{
		static $hash;
		if (!is_array($hash)) {
			$hash = array();
		}
		if (!isset($hash[$sid])) {
			$hash[$sid] = md5(uniqid($sid));
		}
		
		return $hash[$sid].'_'.$suffix;
	}
	
	function _getTmp()
	{
		static $tmp;
		if (!$tmp)
		{
			$mainframe = JFactory::getApplication();
			$tmp = $mainframe->getCfg('tmp_path');
		}
		
		return $tmp;
	}
	
	function rsfp_f_onAfterFormProcess($args)
	{
		// $args['SubmissionId'], $args['formId']
		// cleanup
		
		$info = $this->_getInfo($args['formId']);
		
		if (!empty($info) && ($info->useremail_send || $info->adminemail_send))
		{
			jimport('joomla.filesystem.file');
			jimport('joomla.filesystem.folder');
			list($replace, $with) = RSFormProHelper::getReplacements($args['SubmissionId']);
			$tmp = $this->_getTmp();
			
			if ($info->useremail_send)
			{
				$id = $this->_createId('user', $args['SubmissionId']);
				$info->useremail_filename = $this->_getFilename($info->useremail_filename, $replace, $with);
				$dir  = $tmp.'/'.$id;
				$path = $dir.'/'.$info->useremail_filename;
				if (file_exists($path) && is_file($path))
					JFile::delete($path);
				if (is_dir($dir))
					JFolder::delete($dir);
			}
			if ($info->adminemail_send)
			{
				$id = $this->_createId('admin', $args['SubmissionId']);
				$info->adminemail_filename = $this->_getFilename($info->adminemail_filename, $replace, $with);
				$dir  = $tmp.'/'.$id;
				$path = $dir.'/'.$info->adminemail_filename;
				if (file_exists($path) && is_file($path))
					JFile::delete($path);
				if (is_dir($dir))
					JFolder::delete($dir);
			}
		}
	}
	
	function rsfp_bk_onAfterShowFormScriptsTabsTab()
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfppdf');
		
		echo '<li><a href="javascript: void(0);" id="rsfppdf"><span>'.JText::_('RSFP_PHP_PDF_SCRIPTS').'</span></a></li>';
	}
	
	function rsfp_bk_onAfterShowFormScriptsTabs()
	{
		if (!$this->_loadRow()) return;
		
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfppdf');
		?>
		<div id="pdf_scripts">
		<style type="text/css">
		ul.rsform_leftnav li a#rsfppdf span {
			background: url("components/com_rsform/assets/images/icons/rsfppdf.png") no-repeat scroll 10px center transparent;
		}

		#useremail_layout, #adminemail_layout, #useremail_php, #adminemail_php
		{
			width: 700px;
			height: 450px;
		}
		</style>
		<table class="admintable">
			<tr>
				<td width="250" align="right" class="key" style="width: 250px;"><?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL_PHP'); ?></td>
				<td><?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL_PHP_DESC'); ?></td>
			</tr>
			<tr>
				<td colspan="2"><textarea rows="20" cols="75" style="width:100%;" class="codemirror-php" name="useremail_php" id="useremail_php"><?php echo RSFormProHelper::htmlEscape($this->row->useremail_php); ?></textarea></td>
			</tr>
			<tr>
				<td width="250" align="right" class="key" style="width: 250px;"><?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL_PHP'); ?></td>
				<td><?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL_PHP_DESC'); ?></td>
			</tr>
			<tr>
				<td colspan="2"><textarea rows="20" cols="75" style="width:100%;" class="codemirror-php" name="adminemail_php" id="adminemail_php"><?php echo RSFormProHelper::htmlEscape($this->row->adminemail_php); ?></textarea></td>
			</tr>
		</table>
		</div>
		<?php
	}
	
	function rsfp_bk_onAfterShowUserEmail()
	{
		if (!$this->_loadRow()) return;
		
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfppdf');
		
		$lists['useremail_send'] = RSFormProHelper::renderHTML('select.booleanlist','useremail_send','class="inputbox"',$this->row->useremail_send);
		?>
		<fieldset>
		<legend><?php echo JText::_('RSFP_PDF_ATTACHMENT'); ?></legend>
		<table style="width: 100%;">
			<tr>
				<td width="25%" align="right" nowrap="nowrap" class="key"><span class="hasTip" title="<?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL_DESC'); ?>"><?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL'); ?></span></td>
				<td><?php echo $lists['useremail_send']; ?></td>
			</tr>
			<tr>
				<td width="25%" align="right" nowrap="nowrap" class="key"><span class="hasTip" title="<?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL_FILENAME_DESC'); ?>"><?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL_FILENAME'); ?></span></td>
				<td><input type="text" class="rs_inp rs_80" name="useremail_filename" id="useremail_filename" value="<?php echo RSFormProHelper::htmlEscape($this->row->useremail_filename); ?>" size="35" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" /></td>
			</tr>
			<tr>
				<td width="25%" align="right" nowrap="nowrap" class="key"><span class="hasTip" title="<?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL_LAYOUT_DESC'); ?>"><?php echo JText::_('RSFP_PDF_SEND_USER_EMAIL_LAYOUT'); ?></span></td>
				<td><textarea rows="20" cols="75" style="width:100%;" class="rs_textarea codemirror-html" name="useremail_layout" id="useremail_layout"><?php echo RSFormProHelper::htmlEscape($this->row->useremail_layout); ?></textarea></td>
			</tr>
		</table>
		</fieldset>
		<?php
	}
	
	function rsfp_bk_onAfterShowAdminEmail()
	{
		if (!$this->_loadRow()) return;
		
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfppdf');
		
		$lists['adminemail_send'] = RSFormProHelper::renderHTML('select.booleanlist','adminemail_send','class="inputbox"',$this->row->adminemail_send);
		?>
		<fieldset>
		<legend><?php echo JText::_('RSFP_PDF_ATTACHMENT'); ?></legend>
		<table style="width: 100%;">
			<tr>
				<td width="25%" align="right" nowrap="nowrap" class="key"><span class="hasTip" title="<?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL_DESC'); ?>"><?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL'); ?></span></td>
				<td><?php echo $lists['adminemail_send']; ?></td>
			</tr>
			<tr>
				<td width="25%" align="right" nowrap="nowrap" class="key"><span class="hasTip" title="<?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL_FILENAME_DESC'); ?>"><?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL_FILENAME'); ?></span></td>
				<td><input type="text" class="rs_inp rs_80" name="adminemail_filename" id="adminemail_filename" value="<?php echo RSFormProHelper::htmlEscape($this->row->adminemail_filename); ?>" size="35" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" /></td>
			</tr>
			<tr>
				<td width="25%" align="right" nowrap="nowrap" class="key"><span class="hasTip" title="<?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL_LAYOUT_DESC'); ?>"><?php echo JText::_('RSFP_PDF_SEND_ADMIN_EMAIL_LAYOUT'); ?></span></td>
				<td><textarea rows="20" cols="75" style="width:100%;" class="rs_textarea codemirror-html" name="adminemail_layout" id="adminemail_layout"><?php echo RSFormProHelper::htmlEscape($this->row->adminemail_layout); ?></textarea></td>
			</tr>
		</table>
		</fieldset>
		<?php
	}
	
	function rsfp_bk_onAfterShowConfigurationTabs($tabs)
	{
		$lang = JFactory::getLanguage();
		$lang->load('plg_system_rsfppdf');
		
		$data 	= array();
		$data[] = JHTML::_('select.option', 'dejavu sans', JText::_('RSFP_PDF_DEJAVU_SANS'), 'value', 'text', !file_exists(JPATH_COMPONENT.'/helpers/pdf/dompdf6/lib/fonts/DejaVuSans.ufm'));
		$data[] = JHTML::_('select.option', 'fireflysung', JText::_('RSFP_PDF_FIREFLYSUNG'), 'value', 'text', !file_exists(JPATH_COMPONENT.'/helpers/pdf/dompdf6/lib/fonts/fireflysung.ufm'));
		// get fonts
		$data[] = JHTML::_('select.option', 'courier', JText::_('RSFP_PDF_COURIER'));
		$data[] = JHTML::_('select.option', 'helvetica', JText::_('RSFP_PDF_HELVETICA'));
		$data[] = JHTML::_('select.option', 'times', JText::_('RSFP_PDF_TIMES'));
		
		$lists['font'] = JHTML::_('select.genericlist', $data, 'rsformConfig[pdf.font]', null, 'value', 'text', RSFormProHelper::getConfig('pdf.font'));
		
		// orientation
		$data = array(
			JHTML::_('select.option', 'portrait', JText::_('RSFP_PDF_PORTRAIT')),
			JHTML::_('select.option', 'landscape', JText::_('RSFP_PDF_LANDSCAPE'))
		);
		$lists['orientation'] = JHTML::_('select.genericlist', $data, 'rsformConfig[pdf.orientation]', null, 'value', 'text', RSFormProHelper::getConfig('pdf.orientation'));
		
		// paper size
		$data = array(
			JHTML::_('select.option', '4a0'),
			JHTML::_('select.option', '2a0'),
			JHTML::_('select.option', 'a0'),
			JHTML::_('select.option', 'a1'),
			JHTML::_('select.option', 'a2'),
			JHTML::_('select.option', 'a3'),
			JHTML::_('select.option', 'a4'),
			JHTML::_('select.option', 'a5'),
			JHTML::_('select.option', 'a6'),
			JHTML::_('select.option', 'a7'),
			JHTML::_('select.option', 'a8'),
			JHTML::_('select.option', 'a9'),
			JHTML::_('select.option', 'a10'),
			JHTML::_('select.option', 'b0'),
			JHTML::_('select.option', 'b1'),
			JHTML::_('select.option', 'b2'),
			JHTML::_('select.option', 'b3'),
			JHTML::_('select.option', 'b4'),
			JHTML::_('select.option', 'b5'),
			JHTML::_('select.option', 'b6'),
			JHTML::_('select.option', 'b7'),
			JHTML::_('select.option', 'b8'),
			JHTML::_('select.option', 'b9'),
			JHTML::_('select.option', 'b10'),
			JHTML::_('select.option', 'c0'),
			JHTML::_('select.option', 'c1'),
			JHTML::_('select.option', 'c2'),
			JHTML::_('select.option', 'c3'),
			JHTML::_('select.option', 'c4'),
			JHTML::_('select.option', 'c5'),
			JHTML::_('select.option', 'c6'),
			JHTML::_('select.option', 'c7'),
			JHTML::_('select.option', 'c8'),
			JHTML::_('select.option', 'c9'),
			JHTML::_('select.option', 'c10'),
			JHTML::_('select.option', 'ra0'),
			JHTML::_('select.option', 'ra1'),
			JHTML::_('select.option', 'ra2'),
			JHTML::_('select.option', 'ra3'),
			JHTML::_('select.option', 'ra4'),
			JHTML::_('select.option', 'sra0'),
			JHTML::_('select.option', 'sra1'),
			JHTML::_('select.option', 'sra2'),
			JHTML::_('select.option', 'sra3'),
			JHTML::_('select.option', 'sra4'),
			JHTML::_('select.option', 'letter'),
			JHTML::_('select.option', 'legal'),
			JHTML::_('select.option', 'ledger'),
			JHTML::_('select.option', 'tabloid'),
			JHTML::_('select.option', 'executive'),
			JHTML::_('select.option', 'folio'),
			JHTML::_('select.option', 'commercial #10 envelope'),
			JHTML::_('select.option', 'catalog #10 1/2 envelope'),
			JHTML::_('select.option', '8.5x11'),
			JHTML::_('select.option', '8.5x14'),
			JHTML::_('select.option', '11x17')
		);
		
		$lists['paper'] = JHTML::_('select.genericlist', $data, 'rsformConfig[pdf.paper]', null, 'value', 'text', RSFormProHelper::getConfig('pdf.paper'));
		
		$tabs->addTitle(JText::_('RSFP_PDF_CONFIG'), 'form-pdf');
		
		ob_start();
		
		?>
		<div class="rsform_error"><?php echo JText::_('RSFP_PDF_FONT_DESCRIPTION'); ?><br /><a href="http://www.rsjoomla.com/support/documentation/view-article/747-rsform-pro-pdf-plugin.html#unicode" target="_blank"><?php echo JText::_('RSFP_PDF_FONT_HOW_TO_ADD'); ?></a></div>
		<table class="admintable">
			<tr>
				<td align="right" class="key" nowrap="nowrap">
					<label><span title="<?php echo JText::_('RSFP_PDF_FONT_DESC'); ?>" class="hasTip"><?php echo JText::_('RSFP_PDF_FONT'); ?></span></label>
				</td>
				<td>
					<?php echo $lists['font']; ?>
				</td>
			</tr>
			<tr>
				<td align="right" class="key" nowrap="nowrap">
					<label><span title="<?php echo JText::_('RSFP_PDF_ORIENTATION_DESC'); ?>" class="hasTip"><?php echo JText::_('RSFP_PDF_ORIENTATION'); ?></span></label>
				</td>
				<td valign="middle">
					<?php echo $lists['orientation']; ?>
				</td>
			</tr>
			<tr>
				<td align="right" class="key" nowrap="nowrap">
					<label><span title="<?php echo JText::_('RSFP_PDF_PAPER_DESC'); ?>" class="hasTip"><?php echo JText::_('RSFP_PDF_PAPER'); ?></span></label>
				</td>
				<td>
					<?php echo $lists['paper']; ?>
				</td>
			</tr>
		</table>
		<?php
		
		$contents = ob_get_contents();
		ob_end_clean();
		
		$tabs->addContent($contents);
	}
	
	function rsfp_onAfterCreatePlaceholders($args)
	{
		// index.php?option=com_rsform&task=plugin&plugin_task=
		$hash = md5($args['submission']->SubmissionId.'{user}'.$args['submission']->DateSubmitted);
		$args['placeholders'][] = '{user_pdf}';
		$args['values'][] = JURI::root().'index.php?option=com_rsform&task=plugin&plugin_task=user_pdf&hash='.$hash;
		$hash = md5($args['submission']->SubmissionId.'{admin}'.$args['submission']->DateSubmitted);
		$args['placeholders'][] = '{admin_pdf}';
		$args['values'][] = JURI::root().'index.php?option=com_rsform&task=plugin&plugin_task=admin_pdf&hash='.$hash;
	}
	
	function rsfp_f_onSwitchTasks()
	{
		$task = JRequest::getCmd('plugin_task');
		if ($task == 'user_pdf' || $task == 'admin_pdf')
		{
			$hash = JRequest::getCmd('hash');
			if (strlen($hash) == 32)
			{
				$type = $task == 'user_pdf' ? 'user' : 'admin';
				$db = JFactory::getDBO();
				$db->setQuery("SELECT SubmissionId, FormId FROM #__rsform_submissions WHERE MD5(CONCAT(SubmissionId, '{".$type."}', DateSubmitted)) = '".$db->escape($hash)."'");
				if ($submission = $db->loadObject())
				{
					$form = new stdClass();
					$form->FormId = $submission->FormId;
					
					@list($placeholders, $values) = RSFormProHelper::getReplacements($submission->SubmissionId);
					
					$args = array(
						'SubmissionId' => $submission->SubmissionId,
						'submissionId' => $submission->SubmissionId,
						'form' => $form,
						'placeholders' => $placeholders,
						'values' => $values,
					);
					if ($task == 'user_pdf')
						$this->_createPDF('user', $args, true);
					elseif ($task == 'admin_pdf')
						$this->_createPDF('admin', $args, true);
				}
			}
		}
	}
	
	function _loadRow()
	{
		if (empty($this->row))
		{
			$this->row = JTable::getInstance('RSForm_PDFs', 'Table');
			if (empty($this->row))
				return false;
			$formId = JRequest::getInt('formId');
			$this->row->load($formId);
		}
		
		return true;
	}
}