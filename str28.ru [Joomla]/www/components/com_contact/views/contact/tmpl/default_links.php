<?php
/**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */

defined('_REXEC') or die;

if ('plain' == $this->params->get('presentation_style')) :
	echo '<h3>'.RText::_('COM_CONTACT_LINKS').'</h3>';
else :
    echo JHtml::_($this->params->get('presentation_style').'.panel', RText::_('COM_CONTACT_LINKS'), 'display-links');
endif;
?>

<div class="contact-links">
	<ul>
		<?php
		    foreach(range('a', 'e') as $char) :// letters 'a' to 'e'
			    $link = $this->contact->params->get('link'.$char);
			    $label = $this->contact->params->get('link'.$char.'_name');

			    if( ! $link) :
			        continue;
			    endif;

			    // Add 'http://' if not present
			    $link = (0 === strpos($link, 'http')) ? $link : 'http://'.$link;

			    // If no label is present, take the link
			    $label = ($label) ? $label : $link;
			    ?>
			<li>
				<a href="<?php echo $link; ?>">
				    <?php echo $label;  ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
