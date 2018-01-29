<?php
/**
 * 
 * 
 */

// No direct access.
defined('_REXEC') or die;

/**
 * Class to manage the site application pathway.
 *
 * @package		Retina.Site
 * @subpackage	Application
 * @since		1.5
 */
class JPathwaySite extends JPathway
{
	/**
	 * Class constructor.
	 *
	 * @param	array
	 *
	 * @return	JPathwaySite
	 * @since	1.5
	 */
	public function __construct($options = array())
	{
		//Initialise the array.
		$this->_pathway = array();

		$app	= JApplication::getInstance('site');
		$menu	= $app->getMenu();

		if ($element = $menu->getActive()) {
			$menus = $menu->getMenu();
			$home = $menu->getDefault();

			if (is_object($home) && ($element->id != $home->id)) {
				foreach($element->tree as $menupath)
				{
					$url = '';
					$link = $menu->getelement($menupath);

					switch($link->type)
					{
						case 'separator':
							$url = null;
							break;

						case 'url':
							if ((strpos($link->link, 'index.php?') === 0) && (strpos($link->link, 'elementid=') === false)) {
								// If this is an internal retina link, ensure the elementid is set.
								$url = $link->link.'&elementid='.$link->id;
							}
							else {
								$url = $link->link;
							}
							break;

						case 'alias':
							// If this is an alias use the element id stored in the parameters to make the link.
							$url = 'index.php?elementid='.$link->params->get('aliasoptions');
							break;

						default:
							$router = JSite::getRouter();
							if ($router->getMode() == JROUTER_MODE_SEF) {
								$url = 'index.php?elementid='.$link->id;
							}
							else {
								$url .= $link->link.'&elementid='.$link->id;
							}
							break;
					}

					$this->addelement($menus[$menupath]->title, $url);
				}
			}
		}
	}
}
