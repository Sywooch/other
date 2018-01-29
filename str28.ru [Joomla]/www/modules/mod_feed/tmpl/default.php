<?php
/**
 * @package		Retina.Site
 * @subpackage	mod_feed
 * 
 * 
 */

// no direct access 2
defined('_REXEC') or die;
?>

<?php
if ($feed != false)
{
	//image handling
	$iUrl	= isset($feed->image->url)	? $feed->image->url	: null;
	$iTitle = isset($feed->image->title) ? $feed->image->title : null;
	?>
	<div style="direction: <?php echo $rssrtl ? 'rtl' :'ltr'; ?>; text-align: <?php echo $rssrtl ? 'right' :'left'; ?> ! important"  class="feed<?php echo $moduleclass_sfx; ?>">
	<?php
	// feed description
	if (!is_null($feed->title) && $params->get('rsstitle', 1)) {
		?>

				<h4>
					<a href="<?php echo str_replace('&', '&amp', $feed->link); ?>" target="_blank">
					<?php echo $feed->title; ?></a>
				</h4>

		<?php
	}

	// feed description
	if ($params->get('rssdesc', 1)) {
	?>
		<?php echo $feed->description; ?>

		<?php
	}

	// feed image
	if ($params->get('rssimage', 1) && $iUrl) {
	?>
		<img src="<?php echo $iUrl; ?>" alt="<?php echo @$iTitle; ?>"/>

	<?php
	}

	$actualelements = count($feed->elements);
	$setelements	= $params->get('rsselements', 5);

	if ($setelements > $actualelements) {
		$totalelements = $actualelements;
	} else {
		$totalelements = $setelements;
	}
	?>

			<ul class="newsfeed<?php echo $params->get('moduleclass_sfx'); ?>">
			<?php
			$words = $params->def('word_count', 0);
			for ($j = 0; $j < $totalelements; $j ++)
			{
				$currelement = & $feed->elements[$j];
				// element title
				?>
				<li class="newsfeed-element">
					<?php	if (!is_null($currelement->get_link())) {
					?>
				<?php if (!is_null($feed->title) && $params->get('rsstitle', 1))

					{ echo '<h5 class="feed-link">';}
				else
				{
				echo '<h4 class="feed-link">';
				}
				?>

				<a href="<?php echo $currelement->get_link(); ?>" target="_blank">
					<?php echo $currelement->get_title(); ?></a>
					<?php if (!is_null($feed->title) && $params->get('rsstitle', 1))

					{ echo '</h5>';}
						else
						{ echo '</h4>';}
				?>
				<?php
				}

				// element description
				if ($params->get('rsselementdesc', 1))
				{
					// element description
					$text = $currelement->get_description();
					$text = str_replace('&apos;', "'", $text);
					$text=strip_tags($text);
					// word limit check
					if ($words)
					{
						$texts = explode(' ', $text);
						$count = count($texts);
						if ($count > $words)
						{
							$text = '';
							for ($i = 0; $i < $words; $i ++) {
								$text .= ' '.$texts[$i];
							}
							$text .= '...';
						}
					}
					?>

						<p><?php echo $text; ?></p>

					<?php
				}
				?>
				</li>
				<?php
			}
			?>
			</ul>

	</div>
<?php } ?>
