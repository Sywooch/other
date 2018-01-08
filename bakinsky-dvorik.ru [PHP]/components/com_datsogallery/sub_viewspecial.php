<?php
  defined('_JEXEC') or die('Restricted access');
  $header="<link rel='stylesheet' href='".JURI::base()."components/com_datsogallery/libraries/vote/vote.css' type='text/css' />\n";
  $mainframe->addCustomHeadTag($header);
  jimport('joomla.html.pagination');
  $limit  = $ad_toplist;
  $limitstart  = JRequest::getVar('limitstart', 0, 'int');
  $page_nav_links ='';
  GalleryHeader();
  switch($sorting) {
    case 'find':
      $db->setQuery("select * "
      ." from #__datsogallery as a, #__datsogallery_catg "
      ." as ca where a.catid=ca.cid "
      ." and (( a.imgtitle like '%$sstring%' ) || ( a.imgtext like '%$sstring%' )) "
      ." and a.published='1' "
      ." and a.approved=1 "
      ." and ca.published='1' "
      ." and ca.access<=".$user->get('aid')." "
      ." order by a.id desc"
      );
      $tl_title=_DG_SEARCH_RESULTS." $sstring ";
      $pw_title=_DG_SEARCH_RESULTS." $sstring ";
      break;
    case 'lastcomment':
      $query = "SELECT count(*) AS count FROM #__datsogallery AS d JOIN #__datsogallery_comments AS c ON c.cmtpic = d.id WHERE d.published=1 AND d.approved=1";
		$db->setQuery($query);
		$row = $db->LoadObject();
		$total = $row->count;
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$page_nav_links = $pageNav->getPagesLinks();
      $db->setQuery("select a.*, cc.cmtid "
      ." from #__datsogallery as a, #__datsogallery_comments as cc, "
      ." #__datsogallery_catg as ca "
      ." where a.id=cc.cmtpic "
      ." and a.catid=ca.cid "
      ." and cc.cmtid=(select max(ab.cmtid) "
      ." from #__datsogallery_comments as ab "
      ." where a.id=ab.cmtpic) "
      ." and a.published='1' "
      ." and a.approved=1 "
      ." and ca.published='1' "
      ." and ca.access<=".$user->get('aid')." "
      ." group by a.id order by cc.cmtid desc limit $limitstart, $limit"
      );
      $tl_title=_DG_LAST_COMMENTED;
      $pw_title=_DG_LAST_COMMENTED;
      break;
    case 'lastadd':
    $query = "SELECT count(*) AS count FROM #__datsogallery WHERE published=1 AND approved=1 ";
		$db->setQuery($query);
		$row = $db->LoadObject();
		$total = $row->count;
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$page_nav_links = $pageNav->getPagesLinks();
      $db->setQuery("select * "
      ." from #__datsogallery as a, #__datsogallery_catg "
      ." as ca where a.catid=ca.cid "
      ." and a.published=1 "
      ." and a.approved=1 "
      ." and ca.published=1 "
      ." and ca.access<=".$user->get('aid')." "
      ." order by a.id desc limit $limitstart, $limit"
      );
      $tl_title=_DG_LAST_ADDED;
      $pw_title=_DG_LAST_ADDED;
      break;
    case 'rating':
    $query = "SELECT count(*) AS count FROM #__datsogallery WHERE imgvotes > 0 AND published=1 AND approved=1 ";
		$db->setQuery($query);
		$row = $db->LoadObject();
		$total = $row->count;
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$page_nav_links = $pageNav->getPagesLinks();
      $db->setQuery("select *, imgvotesum "
      ." as rating from #__datsogallery "
      ." as a, #__datsogallery_catg "
      ." as ca where a.catid=ca.cid "
      ." and a.imgvotes > 0 "
      ." and a.published = 1  "
      ." and a.approved = 1  "
      ." and ca.published = 1  "
      ." and ca.access<=".$user->get('aid')." "
      ." order by rating desc limit $limitstart, $limit"
      );
      $tl_title=_DG_TOP_RATED;
      $pw_title=_DG_TOP_RATED;
      break;
    case 'owner':
      $db->setQuery("select username from #__users where id = '$op'");
	    $imgowner=$db->loadResult();

	    $query = "SELECT count(*) AS count FROM #__datsogallery WHERE owner = '$imgowner' AND published=1 AND approved=1 ";
		$db->setQuery($query);
		$row = $db->LoadObject();
		$total = $row->count;
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$page_nav_links = $pageNav->getPagesLinks();
      $db->setQuery("select * "
      ." from #__datsogallery as a, #__datsogallery_catg "
      ." as ca where a.catid=ca.cid "
      ." and a.published=1 "
      ." and a.owner = '$imgowner' "
      ." and a.approved=1 "
      ." and ca.published=1 "
      ." and ca.access<=".$user->get('aid')." "
      ." order by a.id desc limit $limitstart, $limit"
      );
      $tl_title=_DG_FROM_USER." $imgowner";
      $pw_title=_DG_FROM_USER." $imgowner";
      break;
    default:
    $query = "SELECT count(*) AS count FROM #__datsogallery WHERE published=1 AND approved=1 ";
		$db->setQuery($query);
		$row = $db->LoadObject();
		$total = $row->count;
		$pageNav = new JPagination( $total, $limitstart, $limit );
		$page_nav_links = $pageNav->getPagesLinks();
      $db->setQuery("select * "
      ." from #__datsogallery "
      ." as a, #__datsogallery_catg "
      ." as ca where a.catid=ca.cid "
      ." and a.published=1 "
      ." and a.approved=1 "
      ." and ca.published=1 "
      ." and ca.access<=".$user->get('aid').""
      ." order by imgcounter desc limit $limitstart, $limit"
      );
      $tl_title=_DG_MOST_VIEWED;
      $pw_title=_DG_MOST_VIEWED;
      break;
  }
  $rows=$db->loadObjectList();
  $mainframe->setPageTitle($pw_title);
