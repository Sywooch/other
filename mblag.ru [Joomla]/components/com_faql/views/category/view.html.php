<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

jimport( 'joomla.application.component.view');
jimport( 'joomla.user.helper' );

class faqlsViewCategory extends JView
{
	function display( $tpl = null )
	{
		$app = JFactory::getApplication();
		
		JHTML::_( 'behavior.mootools' );
		
		// Initialize some variables
		$document	= JFactory::getDocument();
		$uri 		= JFactory::getURI();
		$pathway	= $app->getPathway();
		$user = JFactory::getUser();
		
		$gr_man = $this->get('GrMan'); // Cet group managers
		// Get array Id managers
		$adm_par = JAccess::getUsersByGroup($gr_man);
		$app->setUserState('com_faql.adm_par', $adm_par); // array Id managers
		
		$userfaql = $this->faqlUser($gr_man);
		$app->setUserState('com_faql.userfaql', $userfaql); // To take permissions of the user for com_faql


		$category = $this->get('category'); // Cet category
		if (!is_object($category)) return;

		$sort = $this->get('GlobalSort'); // Set GlobalSort

		$items = $this->get('data' ); // Get data
		if (!is_array($items)) return;
		
		$catquest = $this->get('CquestAnswer'); // Get count questions and answers in category
		if (!is_array($items)) return;
		
		$total = $this->get('count'); // Get count items
		$pagination = $this->get('Pagination');

		$params = $app->getParams();
		$document->setTitle( $params->get( 'page_title' ) );

		// To develop all or not
		if (!$params->get( 'all_is_opened', 0 )) {
			$script = 
			"window.addEvent('domready', function(){
				var accordion = new Accordion($$('.question'), $$('.answer'), {
					opacity: " . $params->get( 'show_transp', 1 ) . ",
					show : " . $params->get( 'show_first_ans', -1 ) . ",
					alwaysHide : true,
					onActive: function(toggler, element){
					toggler.setStyle('color', '" . $params->get( 'act_color', '#135CAE' ) . "');
					},
					onBackground: function(toggler, element){
					toggler.setStyle('color', '" . $params->get( 'back_color', '#000000' ) . "');
					}	
				}, $('questions'));
			});";
		$document->addScriptDeclaration($script);
		}
		
		$baseurl = JURI::root();
		$document->addStyleSheet($baseurl . "components/com_faql/css/faql.css");

		$this->user = $user;
		$this->params = $params;
		$this->category = $category;
		$this->catquest = $catquest;
		$this->total = $total;
		$this->items = $items;
		$this->pagination = $pagination;
		$this->ret = $uri->toString();
		$this->baseurl = $baseurl;

		parent::display($tpl);
	}
	
	public function faqlUser($gr_man)
	{
		// Compute selected asset permissions.
		$user	= JFactory::getUser();
		// To take permissions of the user for com_faql
		$canDo = new JObject;
		$usgroups = JAccess::getGroupsByUser($user->id);
		array_unshift($usgroups, $user->id * -1);
		if (JAccess::getAssetRules(1)->allow('core.admin', $usgroups)) $canDo->set('SuperUser', 1);
		if (in_array($gr_man, $usgroups)) {
			$asset	= 'com_faql';
			if ($user->authorise('core.edit', $asset)) $canDo->set('faqlEdit', 1);
			if ($user->authorise('core.delete', $asset)) $canDo->set('faqlDelete', 1);
			if ($canDo->get('faqlEdit') OR $canDo->get('faqlDelete')) $canDo->set('manager', 1);
		}
		if ($user->get('guest')) $canDo->set('guest', 1);
				
		return $canDo;
	}
}
