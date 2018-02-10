<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
					if(isset($this->variables['analyticsValidSettings']) && count($this->variables['analyticsValidSettings']) != 0 && $this->variables['analyticsValidSettings'] != '' && $this->variables['analyticsValidSettings'] !== false)
					{
						?>
<div class="box" id="widgetAnalyticsVisitors">
	<div class="heading">
		<h3>
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); } else { ?>{$var|geturl:'index':'analytics'}<?php } ?>">
				<?php if(array_key_exists('lblRecentVisits', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblRecentVisits']); } else { ?>{$lblRecentVisits|ucfirst}<?php } ?> <?php if(array_key_exists('lblFrom', (array) $this->variables)) { echo $this->variables['lblFrom']; } else { ?>{$lblFrom}<?php } ?>
				<?php if(array_key_exists('analyticsRecentVisitsStartDate', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['analyticsRecentVisitsStartDate'], 'j-m', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$analyticsRecentVisitsStartDate|date:'j-m':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?> <?php if(array_key_exists('lblTill', (array) $this->variables)) { echo $this->variables['lblTill']; } else { ?>{$lblTill}<?php } ?>
				<?php if(array_key_exists('analyticsRecentVisitsEndDate', (array) $this->variables) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonTemplateModifiers::date($this->variables['analyticsRecentVisitsEndDate'], 'j-m', $this->variables['INTERFACE_LANGUAGE']); } else { ?>{$analyticsRecentVisitsEndDate|date:'j-m':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>}<?php } ?>
			</a>
		</h3>
	</div>

	<div class="options content">
		<?php
					if(isset($this->variables['analyticsGraphData']) && count($this->variables['analyticsGraphData']) != 0 && $this->variables['analyticsGraphData'] != '' && $this->variables['analyticsGraphData'] !== false)
					{
						?>
			<div id="dataChartWidget" class="hidden">
				<span id="maxYAxis"><?php if(array_key_exists('analyticsMaxYAxis', (array) $this->variables)) { echo $this->variables['analyticsMaxYAxis']; } else { ?>{$analyticsMaxYAxis}<?php } ?></span>
				<span id="tickInterval"><?php if(array_key_exists('analyticsTickInterval', (array) $this->variables)) { echo $this->variables['analyticsTickInterval']; } else { ?>{$analyticsTickInterval}<?php } ?></span>
				<span id="yAxisTitle"><?php if(array_key_exists('lblPageviews', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPageviews']); } else { ?>{$lblPageviews|ucfirst}<?php } ?> / <?php if(array_key_exists('lblVisitors', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblVisitors']); } else { ?>{$lblVisitors|ucfirst}<?php } ?></span>
				<ul class="series">
					<?php
					if(!isset($this->variables['analyticsGraphData']))
					{
						?>{iteration:analyticsGraphData}<?php
						$this->variables['analyticsGraphData'] = array();
						$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['fail'] = true;
					}
				if(isset(${'analyticsGraphData'})) $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['old'] = ${'analyticsGraphData'};
				$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['iteration'] = $this->variables['analyticsGraphData'];
				$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['i'] = 1;
				$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['count'] = count($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['iteration'] as ${'analyticsGraphData'})
				{
					if(!isset(${'analyticsGraphData'}['first']) && $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['i'] == 1) ${'analyticsGraphData'}['first'] = true;
					if(!isset(${'analyticsGraphData'}['last']) && $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['i'] == $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['count']) ${'analyticsGraphData'}['last'] = true;
					if(isset(${'analyticsGraphData'}['formElements']) && is_array(${'analyticsGraphData'}['formElements']))
					{
						foreach(${'analyticsGraphData'}['formElements'] as $name => $object)
						{
							${'analyticsGraphData'}[$name] = $object->parse();
							${'analyticsGraphData'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
						<li class="serie" id="metric<?php if(array_key_exists('i', (array) ${'analyticsGraphData'})) { echo ${'analyticsGraphData'}['i']; } else { ?>{$analyticsGraphData->i}<?php } ?>serie">
							<span class="name"><?php if(array_key_exists('label', (array) ${'analyticsGraphData'})) { echo ${'analyticsGraphData'}['label']; } else { ?>{$analyticsGraphData->label}<?php } ?></span>
							<ul class="data">
								<?php
					if(!isset(${'analyticsGraphData'}['data']))
					{
						?>{iteration:analyticsGraphData->data}<?php
						${'analyticsGraphData'}['data'] = array();
						$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['fail'] = true;
					}
				if(isset(${'analyticsGraphData'}['data'])) $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['old'] = ${'analyticsGraphData'}['data'];
				$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['iteration'] = ${'analyticsGraphData'}['data'];
				$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['i'] = 1;
				$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['count'] = count($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['iteration']);
				foreach((array) $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['iteration'] as ${'analyticsGraphData'}['data'])
				{
					if(!isset(${'analyticsGraphData'}['data']['first']) && $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['i'] == 1) ${'analyticsGraphData'}['data']['first'] = true;
					if(!isset(${'analyticsGraphData'}['data']['last']) && $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['i'] == $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['count']) ${'analyticsGraphData'}['data']['last'] = true;
					if(isset(${'analyticsGraphData'}['data']['formElements']) && is_array(${'analyticsGraphData'}['data']['formElements']))
					{
						foreach(${'analyticsGraphData'}['data']['formElements'] as $name => $object)
						{
							${'analyticsGraphData'}['data'][$name] = $object->parse();
							${'analyticsGraphData'}['data'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
									<li>
										<span class="fulldate"><?php if(isset(${'analyticsGraphData'}['data']) && array_key_exists('date', (array) ${'analyticsGraphData'}['data']) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo ucwords(SpoonTemplateModifiers::date(${'analyticsGraphData'}['data']['date'], 'D d M', $this->variables['INTERFACE_LANGUAGE'])); } else { ?>{$analyticsGraphData->data.date|date:'D d M':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>|ucwords}<?php } ?></span>
										<span class="date"><?php if(isset(${'analyticsGraphData'}['data']) && array_key_exists('date', (array) ${'analyticsGraphData'}['data']) && array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo SpoonFilter::ucfirst(SpoonTemplateModifiers::date(${'analyticsGraphData'}['data']['date'], 'D', $this->variables['INTERFACE_LANGUAGE'])); } else { ?>{$analyticsGraphData->data.date|date:'D':<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>|ucfirst}<?php } ?></span>
										<span class="value"><?php if(isset(${'analyticsGraphData'}['data']) && array_key_exists('value', (array) ${'analyticsGraphData'}['data'])) { echo ${'analyticsGraphData'}['data']['value']; } else { ?>{$analyticsGraphData->data.value}<?php } ?></span>
									</li>
								<?php
					$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['i']++;
				}
					if(isset($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['fail']) && $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['fail'] == true)
					{
						?>{/iteration:analyticsGraphData->data}<?php
					}
				if(isset($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['old'])) ${'analyticsGraphData'}['data'] = $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']['old'];
				else unset($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_2']['data']);
				?>
							</ul>
						</li>
					<?php
					$this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['fail']) && $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:analyticsGraphData}<?php
					}
				if(isset($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['old'])) ${'analyticsGraphData'} = $this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']['old'];
				else unset($this->iterations['b61ee4f12797e6ac67d0d5fa4685d883_Visitors.tpl.php_1']);
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
				<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); } else { ?>{$var|geturl:'index':'analytics'}<?php } ?>" class="linkedImage">
					<img src="<?php if(array_key_exists('SITE_URL', (array) $this->variables)) { echo $this->variables['SITE_URL']; } else { ?>{$SITE_URL}<?php } ?>/src/Backend/Modules/Analytics/Layout/images/analytics_widget_<?php if(array_key_exists('INTERFACE_LANGUAGE', (array) $this->variables)) { echo $this->variables['INTERFACE_LANGUAGE']; } else { ?>{$INTERFACE_LANGUAGE}<?php } ?>.jpg" alt="" />
				</a>
			</p>
		<?php endif; ?>
	</div>

	<div class="footer">
		<div class="buttonHolderRight">
			<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'index', 'analytics'); } else { ?>{$var|geturl:'index':'analytics'}<?php } ?>" class="button"><span><?php if(array_key_exists('lblAllStatistics', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAllStatistics']); } else { ?>{$lblAllStatistics|ucfirst}<?php } ?></span></a>
		</div>
	</div>
</div>
<?php } ?>
