<?php
/**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
JHtml::core();

$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));

// Create a shortcut for params.
$params = &$this->element->params;
?>

<?php if (empty($this->elements)) : ?>
	<p> <?php echo RText::_('COM_CONTACT_NO_CONTACTS'); ?>	 </p>
<?php else : ?>

<form action="<?php echo htmlspecialchars(JFactory::getURI()->toString()); ?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filters">
	<legend class="hidelabeltxt"><?php echo RText::_('RGLOBAL_FILTER_LABEL'); ?></legend>
	<?php if ($this->params->get('show_pagination_limit')) : ?>
		<div class="display-limit">
			<?php echo RText::_('RGLOBAL_DISPLAY_NUM'); ?>&#160;
			<?php echo $this->pagination->getLimitBox(); ?>
		</div>
	<?php endif; ?>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
	</fieldset>

	<table class="category">
		<?php if ($this->params->get('show_headings')) : ?>
		<thead><tr>
			<th class="element-num">
				<?php echo RText::_('RGLOBAL_NUM'); ?>
			</th>
			<th class="element-title">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_CONTACT_EMAIL_NAME_LABEL', 'a.name', $listDirn, $listOrder); ?>
			</th>
			<?php if ($this->params->get('show_position_headings')) : ?>
			<th class="element-position">
				<?php echo JHtml::_('grid.sort',  'COM_CONTACT_POSITION', 'a.con_position', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>
			<?php if ($this->params->get('show_email_headings')) : ?>
			<th class="element-email">
				<?php echo RText::_('RGLOBAL_EMAIL'); ?>
			</th>
			<?php endif; ?>
			<?php if ($this->params->get('show_telephone_headings')) : ?>
			<th class="element-phone">
				<?php echo RText::_('COM_CONTACT_TELEPHONE'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_mobile_headings')) : ?>
			<th class="element-phone">
				<?php echo RText::_('COM_CONTACT_MOBILE'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_fax_headings')) : ?>
			<th class="element-phone">
				<?php echo RText::_('COM_CONTACT_FAX'); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_suburb_headings')) : ?>
			<th class="element-suburb">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_SUBURB', 'a.suburb', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_state_headings')) : ?>
			<th class="element-state">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_STATE', 'a.state', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			<?php if ($this->params->get('show_country_headings')) : ?>
			<th class="element-state">
				<?php echo JHtml::_('grid.sort', 'COM_CONTACT_COUNTRY', 'a.country', $listDirn, $listOrder); ?>
			</th>
			<?php endif; ?>

			</tr>
		</thead>
		<?php endif; ?>

		<tbody>
			<?php foreach($this->elements as $i => $element) : ?>
				<tr class="<?php echo ($i % 2) ? "odd" : "even"; ?>">
					<td class="element-num">
						<?php echo $i; ?>
					</td>

					<td class="element-title">
						<a href="<?php echo JRoute::_(ContactHelperRoute::getContactRoute($element->slug, $element->catid)); ?>">
							<?php echo $element->name; ?></a>
					</td>

					<?php if ($this->params->get('show_position_headings')) : ?>
						<td class="element-position">
							<?php echo $element->con_position; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_email_headings')) : ?>
						<td class="element-email">
							<?php echo $element->email_to; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_telephone_headings')) : ?>
						<td class="element-phone">
							<?php echo $element->telephone; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_mobile_headings')) : ?>
						<td class="element-phone">
							<?php echo $element->mobile; ?>
						</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_fax_headings')) : ?>
					<td class="element-phone">
						<?php echo $element->fax; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_suburb_headings')) : ?>
					<td class="element-suburb">
						<?php echo $element->suburb; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_state_headings')) : ?>
					<td class="element-state">
						<?php echo $element->state; ?>
					</td>
					<?php endif; ?>

					<?php if ($this->params->get('show_country_headings')) : ?>
					<td class="element-state">
						<?php echo $element->country; ?>
					</td>
					<?php endif; ?>
				</tr>
			<?php endforeach; ?>

		</tbody>
	</table>

</form>
<?php endif; ?>
