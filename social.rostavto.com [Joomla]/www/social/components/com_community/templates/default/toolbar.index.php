<?php
/**
* @copyright (C) 2013 iJoomla, Inc. - All rights reserved.
* @license GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
* @author iJoomla.com <webmaster@ijoomla.com>
* @url https://www.jomsocial.com/license-agreement
* The PHP code portions are distributed under the GPL license. If not otherwise stated, all images, manuals, cascading style sheets, and included JavaScript *are NOT GPL, and are released under the IJOOMLA Proprietary Use License v1.0
* More info at https://www.jomsocial.com/license-agreement
*/
defined('_JEXEC') or die();
$viewName = JRequest::getCmd( 'view');
$taskName = JRequest::getCmd( 'task');
// call the auto refresh on specific page
?>

<?php if($showToolbar) : ?>

<style type="text/css">
	/*@TEMPORARY*/
	#community-wrap .row-fluid [class*="span"] {
		float: left;
	}

.menu_number_4{

display:none;

}
.menu_number_5{

display:none;

}
.menu_number_6{

display:none;

}
.menu_number_7{

display:none;

}

.nav li a {

color:#5e0b00 !important;
}


.dropdown-menu li a: hover{

color:white !important;

}

.nav li a .dropdown-menu:hover{

color:white !important;

}


</style>

<div class="navbar js-toolbar">
  <div class="navbar-inner"  style="background-color:transparent; border:1px solid #FBFBC4; border-radius:10px; box-shadow:0 0px 3px #999; 
background-image:url('/images/avto/user_menu_1.png'); ">
      <a class="btn btn-navbar js-bar-collapse-btn">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
    
    
    
    <ul class="nav hidden-desktop" >
        	<li <?php echo $active == 0 ? ' class="active"' :'';?> ><a href="<?php echo CRoute::_( 'index.php?option=com_community&view=frontpage' );?>">
        		<i class="js-icon-home"></i></a>
					</li>
					<li>
						<a href="javascript:joms.notifications.showWindow();" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_GLOBAL' );?>">
							<i class="js-icon-globe"></i>
							<?php if( $newEventInviteCount ) { ?>
							<span class="js-counter"><?php echo $newEventInviteCount; ?></span>
							<?php } ?>
						</a>
					</li>

					<li>
						<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=friends&task=pending' );?>" onclick="joms.notifications.showRequest();return false;" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_INVITE_FRIENDS' );?>">
							<i class="js-icon-users"></i>
							<?php if( $newFriendInviteCount ){ ?><span class="js-counter"><?php echo $newFriendInviteCount; ?></span><?php } ?>
						</a>
					</li>

					<li>
						<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=inbox' );?>"  onclick="joms.notifications.showInbox();return false;" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_INBOX' );?>">
							<i class="js-icon-chat"></i>
							<?php if( $newMessageCount ){ ?><span class="js-counter"><?php echo $newMessageCount; ?></span><?php } ?>
						</a>
					</li>
					<li>
						<a href="javascript:void(0);" title="<?php echo JText::_('COM_COMMUNITY_LOGOUT'); ?>" onclick="document.communitylogout2.submit();">
							<i class="js-icon-logout"></i>
						</a>
					<form class="cForm" action="<?php echo JRoute::_('index.php');?>" method="post" name="communitylogout2" id="communitylogout2">
						<input type="hidden" name="option" value="<?php echo COM_USER_NAME ; ?>" />
						<input type="hidden" name="task" value="<?php echo COM_USER_TAKS_LOGOUT ; ?>" />
						<input type="hidden" name="return" value="<?php echo $logoutLink; ?>" />
						<?php echo JHtml::_('form.token'); ?>
					</form>
					</li>
				</ul>

      <div class="nav-collapse collapse js-bar-collapse">



<div style="width:100%; height:50px; background-color:transparent;">	  
        <ul class="nav" style="font-size:11px; font-size:12pt !important; color:#5e0b00;">
     

     <li style="background-color:transparent;" class="<?php echo $active == 0 ? 'active' :'';?> visible-desktop" ><a href="<?php echo CRoute::_( 'index.php?option=com_community&view=frontpage' );?>">
        		<i class="js-icon-home"></i></a>
					</li>

          
          
          
        
					
          
      <?php     

$i_tmp_menu=0;

?>    
          
          <?php
					foreach( $menus as $menu ) {

					$dropdown	= !empty( $menu->childs ) ? 'dropdown' : '';
					$toggle = !empty( $menu->childs ) ? 'class="dropdown-toggle"' : '';
					?>


          
          
					<li style="background-color:transparent;"  class="
<?php    echo   "menu_number_".$i_tmp_menu." "; $i_tmp_menu++; ?>
   <?php echo $active === $menu->item->id ? 'active' : '';?> <?php echo (isset($menu->item->css)) ? $menu->item->css : '' ; ?> <?php echo $dropdown; ?>" >
						<a href="<?php  $link_tmp=CRoute::_( $menu->item->link );  if($link_tmp=="/moi-sobytiya"){   
$user = JFactory::getUser(); 
if (!$user->guest) {

//$tmp_user=$user->username;

$tmp_user=$user->id;
}
else{ $tmp_user=NULL; }; $link_tmp=$link_tmp."/?user=".$tmp_user.""; };   echo $link_tmp; ?>" <?php echo $toggle; ?> ><?php echo JText::_( $menu->item->name );?></a>
						<?php if( !empty($menu->childs) ) { ?>
						<ul class="dropdown-menu">
						<?php
						foreach( $menu->childs as $child ) { ?>
                          <li style="background-color:transparent;" class="<?php echo (isset($child->css)) ? $child->css : ''; ?>">
								<?php if( $child->script ){ ?>
									<a href="javascript:void(0);" onclick="<?php echo $child->link;?>">
								<?php } else { ?>
									<a href="<?php echo CRoute::_( $child->link );?>">
								<?php } ?>
								<?php echo JText::_( $child->name );?></a>
								</li>
								<?php } ?>
						</ul>
						<?php } ?>
					</li>

					<?php
						}
					?>

          
          
          
          
            
          
          
