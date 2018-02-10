<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div class="box" id="widgetFaqFeedback">
	<div class="heading">
		<h3><a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'faq'); } else { ?>{$var|geturl:'index':'faq'}<?php } ?>"><?php if(array_key_exists('lblFaq', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFaq']); } else { ?>{$lblFaq|ucfirst}<?php } ?>: <?php if(array_key_exists('lblFeedback', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblFeedback']); } else { ?>{$lblFeedback|ucfirst}<?php } ?></a></h3>
	</div>

	<?php
					if(isset($this->variables['faqFeedback']) && count($this->variables['faqFeedback']) != 0 && $this->variables['faqFeedback'] != '' && $this->variables['faqFeedback'] !== false)
					{
						?>
		<div class="dataGridHolder">
			<table class="dataGrid">
				<tbody>
					<?php
					if(!isset($this->variables['faqFeedback']))
					{
						?>{iteration:faqFeedback}<?php
						$this->variables['faqFeedback'] = array();
						$this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['fail'] = true;
					}
				if(isset(${'faqFeedback'})) $this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['old'] = ${'faqFeedback'};
				$this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['iteration'] = $this->variables['faqFeedback'];
				$this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['i'] = 1;
				$this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['count'] = count($this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['iteration'] as ${'faqFeedback'})
				{
					if(!isset(${'faqFeedback'}['first']) && $this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['i'] == 1) ${'faqFeedback'}['first'] = true;
					if(!isset(${'faqFeedback'}['last']) && $this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['i'] == $this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['count']) ${'faqFeedback'}['last'] = true;
					if(isset(${'faqFeedback'}['formElements']) && is_array(${'faqFeedback'}['formElements']))
					{
						foreach(${'faqFeedback'}['formElements'] as $name => $object)
						{
							${'faqFeedback'}[$name] = $object->parse();
							${'faqFeedback'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
					<tr class="<?php
					$arguments = array();
						ob_start();
						?>odd<?php
						$arguments[] = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
						ob_start();
						?>even<?php
						$arguments[] = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
					echo $this->cycle($this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['i'], $arguments);
					?>
">
						<td><a href="<?php if(array_key_exists('full_url', (array) ${'faqFeedback'})) { echo ${'faqFeedback'}['full_url']; } else { ?>{$faqFeedback->full_url}<?php } ?>"><?php if(array_key_exists('text', (array) ${'faqFeedback'})) { echo Backend\Core\Engine\TemplateModifiers::truncate(${'faqFeedback'}['text'], 150); } else { ?>{$faqFeedback->text|truncate:150}<?php } ?></a></td>
					</tr>
					<?php
					$this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['fail']) && $this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:faqFeedback}<?php
					}
				if(isset($this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['old'])) ${'faqFeedback'} = $this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']['old'];
				else unset($this->iterations['1683b1873a744b48d51d15e180136016_Feedback.tpl.php_1']);
				?>
				</tbody>
			</table>
		</div>
	<?php } ?>

	<?php if(!isset($this->variables['faqFeedback']) || count($this->variables['faqFeedback']) == 0 || $this->variables['faqFeedback'] == '' || $this->variables['faqFeedback'] === false): ?>
		<div class="options content">
			<p><?php if(array_key_exists('msgNoFeedback', (array) $this->variables)) { echo $this->variables['msgNoFeedback']; } else { ?>{$msgNoFeedback}<?php } ?></p>
		</div>
	<?php endif; ?>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'faq'); } else { ?>{$var|geturl:'index':'faq'}<?php } ?>" class="button"><span><?php if(array_key_exists('lblAllQuestions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAllQuestions']); } else { ?>{$lblAllQuestions|ucfirst}<?php } ?></span></a>
		</div>
	</div>
</div>