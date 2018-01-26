<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>


<section class="contact">
	<div class="inner">
		<div class="bd">
			<?php
					if(isset($this->variables['successMessage']) && count($this->variables['successMessage']) != 0 && $this->variables['successMessage'] != '' && $this->variables['successMessage'] !== false)
					{
						?><div class="message-success"><?php echo $this->variables['successMessage']; ?></div><?php } ?>
			<?php
					if(isset($this->variables['formBuilderError']) && count($this->variables['formBuilderError']) != 0 && $this->variables['formBuilderError'] != '' && $this->variables['formBuilderError'] !== false)
					{
						?><div class="message error"><p><?php echo $this->variables['formBuilderError']; ?></p></div><?php } ?>

			<?php
					if(isset($this->variables['fields']) && count($this->variables['fields']) != 0 && $this->variables['fields'] != '' && $this->variables['fields'] !== false)
					{
						?>
			<div class="field_container">
				<form <?php
					if(isset($this->variables['hidUtf8']) && count($this->variables['hidUtf8']) != 0 && $this->variables['hidUtf8'] != '' && $this->variables['hidUtf8'] !== false)
					{
						?>accept-charset="UTF-8" <?php } ?>id="<?php echo $this->variables['formName']; ?>" method="post" action="#sendPage">
					<?php
					if(isset($this->variables['formToken']) && count($this->variables['formToken']) != 0 && $this->variables['formToken'] != '' && $this->variables['formToken'] !== false)
					{
						?>
						<input type="hidden" name="form_token" id="formToken<?php echo SpoonFilter::ucfirst($this->variables['formName']); ?>" value="<?php echo $this->variables['formToken']; ?>" />
					<?php } ?>

					<input type="hidden" name="form" value="<?php echo $this->variables['formName']; ?>" />

					<?php
				if(isset(${'fields'})) $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['old'] = ${'fields'};
				$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['iteration'] = $this->variables['fields'];
				$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['i'] = 1;
				$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['count'] = count($this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['iteration'] as ${'fields'})
				{
					if(!isset(${'fields'}['first']) && $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['i'] == 1) ${'fields'}['first'] = true;
					if(!isset(${'fields'}['last']) && $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['i'] == $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['count']) ${'fields'}['last'] = true;
					if(isset(${'fields'}['formElements']) && is_array(${'fields'}['formElements']))
					{
						foreach(${'fields'}['formElements'] as $name => $object)
						{
							${'fields'}[$name] = $object->parse();
							${'fields'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						
						<?php
					if(isset(${'fields'}['plaintext']) && count(${'fields'}['plaintext']) != 0 && ${'fields'}['plaintext'] != '' && ${'fields'}['plaintext'] !== false)
					{
						?>
							<div class="content">
								<?php echo ${'fields'}['html']; ?>
							</div>
						<?php } ?>

						
						<?php
					if(isset(${'fields'}['simple']) && count(${'fields'}['simple']) != 0 && ${'fields'}['simple'] != '' && ${'fields'}['simple'] !== false)
					{
						?>
							<p<?php
					if(isset(${'fields'}['error']) && count(${'fields'}['error']) != 0 && ${'fields'}['error'] != '' && ${'fields'}['error'] !== false)
					{
						?> class="errorArea"<?php } ?>>
								<label for="<?php echo ${'fields'}['name']; ?>">
									<?php echo ${'fields'}['label']; ?><?php
					if(isset(${'fields'}['required']) && count(${'fields'}['required']) != 0 && ${'fields'}['required'] != '' && ${'fields'}['required'] !== false)
					{
						?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr><?php } ?>
								</label>
								<?php echo ${'fields'}['html']; ?>
								<?php
					if(isset(${'fields'}['error']) && count(${'fields'}['error']) != 0 && ${'fields'}['error'] != '' && ${'fields'}['error'] !== false)
					{
						?><span class="formError inlineError"><?php echo ${'fields'}['error']; ?></span><?php } ?>
							</p>
						<?php } ?>

						
						<?php
					if(isset(${'fields'}['multiple']) && count(${'fields'}['multiple']) != 0 && ${'fields'}['multiple'] != '' && ${'fields'}['multiple'] !== false)
					{
						?>
							<div class="inputList<?php
					if(isset(${'fields'}['error']) && count(${'fields'}['error']) != 0 && ${'fields'}['error'] != '' && ${'fields'}['error'] !== false)
					{
						?> errorArea<?php } ?>">
								<p class="label">
									<?php echo ${'fields'}['label']; ?><?php
					if(isset(${'fields'}['required']) && count(${'fields'}['required']) != 0 && ${'fields'}['required'] != '' && ${'fields'}['required'] !== false)
					{
						?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr><?php } ?>
								</p>
								<ul>
									<?php
				if(isset(${'fields'}['html'])) $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['old'] = ${'fields'}['html'];
				$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['iteration'] = ${'fields'}['html'];
				$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['i'] = 1;
				$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['count'] = count($this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['iteration']);
				foreach((array) $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['iteration'] as ${'fields'}['html'])
				{
					if(!isset(${'fields'}['html']['first']) && $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['i'] == 1) ${'fields'}['html']['first'] = true;
					if(!isset(${'fields'}['html']['last']) && $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['i'] == $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['count']) ${'fields'}['html']['last'] = true;
					if(isset(${'fields'}['html']['formElements']) && is_array(${'fields'}['html']['formElements']))
					{
						foreach(${'fields'}['html']['formElements'] as $name => $object)
						{
							${'fields'}['html'][$name] = $object->parse();
							${'fields'}['html'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
										<li><label for="<?php echo ${'fields'}['html']['id']; ?>"><?php echo ${'fields'}['html']['field']; ?> <?php echo ${'fields'}['html']['label']; ?></label></li>
									<?php
					$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['i']++;
				}
				if(isset($this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['old'])) ${'fields'}['html'] = $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']['old'];
				else unset($this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_2']['html']);
				?>
								</ul>
								<?php
					if(isset(${'fields'}['error']) && count(${'fields'}['error']) != 0 && ${'fields'}['error'] != '' && ${'fields'}['error'] !== false)
					{
						?><span class="formError inlineError"><?php echo ${'fields'}['error']; ?></span><?php } ?>
							</div>
						<?php } ?>
					<?php
					$this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['old'])) ${'fields'} = $this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']['old'];
				else unset($this->iterations['97715773809e2e191aadc605a60547bf_Form.tpl.php_1']);
				?>

					<p>
						<input type="submit" value="<?php echo $this->variables['submitValue']; ?>" name="submit" class="inputSubmit" />
					</p>
				</form>
			<?php } ?>
			</div>
		</div>
	</div>
</section>
