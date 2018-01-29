<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php if (!empty($events)) { ?>
<?php $locations = count($events); ?>
<script type="text/javascript">
	var map_module<?php echo $module->id; ?>;
	var geocoder_module<?php echo $module->id; ?>;
	function module_initialize<?php echo $module->id; ?>() {
		geocoder_module<?php echo $module->id; ?> = new google.maps.Geocoder();
		var module_mapDiv = document.getElementById('rs_canvas<?php echo $module->id; ?>');
		map_module<?php echo $module->id; ?> = new google.maps.Map(module_mapDiv, {
		  center: new google.maps.LatLng(<?php echo rseventsproHelper::getConfig('google_maps_center'); ?>),
		  zoom: <?php echo rseventsproHelper::getConfig('google_map_zoom','int'); ?>,
		  mapTypeId: google.maps.MapTypeId.ROADMAP,
		  scrollwheel: false
		});
		
		var latlngbounds = new google.maps.LatLngBounds();
		
		<?php foreach ($events as $location => $events) { ?>
		<?php if (empty($events)) continue; ?>
		<?php $event = $events[0]; ?>
		<?php $single = count($events) > 1 ? false : true; ?>
		<?php if (empty($event->coordinates) && empty($event->address)) continue; ?>
		
		<?php if (!empty($event->coordinates)) { ?>
		var coordinates_module = '<?php echo addslashes($event->coordinates); ?>';
		coordinates_module = coordinates_module.split(',');
		var module_lat = parseFloat(coordinates_module[0]);
		var module_lon = parseFloat(coordinates_module[1]);
		var marker_module<?php echo $event->id; ?> = moduleCreateMarker<?php echo $module->id; ?>(new google.maps.LatLng(module_lat,module_lon));
		latlngbounds.extend(new google.maps.LatLng(module_lat,module_lon));
		<?php } else { ?>
		var marker_module<?php echo $event->id; ?> = moduleCreateMarker<?php echo $module->id; ?>();
		module_codeAddress<?php echo $module->id; ?>('<?php echo addslashes($event->address); ?>',marker_module<?php echo $event->id; ?>);
		<?php } ?>
		
		if (marker_module<?php echo $event->id; ?> != false) {
			<?php if ($event->allday) { ?>
			var contentString<?php echo $module->id; ?><?php echo $event->id; ?> = '<b><a target="_blank" href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&id='.rseventsproHelper::sef($event->id,$event->name),true,$itemid); ?>"><?php echo addslashes($event->name); ?></a></b> <br /> <?php echo JText::_('COM_RSEVENTSPRO_GLOBAL_ON',true); ?> <?php echo addslashes(rseventsproHelper::date($event->start,rseventsproHelper::getConfig('global_date'),true)); ?> <br /> <?php echo JText::_('COM_RSEVENTSPRO_GLOBAL_AT',true); ?> <a target="_blank" href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=location&id='.rseventsproHelper::sef($event->lid,$event->lname),true,$itemid); ?>"><?php echo addslashes($event->lname); ?></a> ';
			<?php } else { ?>
			var contentString<?php echo $module->id; ?><?php echo $event->id; ?> = '<b><a target="_blank" href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&id='.rseventsproHelper::sef($event->id,$event->name),true,$itemid); ?>"><?php echo addslashes($event->name); ?></a></b> <br /> <?php echo JText::_('COM_RSEVENTSPRO_EVENT_STARTS',true); ?> <?php echo addslashes(rseventsproHelper::date($event->start,null,true)); ?> <br /> <?php echo JText::_('COM_RSEVENTSPRO_EVENT_ENDS',true); ?> <?php echo addslashes(rseventsproHelper::date($event->end,null,true)); ?> <br /> <?php echo JText::_('COM_RSEVENTSPRO_GLOBAL_AT',true); ?> <a target="_blank" href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=location&id='.rseventsproHelper::sef($event->lid,$event->lname),true,$itemid); ?>"><?php echo addslashes($event->lname); ?></a> ';
			<?php } ?>
			
			<?php if (!$single) { ?>
			contentString<?php echo $module->id; ?><?php echo $event->id; ?> += '<br /><br /><a style="float:right;" href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&location='.rseventsproHelper::sef($event->lid,$event->lname),true,$itemid); ?>"><?php echo JText::_('COM_RSEVENTSPRO_VIEW_OTHER_EVENTS',true); ?></a>';
			<?php } ?>
			
			var infowindow<?php echo $module->id; ?><?php echo $event->id; ?> = new google.maps.InfoWindow({
				content: contentString<?php echo $module->id; ?><?php echo $event->id; ?>
			});
			
			google.maps.event.addListener(marker_module<?php echo $event->id; ?>, 'click', function() {
			  infowindow<?php echo $module->id; ?><?php echo $event->id; ?>.open(map_module<?php echo $module->id; ?>,marker_module<?php echo $event->id; ?>);
			});
			
			google.maps.event.addListener(map_module<?php echo $module->id; ?>, 'click', function() {
			  infowindow<?php echo $module->id; ?><?php echo $event->id; ?>.close();
			});
		}
		
		<?php } ?>
		
		<?php if ($locations >= 1) { ?>
		map_module<?php echo $module->id; ?>.setCenter(latlngbounds.getCenter());
		<?php if ($locations != 1) { ?>map_module<?php echo $module->id; ?>.fitBounds(latlngbounds);<?php } ?>
		<?php } ?>
		
		google.maps.event.addListener(map_module<?php echo $module->id; ?>, 'click', function(e) {
          module_pantocenter<?php echo $module->id; ?>(e.latLng, map_module<?php echo $module->id; ?>);
        });
	}
	
	function module_pantocenter<?php echo $module->id; ?>(position,map) {
		var currentzoom = map.getZoom();
		if (currentzoom == 2) {
			map.panTo(position);
			map.setZoom(5);
		}
	}
	
	function moduleCreateMarker<?php echo $module->id; ?>(point) {
		marker = new google.maps.Marker({
		  map: map_module<?php echo $module->id; ?>,
		  position: point,
		  draggable: false
		});
		
		return marker;
	}
	
	function module_codeAddress<?php echo $module->id; ?>(address,themarker) {
		geocoder_module<?php echo $module->id; ?>.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var module_lat_addr = parseFloat(results[0].geometry.location.lat().toFixed(7));
				var module_lon_addr = parseFloat(results[0].geometry.location.lng().toFixed(7));
				themarker.setPosition(new google.maps.LatLng(module_lat_addr,module_lon_addr));
			}
		});
	}

	google.maps.event.addDomListener(window, 'load', module_initialize<?php echo $module->id; ?>);
</script>
<div id="rs_canvas<?php echo $module->id; ?>" class="rs_module_map" style="width: <?php echo $width; ?>; height: <?php echo $height; ?>px; margin: 5px;"></div>
<?php } ?>