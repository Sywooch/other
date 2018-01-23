<?php
// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class faqlsController extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		// Set a default view if none exists
		if ( ! JRequest::getCmd( 'view' ) ) {
			JRequest::setVar('view', 'category' );
		}

		$layout =  JRequest::getCmd( 'layout' );

		if ($layout == 'form') {
			JError::raiseError( 404, JText::_("Resource Not Found") );
			return;
		}

		$view = JRequest::getVar('view');

		parent::display(true);
	}
	
	
	function addquestion()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$protecttime = $this->_protect($ip);

		if ($protecttime == 'OK') {
			$form = require_once( JPATH_COMPONENT.DS.'views'.DS.'category'.DS.'tmpl'.DS.'form.php' );
		} else { 
			$protecttime =  JHTML::_('date',  $protecttime,  '%d-%m-%Y '. JText::_('in'). '<strong> %H:%M </strong>' );
			echo '<div id="prot">'.JText::_('NEXT_QUESTION').' '.$protecttime.'</div>';
		}
	}
	
	function _protect($ip)
	{
		$app = JFactory::getApplication();
		$db		=& JFactory::getDBO();
		$datenow =& JFactory::getDate();
		$date_now = $datenow->toMySQL();
		$params = $app->getParams();
		$protectInterval = $params->get('prot_time', 0);
		
		$query = "SELECT DATE_ADD(created, INTERVAL " . $protectInterval . " MINUTE)". 
				"\nFROM #__faql ".
			    "\nWHERE ip = '$ip' ".
				"\nORDER BY created desc";
				
		$db->setQuery( $query );
		$protecttime = $db->loadResult();
		if ($date_now > $protecttime ) {
			$protecttime = 'OK';
		} else {
		}
			
		return $protecttime;
	}
	
	function sendquest()
	{
		/* For debug */
		/*$res['valid'] = true;
		$res['msg'] = JRequest::getVar('idadm'); // OK msg
		$res['items'] = array(); //Err msg
		echo json_encode($res);
		return;*/
		
		$app = JFactory::getApplication();
		$userfaql = $app->getUserState('com_faql.userfaql'); // To take permissions of the user for com_faql
		$adm_par = $app->getUserState('com_faql.adm_par'); // Id managers
		
		$user = & JFactory::getUser();
		$res['valid'] = false;
		$res['msg'] = '';
		$res['items'] = array();
		$res['reload'] = true;
		$ip = $_SERVER['REMOTE_ADDR'];
		$Validname = true;
		$Validemail = true;
		$Validquestion = true;
		$Validcaptcha = true;
		$Validmanager = true;
		
		$params = &$app->getParams();

		// Check captcha
		if (($params->get('show_captcha') == 1 AND $userfaql->get('guest')) OR ($params->get('show_captcha') == 2 AND !$userfaql->get('manager') AND !$userfaql->get('SuperUser'))) {
			$captcha = JRequest::getVar('captcha');
			if ($captcha !== $_SESSION['captcha-code']) {
				$res['items'][] = array('name' => 'captcha', 'status' => 0, 'msg' => JText::_('WRONG_CAPTCHA'));
				$Validcaptcha = false;
			} else {
				$res['items'][] = array('name' => 'captcha', 'status' => 1);
			}
		}
		
		// Check question
		$question = JRequest::getVar('question');
		if(strlen($question) < 5 ) {
			$res['items'][] = array('name' => 'question', 'status' => 0, 'msg' => JText::_('WRONG_QUESTION'));
			$Validquestion = false;
		} else {
			$res['items'][] = array('name' => 'question', 'status' => 1);
		}
		
		// Check whom
		$adm = JRequest::getVar('idadm');
		if ($adm == 0) {
			$res['items'][] = array('name' => 'idadm', 'status' => 0, 'msg' => JText::_('NOADMIN'));
			$Validmanager = false;
		} else {
			$res['items'][] = array('name' => 'idadm', 'status' => 1);
		}
		
		// Check email and name
		if ($userfaql->get('guest')) {
			// Check email
			$email = JRequest::getVar('email');
			$send_mail = JRequest::getVar( 'send_mail', 0);
			if ($send_mail) {
				$email = trim($email);
				if(strlen($email) < 4 || !preg_match('#^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$#i', $email)) {
				  $res['items'][] = array('name' => 'email', 'status' => 0, 'msg' => JText::_('WRONG_EMAIL'));
				  $Validemail = false;
				} else {
				  $res['items'][] = array('name' => 'email', 'status' => 1);
				}
			}
			// Check name
			$name = JRequest::getVar('created_by');
			if (preg_match('/[\"\'\[\]\=\<\>\(\)\;]+/', $name ) || (strlen($name) < 3 )) {
				$res['items'][] = array('name' => 'created_by', 'status' => 0, 'msg' => JText::_('WRONG_NAME'));
				//$res['items'][] = array('name' => 'created_by', 'status' => 0, 'msg' => $send_mail);
				$Validname = false;
			} else {
				$res['items'][] = array('name' => 'created_by', 'status' => 1);
			}
		}
	  
		if ($Validname && $Validemail &&  $Validquestion && $Validcaptcha && $Validmanager) {
			$model = $this->getModel('faql');
			$post = JRequest::get('post');
			$post['ip'] = $ip;
		  
			$send_mail = JRequest::getVar( 'send_mail', 0);
			if ($send_mail) $post['send_mail'] = $send_mail;

			if ($model->store($post)) {
				$res['valid'] = true;
				if ($adm == -1) {
					foreach ($adm_par as $ad) {
						$this->_sendMail($ad); // send mail to all managers
					}
				}
				else {
					$this->_sendMail($adm); // send mail to manager
				}
				if ($send_mail) {
					$res['msg'] = JText::_('FORM_SEND_OK_SUB');
				} else {
					$res['msg'] = JText::_('FORM_SEND_OK');
				}
			} else {
				$res['msg'] = $model->getError();
			}
		}
		
		echo json_encode($res);
    }

	function _sendMail($adm)
	{
		require_once(JPATH_COMPONENT.DS.'helpers'.DS.'route.php');
		$app = JFactory::getApplication();

		$db		=& JFactory::getDBO();
		
		$datenow =& JFactory::getDate();
		$name = JRequest::getVar( 'created_by', '', 'post' );
		$question = JRequest::getVar( 'question', '', 'post' );
		$catid = JRequest::getVar( 'catid', 0, '', 'int');
		
		$query = 'SELECT title' .
				' FROM #__categories' .
				' WHERE id = '. (int) $catid;
		$db->setQuery( $query );
		$cattitle = $db->loadResult();
		
		$sitename = $app->getCfg( 'sitename' );
		$mailfrom = $app->getCfg( 'mailfrom' );
		$fromname = $app->getCfg( 'fromname' );
		$subject = JText::_( 'NEW_QUESTION' ). " (" . JText::_( 'JCATEGORY' ). " - " .$cattitle . " )";
		$created = JHTML::date($datenow->toMySQL(),  'd-m-Y H:i:s' );
		$message = JText::_( 'ASKER' ). ': ' . $name . "\n" . JText::_( 'DATE' ). ': ' . $created;
		$message .= "\n\n". JText::_( 'QUESTION' ). ": \n" . $question;
		$message .= "\n\n". JURI::root().faqlsHelperRoute::getCategoryRoute($catid);
		
		$query = 'SELECT email, sendEmail' .
				' FROM #__users WHERE id='.$adm;
		$db->setQuery( $query );
		$rows = $db->loadObject();
				
		// Send email to manager
		if ($rows->sendEmail)
		{
			JUtility::sendMail($mailfrom, $fromname, $rows->email, $subject, $message);
		}
		
		return true;
	}

	function captcha()
	{
		  require_once(JPATH_COMPONENT.DS.'helpers'.DS.'captcha.php');
		  faqlsHelperCaptcha::image();
	}
	
	function sendsort()
	{
		$sortval = JRequest::getVar('sortq');
		$idcat = JRequest::getVar('idcat');
		$model = $this->getModel('category');
		$model->getGlobalSort($sortval, $idcat); // set GlobalSort
		$referer = JRequest::getString('ret',  base64_encode(JURI::base()), 'post');
		$referer = base64_decode($referer);
		$this->setRedirect($referer);
		
		echo $referer;
	}
	
}
