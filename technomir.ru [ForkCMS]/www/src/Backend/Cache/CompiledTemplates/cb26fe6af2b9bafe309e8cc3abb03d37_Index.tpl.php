<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureStartModule.tpl}<?php
				}
?>

<div class="pageTitle">
	<h2><?php if(array_key_exists('lblLocation', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblLocation']); } else { ?>{$lblLocation|ucfirst}<?php } ?></h2>

	<?php
					if(isset($this->variables['showLocationAdd']) && count($this->variables['showLocationAdd']) != 0 && $this->variables['showLocationAdd'] != '' && $this->variables['showLocationAdd'] !== false)
					{
						?>
	<div class="buttonHolderRight">
		<a href="<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); } else { ?>{$var|geturl:'add'}<?php } ?>" class="button icon iconAdd" title="<?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?>">
			<span><?php if(array_key_exists('lblAdd', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblAdd']); } else { ?>{$lblAdd|ucfirst}<?php } ?></span>
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
						<h3><?php if(array_key_exists('lblMap', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMap']); } else { ?>{$lblMap|ucfirst}<?php } ?></h3>
					</div>

					
					<div class="options">
						<?php
					if(isset($this->variables['items']) && count($this->variables['items']) != 0 && $this->variables['items'] != '' && $this->variables['items'] !== false)
					{
						?>
							<div id="map" style="height: <?php if(isset($this->variables['settings']) && array_key_exists('height', (array) $this->variables['settings'])) { echo $this->variables['settings']['height']; } else { ?>{$settings.height}<?php } ?>px; width: <?php if(isset($this->variables['settings']) && array_key_exists('width', (array) $this->variables['settings'])) { echo $this->variables['settings']['width']; } else { ?>{$settings.width}<?php } ?>px;">
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
						<h3><?php if(array_key_exists('lblSettings', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSettings']); } else { ?>{$lblSettings|ucfirst}<?php } ?></h3>
					</div>

					
					<div class="options">
						<p>
							<label for="zoomLevel"><?php if(array_key_exists('lblZoomLevel', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblZoomLevel']); } else { ?>{$lblZoomLevel|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('ddmZoomLevel', (array) $this->variables)) { echo $this->variables['ddmZoomLevel']; } else { ?>{$ddmZoomLevel}<?php } ?> <?php if(array_key_exists('ddmZoomLevelError', (array) $this->variables)) { echo $this->variables['ddmZoomLevelError']; } else { ?>{$ddmZoomLevelError}<?php } ?>
						</p>
					</div>

					
					<div class="options"<?php if(!isset($this->variables['godUser']) || count($this->variables['godUser']) == 0 || $this->variables['godUser'] == '' || $this->variables['godUser'] === false): ?> style="display:none;"<?php endif; ?>>
						<p>
							<label for="width"><?php if(array_key_exists('lblWidth', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblWidth']); } else { ?>{$lblWidth|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('txtWidth', (array) $this->variables)) { echo $this->variables['txtWidth']; } else { ?>{$txtWidth}<?php } ?> <?php if(array_key_exists('txtWidthError', (array) $this->variables)) { echo $this->variables['txtWidthError']; } else { ?>{$txtWidthError}<?php } ?>
							<span class="helpTxt">
								<?php if(array_key_exists('msgWidthHelp', (array) $this->variables)) { echo sprintf($this->variables['msgWidthHelp'], 300, 800); } else { ?>{$msgWidthHelp|sprintf:300:800}<?php } ?>
							</span>
						</p>
					</div>

					
					<div class="options"<?php if(!isset($this->variables['godUser']) || count($this->variables['godUser']) == 0 || $this->variables['godUser'] == '' || $this->variables['godUser'] === false): ?> style="display:none;"<?php endif; ?>>
						<p>
							<label for="height"><?php if(array_key_exists('lblHeight', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblHeight']); } else { ?>{$lblHeight|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('txtHeight', (array) $this->variables)) { echo $this->variables['txtHeight']; } else { ?>{$txtHeight}<?php } ?> <?php if(array_key_exists('txtHeightError', (array) $this->variables)) { echo $this->variables['txtHeightError']; } else { ?>{$txtHeightError}<?php } ?>
							<span class="helpTxt">
								<?php if(array_key_exists('msgHeightHelp', (array) $this->variables)) { echo sprintf($this->variables['msgHeightHelp'], 150); } else { ?>{$msgHeightHelp|sprintf:150}<?php } ?>
							</span>
						</p>
					</div>

					
					<div class="options">
						<p>
							<label for="mapType"><?php if(array_key_exists('lblMapType', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblMapType']); } else { ?>{$lblMapType|ucfirst}<?php } ?></label>
							<?php if(array_key_exists('ddmMapType', (array) $this->variables)) { echo $this->variables['ddmMapType']; } else { ?>{$ddmMapType}<?php } ?> <?php if(array_key_exists('ddmMapTypeError', (array) $this->variables)) { echo $this->variables['ddmMapTypeError']; } else { ?>{$ddmMapTypeError}<?php } ?>
						</p>
					</div>

					
					<div class="options">
						<div class="buttonHolderRight">
							<a href="#" id="saveLiveData" class="submitButton button inputButton button mainButton">
								<span><?php if(array_key_exists('lblSave', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblSave']); } else { ?>{$lblSave|ucfirst}<?php } ?></span>
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
		<?php if(array_key_exists('dataGrid', (array) $this->variables)) { echo $this->variables['dataGrid']; } else { ?>{$dataGrid}<?php } ?>
	</div>
<?php } ?>

<?php if(!isset($this->variables['dataGrid']) || count($this->variables['dataGrid']) == 0 || $this->variables['dataGrid'] == '' || $this->variables['dataGrid'] === false): ?><p><?php if(array_key_exists('msgNoItems', (array) $this->variables) && array_key_exists('var', (array) $this->variables)) { echo sprintf($this->variables['msgNoItems'], Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add')); } else { ?>{$msgNoItems|sprintf:<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'add'); } else { ?>{$var|geturl:'add'}<?php } ?>}<?php } ?></p><?php endif; ?>

<script type="text/javascript">
	var mapOptions = {
		zoom: '<?php if(isset($this->variables['settings']) && array_key_exists('zoom_level', (array) $this->variables['settings'])) { echo $this->variables['settings']['zoom_level']; } else { ?>{$settings.zoom_level}<?php } ?>' == 'auto' ? 0 : <?php if(isset($this->variables['settings']) && array_key_exists('zoom_level', (array) $this->variables['settings'])) { echo $this->variables['settings']['zoom_level']; } else { ?>{$settings.zoom_level}<?php } ?>,
		type: '<?php if(isset($this->variables['settings']) && array_key_exists('map_type', (array) $this->variables['settings'])) { echo $this->variables['settings']['map_type']; } else { ?>{$settings.map_type}<?php } ?>',
		center: {
			lat: <?php if(isset($this->variables['settings']['center']) && array_key_exists('lat', (array) $this->variables['settings']['center'])) { echo $this->variables['settings']['center']['lat']; } else { ?>{$settings.center.lat}<?php } ?>,
			lng: <?php if(isset($this->variables['settings']['center']) && array_key_exists('lng', (array) $this->variables['settings']['center'])) { echo $this->variables['settings']['center']['lng']; } else { ?>{$settings.center.lng}<?php } ?>
		}
	};
	var markers = [];
	<?php
					if(!isset($this->variables['items']))
					{
						?>{iteration:items}<?php
						$this->variables['items'] = array();
						$this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['fail'] = true;
					}
				if(isset(${'items'})) $this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['old'] = ${'items'};
				$this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['iteration'] = $this->variables['items'];
				$this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['i'] = 1;
				$this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['count'] = count($this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['iteration'] as ${'items'})
				{
					if(!isset(${'items'}['first']) && $this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['i'] == 1) ${'items'}['first'] = true;
					if(!isset(${'items'}['last']) && $this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['i'] == $this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['count']) ${'items'}['last'] = true;
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
					lat: <?php if(array_key_exists('lat', (array) ${'items'})) { echo ${'items'}['lat']; } else { ?>{$items->lat}<?php } ?>,
					lng: <?php if(array_key_exists('lng', (array) ${'items'})) { echo ${'items'}['lng']; } else { ?>{$items->lng}<?php } ?>,
					title: '<?php if(array_key_exists('title', (array) ${'items'})) { echo ${'items'}['title']; } else { ?>{$items->title}<?php } ?>',
					text: '<p><?php if(array_key_exists('street', (array) ${'items'})) { echo ${'items'}['street']; } else { ?>{$items->street}<?php } ?> <?php if(array_key_exists('number', (array) ${'items'})) { echo ${'items'}['number']; } else { ?>{$items->number}<?php } ?></p><p><?php if(array_key_exists('zip', (array) ${'items'})) { echo ${'items'}['zip']; } else { ?>{$items->zip}<?php } ?> <?php if(array_key_exists('city', (array) ${'items'})) { echo ${'items'}['city']; } else { ?>{$items->city}<?php } ?></p>'
				});
			<?php } ?>
		<?php } ?>
	<?php
					$this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['fail']) && $this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:items}<?php
					}
				if(isset($this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['old'])) ${'items'} = $this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']['old'];
				else unset($this->iterations['cb26fe6af2b9bafe309e8cc3abb03d37_Index.tpl.php_1']);
				?>
</script>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/StructureEndModule.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Location/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
