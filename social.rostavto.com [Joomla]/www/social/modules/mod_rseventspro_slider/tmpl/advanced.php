<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php $open = !$links ? 'target="_blank"' : ''; ?>
<?php if (!empty($events)) { ?>

<div id="rsepro_slider_adv_holder<?php echo $suffix; ?>" class="rsepro_slider_adv_holder">
	
	<?php echo $pretext;?>
	<div class="rsepro_slider_box" id="rsepro_slider_box<?php echo $module->id;?>">
		<div class="rsepro_slider_mask3" id="rsepro_slider_mask3<?php echo $module->id?>">
			<div id="rsepro_slider_adv<?php echo $module->id;?>" class="rsepro_slider_adv">
			<?php $i=1; ?>
			<?php foreach ($events as $event) { ?>
				<div class="rsepro_slider_slide rseslider_slide">
					<?php if (!empty($title)) { ?>
					<h3>
						<a <?php echo $open; ?> href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&id='.rseventsproHelper::sef($event->id,$event->name),true,$itemid); ?>">
							<?php echo $event->name; ?>
						</a>
					</h3>
					<?php } ?>
					<a <?php echo $open; ?> href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&id='.rseventsproHelper::sef($event->id,$event->name),true,$itemid); ?>" class="hasTip" title="<?php echo $event->name.'::'; ?>">
						<?php if (!empty($event->icon) && file_exists(JPATH_SITE.'/'.$image_path.$event->icon)) { ?>
							<img src="<?php echo JURI::root().$image_path.$event->icon;?>" alt="<?php echo $event->name; ?>" />
						<?php } else { ?>
							<img src="<?php echo JURI::root(); ?>modules/mod_rseventspro_slider/assets/images/default.gif" />
						<?php } ?>
					</a>
					<?php if (!empty($date)) { ?>
					<?php echo JText::_('MOD_RSEVENTSPRO_SLIDER_DATE'). ': '.($event->allday ? rseventsproHelper::date($event->start,rseventsproHelper::getConfig('global_date'),true) : rseventsproHelper::date($event->start,null,true)); ?> <br />
					<?php } ?>
					<?php echo substr(strip_tags($event->description),0,$length); ?>
				</div>
			<?php ++$i; ?>
			<?php } ?>
			</div>
		</div>
		<h4><span id="info4"></span></h4>
		
		<?php if ($buttons) { ?>
		<div class="buttons" id="buttons<?php echo $module->id;?>">
			<div style="width:<?php echo (13*$i); ?>px;margin:0 auto;" id="handles_<?php echo $module->id?>">
				<?php $nr = 0; ?>
				<?php foreach ($events as $event) { ?>
				<span class="roundbtn <?php ($nr == 0 ? 'active' : '');?>"></span>
				<?php ++$nr; ?>
				<?php } ?>
			</div>
		</div>
		
		<span id="prev_slide<?php echo $module->id?>" class="prev_slide"></span>
		<span id="next_slide<?php echo $module->id?>" class="next_slide"></span>
		<?php } ?>
	</div>
	<div>
		<?php echo $posttext;?>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
window.addEvent('domready',function(){
	$$('#rsepro_slider_box<?php echo $module->id;?>').setStyle('width','<?php echo $width;?>px');
	$$('#buttons<?php echo $module->id;?>').setStyle('width','<?php echo $width;?>px');
	$$('.rsepro_slider_slide').setStyle('width','<?php echo ($width-60);?>px');
	$$('#rsepro_slider_adv<?php echo $module->id;?>').setStyle('height','<?php echo $height;?>px');
	$$('#rsepro_slider_mask3<?php echo $module->id?>').setStyle('height','<?php echo $height;?>px');
	$$('.rsepro_slider_slide').setStyle('height','<?php echo $height;?>px');

	var noobslidersepro = new noobSlide({
		box: $('rsepro_slider_adv<?php echo $module->id?>'),
		items: $$('#rsepro_slider_adv<?php echo $module->id?> div.rsepro_slider_slide'),
		size: <?php echo $width; ?>,
		<?php if ($buttons) { ?>
		handles: $$('#handles_<?php echo $module->id?> span'),
		addButtons: {
			previous: $('prev_slide<?php echo $module->id?>'),
			next: $('next_slide<?php echo $module->id?>')
		},
		onWalk: function(currentItem,currentHandle){
			this.handles.removeClass('active');
			currentHandle.addClass('active');
		},
		<?php } ?>
		fxOptions: {
			duration: <?php echo $duration; ?>000,
			transition: <?php echo $effect; ?>.<?php echo $method; ?>,
			wait: false
		},
		<?php if ($autoplay) { ?>
		autoPlay: true,
		<?php } ?>
		interval: <?php echo $interval; ?>000
	});
});
</script>
<?php } ?>