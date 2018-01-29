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



<div style="width:100%; text-align:center;" class="banners1_1">
<img src="/images/banners/001.png" alt="" title="">

</div>



<?php $this->displayCategories () ?>
<?php if ($this->category->headerdesc) : ?>
<div class="kblock">
	<div class="kheader" style="display:none;">
		<span class="ktoggler"><a class="ktoggler close" title="<?php echo JText::_('COM_KUNENA_TOGGLER_COLLAPSE') ?>" rel="frontstats_tbody"></a></span>
		<h2><span><?php echo JText::_('COM_KUNENA_FORUM_HEADER'); ?></span></h2>
	</div>
	<div class="kcontainer" id="frontstats_tbody">
		<div class="kbody">
			<div class="kfheadercontent">
				<?php echo KunenaHtmlParser::parseBBCode ( $this->category->headerdesc ); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>




<?php if (!$this->category->isSection()) : ?>
<table class="klist-actions">
	<tr>
		<td class="klist-actions-goto">
			<a id="forumtop"> </a>
			<a class="kbuttongoto" href="#forumbottom" rel="nofollow">
			<?php echo $this->getIcon ( 'kforumbottom', JText::_('COM_KUNENA_GEN_GOTOBOTTOM') ) ?></a>
		</td>
		<?php $this->displayCategoryActions() ?>
		<td class="klist-pages-all"><?php echo $this->getPagination (7); // odd number here (# - 2) ?></td>
	</tr>
</table>


<div class="head_container2">
<div class="head_cat1_abs2">
<span>Тема раздела: <?php
 echo $this->getCategoryLink($this->category);   
?></span>
</div>
</div>


<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" method="post" name="ktopicsform class1">
	<input type="hidden" name="view" value="topics" />
	<?php echo JHtml::_( 'form.token' ); ?>

<div class="kblock kflat">
	<div class="kheader">
		<?php if (!empty($this->topicActions)) : ?>
		<span class="kcheckbox select-toggle"><input class="kcheckall" type="checkbox" name="toggle" value="" /></span>
		<?php endif; ?>
		<h3><span><?php //echo $this->escape($this->headerText); ?></span></h3>
        <span class="txt1">Темы/Автор</span>
        
        <span class="txt4">Просмотров</span>
        <span class="txt3">Ответов</span>
        <span class="txt2">Последнеее сообщение</span>
        
        
        
	</div>
	<div class="kcontainer">
		<div class="kbody">
				<table class="kblocktable<?php echo $this->escape($this->category->class_sfx); ?>" id="kflattable">

					<?php if (empty ( $this->topics ) && empty ( $this->subcategories )) : ?>
					<tr class="krow2"><td class="kcol-first"><?php echo JText::_('COM_KUNENA_VIEW_NO_TOPICS') ?></td></tr>

					<?php else : ?>
						<?php $this->displayRows (); ?>

					<?php  if ( !empty($this->topicActions) || !empty($this->embedded) ) : ?>
					<!-- Bulk Actions -->
					<tr class="krow1">
						<td colspan="<?php echo empty($this->topicActions) ? 5 : 6 ?>" class="kcol krowmoderation">
							<?php if (!empty($this->moreUri)) echo JHtml::_('kunenaforum.link', $this->moreUri, JText::_('COM_KUNENA_MORE'), null, null, 'follow'); ?>
							<?php if (!empty($this->topicActions)) : ?>
							<?php echo JHtml::_('select.genericlist', $this->topicActions, 'task', 'class="inputbox kchecktask" size="1"', 'value', 'text', 0, 'kchecktask'); ?>
							<?php if ($this->actionMove) :
								$options = array (JHtml::_ ( 'select.option', '0', JText::_('COM_KUNENA_BULK_CHOOSE_DESTINATION') ));
								echo JHtml::_('kunenaforum.categorylist', 'target', 0, $options, array(), 'class="inputbox fbs" size="1" disabled="disabled"', 'value', 'text', 0, 'kchecktarget');
								endif;?>
							<input type="submit" name="kcheckgo" class="kbutton" value="<?php echo JText::_('COM_KUNENA_GO') ?>" />
							<?php endif; ?>
						</td>
					</tr>
					<!-- /Bulk Actions -->
					<?php endif; ?>
					<?php endif; ?>
				</table>
		</div>
	</div>
</div>
</form>

<table class="klist-actions-bottom" >
	<tr>
		<td class="klist-actions-goto">
			<a id="forumbottom"> </a>
			<a  class="kbuttongoto" href="#forumtop" rel="nofollow"><?php echo $this->getIcon ( 'kforumtop', JText::_('COM_KUNENA_GEN_GOTOTOP') ) ?></a>
		</td>
		<?php $this->displayCategoryActions() ?>
		<td class="klist-pages-all"><?php echo $this->getPagination (7); // odd number here (# - 2) ?></td>
	</tr>
</table>

