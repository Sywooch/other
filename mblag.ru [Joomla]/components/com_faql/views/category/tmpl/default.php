<?php defined('_JEXEC') or die; ?>

<?php
/**
 * Inverses a provided hex color. If you pass a hex string with a
 * hash(#), the function will return a string with a hash prepended
 * @param string $color Hex color to flip
 * @return string Reversed hex color
 */
function inverseHex( $color )
{
	$color       = trim($color);
	$prependHash = FALSE;
 
	if(strpos($color,'#')!==FALSE) {
		$prependHash = TRUE;
		$color       = str_replace('#',NULL,$color);
	}
 
	switch($len=strlen($color)) {
	case 3:
		$color=preg_replace("/(.)(.)(.)/","\\1\\1\\2\\2\\3\\3",$color);
		break;
	case 6:
		break;
	default:
		trigger_error("Invalid hex length ($len). Must be a minimum length of (3) or maxium of (6) characters", E_USER_ERROR);
	}
 
	if(!preg_match('/^[a-f0-9]{6}$/i',$color)) {
		$color = htmlentities($color);
		trigger_error( "Invalid hex string #$color", E_USER_ERROR );
	}
 
	$r = dechex(255-hexdec(substr($color,0,2)));
	$r = (strlen($r)>1)?$r:'0'.$r;
	$g = dechex(255-hexdec(substr($color,2,2)));
	$g = (strlen($g)>1)?$g:'0'.$g;
	$b = dechex(255-hexdec(substr($color,4,2)));
	$b = (strlen($b)>1)?$b:'0'.$b;
 
	return ($prependHash?'#':NULL).$r.$g.$b;
}
?>

<?php 
	$app = JFactory::getApplication();
	$adm_par = $app->getUserState('com_faql.adm_par'); // array Id managers
	$userfaql = $app->getUserState('com_faql.userfaql'); // To take permissions of the user for com_faql
	$sort = $app->getUserState('com_faql.sort'.$this->category->id); // array sort
?>

<?php /* Start */ ?>

<?php /* page heading */ ?>
<?php if ( $this->params->get( 'show_page_heading', 0 ) ) : ?>
	<div class="componentheading">
	<?php 
		if ($this->category->params->get('image'))
		{
			$attribs['align']  = 'left';
			$attribs['height'] = '30px';

			// Use the static HTML library to build the image tag
			echo JHTML::_('image', $this->category->params->get('image'), JText::_('faql'), $attribs);
		}
	?>
	<?php echo '<h3>'.$this->escape($this->params->get('page_title')).'</h3>'; ?>
	</div>
	<?php if ($this->params->get('num_questions')) { ?>
			<p class="faql_small">
			&nbsp;&nbsp;&nbsp;<?php echo JText::_('QUESTIONS') .': '.JText::_('TOTAL').'-'.$this->catquest->numquestion.', '
								.JText::_('TODAY').'-'.$this->catquest->catquest_t.'; &nbsp;&nbsp;&nbsp;'
								.JText::_('ANSWERS') .': '.JText::_('TOTAL').'-'.$this->catquest->numanswer.', '
								.JText::_('TODAY').'-'.$this->catquest->catansw_t;
			?>
			 </p>
	<?php } ?>
<?php endif; ?>

<?php /* category description */ ?>
<?php if ( $this->params->get( 'show_desc', 0 ) ) : ?>
	<div style="overflow:hidden" class="contentdescription">
		<?php echo $this->category->description; ?>
	</div>
<?php endif; ?>

<?php
	JHTML::_('behavior.modal', 'a.modal'); // add modal windows
	$document	= JFactory::getDocument();
	// Link modal window - add question
	if ($this->params->get('add_question') == 0 OR !$userfaql->get('guest')) {
		if ($adm_par) {
			$menus	= &JSite::getMenu();
			$menu	= $menus->getActive();
			if (!$userfaql->get('manager') AND !$userfaql->get('SuperUser')) {
				$parlink = '<a class="addquestion button modal" href="'.$this->baseurl.'index.php?option=com_faql&amp;task=addquestion&amp;format=raw&amp;catid='.$this->category->id.'&amp;Itemid='.$menu->id.'&amp;id_group='.$this->category->id_group.'"';
				$parlink .= ' rel="{handler: \'iframe\', size: {x: 600, y: 550}, onClose: function() {}}">';
				$parlink .= '<span>'.JText::_('ADD_QUESTION').'</span></a>';
				$parlink .= '<div id="time"></div>';
				$parlink .= '<input type="hidden" id="smcatid" value="'. $this->category->id.'" />';
				$parlink .= '<input type="hidden" id="Itemid" value="'. $menu->id. '" />';
				$parlink .= '<input type="hidden" id="id_group" value="'.$this->category->id_group.'" />';
				$parlink .= '<input type="hidden" id="count" value="'.$this->params->get('count', 1000).'" />';
				$this->params->set('link_add', $parlink);
			}
		}
	}
