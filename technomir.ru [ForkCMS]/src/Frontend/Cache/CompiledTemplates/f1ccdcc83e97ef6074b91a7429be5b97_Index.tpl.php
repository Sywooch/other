<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<?php if(!isset($this->variables['faqCategories']) || count($this->variables['faqCategories']) == 0 || $this->variables['faqCategories'] == '' || $this->variables['faqCategories'] === false): ?>
	<section id="faqIndex">
		<p><?php if(array_key_exists('msgFaqNoItems', (array) $this->variables)) { echo $this->variables['msgFaqNoItems']; } else { ?>{$msgFaqNoItems}<?php } ?></p>
	</section>
<?php endif; ?>

<?php
					if(isset($this->variables['faqCategories']) && count($this->variables['faqCategories']) != 0 && $this->variables['faqCategories'] != '' && $this->variables['faqCategories'] !== false)
					{
						?>
	<section id="faqIndex">
		<div class="panel-group" id="accordion">
			<?php
					if(!isset($this->variables['faqCategories']))
					{
						?>{iteration:faqCategories}<?php
						$this->variables['faqCategories'] = array();
						$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['fail'] = true;
					}
				if(isset(${'faqCategories'})) $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['old'] = ${'faqCategories'};
				$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['iteration'] = $this->variables['faqCategories'];
				$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['i'] = 1;
				$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['count'] = count($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['iteration'] as ${'faqCategories'})
				{
					if(!isset(${'faqCategories'}['first']) && $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['i'] == 1) ${'faqCategories'}['first'] = true;
					if(!isset(${'faqCategories'}['last']) && $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['i'] == $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['count']) ${'faqCategories'}['last'] = true;
					if(isset(${'faqCategories'}['formElements']) && is_array(${'faqCategories'}['formElements']))
					{
						foreach(${'faqCategories'}['formElements'] as $name => $object)
						{
							${'faqCategories'}[$name] = $object->parse();
							${'faqCategories'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<?php
					if(isset($this->variables['allowMultipleCategories']) && count($this->variables['allowMultipleCategories']) != 0 && $this->variables['allowMultipleCategories'] != '' && $this->variables['allowMultipleCategories'] !== false)
					{
						?>
				<header>
					<h3 id="<?php if(array_key_exists('url', (array) ${'faqCategories'})) { echo ${'faqCategories'}['url']; } else { ?>{$faqCategories->url}<?php } ?>"><?php if(array_key_exists('title', (array) ${'faqCategories'})) { echo ${'faqCategories'}['title']; } else { ?>{$faqCategories->title}<?php } ?></h3>
				</header>
				<?php } ?>

				<?php
					if(!isset(${'faqCategories'}['questions']))
					{
						?>{iteration:faqCategories->questions}<?php
						${'faqCategories'}['questions'] = array();
						$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['fail'] = true;
					}
				if(isset(${'faqCategories'}['questions'])) $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['old'] = ${'faqCategories'}['questions'];
				$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['iteration'] = ${'faqCategories'}['questions'];
				$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['i'] = 1;
				$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['count'] = count($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['iteration']);
				foreach((array) $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['iteration'] as ${'faqCategories'}['questions'])
				{
					if(!isset(${'faqCategories'}['questions']['first']) && $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['i'] == 1) ${'faqCategories'}['questions']['first'] = true;
					if(!isset(${'faqCategories'}['questions']['last']) && $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['i'] == $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['count']) ${'faqCategories'}['questions']['last'] = true;
					if(isset(${'faqCategories'}['questions']['formElements']) && is_array(${'faqCategories'}['questions']['formElements']))
					{
						foreach(${'faqCategories'}['questions']['formElements'] as $name => $object)
						{
							${'faqCategories'}['questions'][$name] = $object->parse();
							${'faqCategories'}['questions'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php if(isset(${'faqCategories'}['questions']) && array_key_exists('id', (array) ${'faqCategories'}['questions'])) { echo ${'faqCategories'}['questions']['id']; } else { ?>{$faqCategories->questions.id}<?php } ?>"><?php if(isset(${'faqCategories'}['questions']) && array_key_exists('question', (array) ${'faqCategories'}['questions'])) { echo ${'faqCategories'}['questions']['question']; } else { ?>{$faqCategories->questions.question}<?php } ?></a>
						</h4>
					</div>
					<div id="collapse<?php if(isset(${'faqCategories'}['questions']) && array_key_exists('id', (array) ${'faqCategories'}['questions'])) { echo ${'faqCategories'}['questions']['id']; } else { ?>{$faqCategories->questions.id}<?php } ?>" class="panel-collapse collapse">
						<div class="panel-body">
							<?php if(isset(${'faqCategories'}['questions']) && array_key_exists('answer', (array) ${'faqCategories'}['questions'])) { echo ${'faqCategories'}['questions']['answer']; } else { ?>{$faqCategories->questions.answer}<?php } ?>
						</div>
					</div>
				</div>
				<?php
					$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['i']++;
				}
					if(isset($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['fail']) && $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['fail'] == true)
					{
						?>{/iteration:faqCategories->questions}<?php
					}
				if(isset($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['old'])) ${'faqCategories'}['questions'] = $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']['old'];
				else unset($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_2']['questions']);
				?>
			<?php
					$this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['fail']) && $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:faqCategories}<?php
					}
				if(isset($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['old'])) ${'faqCategories'} = $this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']['old'];
				else unset($this->iterations['f1ccdcc83e97ef6074b91a7429be5b97_Index.tpl.php_1']);
				?>
		</div>
	</section>
<?php } ?>