<div class="kcontainer klist-bottom">
	<div class="kbody">
		<div class="kmoderatorslist-jump fltrt"><?php $this->displayForumJump (); ?></div>
		<?php if (!empty ( $this->moderators ) ) : ?>
		<div class="klist-moderators">
			<?php
				$modslist = array();
				foreach ( $this->moderators as $moderator ) {
					$modslist[] = $moderator->getLink();
				}
				echo JText::_('COM_KUNENA_MODERATORS') . ': ' . implode(', ', $modslist);
			?>
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>

<div class="bottom_new_theme">
<?php $this->displayCategoryActions() ?>


<div class="klist-pages-all" style="float:right;">
<?php echo $this->getPagination (7); // odd number here (# - 2) ?>
</div>

</div>


<?php
$users = KunenaUserHelper::getOnlineUsers();
	///	KunenaUserHelper::loadUsers(array_keys($users));

	$onlineusers = KunenaUserHelper::getOnlineCount();

$all_u=$onlineusers['user']+$onlineusers['guest'];		

		
?>



<div class="kblock kwhoisonline">
	<div class="kheader">
		<span class="ktoggler" style="display:none;"><a class="ktoggler close" title="<?php echo JText::_('COM_KUNENA_TOGGLER_COLLAPSE') ?>" rel="kwhoisonline"></a></span>
		<h2><span><span class="ktitle km"><?php echo JText::_('COM_KUNENA_VIEW_COMMON_WHO_TITLE') ?></span></span></h2>
        
        
	</div>
	<div class="kcontainer" id="kwhoisonline">
		<div class="kbody">
	<table class = "kblocktable">
		<tr class = "krow2">
			<td class = "kcol-first">
				<div class="kwhoicon"></div>
			</td>
			<td class = "kcol-mid km">
				<div class="kwhoonline kwho-total ks" >
				
				
				<h5>Присутствуют</h5> <?php echo $all_u; ?> (<span><?php echo $onlineusers['user']; ?> </span>пользователь&nbsp;и<span> <?php echo $onlineusers['guest'];  ?> </span>гостей)&nbsp;<br>
                Рекорд одновременного пребывания 
                <?php
				
				$database	= & JFactory::getDBO();
				$database->setQuery("SELECT * FROM #__statistic");
				$list = $database->loadObjectList();
 				
				foreach($list as $user) {
				echo $user->count." это было ".$user->time;
				
				break;
				}
				
				?>
                
                
               
                
                
                </div>
				<div>
					 <?php  /* $onlinelist = array();
					foreach ($this->onlineList as $user) {
						$onlinelist[] = $user->getLink();
					}

					echo implode(', ', $onlinelist); */ 
					$users = KunenaUserHelper::getOnlineUsers();
					foreach ($users as $userid=>$usertime) {
						$user = KunenaUserHelper::get($userid);
						if ( !$user->showOnline ) {
							if ($moderator) $this->hiddenList[$user->getName()] = $user;
						} else {
							$this->onlineList[$user->getName()] = $user;
							echo $user->getLink()." ";
						}
					}
					
					
					?>
                    </div>
                
                
                
                
				<div class="kwholegend ks">
					<span><?php echo JText::_('COM_KUNENA_LEGEND'); ?>:</span>&nbsp;
					<span class = "kwho-admin" title = "<?php echo JText::_('COM_KUNENA_COLOR_ADMINISTRATOR'); ?>"> <?php echo JText::_('COM_KUNENA_COLOR_ADMINISTRATOR'); ?></span>,&nbsp;
					<span class = "kwho-globalmoderator" title = "<?php echo JText::_('COM_KUNENA_COLOR_GLOBAL_MODERATOR'); ?>"> <?php echo JText::_('COM_KUNENA_COLOR_GLOBAL_MODERATOR'); ?></span>,&nbsp;
					<span class = "kwho-moderator" title = "<?php echo JText::_('COM_KUNENA_COLOR_MODERATOR'); ?>"> <?php echo JText::_('COM_KUNENA_COLOR_MODERATOR'); ?></span>,&nbsp;
					<span class = "kwho-banned" title = "<?php echo JText::_('COM_KUNENA_COLOR_BANNED'); ?>"> <?php echo JText::_('COM_KUNENA_COLOR_BANNED'); ?></span>,&nbsp;
					<span class = "kwho-user" title = "<?php echo JText::_('COM_KUNENA_COLOR_USER'); ?>"> <?php echo JText::_('COM_KUNENA_COLOR_USER'); ?></span>,&nbsp;
					<span class = "kwho-guest" title = "<?php echo JText::_('COM_KUNENA_COLOR_GUEST'); ?>"> <?php echo JText::_('COM_KUNENA_COLOR_GUEST'); ?></span>
				</div>
			</td>
		</tr>
</table>
</div>
</div>
</div>



<div class="forum_statuses">
<span class="status1">Новые сообщения</span>
<span class="status2">Популярная тема с новыми сообщениями</span>
<span class="status3">Нет новых сообщений</span>
<span class="status4">Популярная тема без новых сообщений</span>
<span class="status5">Тема закрыта</span>
<span class="status6">В этой теме есть ваши сообщения</span>
</div>


