<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 * @subpackage Category
 *
 * @copyright (C) 2008 - 2014 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>

<div class="info1">
	<h1>Важная информация</h1>
    <span>Важная информация</span>
</div>

<div style="width:100%; text-align:center;" class="banners1">
<img src="/images/banners/001.png"  alt="" title=""/>

</div>

<?php
$menu = & JSite::getMenu();
if ($menu->getActive() == $menu->getDefault()) {
// на главной

?>
<div class="info2">
	<h1>Добро пожаловать</h1>
    <span>Добро пожаловать</span>
</div>
<?php
}
?>

<!--
<div class="banner_block2"></div>

-->
<?php

$tabclass = array ("row1", "row2" );
$mmm=0;
foreach ( $this->sections as $section ) :
	$htmlClassBlockTable = !empty ( $section->class_sfx ) ? ' kblocktable' . $this->escape($section->class_sfx) : '';
	$htmlClassTitleCover = !empty ( $section->class_sfx ) ? ' ktitle-cover' . $this->escape($section->class_sfx) : '';
?>
<!--
<div style="width:100%; text-align:center;" class="banners1">
<img src="http://sinocom.ru/banners/200x80/taohelper_200x80.jpg"  alt="" title=""/>
<img src="http://sinocom.ru/banners/200x80/taohelper_200x80.jpg"  alt="" title=""/>
<img src="http://sinocom.ru/banners/200x80/taohelper_200x80.jpg"  alt="" title=""/>
<img src="http://sinocom.ru/banners/200x80/taohelper_200x80.jpg"  alt="" title=""/>
<img src="http://sinocom.ru/banners/200x80/taohelper_200x80.jpg"  alt="" title=""/>

</div>
-->
<?php
if ($menu->getActive() != $menu->getDefault()) {
?>
<div class="head_cat1">
Подразделы: <?php echo $this->GetCategoryLink ( $section, $this->escape($section->name) ); ?>
</div>
<style type="text/css">
#Kunena tr.krow2 td{
padding-top:8px !important;
padding-bottom:8px !important;	
}
</style>

<?php
}
?>


<div class="kblock kcategories-<?php echo intval($section->id) ?>">
	<div class="kheader">
    
    <div class="block1">Последнее сообщение</div>
    
    
    <?php
	if ($menu->getActive() == $menu->getDefault()) {
	?>
    <div class="block2">Тем / Сообщений</div>
    <?php
	}else{
	?>
    <div class="block2_1">Тем</div>
    <div class="block2_2">Сообщений</div>
    
	
	<?php
	}
	?>
    
    
		<?php if (count($this->sections) > 0) : ?>
		<span class="ktoggler"><a class="ktoggler close" title="<?php echo JText::_('COM_KUNENA_TOGGLER_COLLAPSE') ?>" rel="catid_<?php echo intval($section->id) ?>"></a></span>
		<?php endif; ?>
		<h2><span><?php 
		if ($menu->getActive() == $menu->getDefault()) {
		echo $this->GetCategoryLink ( $section, $this->escape($section->name) ); 
		}else{
		echo'<span class="head_2">Раздел</span>';	
		}
		
		?></span></h2>
		<?php if (!empty($section->description)) : ?>
		<div class="ktitle-desc km hidden-phone">
			<?php echo KunenaHtmlParser::parseBBCode ( $section->description ); ?>
		</div>
		<?php endif; ?>
	</div>
	<div class="kcontainer" id="catid_<?php echo intval($section->id) ?>">
		<div class="kbody">
