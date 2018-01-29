<?php
/**
 * @package		Retina.Site
 * @subpackage	com_search
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>

<?php if($this->error): ?>
<div class="error">
			<?php echo $this->escape($this->error); ?>
</div>
<?php endif; ?>
