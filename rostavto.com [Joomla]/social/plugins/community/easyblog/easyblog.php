<?php
/**
 * @package		plg_easyblog
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
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.filesystem.file' );
$file	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_community' . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'core.php';

if( JFile::exists( $file ) )
{
	require_once( $file );

	class plgCommunityEasyBlog extends CApplications
	{
		var $name 		= "EasyBlog Application";
		var $_name		= 'easyblog';
		var $_path		= '';
		var $_user		= '';
		var $err        = null;

		function plgCommunityEasyBlog(& $subject, $config)
		{
			$this->_path	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog';
			$this->_user	= CFactory::getRequestUser();

			parent::__construct($subject, $config);
		}

		function _trim(&$text)
		{
			$text = JString::trim($text);
		}

		function _validateFields( $post )
		{
			$ajax	= new JAXResponse();

			if(JString::strlen($post['comment']) == 0)
			{
				$ajax->addScriptCall( 'easyblogApp.comment.notify' , $post[ 'id' ] , JText::_( 'PLG_EASYBLOG_COMMENT_IS_EMPTY' ) , 'error' );
				$ajax->addScriptCall( 'easyblogApp.spinner.hide');
				$ajax->addScriptCall( 'easyblogApp.element.focus', 'comment');
				return $ajax->sendResponse();
			}
		}

		function savecomment( $ajax , $post )
		{
			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );

			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'string.php' );

			$mainframe		= JFactory::getApplication();
			$my				= JFactory::getUser();
			$config 		= EasyBlogHelper::getConfig();

			$this->_validateFields( $post );

			// We don't require a title here.
			$post[ 'title' ]	= '';

			//real work start here.
			$isModerate		= false;
			$parentId		= "0";
			$commentDepth	= $post['comment_depth'];
			$blogId			= $post['id'];

			//we need to rename the esname and esemail back to name and email.
			$post['url']	= '';
			$post['name']	= $post['esname'];
			$post['email']	= $post['esemail'];

			unset($post['esname']);
			unset($post['esemail']);

			JTable::addIncludePath( EBLOG_TABLES );
			$db     	= EasyBlogHelper::db();

			$comment 	= EasyBlogHelper::getTable( 'Comment' );
			$comment->bindPost($post);

			$now                	= JFactory::getDate();
			$totalComment			= (empty($post['totalComment'])) ? 1 : $post['totalComment'];
			$comment->created		= $now->toMySql();
			$comment->modified		= $now->toMySql();
			$comment->published		= 1;
			$comment->parent_id		= $parentId;
			$comment->created_by	= $my->id;

			if(($my->id != 0 && $config->get( 'comment_moderatecomment') == 1) || ($my->id == 0 && $config->get( 'comment_moderateguestcomment') == 1))
			{
				 $comment->published	= 0;
				 $isModerate			= true;
			}

			jimport( 'joomla.application.component.model' );
			JLoader::import( 'comment' , EBLOG_ROOT . DIRECTORY_SEPARATOR . 'models' );
			$model			= JModel::getInstance( 'Comment' , 'EasyBlogModel' );
			$latestComment	= $model->getLatestComment( $blogId , $parentId );
			$left			= 1;
			$right			= 2;

			if( !empty( $latestComment ) )
			{
				$left		= $latestComment->rgt + 1;
				$right		= $latestComment->rgt + 2;

				$model->updateCommentSibling( $blogId , $latestComment->rgt );
			}
			$comment->lft	= $left;
			$comment->rgt	= $right;

			if( !$comment->store() )
			{
				$ajax->addScriptCall( 'easyblogApp.comment.notify' , $post[ 'id' ] , JText::_( 'PLG_EASYBLOG_FAILED_TO_SAVE_COMMENT' ) , 'error' );
				$ajax->addScriptCall( 'easyblogApp.spinner.hide');
				$ajax->addScriptCall( 'easyblogApp.element.focus', 'comment');
				return $ajax->sendResponse();
			}

			$blog 	= EasyBlogHelper::getTable( 'Blog' );
			$blog->load( $blogId );

			// @rule: Process notifications
			$comment->processEmails( $isModerate , $blog );
			
			$profile 	= EasyBlogHelper::getTable( 'Profile' );
			$profile->load( $comment->created_by );
			$comment->creator   = $profile;

			$date	= EasyBlogDateHelper::dateWithOffSet( $comment->created );
			$comment->formattedDate	= $date->toFormat( $config->get('layout_dateformat', '%A, %d %B %Y') );
			$text		= (JString::strlen( $comment->comment) > 50) ? JString::substr( strip_tags( $comment->comment), 0, 50) . '...' : strip_tags($comment->comment);

			$commentText	= '
					<li>
						<div class="blog-comment-avatar">
							<a href="' . $comment->creator->getProfileLink() . '"><img src="'  . $comment->creator->getAvatar() . '" width="32" /></a>
						</div>
						<div class="blog-comment-item">
							<div class="small">
								<a href="' . $comment->creator->getProfileLink() . '">' . $comment->creator->getName() . '</a>
								' . JText::_( 'PLG_EASYBLOG_ON' ) . '
								<span class="small">' . $comment->formattedDate . '</span>
							</div>
							' . $text . '
						</div>
						<div style="clear: both;"></div>
					</li>';

			$ajax->addScriptCall( 'easyblogApp.comment.add', $blogId , $commentText );
			$ajax->addScriptCall( 'easyblogApp.comment.cancel', $blogId );
			$ajax->addScriptCall( 'easyblogApp.spinner.hide');
			$ajax->addScriptCall( 'easyblogApp.comment.notify' , $blogId , JText::_( 'PLG_EASYBLOG_COMMENT_ADDED' ) , 'success' );

			return $ajax->sendResponse();
		}

		/**
		 * Make compatilble with JomSocial 2.8.3
		 *
		 */
		public function onCommunityStreamRender( $act )
		{
			$user = CFactory::getUser($act->actor);
			$actorLink = '<a class="cStream-Author" href="' .CUrlHelper::userLink($user->id).'">'.$user->getDisplayName().'</a>';
			$title = $act->title;

			// Handle 'single' view exclusively
			$title = preg_replace('/\{multiple\}(.*)\{\/multiple\}/i', '', $title);
			$search = array('{single}', '{/single}');
			$title = CString::str_ireplace($search, '', $title);
			$title = CString::str_ireplace('{actor}', $actorLink, $title);

			$stream = new stdClass();
			$stream->actor = $user;
			$stream->target = null;
			$stream->headline = $title;
			$stream->message = $act->content;
			$stream->attachments = array();

			return $stream;
		}

		function onProfileDisplay()
		{
			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );


			if( !file_exists( $this->_path . DIRECTORY_SEPARATOR . 'constants.php' ) )
			{
				return '';
			}

			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'constants.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'date.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'acl.php' );

			$easyBlogItemid	= EasyBlogRouter::getItemId('easyblog');
			$bloggerItemid	= EasyBlogRouter::getItemId('blogger');
			$config 		= EasyBlogHelper::getConfig();
			$acl			= EasyBlogACLHelper::getRuleSet();

			$document		= JFactory::getDocument();
			$mainframe      = JFactory::getApplication();
			$my				= CFactory::getUser();
			$userId 		= $this->_user->id;
			$userName 		= $this->_user->getDisplayName();
			$isOwner		= ($my->id == $userId ) ? true : false;


			// Attach myblog.js to this page so that the editor can load up nicely.
			$j16pluginPath  = EasyBlogHelper::getJoomlaVersion() >= '1.6' ? '/easyblog' : '';

			$document->addScript( JURI::root() . 'plugins/community'.$j16pluginPath.'/easyblog/assets/easyblog.js' );
			$document->addStyleSheet( JURI::root() . 'plugins/community'.$j16pluginPath.'/easyblog/assets/style.css' );

			EasyBlogHelper::loadHeaders();
			$this->loadUserParams();

			$config		= EasyBlogHelper::getConfig();
			$maxComment = 3;

			$rows	    = $this->_getLatestPost($this->_user->id, $this->userparams->get('count', 5) , $this->params->get('order_by', 'created') , $this->params->get('order', 'DESC') );

			$result     = array();
			for( $i = 0; $i < count( $rows ); $i++ )
			{
				$row				=& $blog;

				$item				=& $rows[$i];
				$row 				= EasyBlogHelper::getTable( 'Blog' );
				$row->bind( $item );


				$row->totalComments	= EasyBlogHelper::getCommentCount( $row->id );
				$row->isFeatured    = EasyBlogHelper::isFeatured('post', $row->id);
				$row->category      = (empty($row->category)) ? JText::_('PLG_EASYBLOG_UNCATEGORIZED') : $row->category;

				// @rule: Initialize all variables
				$row->videos		= array();
				$row->galleries		= array();
				$row->albums 		= array();
				$row->audios		= array();
				$row->media         = '';
				$row->images        = array();

				// @rule: Before anything get's processed we need to format all the microblog posts first.
				if( !empty( $row->source ) )
				{
					EasyBlogHelper::formatMicroblog( $row );
				}

				self::_processMedia( $row );

				$row->text			= empty( $row->intro ) ? $row->content : $row->intro;
				//onPrepareContent trigger start
				$row->introtext		= $row->intro;
				$row->excerpt		= $row->introtext;
				$row->content		= $row->text;

				//comments
				$row->comments		= array();
				if($this->params->get('allowcomment' , true ))
				{
					$row->comments	= $this->_getComments( $row->id, $config->get('layout_showcommentcount', 3) );
				}

				$result[]   = $row;
			}

			$cache		= JFactory::getCache('plgCommunityEasyBlog');
			$cache->setCaching( $this->params->get( 'cache' ) ? $mainframe->getCfg( 'caching' ) : false );
			$contents = $cache->call( array( 'plgCommunityEasyBlog' , '_getHTML' ) , $isOwner, $userId, $easyBlogItemid, $bloggerItemid, $my, $result, $this->params);

			return $contents;
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

		function _getHTML( $isOwner, $userId, $easyBlogItemid, $bloggerItemid, $my, $rows, $params)
		{
			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );
			JFactory::getLanguage()->load( 'com_easyblog' , JPATH_ROOT );


			$config		= EasyBlogHelper::getConfig();
			$canComment = $params->get('allowcomment', 0);
			$canRate	= $params->get('showratings' , 1 );
			$showContent	= $params->get( 'showcontent' , 1 );

			$j16pluginPath  = EasyBlogHelper::getJoomlaVersion() >= '1.6' ? '/easyblog' : '';

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

			  ob_start();
		  ?>
			  <div id="easyblog-app-wrapper" class="ezb-postToWall">
		  <?php

			if(empty($rows))
			{
		?>
				<div class="blog-icon" style="float: left; width: 20px;"><img src="<?php echo JURI::root(); ?>plugins/community<?php echo $j16pluginPath; ?>/easyblog/assets/icon-easyblog.png" alt="" /></div>
				<div><?php echo JText::_('PLG_EASYBLOG_NO_BLOG_CREATED_YET'); ?></div>
		<?php
			}
			else
			{
			?>
			<ul class="ezul">
			<?php
				for($i = 0; $i < count($rows); $i++)
				{
					$row    = $rows[$i];

					$EasyBlogDateHelper	= EasyBlogDateHelper::dateWithOffSet($row->created);
					$date		= $EasyBlogDateHelper->toFormat( $config->get('layout_dateformat', '%A, %d %B %Y') );

					$requireVerification = false;
					if($config->get('main_password_protect', true) && !empty($row->blogpassword))
					{
						$row->title	= JText::sprintf('COM_EASYBLOG_PASSWORD_PROTECTED_BLOG_TITLE', $row->title);
						$requireVerification = true;
					}

					if($requireVerification && !EasyBlogHelper::verifyBlogPassword($row->blogpassword, $row->id))
					{
						$theme = new CodeThemes();
						$theme->set('id', $row->id);
						$theme->set('return', base64_encode(EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id)));
						$blogText			= $theme->fetch( 'blog.protected.php' );
						$row->showRating	= false;
						$row->protect		= true;
					}
					else
					{

						$blogText	= (!empty($row->introtext)) ? $row->introtext : $row->content;

						$limitText  = $params->get('limit', 250);
						$blogText	= strip_tags( $blogText );

						if(JString::strlen($blogText) > $limitText)
						{
							$blogText = strip_tags( $blogText );
							$blogText = JString::substr($blogText, 0, $limitText);
							$blogText = $blogText . '...';
						}

						$row->showRating	= true;
						$row->protect		= false;
					}
		?>
			<li class="joms-newsfeed-item">
				<div class="blog-entries">
					<div class="blog-title"><a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=entry&id=' . $row->id . '&Itemid=' . $easyBlogItemid );?>"><?php echo $row->title;?></a></div>

					<?php if( $showContent ){ ?>
					<div class="blog-content mleft">
						<div class="item-container" style="display: <?php if( $params->get( 'expanded' ) ){ ?>block<?php } else { ?>none<?php }?>;">

							<!-- Blog Image -->
							<?php if( $row->getImage() ){ ?>
								<a href="<?php echo EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id); ?>" title="<?php echo htmlentities( $row->title );?>" class="blog-image float-l mrm mbm">
									<img src="<?php echo $row->getImage()->getSource( 'frontpage' );?>" align="left" style="padding: 5px;" />
								</a>
							<?php } else { ?>
								<?php if( $row->videos ){ ?>
									<?php foreach( $row->videos as $video ){ ?>
										<p class="video-source">
											<?php echo $video->html; ?>
										</p>
									<?php } ?>
								<?php } else { ?>
									<?php echo $row->media; ?>
								<?php } ?>
							<?php } ?>

							<?php echo $blogText; ?>

							<div class="post-date small"><?php echo JText::sprintf('PLG_EASYBLOG_POSTED_ON', $date);?></div>
						</div>

						<a href="javascript:void(0);" onclick="easyblogApp.blog.toggle(this)" class="toggle-item"><?php echo JText::_('PLG_EASYBLOG_SHOW_OR_HIDE'); ?></a>

						<div style="clear:both;"></div>
					</div>
					<?php } ?>

					<?php if( $canRate ){ ?>
					<div class="blog-ratings"><?php if($row->showRating){ echo EasyBlogHelper::getHelper( 'ratings' )->getHTML( $row->id , 'entry' , JText::_( 'PLG_EASYBLOG_RATING' ) , 'blog-rating-' . $row->id ); }?></div>
					<?php } ?>

					<div class="blog-tools">
						<?php if( $params->get( 'allowhits' , true ) ): ?>
						<span class="blog-hits">
							<a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=entry&id=' . $row->id . '&Itemid=' . $easyBlogItemid );?>"><?php echo JText::sprintf( 'PLG_EASYBLOG_TOTAL_HITS' , $row->hits ); ?></a>
						</span>
						<?php endif; ?>

						<?php if($canComment) : ?>
						<span class="blog-comments">
							<a href="javascript:void(0);" onclick="easyblogApp.comment.show('<?php echo $row->id; ?>');" class="small">
								<?php if( $row->totalComments === false ) { ?>
								<?php echo JText::sprintf('PLG_EASYBLOG_COMMENTS' , $row->totalComments ); ?>
								<?php } else { ?>
								<?php echo JText::sprintf('PLG_EASYBLOG_TOTAL_COMMENTS' , $row->totalComments ); ?>
								<?php } ?>
							</a>
						</span>
						<?php endif; ?>

						<?php if( $params->get( 'allowreadon' , true ) ): ?>
						<span class="blog-readon">
							<a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=entry&id=' . $row->id . '&Itemid=' . $easyBlogItemid );?>"><?php echo JText::_( 'PLG_EASYBLOG_READ_ON' ); ?></a>
						</span>
						<?php endif; ?>
					</div>
					<div style="clear: both;"></div>

					<?php if( $canComment ): ?>
					<div id="comment-notify-<?php echo $row->id;?>" class="comment-notify"></div>
					<div id="comment-add-form-<?php echo $row->id; ?>" style="display:none;"></div>
					<ul id="comments-wrapper<?php echo $row->id;?>" class="ezb-blogComment ezul">
						<?php if( !empty( $row->comments ) ): ?>
							<?php foreach( $row->comments as $comment ): ?>
							<li>
								<div class="blog-comment-avatar">
									<a href="<?php echo $comment->creator->getProfileLink(); ?>"><img src="<?php echo $comment->creator->getAvatar(); ?>" width="32" class="avatar" /></a>
								</div>
								<div class="blog-comment-item eztc">
									<div class="small">
										<a href="<?php echo $comment->creator->getProfileLink(); ?>"><?php echo $comment->creator->getName(); ?></a>
										<?php echo JText::_( 'PLG_EASYBLOG_ON' );?>
										<span><?php echo $comment->formattedDate; ?></span>
									</div>
									<?php echo JString::strlen( $comment->comment ) > 50 ? JString::substr( strip_tags( $comment->comment ) , 0 , 50 ) . '...' : strip_tags( $comment->comment ); ?>
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
		<?php	} ?>
			</ul>
		<?php } ?>
				<div id="comment-separator" class="clear"></div>
				<?php if ( $canComment) : ?>
				<div id="comment-form" class="comment-form" style="display:none;">
					<a name="commentform" id="commentform"></a>
					<form id="frmComment" name="frmComment">
						<div id="err-msg"></div>
						<div id="comment-loading" style="display: none;"><img src="<?php echo rtrim(JURI::root(),'/') . '/plugins/community'.$j16pluginPath.'/easyblog/assets/loading.gif' ?>" alt="Loading" border="0" /></div>
						<h3 class="add-comment"><?php echo JText::_( 'PLG_EASYBLOG_ADD_COMMENT' );?></h3>
						<textarea name="comment" id="comment" width="100%"></textarea>
						<?php if ( $my->id != 0 ) : ?>
							<input type="hidden" id="esname" name="esname" value="<?php echo $my->getDisplayName(); ?>" />
							<input type="hidden" id="esemail" name="esemail" value="<?php echo $my->email; ?>" />
						<?php endif; ?>
						<input type="hidden" name="id" id="blog_id" value="" />
						<input type="hidden" name="parent_id" id="parent_id" value="" />
						<input type="hidden" name="comment_depth" id="comment_depth" value="0" />
						<input type="hidden" name="tnc" id="tnc" value="y" />
						<div class="comment-actions">
							<input class="button" type="button" id="btnSubmit" onclick="easyblogApp.comment.cancel(); return false;" value="<?php echo JText::_('PLG_EASYBLOG_CANCEL_BUTTON') ; ?>" />
							<input class="button" type="button" id="btnSubmit" onclick="easyblogApp.comment.submit(); return false;" value="<?php echo JText::_('PLG_EASYBLOG_ADD_BUTTON') ; ?>" />
						</div>
					</form>
				</div>
				<?php endif; ?>
				<div style="text-align: right;">
					<a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=blogger&layout=listings&id=' . $userId . '&Itemid=' . $easyBlogItemid );?>"><?php echo JText::_( 'PLG_EASYBLOG_VIEW_ALL' );?></a>
				</div>
			</div>
		<?php

			$content = ob_get_contents();
			ob_end_clean();

			return $content;
		}

		function _getComments( $blogId, $max = 0 )
		{
			$config	= EasyBlogHelper::getConfig();
			$db		= EasyBlogHelper::db();

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

			foreach( $result as $row )
			{
				$date	= EasyBlogDateHelper::dateWithOffSet( $row->created );
				$row->formattedDate	= $date->toFormat( $config->get('layout_dateformat', '%A, %d %B %Y') );
				$profile 		= EasyBlogHelper::getTable( 'Profile' );
				$row->creator	= $profile->load( $row->created_by );
			}

			return $result;
		}

		function _getLatestPost($bloggerId, $max, $order_by, $order_dir)
		{

			$db 		= EasyBlogHelper::db();
			$my			= CFactory::getUser();
			$config 	= EasyBlogHelper::getConfig();

			$query  = 'select a.*, b.`title` AS `category` from `#__easyblog_post` as a';
			$query	.= ' LEFT JOIN `#__easyblog_category` AS b';
			$query	.= ' 	ON a.`category_id` = b.`id`';
			$query  .= ' where a.`created_by` = ' . $db->Quote($bloggerId);
			$query  .= ' and a.`published` = 1';


			if( $config->get( 'main_jomsocial_privacy' ) )
			{
				$jsFriends	= CFactory::getModel( 'Friends' );
				$friends	= $jsFriends->getFriendIds( $my->id );

				// Insert query here.
				$query	.= ' AND (';
				$query	.= ' (a.`private`= 0 ) OR';
				$query	.= ' ( (a.`private` = 20) AND (' . $db->Quote( $my->id ) . ' > 0 ) ) OR';

				if( empty( $friends ) )
				{
					$query	.= ' ( (a.`private` = 30) AND ( 1 = 2 ) ) OR';
				}
				else
				{
					$query	.= ' ( (a.`private` = 30) AND ( a.' . $db->nameQuote( 'created_by' ) . ' IN (' . implode( ',' , $friends ) . ') ) ) OR';
				}

				$query	.= ' ( (a.`private` = 40) AND ( a.' . $db->nameQuote( 'created_by' ) .'=' . $my->id . ') )';
				$query	.= ' )';
			}
			else
			{
				if( $my->id == 0)
				{
					$query .= ' AND a.`private` = ' . $db->Quote(BLOG_PRIVACY_PUBLIC);
				}
			}


			if($order_by == 'title')
				$query  .= ' order by a.`title`';
			else
				$query  .= ' order by a.`created`';

			$query  .= ' ' . $order_dir;

			if($max > 0)
				$query  .= ' LIMIT ' . $max;

			$db->setQuery($query);
			$result = $db->loadObjectList();

			return $result;
		}

	}
}

