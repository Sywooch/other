<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
					if(isset($this->variables['analyticsValidSettings']) && count($this->variables['analyticsValidSettings']) != 0 && $this->variables['analyticsValidSettings'] != '' && $this->variables['analyticsValidSettings'] !== false)
					{
						?>
<div class="box" id="widgetAnalyticsTrafficSources">
	<div class="heading">
		<h3>
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); } else { ?>{$var|geturl:'index':'analytics'}<?php } ?>">
				<?php if(array_key_exists('lblTrafficSources', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTrafficSources']); } else { ?>{$lblTrafficSources|ucfirst}<?php } ?>
				<?php if(array_key_exists('lblFrom', (array) $this->variables)) { echo $this->variables['lblFrom']; } else { ?>{$lblFrom}<?php } ?>
				<span id="trafficSourcesDate"><?php if(array_key_exists('analyticsTrafficSourcesDate', (array) $this->variables)) { echo $this->variables['analyticsTrafficSourcesDate']; } else { ?>{$analyticsTrafficSourcesDate}<?php } ?></span>
			</a>
		</h3>
	</div>

	<div class="options">
		<div id="tabs" class="tabs">
			<ul>
				<li><a href="#tabAnalyticsReferrers"><?php if(array_key_exists('lblTopReferrers', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTopReferrers']); } else { ?>{$lblTopReferrers|ucfirst}<?php } ?></a></li>
				<li><a href="#tabAnalyticsKeywords"><?php if(array_key_exists('lblTopKeywords', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblTopKeywords']); } else { ?>{$lblTopKeywords|ucfirst}<?php } ?></a></li>
			</ul>

			<div id="tabAnalyticsReferrers">
				
				<div class="dataGridHolder" id="dataGridReferrers">
					<?php
					if(isset($this->variables['dgAnalyticsReferrers']) && count($this->variables['dgAnalyticsReferrers']) != 0 && $this->variables['dgAnalyticsReferrers'] != '' && $this->variables['dgAnalyticsReferrers'] !== false)
					{
						?>
						<?php if(array_key_exists('dgAnalyticsReferrers', (array) $this->variables)) { echo $this->variables['dgAnalyticsReferrers']; } else { ?>{$dgAnalyticsReferrers}<?php } ?>
					<?php } ?>

					<?php if(!isset($this->variables['dgAnalyticsReferrers']) || count($this->variables['dgAnalyticsReferrers']) == 0 || $this->variables['dgAnalyticsReferrers'] == '' || $this->variables['dgAnalyticsReferrers'] === false): ?>
						<table class="dataGrid">
							<tr>
								<td><?php if(array_key_exists('msgNoReferrers', (array) $this->variables)) { echo $this->variables['msgNoReferrers']; } else { ?>{$msgNoReferrers}<?php } ?></td>
							</tr>
						</table>
					<?php endif; ?>
				</div>
			</div>

			<div id="tabAnalyticsKeywords">
				
				<div class="dataGridHolder" id="dataGridKeywords">
					<?php
					if(isset($this->variables['dgAnalyticsKeywords']) && count($this->variables['dgAnalyticsKeywords']) != 0 && $this->variables['dgAnalyticsKeywords'] != '' && $this->variables['dgAnalyticsKeywords'] !== false)
					{
						?>
						<?php if(array_key_exists('dgAnalyticsKeywords', (array) $this->variables)) { echo $this->variables['dgAnalyticsKeywords']; } else { ?>{$dgAnalyticsKeywords}<?php } ?>
					<?php } ?>

					<?php if(!isset($this->variables['dgAnalyticsKeywords']) || count($this->variables['dgAnalyticsKeywords']) == 0 || $this->variables['dgAnalyticsKeywords'] == '' || $this->variables['dgAnalyticsKeywords'] === false): ?>
						<table class="dataGrid">
							<tr>
								<td><?php if(array_key_exists('msgNoKeywords', (array) $this->variables)) { echo $this->variables['msgNoKeywords']; } else { ?>{$msgNoKeywords}<?php } ?></td>
							</tr>
						</table>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); } else { ?>{$var|geturl:'index':'analytics'}<?php } ?>" class="button"><span><?php if(array_key_exists('lblAllStatistics', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAllStatistics']); } else { ?>{$lblAllStatistics|ucfirst}<?php } ?></span></a>
			<a href="#refresh" id="refreshTrafficSources" class="submitButton button inputButton mainButton iconLink icon iconRefresh"><span></span></a>
			<?php
					if(isset($this->variables['settingsUrl']) && count($this->variables['settingsUrl']) != 0 && $this->variables['settingsUrl'] != '' && $this->variables['settingsUrl'] !== false)
					{
						?><div id="settingsUrl" class="hidden"><?php if(array_key_exists('settingsUrl', (array) $this->variables)) { echo $this->variables['settingsUrl']; } else { ?>{$settingsUrl}<?php } ?></div><?php } ?>
		</div>
	</div>
</div>
<?php } ?>