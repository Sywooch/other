<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>


<?php
					if(isset($this->variables['widgetLocationItem']) && count($this->variables['widgetLocationItem']) != 0 && $this->variables['widgetLocationItem'] != '' && $this->variables['widgetLocationItem'] !== false)
					{
						?>
	

<div id="map<?php echo $this->variables['widgetLocationItem']['id']; ?>" class="parseMap" style="height: <?php echo $this->variables['widgetLocationSettings']['height']; ?>px; width: <?php echo $this->variables['widgetLocationSettings']['width']; ?>px;"></div>

	<?php
					if(isset($this->variables['widgetLocationSettings']['directions']) && count($this->variables['widgetLocationSettings']['directions']) != 0 && $this->variables['widgetLocationSettings']['directions'] != '' && $this->variables['widgetLocationSettings']['directions'] !== false)
					{
						?>
		<aside id="locationSearch<?php echo $this->variables['widgetLocationItem']['id']; ?>" class="locationSearch">
			<form method="get" action="#">
				<p>
					<label for="locationSearchAddress<?php echo $this->variables['widgetLocationItem']['id']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblStart']); ?><abbr title="<?php echo $this->variables['lblRequiredField']; ?>">*</abbr></label>
					<input type="text" id="locationSearchAddress<?php echo $this->variables['widgetLocationItem']['id']; ?>" name="locationSearchAddress" class="inputText" />
					<span id="locationSearchError<?php echo $this->variables['widgetLocationItem']['id']; ?>" class="formError inlineError" style="display: none;"><?php echo SpoonFilter::ucfirst($this->variables['errFieldIsRequired']); ?></span>
				</p>
				<p>
					<input type="submit" id="locationSearchRequest<?php echo $this->variables['widgetLocationItem']['id']; ?>" name="locationSearchRequest" class="inputSubmit" value="<?php echo SpoonFilter::ucfirst($this->variables['lblShowDirections']); ?>" />
				</p>
			</form>
		</aside>
	<?php } ?>

	<?php
					if(isset($this->variables['widgetLocationSettings']['full_url']) && count($this->variables['widgetLocationSettings']['full_url']) != 0 && $this->variables['widgetLocationSettings']['full_url'] != '' && $this->variables['widgetLocationSettings']['full_url'] !== false)
					{
						?>
		<p><a href="<?php echo $this->variables['widgetLocationSettings']['maps_url']; ?>" title="<?php echo $this->variables['lblViewLargeMap']; ?>"><?php echo SpoonFilter::ucfirst($this->variables['lblViewLargeMap']); ?></a></p>
	<?php } ?>

	<div id="markerText<?php echo $this->variables['widgetLocationItem']['id']; ?>" style="display: none;">
		<address><?php echo $this->variables['widgetLocationItem']['city']; ?><br />
			<?php echo $this->variables['widgetLocationItem']['street']; ?> <?php echo $this->variables['widgetLocationItem']['number']; ?><br />
			<?php echo $this->variables['widgetLocationItem']['zip']; ?> 
		</address>
        </div>
<?php } ?>