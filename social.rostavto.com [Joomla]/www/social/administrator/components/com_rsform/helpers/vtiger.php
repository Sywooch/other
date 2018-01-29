<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2011 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
function enablevTiger(value)
{
	document.getElementById('vt_table').style.display = 'none';
	if (value == 1)
		document.getElementById('vt_table').style.display = '';
}

function enablevTigerDebug(value)
{
	var todo = true;
	if (value == 1)
		todo = false;
	
	document.getElementById('vt_debugEmail').disabled = todo;
}

function addvTigerCustomField()
{
	var table = document.getElementById('vt_table');
	
	// ID
	var id = Math.floor(Math.random()*3+1);
	
	// API Name
	var x = table.insertRow(table.rows.length);
	x.id = 'vt_api_name' + id;
	x.setAttribute('id', 'vt_api_name' + id);
	
	var y = x.insertCell(0);
	y.setAttribute('width', 80);
	y.setAttribute('align', 'right');
	y.setAttribute('nowrap', 'nowrap');
	y.setAttribute('class', 'key');
	y.innerHTML = '<?php echo JText::_('RSFP_VT_CUSTOM_FIELD_API_NAME', true); ?>';
	
	var y = x.insertCell(1);	
	var input = document.createElement('input');
	input.name = 'vt_api_name[]';
	input.value = 'ID';
	input.setAttribute('class', 'rs_inp rs_50');
	y.appendChild(input);
	
	var button = document.createElement('button');
	button.type = 'button';
	button.setAttribute('class', 'rs_button rs_right');
	button.innerHTML = '<?php echo JText::_('DELETE', true); ?>';
	jQuery(button).click(function() {
		deletevTigerCustomField(id);
	});
	y.appendChild(button);
	
	// Value
	var x = table.insertRow(table.rows.length);
	x.id = 'vt_value' + id;
	x.setAttribute('id', 'vt_value' + id);
	
	var y = x.insertCell(0);
	y.setAttribute('width', 80);
	y.setAttribute('align', 'right');
	y.setAttribute('nowrap', 'nowrap');
	y.setAttribute('class', 'key');
	y.innerHTML = '<?php echo JText::_('RSFP_VT_CUSTOM_FIELD_API_VALUE', true); ?>';
	
	var y = x.insertCell(1);
	var input = document.createElement('input');
	input.name = 'vt_value[]';
	input.value = '';
	input.setAttribute('class', 'rs_inp rs_80');
	y.appendChild(input);
}

