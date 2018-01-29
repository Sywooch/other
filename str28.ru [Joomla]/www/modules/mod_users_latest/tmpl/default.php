<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_users_latest
 * 
 * 
 */
// no direct access 2
defined('_REXEC') or die;
?>
<?php if (!empty($names)) : ?>
	<ul class="latestusers<?php echo $moduleclass_sfx ?>" >
	<?php foreach($names as $name) : ?>
		<li>
			<?php echo $name->username; ?>
		</li>
	<?php endforeach;  ?>
	</ul>
<?php endif; ?>
