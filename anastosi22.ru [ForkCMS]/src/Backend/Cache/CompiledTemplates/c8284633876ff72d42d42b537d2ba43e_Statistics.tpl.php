<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<div class="box" id="widgetMailmotorClassic">
	<div class="heading">
		<h3>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'mailmotor'); ?>">
				<?php echo SpoonFilter::ucfirst($this->variables['lblMailmotor']); ?>
			</a>
		</h3>
	</div>

	<div class="options">
		<div id="tabs" class="tabs">
			<ul>
				<li><a href="#tabMailmotorSubscriptions"><?php echo SpoonFilter::ucfirst($this->variables['lblSubscriptions']); ?></a></li>
				<li><a href="#tabMailmotorUnsubscriptions"><?php echo SpoonFilter::ucfirst($this->variables['lblUnsubscriptions']); ?></a></li>
				<li><a href="#tabMailmotorStatistics"><?php echo SpoonFilter::ucfirst($this->variables['lblStatistics']); ?></a></li>
			</ul>

			<div id="tabMailmotorSubscriptions">
				
				<div id="dataGridSubscriptions">
					<?php
					if(isset($this->variables['dgMailmotorSubscriptions']) && count($this->variables['dgMailmotorSubscriptions']) != 0 && $this->variables['dgMailmotorSubscriptions'] != '' && $this->variables['dgMailmotorSubscriptions'] !== false)
					{
						?>
					<div class="dataGridHolder">
						<?php echo $this->variables['dgMailmotorSubscriptions']; ?>
					</div>
					<?php } ?>
					<?php if(!isset($this->variables['dgMailmotorSubscriptions']) || count($this->variables['dgMailmotorSubscriptions']) == 0 || $this->variables['dgMailmotorSubscriptions'] == '' || $this->variables['dgMailmotorSubscriptions'] === false): ?>
					<p>
						<?php echo SpoonFilter::ucfirst($this->variables['msgNoSubscriptions']); ?>
					</p>
					<?php endif; ?>
				</div>
			</div>

			<div id="tabMailmotorUnsubscriptions">
				
				<div id="dataGridUnsubscriptions">
					<?php
					if(isset($this->variables['dgMailmotorUnsubscriptions']) && count($this->variables['dgMailmotorUnsubscriptions']) != 0 && $this->variables['dgMailmotorUnsubscriptions'] != '' && $this->variables['dgMailmotorUnsubscriptions'] !== false)
					{
						?>
					<div class="dataGridHolder" >
						<?php echo $this->variables['dgMailmotorUnsubscriptions']; ?>
					</div>
					<?php } ?>
					<?php if(!isset($this->variables['dgMailmotorUnsubscriptions']) || count($this->variables['dgMailmotorUnsubscriptions']) == 0 || $this->variables['dgMailmotorUnsubscriptions'] == '' || $this->variables['dgMailmotorUnsubscriptions'] === false): ?>
					<p>
						<?php echo SpoonFilter::ucfirst($this->variables['msgNoUnsubscriptions']); ?>
					</p>
					<?php endif; ?>
				</div>
			</div>

			<div id="tabMailmotorStatistics">
				
				<div id="dataGridStatistics">
					<?php
					if(isset($this->variables['dgMailmotorStatistics']) && count($this->variables['dgMailmotorStatistics']) != 0 && $this->variables['dgMailmotorStatistics'] != '' && $this->variables['dgMailmotorStatistics'] !== false)
					{
						?>
					<div class="dataGridHolder">
						<?php echo $this->variables['dgMailmotorStatistics']; ?>
					</div>
					<?php } ?>

					<?php if(!isset($this->variables['dgMailmotorStatistics']) || count($this->variables['dgMailmotorStatistics']) == 0 || $this->variables['dgMailmotorStatistics'] == '' || $this->variables['dgMailmotorStatistics'] === false): ?>
					<p>
						<?php echo SpoonFilter::ucfirst($this->variables['msgNoSentMailings']); ?>
					</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'addresses', 'mailmotor'); ?>" class="button"><span><?php echo SpoonFilter::ucfirst($this->variables['msgAllAddresses']); ?></span></a>
		</div>
	</div>
</div>