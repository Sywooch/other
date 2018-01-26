<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div id="fieldHolder-<?php echo $this->variables['id']; ?>" class="field options">
	
	<?php
					if(isset($this->variables['plaintext']) && count($this->variables['plaintext']) != 0 && $this->variables['plaintext'] != '' && $this->variables['plaintext'] !== false)
					{
						?>
		<div class="fieldWrapper content">
			<?php echo $this->variables['content']; ?>
		</div>
	<?php } ?>

	
	<?php
					if(isset($this->variables['simple']) && count($this->variables['simple']) != 0 && $this->variables['simple'] != '' && $this->variables['simple'] !== false)
					{
						?>
		<div class="fieldWrapper horizontal">
			<label for="field<?php echo $this->variables['id']; ?>">
				<?php echo $this->variables['label']; ?><?php
					if(isset($this->variables['required']) && count($this->variables['required']) != 0 && $this->variables['required'] != '' && $this->variables['required'] !== false)
					{
						?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr><?php } ?>
			</label>
			<?php echo $this->variables['field']; ?>
		</div>
	<?php } ?>

	
	<?php
					if(isset($this->variables['multiple']) && count($this->variables['multiple']) != 0 && $this->variables['multiple'] != '' && $this->variables['multiple'] !== false)
					{
						?>
		<div class="fieldWrapper horizontal">
			<p class="label"><?php echo $this->variables['label']; ?><?php
					if(isset($this->variables['required']) && count($this->variables['required']) != 0 && $this->variables['required'] != '' && $this->variables['required'] !== false)
					{
						?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr><?php } ?></p>
			<ul class="inputList">
			<?php
				if(isset(${'items'})) $this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['old'] = ${'items'};
				$this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['iteration'] = $this->variables['items'];
				$this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['i'] = 1;
				$this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['count'] = count($this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['iteration'] as ${'items'})
				{
					if(!isset(${'items'}['first']) && $this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['i'] == 1) ${'items'}['first'] = true;
					if(!isset(${'items'}['last']) && $this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['i'] == $this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['count']) ${'items'}['last'] = true;
					if(isset(${'items'}['formElements']) && is_array(${'items'}['formElements']))
					{
						foreach(${'items'}['formElements'] as $name => $object)
						{
							${'items'}[$name] = $object->parse();
							${'items'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<li><label for="<?php echo ${'items'}['id']; ?>"><?php echo ${'items'}['field']; ?> <?php echo ${'items'}['label']; ?></label></li>
			<?php
					$this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['old'])) ${'items'} = $this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']['old'];
				else unset($this->iterations['1fa855987207b10f99f7805abe3478e2_Field.tpl.php_1']);
				?>
			</ul>
		</div>
	<?php } ?>

	<p class="buttonHolderRight">
		<span class="dragAndDropHandle"></span>
		<a class="button icon iconOnly iconDelete deleteField" href="#delete-<?php echo $this->variables['id']; ?>" rel="<?php echo $this->variables['id']; ?>"><span><?php echo $this->variables['lblDelete']; ?></span></a>
		<a class="button icon iconOnly iconEdit editField" href="#edit-<?php echo $this->variables['id']; ?>" rel="<?php echo $this->variables['id']; ?>"><span><?php echo $this->variables['lblEdit']; ?></span></a>
	</p>
</div>