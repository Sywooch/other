<?php
/**
 * @package   error404
 * @subpackage Components
 * components/com_error404/error404.php
 * @link http://www.cdprof.com
 * @license    GNU/GPL
 */

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the error404 Component
 *
 * @package    error404
 */

class error404Viewerror404 extends JView
{
	

	
	function display($tpl = null)
	{
		$model =& $this->getModel();
		$db = $model->connectCdprof();
		$app=&JFactory::getApplication('site');
        $params = &$app->getParams('com_error404');	
		$to=$params->get('destinataire_mail');
		$sujet=$params->get('objet_mail');
		$site_web=$params->get('site_web');
		$afficher_web=$params->get('afficher_web');
		$send_mail=$params->get('send_mail');
		$use_google_search=$params->get('use_google_search');
		$texte_erreur=$params->get('texte_erreur');
		$from=$params->get('expediteur_mail');
		$titre_page=$params->get('titre_page');
		$rediriger_accueil=$params->get('rediriger_accueil');
		$chaine = $model->getChaine($db);
		JPluginHelper::importPlugin( 'error404' );
		$dispatcher =& JDispatcher::getInstance();
		$results = $dispatcher->trigger( 'onBeforeMail');
		$doc =& JFactory::getDocument();
		$doc->setMetaData('robots', 'noindex, nofollow');	
		$doc->setTitle($titre_page);
		if ($rediriger_accueil=="0")
			{
			$app = &JFactory::getApplication();
			$app->redirect($site_web);
			}
		
		if ($send_mail=="0")
			{
			$texte = $model->envoi_mail($chaine,$to,$sujet,$from);
			}
		else { $texte="Sending mail not activated in parameters";}
		
		$this->assignRef( 'texte', $texte );
		$this->assignRef( 'site_web', $site_web);
		$this->assignRef( 'to', $to );
		$this->assignRef( 'sujet', $sujet );
		$this->assignRef( 'use_google_search', $use_google_search );
		$this->assignRef( 'texte_erreur', $texte_erreur );
		$this->assignRef( 'afficher_web',$afficher_web);

		parent::display($tpl);
	}
}
