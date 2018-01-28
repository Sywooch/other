<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 * @subpackage User
 *
 * @copyright (C) 2008 - 2012 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$private = KunenaFactory::getPrivateMessaging();
if ($this->me->userid == $this->user->id) {
	$PMCount = $private->getUnreadCount($this->me->userid);
	$PMlink = $private->getInboxLink($PMCount ? JText::sprintf('COM_KUNENA_PMS_INBOX_NEW', $PMCount) : JText::_('COM_KUNENA_PMS_INBOX'));
} else {
	$PMlink = $this->profile->profileIcon('private');
}
?>
<?php if ($this->avatarlink) : ?>

<?php


require ''.JPATH_ROOT.'/config_db_social/config.php';

$dbh=mysql_connect(DB_SERVER_S,DB_USER_S,DB_PASS_S) or die ("Невозможно соединиться с сервером.");

mysql_select_db(DB_BASE_S) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
			
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


$query_ra="SELECT * FROM avto_users WHERE username='".($this->user->username)."'";

$res_ra=mysql_query($query_ra);
					if($res_ra==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row_ra=mysql_fetch_array($res_ra)){

$id_tmp_ra=$row_ra['id'];
break;
}


$query_avatar="SELECT * FROM avto_community_users WHERE userid='".($id_tmp_ra)."'";

$res_avatar=mysql_query($query_avatar);
					if($res_avatar==false){
	    			echo"Ошибка выполнения запроса.</br>";
					echo mysql_error();
					exit; }

while($row_avatar=mysql_fetch_array($res_avatar)){

$tmp_avatar=$row_avatar['avatar'];
break;
}

if(($tmp_avatar=="")||($tmp_avatar==NULL)){


$tmp_avatar=$this->avatarlink;

}else{

$tmp_avatar=ADRESS_SOCIAL.$tmp_avatar;

//echo $tmp_avatar;

$tmp_avatar='<img class="kavatar" src="'.$tmp_avatar.'" alt="" style="max-width: 200px; max-height: 200px">';
}
  ?>


<div class="kavatar-lg" style="background-color:transparent;"><?php  echo $tmp_avatar;  // echo $this->avatarlink; ?></div>
<?php endif; ?>
<div id="kprofile-stats">
<ul>
	<?php if ( !empty($this->banReason) ) { ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_BANINFO'); ?>:</strong> <?php echo $this->escape($this->banReason); ?></li><?php } ?>
	<li><span class="kicon-button kbuttononline-<?php echo $this->profile->isOnline('yes', 'no') ?>"><span class="online-<?php echo $this->profile->isOnline('yes', 'no') ?>"><span><?php echo $this->profile->isOnline(JText::_('COM_KUNENA_ONLINE'), JText::_('COM_KUNENA_OFFLINE')); ?></span></span></span></li>
	<?php if (!empty($this->usertype)): ?><li class="usertype"><?php echo $this->escape($this->usertype); ?></li><?php endif; ?>
	<?php if (!empty($this->rank_title)): ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_RANK'); ?>: </strong><?php echo $this->escape($this->rank_title); ?></li><?php endif; ?>
	<?php if (!empty($this->rank_image)): ?><li class="kprofile-rank"><?php echo $this->rank_image; ?></li><?php endif; ?>
	<?php if (!empty($this->registerdate)): ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_REGISTERDATE'); ?>:</strong> <span title="<?php echo KunenaDate::getInstance($this->registerdate)->toKunena('ago'); ?>"><?php echo KunenaDate::getInstance($this->registerdate)->toKunena('date_today'); ?></span></li><?php endif; ?>
	<?php if (!empty($this->lastvisitdate)): ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_LASTVISITDATE'); ?>:</strong> <span title="<?php echo KunenaDate::getInstance($this->lastvisitdate)->toKunena('ago'); ?>"><?php echo KunenaDate::getInstance($this->lastvisitdate)->toKunena('date_today'); ?></span></li><?php endif; ?>
	<li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_TIMEZONE'); ?>:</strong> GMT <?php echo $this->localtime->toTimezone(); ?></li>
	<li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_LOCAL_TIME'); ?>:</strong> <?php echo $this->localtime->toKunena('time'); ?></li>
	<?php if (!empty($this->posts)): ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_POSTS'); ?>:</strong> <?php echo intval($this->posts); ?></li><?php endif; ?>
	<?php if (!empty($this->userpoints)): ?><li><strong><?php echo JText::_('COM_KUNENA_AUP_POINTS'); ?></strong> <?php echo intval($this->userpoints); ?></li><?php endif; ?>
	<?php if (!empty($this->usermedals)) : ?><li><?php foreach ( $this->usermedals as $medal ) : echo $medal,' '; endforeach ?></li><?php endif ?>
	<li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_PROFILEVIEW'); ?>:</strong> <?php echo intval($this->profile->uhits); ?></li>
	<li><?php echo $this->displayKarma(); ?></li>
	<?php if ($PMlink) {
			?>
	<li><?php echo $PMlink; ?></li>
	<?php  } ?>
	<?php if( !empty($this->personalText) ) { ?><li><strong><?php echo JText::_('COM_KUNENA_MYPROFILE_ABOUTME'); ?>:</strong> <?php echo KunenaHtmlParser::parseText($this->personalText); ?></li><?php } ?>
</ul>
</div>