<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
					if(isset($this->variables['analyticsValidSettings']) && count($this->variables['analyticsValidSettings']) != 0 && $this->variables['analyticsValidSettings'] != '' && $this->variables['analyticsValidSettings'] !== false)
					{
						?>
<div class="box" id="widgetAnalyticsVisitors">
	<div class="heading">
		<h3>
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); ?>">
				<?php echo SpoonFilter::ucfirst($this->variables['lblRecentVisits']); ?> <?php echo $this->variables['lblFrom']; ?>
				<?php echo SpoonTemplateModifiers::date($this->variables['analyticsRecentVisitsStartDate'], 'j-m', $this->variables['INTERFACE_LANGUAGE']); ?> <?php echo $this->variables['lblTill']; ?>
				<?php echo SpoonTemplateModifiers::date($this->variables['analyticsRecentVisitsEndDate'], 'j-m', $this->variables['INTERFACE_LANGUAGE']); ?>
			</a>
		</h3>
	</div>

	<div class="options content">
		<?php
					if(isset($this->variables['analyticsGraphData']) && count($this->variables['analyticsGraphData']) != 0 && $this->variables['analyticsGraphData'] != '' && $this->variables['analyticsGraphData'] !== false)
					{
						?>
			<div id="dataChartWidget" class="hidden">
				<span id="maxYAxis"><?php echo $this->variables['analyticsMaxYAxis']; ?></span>
				<span id="tickInterval"><?php echo $this->variables['analyticsTickInterval']; ?></span>
				<span id="yAxisTitle"><?php echo SpoonFilter::ucfirst($this->variables['lblPageviews']); ?> / <?php echo SpoonFilter::ucfirst($this->variables['lblVisitors']); ?></span>
				<ul class="series">
					<?php
				if(isset(${'analyticsGraphData'})) $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['old'] = ${'analyticsGraphData'};
				$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['iteration'] = $this->variables['analyticsGraphData'];
				$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['i'] = 1;
				$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['count'] = count($this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['iteration'] as ${'analyticsGraphData'})
				{
					if(!isset(${'analyticsGraphData'}['first']) && $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['i'] == 1) ${'analyticsGraphData'}['first'] = true;
					if(!isset(${'analyticsGraphData'}['last']) && $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['i'] == $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['count']) ${'analyticsGraphData'}['last'] = true;
					if(isset(${'analyticsGraphData'}['formElements']) && is_array(${'analyticsGraphData'}['formElements']))
					{
						foreach(${'analyticsGraphData'}['formElements'] as $name => $object)
						{
							${'analyticsGraphData'}[$name] = $object->parse();
							${'analyticsGraphData'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<li class="serie" id="metric<?php echo ${'analyticsGraphData'}['i']; ?>serie">
							<span class="name"><?php echo ${'analyticsGraphData'}['label']; ?></span>
							<ul class="data">
								<?php
				if(isset(${'analyticsGraphData'}['data'])) $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['old'] = ${'analyticsGraphData'}['data'];
				$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['iteration'] = ${'analyticsGraphData'}['data'];
				$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['i'] = 1;
				$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['count'] = count($this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['iteration']);
				foreach((array) $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['iteration'] as ${'analyticsGraphData'}['data'])
				{
					if(!isset(${'analyticsGraphData'}['data']['first']) && $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['i'] == 1) ${'analyticsGraphData'}['data']['first'] = true;
					if(!isset(${'analyticsGraphData'}['data']['last']) && $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['i'] == $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['count']) ${'analyticsGraphData'}['data']['last'] = true;
					if(isset(${'analyticsGraphData'}['data']['formElements']) && is_array(${'analyticsGraphData'}['data']['formElements']))
					{
						foreach(${'analyticsGraphData'}['data']['formElements'] as $name => $object)
						{
							${'analyticsGraphData'}['data'][$name] = $object->parse();
							${'analyticsGraphData'}['data'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
									<li>
										<span class="fulldate"><?php echo ucwords(SpoonTemplateModifiers::date(${'analyticsGraphData'}['data']['date'], 'D d M', $this->variables['INTERFACE_LANGUAGE'])); ?></span>
										<span class="date"><?php echo SpoonFilter::ucfirst(SpoonTemplateModifiers::date(${'analyticsGraphData'}['data']['date'], 'D', $this->variables['INTERFACE_LANGUAGE'])); ?></span>
										<span class="value"><?php echo ${'analyticsGraphData'}['data']['value']; ?></span>
									</li>
								<?php
					$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['i']++;
				}
				if(isset($this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['old'])) ${'analyticsGraphData'}['data'] = $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']['old'];
				else unset($this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_2']['data']);
				?>
							</ul>
						</li>
					<?php
					$this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['old'])) ${'analyticsGraphData'} = $this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']['old'];
				else unset($this->iterations['fa950b8e8384e089a68d2aee2a4386fc_Visitors.tpl.php_1']);
				?>
				</ul>
			</div>
			<div id="chartWidget">&nbsp;</div>
			<p>
				<a href="http://highcharts.com/" class="analyticsBacklink">Highcharts</a>
			</p>
		<?php } ?>

		<?php if(!isset($this->variables['analyticsGraphData']) || count($this->variables['analyticsGraphData']) == 0 || $this->variables['analyticsGraphData'] == '' || $this->variables['analyticsGraphData'] === false): ?>
			<p class="analyticsFallback">
				<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); ?>" class="linkedImage">
					<img src="<?php echo $this->variables['SITE_URL']; ?>/src/Backend/Modules/Analytics/Layout/images/analytics_widget_<?php echo $this->variables['INTERFACE_LANGUAGE']; ?>.jpg" alt="" />
				</a>
			</p>
		<?php endif; ?>
	</div>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); ?>" class="button"><span><?php echo SpoonFilter::ucfirst($this->variables['lblAllStatistics']); ?></span></a>
		</div>
	</div>
</div>
<?php } ?>
