<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<section class="mod">
	<div class="inner">
		<div class="bd">
			<?php
					if(isset($this->variables['successMessage']) && count($this->variables['successMessage']) != 0 && $this->variables['successMessage'] != '' && $this->variables['successMessage'] !== false)
					{
						?><div class="message success"><?php if(array_key_exists('successMessage', (array) $this->variables)) { echo $this->variables['successMessage']; } else { ?>{$successMessage}<?php } ?></div><?php } ?>
			<?php
					if(isset($this->variables['formBuilderError']) && count($this->variables['formBuilderError']) != 0 && $this->variables['formBuilderError'] != '' && $this->variables['formBuilderError'] !== false)
					{
						?><div class="message error"><p><?php if(array_key_exists('formBuilderError', (array) $this->variables)) { echo $this->variables['formBuilderError']; } else { ?>{$formBuilderError}<?php } ?></p></div><?php } ?>

			<?php
					if(isset($this->variables['fields']) && count($this->variables['fields']) != 0 && $this->variables['fields'] != '' && $this->variables['fields'] !== false)
					{
						?>
				<form <?php
					if(isset($this->variables['hidUtf8']) && count($this->variables['hidUtf8']) != 0 && $this->variables['hidUtf8'] != '' && $this->variables['hidUtf8'] !== false)
					{
						?>accept-charset="UTF-8" <?php } ?>id="<?php if(array_key_exists('formName', (array) $this->variables)) { echo $this->variables['formName']; } else { ?>{$formName}<?php } ?>" method="post" action="<?php if(array_key_exists('formAction', (array) $this->variables)) { echo $this->variables['formAction']; } else { ?>{$formAction}<?php } ?>">
					<?php
					if(isset($this->variables['formToken']) && count($this->variables['formToken']) != 0 && $this->variables['formToken'] != '' && $this->variables['formToken'] !== false)
					{
						?>
						<input type="hidden" name="form_token" id="formToken<?php if(array_key_exists('formName', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['formName']); } else { ?>{$formName|ucfirst}<?php } ?>" value="<?php if(array_key_exists('formToken', (array) $this->variables)) { echo $this->variables['formToken']; } else { ?>{$formToken}<?php } ?>" />
					<?php } ?>

					<input type="hidden" name="form" value="<?php if(array_key_exists('formName', (array) $this->variables)) { echo $this->variables['formName']; } else { ?>{$formName}<?php } ?>" />

					<?php
					if(!isset($this->variables['fields']))
					{
						?>{iteration:fields}<?php
						$this->variables['fields'] = array();
						$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['fail'] = true;
					}
				if(isset(${'fields'})) $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['old'] = ${'fields'};
				$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['iteration'] = $this->variables['fields'];
				$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['i'] = 1;
				$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['count'] = count($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['iteration'] as ${'fields'})
				{
					if(!isset(${'fields'}['first']) && $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['i'] == 1) ${'fields'}['first'] = true;
					if(!isset(${'fields'}['last']) && $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['i'] == $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['count']) ${'fields'}['last'] = true;
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
								<?php if(array_key_exists('html', (array) ${'fields'})) { echo ${'fields'}['html']; } else { ?>{$fields->html}<?php } ?>
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
								<label for="<?php if(array_key_exists('name', (array) ${'fields'})) { echo ${'fields'}['name']; } else { ?>{$fields->name}<?php } ?>">
									<?php if(array_key_exists('label', (array) ${'fields'})) { echo ${'fields'}['label']; } else { ?>{$fields->label}<?php } ?><?php
					if(isset(${'fields'}['required']) && count(${'fields'}['required']) != 0 && ${'fields'}['required'] != '' && ${'fields'}['required'] !== false)
					{
						?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr><?php } ?>
								</label>
								<?php if(array_key_exists('html', (array) ${'fields'})) { echo ${'fields'}['html']; } else { ?>{$fields->html}<?php } ?>
								<?php
					if(isset(${'fields'}['error']) && count(${'fields'}['error']) != 0 && ${'fields'}['error'] != '' && ${'fields'}['error'] !== false)
					{
						?><span class="formError inlineError"><?php if(array_key_exists('error', (array) ${'fields'})) { echo ${'fields'}['error']; } else { ?>{$fields->error}<?php } ?></span><?php } ?>
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
									<?php if(array_key_exists('label', (array) ${'fields'})) { echo ${'fields'}['label']; } else { ?>{$fields->label}<?php } ?><?php
					if(isset(${'fields'}['required']) && count(${'fields'}['required']) != 0 && ${'fields'}['required'] != '' && ${'fields'}['required'] !== false)
					{
						?><abbr title="<?php if(array_key_exists('lblRequiredField', (array) $this->variables)) { echo $this->variables['lblRequiredField']; } else { ?>{$lblRequiredField}<?php } ?>">*</abbr><?php } ?>
								</p>
								<ul>
									<?php
					if(!isset(${'fields'}['html']))
					{
						?>{iteration:fields->html}<?php
						${'fields'}['html'] = array();
						$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['fail'] = true;
					}
				if(isset(${'fields'}['html'])) $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['old'] = ${'fields'}['html'];
				$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['iteration'] = ${'fields'}['html'];
				$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['i'] = 1;
				$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['count'] = count($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['iteration']);
				foreach((array) $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['iteration'] as ${'fields'}['html'])
				{
					if(!isset(${'fields'}['html']['first']) && $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['i'] == 1) ${'fields'}['html']['first'] = true;
					if(!isset(${'fields'}['html']['last']) && $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['i'] == $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['count']) ${'fields'}['html']['last'] = true;
					if(isset(${'fields'}['html']['formElements']) && is_array(${'fields'}['html']['formElements']))
					{
						foreach(${'fields'}['html']['formElements'] as $name => $object)
						{
							${'fields'}['html'][$name] = $object->parse();
							${'fields'}['html'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
										<li><label for="<?php if(isset(${'fields'}['html']) && array_key_exists('id', (array) ${'fields'}['html'])) { echo ${'fields'}['html']['id']; } else { ?>{$fields->html.id}<?php } ?>"><?php if(isset(${'fields'}['html']) && array_key_exists('field', (array) ${'fields'}['html'])) { echo ${'fields'}['html']['field']; } else { ?>{$fields->html.field}<?php } ?> <?php if(isset(${'fields'}['html']) && array_key_exists('label', (array) ${'fields'}['html'])) { echo ${'fields'}['html']['label']; } else { ?>{$fields->html.label}<?php } ?></label></li>
									<?php
					$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['i']++;
				}
					if(isset($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['fail']) && $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['fail'] == true)
					{
						?>{/iteration:fields->html}<?php
					}
				if(isset($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['old'])) ${'fields'}['html'] = $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']['old'];
				else unset($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_2']['html']);
				?>
								</ul>
								<?php
					if(isset(${'fields'}['error']) && count(${'fields'}['error']) != 0 && ${'fields'}['error'] != '' && ${'fields'}['error'] !== false)
					{
						?><span class="formError inlineError"><?php if(array_key_exists('error', (array) ${'fields'})) { echo ${'fields'}['error']; } else { ?>{$fields->error}<?php } ?></span><?php } ?>
							</div>
						<?php } ?>
					<?php
					$this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['fail']) && $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:fields}<?php
					}
				if(isset($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['old'])) ${'fields'} = $this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']['old'];
				else unset($this->iterations['14c2c7e4c7d4c32db30e8a83e5c85726_Form.tpl.php_1']);
				?>

					<p>
						<input type="submit" value="<?php if(array_key_exists('submitValue', (array) $this->variables)) { echo $this->variables['submitValue']; } else { ?>{$submitValue}<?php } ?>" name="submit" class="inputSubmit" />
					</p>
				</form>
			<?php } ?>
		</div>
	</div>
</section>
