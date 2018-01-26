<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
?>

<div class="pageTitle">
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblLocation']); ?></h2>

	<?php
					if(isset($this->variables['showLocationAdd']) && count($this->variables['showLocationAdd']) != 0 && $this->variables['showLocationAdd'] != '' && $this->variables['showLocationAdd'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); ?>" class="button icon iconAdd" title="<?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?>">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblAdd']); ?></span>
		</a>
	</div>
	<?php } ?>
</div>

<?php
					if(isset($this->variables['dataGrid']) && count($this->variables['dataGrid']) != 0 && $this->variables['dataGrid'] != '' && $this->variables['dataGrid'] !== false)
					{
						?>
	<table width="100%">
		<tr>
			<td id="leftColumn">
				<div class="box">
					<div class="heading">
						<h3><?php echo SpoonFilter::ucfirst($this->variables['lblMap']); ?></h3>
					</div>

					
					<div class="options">
						<?php
					if(isset($this->variables['items']) && count($this->variables['items']) != 0 && $this->variables['items'] != '' && $this->variables['items'] !== false)
					{
						?>
							<div id="map" style="height: <?php echo $this->variables['settings']['height']; ?>px; width: <?php echo $this->variables['settings']['width']; ?>px;">
							</div>
						<?php } ?>
					</div>
				</div>
			</td>

			<?php
					if(isset($this->forms['settings']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['settings']->getAction(); ?>" method="<?php echo $this->forms['settings']->getMethod(); ?>"<?php echo $this->forms['settings']->getParametersHTML(); ?>>
						<?php echo $this->forms['settings']->getField('form')->parse();
						if($this->forms['settings']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['settings']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['settings']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
			<td id="rightColumn" style="width: 300px; padding-left: 10px;">
				<div class="box">
					<div class="heading">
						<h3><?php echo SpoonFilter::ucfirst($this->variables['lblSettings']); ?></h3>
					</div>

					
					<div class="options">
						<p>
							<label for="zoomLevel"><?php echo SpoonFilter::ucfirst($this->variables['lblZoomLevel']); ?></label>
							<?php echo $this->variables['ddmZoomLevel']; ?> <?php echo $this->variables['ddmZoomLevelError']; ?>
						</p>
					</div>

					
					<div class="options"<?php if(!isset($this->variables['godUser']) || count($this->variables['godUser']) == 0 || $this->variables['godUser'] == '' || $this->variables['godUser'] === false): ?> style="display:none;"<?php endif; ?>>
						<p>
							<label for="width"><?php echo SpoonFilter::ucfirst($this->variables['lblWidth']); ?></label>
							<?php echo $this->variables['txtWidth']; ?> <?php echo $this->variables['txtWidthError']; ?>
							<span class="helpTxt">
								<?php echo sprintf($this->variables['msgWidthHelp'], 300, 800); ?>
							</span>
						</p>
					</div>

					
					<div class="options"<?php if(!isset($this->variables['godUser']) || count($this->variables['godUser']) == 0 || $this->variables['godUser'] == '' || $this->variables['godUser'] === false): ?> style="display:none;"<?php endif; ?>>
						<p>
							<label for="height"><?php echo SpoonFilter::ucfirst($this->variables['lblHeight']); ?></label>
							<?php echo $this->variables['txtHeight']; ?> <?php echo $this->variables['txtHeightError']; ?>
							<span class="helpTxt">
								<?php echo sprintf($this->variables['msgHeightHelp'], 150); ?>
							</span>
						</p>
					</div>

					
					<div class="options">
						<p>
							<label for="mapType"><?php echo SpoonFilter::ucfirst($this->variables['lblMapType']); ?></label>
							<?php echo $this->variables['ddmMapType']; ?> <?php echo $this->variables['ddmMapTypeError']; ?>
						</p>
					</div>

					
					<div class="options">
						<div class="buttonHolderRight">
							<a href="#" id="saveLiveData" class="submitButton button inputButton button mainButton">
								<span><?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?></span>
							</a>
						</div>
					</div>
				</div>
			</td>
			</form>
				<?php } ?>
		</tr>
	</table>

	<div class="dataGridHolder">
		<?php echo $this->variables['dataGrid']; ?>
	</div>
<?php } ?>

<?php if(!isset($this->variables['dataGrid']) || count($this->variables['dataGrid']) == 0 || $this->variables['dataGrid'] == '' || $this->variables['dataGrid'] === false): ?><p><?php echo sprintf($this->variables['msgNoItems'], Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add')); ?></p><?php endif; ?>

<script type="text/javascript">
	var mapOptions = {
		zoom: '<?php echo $this->variables['settings']['zoom_level']; ?>' == 'auto' ? 0 : <?php echo $this->variables['settings']['zoom_level']; ?>,
		type: '<?php echo $this->variables['settings']['map_type']; ?>',
		center: {
			lat: <?php echo $this->variables['settings']['center']['lat']; ?>,
			lng: <?php echo $this->variables['settings']['center']['lng']; ?>
		}
	};
	var markers = [];
	<?php
				if(isset(${'items'})) $this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['old'] = ${'items'};
				$this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['iteration'] = $this->variables['items'];
				$this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['i'] = 1;
				$this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['count'] = count($this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['iteration'] as ${'items'})
				{
					if(!isset(${'items'}['first']) && $this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['i'] == 1) ${'items'}['first'] = true;
					if(!isset(${'items'}['last']) && $this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['i'] == $this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['count']) ${'items'}['last'] = true;
					if(isset(${'items'}['formElements']) && is_array(${'items'}['formElements']))
					{
						foreach(${'items'}['formElements'] as $name => $object)
						{
							${'items'}[$name] = $object->parse();
							${'items'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
		<?php
					if(isset(${'items'}['lat']) && count(${'items'}['lat']) != 0 && ${'items'}['lat'] != '' && ${'items'}['lat'] !== false)
					{
						?>
			<?php
					if(isset(${'items'}['lng']) && count(${'items'}['lng']) != 0 && ${'items'}['lng'] != '' && ${'items'}['lng'] !== false)
					{
						?>
				markers.push({
					lat: <?php echo ${'items'}['lat']; ?>,
					lng: <?php echo ${'items'}['lng']; ?>,
					title: '<?php echo ${'items'}['title']; ?>',
					text: '<p><?php echo ${'items'}['street']; ?> <?php echo ${'items'}['number']; ?></p><p><?php echo ${'items'}['zip']; ?> <?php echo ${'items'}['city']; ?></p>'
				});
			<?php } ?>
		<?php } ?>
	<?php
					$this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['old'])) ${'items'} = $this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']['old'];
				else unset($this->iterations['91ad206eef11bb5530068e3f0628bcfa_Index.tpl.php_1']);
				?>
</script>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
?>
