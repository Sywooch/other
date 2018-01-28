<?php
/**
 * error404 model pour composant error404
 *
 * @package    Error404
 * @subpackage Components
 * components/com_error404/error404.php
 * @link http://www.cdprof.com
 * @license    GNU/GPL
 */

// No direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

/**
 * error404 Model
 *
 * @package    error404
 * @subpackage Components
 */
class error404Modelerror404 extends JModel
{
	/**
	 * affiche une page 404 et envoie un mail
	 */

	function connectCdprof()
	{
		// Connection to database
		$db	   =& JFactory::getDBO();
		return $db;
	}
	

	function getChaine($db)
	{
	//searching for the keywords for which not to send an email with the error
		$query = 'SELECT * FROM #__error404';
		$test=$db->SetQuery( $query );
		$chaine = $db->loadAssocList();
		return $chaine;
	}
	
	function envoi_mail($chaine,$to,$sujet,$from)
	{
	$referer=(isset($_SERVER['HTTP_REFERER']))?$_SERVER['HTTP_REFERER']:"";
	$uri=$_SERVER['REQUEST_URI'];
	$user_agent=$_SERVER['HTTP_USER_AGENT'];
	$remote_addr=$_SERVER['REMOTE_ADDR'];
	$host=$_SERVER["HTTP_HOST"];
	$envoyer="oui";
	
	foreach ($chaine as $value)
		{
		switch ($value['type'])
			{
			case 1://we look for the keyword in the uri
				if (strpos($uri,$value['chaine'])!==FALSE) {$envoyer="non";}
			break;
			case 2://we look for the keyword in the referrer
				if (strpos($referer,$value['chaine'])!==FALSE) {$envoyer="non";}
			break;
			case 3;//we look for the keyword in the user_agent
				if (strpos($user_agent,$value['chaine'])!==FALSE) {$envoyer="non";}
			break;
			default://by default we send mail
			}
		}
			
			
	
	if ($envoyer=="oui") //if sending is "yes"
		{
		$mailer =& JFactory::getMailer();
		$mailer->addRecipient($to);
		$mailer->setSubject($sujet);
				
		$referer=($referer=="")?JTEXT::_("COM_ERROR404_PAGE_INCONNUE"):"<a href='$referer'>$referer</a>";
		$message=JTEXT::_("COM_ERROR404_INTRO_MAIL")." ".$host." :<br /><a href=\"http://$host$uri\">$host$uri</a><br /><br />";
		$message.=JTEXT::_("COM_ERROR404_DETAILS_UTILISATEUR")." :";
		$message.="<br />user_agent :<br /> ".$user_agent."<br />Remote adress :<br />".$remote_addr."<br /><br />";
		$message.=JTEXT::_("COM_ERROR404_PAGE_ERREUR")." : <br />".$referer."<br />";
		$message.=JTEXT::_("COM_ERROR404_FIN_MESSAGE");
		//$headers  = "MIME-Version: 1.0\r\n";
		//$headers .= "content-type: text/html; charset=iso-8859-1\r\n";
		$mailer->isHTML(true);
		$mailer->setBody($message);
		
		if ($from!="")
		{
			$mailer->setSender($from);
		}
		$test =& $mailer->Send();
		
		//$test=mail($to,$sujet,$message,$headers);
		$texte=($test==TRUE)?JTEXT::_("COM_ERROR404_MESSAGE_ENVOYE"):JTEXT::_("COM_ERROR404_PB_MAIL_PAS_ENVOYE");
		}
	else {
		$texte=JTEXT::_("COM_ERROR404_ERREUR_PAS_MAIL");
		}
	return $texte;
	}

}