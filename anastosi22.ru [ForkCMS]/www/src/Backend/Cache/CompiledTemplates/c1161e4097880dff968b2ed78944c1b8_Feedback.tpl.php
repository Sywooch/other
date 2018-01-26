<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div class="box" id="widgetFaqFeedback">
	<div class="heading">
		<h3><a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'faq'); ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblFaq']); ?>: <?php echo SpoonFilter::ucfirst($this->variables['lblFeedback']); ?></a></h3>
	</div>

	<?php
					if(isset($this->variables['faqFeedback']) && count($this->variables['faqFeedback']) != 0 && $this->variables['faqFeedback'] != '' && $this->variables['faqFeedback'] !== false)
					{
						?>
		<div class="dataGridHolder">
			<table class="dataGrid">
				<tbody>
					<?php
				if(isset(${'faqFeedback'})) $this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['old'] = ${'faqFeedback'};
				$this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['iteration'] = $this->variables['faqFeedback'];
				$this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['i'] = 1;
				$this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['count'] = count($this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['iteration'] as ${'faqFeedback'})
				{
					if(!isset(${'faqFeedback'}['first']) && $this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['i'] == 1) ${'faqFeedback'}['first'] = true;
					if(!isset(${'faqFeedback'}['last']) && $this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['i'] == $this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['count']) ${'faqFeedback'}['last'] = true;
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
					echo $this->cycle($this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['i'], $arguments);
					?>
">
						<td><a href="<?php echo ${'faqFeedback'}['full_url']; ?>"><?php echo Backend\Core\Engine\TemplateModifiers::truncate(${'faqFeedback'}['text'], 150); ?></a></td>
					</tr>
					<?php
					$this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['old'])) ${'faqFeedback'} = $this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']['old'];
				else unset($this->iterations['c1161e4097880dff968b2ed78944c1b8_Feedback.tpl.php_1']);
				?>
				</tbody>
			</table>
		</div>
	<?php } ?>

	<?php if(!isset($this->variables['faqFeedback']) || count($this->variables['faqFeedback']) == 0 || $this->variables['faqFeedback'] == '' || $this->variables['faqFeedback'] === false): ?>
		<div class="options content">
			<p><?php echo $this->variables['msgNoFeedback']; ?></p>
		</div>
	<?php endif; ?>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'faq'); ?>" class="button"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAllQuestions']); ?></span></a>
		</div>
	</div>
</div>