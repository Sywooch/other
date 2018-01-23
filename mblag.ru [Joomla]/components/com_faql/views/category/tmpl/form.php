<?php defined('_JEXEC') or die;
$app = JFactory::getApplication();
$params = &$app->getParams();
$adm_par = $app->getUserState('com_faql.adm_par'); // Id managers
$userfaql = $app->getUserState('com_faql.userfaql'); // To take permissions of the user for com_faql

$baseurl = JURI::root();
?>
<?php // css ?>
<link rel="stylesheet" href="<?php echo $baseurl.'components/com_faql/css/faql.css'; ?>" type="text/css">
<?php // script ?>
<script src="/media/system/js/core.js" type="text/javascript"></script>
<script src="/media/system/js/mootools-core.js" type="text/javascript"></script>
<script src="/media/system/js/mootools-more.js" type="text/javascript"></script>
<script src="<?php echo $baseurl.'components/com_faql/js/addform.js'; ?>" type="text/javascript"></script>

	<form action="#" name="QuestionForm" id="QuestionForm" method="post" >
	<div id="titleform">
		<h3><?php echo JText::_('TITLE_FORM'); ?></h3>
	</div>
	<div id="box"></div>
		<?php if ($userfaql->get('guest')) { ?>
			<div class="created_name">
				<?php echo JText::_( 'NAME' ); ?>:
			</div>
			<input type="text" id="created_by" name="created_by" size="40" maxlength="50" />
			<div class="clr"></div>

			<div class="send_email">
				<input type="checkbox" name="send_mail" id="flemail" value="1" checked="checked" onclick = "faqlNoSend(this);" /><?php echo JText::_('SEND_MAIL'); ?>
			</div>
			<div id="created_email">
				<div class="created_name">
					<?php echo JText::_( 'EMAIL' ).':'; ?>
				</div>
				<input type="text" id="email" name="email" size="40" maxlength="50" />
			</div>
			<div class="clr"></div>
		<?php }  ?>

	<div>	
		<div class ="quest">
			<label for="question">
				<?php echo JText::_( 'QUESTION' ); ?>:
			</label>
			<br />
			<textarea id="question" rows="5" name="question"></textarea>
			<br />
			<?php echo JText::_( 'SYMBOL_ADD' ); ?>:<input type="text" id="t1"  size="4" maxlength="4" disabled="false">
		</div>
		
		<div class="quest_adm">
			<?php echo JText::_( 'WHOM' ); ?>
			<br />
			<?php 
				echo '<select name="idadm" id="idadm">';
				echo '<option value="0">'.JText::_('CHOOSE_MANAGER').'</option>';
				foreach ($adm_par as $us) {
					$userid = $us;
					$user1 = &JFactory::getUser($userid);
					$username = $user1->name;
					$dis = '';
					$sel = '';
					if (count($adm_par) == 1) {
						$dis = 'disabled';
						$sel = ' selected';
					}
					echo '<option '.$dis.$sel.' value="'.$userid.'">'.$username.'</option>';
				}
				if (count($adm_par) > 1) echo '<option value="-1">'.JText::_('ALL_MANAGER').'</option>';
				echo "</select>";

			?>
		</div>

		<div class="clr"></div>
		
		<br />
	   <?php if (($params->get('show_captcha') == 1 AND $userfaql->get('guest')) OR ($params->get('show_captcha') == 2 AND !$userfaql->get('manager') AND !$userfaql->get('SuperUser'))) { ?>
			<img style="float:left;" class="captcha" id="captchaimg" src="index.php?option=com_faql&amp;task=captcha&amp;format=row&amp;ac=11" width="120" height="60" alt="<?php echo JText::_('FORM_CAPTCHA'); ?>" />
			<a id="updatecaptcha" href="#">
			<img src="<?php echo $baseurl.'media/com_faql/images/site/update.png'; ?>" title="<?php echo JText::_('FORM_CAPTCHA_REFRESH'); ?>" alt="<?php echo JText::_('FORM_CAPTCHA_REFRESH'); ?>" border="0">
			</a>
			<br style="clear:both;" /><br />
			<input class="captcha" id="captcha" type="text" name="captcha" value="" size="10" />
			<span><?php echo JText::_('INPUT_CAPTCHA'); ?></span><br /><br />
		<?php } ?>
	</div>
	
	<input type="submit" value="<?php echo JText::_('SEND'); ?>" class="sendbutton" />
	<button id="cancel" type="button" ><?php echo JText::_('CANCEL') ?></button>
	<input type="hidden" name="catid" value="<?php echo JRequest::getInt('catid'); ?>" />
	<input type="hidden" name="id_group" value="<?php echo JRequest::getInt('id_group'); ?>" />
	<input type="hidden" name="Itemid" value="<?php echo JRequest::getInt('Itemid'); ?>" />
	<input type="hidden" name="id" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>
