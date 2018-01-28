<?php
/**
* @package		EasySocial
* @copyright	Copyright (C) 2010 - 2012 Stack Ideas Sdn Bhd. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasySocial is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined( '_JEXEC' ) or die( 'Unauthorized Access' );

Foundry::import( 'site:/views/views' );

class EasySocialViewExplorer extends EasySocialSiteView
{
	/**
	 * Displays the delete folder confirmation
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmDeleteFolder()
	{
		$ajax 	= Foundry::ajax();

		$id 	= JRequest::getInt( 'id' );

		$folder = Foundry::table( 'FileCollection' );
		$folder->load( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'folder' , $folder );
		$contents 	= $theme->output( 'site/explorer/dialog.delete.folder' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Displays the delete file confirmation
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function confirmDeleteFile()
	{
		$ajax 	= Foundry::ajax();

		$id 	= JRequest::getInt( 'id' );
		$file 	= Foundry::table( 'File' );
		$file->load( $id );

		$theme 	= Foundry::themes();
		$theme->set( 'file' , $file );
		$contents 	= $theme->output( 'site/explorer/dialog.delete.file' );

		return $ajax->resolve( $contents );
	}

	/**
	 * Renders the file browser
	 *
	 * @since	1.2
	 * @access	public
	 * @param	string
	 * @return
	 */
	public function browser()
	{
		$ajax = Foundry::ajax();

		$uid  = JRequest::getInt( 'uid' );
		$type = JRequest::getCmd( 'type' );
		$url  = JRequest::getVar( 'url' );

		$explorer = Foundry::explorer( $uid, $type );
		$html = $explorer->render( $url );

		return $ajax->resolve($html);
	}
}