function deletevTigerCustomField(id)
{
	document.getElementById('vt_api_name' + id).parentNode.removeChild(document.getElementById('vt_api_name' + id));
	document.getElementById('vt_value' + id).parentNode.removeChild(document.getElementById('vt_value' + id));
}
</script>
<style type="text/css">
#vtigerdiv { overflow: auto; }
ul.rsform_leftnav li a#vtiger span {
	background: url(components/com_rsform/assets/images/icons/vtiger.png) no-repeat scroll 10px center transparent;
}
</style>
<table class="admintable">
<tr>
	<td valign="top" align="left" width="1%">
		<table>
			<tr>
				<td colspan="2"><?php echo JHTML::image('administrator/components/com_rsform/assets/images/vtiger.png', 'vtiger.com'); ?></td>
			</tr>
			<tr>
				<td colspan="2"><div class="rsform_error" style="width: 620px;"><?php echo JText::_('RSFP_VTIGER_DESC'); ?></div></td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_USE_INTEGRATION'); ?></td>
				<td nowrap="nowrap"><?php echo $lists['published']; ?></td>
			</tr>
		</table>
		<table id="vt_table" <?php echo !$row->vt_published ? 'style="display: none;"' : ''; ?>>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_ACCESSKEY'); ?></td>
				<td>
					<input name="vt_accesskey" id="vt_accesskey" value="<?php echo RSFormProHelper::htmlEscape($row->vt_accesskey); ?>" class="rs_inp rs_80" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_USERNAME'); ?></td>
				<td>
					<input name="vt_username" id="vt_username" value="<?php echo RSFormProHelper::htmlEscape($row->vt_username); ?>" class="rs_inp rs_80" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_HOSTNAME'); ?></td>
				<td>
					<input name="vt_hostname" id="vt_hostname" value="<?php echo RSFormProHelper::htmlEscape($row->vt_hostname); ?>" class="rs_inp rs_80" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_DEBUG'); ?></td>
				<td><?php echo $lists['debug']; ?></td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_DEBUG_EMAIL'); ?></td>
				<td>
					<input name="vt_debugEmail" id="vt_debugEmail" value="<?php echo RSFormProHelper::htmlEscape($row->vt_debugEmail); ?>" class="rs_inp rs_80" <?php if (!$row->vt_published || !$row->vt_debug) { ?>disabled="disabled"<?php } ?> />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_LEAD_SOURCE'); ?></td>
				<td>
					<input name="vt_leadsource" id="vt_leadsource" value="<?php echo RSFormProHelper::htmlEscape($row->vt_leadsource); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
					<br /><small><?php echo JText::_('RSFP_VT_LEAD_SOURCE_DESC'); ?></small>
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_LEAD_STATUS'); ?></td>
				<td>
					<input name="vt_leadstatus" id="vt_leadstatus" value="<?php echo RSFormProHelper::htmlEscape($row->vt_leadstatus); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_DESCRIPTION'); ?></td>
				<td>
					<input name="vt_description" id="vt_description" value="<?php echo RSFormProHelper::htmlEscape($row->vt_description); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_DESIGNATION'); ?></td>
				<td>
					<input name="vt_designation" id="vt_designation" value="<?php echo RSFormProHelper::htmlEscape($row->vt_designation); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_SALUTATION'); ?></td>
				<td>
					<input name="vt_salutationtype" id="vt_salutationtype" value="<?php echo RSFormProHelper::htmlEscape($row->vt_salutationtype); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
					<br /><small><?php echo JText::_('RSFP_VT_SALUTATION_DESC'); ?></small>
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_FIRST_NAME'); ?></td>
				<td>
					<input name="vt_firstname" id="vt_firstname" value="<?php echo RSFormProHelper::htmlEscape($row->vt_firstname); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_LAST_NAME'); ?></td>
				<td>
					<input name="vt_lastname" id="vt_lastname" value="<?php echo RSFormProHelper::htmlEscape($row->vt_lastname); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_TITLE'); ?></td>
				<td>
					<input name="vt_title" id="vt_title" value="<?php echo RSFormProHelper::htmlEscape($row->vt_title); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_INDUSTRY'); ?></td>
				<td>
					<input name="vt_industry" id="vt_industry" value="<?php echo RSFormProHelper::htmlEscape($row->vt_industry); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_COMPANY'); ?></td>
				<td>
					<input name="vt_company" id="vt_company" value="<?php echo RSFormProHelper::htmlEscape($row->vt_company); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_RATING'); ?></td>
				<td>
					<input name="vt_rating" id="vt_rating" value="<?php echo RSFormProHelper::htmlEscape($row->vt_rating); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_ANNUALREVENUE'); ?></td>
				<td>
					<input name="vt_annualrevenue" id="vt_annualrevenue" value="<?php echo RSFormProHelper::htmlEscape($row->vt_annualrevenue); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_NOOFEMPLOYEES'); ?></td>
				<td>
					<input name="vt_noofemployees" id="vt_noofemployees" value="<?php echo RSFormProHelper::htmlEscape($row->vt_noofemployees); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_WEBSITE'); ?></td>
				<td>
					<input name="vt_website" id="vt_website" value="<?php echo RSFormProHelper::htmlEscape($row->vt_website); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_EMAIL'); ?></td>
				<td>
					<input name="vt_email" id="vt_email" value="<?php echo RSFormProHelper::htmlEscape($row->vt_email); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_SECONDARYEMAIL'); ?></td>
				<td>
					<input name="vt_secondaryemail" id="vt_secondaryemail" value="<?php echo RSFormProHelper::htmlEscape($row->vt_secondaryemail); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_PHONE'); ?></td>
				<td>
					<input name="vt_phone" id="vt_phone" value="<?php echo RSFormProHelper::htmlEscape($row->vt_phone); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_MOBILE'); ?></td>
				<td>
					<input name="vt_mobile" id="vt_mobile" value="<?php echo RSFormProHelper::htmlEscape($row->vt_mobile); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_FAX'); ?></td>
				<td>
					<input name="vt_fax" id="vt_fax" value="<?php echo RSFormProHelper::htmlEscape($row->vt_fax); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_LANE'); ?></td>
				<td>
					<input name="vt_lane" id="vt_lane" value="<?php echo RSFormProHelper::htmlEscape($row->vt_lane); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_POBOX'); ?></td>
				<td>
					<input name="vt_pobox" id="vt_pobox" value="<?php echo RSFormProHelper::htmlEscape($row->vt_pobox); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_CITY'); ?></td>
				<td>
					<input name="vt_city" id="vt_city" value="<?php echo RSFormProHelper::htmlEscape($row->vt_city); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_STATE'); ?></td>
				<td>
					<input name="vt_state" id="vt_state" value="<?php echo RSFormProHelper::htmlEscape($row->vt_state); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_CODE'); ?></td>
				<td>
					<input name="vt_code" id="vt_code" value="<?php echo RSFormProHelper::htmlEscape($row->vt_code); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_COUNTRY'); ?></td>
				<td>
					<input name="vt_country" id="vt_country" value="<?php echo RSFormProHelper::htmlEscape($row->vt_country); ?>" class="rs_inp rs_80" onkeydown="closeAllDropdowns();" onclick="toggleDropdown(this);" />
				</td>
			</tr>
			<tr>
				<td colspan="2" class="key" align="center"><p align="center"><?php echo JText::_('RSFP_VT_CUSTOM_FIELDS'); ?> <button type="button" class="rs_button" onclick="addvTigerCustomField();"><?php echo JText::_('RSFP_VT_ADD_CUSTOM_FIELD'); ?></button></p></td>
			</tr>
			<?php foreach ($row->vt_custom_fields as $i => $field) { ?>
			<tr id="vt_api_name<?php echo $i; ?>">
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_CUSTOM_FIELD_API_NAME'); ?></td>
				<td><input name="vt_api_name[]" value="<?php echo RSFormProHelper::htmlEscape($field->api_name); ?>" class="rs_inp rs_50" /><button class="rs_button rs_right" type="button" onclick="deletevTigerCustomField(<?php echo $i; ?>)"><?php echo JText::_('DELETE'); ?></button></td>
			</tr>
			<tr id="vt_value<?php echo $i; ?>">
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_VT_CUSTOM_FIELD_API_VALUE'); ?></td>
				<td><input name="vt_value[]" value="<?php echo RSFormProHelper::htmlEscape($field->value); ?>" class="rs_inp rs_80" /></td>
			</tr>
			<?php } ?>
		</table>
	</td>
	<td valign="top">
		&nbsp;
	</td>
</tr>
</table>