<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
					if(isset($this->variables['analyticsValidSettings']) && count($this->variables['analyticsValidSettings']) != 0 && $this->variables['analyticsValidSettings'] != '' && $this->variables['analyticsValidSettings'] !== false)
					{
						?>
<div class="box" id="widgetAnalyticsTrafficSources">
	<div class="heading">
		<h3>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); ?>">
				<?php echo SpoonFilter::ucfirst($this->variables['lblTrafficSources']); ?>
				<?php echo $this->variables['lblFrom']; ?>
				<span id="trafficSourcesDate"><?php echo $this->variables['analyticsTrafficSourcesDate']; ?></span>
			</a>
		</h3>
	</div>

	<div class="options">
		<div id="tabs" class="tabs">
			<ul>
				<li><a href="#tabAnalyticsReferrers"><?php echo SpoonFilter::ucfirst($this->variables['lblTopReferrers']); ?></a></li>
				<li><a href="#tabAnalyticsKeywords"><?php echo SpoonFilter::ucfirst($this->variables['lblTopKeywords']); ?></a></li>
			</ul>

			<div id="tabAnalyticsReferrers">
				
				<div class="dataGridHolder" id="dataGridReferrers">
					<?php
					if(isset($this->variables['dgAnalyticsReferrers']) && count($this->variables['dgAnalyticsReferrers']) != 0 && $this->variables['dgAnalyticsReferrers'] != '' && $this->variables['dgAnalyticsReferrers'] !== false)
					{
						?>
						<?php echo $this->variables['dgAnalyticsReferrers']; ?>
					<?php } ?>

					<?php if(!isset($this->variables['dgAnalyticsReferrers']) || count($this->variables['dgAnalyticsReferrers']) == 0 || $this->variables['dgAnalyticsReferrers'] == '' || $this->variables['dgAnalyticsReferrers'] === false): ?>
						<table class="dataGrid">
							<tr>
								<td><?php echo $this->variables['msgNoReferrers']; ?></td>
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
						<?php echo $this->variables['dgAnalyticsKeywords']; ?>
					<?php } ?>

					<?php if(!isset($this->variables['dgAnalyticsKeywords']) || count($this->variables['dgAnalyticsKeywords']) == 0 || $this->variables['dgAnalyticsKeywords'] == '' || $this->variables['dgAnalyticsKeywords'] === false): ?>
						<table class="dataGrid">
							<tr>
								<td><?php echo $this->variables['msgNoKeywords']; ?></td>
							</tr>
						</table>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); ?>" class="button"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAllStatistics']); ?></span></a>
			<a href="#refresh" id="refreshTrafficSources" class="submitButton button inputButton mainButton iconLink icon iconRefresh"><span></span></a>
			<?php
					if(isset($this->variables['settingsUrl']) && count($this->variables['settingsUrl']) != 0 && $this->variables['settingsUrl'] != '' && $this->variables['settingsUrl'] !== false)
					{
						?><div id="settingsUrl" class="hidden"><?php echo $this->variables['settingsUrl']; ?></div><?php } ?>
		</div>
	</div>
</div>
<?php } ?>