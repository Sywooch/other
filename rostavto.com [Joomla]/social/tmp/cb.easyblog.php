<?php
/**
* @package		EasyBlog
* @copyright	Copyright (C) 2010 Stack Ideas Private Limited. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* EasyBlog is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/
defined('_JEXEC') or die('Restricted access');

class getEasyBlogTab extends cbTabHandler
{
	var $user	= null;

	function getEasyBlogTab()
	{
		return $this->cbTabHandler();
	}

	function isOwner()
	{
		$my		= JFactory::getUser();

		return $my->id == $this->user->id;
	}

	function getDisplayTab( $tab , $user , $ui )
	{
		if(file_exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'easyblog.php'))
		{
			require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php' );
			require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php' );
			require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR .'blog.php' );
			JTable::addIncludePath( JPATH_ROOT . DIRECTORY_SEPARATOR . 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'tables' );

			JFactory::getLanguage()->load( 'com_easyblog' , JPATH_ROOT );

			$params 	= $this->params;
			$mainframe	=& JFactory::getApplication();
			$config		=& EasyBlogHelper::getConfig();
			$my         =& JFactory::getUser();


			$canComment = $params->get('allowcomment', 0);

			//check if jomcomment installed.
			$jcInstalled = false;
			if(file_exists(JPATH_ROOT . DIRECTORY_SEPARATOR . 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_jomcomment' . DIRECTORY_SEPARATOR . 'config.jomcomment.php' ) )
			{
			    $jcInstalled = true;
			}

		    $idebateCode    = $config->get('comment_intensedebate_code');
			$disqusCode     = $config->get('comment_disqus_code');

			if( ($config->get('comment_intensedebate') && !empty( $idebateCode )) || ($config->get('comment_disqus') && !empty( $disqusCode )) || ($config->get('comment_jomcomment', false) && $jcInstalled) )
			{
			    $canComment = false;
			}


			//setting limit
			$limit      = JRequest::getVar('easybloglimit', 0, 'REQUEST');

			if( empty($limit) )
			{
				$limit		= ($mainframe->getCfg('list_limit') == 0) ? 5 : $mainframe->getCfg('list_limit');
			}
			$limitstart = JRequest::getVar('easybloglimitstart', 0, 'REQUEST');

			// In case limit has been changed, adjust it
			$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

			$itemidDashboard	= EasyBlogRouter::getItemId('dashboard');
			$itemidProfile		= EasyBlogRouter::getItemId('profile');
			$itemidTags			= EasyBlogRouter::getItemId('tags');

			$document = JFactory::getDocument();
			$document->addScript( JURI::root() . 'components/com_comprofiler/plugin/user/plug_easyblog/assets/easyblog.js' );
			$document->addStyleSheet( JURI::root() . 'components/com_comprofiler/plugin/user/plug_easyblog/assets/style.css' );


			EasyBlogHelper::loadHeaders();

			$author 	= EasyBlogHelper::getTable( 'Profile' );
			$author->load( $user->id );

			$this->user	= $user;

			ob_start();

	?>
	<div id="easyblog-app-wrapper" class="ezb-postToWall">
	<?php
			if( $this->isOwner( $user ) )
			{
	?>
			<div id="dashboard-actions">
				<span class="dashboard"><a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=dashboard&Itemid='.$itemidDashboard); ?>"><?php echo JText::_('COM_EASYBLOG_CB_DASHBOARD');?></a></span>
				<span class="write"><a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=dashboard&layout=write&Itemid='.$itemidDashboard); ?>"><?php echo JText::_('COM_EASYBLOG_CB_WRITE_ENTRY');?></a></span>
				<span class="settings"><a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=dashboard&layout=profile&Itemid='.$itemidDashboard); ?>"><?php echo JText::_('COM_EASYBLOG_CB_SETTINGS');?></a></span>
			</div>
			<div style="clear:both;"></div>
	<?php
			}

			$model		= new EasyBlogModelBlog();

			$model->setState('limit', $limit);
			$model->setState('limitstart', $limitstart);

			$blogs		= $model->getBlogsBy( 'blogger', $user->id );

			$pagination = $model->getPagination();
			$pagingParams =	$this->_getPaging( array(), array( '' ) );
			$paging = $this->_writePaging( $pagingParams, '', $pagination->limit, $pagination->total );

	?>
			<div>
				<div><h2><?php echo JText::_('COM_EASYBLOG_CB_BIOGRAPHY'); ?> : </h2></div>
				<div><?php echo empty($author->biography)? JText::sprintf( 'COM_EASYBLOG_CB_NOT_SET_BIOGRAPHY', $author->getName() ) : $author->biography; ?></div>
			</div>

			<h2><?php echo JText::_('COM_EASYBLOG_CB_RECENT_BLOG_ENTRIES');?> : </h2>

	<?php
			if(!empty($blogs))
			{
	?>

				<ul class="ezul">
	<?php
				for( $i = 0 ; $i < count( $blogs ); $i++ )
				{

					$item	=& $blogs[$i];
					$blog 	= EasyBlogHelper::getTable( 'Blog' );
					$blog->bind( $item );


					$permalink = EasyBlogRouter::getEntryRoute( $blog->id );

					// @rule: Initialize all variables
					$blog->videos		= array();
					$blog->galleries		= array();
					$blog->albums 		= array();
					$blog->audios		= array();
					$blog->media         = '';
					$blog->images        = array();

					// @rule: Before anything get's processed we need to format all the microblog posts first.
					if( !empty( $row->source ) )
					{
						EasyBlogHelper::formatMicroblog( $blog );
					}

					self::_processMedia( $blog );


					$EasyBlogDateHelper	= EasyBlogDateHelper::dateWithOffSet($blog->created);
					$date		= $EasyBlogDateHelper->toFormat( $config->get('layout_dateformat', '%A, %d %B %Y') );
					$blogText	= (!empty($blog->intro)) ? $blog->intro : $blog->content;

					$limitText  = $params->get('limit', 250);
					$blogText	= strip_tags( $blogText );

					if(JString::strlen($blogText) > $limitText)
					{
						$blogText = strip_tags( $blogText );
						$blogText = JString::substr($blogText, 0, $limitText);
	                    $blogText = $blogText . '...';
					}

					$blogText       = $blog->media . $blogText;

		            $blog->comments		= array();
					if($params->get('allowcomment' , true ))
					{
		                $blog->comments	= $this->getComments( $blog->id, $config->get('layout_showcommentcount', 3) );
					}

					$blog->totalComments  = $this->getTotalComment( $blog->id );

	?>
				    <li>
						<div class="blog-entries">
					        <div class="blog-title"><a href="<?php echo $permalink;?>"><?php echo $blog->title;?></a></div>
							<div class="blog-content mleft">

								<div class="item-container" style="display: <?php if( $params->get( 'expanded' ) ){ ?>block<?php } else { ?>none<?php }?>;">

									<!-- Blog Image -->
									<?php if( $blog->getImage() ){ ?>
										<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$blog->id); ?>" title="<?php echo htmlentities( $blog->title );?>" class="blog-image float-l mrm mbm">
											<img src="<?php echo $blog->getImage()->getSource( 'module' );?>" />
										</a>
									<?php } ?>

									<?php echo $blogText; ?>
									<div class="post-date small"><?php echo JText::sprintf('COM_EASYBLOG_CB_POSTED_ON', $date);?></div>
								</div>
								<a href="javascript:void(0);" onclick="easyblogApp.blog.toggle(this)" class="toggle-item">Show / Hide</a>
							</div>
							<div class="blog-ratings"><?php echo EasyBlogHelper::getHelper( 'ratings' )->getHTML( $blog->id , 'entry' , JText::_( 'COM_EASYBLOG_CB_RATING' ) , 'blog-rating-' . $blog->id );?></div>
							<div class="blog-tools">
								<?php if( $params->get( 'allowhits' , true ) ): ?>
								<span class="blog-hits">
									<a href="<?php echo $permalink;?>"><?php echo JText::sprintf( 'COM_EASYBLOG_CB_HITS' , $blog->hits ); ?></a>
								</span>
								<?php endif; ?>

								<?php if($canComment) : ?>
								<span class="blog-comments">
									<a href="javascript:void(0);" onclick="easyblogApp.comment.show('<?php echo $blog->id; ?>');" class="small"><?php echo JText::sprintf('COM_EASYBLOG_CB_COMMENTS' , $blog->totalComments ); ?></a>
								</span>
								<?php endif; ?>

								<?php if( $params->get( 'allowreadon' , true ) ): ?>
								<span class="blog-readon">
									<a href="<?php echo $permalink; ?>"><?php echo JText::_( 'COM_EASYBLOG_CB_READON' ); ?></a>
								</span>
								<?php endif; ?>
							</div>
							<div style="clear: both;"></div>

						    <?php if( $canComment ): ?>
							<div id="comment-notify-<?php echo $blog->id;?>" class="comment-notify"></div>
							<div id="comment-add-form-<?php echo $blog->id; ?>" style="display:none;"></div>
						    <ul id="comments-wrapper<?php echo $blog->id;?>" class="ezb-blogComment ezul">
								<?php if( !empty( $blog->comments ) ): ?>
									<?php foreach( $blog->comments as $comment ):

										$commenttext		= strip_tags($comment->comment);
										$commentLength		= JString::strlen($commenttext);
										$desiredLength		= 100;
										$trimmedComment		= JString::substr($commenttext, 0, $desiredLength);

										$commenttext		= EasyBlogCommentHelper::parseBBCode( $commenttext );
										$commenttext        = ($commentLength > $desiredLength) ? $trimmedComment . '...' : $commenttext;
									?>
									<li>
										<div class="blog-comment-avatar">
											<a href="<?php echo $comment->creator->getProfileLink(); ?>"><img src="<?php echo $comment->creator->getAvatar(); ?>" width="32" class="avatar" /></a>
										</div>
										<div class="blog-comment-item eztc">
											<div class="small">
												<a href="<?php echo $comment->creator->getProfileLink(); ?>"><?php echo $comment->creator->getName(); ?></a>
												<?php echo JText::_( 'COM_EASYBLOG_CB_ON' );?>
												<span><?php echo $comment->formattedDate; ?></span>
											</div>
											<?php echo $commenttext; ?>
										</div>
										<div style="clear: both;"></div>
									</li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
							<?php endif; ?>
						    <div style="clear: both;"></div>
					    </div>
					</li>
	<?php
				}
	?>
				</ul>

				<div id="comment-separator" class="clear"></div>
				<?php if ( $canComment) : ?>
				<div id="comment-form" class="comment-form" style="display:none;">
					<a name="commentform" id="commentform"></a>
					<form id="frmComment" name="frmComment">
						<div id="err-msg"></div>
						<div id="comment-loading" style="display: none;"><img src="<?php echo rtrim(JURI::root(),'/') . '/components/com_comprofiler/plugin/user/plug_easyblog/assets/loading.gif' ?>" alt="Loading" border="0" /></div>
						<h3 class="add-comment"><?php echo JText::_( 'COM_EASYBLOG_CB_ADD_COMMENT' );?></h3>
						<textarea name="comment" id="comment" width="100%"></textarea>
	          			<?php if ( $my->id != 0 ) : ?>
	          				<input type="hidden" id="esname" name="esname" value="<?php echo $my->name; ?>" />
	          				<input type="hidden" id="esemail" name="esemail" value="<?php echo $my->email; ?>" />
	          			<?php endif; ?>
						<input type="hidden" name="id" id="blog_id" value="" />
						<input type="hidden" name="parent_id" id="parent_id" value="" />
						<input type="hidden" name="comment_depth" id="comment_depth" value="0" />
						<input type="hidden" name="tnc" id="tnc" value="y" />
						<div class="comment-actions">
							<input class="button" type="button" id="btnSubmit" onclick="easyblogApp.comment.cancel(); return false;" value="<?php echo JText::_('COM_EASYBLOG_CB_CANCEL') ; ?>" />
							<input class="button" type="button" id="btnSubmit" onclick="easyblogApp.comment.submit(); return false;" value="<?php echo JText::_('COM_EASYBLOG_CB_ADD') ; ?>" />
						</div>
					</form>
				</div>
				<?php endif; ?>

	<?php

			}
			else
			{
	?>
				<div><?php echo JText::sprintf('COM_EASYBLOG_CB_NO_BLOG_ENTRY_YET', $author->getName() ); ?></div>
	<?php
			}
	?>
	        </div>
			<div style="margin-top:20px">
				<?php echo ($pagination->limit >= $pagination->total)? '' : $paging; ?>
			</div>
	<?php

			$html	= ob_get_contents();
			ob_end_clean();
		}
		else
		{
			$html = JText::_('COM_EASYBLOG_CB_EASYBLOG_NOT_INSTALLED');
		}

		return $html;
	}

	function getComments( $blogId, $max = 0 )
	{
		$config	= EasyBlogHelper::getConfig();
		$db		=& JFactory::getDBO();

		$query	= 'SELECT a.*, (count(b.id) - 1) AS `depth` FROM `#__easyblog_comment` a,';
		$query	.= ' `#__easyblog_comment` b';
		$query	.= ' WHERE a.`post_id` = '.$db->Quote($blogId);
		$query	.= ' AND b.`post_id` = '.$db->Quote($blogId);
		$query	.= ' AND a.`published` = 1';
		$query	.= ' AND b.`published` = 1';
		$query	.= ' AND a.`lft` BETWEEN b.`lft` AND b.`rgt`';
		$query	.= ' GROUP BY a.`id`';
		$query	.= ' ORDER BY a.`lft` DESC';

		if( $max > 0)
			$query  .= ' LIMIT ' . $max;

		$db->setQuery( $query );

		if($db->getErrorNum() > 0)
		{
			JError::raiseError( $db->getErrorNum() , $db->getErrorMsg() . $db->stderr());
		}
		$result	= $db->loadObjectList();

		if( !$result )
		{
			return $result;
		}

		$profile 	= EasyBlogHelper::getTable( 'Profile' );

		foreach( $result as $row )
		{
			$date	= EasyBlogDateHelper::dateWithOffSet( $row->created );
			$row->formattedDate	= $date->toFormat( $config->get('layout_dateformat', '%A, %d %B %Y') );
			$profile->load( $row->created_by );
			$row->creator	= $profile;
		}

		return $result;
	}

	function getBlogTags( $id )
	{
		require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR .'models' . DIRECTORY_SEPARATOR .'posttag.php' );
		$model	= new EasyBlogModelPostTag();
		return $model->getBlogTags( $id );
	}

	function getTotalComment( $id )
	{
		require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR .'helpers' . DIRECTORY_SEPARATOR .'helper.php' );
		return EasyBlogHelper::getCommentCount( $id );
	}

	function _processMedia( &$row )
	{
		$row->media = '';


		// Match images that has preview.
		$pattern		= '/<a class="easyblog-thumb-preview"(.*?)<\/a>/is';

		preg_match( $pattern , $row->intro . $row->content , $matches );

		// Legacy images that doesn't have previews.
		if( empty( $matches ) )
		{
			$pattern		= '#<img[^>]*>#i';

			preg_match( $pattern , $row->intro . $row->content , $matches );
		}

		if( !empty( $matches ) )
		{
			$img        = $matches[ 0 ];
			$img        = preg_replace('/height="(.*)"/', '', $img, 1);
			$row->media	= $img;
		}
		else
		{
			if( count( $row->images ) > 0 )
			{
				foreach( $row->images as $img )
				{
					$imgTag     = '<img src="' . $img . '" />';
					$row->media .= ( empty($row->media) ) ? $imgTag : '<br />' . $imgTag;
				}
			}
		}

		// @rule: If this is a normal blog post, we match them manually
		if( empty( $row->source ) )
		{
			// @rule: Try to match all videos from the blog post first.
			$row->videos		= EasyBlogHelper::getHelper( 'Videos' )->getHTMLArray( $row->intro . $row->content );

			// @rule:
			$row->galleries		= EasyBlogHelper::getHelper( 'Gallery' )->getHTMLArray( $row->intro . $row->content );

			// @rule:
			$row->audios 		= EasyBlogHelper::getHelper( 'Audio' )->getHTMLArray( $row->intro . $row->content );

			// @rule:
			$row->albums		= EasyBlogHelper::getHelper( 'Album' )->getHTMLArray( $row->intro . $row->content );


			$embedHTML		= '';
			if( !empty( $row->galleries ) )
			{
				$embedHTML		.= implode( '' , $row->galleries );
			}

			if( !empty( $row->audios ) )
			{
				$embedHTML		.= implode( '' , $row->audios );
			}

			if( !empty( $row->videos ) )
			{
				$embedHTML		.= implode( '' , $row->videos );
			}

			if( !empty( $row->albums ) )
			{
				$embedHTML		.= implode( '' , $row->albums );
			}

			$row->media			.= ( empty($row->media) ) ? $embedHTML : '<br />' . $embedHTML;
		}

		// @task: Strip out video tags
		$row->intro		= EasyBlogHelper::getHelper( 'Videos' )->strip( $row->intro );
		$row->content	= EasyBlogHelper::getHelper( 'Videos' )->strip( $row->content );

		// @task: Strip out audio tags
		$row->intro		= EasyBlogHelper::getHelper( 'Audio' )->strip( $row->intro );
		$row->content	= EasyBlogHelper::getHelper( 'Audio' )->strip( $row->content );

		// @task: Strip out gallery tags
		$row->intro		= EasyBlogHelper::getHelper( 'Gallery' )->strip( $row->intro );
		$row->content	= EasyBlogHelper::getHelper( 'Gallery' )->strip( $row->content );

		// @task: Strip out album tags
		$row->intro		= EasyBlogHelper::getHelper( 'Album' )->strip( $row->intro );
		$row->content	= EasyBlogHelper::getHelper( 'Album' )->strip( $row->content );

		// @rule: Once the gallery is already processed above, we will need to strip out the gallery contents since it may contain some unwanted codes
		// @2.0: <input class="easyblog-gallery"
		// @3.5: {ebgallery:'name'}
		$row->intro			= EasyBlogHelper::removeGallery( $row->intro );
		$row->content		= EasyBlogHelper::removeGallery( $row->content );

	}
}
