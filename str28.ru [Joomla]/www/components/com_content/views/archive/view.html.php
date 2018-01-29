<?php
/**
 * 
 * 
 */

// No direct access
defined('_REXEC') or die;

jimport('retina.application.component.view');

/**
 * HTML View class for the Content component
 *
 * @package		Retina.Site
 * @subpackage	com_content
 * @since 1.5
 */
class ContentViewArchive extends JView
{
	protected $state = null;
	protected $element = null;
	protected $elements = null;
	protected $pagination = null;

	function display($tpl = null)
	{
		$app = JFactory::getApplication();
		$user		= JFactory::getUser();

		$state 		= $this->get('State');
		$elements 		= $this->get('elements');
		$pagination	= $this->get('Pagination');

		$pathway	= $app->getPathway();
		$document	= JFactory::getDocument();

		// Get the page/component configuration
		$params = &$state->params;

		foreach ($elements as $element)
		{
			$element->catslug = ($element->category_alias) ? ($element->catid . ':' . $element->category_alias) : $element->catid;
			$element->parent_slug = ($element->parent_alias) ? ($element->parent_id . ':' . $element->parent_alias) : $element->parent_id;
		}



		$form = new stdClass();
		// Month Field
		$months = array(
			'' => RText::_('COM_CONTENT_MONTH'),
			'01' => RText::_('JANUARY_SHORT'),
			'02' => RText::_('FEBRUARY_SHORT'),
			'03' => RText::_('MARCH_SHORT'),
			'04' => RText::_('APRIL_SHORT'),
			'05' => RText::_('MAY_SHORT'),
			'06' => RText::_('JUNE_SHORT'),
			'07' => RText::_('JULY_SHORT'),
			'08' => RText::_('AUGUST_SHORT'),
			'09' => RText::_('SEPTEMBER_SHORT'),
			'10' => RText::_('OCTOBER_SHORT'),
			'11' => RText::_('NOVEMBER_SHORT'),
			'12' => RText::_('DECEMBER_SHORT')
		);
		$form->monthField = JHtml::_(
			'select.genericlist',
			$months,
			'month',
			array(
				'list.attr' => 'size="1" class="inputbox"',
				'list.select' => $state->get('filter.month'),
				'option.key' => null
			)
		);
		// Year Field
		$years = array();
		$years[] = JHtml::_('select.option', null, RText::_('JYEAR'));
		for ($i = 2000; $i <= 2020; $i++) {
			$years[] = JHtml::_('select.option', $i, $i);
		}
		$form->yearField = JHtml::_(
			'select.genericlist',
			$years,
			'year',
			array('list.attr' => 'size="1" class="inputbox"', 'list.select' => $state->get('filter.year'))
		);
		$form->limitField = $pagination->getLimitBox();

		//Escape strings for HTML output
		$this->pageclass_sfx = htmlspecialchars($params->get('pageclass_sfx'));

		$this->assign('filter', $state->get('list.filter'));
		$this->assignRef('form', $form);
		$this->assignRef('elements', $elements);
		$this->assignRef('params', $params);
		$this->assignRef('user', $user);
		$this->assignRef('pagination', $pagination);

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
		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		} else {
			$this->params->def('page_heading', RText::_('RGLOBAL_ARTICLES'));
		}

		$title = $this->params->get('page_title', '');
		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = RText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = RText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}
}
?>