<!--события-->		  
		  <li class=" dropdown">
		  <a href="" class="dropdown-toggle" >События</a> 
		  <ul class="dropdown-menu">
				<li style="background-color:transparent;" class="">
				<a href="/soz-sobytie-n/edit-event">
				Создать событие</a>
				</li>
				<li style="background-color:transparent;" class="">
				<a href="<?php   $link_tmp2="/moi-sobytiya";  
$user = JFactory::getUser(); 
if (!$user->guest) {

$tmp_user=$user->id;
}
else{ $tmp_user=NULL; }; $link_tmp2=$link_tmp2."/?user=".$tmp_user.""; 
echo $link_tmp2;   ?>">
				Мои события</a>
				</li>
								                         
				</ul>
		  </li>
		  
		  
<!--события--> 



<!--истории авто-->   
<li class=" dropdown">
  <a href="" class="dropdown-toggle" >Истории авто</a>
 <ul class="dropdown-menu">
				<li style="background-color:transparent;" class="">
				<a href="/sozdat-istoriyu-avtomobilya?view=dashboard&layout=write">
				Создать историю автомобиля</a>
				</li>
				<li style="background-color:transparent;" class="">
				    <a href="<?php

$user2 = JFactory::getUser(); 
if (!$user2->guest) {

 
  
  
   echo "/istorii-avtomobilej-polzovatelej/blogger/listings/".strtolower($user2->username);
}
else{  }; 


?>">Мои истории авто</a>
				</li>
					

				<li style="background-color:transparent;" class="">
				<a href="/chernoviki?view=dashboard&layout=drafts">
				Черновики</a>
				</li>

			                         
				</ul>
 
</li>
<!--истории авто-->

      
                  
          
		  

<!--сервисные книжки-->  
		     <li  class=" dropdown">
                       <a href="" class="dropdown-toggle" >Сервисные книжки</a>  
              
 <ul class="dropdown-menu">
				<li style="background-color:transparent;" class="">
				<a href="/servisnye-knizhki/post_ad?catid=9">
				Создать сервисную книжку</a>
				</li>
				<li style="background-color:transparent;" class="">
				    <a href="/servisnye-knizhki/my_ads">Мои сервисные книжки</a>
				</li>
					

				

			                         
				</ul>
         
              </li>

<!--сервисные книжки-->		  
		  
          
					

					<li class="visible-desktop" >
						<a class="menu-icon" href="<?php echo CRoute::_( 'index.php?option=com_community&view=friends&task=pending' );?>" onclick="joms.notifications.showRequest();return false;" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_INVITE_FRIENDS' );?>">
							<i class="js-icon-users"></i>
							<?php if( $newFriendInviteCount ){ ?><span class="js-counter"><?php echo $newFriendInviteCount; ?></span><?php } ?>
						</a>
					</li>

					<li class="visible-desktop" >
						<a class="menu-icon" href="<?php echo CRoute::_( 'index.php?option=com_community&view=inbox' );?>"  onclick="joms.notifications.showInbox();return false;" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_INBOX' );?>">
							<i class="js-icon-chat"></i>
							<?php if( $newMessageCount ){ ?><span class="js-counter"><?php echo $newMessageCount; ?></span><?php } ?>
						</a>
					</li>

        </ul>

       
        
        <ul class="nav pull-right" style="background-color:transparent; ">
      
		<li class="visible-desktop" >
		<a href="javascript:void(0);" title="<?php echo JText::_('COM_COMMUNITY_LOGOUT'); ?>" onclick="document.communitylogout.submit();">
		<i class="js-icon-logout" style="float:left;"></i>
		</a>
	    <form class="cForm" action="<?php echo JRoute::_('index.php');?>" method="post" name="communitylogout" id="communitylogout">
		<input type="hidden" name="option" value="<?php echo COM_USER_NAME ; ?>" />
		<input type="hidden" name="task" value="<?php echo COM_USER_TAKS_LOGOUT ; ?>" />
		<input type="hidden" name="return" value="<?php echo $logoutLink; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	    </form>
	    </li>
        </ul>
        
		

		
		
         <ul class="nav pull-right" style="background-color:transparent; ">
           <li class="visible-desktop" style="margin-top:0px; color:#5e0b00; font-size:12pt; float:right; margin-top:17px;" >
                 <?php
$user = JFactory::getUser(); 
if (!$user->guest) {
echo $user->name;
echo" [".$user->username."]";
}
else{  }; ?>
               
               </li>
        </ul>
                
  
</div>



 
  
     
    
	
	
	
	
      </div><!-- /.nav-collapse -->
  </div><!-- /navbar-inner -->
</div>

<?php endif; ?>

<?php if ( $miniheader ) : ?>
	<?php echo @$miniheader; ?>
<?php endif; ?>

<?php if ( !empty( $groupMiniHeader ) ) : ?>
	<?php echo $groupMiniHeader; ?>
<?php endif; ?>

<script>
	joms.jQuery(function() {
		var $collapsible = joms.jQuery('#js-collapse');

		$collapsible.collapse({
	        toggle: false
	    });

	    joms.jQuery('#js-collapse-btn').on('click', 
	        function(){
	            $collapsible.collapse('toggle');
	        }
	    );
	});
</script>
