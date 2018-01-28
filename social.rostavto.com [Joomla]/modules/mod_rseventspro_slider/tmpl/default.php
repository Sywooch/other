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

<?php echo $pretext; ?>
	<div class="mod_rseventspro_slider" id="mod_rseventspro_slider<?php echo $module->id;?>">
		<div class="mod_rseventspro_slider_mask2" id="mod_rseventspro_slider_mask2<?php echo $module->id;?>">
			<div class="rsepro_slider_img" id="rsepro_simple_img<?php echo $module->id;?>">
			<?php foreach($events as $event) { ?>
				<span>
					<a <?php echo $open; ?> href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&id='.rseventsproHelper::sef($event->id,$event->name),true,$itemid); ?>" class="hasTip"  title="<?php echo $event->name.'::'; ?>">
						<?php if (!empty($event->icon) && file_exists(JPATH_SITE.'/'.$image_path.$event->icon)) { ?>
						<img src="<?php echo JURI::root().$image_path.$event->icon;?>" alt="<?php echo $event->name; ?>" />
						<?php } else { ?>
						<img src="<?php echo JURI::root(); ?>modules/mod_rseventspro_slider/assets/images/default.gif" />
						<?php } ?>
					</a>
				</span>
			<?php } ?>
			</div>
			<?php if (!empty($title) || !empty($date)) { ?>
			<div class="rsepro_slider_text info" id="rsepro_simple_txt<?php echo $module->id;?>">
				<?php if (!empty($title)) { ?>
				<h4><small><strong><?php echo $events[0]->name; ?></strong></small></h4>
				<?php } ?>
				<p>
					<?php if (!empty($date)) { ?>
					<strong>
						<small>
							<?php echo JText::_('MOD_RSEVENTSPRO_SLIDER_DATE');?>: <?php echo $events[0]->allday ? rseventsproHelper::date($events[0]->start,rseventsproHelper::getConfig('global_date'),true) : rseventsproHelper::date($events[0]->start,null,true); ?>
						</small>
					</strong>
					<?php } ?>
					<a <?php echo $open; ?> href="<?php echo rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&cid='.rseventsproHelper::sef($events[0]->id,$events[0]->name),true,$itemid); ?>" class="bnr_link"><?php echo JText::_('MOD_RSEVENTSPRO_SLIDER_VIEW')?></a>
				</p>
			</div>
			<?php } ?>
		</div>
		
		<?php if ($buttons) { ?>
		<p class="buttons_sml" id="buttons_sml<?php echo $module->id;?>">
			<span class="prev_slide_sml" id="prev_slide<?php echo $module->id;?>"></span>
			<span class="next_slide_sml" id="next_slide<?php echo $module->id;?>"></span>
		</p>
		<?php } ?>
	</div>
	<br />
<?php echo $posttext; ?>

<script type="text/javascript" charset="utf-8">
window.addEvent('domready',function(){
<?php if (!empty($title) || !empty($date)) { ?>
var rsepro_slider_text = $('rsepro_simple_txt<?php echo $module->id;?>').set('opacity',0.5);
<?php } ?>
var sampleObjectItems =[
<?php $i=0; ?>
<?php foreach($events as $row) { ?>
<?php $eventdate = $row->allday ? rseventsproHelper::date($row->start,rseventsproHelper::getConfig('global_date'),true) : rseventsproHelper::date($row->start,null,true); ?>
<?php ++$i; ?>
	{
		title: '<?php echo addslashes($row->name); ?>',
		date: '<?php echo addslashes($eventdate); ?>',
		link: '<?php echo addslashes(rseventsproHelper::route('index.php?option=com_rseventspro&layout=show&id='.rseventsproHelper::sef($row->id,$row->name),true,$itemid)); ?>'
	}
<?php if ($i < count($events)) echo ','; ?>
<?php } ?>
	];
		
	var noobslidersepro = new noobSlide({
		mode: 'vertical',
		box: $('rsepro_simple_img<?php echo $module->id;?>'),
		size: <?php echo $height; ?>,
		items: sampleObjectItems,
		interval: <?php echo $interval; ?>000,
		<?php if ($buttons == '1') { ?>
		addButtons: {
			previous: $('prev_slide<?php echo $module->id;?>'),
			next: $('next_slide<?php echo $module->id;?>')
		},
		<?php } ?>
		fxOptions: {
			duration: <?php echo $duration; ?>000,
			transition: <?php echo $effect; ?>.<?php echo $method; ?>,
			wait: true,
		},
		<?php if ($autoplay) { ?>
		autoPlay: true,
		<?php } ?>
		
		<?php if (!empty($title) || !empty($date)) { ?>
		onWalk: function(currentItem){
			rsepro_slider_text.empty();
			<?php if (!empty($title)) { ?>
			new Element('h4').set('html', '<small><strong>'+currentItem.title+'</strong></small>').inject(rsepro_slider_text);
			<?php } ?>
			new Element('p').set('html','<?php if (!empty($date)) { ?><strong><small><?php echo JText::_("MOD_RSEVENTSPRO_SLIDER_DATE",true);?>: '+currentItem.date+'</small></strong><?php } ?><a <?php echo $open; ?> href="'+currentItem.link+'" class="bnr_link"><?php echo JText::_("MOD_RSEVENTSPRO_SLIDER_VIEW",true)?></a>').inject(rsepro_slider_text);
		}
		<?php } ?>
	});


	$$('#mod_rseventspro_slider<?php echo $module->id;?>').setStyle('width','<?php echo $width;?>px');
	$$('#buttons_sml<?php echo $module->id;?>').setStyle('width','<?php echo $width;?>px');
	$$('#rsepro_simple_img<?php echo $module->id;?>').setStyle('width','<?php echo $width;?>px');
	$$('#rsepro_simple_txt<?php echo $module->id;?>').setStyle('width','<?php echo $width;?>px');
	$$('#rsepro_simple_img<?php echo $module->id;?> span a img').setStyle('width','<?php echo $width;?>px');
	$$('#mod_rseventspro_slider_mask2<?php echo $module->id;?>').setStyle('width','<?php echo $width;?>px');

	$$('#mod_rseventspro_slider<?php echo $module->id;?>').setStyle('height','<?php echo $height;?>px');
	$$('#rsepro_simple_img<?php echo $module->id;?> span').setStyle('height','<?php echo $height;?>px');
	$$('#rsepro_simple_img<?php echo $module->id;?> span a img').setStyle('height','<?php echo $height;?>px');
	$$('#mod_rseventspro_slider_mask2<?php echo $module->id;?>').setStyle('height','<?php echo $height;?>px');
});
</script>
<?php } ?>