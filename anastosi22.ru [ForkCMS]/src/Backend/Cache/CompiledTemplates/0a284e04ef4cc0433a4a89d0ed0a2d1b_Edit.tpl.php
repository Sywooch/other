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
	<h2><?php echo SpoonFilter::ucfirst($this->variables['lblLocation']); ?>: <?php echo $this->variables['lblEdit']; ?></h2>
</div>

<?php
					if(isset($this->forms['edit']))
					{
						?><form accept-charset="UTF-8" action="<?php echo $this->forms['edit']->getAction(); ?>" method="<?php echo $this->forms['edit']->getMethod(); ?>"<?php echo $this->forms['edit']->getParametersHTML(); ?>>
						<?php echo $this->forms['edit']->getField('form')->parse();
						if($this->forms['edit']->getUseToken())
						{
							?><input type="hidden" name="form_token" id="<?php echo $this->forms['edit']->getField('form_token')->getAttribute('id'); ?>" value="<?php echo htmlspecialchars($this->forms['edit']->getField('form_token')->getValue()); ?>" />
						<?php } ?>
	<p>
		<label for="title"><?php echo SpoonFilter::ucfirst($this->variables['lblTitle']); ?></label>
		<?php echo $this->variables['txtTitle']; ?> <?php echo $this->variables['txtTitleError']; ?>
	</p>

	<div class="box horizontal">
		<div class="heading">
			<h3><?php echo SpoonFilter::ucfirst($this->variables['lblAddress']); ?></h3>
		</div>
		<div class="options">
			<p>
				<label for="street"><?php echo SpoonFilter::ucfirst($this->variables['lblStreet']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtStreet']; ?> <?php echo $this->variables['txtStreetError']; ?>
			</p>
			<p>
				<label for="number"><?php echo SpoonFilter::ucfirst($this->variables['lblNumber']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtNumber']; ?> <?php echo $this->variables['txtNumberError']; ?>
			</p>
			<p>
				<label for="zip"><?php echo SpoonFilter::ucfirst($this->variables['lblZip']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtZip']; ?> <?php echo $this->variables['txtZipError']; ?>
			</p>
			<p>
				<label for="city"><?php echo SpoonFilter::ucfirst($this->variables['lblCity']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['txtCity']; ?> <?php echo $this->variables['txtCityError']; ?>
			</p>
			<p>
				<label for="country"><?php echo SpoonFilter::ucfirst($this->variables['lblCountry']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
				<?php echo $this->variables['ddmCountry']; ?> <?php echo $this->variables['ddmCountryError']; ?>
			</p>
			<?php echo $this->variables['hidMapId']; ?> <?php echo $this->variables['hidRedirect']; ?>

		<div class="buttonHolderRight">
			<input id="editButton" class="inputButton button mainButton" type="submit" name="edit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblUpdateMap']); ?>" />
		</div>
		</div>
	</div>
</form>
				<?php } ?>

<table width="100%">
	<tr>
		<td id="leftColumn">
			<div class="box">
				<div class="heading">
					<h3><?php echo SpoonFilter::ucfirst($this->variables['lblMap']); ?></h3>
				</div>

				
				<div class="options">
					<div id="map" style="height: <?php echo $this->variables['settings']['height']; ?>px; width: <?php echo $this->variables['settings']['width']; ?>px;">
					</div>
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
					<p>
						<label for="fullUrl"><?php echo $this->variables['chkFullUrl']; ?> <?php echo $this->variables['msgShowMapUrl']; ?></label>
					</p>
				</div>

				
				<div class="options">
					<p>
						<label for="directions"><?php echo $this->variables['chkDirections']; ?> <?php echo $this->variables['msgShowDirections']; ?></label>
					</p>
				</div>

				
				<div class="options">
					<p>
						<label for="markerOverview"><?php echo $this->variables['chkMarkerOverview']; ?> <?php echo $this->variables['msgShowMarkerOverview']; ?></label>
					</p>
				</div>
			</div>
		</td>
		</form>
				<?php } ?>
	</tr>
</table>

<div class="fullwidthOptions">
	<?php
					if(isset($this->variables['showLocationDelete']) && count($this->variables['showLocationDelete']) != 0 && $this->variables['showLocationDelete'] != '' && $this->variables['showLocationDelete'] !== false)
					{
						?>
	<a href="<?php echo Backend\Core\Engine\TemplateModifiers::getURL($this->variables['var'], 'delete'); ?>&amp;id=<?php echo $this->variables['item']['id']; ?>" data-message-id="confirmDelete" class="askConfirmation button linkButton icon iconDelete">
		<span><?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?></span>
	</a>
	<div id="confirmDelete" title="<?php echo SpoonFilter::ucfirst($this->variables['lblDelete']); ?>?" style="display: none;">
		<p>
			<?php echo sprintf($this->variables['msgConfirmDelete'], $this->variables['item']['title']); ?>
		</p>
	</div>
	<?php } ?>

	<div class="buttonHolderRight">
		<a href="#" id="saveLiveData" class="button mainButton">
			<span><?php echo SpoonFilter::ucfirst($this->variables['lblSave']); ?></span>
		</a>
	</div>
</div>

<script type="text/javascript">
	var mapOptions =
	{
		zoom: '<?php echo $this->variables['settings']['zoom_level']; ?>' == 'auto' ? 0 : <?php echo $this->variables['settings']['zoom_level']; ?>,
		type: '<?php echo $this->variables['settings']['map_type']; ?>',
		center:
		{
			lat: <?php echo $this->variables['settings']['center']['lat']; ?>,
			lng: <?php echo $this->variables['settings']['center']['lng']; ?>
		}
	};
	var markers = [];
	<?php
					if(isset($this->variables['item']['lat']) && count($this->variables['item']['lat']) != 0 && $this->variables['item']['lat'] != '' && $this->variables['item']['lat'] !== false)
					{
						?>
		<?php
					if(isset($this->variables['item']['lng']) && count($this->variables['item']['lng']) != 0 && $this->variables['item']['lng'] != '' && $this->variables['item']['lng'] !== false)
					{
						?>
			markers.push(
			{
				lat: <?php echo $this->variables['item']['lat']; ?>,
				lng: <?php echo $this->variables['item']['lng']; ?>,
				title: '<?php echo $this->variables['item']['title']; ?>',
				text: '<p><?php echo $this->variables['item']['street']; ?> <?php echo $this->variables['item']['number']; ?></p><p><?php echo $this->variables['item']['zip']; ?> <?php echo $this->variables['item']['city']; ?></p>',
				dragable: true
			});
		<?php } ?>
	<?php } ?>
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
