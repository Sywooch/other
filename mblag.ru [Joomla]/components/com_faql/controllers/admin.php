<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class faqlsControllerAdmin extends faqlsController
{
	function edit()
	{
		$model = $this->getModel('faql');
		
		$user = & JFactory::getUser();
		$uid	= $user->get('id');
		$faql = $model->getTable('faql');
		$faql->load(JRequest::getVar( 'id'));
		// fail if checked out not by 'me'
		if ($faql->isCheckedOut($uid) OR $faql->checked_out == $uid) {
			require_once(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'route.php');
			$app = JFactory::getApplication();
			$app->redirect(JURI::root().faqlsHelperRoute::getCategoryRoute(JRequest::getVar('catid')));
		}
		$model->checkout(); // Set checkout

		parent::display();
	}
	
	function save()	
	{
		//jexit(print_r($this)); For debug
		
		// Protection from a frozen form
		if (!JRequest::getVar( 'idman')) {
			$app = JFactory::getApplication();
			require_once(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'route.php');
			$app->redirect(JURI::root().faqlsHelperRoute::getCategoryRoute(JRequest::getVar('catid')));
		}

		$model = $this->getModel('faql');
		$model->checkin(); // Reset checkout
		$post = JRequest::get('post');
		$post['answer'] = JRequest::getVar('answer', '', 'post', 'string', JREQUEST_ALLOWRAW);

		$emailmuser = JRequest::getVar( 'email', '');
		$published = JRequest::getVar( 'published', 0);
		$state     = JRequest::getVar( 'state', 0);
		$send_mail = JRequest::getVar( 'send_mail', 0);
		$post['send_mail'] = $send_mail;
		
		if (($published == 1) && ($state == 1)){
			// Published and Direct answer
			sendDirAnswer();
			$msg = JText::_( 'DIRECT_ANSWER').'=>'.$emailmuser;
			$referer = JRequest::getString('ret',  base64_encode(JURI::base()), 'get');
			$referer = base64_decode($referer);
			$this->setRedirect($referer, $msg);    
		} elseif ($published == 0 && $state == 1) {
			// No published and Direct answer
			if ($model->store($post)) {
				if ($send_mail == 1 && $state == 1 && $emailmuser){
					sendDirAnswer();
					$msg = JText::_( 'GREETING_SAVED' ).'=>'.JText::_( 'DIRECT_ANSWER').'=>'.$emailmuser;
				}
				else $msg = JText::_( 'GREETING_SAVED' );
				$referer = JRequest::getString('ret',  base64_encode(JURI::base()), 'get');
				$referer = base64_decode($referer);
				$this->setRedirect($referer, $msg);      
			} else {
				$this->setError($model->getError());
				$this->display();    	
			}
		} else {
			if ($model->store($post)) {	
				$msg = JText::_( 'GREETING_SAVED' );
				if ($send_mail == 1 && $published == 1 && $state == 2 && $emailmuser){
					sendUser();
				}
				$referer = JRequest::getString('ret',  base64_encode(JURI::base()), 'get');
				$referer = base64_decode($referer);
				$this->setRedirect($referer, $msg);
			} else {
				$this->setError($model->getError());
				$this->display();
			}
		}		
	}
	
	function cancel()
	{
		// Checkin the weblink
		$model = $this->getModel('faql');
		$model->checkin();

		$referer = JRequest::getString('ret', base64_encode(JURI::base()), 'get');
		$referer = base64_decode($referer);
		if (!JURI::isInternal($referer)) {
			$referer = '';
		}
		$this->setRedirect($referer);
	}

	function delete()
	{
		$user = & JFactory::getUser();
		$model = $this->getModel('faql');
		$uid	= $user->get('id');
		$faql = $model->getTable();
		$faql->load(JRequest::getVar('id'));
		// fail if checked out not by 'me'
		if ($faql->isCheckedOut($uid)) {
			require_once(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'route.php');
			$app = JFactory::getApplication();
			$app->redirect(JURI::root().faqlsHelperRoute::getCategoryRoute(JRequest::getVar('catid')));
		}
		
		$id = JRequest::getVar('id', 0, '', 'int');
		
		$db	= & JFactory::getDBO();
		$query = 'DELETE FROM #__faql' .
				' WHERE id =' . $id;
		$db->setQuery($query);
		
		if (!$db->query()) {
			JError::raiseError( 500, $db->getErrorMsg() );
			return false;
		}
		
		$referer = JRequest::getString('ret',  base64_encode(JURI::base()), 'get');
		$referer = base64_decode($referer);
		$this->setRedirect($referer, JText::_('DELETE_SUCCESSFULLY'));
	}
	
}

	function sendDirAnswer()
	{
		require_once(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'route.php');
		$app = JFactory::getApplication();
		
		$SiteName	= $app->getCfg('sitename');
		$email		= JRequest::getVar( 'email', '' , 'post' );
		$question	= JRequest::getVar( 'question', '' , 'post' );
		$answer = JRequest::getVar( 'answer', '' , 'post' );
		$MailFrom 	= $app->getCfg('mailfrom');
		$FromName 	= $app->getCfg('fromname');
		$catid  	= JRequest::getVar( 'catid', 0, '', 'int');

		$subject	= JText::_( 'ANSWER_QUESTION') . " (". $SiteName . " )";
		$body = JText::_('ON_YOUR_QUESTION');
		$body .= "\n" . $question;
		$body .= "\n\r\n" . JText::_('THE_ANSWER_IS_GIVEN');
		$body .= "\n" . $answer;
		$mail = JFactory::getMailer();
		
		$mail->addRecipient( $email );
		$mail->setSender( array( $MailFrom, $FromName ) );
		$mail->setSubject( $subject );
		$mail->setBody( $body );
		
		$sent = $mail->Send();
	}

	function sendUser()
	{
		require_once(JPATH_COMPONENT_SITE.DS.'helpers'.DS.'route.php');
		$app = JFactory::getApplication();
		
		$SiteName	= $app->getCfg('sitename');
		$email		= JRequest::getVar( 'email', '', 'post' );
		$question	= JRequest::getVar( 'question',	'',	'post' );
		$MailFrom 	= $app->getCfg('mailfrom');
		$FromName 	= $app->getCfg('fromname');
		$catid  	= JRequest::getVar( 'catid', 0, '', 'int');

		$subject	= JText::_( 'ANSWER_QUESTION') . " (". $SiteName . " )";
		$body = JText::_('ON_YOUR_QUESTION');
		$body .= "\n" . $question;
		$body .= "\n\r\n" . JText::_('PUBLISHED_ANSWER');
		$body .= "\n". JURI::root().faqlsHelperRoute::getCategoryRoute($catid);
		$mail = JFactory::getMailer();
		
		$mail->addRecipient( $email );
		$mail->setSender( array( $MailFrom, $FromName ) );
		$mail->setSubject( $subject );
		$mail->setBody( $body );
		
		$sent = $mail->Send();
	}

