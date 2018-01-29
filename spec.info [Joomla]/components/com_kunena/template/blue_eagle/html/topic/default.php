<?php
/**
 * Kunena Component
 * @package Kunena.Template.Blue_Eagle
 * @subpackage Topic
 *
 * @copyright (C) 2008 - 2014 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>
<?php
$this->document->addScriptDeclaration('// <![CDATA[
var kunena_anonymous_name = "'.JText::_('COM_KUNENA_USERNAME_ANONYMOUS', true).'";
// ]]>');
?>


<div style="width:100%; text-align:center;" class="banners1_1">
<img src="/images/banners/001.png" alt="" title="">

</div>

<?php if ($this->category->headerdesc) : ?>
	<div id="kforum-head" class="<?php echo isset ( $this->category->class_sfx ) ? ' kforum-headerdesc' . $this->escape($this->category->class_sfx) : '' ?>">
		<?php echo KunenaHtmlParser::parseBBCode ( $this->category->headerdesc ) ?>
	</div>
<?php endif ?>

<?php
	$this->displayPoll();
	$this->displayModulePosition( 'kunena_poll' );
	$this->displayTopicActions();
?>


<style type="text/css">
#Kunena div.kblock{
border-width:0px !important;	
}

</style>



<div class="kheader topic1">
		<span><?php echo JText::_('COM_KUNENA_TOPIC') ?> <?php echo $this->escape($this->topic->subject) ?></span>
		<?php $this->displayModulePosition( 'kunena_topictitle' ); ?>
		<?php if ($this->usertopic->favorite) : ?><div class="kfavorite"></div><?php endif ?>
		<?php if (!empty($this->keywords)) : ?><div class="kkeywords"><?php echo JText::sprintf('COM_KUNENA_TOPIC_TAGS', $this->escape($this->keywords)) ?></div><?php endif ?>
	</div>





<div class="kblock">
	
	<div class="kcontainer">
		<div class="kbody">
        
		<?php $this->displayMessages() ?>

        
        </div>
	</div>
</div>
<?php $this->displayTopicActions(); ?>

<div class="kcontainer klist-bottom">
	<div class="kbody">
		<div class="kmoderatorslist-jump fltrt">
				<?php $this->displayForumJump (); ?>
		</div>
		<?php if (!empty ( $this->moderators ) ) : ?>
		<div class="klist-moderators">
				<?php
				echo '' . JText::_('COM_KUNENA_MODERATORS') . ": ";
				$modlinks = array();
				foreach ( $this->moderators as $moderator) {
					$modlinks[] = $moderator->getLink ();
				}
				echo implode(', ', $modlinks);
				?>
		</div>
		<?php endif; ?>
	</div>
</div>




<div class="kblock kwhoisonline" style="border: 1px #c3c3c3 solid !important; ">
	
    <div class="kheader" style="border-bottom-width:0px !important;">
	<span class="ktoggler" ><a class="ktoggler close" title="Свернуть" rel="kwhoisonline"></a></span>
	<h2><span><span class="ktitle km">Быстрый ответ</span></span></h2>
    </div>
    
    
    
	<div class="kcontainer" id="kwhoisonline">
	
    <!-------------------------------->
    
    <form action="/forum" method="post" class="postform form-validate" id="postform" name="postform" enctype="multipart/form-data" onsubmit="return myValidate(this);">
	<input type="hidden" name="view" value="topic">
		<input type="hidden" name="task" value="post">
	<input type="hidden" name="parentid" value="18">
			<input type="hidden" name="catid" value="18">
		<input type="hidden" name="ae26c860a3dd83f21f04a10b688dd012" value="1">
<div class="kblock" style="background-color:#fbfbfb; margin-bottom:0px; padding-bottom:20px;">
	<div class="kcontainer">



<table>
<tbody>
<tr id="kpost-message" class="krow1">


	<td class="kcol-last kcol-editor-field" style="border-width:0px; text-align:center;">
		<textarea class="ktxtarea required" name="message" id="kbbcode-message" rows="10" cols="50" tabindex="3" aria-required="true" required="required" aria-invalid="true" style="width:50% !important;  margin-left: auto;
  margin-right: auto;
  float: none;"></textarea>

		<!-- Hidden preview placeholder -->
		<div id="kbbcode-preview" style="display: none;"></div>
			</td>
</tr>


		
		
		
						<tr id="kpost-buttons" class="krow1">
			<td id="kpost-buttons" colspan="2">
				<input type="submit" name="ksubmit" class="kbutton" value=" Отправить быстрый ответ" title="Нажмите, чтобы отправить ваше сообщение" tabindex="4" style="float:none; margin:0; padding:0; margin-left:auto; margin-right:auto; padding-left:10px; padding-right:10px; display:inline-block;">
                
                <input type="button" name="ksubmit" class="kbutton" value="Расширенный режим" title="" tabindex="4" style="float:none; margin:0; padding:0; margin-left:auto; margin-right:auto; padding-left:10px; padding-right:10px; line-height:40px; display:inline-block;">
				
			</td>
		</tr>
	</tbody>
</table>
</div>
</div>

<script type="text/javascript">document.postform.message.focus();</script></form>
  
</form>
  
 	<!------------------------------->   
    
	</div>
</div>


<!----next prev----->
<!--<div style="width:100%; height:50px; background-color:red;"></div>
-->
<!----next prev----->




<?php
$users = KunenaUserHelper::getOnlineUsers();
	///	KunenaUserHelper::loadUsers(array_keys($users));

	$onlineusers = KunenaUserHelper::getOnlineCount();

$all_u=$onlineusers['user']+$onlineusers['guest'];		

		
?>

<div class="kblock kwhoisonline" style="border: 1px #c3c3c3 solid !important; ">
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



<div class="kheader topic1">
		<span>Другие темы раздела</span>
        
</div>




 				
			
        
		



<div class="kblock kcategories-12 topic2" style="border-width:1px !important;">
	<div class="kheader">
    

    
				<span class="ktoggler"><a class="ktoggler close" title="Свернуть" rel="catid_12"></a></span>
				<h2>
                
                
                <span class="hd hd1">Темы</span>
                
                <span class="hd hd2">Автор</span>
                
                <span class="hd hd3">Последнее сообщение</span>
                
                <span class="hd hd4">Ответов</span>
                
                <span class="hd hd5">Просмотров</span>
                
                </h2>
			</div>
	<div class="kcontainer" id="catid_12">
		<div class="kbody">

<table class="kblocktable" id="kcat12">
			<tbody>
            
        <?php
        
        $database->setQuery("SELECT * FROM #__kunena_topics WHERE category_id='".$this->category->id."'");
		$list = $database->loadObjectList();
				
		?>    
		
        <?php
		foreach($list as $user) {
		
		?>
		
			
		
            <tr class="krow2 krow2" id="kcat143">
			
            
            <td class="kcol-first kcol-category-icon hidden-phone" style="width:22% !important; text-align:left;">
                <?php  echo $user->subject; ?>
            </td>
            

			<td class="kcol-mid kcol-kcattitle" style="width:20% !important;">
				<?php  echo $user->first_post_guest_name; ?>
            </td>
            
            
            <td class="kcol-mid kcol-knoposts" style="padding-left:0px !important; width:25% !important;">
            	<?php
				echo "".substr($user->last_post_message, 0, 30)."... ".date( "d-m-Y", $user->last_post_time )." ".date( "H:i", $user->last_post_time )." от ".$user->last_post_guest_name;
				
				?>
            </td>
			
                        
            <td class="kcol-mid kcol-kcattopics hidden-phone" style="width:5% !important;">
				<?php
				echo $user->posts;
				
				?>
            </td>


			<td class="kcol-mid kcol-kcatreplies hidden-phone" style="width:13% !important;">
				<?php
				echo $user->hits;
				?>
            </td>

			
			</tr>
        
        <?php
		}
		
		?>
        
		</tbody></table>
</div>
</div>
</div>
