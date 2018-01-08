<?php
  defined('_JEXEC') or die('Restricted access');
  if (@ $_REQUEST['is_editor']) {
    print "<script>document.location.href='../../index.php'</script>";
    exit ();
  }
  GalleryHeader();
  $document = & JFactory::getDocument();
  $imagetoolbar = "<meta http-equiv='imagetoolbar' content='no' />\n";
  $document->addCustomTag($imagetoolbar);
?>
<script type="text/javascript">
var stopstatus = 1;

function validatecomment() {
  <?php
    if (!$user->username) {
    ?>
    if (document.commentform.cmtname.value == "") {
      document.commentform.cmtname.focus();
      document.commentform.cmtname.style.backgroundColor = "#FFCCCC";
      document.getElementById("cmtname").innerHTML = '<font color="#DC143C"><?php echo _DG_ENTER_NAME;?></font>';
      return false;
    }
    if (document.commentform.cmtmail.value == "") {
      document.commentform.cmtmail.focus();
      document.commentform.cmtmail.style.backgroundColor = "#FFCCCC";
      document.getElementById("cmtmail").innerHTML = '<font color="#DC143C"><?php echo _DG_ENTER_EMAIL;?></font>';
      return false;
    }
    <?php
    }
  ?>

  if (document.commentform.cmttext.value == "") {
    document.commentform.cmttext.focus();
    document.commentform.cmttext.style.backgroundColor = "#FFCCCC";
    document.getElementById("cmttext_errmsg").innerHTML = '<font color="#DC143C"><?php echo _DG_ENTER_COMMENT;?></font>';
    return false;
  }

  if (document.commentform.vercode.value == "") {
    document.commentform.vercode.focus();
    document.commentform.vercode.style.backgroundColor = "#FFCCCC";
    document.getElementById("vercode").innerHTML = '<font color="#DC143C"><?php echo _DG_ENTER_CODE;?></font>';
    return false;
  } else {
    document.commentform.action = 'index.php';
    document.commentform.submit();
  }
}

