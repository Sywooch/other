<?php
/**
 * @package		EasyBlog
 * @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * EasyBlog is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

require_once (JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php');


/**
* Page break plugin
*
* <b>Usage:</b>
* <code><hr class="system-pagebreak" /></code>
* <code><hr class="system-pagebreak" title="The page title" /></code>
* or
* <code><hr class="system-pagebreak" alt="The first page" /></code>
* or
* <code><hr class="system-pagebreak" title="The page title" alt="The first page" /></code>
* or
* <code><hr class="system-pagebreak" alt="The first page" title="The page title" /></code>
*
*/

jimport( 'joomla.html.pagination' );

class PagebreakPagination extends JPagination
{
	function _buildDataObject()
	{
		// Initialize variables
		$data = new stdClass();

		$data->all	= new JPaginationObject(JText::_('View All'));
		if (!$this->_viewall) {
			$data->all->base	= '0';
			$data->all->link	= JRoute::_("&pagestart=");
		}

		// Set the start and previous data objects
		$data->start	= new JPaginationObject(JText::_('Start'));
		$data->previous	= new JPaginationObject(JText::_('Prev'));

		if ($this->get('pages.current') > 1)
		{
			$page = ($this->get('pages.current') -2) * $this->limit;

			$page = $page == 0 ? '' : $page; //set the empty for removal from route

			$data->start->base	= '0';
			$data->start->link	= JRoute::_("&pagestart=");
			$data->previous->base	= $page;
			$data->previous->link	= JRoute::_("&pagestart=".$page);
		}

		// Set the next and end data objects
		$data->next	= new JPaginationObject(JText::_('Next'));
		$data->end	= new JPaginationObject(JText::_('End'));

		if ($this->get('pages.current') < $this->get('pages.total'))
		{
			$next = $this->get('pages.current') * $this->limit;
			$end  = ($this->get('pages.total') -1) * $this->limit;

			$data->next->base	= $next;
			$data->next->link	= JRoute::_("&pagestart=".$next);
			$data->end->base	= $end;
			$data->end->link	= JRoute::_("&pagestart=".$end);
		}

		$data->pages = array();
		$stop = $this->get('pages.stop');
		for ($i = $this->get('pages.start'); $i <= $stop; $i ++)
		{
			$offset = ($i -1) * $this->limit;

			$offset = $offset == 0 ? '' : $offset;  //set the empty for removal from route

			$data->pages[$i] = new JPaginationObject($i);
			if ($i != $this->get('pages.current') || $this->_viewall)
			{
				$data->pages[$i]->base	= $offset;
				$data->pages[$i]->link	= JRoute::_("&pagestart=".$offset);
			}
		}
		return $data;
	}
}


