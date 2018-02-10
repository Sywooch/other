<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
					if(isset($this->forms['search']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['search']->getAction(); ?>" method="<?php echo $this->forms['search']->getMethod(); ?>"<?php echo $this->forms['search']->getParametersHTML(); ?>>
						<?php echo $this->forms['search']->getField('form')->parse();
						if($this->forms['search']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['search']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['search']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<input type="hidden" value="search" id="formSearch" name="form" />
	<div class="form-group">
		<input value="" id="qWidget" name="q_widget" maxlength="255" type="text" class="inputText autoSuggest form-control" />
	</div>
	<input type="submit" class="btn btn-success" name="submit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSearch']); ?>">
</form>
				<?php } ?>