?>

<div id="start"></div>
<?php if (!$this->items) : ?>
	<?php
		if ($adm_par) {
			// button add question
			if ($this->params->get('add_question') == 0 OR !$userfaql->get('guest')) {
				echo '<div class="linkadd">'.$this->params->get('link_add').'</div>';
			}
			else {
				echo '<span>'.JText::_( 'ASK_A_QUESTION_THE_REGISTERED_USERS_CAN_ONLY' ).'</span>';
			}
		} else {
			echo '<p>'.JText::_('ERROR_NO_MANAGERS').'</p>';
		}	
	?>
	<br />
	<br />
	<div class="no_questions">
			<?php 
				if ($userfaql->get('manager') AND $this->total > 0)	echo JText::_('FOR_YOU_THERE_ARE_NO_QUESTIONS');
				else echo JText::_('NO_QUESTION');
			?>
	</div>
<?php else: ?>
	<?php
		if ($adm_par) {
			// button add question
			if ($this->params->get('add_question') == 0 OR !$userfaql->get('guest')) {
				echo '<div class="linkadd">'.$this->params->get('link_add').'</div>';
			}
			else {
				echo '<span>'.JText::_( 'ASK_A_QUESTION_THE_REGISTERED_USERS_CAN_ONLY' ).'</span>';
			}
		} else {
			echo '<p>'.JText::_('ERROR_NO_MANAGERS').'</p>';
		}	
	?>
	
	<br />
	<div class="clr"> </div>

	<div class="sort_filter">
		<?php // sort question ?>
		<div class="order">
			<span><?php echo JText::_('JFIELD_ORDERING_LABEL') ?></span>
		</div>
		<div class="quest_sort">
			<form action="index.php?option=com_faql&amp;task=sendsort" name="SortForm" id="SortForm" method="post" >
				<?php 
					$state_ord[] = JHTML::_('select.option','ot', JText::_( 'ORDER_TOP' ) );
					$state_ord[] = JHTML::_('select.option','od', JText::_( 'ORDER_DOWN' ) );
					$state_ord[] = JHTML::_('select.option','nt', JText::_( 'NUMBER_TOP' ) );
					$state_ord[] = JHTML::_('select.option','nd', JText::_( 'NUMBER_DOWN' ));
					$state_ord[] = JHTML::_('select.option','dqt', JText::_( 'QUEST_TOP' ));
					$state_ord[] = JHTML::_('select.option','dqd', JText::_( 'QUEST_DOWN' ) );
					$state_ord[] = JHTML::_('select.option','dat', JText::_( 'ANSWER_TOP' ) );
					$state_ord[] = JHTML::_('select.option','dad', JText::_( 'ANSWER_DOWN' ) );
					echo JHTML::_('select.genericlist',  $state_ord, 'sortq', 'onchange="document.getElementById(\'SortForm\').submit();"', 'value', 'text', $sort['sort']);
				?>
				<input type="hidden" name="idcat" value="<?php echo $this->category->id; ?>" />
				<input type="hidden" name="ret" value="<?php echo base64_encode($this->ret); ?>" />
			</form>
		</div>
	</div>
	
	<div class="faql_legenda">
		<?php // legenda ?>
		<table border="0">
			<tr>
				<td>
					<img src="<?php echo $this->baseurl."media/com_faql/images/site/help_yes.png" ?>" alt="" />
				</td>
				<td>
					<?php echo JText::_('THERE_IS_AN_ANSWER').'&nbsp;&nbsp;<br />'.JText::_('IT_IS_PUBLISHED').'&nbsp;&nbsp;'; ?>
				</td>
				<td>
					<img src="<?php echo $this->baseurl."media/com_faql/images/site/help_no.png" ?>" alt="" />
				</td>
				<td>
					<?php echo JText::_('EXPECTS_THE_ANSWER').'&nbsp;&nbsp;<br />'.JText::_('IT_IS_PUBLISHED').'&nbsp;&nbsp;'; ?>
				</td>
			</tr>
			<?php if ($userfaql->get('manager') OR $userfaql->get('SuperUser')) : ?>
			<tr>
				<td>
					<img src="<?php echo $this->baseurl . "media/com_faql/images/site/help_ynp.png" ?>" alt="" />
				</td>
				<td>
					<?php echo JText::_('THERE_IS_AN_ANSWER').'&nbsp;&nbsp;<br />'.JText::_('IT_IS_NOT_PUBLISHED').'&nbsp;&nbsp;'; ?>
				</td>
				<td>
					<img src="<?php echo $this->baseurl . "media/com_faql/images/site/help_np.png" ?>" alt="" />
				</td>
				<td>
					<?php echo JText::_('EXPECTS_THE_ANSWER').'&nbsp;&nbsp;<br />'.JText::_('IT_IS_NOT_PUBLISHED').'&nbsp;&nbsp;'; ?>
				</td>
				<td>
					<img src="<?php echo $this->baseurl . "media/com_faql/images/site/help_da.png" ?>" alt="" />
				</td>
				<td>
					<?php echo JText::_('THE_DIRECT_ANSWER').'&nbsp;&nbsp;<br />'.JText::_('IT_IS_NOT_PUBLISHED').'&nbsp;&nbsp;'; ?>
				</td>
			</tr>
			<?php endif; ?>
		</table>
	</div>
	<div class="clr"> </div>

	<div id="questions" class="questions">
		<?php foreach ($this->items as $item) : ?>
			<?php $color = $this->params->get( 'background_color' ); ?>
			<?php 
				$usid = $this->user->id;
				if ($item->state == 0 AND $item->published == 1) $csub = ' noanswer';
				elseif ($item->state == 0 AND $item->published == 0) $csub = ' noanswnopubl';
				elseif ($item->state == 1) $csub = ' diranswer';
				elseif ($item->state == 2 AND $item->published == 1) $csub = '';
				elseif ($item->state == 2 AND $item->published == 0) $csub = ' yesanswnopubl';
			?>
			<?php $color_na = $this->params->get( 'back_color', '#000000' ); ?>
			<div class="question<?php echo $csub; ?>" id="question" style="<?php echo 'background-color:'.$color.'; color:'.$color_na.';'?>">
				<div><?php 
					// Show question
					$questtxt = $this->escape($item->question);
					$questtxt = preg_replace('/\\n/', '<br />', $questtxt );
					if ( $this->params->get( 'show_numbs', 1 ) == 1 ) {
						echo $item->id." - ".$questtxt;
					}
					else echo $questtxt;
				?></div>
							
				<?php /* Show author */ ?>
				<?php if ( $this->params->get( 'show_author', 0 ) ) : ?>
					<div class="divauthor" style="<?php echo "color:".inverseHex( $color ).";";?>">
						<?php echo JText::_('AUTHOR_QUESTION').": ".$item->created_by." - ".JHTML::_('date', $item->created, 'd-m-Y H:i:s'); ?>
					</div>
				<?php endif; ?>
							
				<?php /* Show author answer*/ ?>
				<?php if ( $this->params->get( 'show_autansw', 0 ) AND $item->state > 0) : ?>
					<?php
						$authansw = '';
						if ($item->author_answ) {
							$authansw = JFactory::getUser($item->author_answ)->name;
						}
					?>
					<div class="divauthor" style="<?php echo "color:".inverseHex( $color ).";";?>">
						<?php echo JText::_('AUTHOR_ANSWER').": ".$authansw." - ".JHTML::_('date',  $item->created_ans,  'd-m-Y H:i:s' ); ?>
					</div>
				<?php endif; ?>
							
				<?php /* For managers */ ?>
				<?php if (($userfaql->get('manager') AND ($usid == $item->whom OR $item->whom == -1)) OR $userfaql->get('SuperUser')) : ?>
					<?php if (!$item->checked_out) : ?>
						<?php if ($userfaql->get('faqlEdit') OR $userfaql->get('faqlDelete') OR $userfaql->get('SuperUser')) : ?>
							<?php if ($userfaql->get('faqlEdit') OR $userfaql->get('SuperUser')) : ?>
								<a style="margin-bottom:10px;" href="index.php?option=com_faql&view=faql&controller=admin&task=edit&catid=<?php echo $this->category->id; ?>&id=<?php echo $item->id; ?>&ret=<?php echo base64_encode($this->ret); ?>">
								<?php if ($item->state == 0) { ?>
									<span><?php echo JText::_( 'TO_ANSWER' ); ?></span></a>
								<?php } else { ?>	
									<span><?php echo JText::_( 'EDIT' ); ?></span></a>
								<?php } ?>
								&nbsp;&nbsp;&nbsp;
							<?php endif; ?>
						<?php endif; ?>
						<?php if ($userfaql->get('faqlDelete') OR $userfaql->get('SuperUser')) : ?>
							<a style="margin-bottom:10px;" href="index.php?option=com_faql&view=faql&controller=admin&task=delete&id=<?php echo $item->id; ?>&catid=<?php echo $this->category->id; ?>&ret=<?php echo base64_encode($this->ret); ?>" onclick="return confirm('<?php echo JText::_('CONFIRM_DELETE'); ?>')">
							<span><?php echo JText::_( 'DELETE' ); ?></span></a>
						<?php endif; ?>
					<?php else : ?>
						<span style="<?php echo "color:".inverseHex( $color ).";";?>"><?php echo JText::_( 'THIS_QUESTION_ALREADY_EDITS' ).' '.JFactory::getUser($item->checked_out)->name; ?></span>
					<?php endif; ?>
				<?php endif; ?>
			</div>
						
			<div class="answer">
				<?php echo $item->answer; ?>
			</div>
		<?php endforeach; ?>
	</div>

	<div class="pagination">
		<?php echo $this->pagination->getPagesLinks(); ?>
	</div>
	
<?php endif; ?>
