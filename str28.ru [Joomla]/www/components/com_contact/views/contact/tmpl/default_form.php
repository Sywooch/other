<?php

 /**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */
defined('_REXEC') or die;
JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');
 if (isset($this->error)) : ?>
	<div class="contact-error">
		<?php echo $this->error; ?>
	</div>
<?php endif; ?>






<div class="contact-form" style="text-align:left !important; width:670px !important;"> 
	<form id="contact-form" action="<?php echo JRoute::_('index.php'); ?>" method="post" class="form-validate" >
		<fieldset>
			<legend><?php echo RText::_('COM_CONTACT_FORM_LABEL'); ?></legend>
			<dl>
				<div style="width:660px; height:30px; "><dt><?php echo $this->form->getLabel('contact_name'); ?></dt>
				<dd><?php echo $this->form->getInput('contact_name'); ?></dd></div>
				
				
				<div style="width:660px; height:30px; ">
				<dt ><?php echo $this->form->getLabel('contact_email'); ?></dt>
				<dd ><?php //echo $this->form->getInput('contact_email'); ?>
				<input type="email" name="rinputform[contact_email]" 
				class="validate-email required invalid" id="rinputform_contact_email"
				value="" size="31" aria-required="true" required="required"
				aria-invalid="true"></input>
				
				</dd></div>
				
				
				<div style="width:660px; height:30px; ">
				<dt ><?php echo $this->form->getLabel('contact_subject'); ?></dt>
				<dd ><?php echo $this->form->getInput('contact_subject'); ?></dd>
				</div>
				
				<div style="width:660px; height:30px; ">
				<dt ><?php echo $this->form->getLabel('contact_message'); ?></dt>
				<dd ><?php echo $this->form->getInput('contact_message'); ?></dd>
				</div>
				<?php 	if ($this->params->get('show_email_copy')){ ?>
						
						<dt><?php echo $this->form->getLabel('contact_email_copy'); ?></dt>
						<dd ><?php echo $this->form->getInput('contact_email_copy'); ?></dd>
					
				<?php 	} ?>
			<?php //Dynamically load any additional fields from plugins. ?>
			     <?php foreach ($this->form->getFieldsets() as $fieldset): ?>
			          <?php if ($fieldset->name != 'contact'):?>
			               <?php $fields = $this->form->getFieldset($fieldset->name);?>
			               <?php foreach($fields as $field): ?>
			                    <?php if ($field->hidden): ?>
			                         <?php echo $field->input;?>
			                    <?php else:?>
			                         <dt>
			                            <?php echo $field->label; ?>
			                            <?php if (!$field->required && $field->type != "Spacer"): ?>
			                               <span class="optional"><?php echo RText::_('COM_CONTACT_OPTIONAL');?></span>
			                            <?php endif; ?>
			                         </dt>
			                         <dd><?php echo $field->input;?></dd>
			                    <?php endif;?>
			               <?php endforeach;?>
			          <?php endif ?>
			     <?php endforeach;?>
				<dt></dt>
				<dd><button class="button validate" type="submit"><?php echo RText::_('COM_CONTACT_CONTACT_SEND'); ?></button>
					<input type="hidden" name="option" value="com_contact" />
					<input type="hidden" name="task" value="contact.submit" />
					<input type="hidden" name="return" value="<?php echo $this->return_page;?>" />
					<input type="hidden" name="id" value="<?php echo $this->contact->slug; ?>" />
					<?php echo JHtml::_( 'form.token' ); ?>
				</dd>
			</dl>
		</fieldset>
	</form>
</div>