?>
<table width='100%' border='0' cellspacing='1' cellpadding='10'>
    <tr><td colspan='4' class='sectiontableheader' width='100%'><?php echo $tl_title; ?></td></tr>

    <?php
      $rowcounter=0;
      if(count($rows)) {
        foreach($rows as $row) {
        ?>
    <tr class='sectiontableentry1'>
    <td align='center'>
    <a href='<?php echo JRoute::_("index.php?option=com_datsogallery&amp;func=detail&amp;catid=".$row->catid."&amp;id=".$row->id."&amp;Itemid=".$Itemid); ?>'>
    <img src='<?php echo $thumbnailpath.$row->imgthumbname; ?>' id='dg-image' alt='' /></a>
    </td>
    <td width='100%' valign='top'><strong><?php echo $row->imgtitle; ?></strong>
    <span class="small">
                  <?php
                    if($ad_showdetail)
                      $picdate=strftime("%d.%m.%Y %H:%M",$row->imgdate);
                    echo "<br /><strong>"._DG_DATE_ADD."</strong>: $picdate ";
                    echo "<br /><strong>"._DG_HITS."</strong>: $row->imgcounter ";
                    if($ad_showrating) {
                      if($row->imgvotes>0) {
                        $fimgvotesum=number_format(intval($row->imgvotesum)/intval($row->imgvotes),2)*20;
                        $dgvotes = "( "._DG_VOTES.": ".$row->imgvotes." )";
                      }
                      else{
                        $fimgvotesum="0";
                        $dgvotes = "( "._DG_NO_VOTES." )";
                      }
                      echo "<br /><strong>"._DG_RATING."</strong>:
                      <div class=\"vote-container-small\">
                        <ul class=\"vote-stars-small\">
                          <li id=\"rating_".$row->id."\" class=\"current-rating\" style=\"width: ".$fimgvotesum."%;cursor:default\"></li>
                        </ul>
                      </div>
                    <span id=\"vote_".$row->id."\" class=\"vote-count\"> ".$dgvotes."</span>";
                    }
                    if($ad_showcomment) {
                      $db->setQuery("select cmtid from #__datsogallery_comments where cmtpic='".$row->id."'");
                      $comments_result=$db->query();
                      $comments=mysql_num_rows($comments_result);
                      echo "<br /><strong>"._DG_COMMENTS."</strong>: $comments";
                    }
                  ?>
    </span>
	</td>
                  <?php
                    $rowcounter++;
                  }
                }
              ?>
    </tr>
</table>
<br />
<div align='center'>
<?php echo $page_nav_links; ?>
</div>