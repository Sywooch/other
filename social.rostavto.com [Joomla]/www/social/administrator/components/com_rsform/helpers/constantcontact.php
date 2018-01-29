<?php
/**
* @version 1.3.0
* @package RSform!Pro 1.3.0
* @copyright (C) 2007-2010 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
function rsfp_showCcVars(val)
{	
	if (val == 0)
		document.getElementById('merge_vars_cc').style.display = 'none';
	else
		document.getElementById('merge_vars_cc').style.display = '';
	return;
}

function rsfp_changeCcEmailType(what)
{	
	if (what.value == 'user')
		document.getElementById('cc_email_type_field').disabled = false;
	else
		document.getElementById('cc_email_type_field').disabled = true;
}

function rsfp_changeCcAction(what)
{	
	if (what.value == 2)
		document.getElementById('cc_action_field').disabled = false;
	else
		document.getElementById('cc_action_field').disabled = true;
}
</script>

<table class="admintable">
<tr>
	<td valign="top" align="left" width="30%">
		<table>
			<tr>
				<td colspan="2" align="center"><?php echo JHTML::image('administrator/components/com_rsform/assets/images/constantcontact.gif', 'ConstantContact'); ?></td>
			</tr>
			<tr>
				<td colspan="2"><div class="rsform_error"><?php echo JText::_('RSFP_CONSTANTCONTACT_DESC'); ?></div></td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_CC_USE_INTEGRATION'); ?></td>
				<td><?php echo $lists['published']; ?></td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key">
					<span class="hasTip" title="<?php echo JText::_('RSFP_CC_ACTION_DESC'); ?>"><?php echo JText::_('RSFP_CC_ACTION'); ?></span>
				</td>
				<td nowrap="nowrap"><?php echo $lists['cc_action']; ?> <?php echo $lists['cc_action_field']; ?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo JText::_('RSFP_CC_ACTION_WARNING'); ?></td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key"><?php echo JText::_('RSFP_CC_LIST_ID'); ?></td>
				<td nowrap="nowrap"><?php echo $lists['cc_list_id']; ?></td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key">
					<span class="hasTip" title="<?php echo JText::_('RSFP_CC_EMAIL_TYPE_DESC'); ?>"><?php echo JText::_('RSFP_CC_EMAIL_TYPE'); ?></span>
				</td>
				<td nowrap="nowrap"><?php echo $lists['cc_email_type']; ?> <?php echo $lists['cc_email_type_field']; ?></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo JText::_('RSFP_CC_EMAIL_TYPE_WARNING'); ?></td>
			</tr>
			<tr>
				<td colspan="2" class="key" align="center"><p align="center"><?php echo JText::_('RSFP_CC_UNSUBSCRIBE_OPTIONS'); ?></p></td>
			</tr>
			<tr>
				<td width="80" align="right" nowrap="nowrap" class="key">
					<span class="hasTip" title="<?php echo JText::_('RSFP_CC_DELETE_MEMBER_DESC'); ?>"><?php echo JText::_('RSFP_CC_DELETE_MEMBER'); ?></span>
				</td>
				<td><?php echo $lists['cc_delete_member']; ?></td>
			</tr>
			<tr>
				<td colspan="2" class="key" align="center"><p align="center"><?php echo JText::_('RSFP_CC_MERGE_VARS'); ?></p></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo JText::_('RSFP_CC_MERGE_VARS_DESC'); ?></td>
			</tr>
			<tbody id="merge_vars_cc">
			<?php if (is_array($merge_vars)) { ?>
				<?php foreach ($merge_vars as $merge_var => $title) { ?>
				<tr>
					<td nowrap="nowrap" align="right"><?php echo $title; ?></td>
					<td><?php echo $lists['fields'][$merge_var]; ?></td>
				</tr>
				<?php } ?>
			<?php } ?>
			</tbody>
		</table>
	</td>
	<td valign="top">
		&nbsp;
	</td>
</tr>
</table>
<script type="text/javascript">
var cc_list = document.getElementById('cc_list_id');
var cc_list_selected = cc_list.options[cc_list.selectedIndex].value;
rsfp_showCcVars(cc_list_selected);
</script>