<table class="kblocktable<?php echo $htmlClassBlockTable ?>" id="kcat<?php echo intval($section->id) ?>">
		<?php if (empty ( $this->categories [$section->id] )) { echo JText::_('COM_KUNENA_GEN_NOFORUMS');
		} else {
		$k = 0;
		foreach ( $this->categories [$section->id] as $category ) {
	?>
		<tr class="k<?php echo $tabclass [$k ^= 1], isset ( $category->class_sfx ) ? ' k' . $this->escape($tabclass [$k]) . $this->escape($category->class_sfx) : '' ?>"
			id="kcat<?php echo intval($category->id) ?>">
			<td class="kcol-first kcol-category-icon hidden-phone">
				<?php echo $this->getCategoryLink($category, $this->getCategoryIcon($category), '') ?>
			</td>

			<td class="kcol-mid kcol-kcattitle">
			<div class="kthead-title kl">
			<?php
				// Show new posts, locked, review
				echo $this->getCategoryLink($category); ?>
				<?php
				if ($category->getNewCount()) {
					echo '<sup class="knewchar">(' . $category->getNewCount() . ' ' . JText::_('COM_KUNENA_A_GEN_NEWCHAR') . ")</sup>";
				}
				if ($category->locked) {
					echo $this->getIcon ( 'kforumlocked', JText::_('COM_KUNENA_LOCKED_CATEGORY') );
				}
				if ($category->review) {
					echo $this->getIcon ( 'kforummoderated', JText::_('COM_KUNENA_GEN_MODERATED') );
				}
				?>
			</div>

		<?php if (!empty($category->description)) : ?>
			<div class="kthead-desc km hidden-phone"><?php echo KunenaHtmlParser::parseBBCode ($category->description) ?> </div>
		<?php endif; ?>
		<?php
			// Display subcategories
			if (! empty ( $this->categories [$category->id] )) :
		?>
			<div class="kthead-child">
			<div class="kcc-table">
			<?php foreach ( $this->categories [$category->id] as $childforum ) : ?>
			<div class="kcc-subcat km">
			<?php
				echo $this->getCategoryIcon($childforum, true);
				echo $this->getCategoryLink($childforum);
				echo '<span class="kchildcount ks">(' . $childforum->getTopics() . "/" . $childforum->getReplies() . ')</span>';
			?>
			</div>
			<?php endforeach; ?>
			</div>
			</div>
		<?php endif; ?>
		<?php if (! empty ( $category->moderators )) : ?>
			<div class="kthead-moderators ks">
		<?php
				// get the Moderator list for display
				$modslist = array();
				foreach ( $category->moderators as $moderator ) {
					$modslist[] = KunenaFactory::getUser($moderator)->getLink();
				}
				echo JText::_('COM_KUNENA_MODERATORS') . ': ' . implode(', ', $modslist);
		?>
			</div>
		<?php endif; ?>
		<?php if (! empty ( $this->pending [$category->id] )) : ?>
			<div class="ks kalert">
				<?php echo JHtml::_('kunenaforum.link', 'index.php?option=com_kunena&view=topics&layout=posts&mode=unapproved&userid=0&catid='.intval($category->id), intval($this->pending [$category->id]) . ' ' . JText::_('COM_KUNENA_SHOWCAT_PENDING'), '', '', 'nofollow'); ?>
			</div>
		<?php endif; ?>
			</td>
            
            
            
            
            
            
            <?php $last = $category->getLastTopic();
			if ($last->exists()) { ?>
			<td class="kcol-mid kcol-kcatlastpost">
			<?php if ($this->config->avataroncat > 0) : ?>
			<?php
				$profile = KunenaFactory::getUser((int)$last->last_post_userid);
				$useravatar = $profile->getAvatarImage('klist-avatar', 'list');
				if ($useravatar) : ?>
					<span class="klatest-avatar hidden-phone"> <?php echo $last->getLastPostAuthor()->getLink( $useravatar ); ?></span>
				<?php endif; ?>
			<?php endif; ?>
			<div class="klatest-subject ks">
				<?php echo   $this->getLastPostLink($category) ?>
			</div>

			<div class="klatest-subject-by ks hidden-phone">
			<?php
					echo JText::_('COM_KUNENA_BY') . ' ';
					echo $last->getLastPostAuthor()->getLink();
					echo '<br /><span class="nowrap" title="' . KunenaDate::getInstance($last->last_post_time)->toKunena('config_post_dateformat_hover') . '">' . KunenaDate::getInstance($last->last_post_time)->toKunena('config_post_dateformat') . '</span>';
					?>
			</div>
			</td>

			<?php } else { ?>
			<td class="kcol-mid kcol-knoposts"><?php echo JText::_('COM_KUNENA_NO_POSTS'); ?></td>
			<?php } ?>
            
            
            
            
            
            

			<td class="kcol-mid kcol-kcattopics hidden-phone">
				<span class="kcat-topics-number">
				
				<?php 
				if ($menu->getActive() == $menu->getDefault()) {
				
				echo $this->formatLargeNumber ( $category->getTopics() ) .' / '.$this->formatLargeNumber ( $category->getReplies() ); 
				
				}else{
				echo '<span class="number1">'.$this->formatLargeNumber ( $category->getTopics() ).'</span>'; 
				 echo '<span class="number2">'.$this->formatLargeNumber ( $category->getReplies() ).'</span>'; 
				echo'
				<style type="text/css">
				#Kunena td.kcol-kcattopics{
				width:16% !important;	
				}
				
				#Kunena .kcol-mid.kcol-kcattitle{
				width:63% !important;	
				}
				
				#Kunena table.kblocktable td.kcol-mid.kcol-knoposts{
				
				}
				
				.number1{
				margin-left:-70px;
				width:50px;	
				}
				
				.number2{
				margin-left:68px;	
				width:50px;
				}
				
				
				</style>
				
				';
					
				}
				
				
				?>
                
                
                </span>
				<span class="kcat-topics" style="display:none;"><?php echo JText::_('COM_KUNENA_TOPICS');?></span>
			<!--</td>

			<td class="kcol-mid kcol-kcatreplies hidden-phone">-->
				<span class="kcat-replies-number" style="display:none;"><?php echo $this->formatLargeNumber ( $category->getReplies() ) ?></span>
				<span class="kcat-replies" style="display:none;"><?php echo JText::_('COM_KUNENA_GEN_REPLIES');?> </span>
			</td>

			
		</tr>
		<?php } } ?>
</table>
</div>
</div>
</div>


<!-- Begin: Category Module Position -->
	<?php $this->displayModulePosition('kunena_section_' . ++$mmm) ?>
<!-- Finish: Category Module Position -->
<?php endforeach; ?>

<?php
if ($menu->getActive() != $menu->getDefault()) {
?>
<div class="head_container" style="display:none;">
<div class="head_cat1_abs">
<span>Подразделы: <?php echo $this->GetCategoryLink ( $section, $this->escape($section->name) ); ?></span>
</div>
</div>
<?php
}
?>
<style type="text/css">
.banners1_1{
display:none;	
}

</style>

