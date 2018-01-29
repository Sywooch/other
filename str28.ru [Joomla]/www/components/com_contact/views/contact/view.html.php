<?php
/**
 * @package		Retina.Site
 * @subpackage	com_contact
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');
require_once RPATH_COMPONENT.'/models/category.php';

/**
 * HTML Contact View class for the Contact component
 *
 * @package		Retina.Site
 * @subpackage	com_contact
 * @since 		1.5
 */
class ContactViewContact extends JView
{
	protected $state;
	protected $form;
	protected $element;
	protected $return_page;

	function display($tpl = null)
	{
		// Initialise variables.
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$dispatcher = JDispatcher::getInstance();
		$state		= $this->get('State');
		$element		= $this->get('element');
		$this->form	= $this->get('Form');

		// Get the parameters
		$params = JComponentHelper::getParams('com_contact');

		if ($element) {
			// If we found an element, merge the element parameters
			$params->merge($element->params);

			// Get Category Model data
			$categoryModel = JModel::getInstance('Category', 'ContactModel', array('ignore_request' => true));
			$categoryModel->setState('category.id', $element->catid);
			$categoryModel->setState('list.ordering', 'a.name');
			$categoryModel->setState('list.direction', 'asc');
			$categoryModel->setState('filter.published', 1);

			$contacts = $categoryModel->getelements();
		}

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}

		// check if access is not public
		$groups	= $user->getAuthorisedViewLevels();

		$return = '';

		if ((!in_array($element->access, $groups)) || (!in_array($element->category_access, $groups))) {
			$uri		= JFactory::getURI();
			$return		= (string)$uri;

			JError::raiseWarning(403, RText::_('RERROR_ALERTNOAUTHOR'));
			return;
		}

		$options['category_id']	= $element->catid;
		$options['order by']	= 'a.default_con DESC, a.ordering ASC';


		// Handle email cloaking
		if ($element->email_to && $params->get('show_email')) {
			$element->email_to = JHtml::_('email.cloak', $element->email_to);
		}
			if ($params->get('show_street_address') || $params->get('show_suburb') || $params->get('show_state') || $params->get('show_postcode') || $params->get('show_country')) {
			if (!empty ($element->address) || !empty ($element->suburb) || !empty ($element->state) || !empty ($element->country) || !empty ($element->postcode)) {
				$params->set('address_check', 1);
			}
		}
		else {
			$params->set('address_check', 0);
		}


		// Manage the display mode for contact detail groups
		switch ($params->get('contact_icons'))
		{
			case 1 :
				// text
				$params->set('marker_address',	RText::_('COM_CONTACT_ADDRESS').": ");
				$params->set('marker_email',		RText::_('RGLOBAL_EMAIL').": ");
				$params->set('marker_telephone',	RText::_('COM_CONTACT_TELEPHONE').": ");
				$params->set('marker_fax',		RText::_('COM_CONTACT_FAX').": ");
				$params->set('marker_mobile',		RText::_('COM_CONTACT_MOBILE').": ");
				$params->set('marker_misc',		RText::_('COM_CONTACT_OTHER_INFORMATION').": ");
				$params->set('marker_class',		'jicons-text');
				break;

			case 2 :
				// none
				$params->set('marker_address',	'');
				$params->set('marker_email',		'');
				$params->set('marker_telephone',	'');
				$params->set('marker_mobile',	'');
				$params->set('marker_fax',		'');
				$params->set('marker_misc',		'');
				$params->set('marker_class',		'jicons-none');
				break;

			default :
				// icons
				$image1 = JHtml::_('image', 'contacts/'.$params->get('icon_address', 'con_address.png'), RText::_('COM_CONTACT_ADDRESS').": ", NULL, true);
				$image2 = JHtml::_('image', 'contacts/'.$params->get('icon_email', 'emailButton.png'), RText::_('RGLOBAL_EMAIL').": ", NULL, true);
				$image3 = JHtml::_('image', 'contacts/'.$params->get('icon_telephone', 'con_tel.png'), RText::_('COM_CONTACT_TELEPHONE').": ", NULL, true);
				$image4 = JHtml::_('image', 'contacts/'.$params->get('icon_fax', 'con_fax.png'), RText::_('COM_CONTACT_FAX').": ", NULL, true);
				$image5 = JHtml::_('image', 'contacts/'.$params->get('icon_misc', 'con_info.png'), RText::_('COM_CONTACT_OTHER_INFORMATION').": ", NULL, true);
				$image6 = JHtml::_('image', 'contacts/'.$params->get('icon_mobile', 'con_mobile.png'), RText::_('COM_CONTACT_MOBILE').": ", NULL, true);

				$params->set('marker_address',	$image1);
				$params->set('marker_email',		$image2);
				$params->set('marker_telephone',	$image3);
				$params->set('marker_fax',		$image4);
				$params->set('marker_misc',		$image5);
				$params->set('marker_mobile',		$image6);
				$params->set('marker_class',		'jicons-icons');
				break;
		}

