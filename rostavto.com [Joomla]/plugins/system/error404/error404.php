<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * redirection vers com_error404 plugin
 */
class plgSystemError404 extends JPlugin
{

/**
	 * Object Constructor.
	 *
	 * @access	public
	 * @param	object	The object to observe -- event dispatcher.
	 * @param	object	The configuration object for the plugin.
	 * @return	void
	 * @since	1.0
	 */
	function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);

		// Set the error handler for E_ERROR to be the class handleError method.
		JError::setErrorHandling(E_ERROR, 'callback', array('plgSystemError404', 'handleError'));
		//$redirect=$this->params->get('redirection');
	}
	
static function handleError(&$error)
	{
		// Get the application object.
		$app = JFactory::getApplication();	
		jimport( 'joomla.html.parameter' );
		$plugin = & JPluginHelper::getPlugin('system', 'error404');
 		$pluginParams = new JParameter($plugin->params);
		
		$redirect=$pluginParams->get('redirection');

		// Make sure the error is a 404 and we are not in the administrator.
		if (!$app->isAdmin() and ($error->getCode() == 404))
		{
			// Get the full current URI.
			$uri = JURI::getInstance();
			$base = JURI::base();
			$current = $uri->toString(array('scheme', 'host', 'port', 'path', 'query', 'fragment'));
			$url=$base."index.php?option=com_error404&view=error404&uri=".$current;
			// Attempt to ignore idiots.
			if ((strpos($current, 'mosConfig_') !== false) || (strpos($current, '=http://') !== false)) {
				// Render the error page.
				$app->redirect($url);
			}

			// See if the current url exists in the database as a redirect.
			if ($redirect==1)
				{
				$db = JFactory::getDBO();
				$db->setQuery(
					'SELECT `new_url`, `published`' .
					' FROM `#__redirect_links`' .
					' WHERE `old_url` = '.$db->quote($current),
					0, 1
					);
				$link = $db->loadObject();

				// If a redirect exists and is published, permanently redirect.
				if ($link and ($link->published == 1)) {
					$app->redirect($link->new_url, null, null, true, false);
				}
				else
					{
					$referer = empty($_SERVER['HTTP_REFERER']) ? '' : $_SERVER['HTTP_REFERER'];

					// If not, add the new url to the database.
					$db->setQuery(
						'INSERT IGNORE INTO `#__redirect_links` (`old_url`, `referer`, `published`, `created_date`)' .
						' VALUES ('.$db->Quote($current).', '.$db->Quote($referer).', 0, '.$db->Quote(JFactory::getDate()->toMySQL()).')'
					);
					$db->query();

					// Render the error page.
					$app->redirect($url);
				}
				}
			else {
				// Render the error page.
					$app->redirect($url);
				}
			}
		else {
			// Render the error page.
			JError::customErrorPage($error);
			
			//$app->redirect($url);
		}
	}
	
function onAfterRoute()
	{
		$app = JFactory::getApplication();
		
		// No need in admin panel
	    if( $app->isAdmin() ) return;
					
		$option=JREQUEST::getVar("option",null,"REQUEST");
		$view=JREQUEST::getVar("view",null,"REQUEST");
		$Itemid=JREQUEST::getVar("Itemid",null,"REQUEST");
		$task=JREQUEST::getVar("task",null,"REQUEST");
		$id=JREQUEST::getVar("id",null,"GET");
		$do=JREQUEST::getVar("do",null,"REQUEST");
		$layout=JREQUEST::getVar("layout",null,"REQUEST");
		//$func_kunena=JREQUEST::getVar("func",null,"GET");
		$route=&JRouter::getInstance("site");	
		$uri=& JURI::getInstance();
		$path=$uri->getPath();			
		$mode=$route->getMode();
		$count="";
		
		if ($mode!="1")
		{
		//pas de mode SEF
		// We verify in database that article exists and that it is published
		if ($option=="com_content" && $view=="article" && $id!="")
		{
		$id=explode(':',$id,2);
		$id=$id[0];
		$db =& JFactory::getDBO();
 		$query = "SELECT COUNT(*) FROM #__content WHERE id = $id and (state=1 or state='-1') and (publish_down>NOW() OR publish_down='0000-00-00 00:00:00')";
		$db->setQuery($query);
		$count = $db->loadResult();
		}
		
		if ($option=="com_kunena" && $do!="") {return;}
		if ($option=="com_camelcitycontent") {return;}
		if (($option=="com_content") && $view=="frontpage" && $Itemid==1 && !isset($_SERVER['REDIRECT_URL']) && $mode=="1") {return;}
	    if (($option=="com_content") && $view=="frontpage" && $Itemid==1 && $_SERVER['SCRIPT_FILENAME']==JPATH_BASE."/index.php" && $mode=="0" && !isset($_SERVER['REDIRECT_URL'])) {return;}
	   	if (($option=="com_content") && $view=="article" && $layout=="form") {return;}
		if ($view=="article" && $task=="edit") {return;}
		if ($task=="save" or $task=="cancel"){return;}
		
	   	if ($path=="/index2.php" or $task=="login" or $task=="logout") {return;}		
		$result_error404=JComponentHelper::getComponent("com_error404");

		//we test if com_error404 is enabled
		if ($result_error404->enabled==1)
		{				
			//we verify if the component in the query string is enabled
			$component=JComponentHelper::getComponent($option,true);

		if (($component->enabled!=1 and $option!="") or (strpos($_SERVER['REQUEST_URI'],'index.php')===false and $_SERVER['REQUEST_URI']!="/") or ($option=="com_content" and $view=="article" and $count!="1" ))
					{
					JREQUEST::setVar("option","com_error404");
					JREQUEST::setVar("uri",$_SERVER['REQUEST_URI']);
					JREQUEST::setVar("view","error404");	
					}
		}
			
		}
	}
		
}

