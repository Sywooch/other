<?php defined('_JEXEC') or die; 
$editor =& JFactory::getEditor();
$usid = $this->user->id;
$baseurl = JURI::root();
?>

<?php if(isset($this->error)) { ?>
	<div id="faql-error">
		<?php echo $this->error; ?>
	</div>
<?php } ?>
<div class="editform">
	<form action="<?php echo $this->action ?>" method="post" name="adminForm" id="adminForm">
		<?php if ($this->data->id > 0) { ?>
			<div>
				<span class="key">
					<?php echo JText::_( 'JCATEGORY' ); ?>:
				</span>
					<b><?php echo $this->data->cattitle; ?></b>
					<input type="hidden" name="catid" value="<?php echo $this->data->catid; ?>" />
			</div>
			<div>
				<span class="key">
					<?php echo JText::_( 'AUTHOR_QUESTION' ); ?>:
				</span>
				<span class="key2">
					<b><?php echo $this->data->created_by;?></b>
					<input value="<?php echo $this->data->created_by;?>" type="hidden" name="created_by" id="created_by" readonly="readonly" />
				</span>
				<span class="key">
					<?php echo JText::_( 'IP' ); ?>:
				</span>
				<a title="Whois" target="_blank" href="http://www.ripe.net/perl/whois?searchtext=<?php echo $this->data->ip;?>"><b><?php echo $this->data->ip; ?></b></a>
			</div>
			<div>
				<span class="key">
					<?php echo JText::_( 'AUTHOR_EMAIL' ); ?>:
				</span>
				<span class="key2">
					<b>
						<?php 
							if ($this->data->email) echo $this->data->email;
							else echo '----';
						?>
					</b>
					<input value="<?php echo $this->data->email;?>" type="hidden" name="email" id="email" readonly="readonly" />
				</span>
				<div class="key3">
					<?php 
						if ($this->data->send_mail) $check = 'checked="checked"';
						else $check = '';
						if ($this->data->email) $disabled = '';
						else $disabled = 'disabled="disabled"';
					?>
					<input type="checkbox" name="send_mail" value="1" <?php echo $check; ?> <?php echo $disabled; ?> /><?php echo JText::_('SEND_MAIL'); ?>
				</div>
			</div>
				
			<div>
				<span class="key">
					<?php echo JText::_( 'CREATED' ); ?>:
				</span>
				<b><?php echo JHTML::_('date', $this->data->created, 'd-m-Y H:i:s'); ?></b>
				<input value="<?php echo JHTML::_('date', $this->data->created, 'd-m-Y H:i:s'); ?>" type="hidden" name="created" id="fromdate" />
			</div>
			<div>
				<span class="key">
					<?php echo JText::_( 'JPUBLISHED' ).':'; ?>
				</span>
				<div class="fl_publ">
					<?php echo $this->lists['published']; ?>
				</div>
			</div>
			<br />
		<?php } ?>                
		<div class="QuestForm">
			<fieldset>
				<legend><?php echo JText::_( 'QUESTION' ); ?></legend>
				<textarea id="question" name="question" rows="5" cols="50"><?php echo $this->data->question; ?></textarea> 
			</fieldset>
		
			<fieldset>
				<legend><?php echo JText::_( 'ANSWER' ); ?></legend>
				<?php echo $editor->display('answer', $this->data->answer, '100%', '100', '70', '15', true, null, 1 ); ?>
			</fieldset>
		</div>
		
		<div class="FutForm">
			<div>
				<span class="key">
					<?php echo JText::_( 'CREATED_ANSWER' ).':'; ?>
				</span>

				<?php
					if ($this->data->created_ans != 0) {
						$cr_answ = JHTML::_('date', $this->data->created_ans, 'd-m-Y H:i:s');
					}
					else {
						$date_answ = gmdate('Y-m-d H:i:s');
						$cr_answ = JHTML::_('date', $date_answ, 'd-m-Y H:i:s');
					}
					echo JHTML::calendar($cr_answ, 'created_ans', 'fromdate2', '%d-%m-%Y 00:00:00', array('size'=>'17', 'maxlength'=>'17'));
				?>
			</div>
			<div>
				<div class="key">
					<?php echo JText::_( 'SELECT_STATE_ANSWER' ); ?>:
				</div>
				<div>
					<?php echo $this->lists['state_ans']; ?>
				</div>
			</div>
		</div>
		
		<div>
			<button type="button" onclick="submitbtn('save');">
			<?php echo JText::_('JSAVE') ?>
			</button>
			<button type="button" onclick="submitbtn('cancel');">
			<?php echo JText::_('JCANCEL') ?>
			</button>
		</div>
		
		<input type="hidden" id="wanttxt" value="<?php echo JText::_( 'YOU_WANT_TO_PUBLISH_A_QUESTION', true ); ?>" />
		<input type="hidden" name="author_answ" value="" id="autansw" />
		<input type="hidden" name="idman" value="<?php echo $usid; ?>" id="idman" />
		<input type="hidden" name="whom" value=<?php echo $this->data->whom; ?> />
		<input type="hidden" name="option" value="com_faql" />                    
		<input type="hidden" name="id" value="<?php echo $this->data->id; ?>" />
		<input type="hidden" name="task" value="" />

		<?php echo JHTML::_( 'form.token' ); ?>
	</form>
</div>
<?php echo JHTML::_('behavior.keepalive'); ?>