$file	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_community' . DIRECTORY_SEPARATOR . 'api.php';
if( JFile::exists( $file ) )
{
	require_once( JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog' . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php' );

	class plgCommunityEasyBlog extends JPlugin
	{
		function plgCommunityEasyBlog(& $subject, $config)
		{
			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );

			$this->_path	= JPATH_ROOT . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_easyblog';

			parent::__construct($subject, $config);
		}

		function onProfileExtra($user, $params='', $name)
		{
			if( $name != 'easyblog' )
			{
				return;
			}

			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );

			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'constants.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'router.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'helper.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'date.php' );
			include_once ( $this->_path . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'acl.php' );

			$easyBlogItemid	= EasyBlogRouter::getItemId('easyblog');
			$bloggerItemid	= EasyBlogRouter::getItemId('blogger');
			$config 		= EasyBlogHelper::getConfig();
			$acl			= EasyBlogACLHelper::getRuleSet();

			$document		= JFactory::getDocument();
			$mainframe      = JFactory::getApplication();
			$my				= JFactory::getUser();
			$isOwner		= ($my->id == $user->id ) ? true : false;

			EasyBlogHelper::loadHeaders();

			// Attach myblog.js to this page so that the editor can load up nicely.
			$j16pluginPath  = EasyBlogHelper::getJoomlaVersion() >= '1.6' ? '/easyblog' : '';

			$document->addScript( JURI::root() . 'plugins/community'.$j16pluginPath.'/easyblog/assets/easyblog.js' );
			$document->addStyleSheet( JURI::root() . 'plugins/community'.$j16pluginPath.'/easyblog/assets/style.css' );

			$config		= EasyBlogHelper::getConfig();
			$maxComment = 3;

			$rows	    = $this->_getLatestPost( $user->id, $params->get('count', 5) , $params->get('order_by', 'created') , $params->get('order', 'DESC') );

			foreach ($rows as $blog)
			{
				$row				=& $blog;
				$row->totalComments	= EasyBlogHelper::getCommentCount( $row->id );
				$row->isFeatured    = EasyBlogHelper::isFeatured('post', $row->id);
				$row->category      = (empty($row->category)) ? JText::_('PLG_EASYBLOG_UNCATEGORIZED') : $row->category;
				$row->text			= empty( $row->intro ) ? $row->content : $row->intro;

				//onPrepareContent trigger start
				$row->introtext		= $row->intro;
				$row->excerpt		= $row->introtext;
				$row->content		= $row->text;

				// @rule: Initialize all variables
				$row->videos		= array();
				$row->galleries		= array();
				$row->albums 		= array();
				$row->audios		= array();

				// @rule: Before anything get's processed we need to format all the microblog posts first.
				if( !empty( $row->source ) )
				{
					EasyBlogHelper::formatMicroblog( $row );
				}

				//comments
				$row->comments		= array();
				if($this->params->get('allowcomment' , true ))
				{
					$row->comments	= $this->_getComments( $row->id, $config->get('layout_showcommentcount', 3) );
				}
			}

			$cache		= JFactory::getCache('plgCommunityEasyBlog');
			$cache->setCaching( $this->params->get( 'cache' ) ? $mainframe->getCfg( 'caching' ) : false );
			$contents = $cache->call( array( 'plgCommunityEasyBlog' , '_getHTML' ) , $isOwner, $user->id, $easyBlogItemid, $bloggerItemid, $my, $rows, $this->params);

			$tab = new JSCommunityTab();
			$tab->text			= $contents;
			$tab->title			= JText::_( 'EasyBlog' );
			$tab->description	= JText::_("EasyBlog description");
			$tab->name			= 'EasyBlog';

			return $tab;
		}

		function _getHTML( $isOwner, $userId, $easyBlogItemid, $bloggerItemid, $my, $rows, $params)
		{
			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );
			JFactory::getLanguage()->load( 'com_easyblog' , JPATH_ROOT );

			$config		= EasyBlogHelper::getConfig();
			$canComment = $params->get('allowcomment', 0);

			$j16pluginPath  = EasyBlogHelper::getJoomlaVersion() >= '1.6' ? '/easyblog' : '';

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

			  ob_start();
		  ?>
			  <div id="easyblog-app-wrapper" class="ezb-postToWall ezb-mighty">
		  <?php

			if(empty($rows))
			{
		?>
				<div class="blog-icon" style="float: left; width: 20px;"><img src="<?php echo JURI::root(); ?>plugins/community<?php echo $j16pluginPath; ?>/easyblog/assets/icon-easyblog.png" alt="" /></div>
				<div><?php echo JText::_('PLG_EASYBLOG_NO_BLOG_CREATED_YET'); ?></div>
		<?php
			}
			else
			{
			?>
			<ul class="ezul">
			<?php
				for($i = 0; $i < count($rows); $i++)
				{
					$row    = $rows[$i];

					$EasyBlogDateHelper	= EasyBlogDateHelper::dateWithOffSet($row->created);
					$date		= $EasyBlogDateHelper->toFormat( $config->get('layout_dateformat', '%A, %d %B %Y') );

					$requireVerification = false;
					if($config->get('main_password_protect', true) && !empty($row->blogpassword))
					{
						$row->title	= JText::sprintf('COM_EASYBLOG_PASSWORD_PROTECTED_BLOG_TITLE', $row->title);
						$requireVerification = true;
					}

					if($requireVerification && !EasyBlogHelper::verifyBlogPassword($row->blogpassword, $row->id))
					{
						$theme = new CodeThemes();
						$theme->set('id', $row->id);
						$theme->set('return', base64_encode(EasyBlogRouter::_('index.php?option=com_easyblog&view=entry&id='.$row->id)));
						$blogText			= $theme->fetch( 'blog.protected.php' );
						$row->showRating	= false;
						$row->protect		= true;
					}
					else
					{

						$blogText	= (!empty($row->introtext)) ? $row->introtext : $row->content;
						$limitText  = $params->get('limit', 250);
						$blogText	= strip_tags( $blogText );

						if(JString::strlen($blogText) > $limitText)
						{
							$blogText = strip_tags( $blogText );
							$blogText = JString::substr($blogText, 0, $limitText);
							$blogText = $blogText . '...';
						}

						$row->showRating	= true;
						$row->protect		= false;
					}
		?>
			<li class="joms-newsfeed-item">
				<div class="blog-entries">
					<div class="blog-title"><a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=entry&id=' . $row->id . '&Itemid=' . $easyBlogItemid );?>"><?php echo $row->title;?></a></div>
					<div class="blog-content mleft">

						<div class="item-container" style="display: <?php if( $params->get( 'expanded' ) ){ ?>block<?php } else { ?>none<?php }?>;">
							<?php echo $blogText; ?>
							<div class="post-date small"><?php echo JText::sprintf('PLG_EASYBLOG_POSTED_ON', $date);?></div>
						</div>
						<a href="javascript:void(0);" onclick="easyblogApp.blog.toggle(this)" class="toggle-item"><?php echo JText::_('PLG_EASYBLOG_SHOW_OR_HIDE'); ?></a>
					</div>
					<div class="blog-ratings"><?php if($row->showRating){ echo EasyBlogHelper::getHelper( 'ratings' )->getHTML( $row->id , 'entry' , JText::_( 'PLG_EASYBLOG_RATING' ) , 'blog-rating-' . $row->id ); }?></div>
					<div class="blog-tools">
						<?php if( $params->get( 'allowhits' , true ) ): ?>
						<span class="blog-hits">
							<a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=entry&id=' . $row->id . '&Itemid=' . $easyBlogItemid );?>"><?php echo JText::sprintf( 'PLG_EASYBLOG_TOTAL_HITS' , $row->hits ); ?></a>
						</span>
						<?php endif; ?>

						<?php if( $params->get( 'allowreadon' , true ) ): ?>
						<span class="blog-readon">
							<a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=entry&id=' . $row->id . '&Itemid=' . $easyBlogItemid );?>"><?php echo JText::_( 'PLG_EASYBLOG_READ_ON' ); ?></a>
						</span>
						<?php endif; ?>
					</div>
					<div style="clear: both;"></div>
				</div>
				</li>
		<?php	} ?>
			</ul>
		<?php } ?>
				<div style="text-align: right;">
					<a href="<?php echo JRoute::_('index.php?option=com_easyblog&view=blogger&id=' . $userId . '&Itemid=' . $easyBlogItemid );?>"><?php echo JText::_( 'PLG_EASYBLOG_VIEW_ALL' );?></a>
				</div>
			</div>
		<?php

			$content = ob_get_contents();
			ob_end_clean();

			return $content;
		}

		function _getComments( $blogId, $max = 0 )
		{
			$config	= EasyBlogHelper::getConfig();
			$db		= EasyBlogHelper::db();

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


			foreach( $result as $row )
			{
				$date	= EasyBlogDateHelper::dateWithOffSet( $row->created );
				$row->formattedDate	= $date->toFormat( $config->get('layout_dateformat', '%A, %d %B %Y') );
				$row->creator	= EasyBlogHelper::getTable( 'Profile' );
				$row->creator->load($row->created_by);
			}

			return $result;
		}

		function _getLatestPost($bloggerId, $max, $order_by, $order_dir)
		{

			$db 		= EasyBlogHelper::db();
			$my			= JFactory::getUser();
			$config 	= EasyBlogHelper::getConfig();

			$query  = 'select a.*, b.`title` AS `category` from `#__easyblog_post` as a';
			$query	.= ' LEFT JOIN `#__easyblog_category` AS b';
			$query	.= ' 	ON a.`category_id` = b.`id`';
			$query  .= ' where a.`created_by` = ' . $db->Quote($bloggerId);
			$query  .= ' and a.`published` = 1';


			if( $config->get( 'main_jomsocial_privacy' ) )
			{
				$jsFriends	= CFactory::getModel( 'Friends' );
				$friends	= $jsFriends->getFriendIds( $my->id );

				// Insert query here.
				$query	.= ' AND (';
				$query	.= ' (a.`private`= 0 ) OR';
				$query	.= ' ( (a.`private` = 20) AND (' . $db->Quote( $my->id ) . ' > 0 ) ) OR';

				if( empty( $friends ) )
				{
					$query	.= ' ( (a.`private` = 30) AND ( 1 = 2 ) ) OR';
				}
				else
				{
					$query	.= ' ( (a.`private` = 30) AND ( a.' . $db->nameQuote( 'created_by' ) . ' IN (' . implode( ',' , $friends ) . ') ) ) OR';
				}

				$query	.= ' ( (a.`private` = 40) AND ( a.' . $db->nameQuote( 'created_by' ) .'=' . $my->id . ') )';
				$query	.= ' )';
			}
			else
			{
				if( $my->id == 0)
				{
					$query .= ' AND a.`private` = ' . $db->Quote(BLOG_PRIVACY_PUBLIC);
				}
			}


			if($order_by == 'title')
				$query  .= ' order by a.`title`';
			else
				$query  .= ' order by a.`created`';

			$query  .= ' ' . $order_dir;

			if($max > 0)
				$query  .= ' LIMIT ' . $max;

			$db->setQuery($query);
			$result = $db->loadObjectList();

			return $result;
		}


		function onUserSlideMenu( $profile )
		{
			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );

			$user = JFactory::getUser();

			if($user->id == $profile->id)
			{
				$menu = array();

				$menu[0] = new stdClass();
				$menu[0]->link = JRoute::_("index.php?option=com_easyblog&view=blogger&id=" . $profile->id );
				$menu[0]->icon="plugins/community/easyblog/mighty/write.png";
				$menu[0]->alt = JText::_("PLG_EASYBLOG_MIGHTY_WRITE");

				return $menu;
			}

			$menu = array();

			$menu[0] = new stdClass();
			$menu[0]->link	= EasyBlogRouter::_( 'index.php?option=com_easyblog&view=blogger&id=' . $profile->id );
			$menu[0]->icon="plugins/community/easyblog/mighty/icon.png";
			$menu[0]->alt = JText::_("PLG_EASYBLOG_MIGHTY_SLIDE");

			return $menu;
		}

		function onProfileMenu( $profile )
		{
			JFactory::getLanguage()->load( 'plg_easyblog' , JPATH_ADMINISTRATOR );

			$user = JFactory::getUser();

			if($user->id == $profile->id)
			{
				$menu = array();

				$menu[0] = new stdClass();
				$menu[0]->link	= EasyBlogRouter::_( 'index.php?option=com_easyblog&view=dashboard&layout=write');
				$menu[0]->icon="plugins/community/easyblog/mighty/write.png";
				$menu[0]->alt = JText::_("PLG_EASYBLOG_MIGHTY_WRITE");

				$out = new stdClass();
				$out->title = JText::_("EasyBlog");
				$out->menuItems = $menu;
				return $out;
			}

			$menu = array();

			$menu[0] = new stdClass();
			$menu[0]->link	= EasyBlogRouter::_( 'index.php?option=com_easyblog&view=blogger&id=' . $profile->id );
			$menu[0]->icon="plugins/community/easyblog/mighty/icon.png";
			$menu[0]->alt = JText::_("PLG_EASYBLOG_MIGHTY_BLOGS");

			$out = new stdClass();
			$out->title = JText::_("EasyBlog");
			$out->menuItems = $menu;
			return $out;
		}
	}
}