		// Add links to contacts
		if ($params->get('show_contact_list') && count($contacts) > 1) {
			foreach($contacts as &$contact)
			{
				$contact->link = JRoute::_(ContactHelperRoute::getContactRoute($contact->slug, $contact->catid));
			}
			$element->link = JRoute::_(ContactHelperRoute::getContactRoute($element->slug, $element->catid));
		}

		JHtml::_('behavior.formvalidation');

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->assignRef('contact',		$element);
		$this->assignRef('params',		$params);
		$this->assignRef('return',		$return);
		$this->assignRef('state', 		$state);
		$this->assignRef('element', 		$element);
		$this->assignRef('user', 		$user);
		$this->assignRef('contacts', 	$contacts);

		// Override the layout only if this is not the active menu element
		// If it is the active menu element, then the view and element id will match
		$active	= $app->getMenu()->getActive();
		if ((!$active) || ((strpos($active->link, 'view=contact') === false) || (strpos($active->link, '&id=' . (string) $this->element->id) === false))) {
			if ($layout = $params->get('contact_layout')) {
				$this->setLayout($layout);
			}
		}
		elseif (isset($active->query['layout'])) {
			// We need to set the layout in case this is an alternative menu element (with an alternative layout)
			$this->setLayout($active->query['layout']);
		}

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app		= JFactory::getApplication();
		$menus		= $app->getMenu();
		$pathway	= $app->getPathway();
		$title 		= null;

		// Because the application sets a default page title,
		// we need to get it from the menu element itself
		$menu = $menus->getActive();

		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else {
			$this->params->def('page_heading', RText::_('COM_CONTACT_DEFAULT_PAGE_TITLE'));
		}

		$title = $this->params->get('page_title', '');

		$id = (int) @$menu->query['id'];

		// if the menu element does not concern this contact
		if ($menu && ($menu->query['option'] != 'com_contact' || $menu->query['view'] != 'contact' || $id != $this->element->id))
		{

			// If this is not a single contact menu element, set the page title to the contact title
			if ($this->element->name) {
				$title = $this->element->name;
			}
			$path = array(array('title' => $this->contact->name, 'link' => ''));
			$category = JCategories::getInstance('Contact')->get($this->contact->catid);

			while ($category && ($menu->query['option'] != 'com_contact' || $menu->query['view'] == 'contact' || $id != $category->id) && $category->id > 1)
			{
				$path[] = array('title' => $category->title, 'link' => ContactHelperRoute::getCategoryRoute($this->contact->catid));
				$category = $category->getParent();
			}

			$path = array_reverse($path);

			foreach($path as $element)
			{
				$pathway->addelement($element['title'], $element['link']);
			}
		}

		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = RText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = RText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		if (empty($title)) {
			$title = $this->element->name;
		}
		$this->document->setTitle($title);

		if ($this->element->metadesc)
		{
			$this->document->setDescription($this->element->metadesc);
		}
		elseif (!$this->element->metadesc && $this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->element->metakey)
		{
			$this->document->setMetadata('keywords', $this->element->metakey);
		}
		elseif (!$this->element->metakey && $this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}

		$mdata = $this->element->metadata->toArray();

		foreach ($mdata as $k => $v)
		{
			if ($v) {
				$this->document->setMetadata($k, $v);
			}
		}
	}
}
