<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 * @subpackage Common
 *
 * @copyright (C) 2008 - 2014 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

?>
<div class="kblock kfrontstats">
	<div class="kheader">
		<span class="ktoggler" style="display:none;"><a class="ktoggler close" title="<?php echo JText::_('COM_KUNENA_TOGGLER_COLLAPSE') ?>" rel="kfrontstats-tbody"></a></span>
		<h2><?php echo $this->getStatsLink(JText::_('COM_KUNENA_STAT_FORUMSTATS'), ''); ?></h2>
        
        
        <div class="head_stats"></div>
        
        <div class="head1">
        	<div class="hd1">Тема</div>
            <div class="hd2">Дата</div>
            <div class="hd3">Время</div>
            <div class="hd4">Автор</div>
            <div class="hd5">Ответов</div>
            <div class="hd6">Просмотров</div>
            <div class="hd7">Раздел</div>
        
        </div>
        
        <?php
		//echo "<span style='color:red;'>======<br>";
		$database	= & JFactory::getDBO();
		$database->setQuery("SELECT * FROM #__kunena_topics");
		$list = $database->loadObjectList();
 
		foreach($list as $user) {
			
			
			echo '<div class="body1"> ';	
			
 			echo '<div class="b1"> ';
			
			$link21="";
			$category21=$user->category_id;
			$database21	= & JFactory::getDBO();
			$database21->setQuery("SELECT * FROM #__kunena_categories WHERE id='".$category21."'");
			$list21 = $database21->loadObjectList();
			foreach($list21 as $user21) {
				$link21=$link21."/forum/".($user21->alias)."/";
				break;
			}
			$link21=$link21.($user->id)."-";
			
			
			
			
			$converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '',  'ы' => 'y',   'ъ' => '',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'a',   'Б' => 'b',   'В' => 'v',
        'Г' => 'g',   'Д' => 'd',   'Е' => 'e',
        'Ё' => 'e',   'Ж' => 'zh',  'З' => 'z',
        'И' => 'i',   'Й' => 'y',   'К' => 'k',
        'Л' => 'l',   'М' => 'm',   'Н' => 'n',
        'О' => 'o',   'П' => 'p',   'Р' => 'r',
        'С' => 's',   'Т' => 't',   'У' => 'u',
        'Ф' => 'f',   'Х' => 'h',   'Ц' => 'c',
        'Ч' => 'ch',  'Ш' => 'sh',  'Щ' => 'sch',
        'Ь' => '',  'Ы' => 'y',   'Ъ' => '',
        'Э' => 'e',   'Ю' => 'yu',  'Я' => 'ya',
    );
    $link21=$link21.(strtr(($user->subject), $converter));
		$link21=mb_strtolower($link21);
		$link21=str_replace(" ","-",$link21);
		$link21=str_replace("!","",$link21);
		$link21=str_replace("?","",$link21);
		$link21=str_replace(",","",$link21);
		$link21=str_replace(".","",$link21);
		$link21=str_replace(";","",$link21);
		$link21=str_replace(":","",$link21);
		
			
			
			
    		echo '<a href="'.$link21.'">'.($user->subject).'</a>'; 
			echo'</div>';
			echo '<div class="b2"> ';
			echo date( "d-m-Y", $user->last_post_time );
			echo'</div>';
			echo '<div class="b3"> ';
			echo date( "H:i", $user->last_post_time );
			echo'</div>';
			$userid=$user->last_post_userid;
			$database2	= & JFactory::getDBO();
			$database2->setQuery("SELECT * FROM #__users WHERE id='".$userid."'");
			
			$list2 = $database2->loadObjectList();
			
			$tmp_1=0;
			echo '<div class="b4"> ';
			foreach($list2 as $user2) {
				
			
				echo "<a href=\"/forum/user/".$userid."-".mb_strtolower($user2->username)."\">".$user2->username."";
				
				
				
				
				break;
				$tmp_1=1;
			}
			echo'</div>';
			
			echo '<div class="b5"> ';
			echo $user->posts;
			echo'</div>';
			echo '<div class="b6"> ';
			echo $user->hits;
			echo'</div>';
			
			$category=$user->category_id;
			$database2	= & JFactory::getDBO();
			$database2->setQuery("SELECT * FROM #__kunena_categories WHERE id='".$category."'");
			$list2 = $database2->loadObjectList();
			foreach($list2 as $user2) {
				echo '<div class="b7"> ';
				echo '<a href="/forum/'.$user2->alias.'">'.$user2->name."</a>";
				echo'</div>';
				break;
			}
			
			
			echo"</div>";
			
			
			
		//echo"<br>";
		}
		
		//echo "</span>"
		?>
        
        
        
	</div>
	<div class="kcontainer" id="kfrontstats-tbody">
		<div class="kbody">
			<table class="kblocktable" id="kfrontstats">
				<tr class="krow1">
					<td class="kcol-first">
						<div class="kstatsicon"></div>
					</td>
					<td class="kcol-mid km">
						<ul id="kstatslistright" class="fltrt kright">
							<li class="hidden-phone"><?php echo JText::_('COM_KUNENA_STAT_TOTAL_USERS'); ?>: <strong><?php echo $this->getUserlistLink('', $this->memberCount) ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_LATEST_MEMBERS'); ?>: <strong><?php echo $this->latestMemberLink ?></strong></li>
							<li>&nbsp;</li>
							<li><?php echo $this->getUserlistLink('', JText::_('COM_KUNENA_STAT_USERLIST').' &raquo;') ?></li>
							<li><?php if ($this->config->showpopuserstats || $this->config->showpopsubjectstats) echo $this->getStatsLink(JText::_('COM_KUNENA_STAT_MORE_ABOUT_STATS').' &raquo;');?></li>
						</ul>
						<ul id="kstatslistleft" class="fltlft">
							<li><?php echo JText::_('COM_KUNENA_STAT_TOTAL_MESSAGES'); ?>: <strong> <?php echo intval($this->messageCount); ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_TOTAL_SUBJECTS'); ?>: <strong><?php echo intval($this->topicCount); ?></strong></li>
							<li><?php echo JText::_('COM_KUNENA_STAT_TOTAL_SECTIONS'); ?>: <strong><?php echo intval($this->sectionCount); ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_TOTAL_CATEGORIES'); ?>: <strong><?php echo intval($this->categoryCount); ?></strong></li>
							<li><?php echo JText::_('COM_KUNENA_STAT_TODAY_OPEN_THREAD'); ?>: <strong><?php echo $this->todayTopicCount; ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_YESTERDAY_OPEN_THREAD'); ?>: <strong><?php echo intval($this->yesterdayTopicCount); ?></strong></li>
							<li><?php echo JText::_('COM_KUNENA_STAT_TODAY_TOTAL_ANSWER'); ?>: <strong><?php echo intval($this->todayReplyCount); ?></strong> <span class="divider">|</span> <?php echo JText::_('COM_KUNENA_STAT_YESTERDAY_TOTAL_ANSWER'); ?>: <strong><?php echo intval($this->yesterdayReplyCount); ?></strong></li>
						</ul>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>









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
				<div class="kwhoonline kwho-total ks" ><?php  echo JText::sprintf('COM_KUNENA_VIEW_COMMON_WHO_TOTAL', $this->membersOnline) ?></div>
				<div>
					 <?php $onlinelist = array();
					foreach ($this->onlineList as $user) {
						$onlinelist[] = $user->getLink();
					}

					echo implode(', ', $onlinelist); ?>
					<?php if (!empty($this->hiddenList)) : ?>
						<br />
						<span class="khidden-ktitle ks" style="background-color:red;"><?php echo JText::_('COM_KUNENA_HIDDEN_USERS'); ?>: </span>
						<br />
						 <?php $hiddenlist = array();
						foreach ($this->hiddenList as $user) {
							$hiddenlist[] = $user->getLink();
						}

						echo implode(', ', $hiddenlist); ?>
					<?php endif; ?>
				</div>
                <br>
                <br>
                <span>Тем:</span><?php echo intval($this->topicCount); ?><span> </span>
                <span>Сообщений:</span><?php echo intval($this->messageCount); ?><span> </span>
                <span>Пользователей:</span><?php echo $this->getUserlistLink('', $this->memberCount) ?><span> </span><br>
                <span>Приветствуем нового пользователя: <?php echo $this->latestMemberLink ?></span>
                
                
                
                
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