class plgEasyBlogPagebreak extends JPlugin
{

	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);
		$this->loadLanguage();
	}

    public function onEasyBlogPrepareContent()
	{
	    $args	= func_get_args();
	    $index  = 0;

	    if( count( $args ) > 3 )
	    {
	        $context    = $args[0];
	        $index++;
	    }

		$row    =& $args[ $index ];
		$params =& $args[ $index + 1 ];
		$page   = JRequest::getVar( 'pagestart' );

		// expression to search for
		$regex = '#<hr([^>]*?)class=(\"|\')system-pagebreak(\"|\')([^>]*?)\/*>#iU';

		// Get Plugin info
		$plugin			= JPluginHelper::getPlugin('easyblog', 'pagebreak');

		if( EasyBlogHelper::getJoomlaVersion() >= '3.0' )
		{
			$pluginParams	= new JRegistry( $plugin->params );
		}
		else
		{
			$pluginParams	= new JParameter( $plugin->params );
		}


		$print   = JRequest::getBool('print');
		$showall = JRequest::getBool('showall');

		JPlugin::loadLanguage( 'plg_easyblog_pagebreak', JPATH_ADMINISTRATOR);

		if(!empty($row->intro)){
			$row->content = $row->intro . $row->content;
			$row->intro = '';
		}

		if (!$pluginParams->get('enabled', 1)) {
			$print = true;
		}

		if ($print) {
			$row->content = preg_replace( $regex, '<br />', $row->content );
			return true;
		}

		//simple performance check to determine whether bot should process further
	    if ( strpos( $row->content, 'class="system-pagebreak' ) === false && strpos( $row->content, 'class=\'system-pagebreak' ) === false ) {
			return true;
		}

		$db		= JFactory::getDBO();
	    $view	= JRequest::getCmd('view');
	    $option	= JRequest::getCmd('com_easyblog');

		if(!$page) {
			$page = 0;
		}


		// check whether plugin has been unpublished
		if (!JPluginHelper::isEnabled('easyblog', 'pagebreak') || $params->get( 'intro_only' )|| $params->get( 'popup' ) || ($view != 'entry' && $option != 'com_easyblog')) {
			$row->content = preg_replace( $regex, '', $row->content );
			return;
		}

		// find all instances of plugin and put in $matches
		$matches = array();
		preg_match_all( $regex, $row->content, $matches, PREG_SET_ORDER );

		if (($showall && $pluginParams->get('showall', 1) ))
		{
			$hasToc = $pluginParams->get( 'multipage_toc', 1 );
			if ( $hasToc ) {
				// display TOC
				$page = 1;
				plgEasyBlogPagebreak::plgEasyBlogCreateTOC( $row, $matches, $page );
			} else {
				$row->toc = '';
			}
			$row->content = preg_replace( $regex, '<br/>', $row->content );
			return true;
		}

		// split the text around the plugin
		$text = preg_split( $regex, $row->content );

		// count the number of pages
		$n = count( $text );

		$row->pagebreaktitle = $row->title;

		// we have found at least one plugin, therefore at least 2 pages
		if ($n > 1)
		{
			// Get plugin parameters
			if( EasyBlogHelper::getJoomlaVersion() >= '3.0' )
			{
				$pluginParams	= new JRegistry( $plugin->params );
			}
			else
			{
				$pluginParams	= new JParameter( $plugin->params );
			}

			$title	= $pluginParams->get( 'title', 1 );
			$hasToc = $pluginParams->get( 'multipage_toc', 1 );

			// adds heading or title to <site> Title
			if ( $title )
			{
				if ( $page ) {
					$page_text = $page + 1;
					if ( $page && @$matches[$page-1][2] )
					{
						$attrs = JUtility::parseAttributes($matches[$page-1][0]);

						if ( @$attrs['title'] ) {
							$row->title = $row->title.' - '.$attrs['title'];
						} else {
							$thispage = $page + 1;
							$row->title = $row->title.' - '.JText::_( 'PLG_PAGEBREAK_PAGE' ).' '.$thispage;
						}
					}
				}
			}

			// reset the text, we already hold it in the $text array
			$row->content = '';

			// display TOC
			if ( $hasToc ) {
				plgEasyBlogPagebreak::plgEasyBlogCreateTOC( $row, $matches, $page );
			} else {
				$row->toc = '';
			}

			// traditional mos page navigation
			jimport('joomla.html.pagination');
			// $pageNav = new JPagination( $n, $page, 1 );
			$pageNav = new PagebreakPagination( $n , $page , 1 );

			// page counter
			$row->content .= '<div class="page-current">';
			$row->content .= $pageNav->getPagesCounter();
			$row->content .= '</div>';

			// page text
			$text[$page] = str_replace("<hr id=\"\"system-readmore\"\" />", "", $text[$page]);
			$row->content .= $text[$page];

			// $row->content .= '<br />';
			// $row->content .= '<div class="page-navigation">';

			// add next/prev rel
			plgEasyBlogPagebreak::plgEasyBlogAddRelTag( $row, $page, $n );

			//top pagination
			if( $pluginParams->get( 'show_top_pagination', 0 ) )
			{
				$row->content .= '<br />';
				$tmpContent = $row->content;
				$row->content = '<div class="page-navigation">';

				// adds navigation between pages to bottom of text
				if ( $hasToc ) {
					plgEasyBlogPagebreak::plgEasyBlogCreateNavigation( $row, $page, $n );
				}

				// page links shown at bottom of page if TOC disabled
				if (!$hasToc) {
					$row->content .= $pageNav->getPagesLinks();
				}
				$row->content .= '</div><br />';
				$row->content .= $tmpContent;
			}


			// bottom pagination
			if( $pluginParams->get( 'show_bot_pagination', 1 ) )
			{
				$row->content .= '<br />';
				$row->content .= '<div class="page-navigation">';

				// adds navigation between pages to bottom of text
				if ( $hasToc ) {
					plgEasyBlogPagebreak::plgEasyBlogCreateNavigation( $row, $page, $n );
				}

				// page links shown at bottom of page if TOC disabled
				if (!$hasToc) {
					$row->content .= $pageNav->getPagesLinks();
				}

				$row->content .= '</div><br />';
			}
		}

		return true;
	}

	public function plgEasyBlogCreateTOC( &$row, &$matches, &$page )
	{

		if (isset($row->pagebreaktitle)) {$heading = $row->pagebreaktitle;} else {$heading = $row->title;}
		$limitstart = JRequest::getInt('pagestart', 0);
		$showall = JRequest::getInt('showall', 0);

		// TOC Header
		$row->toc = '
		<div>
		<ul>
		<li>
			<b>'
			. JText::_( 'PLG_PAGEBREAK_ARTICLE_INDEX' ) .
			'</b>
		</li>
		';

		// TOC First Page link
		$class = ($limitstart === 0 && $showall === 0) ? 'toclink active' : 'toclink';
		$row->toc .= '
			<li>
			<a href="'. JRoute::_( '&showall=&pagestart=') .'" class="'. $class .'">'
			. $heading .
			'</a>
			</li>
		';

		$i = 2;

		foreach ( $matches as $bot )
		{
			$link = JRoute::_( '&showall=&pagestart='. ($i-1) );


			if ( @$bot[0] )
			{
				$attrs2 = JUtility::parseAttributes($bot[0]);

				if ( @$attrs2['alt'] )
				{
					$title	= stripslashes( $attrs2['alt'] );
				}
				elseif ( @$attrs2['title'] )
				{
					$title	= stripslashes( $attrs2['title'] );
				}
				else
				{
					$title	= JText::sprintf( 'PLG_PAGEBREAK_PAGE_#', $i );
				}
			}
			else
			{
				$title	= JText::sprintf( 'PLG_PAGEBREAK_PAGE_#', $i );
			}

			$class = ($limitstart == $i-1) ? 'toclink active' : 'toclink';
			$row->toc .= '
					<li>
					<a href="'. $link .'" class="'. $class .'">'
					. $title .
					'</a>
					</li>
				';
			$i++;
		}

		// Get Plugin info
		$plugin = JPluginHelper::getPlugin('easyblog', 'pagebreak');

		if( EasyBlogHelper::getJoomlaVersion() >= '3.0' )
		{
			$params	= new JRegistry( $plugin->params );
		}
		else
		{
			$params	= new JParameter( $plugin->params );
		}

		if ($params->get('showall') )
		{
			$link = JRoute::_( '&showall=1&pagestart=');
			$class = ($showall == 1) ? 'toclink active' : 'toclink';
			$row->toc .= '
					<li>
					<a href="'. $link .'" class="'. $class .'">'
					. JText::_( 'PLG_PAGEBREAK_ALL_PAGES' ) .
					'</a>
					</li>
			';
		}
		//$row->toc .= '</ul></div><div style="clear:both;"></div>';
		$row->toc .= '</ul></div>';
	}

	public function plgEasyBlogAddRelTag( &$row, $page, $n )
	{
		$document	= JFactory::getDocument();

		if ( $page < $n-1 )
		{
			$page_next = $page + 1;
			$link_next = JRoute::_( '&pagestart='. ( $page_next ) );
			$document->addHeadLink( $link_next, 'next', 'rel', array() );
		}

		if ( $page > 0 )
		{
			$page_prev = $page - 1 == 0 ? "" : $page - 1;
			$link_prev = JRoute::_(  '&pagestart='. ( $page_prev) );
			$document->addHeadLink( $link_prev, 'prev', 'rel', array() );
		}

	}

	public function plgEasyBlogCreateNavigation( &$row, $page, $n )
	{
		$pnSpace = "";
		if (JText::_( 'PLG_PAGEBREAK_LT' ) || JText::_( 'PLG_PAGEBREAK_GT' )) $pnSpace = " ";

		if ( $page < $n-1 )
		{
			$page_next = $page + 1;

			$link_next = JRoute::_( '&pagestart='. ( $page_next ) );
			// Next >>
			$next = '<a href="'. $link_next .'">' . JText::_( 'PLG_PAGEBREAK_NEXT' ) . $pnSpace . JText::_( 'PLG_PAGEBREAK_GT' ) . JText::_( 'PLG_PAGEBREAK_GT' ) .'</a>';
		}
		else
		{
			$next = JText::_( 'PLG_PAGEBREAK_NEXT' );
		}

		if ( $page > 0 )
		{
			$page_prev = $page - 1 == 0 ? "" : $page - 1;

			$link_prev = JRoute::_(  '&pagestart='. ( $page_prev) );
			// << Prev
			$prev = '<a href="'. $link_prev .'">'. JText::_( 'PLG_PAGEBREAK_LT' ) . JText::_( 'PLG_PAGEBREAK_LT' ) . $pnSpace . JText::_( 'PLG_PAGEBREAK_PREV' ) .'</a>';
		}
		else
		{
			$prev = JText::_( 'PLG_PAGEBREAK_PREV' );
		}

		$row->content .= '<div>' . $prev . ' - ' . $next .'</div>';
	}

}


function plgEasyBlogPagebreak( &$row, &$params, $page=0 )
{
	return plgEasyBlogPagebreak::onEasyBlogPrepareContent('com_easyblog.entry', $row, $params, $page );
}
