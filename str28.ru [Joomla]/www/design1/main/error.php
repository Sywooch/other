<?php
/**
 * @package		Retina.Site
 * 
 * 
 */

defined('_REXEC') or die;
if (!isset($this->error)) {
	$this->error = JError::raiseWarning(404, RText::_('RERROR_ALERTNOAUTHOR'));
	$this->debug = false;
}
//get language and direction
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/design1/main/css/error.css" type="text/css" />
	<?php if ($this->direction == 'rtl') : ?>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/design1/main/css/error_rtl.css" type="text/css" />
	<?php endif; ?>
</head>
<body>
	<div class="error">
		<div id="outline">
		<div id="errorboxoutline">
			<div id="errorboxheader"><?php echo $this->error->getCode(); ?> - <?php echo $this->error->getMessage(); ?></div>
			<div id="errorboxbody">
			<p><strong><?php echo RText::_('RERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></strong></p>
				<ol>
					<li><?php echo RText::_('RERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
					<li><?php echo RText::_('RERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
					<li><?php echo RText::_('RERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
					<li><?php echo RText::_('RERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
					<li><?php echo RText::_('RERROR_LAYOUT_REQUESTED_RESOURCE_WAS_NOT_FOUND'); ?></li>
					<li><?php echo RText::_('RERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></li>
				</ol>
			<p><strong><?php echo RText::_('RERROR_LAYOUT_PLEASE_TRY_ONE_OF_THE_FOLLOWING_PAGES'); ?></strong></p>

				<ul>
					<li><a href="<?php echo $this->baseurl; ?>/index.php" title="<?php echo RText::_('RERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?>"><?php echo RText::_('RERROR_LAYOUT_HOME_PAGE'); ?></a></li>
				</ul>

			<p><?php echo RText::_('RERROR_LAYOUT_PLEASE_CONTACT_THE_main_admin'); ?>.</p>
			<div id="techinfo">
			<p><?php echo $this->error->getMessage(); ?></p>
			<p>
				<?php if ($this->debug) :
					echo $this->renderBacktrace();
				endif; ?>
			</p>
			</div>
			</div>
		</div>
		</div>
	</div>
</body>
</html>
