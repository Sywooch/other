<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				}
?>


<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblAnalytics']); ?></h2>
</div>

<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
	<div class="generalMessage infoMessage content">
		<p><strong><?php echo $this->variables['msgConfigurationError']; ?></strong></p>
		<ul class="pb0">
			<?php
				if(isset(${'warnings'})) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['old'] = ${'warnings'};
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['iteration'] = $this->variables['warnings'];
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['i'] = 1;
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['count'] = count($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['iteration'] as ${'warnings'})
				{
					if(!isset(${'warnings'}['first']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['i'] == 1) ${'warnings'}['first'] = true;
					if(!isset(${'warnings'}['last']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['i'] == $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['count']) ${'warnings'}['last'] = true;
					if(isset(${'warnings'}['formElements']) && is_array(${'warnings'}['formElements']))
					{
						foreach(${'warnings'}['formElements'] as $name => $object)
						{
							${'warnings'}[$name] = $object->parse();
							${'warnings'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<li><?php echo ${'warnings'}['message']; ?></li>
			<?php
					$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['old'])) ${'warnings'} = $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']['old'];
				else unset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_1']);
				?>
		</ul>
	</div>
<?php } ?>

<?php if(!isset($this->variables['warnings']) || count($this->variables['warnings']) == 0 || $this->variables['warnings'] == '' || $this->variables['warnings'] === false): ?>
	<?php if(!isset($this->variables['dataAvailable']) || count($this->variables['dataAvailable']) == 0 || $this->variables['dataAvailable'] == '' || $this->variables['dataAvailable'] === false): ?>
		<div class="generalMessage infoMessage content singleMessage">
			<p><strong><?php echo $this->variables['msgNoData']; ?></strong></p>
		</div>
	<?php endif; ?>

	<div class="box">
		<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_MODULE_PATH']; ?>/Layout/Templates/Period.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				}
?>

		<div class="options content">
			<div class="analyticsColWrapper clearfix">
				<div class="analyticsCol">
					<p><strong><?php echo $this->variables['pageviews']; ?> </strong><a href="<?php echo $this->variables['googlePageviewsURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblPageviews']); ?></a></p>
					<p><strong><?php echo $this->variables['visitors']; ?> </strong><a href="<?php echo $this->variables['googleVisitorsURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblVisitors']); ?></a></p>
				</div>
				<div class="analyticsCol">
					<p><strong><?php echo $this->variables['pagesPerVisit']; ?> </strong><a href="<?php echo $this->variables['googleAveragePageviewsURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblPagesPerVisit']); ?></a> <small>(<?php echo $this->variables['pagesPerVisitDifference']; ?>%)</small></p>
					<p><strong><?php echo $this->variables['timeOnSite']; ?> </strong><a href="<?php echo $this->variables['googleTimeOnSiteURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblAverageTimeOnSite']); ?></a> <small>(<?php echo $this->variables['timeOnSiteDifference']; ?>%)</small></p>
				</div>
				<div class="analyticsCol">
					<p><strong><?php echo $this->variables['newVisits']; ?>% </strong><a href="<?php echo $this->variables['googleVisitorTypesURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblNewVisitsPercentage']); ?></a> <small>(<?php echo $this->variables['newVisitsDifference']; ?>%)</small></p>
					<p><strong><?php echo $this->variables['bounces']; ?>% </strong><a href="<?php echo $this->variables['googleBouncesURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblBounceRate']); ?></a> <small>(<?php echo $this->variables['bouncesDifference']; ?>%)</small></p>
				</div>
			</div>
		</div>

		<div class="options content">
			<div class="analyticsGraphWrapper">
				<div class="analyticsLeftCol">
					<div class="box boxLevel2">
						<div class="heading">
							<h3><a href="<?php echo $this->variables['googleVisitorsURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblRecentVisits']); ?></a></h3>
							<div class="buttonHolderRight">
								<a class="button icon iconGoto linkButton" href="<?php echo $this->variables['googleVisitorsURL']; ?>"><span><?php echo SpoonFilter::ucfirst($this->variables['lblViewReport']); ?></span></a>
							</div>
						</div>
						<div class="options">
							<?php
					if(isset($this->variables['graphData']) && count($this->variables['graphData']) != 0 && $this->variables['graphData'] != '' && $this->variables['graphData'] !== false)
					{
						?>
								<div id="dataChartDoubleMetricPerDay" class="hidden">
									<span id="maxYAxis"><?php echo $this->variables['maxYAxis']; ?></span>
									<span id="tickInterval"><?php echo $this->variables['tickInterval']; ?></span>
									<span id="yAxisTitle"><?php echo SpoonFilter::ucfirst($this->variables['lblVisits']); ?></span>
									<ul class="series">
										<?php
				if(isset(${'graphData'})) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['old'] = ${'graphData'};
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['iteration'] = $this->variables['graphData'];
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['i'] = 1;
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['count'] = count($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['iteration'] as ${'graphData'})
				{
					if(!isset(${'graphData'}['first']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['i'] == 1) ${'graphData'}['first'] = true;
					if(!isset(${'graphData'}['last']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['i'] == $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['count']) ${'graphData'}['last'] = true;
					if(isset(${'graphData'}['formElements']) && is_array(${'graphData'}['formElements']))
					{
						foreach(${'graphData'}['formElements'] as $name => $object)
						{
							${'graphData'}[$name] = $object->parse();
							${'graphData'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
											<li class="serie" id="metric<?php echo ${'graphData'}['i']; ?>serie">
												<span class="name"><?php echo ${'graphData'}['label']; ?></span>
												<ul class="data">
													<?php
				if(isset(${'graphData'}['data'])) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['old'] = ${'graphData'}['data'];
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['iteration'] = ${'graphData'}['data'];
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['i'] = 1;
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['count'] = count($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['iteration']);
				foreach((array) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['iteration'] as ${'graphData'}['data'])
				{
					if(!isset(${'graphData'}['data']['first']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['i'] == 1) ${'graphData'}['data']['first'] = true;
					if(!isset(${'graphData'}['data']['last']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['i'] == $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['count']) ${'graphData'}['data']['last'] = true;
					if(isset(${'graphData'}['data']['formElements']) && is_array(${'graphData'}['data']['formElements']))
					{
						foreach(${'graphData'}['data']['formElements'] as $name => $object)
						{
							${'graphData'}['data'][$name] = $object->parse();
							${'graphData'}['data'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
														<li>
															<span class="fulldate"><?php echo ucwords(SpoonTemplateModifiers::date(${'graphData'}['data']['date'], 'D d M', $this->variables['INTERFACE_LANGUAGE'])); ?></span>
															<span class="date"><?php echo ucwords(SpoonTemplateModifiers::date(${'graphData'}['data']['date'], 'd M', $this->variables['INTERFACE_LANGUAGE'])); ?></span>
															<span class="value"><?php echo ${'graphData'}['data']['value']; ?></span>
														</li>
													<?php
					$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['i']++;
				}
				if(isset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['old'])) ${'graphData'}['data'] = $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']['old'];
				else unset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_4']['data']);
				?>
												</ul>
											</li>
										<?php
					$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['old'])) ${'graphData'} = $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']['old'];
				else unset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_2']);
				?>
									</ul>
								</div>
								<div id="chartDoubleMetricPerDay">&nbsp;</div>
							<?php } ?>
							<div class="buttonHolderRight">
								<a href="http://highcharts.com/" class="analyticsBacklink">Highcharts</a>
							</div>
						</div>
					</div>
				</div>

				<div class="analyticsRightCol">
					<div class="box boxLevel2">
						<div class="heading">
							<h3><a href="<?php echo $this->variables['googleTrafficSourcesURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblPageviewsByTrafficSources']); ?></a></h3>
							<div class="buttonHolderRight">
								<a class="button icon iconGoto linkButton" href="<?php echo $this->variables['googleTrafficSourcesURL']; ?>"><span><?php echo SpoonFilter::ucfirst($this->variables['lblViewReport']); ?></span></a>
							</div>
						</div>
						<div class="options">
							<?php
					if(isset($this->variables['pieGraphData']) && count($this->variables['pieGraphData']) != 0 && $this->variables['pieGraphData'] != '' && $this->variables['pieGraphData'] !== false)
					{
						?>
								<div id="dataChartPieChart" class="hidden">
									<ul class="data">
										<?php
				if(isset(${'pieGraphData'})) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['old'] = ${'pieGraphData'};
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['iteration'] = $this->variables['pieGraphData'];
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['i'] = 1;
				$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['count'] = count($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['iteration'] as ${'pieGraphData'})
				{
					if(!isset(${'pieGraphData'}['first']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['i'] == 1) ${'pieGraphData'}['first'] = true;
					if(!isset(${'pieGraphData'}['last']) && $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['i'] == $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['count']) ${'pieGraphData'}['last'] = true;
					if(isset(${'pieGraphData'}['formElements']) && is_array(${'pieGraphData'}['formElements']))
					{
						foreach(${'pieGraphData'}['formElements'] as $name => $object)
						{
							${'pieGraphData'}[$name] = $object->parse();
							${'pieGraphData'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
											<li><span class="label"><?php echo ${'pieGraphData'}['label']; ?></span><span class="value"><?php echo ${'pieGraphData'}['value']; ?></span><span class="percentage"><?php echo ${'pieGraphData'}['percentage']; ?></span></li>
										<?php
					$this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['i']++;
				}
				if(isset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['old'])) ${'pieGraphData'} = $this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']['old'];
				else unset($this->iterations['ce9dad64eebe5bf825e448cfa1a6bd29_Index.tpl.php_3']);
				?>
									</ul>
								</div>
								<div id="chartPieChart">&nbsp;</div>
							<?php } ?>
							<div class="buttonHolderRight">
								<a href="http://highcharts.com/" class="analyticsBacklink">Highcharts</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="dataGridHolder" id="analyticsDataGridLeftCol">
		<div class="tableHeading">
			<h3><a href="<?php echo $this->variables['googleTopReferrersURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblTopReferrers']); ?></a></h3>
			<div class="buttonHolderRight">
				<a class="button icon iconGoto linkButton" href="<?php echo $this->variables['googleTopReferrersURL']; ?>"><span><?php echo SpoonFilter::ucfirst($this->variables['lblViewReport']); ?></span></a>
			</div>
		</div>

		
		<?php
					if(isset($this->variables['dgReferrers']) && count($this->variables['dgReferrers']) != 0 && $this->variables['dgReferrers'] != '' && $this->variables['dgReferrers'] !== false)
					{
						?>
			<?php echo $this->variables['dgReferrers']; ?>
		<?php } ?>
		<?php if(!isset($this->variables['dgReferrers']) || count($this->variables['dgReferrers']) == 0 || $this->variables['dgReferrers'] == '' || $this->variables['dgReferrers'] === false): ?>
			<table class="dataGrid">
				<tr>
					<td><?php echo $this->variables['msgNoReferrers']; ?></td>
				</tr>
			</table>
		<?php endif; ?>
	</div>

	<div class="dataGridHolder" id="analyticsDataGridRightCol">
		<div class="tableHeading">
			<h3><a href="<?php echo $this->variables['googleTopKeywordsURL']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblTopKeywords']); ?></a></h3>
			<div class="buttonHolderRight">
				<a class="button icon iconGoto linkButton" href="<?php echo $this->variables['googleTopKeywordsURL']; ?>"><span><?php echo SpoonFilter::ucfirst($this->variables['lblViewReport']); ?></span></a>
			</div>
		</div>

		
		<?php
					if(isset($this->variables['dgKeywords']) && count($this->variables['dgKeywords']) != 0 && $this->variables['dgKeywords'] != '' && $this->variables['dgKeywords'] !== false)
					{
						?>
			<?php echo $this->variables['dgKeywords']; ?>
		<?php } ?>
		<?php if(!isset($this->variables['dgKeywords']) || count($this->variables['dgKeywords']) == 0 || $this->variables['dgKeywords'] == '' || $this->variables['dgKeywords'] === false): ?>
			<table class="dataGrid">
				<tr>
					<td><?php echo $this->variables['msgNoKeywords']; ?></td>
				</tr>
			</table>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Analytics/Layout/Templates');
				}
?>
