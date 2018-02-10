<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div id="headerSearch">
	<h4><?php echo SpoonFilter::ucfirst($this->variables['lblSearch']); ?></h4>

	<?php
					if(isset($this->forms['search']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['search']->getAction(); ?>" method="<?php echo $this->forms['search']->getMethod(); ?>"<?php echo $this->forms['search']->getParametersHTML(); ?>>
						<?php echo $this->forms['search']->getField('form')->parse();
						if($this->forms['search']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['search']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['search']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
		<div class="oneLiner">
			<p><?php echo $this->variables['txtQWidget']; ?></p>
			<p><input id="submit" class="inputSubmit" type="submit" name="submit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblSearch']); ?>" /></p>
		</div>
	</form>
				<?php } ?>
</div>