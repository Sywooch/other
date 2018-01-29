<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_weblinks
 * @copyright	Copyright (C) 2005 - 2009 Open Source Matters, Inc. All rights reserved.
 * 
 */

defined('_REXEC') or die;
?>
<ul class="weblinks<?php echo $moduleclass_sfx; ?>">
<?php foreach ($list as $element) :	?>
<li>
	<?php
	$link = $element->link;
	switch ($params->get('target', 3))
	{
		case 1:
			// open in a new window
			echo '<a href="'. $link .'" target="_blank" rel="'.$params->get('follow', 'no follow').'">'.
			htmlspecialchars($element->title, ENT_COMPAT, 'UTF-8') .'</a>';
			break;

		case 2:
			// open in a popup window
			echo "<a href=\"#\" onclick=\"window.open('". $link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\">".
				htmlspecialchars($element->title, ENT_COMPAT, 'UTF-8') .'</a>';
			break;

		default:
			// open in parent window
			echo '<a href="'. $link .'" rel="'.$params->get('follow', 'no follow').'">'.
				htmlspecialchars($element->title, ENT_COMPAT, 'UTF-8') .'</a>';
			break;
	}
	?>
	<?php if ($params->get('description', 0)) : ?>
		<?php echo nl2br($element->description); ?>
	<?php endif; ?>

	<?php if ($params->get('hits', 0)) : ?>
		<?php echo '(' . $element->hits . ' ' . RText::_('MOD_WEBLINKS_HITS') . ')'; ?>
	<?php endif; ?>
</li>
<?php endforeach; ?>
</ul>
