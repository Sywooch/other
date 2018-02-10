<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<div class="box" id="widgetMailmotorClassic">
	<div class="heading">
		<h3>
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'mailmotor'); } else { ?>{$var|geturl:'index':'mailmotor'}<?php } ?>">
				<?php if(array_key_exists('lblMailmotor', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMailmotor']); } else { ?>{$lblMailmotor|ucfirst}<?php } ?>
			</a>
		</h3>
	</div>

	<div class="options">
		<div id="tabs" class="tabs">
			<ul>
				<li><a href="#tabMailmotorSubscriptions"><?php if(array_key_exists('lblSubscriptions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSubscriptions']); } else { ?>{$lblSubscriptions|ucfirst}<?php } ?></a></li>
				<li><a href="#tabMailmotorUnsubscriptions"><?php if(array_key_exists('lblUnsubscriptions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblUnsubscriptions']); } else { ?>{$lblUnsubscriptions|ucfirst}<?php } ?></a></li>
				<li><a href="#tabMailmotorStatistics"><?php if(array_key_exists('lblStatistics', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblStatistics']); } else { ?>{$lblStatistics|ucfirst}<?php } ?></a></li>
			</ul>

			<div id="tabMailmotorSubscriptions">
				
				<div id="dataGridSubscriptions">
					<?php
					if(isset($this->variables['dgMailmotorSubscriptions']) && count($this->variables['dgMailmotorSubscriptions']) != 0 && $this->variables['dgMailmotorSubscriptions'] != '' && $this->variables['dgMailmotorSubscriptions'] !== false)
					{
						?>
					<div class="dataGridHolder">
						<?php if(array_key_exists('dgMailmotorSubscriptions', (array) $this->variables)) { echo $this->variables['dgMailmotorSubscriptions']; } else { ?>{$dgMailmotorSubscriptions}<?php } ?>
					</div>
					<?php } ?>
					<?php if(!isset($this->variables['dgMailmotorSubscriptions']) || count($this->variables['dgMailmotorSubscriptions']) == 0 || $this->variables['dgMailmotorSubscriptions'] == '' || $this->variables['dgMailmotorSubscriptions'] === false): ?>
					<p>
						<?php if(array_key_exists('msgNoSubscriptions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgNoSubscriptions']); } else { ?>{$msgNoSubscriptions|ucfirst}<?php } ?>
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
						<?php if(array_key_exists('dgMailmotorUnsubscriptions', (array) $this->variables)) { echo $this->variables['dgMailmotorUnsubscriptions']; } else { ?>{$dgMailmotorUnsubscriptions}<?php } ?>
					</div>
					<?php } ?>
					<?php if(!isset($this->variables['dgMailmotorUnsubscriptions']) || count($this->variables['dgMailmotorUnsubscriptions']) == 0 || $this->variables['dgMailmotorUnsubscriptions'] == '' || $this->variables['dgMailmotorUnsubscriptions'] === false): ?>
					<p>
						<?php if(array_key_exists('msgNoUnsubscriptions', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgNoUnsubscriptions']); } else { ?>{$msgNoUnsubscriptions|ucfirst}<?php } ?>
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
						<?php if(array_key_exists('dgMailmotorStatistics', (array) $this->variables)) { echo $this->variables['dgMailmotorStatistics']; } else { ?>{$dgMailmotorStatistics}<?php } ?>
					</div>
					<?php } ?>

					<?php if(!isset($this->variables['dgMailmotorStatistics']) || count($this->variables['dgMailmotorStatistics']) == 0 || $this->variables['dgMailmotorStatistics'] == '' || $this->variables['dgMailmotorStatistics'] === false): ?>
					<p>
						<?php if(array_key_exists('msgNoSentMailings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgNoSentMailings']); } else { ?>{$msgNoSentMailings|ucfirst}<?php } ?>
					</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'addresses', 'mailmotor'); } else { ?>{$var|geturl:'addresses':'mailmotor'}<?php } ?>" class="button"><span><?php if(array_key_exists('msgAllAddresses', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['msgAllAddresses']); } else { ?>{$msgAllAddresses|ucfirst}<?php } ?></span></a>
		</div>
	</div>
</div>