function validatesend2friend() {
  if ((document.send2friend.send2friendname.value == '') || (document.send2friend.send2friendemail.value == '')) {
    alert('<?php echo _DG_ENTER_NAME_EMAIL;?>');
    return false;
  } else {
    document.send2friend.action = 'index.php';
    document.send2friend.submit();
  }
}
</script>
<?php
  $header = "";
  if ($ad_lightbox) {
    $header .= "<script type='text/javascript' src='" . JURI::base() . "components/com_datsogallery/libraries/clearbox/js/clearbox.js'></script>\n";
    $header .= "<link rel='stylesheet' href='" . JURI::base() . "components/com_datsogallery/libraries/clearbox/css/clearbox.css' type='text/css' />\n";
    $header .= "<script type='text/javascript'>
var
CB_PicDir='" . JURI::base() . "components/com_datsogallery/libraries/clearbox/pic/',
CB_NavTextClose='" . _DG_CB_CLOSE . "'
;
</script>\n";
  }
  if ($ad_showfrating) {
    $header .= "<script type='text/javascript' src='" . JURI::base() . "components/com_datsogallery/libraries/vote/vote.js'></script>\n";
    $header .= "<link rel='stylesheet' href='" . JURI::base() . "components/com_datsogallery/libraries/vote/vote.css' type='text/css' />\n";
  }
  if ($ad_bbcodesupport) {
    $header .= "<link rel='stylesheet' href='" . JURI::base() . "components/com_datsogallery/libraries/jquery.wysiwyg.css' type='text/css' />\n";
    $header .= "<script type='text/javascript' src='" . JURI::base() . "components/com_datsogallery/libraries/jquery.wysiwyg.js'></script>";
  }
  $document->addCustomTag($header);
  $db->setQuery("select c.access from #__datsogallery_catg as c left join #__datsogallery as a on a.catid = c.cid where a.id = $id ");
  $c_access = $db->loadResult();
  if ($user->get('aid') < $c_access) {
    $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid), _DG_NOT_ALLOWED_VIEW_PIC);
  }
  $db->setQuery("select a.id, a.catid, a.imgtitle, a.imgauthor, a.imgtext, a.imgdate, a.imgcounter, a.imgdownloaded, a.imgvotes, a.imgvotesum, a.published, a.imgoriginalname, a.imgfilename, a.imgthumbname, a.owner from #__datsogallery as a left join #__users as u on u.username = a.owner where a.id = " . $id);
  $list = $db->query();
  if (count($db->loadObjectList()) < 1) {
    $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid), _DG_PICSLAD);
  }
  list($id, $catid, $imgtitle, $imgauthor, $imgtext, $imgdate, $imgcounter, $imgdownloaded, $imgvotes, $imgvotesum, $published, $imgoriginalname, $imgfilename, $imgthumbname, $imgowner) = mysql_fetch_row($list);
  $db->setQuery("SELECT * FROM #__datsogallery WHERE id = '" . $id . "'");
  $rows = $db->loadObjectList();
  $imgtitle = $rows[0]->imgtitle;
  $imgtext = $rows[0]->imgtext;
  $document = & JFactory::getDocument();
  $document->setTitle($imgtitle);
  if ($ad_metagen) {
    if ($imgtext) {
      $document->setDescription(limit_words($imgtext, 25));
      $document->setMetadata('keywords', metaGen($imgtext));
    }
  }
  $id_cache = array();
  $query = "select * from #__datsogallery where catid = " . $catid . " and published = 1 and approved = 1 order by ordering " . $ad_sortby . "";
  $db->setQuery($query);
  $rows = $db->loadObjectList();
  if (count($rows)) {
    foreach ($rows as $row) {
      $id_cache[] = $row->id;
      $ft_cache[] = jsspecialchars($row->imgtitle);
      $url_cache[] = JRoute::_("index.php?option=com_datsogallery&func=detail&catid=" . $catid . "&id=" . $row->id . "&Itemid=" . $Itemid);
      $wm = JURI::base() . "index2.php?option=com_datsogallery&func=wmark";
      if (!$ad_showwatermark) {
        $fn_cache[] = JURI::base() . $ad_pathimages . "/" . $row->imgfilename;
      }
      else {
        $fn_cache[] = $wm . "&mid=" . $row->id;
      }
    }
  }
  $wm = str_replace("&", "&amp;", $wm) . "&amp;";
  $act_key = array_search($id, $id_cache);
  if ($ad_sortby == "ASC") {
    $nid = (isset ($id_cache[$act_key + 1])) ? $id_cache[$act_key + 1]:0;
    $pid = (isset ($id_cache[$act_key - 1])) ? $id_cache[$act_key - 1]:0;
  }
  else {
    $nid = (isset ($id_cache[$act_key - 1])) ? $id_cache[$act_key - 1]:0;
    $pid = (isset ($id_cache[$act_key + 1])) ? $id_cache[$act_key + 1]:0;
  }
  unset ($id_cache);
  if ($ad_slideshow)
    require (JPATH_COMPONENT . DS . 'sub_slideshow.php');
    $imgcounter++;
  $db->setQuery("update #__datsogallery set imgcounter = " . $imgcounter . " where id = " . $id);
  $db->query();

  list($fi_width, $fi_height) = getimagesize(JPATH_SITE.dgPath($ad_pathimages).DS.$imgfilename);
  if (!$ad_pnthumb) {
  ?>
<!-- Pictures Navigation Start -->
<p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>

<td style="width:33%;text-align:center">
<?php if ($ad_slideshow) {?>
<div id="dt4"><?php echo _DG_SLIDESHOW;?>: <a href="javascript:void(0);" onclick="stopstatus=0;runSlideShow();clearAttr();" id="controller"><?php echo _DG_START;?></a></div>
<div id="dt5" style="display:none"><?php echo _DG_SLIDESHOW;?>: <a onclick="endSlideShow();" style="cursor:pointer"><?php echo _DG_STOP;?></a> </div>
<?php }?>
</td>

</tr>
</table>
</p>
<p></p>
<!-- Pictures Navigation End -->

  <?php
    echo "<div align='center'>\n";
    /* Watermark without Clearbox */
    if ($ad_showwatermark && (!$ad_lightbox)) {
      echo "<img src='".$wm."mid=".$id."' class='imgxy' width='".$fi_width."' height='".$fi_height."' id='dg-image' name='SlideShow' alt='".$imgtitle."' />\n";
    }
    /* Clearbox without Watermark */
    elseif ((!$ad_showwatermark) && $ad_lightbox) {
      echo "<a rel='clearbox' href='".JURI :: base(true).$ad_pathoriginals.'/'.$imgoriginalname."' onmouseover='showttip(\"".jsspecialchars(_DG_VIEW_ORG_IMAGE)."\");'\n";
      echo "onmouseout=\"hidettip();\">\n";
      echo "<img src='".JURI :: base(true).$ad_pathimages.'/'.$imgfilename."' class='imgxy' width='".$fi_width."' height='".$fi_height."' id='dg-image' name='SlideShow' alt='".$imgtitle."' /></a>\n";
    }
    /* Without Watermark and Clearbox */
    elseif (!($ad_showwatermark && $ad_lightbox)) {
      echo "<img src='".JURI :: base(true).$ad_pathimages.'/'.$imgfilename."' class='imgxy' width='".$fi_width."' height='".$fi_height."' id='dg-image' name='SlideShow' alt='".$imgtitle."' />";
    }
    /* Watermark and Clearbox */
    else {
      echo "<a rel='clearbox' href='".$wm."oid=".$id."' onmouseover='showttip(\"".jsspecialchars(_DG_VIEW_ORG_IMAGE)."\");'\n";
      echo " onmouseout='hidettip();'>\n";
      echo "<img src='".$wm."mid=".$id."' class='imgxy' width='".$fi_width."' height='".$fi_height."' id='dg-image' name='SlideShow' alt='".$imgtitle."' /></a>";
    }
    echo "<div id='ImgText' style='padding-top:10px;font-size:16px'></div>\n";
    echo "</div>";
  }
  /* Pictures Navigation by Thumbnails Start */
  else {
    if ($ad_slideshow) {
    ?>

<?php }?>
<div style="position:relative;text-align:center;height:100%">

  <?php
    /* Watermark without Clearbox */
    if ($ad_showwatermark && (!$ad_lightbox)) {
      echo "<img src='".$wm."mid=".$id."' class='imgxy' width='".$fi_width."' height='".$fi_height."' id='dg-image' name='SlideShow' alt='".$imgtitle."' />\n";
    }
    /* Clearbox without Watermark */
    elseif ((!$ad_showwatermark) && $ad_lightbox) {
     // echo "<a href='".JURI :: base(true).$ad_pathoriginals.'/'.$imgoriginalname."' onmouseover='showttip(\"".jsspecialchars(_DG_VIEW_ORG_IMAGE)."\");'\n";
    //  echo " onmouseout='hidettip();'>\n";
      echo "<img src='".JURI :: base(true).$ad_pathimages.'/'.$imgfilename."' class='imgxy maria_img' id='dg-image' name='SlideShow' alt='".$imgtitle."' />\n";
    }
    /* Without Watermark and Clearbox */
    elseif (!($ad_showwatermark && $ad_lightbox)) {
      echo "<img src='".JURI :: base(true).$ad_pathimages.'/'.$imgfilename."' class='imgxy' width='".$fi_width."' height='".$fi_height."' id='dg-image' name='SlideShow' alt='".$imgtitle."' />";
    }
    /* Watermark and Clearbox */
    else {
      echo "<a rel='clearbox' href='".$wm."oid=".$id."' onmouseover='showttip(\"".jsspecialchars(_DG_VIEW_ORG_IMAGE)."\");'\n";
      echo " onmouseout='hidettip();'>\n";
      echo "<img src='".$wm."mid=".$id."' class='imgxy' id='dg-image' name='SlideShow' alt='".$imgtitle."' /></a>";
    }
  ?>

<div id="ImgText" style="padding-top:10px;font-size:16px"></div>
</div>
<?php } ?>
<div id='dt7'>
<?php
  if ($ad_showdetail) {
    $fimgdate = strftime("%d.%m.%Y %H:%M", $imgdate);
    $imgsize = filesize(JPATH_SITE . dgPath($ad_pathoriginals) . DS . $imgoriginalname);
    $dgfilesize = format_filesize($imgsize);
    $size_pic[0] = "";
    $size_pic[1] = "";
    $size_pic = @ getimagesize(JPATH_SITE . dgPath($ad_pathoriginals) . DS . $imgoriginalname);
    $x = "x";
    $res = "$size_pic[0] $x $size_pic[1]";
    $types = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
    $type = $types[$size_pic[2]];
    if ($imgvotes > 0) {
      $fimgvotesum = number_format($imgvotesum / $imgvotes, 2, ",", ".");
      $frating = " ( " . _DG_VOTES . ": $imgvotes )";
    }
    else {
      $frating = "( " . _DG_NO_VOTES . " )";
    }
  ?>
<p></p>
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td colspan='2' class='sectiontableheader'><span style="float: left"><?php echo $imgtitle;?></span>
         <?php
           if (($ad_showdownload && (!$ad_downpub) && ($user->username)) || ($ad_showdownload && ($ad_downpub))) {
             $download_icon = dgTip(_DG_SAVE_AS, $image = 'dg-download-icon.gif', '', JRoute::_("index.php?option=com_datsogallery&func=download&id=$id&Itemid=$Itemid"), $link = 1);
           }
           else
             if ($ad_showdownload && (!$ad_downpub) && (!$user->username)) {
               $download_icon = dgTip(_DG_LOGIN_FIRST, $image = 'dg-no-download-icon.gif', '', '', $link = 0);
             }
             else {
               $download_icon = "";
           }
         ?>
      <span style="float: right"><?php echo $download_icon;?></span> <?php echo exifData($imgoriginalname);?>
        <?php
          $user = & JFactory::getUser();
          if ($user->username == $imgowner) {
          ?>
      <span style="float: right"><?php echo dgTip(_DG_NSDES, $image = 'dg-edit-image-icon.png', '', JRoute::_("index.php?option=com_datsogallery&func=editpic&uid=$id&Itemid=" . $Itemid), $link = 1);?></span>
<?php } ?>
<?php if ($ad_bookmarker) { ?>
<span style="float:right"><?php echo DatsoBookmarker( $id, $imgtitle, $imgtext ); ?></span>
 <?php }?>
      </td>
  </tr>
     <?php
       if ($ad_showimgtext) {
         if ($imgtext) {
         ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_DESCRIPTION;?>:</strong></td>
    <td width='70%' valign='top'><?php echo nl2br($imgtext);?></td>
  </tr>
           <?php
           }
         }
         if ($ad_showfimgdate) {
         ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_DATE_ADD;?>:</strong></td>
    <td width='70%' valign='top'><?php echo $fimgdate;?></td>
  </tr>
        <?php
        }
        if ($ad_showimgcounter) {
        ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_HITS;?>:</strong></td>
    <td width='70%' valign='top'><?php echo $imgcounter;?></td>
  </tr>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_DOWNLOADS;?>:</strong></td>
    <td width='70%' valign='top'><?php echo $imgdownloaded;?></td>
  </tr>
        <?php
        }
        if ($ad_showrating) {
          if ($imgvotes > 0) {
            $result = number_format((intval($imgvotesum) / intval($imgvotes)) * 20, 2);
          }
          else {
            $result = "0";
          }
        ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='middle'><strong><?php echo _DG_RATING;?>:</strong></td>
    <td width='70%'>
      <?php
        echo "
<script type=\"text/javascript\">
<!--
var sfolder = '" . JURI::base(true) . "';
var vote_msg=Array('Your browser does not support AJAX','" . _DG_LOADING . "','" . _DGVOTE_THANKS . "','" . _DGVOTE_ALREADY_VOTE . "','" . _DG_VOTES . "','" . _DG_VOTES . "');
-->
</script>";
        $counter = - 1;
        $html = "";
        $html = "
<div class=\"vote-container-small\">
<ul class=\"vote-stars-small\">
<li id=\"rating_" . $id . "\" class=\"current-rating\" style=\"width:" . (int) $result . "%;\"></li>
<li><a href=\"javascript:void(null)\" onclick=\"javascript:vote(" . $id . ",1," . $imgvotesum . "," . $imgvotes . "," . $counter . ");\" title=\"" . JTEXT::_('Very Poor') . "\" class=\"dg-one-star\">1</a></li>
<li><a href=\"javascript:void(null)\" onclick=\"javascript:vote(" . $id . ",2," . $imgvotesum . "," . $imgvotes . "," . $counter . ");\" title=\"" . JTEXT::_('Poor') . "\" class=\"dg-two-stars\">2</a></li>
<li><a href=\"javascript:void(null)\" onclick=\"javascript:vote(" . $id . ",3," . $imgvotesum . "," . $imgvotes . "," . $counter . ");\" title=\"" . JTEXT::_('Regular') . "\" class=\"dg-three-stars\">3</a></li>
<li><a href=\"javascript:void(null)\" onclick=\"javascript:vote(" . $id . ",4," . $imgvotesum . "," . $imgvotes . "," . $counter . ");\" title=\"" . JTEXT::_('Good') . "\" class=\"dg-four-stars\">4</a></li>
<li><a href=\"javascript:void(null)\" onclick=\"javascript:vote(" . $id . ",5," . $imgvotesum . "," . $imgvotes . "," . $counter . ");\" title=\"" . JTEXT::_('Very Good') . "\" class=\"dg-five-stars\">5</a></li>
</ul>
</div>
<span id=\"vote_" . $id . "\" class=\"vote-count\">";
        $html .= $frating;
        $html .= "</span>";
        echo $html;
      ?>
</td>
  </tr>
        <?php
        }
        if ($ad_showres) {
        ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_SIZE;?>:</strong></td>
    <td width='70%' valign='top'><?php echo $res;?> / <?php echo $type;?></td>
  </tr>
        <?php
        }
        if ($ad_showfimgsize) {
        ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_FILESIZE;?>:</strong></td>
    <td width='70%' valign='top'><?php echo $dgfilesize;?></td>
  </tr>
        <?php
        }
        if ($ad_showimgauthor) {
          $db->setQuery("select id from #__users where username = '$imgowner'");
          $op = $db->loadResult();
          if (!$ad_js) {
            if ($imgauthor == NULL) {
            ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_AUTHOR;?>:</strong></td>
    <td width='70%' valign='top'><a href='<?php echo JRoute::_("index.php?option=com_datsogallery&func=special&sorting=owner&op=" . $op . "&Itemid=" . $Itemid);?>'> <strong><?php echo $imgowner;?></strong></a></td>
  </tr>
              <?php
              }
              else {
              ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_AUTHOR;?>:</strong></td>
    <td width='70%' valign='top'><a href='<?php echo JRoute::_("index.php?option=com_datsogallery&func=special&sorting=owner&op=" . $op . "&Itemid=" . $Itemid);?>'><strong><?php echo $imgauthor;?></strong></a></td>
  </tr>
              <?php
              }
            }
            else {
              $db->setQuery("SELECT id FROM #__menu WHERE link LIKE '%com_community%' AND published = 1");
              $jsItemid = $db->loadResult();
            ?>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_AUTHOR;?>:</strong></td>
    <td width='70%' valign='top'><a href='<?php echo JRoute::_("index.php?option=com_community&view=profile&userid=" . $op . "&Itemid=" . $jsItemid);?>'> <strong><?php echo $imgowner;?></strong></a></td>
  </tr>
           <?php
           }
         }
       ?>
</table>
   <?php
   }

    if ($ad_anoncomment) {
      $allowcomment = 1;
    }
    elseif ($user->username) {
      $allowcomment = 1;
    }
    else {
      $allowcomment = 0;
    }
    if ($ad_showcomment) {
       ?>
<table width='100%' cellpadding='0' cellspacing='0' border="0">
  <tr class='sectiontableheader'>
    <td width='30%' height='20'><?php echo _DG_AUTHOR;?></td>
    <td width='70%' height='20'><?php echo _DG_COMMENT1;?></td>
  </tr>
  <?php
      $db->setQuery("SELECT * FROM #__datsogallery_comments WHERE cmtpic = " . $id . " ORDER BY cmtid ASC");
      $rez = $db->query();
      while ($res = mysql_fetch_assoc($rez)) {
        if (!$ad_js && $res['cmtmail']) {
          $umail = $res['cmtmail'];
        }
        else {
          $query = "SELECT id, email FROM #__users WHERE (( name = '" . $res['cmtname'] . "' ) OR ( username = '" . $res['cmtname'] . "' ))";
          $db->setQuery($query);
          $result = $db->loadObject();
          $jsid = @$result->id;
          $umail = @$result->email;
          if ($ad_js) {
          $db->setQuery("SELECT thumb FROM #__community_users WHERE userid = '" . $jsid . "'");
          $jsthumb = $db->loadResult();
          if (!$jsthumb) {
            $umail = @$result->email;
          }
          }
        }
      ?>
  <tr class="sectiontableentry1" id="commentid-<?php echo $res['cmtid'];?>">
    <td valign='top'>
    <table width="100%" cellpadding='0' cellspacing='0' border='0'>
        <tr>
          <td class="small"><strong><?php echo $res['cmtname'];?></strong></td>
        </tr>
      </table>
      <div style="margin-top:6px">
              <?php
                if (!$ad_js) {
                  getGravatar($umail);
                }
                else {
                  if ($jsthumb) {
                    echo getjsAvatar($jsthumb);
                  }
                  else {
                    echo "<img src='" . JURI::base() . "components/com_community/assets/default_thumb.jpg' class='dg-avatar' alt='' />";
                  }
                }
              ?>
      </div></td>
          <?php
            $signtime = strftime("%d.%m.%Y %H:%M", $res['cmtdate']);
            $origtext = stripslashes($res['cmttext']);
          ?>
    <td valign='top'>
    <table width='100%' cellpadding='0' cellspacing='0' border="0">
        <tr class="sectiontableentry1">
          <td width='16'><img src='<?php echo JURI::base();?>/components/com_datsogallery/images/dg-time-icon.gif' alt='' /></td>
          <td class="small"><strong><?php echo _DG_COMM_ADDED;?>: <?php echo $signtime;?></strong></td>
                <?php
                  if ($is_editor) {
                  ?>
          <td width='16'><?php echo dgTip('User IP: ' . $res['cmtip'], 'dg-computer-icon.gif', '', '', 0);?></td>
          <td width='16' class="delete"><?php echo dgTip(_DG_DELETE_COMMENT, 'dg-delete-comment-icon.gif', '', '#', 0);?></td>
                   <?php
                   }
                 ?>
        </tr>
      </table>
      <div><?php echo $origtext;?></div></td>
  </tr>
        <?php
        }
        ?>
        </table>

<script type="text/javascript">
$(document).ready(function () {
  $('.delete').click(function (e) {
    e.preventDefault();
    var parent = $(this).parent().parent().parent().parent().parent();
    $.ajax({
      type: 'post',
      url: '<?php echo JURI::base();?>index2.php?option=com_datsogallery&func=deletecomment&no_html=1',
      data: '&cmtid=' + parent.attr('id').replace('commentid-', ''),
      cache: false,
      beforeSend: function () {
        parent.animate({
          'backgroundColor': '#FFD2D2'
        },
        500);
      },
      success: function () {
        parent.fadeOut(1000, function () {
          parent.remove();
        });
      }
    });
  });
});
</script>
<style type="text/css">
.delete	{ cursor: pointer; }
</style>

<form name='commentform' action='index.php' method='post' onsubmit='return validatecomment()'>
  <input type='hidden' name='option' value='com_datsogallery' />
  <input type='hidden' name='func' value='commentpic' />
  <input type='hidden' name='catid' value='<?php echo $catid;?>' />
  <input type='hidden' name='id' value='<?php echo $id;?>' />
  <input type='hidden' name='Itemid' value='<?php echo $Itemid;?>' />
  <table width='100%' border='0' cellspacing='0' cellpadding='0'>

       <?php

       if ($allowcomment) {
         if ($user->username && $ad_name_or_user == "name") {
           $cauthor = "<label>" . $user->name . "</label><input type='hidden' name='cmtname' value='" . $user->name . "' />";
         }
         else
           if ($user->username && $ad_name_or_user == "user") {
             $cauthor = "<label>" . $user->username . "</label><input type='hidden' name='cmtname' value='" . $user->username . "' />";
           }
           else {
             $cauthor = "<label>" . _DG_YOUR_NAME . "</label><br />
<input type='text' name='cmtname' size='28' class='inputbox' maxlength='20' /><br /><span id='cmtname' class='small'></span><br />
<label>" . _DG_YOUR_MAIL . "</label><br />
<input type='text' name='cmtmail' size='28' class='inputbox' /><br /><span id='cmtmail' class='small'></span><br />";
         }
       ?>
    <tr class='sectiontableentry1'>
      <td width='30%' valign='top'><?php echo $cauthor;?></td>
      <td width='70%' valign='top'><label><?php echo _DG_YOUR_COMMENT;?></label>
        <br />
        <textarea name="cmttext" style="height:160px;width:320px" id="cmttext"></textarea>
        <br />
        <span id="cmttext_errmsg"></span>
<script type="text/javascript">
var agent=navigator.userAgent.toLowerCase();
var is_iphone = (agent.indexOf('iphone')!=-1);
if (!is_iphone) {
$(function(){$('#cmttext').wysiwyg();});
}
</script></td>
    </tr>
    <tr class='sectiontableentry1'>
      <td width='130'><input type='submit' value='<?php echo _DG_SEND;?>' name='submit' class='button' /></td>
      <td align='right'>
   <?php
     if ($ad_security) {
       $dgrandom = strtoupper(substr(str_shuffle('0123456789abcdefghjkmnpqrstuvwxyz'), 0, 5));
     ?>
        <span style='float:left;'>
        <input type='text' name='vercode' class='inputbox' style='vertical-align:middle' size='7' autocomplete='off' />
        <img src='<?php echo JURI::base();?>/components/com_datsogallery/captcha.php?dgrandom=<?php echo $dgrandom;?>' style='border:1px solid #EEEEEE;vertical-align:middle' alt='' /> &nbsp;
        <input name='codemd5' type='hidden' id='codemd5' value='<?php echo md5($dgrandom);?>'>
        <span style='vertical-align:middle'><?php echo dgTip(_DG_VERCODE, 'dg-info-icon.png', '', '', 0);?></span>&nbsp;<span id="vercode" class="small"></span></span>
              <?php
              }
            ?>
</td>
    </tr>
  </table>
</form>
<?php
      }
    }

   if ($ad_showsend2friend) {
     if ($user->username) {
     ?>
<form method='post' name='send2friend'>
<input type='hidden' name='func' value='send2friend' />
<input type='hidden' name='from2friendname' value='<?php echo $user->name;?>' />
<input type='hidden' name='from2friendemail' value='<?php echo $user->email;?>' />
<input type='hidden' name='catid' value='<?php echo $catid;?>' />
<input type='hidden' name='id' value='<?php echo $id;?>' />
<input type='hidden' name='Itemid' value='<?php echo $Itemid;?>' />
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td class='sectiontableheader' colspan='2'><?php echo _DG_SEND_FRIEND;?></td>
  </tr>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_YOUR_NAME;?>:</strong></td>
    <td width='70%' valign='top'><?php echo $user->name;?></td>
  </tr>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_YOUR_MAIL;?>:</strong></td>
    <td width='70%' valign='top'><?php echo $user->email;?></td>
  </tr>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_FRIENDS_NAME;?>:</strong></td>
    <td width='70%' valign='top'><input type='text' name='send2friendname' size='15' class='inputbox' /></td>
  </tr>
  <tr class='sectiontableentry1'>
    <td width='30%' valign='top'><strong><?php echo _DG_FRIENDS_MAIL;?>:</strong></td>
    <td width='70%' valign='top'><input type='text' name='send2friendemail' size='15' class='inputbox'></td>
  </tr>
  <tr class='sectiontableentry1'>
    <td colspan='2' valign='top'><input type='button' name='send' value='<?php echo _DG_SEND;?>' class='button' onclick='validatesend2friend()' /></td>
  </tr>
</table>

</form>
      <?php
      }
    }
  ?>
</div>
