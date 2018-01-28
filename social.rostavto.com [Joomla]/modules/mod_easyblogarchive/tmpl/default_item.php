<?php
/**
 * @package		mod_easyblogarchive
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined('_JEXEC') or die('Restricted access');
?>
<?php
$curDate    	= EasyBlogHelper::getDate( $i . '-' . $m . '-01' );

// Do not show future months or empty months
if( $i < $currentYear || ($i == $currentYear && $m <= $currentMonth && !$params->get( 'showfuture') ) || $params->get( 'showfuture' )  )
{
    if( ( $showEmptyPost ) || (!$showEmptyPost && !empty( $postCounts->$i->$m ) ) )
    {
		$monthSEF	= ( strlen($m) < 2) ? '0' . $m : $m;
?>
<?php
		if ( ! isset( $postCounts->$i->$m ) )
		{
?>
		<div class="mod-month empty-month">
			<?php echo $curDate->toFormat('%B'); ?>
		</div>
<?php
		}
		else
		{
?>
		<div class="mod-month">
			<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=archive&layout=calendar&archiveyear='.$i.'&archivemonth='.$monthSEF.$menuitemid ) . $catid; ?>" <?php if($defaultYear == $i && $defaultMonth == $m) echo 'style="font-weight:700;"'; ?>>
				<?php echo $curDate->toFormat('%B'); ?>
				<span class="mod-post-count">(<?php echo $postCounts->$i->$m; ?>)</span>
			</a>
		</div>
<?php
		}
	}
}
?>