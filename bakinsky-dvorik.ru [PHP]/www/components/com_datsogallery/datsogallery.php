<?php
  defined('_JEXEC') or die('Restricted access');
  require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
  require_once (JPATH_COMPONENT_ADMINISTRATOR . DS . 'class.datsogallery.php');
  global $mainframe;
  $db = & JFactory::getDBO();
  $user = & JFactory::getUser();
  $uid = JRequest::getVar('uid', 0, 'get', 'int');
  $op = JRequest::getVar('op', 0, 'get', 'int');
  $id = JRequest::getVar('id', 0, 'get', 'int');
  $catid = JRequest::getVar('catid', 0, '', 'int');
  $cmtid = JRequest::getVar('cmtid', 0, 'get', 'int');
  $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
  $start = JRequest::getVar('start', 0, 'get', 'int');
  $sstring = JRequest::getVar('sstring', '', 'post');
  $sstring = JString::strtolower($sstring);
  $sstring = JRequest::getVar('sstring');
  $func = JRequest::getVar('func', null, 'default', 'cmd');
  $sorting = JRequest::getCmd('sorting');
  $org_screenshot = @ $_FILES['org_screenshot']['tmp_name'];
  $org_screenshot_name = @ $_FILES['org_screenshot']['name'];
  $thumbnailpath = JURI::base() . $ad_paththumbs . "/";
  if (@ $func == 'wmark') {
    require_once (JPATH_COMPONENT . DS . 'sub_wm.php');
    exit;
  }
  $lang = & JFactory::getLanguage();
  $datsolang = strtolower($lang->getBackwardLang());
  if (file_exists(JPATH_COMPONENT . DS . 'language' . DS . $datsolang . '.php')) {
    require (JPATH_COMPONENT . DS . 'language' . DS . $datsolang . '.php');
  }
  else {
    require (JPATH_COMPONENT . DS . 'language' . DS . 'english.php');
  }
  $javascript = "";
  $javascript .= "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\"></script>\n";
  $javascript .= "<script type=\"text/javascript\" src=\"" . JURI::base() . "components/com_datsogallery/libraries/jquery.color.js\"></script>\n";
  $javascript .= "<link rel=\"stylesheet\" href=\"" . JURI::base() . "components/com_datsogallery/css/dgstyle.css\" type=\"text/css\" />\n";
  $javascript .= "<script type=\"text/javascript\">
document.write('<div id=\"dhtmltooltip\"></div>');
document.write('<img id=\"dhtmlpointer\" src=\"" . JURI::base() . "components/com_datsogallery/images/tip_arrow.gif\">');
</script>\n";
  $mainframe->addCustomHeadTag($javascript);
  $mainframe->setPageTitle(_DG_GALLERY);
  $is_editor = (strtolower($user->usertype) == 'editor' || strtolower($user->usertype) == 'administrator' || strtolower($user->usertype) == 'super administrator');
  if ($ad_pathway) {
    JoomlaPathway($catid, $id, $func, $sorting);
  }
  function GalleryHeader() {
    global $mainframe;
    require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
    $thumbnailpath = JURI::base() . $ad_paththumbs . "/";
    $db = & JFactory::getDBO();
    $user = & JFactory::getUser();
    $id = JRequest::getVar('id', 0, 'get', 'int');
    $catid = JRequest::getVar('catid', 0, 'get', 'int');
    $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
  ?>

<table width='100%' cellpadding='3' cellspacing='4' border='0' align='center'>
        <?php
          if ($ad_comtitle) {
          ?>
  <tr>
    <td class='componentheading'><?php echo _DG_GALLERY;?></td>
  </tr>
              <?php
              }
            ?>
  <tr>
    <td>
    <table width='100%' border='0' cellspacing='0' cellpadding='0' id='dt1'>
        <tr>
          <td align='left' width='100%'><a href='<?php echo JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid);?>'>
                  <?php
                    if ($catid <> "") {
                      echo DatsoGalleryPathway($catid);
                    }
                    else
                      if ($id) {
                        $db->setQuery("select a.*, cc.name as category " . " from #__datsogallery as a, #__datsogallery_catg as cc " . " where a.catid=cc.cid and a.id=$id " . " and cc.access<='" . $user->get('aid') . "'");
                        $rows = $db->loadObjectList();
                        $row = & $rows[0];
                        echo DatsoGalleryPathway($row->catid);
                      }
                      else
                        if (!$catid && !$ad_pathway) {
                        ?>
            <img src='<?php echo JURI::base();?>components/com_datsogallery/images/dg-home-icon.gif' hspace='6' border='0' align='left' alt='' /><?php echo _DG_HOME;?></a>
                                    <?php
                                    }
                                  ?>
</td>
<?php
                              if ($ad_search) {
                              ?>
         <td align='right' class='directorypath' valign='middle'>
          <form action='<?php echo JRoute::_('index.php?option=com_datsogallery');?>' name='searchgalform' target='_top' method='post'>
              <input type='hidden' name='func' value='special' />
              <input type='hidden' name='sorting' value='find' />
              <input type='text' name='sstring' class='inputbox' onblur="if(this.value=='') this.value='';" onfocus="if(this.value=='<?php echo _DG_SEARCH;?>') this.value='';" value='<?php echo _DG_SEARCH;?>' />
            </form>
            </td>
          <?php } ?>
        </tr>
      </table>
      </td>
  </tr>
  <tr id='dt2'>
    <td align='right'>
                          <?php
                            if ($ad_showpanel) {
                              if ($user->username) {
                                if ($ad_userpannel) {
                                ?>
        <a href='<?php echo JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid);?>'><strong><?php echo _DG_USER_PANEL;?></strong></a> |
                                            <?php
                                            }
                                          }
                                          if ($ad_special) {
                                          ?>
        <a href='<?php echo JRoute::_("index.php?option=com_datsogallery&func=special&Itemid=" . $Itemid);?>'><?php echo _DG_MOST_VIEWED;?></a> |
                                      <?php
                                      }
                                      if ($ad_rating) {
                                      ?>
        <a href='<?php echo JRoute::_("index.php?option=com_datsogallery&func=special&sorting=rating&Itemid=" . $Itemid);?>'><?php echo _DG_TOP_RATED;?></a> |
                                      <?php
                                      }
                                      if ($ad_lastadd) {
                                      ?>
        <a href='<?php echo JRoute::_("index.php?option=com_datsogallery&func=special&sorting=lastadd&Itemid=" . $Itemid);?>'><?php echo _DG_LAST_ADDED;?></a> |
                                      <?php
                                      }
                                      if ($ad_lastcomment) {
                                      ?>
        <a href='<?php echo JRoute::_("index.php?option=com_datsogallery&func=special&sorting=lastcomment&Itemid=" . $Itemid);?>'><?php echo _DG_LAST_COMMENTED;?></a>
                                      <?php
                                      }
                                    ?>
      </td>
  </tr>
  <?php } ?>
  <tr>
    <td>
                        <?php
                  }
                  function GalleryFooter() {
                    require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
                  ?>
</td>
  </tr>
        <?php
          if ($ad_powered) {
          ?>
  <tr>
    <td align = 'center'><font class='small'><?php echo $ad_cr;?></font></td>
  </tr>
              <?php
              }
              else {
                $flink = array("<br />", "<a href='http://www.datso.fr'>Andrey Datso</a>");
                $rlink = array(" ", "Datso.fr");
                $ad_cr = str_replace($flink, $rlink, $ad_cr);
              ?>
  <tr>
    <td><span style='display:none'><?php echo $ad_cr;?></span></td>
  </tr>
              <?php
              }
            ?>
</table>
<script type="text/javascript" src="<?php echo JURI::base();?>components/com_datsogallery/libraries/datso.javascript.js"></script>
      <?php
        return;
      }
      switch (@ $func) {
        case 'download':
          DatsoDownload($id);
          break;
        case 'special':
          require (JPATH_COMPONENT . DS . 'sub_viewspecial.php');
          break;
        case 'detail':
          require (JPATH_COMPONENT . DS . 'sub_viewdetails.php');
          break;
        case 'vote':
          recordVote();
          break;
        case 'editpic':
          if (!$user->username) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid, _DG_YOU_NOT_LOGED));
          }
          GalleryHeader();
          editPic($uid, $option, $thumbnailpath);
          break;
        case 'savepic':
          if (!$user->username) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid, _DG_YOU_NOT_LOGED));
          }
          savePic($option);
          break;
        case 'deletepic':
          if (!$user->username) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid, _DG_YOU_NOT_LOGED));
          }
          deletePic($uid, $option);
          break;
        case 'commentpic':
          require (JPATH_COMPONENT . DS . 'sub_commentpic.php');
          break;
        case 'deletecomment':
          delComment();
          break;
        case 'viewcategory':
          GalleryHeader();
          $user = & JFactory::getUser();
          $aid = $user->get('aid', 0);
          $db->setQuery("select count(*) from #__datsogallery_catg where cid = " . $catid . " and access <= " . (int) $aid);
          $is_allowed = $db->loadResult();
          if (!$is_allowed) {
            $mainframe->redirect(JRoute::_('index.php?option=com_datsogallery&Itemid=' . $Itemid, false), _DG_NOT_ACCESS_THIS_DIRECTORY);
          }
          echo dgCategories($catid);
          require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
          $db->setQuery("select count(*) from #__datsogallery as a left join #__datsogallery_catg as c on c.cid=a.catid where a.published = '1' and a.catid = '" . $catid . "' and a.approved = 1 and c.access <= " . (int) $aid);
          $count = $db->loadResult();
          $gesamtseiten = floor($count / $ad_perpage);
          $seitenrest = $count % $ad_perpage;
          if ($seitenrest > 0) {
            $gesamtseiten++;
          }
          if (isset ($start)) {
            if ($start > $gesamtseiten) {
              $start = $gesamtseiten;
            }
            else
              if ($start < 1) {
                $start = 1;
              }
          }
          else {
            $start = 1;
          }
          if ($ad_picincat) {
            if ($count == 1) {
              $cpics = _DG_COUNT_PIC_ONE;
            }
            else
              if ($count > 1 && ($count < 5)) {
                $cpics = _DG_COUNT_PIC_TWO_TO_FOUR;
              }
              else
                if ($count > 4) {
                  $cpics = _DG_COUNT_PIC_MORE_THAN_FOUR;
                }
               // echo '' . _DG_THERE_ARE . " $count " . @ $cpics . " " . _DG_IN_CATEGORY . ' <p />';
          }
          $starting = ($start - 1) * $ad_perpage;
          $document = & JFactory::getDocument();
          $db->setQuery("SELECT * FROM #__datsogallery_catg WHERE cid = '" . $catid . "'");
          $rows = $db->loadObjectList();
          $vcat = $rows[0]->name;
          $colspan = $ad_perpage * 2;
          echo "<table width='100%' border='0' cellspacing='1' cellpadding='10'>";
          echo "<tr>\n<td colspan='" . $colspan . "' class='sectiontableheader' width='100%'";
          if ($count > $ad_perpage) {
            echo "<div class='page_gall' style='text-align:center; display:block;'>";
            echo _DG_PAGES . ': ';
            $prev = $start - 1;
            if ($prev > 0) {
              echo "<a href='" . JRoute::_("index.php?option=com_datsogallery&func=viewcategory&catid=$catid&start=$prev&Itemid=" . $Itemid) . "'><strong>&laquo;</strong></a> ";
            }
            for ($i = 1; $i <= $gesamtseiten; $i++) {
              if ($i == $start) {
                echo "$i ";
              }
              else {
                echo "<a href='" . JRoute::_("index.php?option=com_datsogallery&func=viewcategory&catid=$catid&start=$i&Itemid=" . $Itemid) . "'>$i</a> ";
              }
            }
            $next = $start + 1;
            if ($next <= $gesamtseiten) {
              echo "<a href='" . JRoute::_("index.php?option=com_datsogallery&func=viewcategory&catid=$catid&start=$next&Itemid=" . $Itemid) . "'><strong>&raquo;</strong></a> ";
            }
            echo "</div>";
          }
          echo "</td>\n</tr>\n";
          if ($start > 1) {
            $page = _DG_PAGE . $start;
          }
          else {
            $page = '';
          }
          $document->setTitle($vcat . $page);
          if ($ad_metagen) {
           if ($rows[0]->description) {
            $document->setDescription(limit_words($rows[0]->description, 25));
            $document->setMetadata('keywords', metaGen($rows[0]->description));
           }
          }
          $db->setQuery("select * from #__datsogallery as a left join #__datsogallery_catg as c on c.cid=a.catid where a.published = 1 and a.catid = '$catid' and a.approved = 1 and c.access <= " . (int) $aid . " order by a.ordering $ad_sortby limit " . $starting . "," . $ad_perpage);
          $rows = $db->loadObjectList();
          $rowcounter = 0;
          foreach ($rows as $row1) {
            if ($ad_cp == '1') {
              $cw = '100%';
            }
            else
              if ($ad_cp == '2') {
                $cw = '50%';
              }
              else
                if ($ad_cp == '3') {
                  $cw = '34%';
                }
                else
                  if ($ad_cp == '4') {
                    $cw = '25%';
                  }
                  else
                    if ($ad_cp == '5') {
                      $cw = '20%';
                    }
                    if ($rowcounter % $ad_cp == 0)
                      echo "<tr class='sectiontableentry2'>\n";
                    echo "<td width='" . @ $cw . "' align='center' valign='middle'>";
            if ($ad_showdetail)
              if ($ad_showrating) {
                if ($row1->imgvotes > 0) {
                  $fimgvotesum = number_format($row1->imgvotesum / $row1->imgvotes, 2, ",", ".");
                  $frating = "$fimgvotesum / $row1->imgvotes ";
                }
                else {
                  $frating = _DG_NO_VOTES;
                }
              }
              if ($ad_showcomment) {
                $db->setQuery("SELECT cmtid FROM #__datsogallery_comments WHERE cmtpic='$row1->id'");
                $comments_result = $db->query();
                $comments = mysql_num_rows($comments_result);
              }
              $dghits = _DG_HITS;
            $dgvotes = _DG_RATING;
            $dgcomment = _DG_COMMENT1;
            $tle = jsspecialchars($row1->imgtitle);
              echo "<a href='" . JRoute::_("index.php?option=com_datsogallery&func=detail&catid=$catid&id=$row1->id&Itemid=" . $Itemid) . "'";
              echo "onmouseover=\"showttip('";
              echo "<strong>$tle</strong>";
              if ($ad_showimgcounter > 0) {
                echo "<br />$dghits: $row1->imgcounter";
              }
              if ($ad_showrating > 0) {
                echo "<br />$dgvotes: $frating  ";
              }
              if ($ad_showcomment > 0) {
                echo "<br />$dgcomment : $comments";
              }
              echo "');\"";
              echo "onmouseout=\"hidettip();\"><img src='$thumbnailpath$row1->imgthumbname' id='dg-image' alt='" . $tle . "' /></a><br />";
            echo "</td>\n";
            $rowcounter++;
          }
          if ($rowcounter % $ad_cp <> 0) {
            for ($i = 1; $i <= ($ad_cp - ($rowcounter % $ad_cp)); $i++) {
              echo "<td width='" . @ $cw . "' valign='middle'>&nbsp;</td>\n";
            }
          }
          echo "</tr>\n</table>\n";
          break;
        case "showupload":
          if (!$user->username) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid), _DG_YOU_NOT_LOGED);
          }
          GalleryHeader();
          showUpload($option, @ $batchul);
          break;
        case "uploadhandler":
          if (!$user->username) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid), _DG_YOU_NOT_LOGED);
          }
          require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
          require_once (JPATH_COMPONENT_ADMINISTRATOR . DS . 'images.datsogallery.php');
          $is_editor = (strtolower($user->usertype) == 'editor' || strtolower($user->usertype) == 'administrator' || strtolower($user->usertype) == 'super administrator');
          if (!$is_editor && ($_FILES["org_screenshot"]["size"] > $ad_maxfilesize)) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid), _DG_SIX_ERR_ONE . "&nbsp;" . $ad_maxfilesize . "&nbsp;" . _DG_SIX_ERR_TWO);
          }
          $thumbcreation = JRequest::getVar('thumbcreation');
          $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
          $ad_pathimages = str_replace('/', DS, $ad_pathimages);
          $ad_paththumbs = str_replace('/', DS, $ad_paththumbs);
          $imagetype = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
          $imginfo = getimagesize($org_screenshot);
          $imginfo[2] = $imagetype[$imginfo[2]];
          if (!$imginfo[3]) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid), _DG_FILENAME_BAD);
          }
          else
            if ($imginfo[2] != 'GIF' && $imginfo[2] != 'JPG' && $imginfo[2] != 'PNG') {
              $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid), _DG_INVALID_IMG_TYPE);
            }
            else
              $org_screenshot_name = dgImgId($catid, $imginfo[2]);
          if ($org_screenshot)
            if ($ad_orgresize) {
              if (strlen($org_screenshot) > 0 && $org_screenshot != "none") {
                if ($imginfo[0] > $ad_orgwidth || $imginfo[1] > $ad_orgheight) {
                  dgImageCreate($org_screenshot, JPATH_SITE . $ad_pathoriginals . DS . $org_screenshot_name, $ad_orgwidth, $ad_orgheight, $ad_thumbquality, "1");
                }
                else {
                  copy($org_screenshot, JPATH_SITE . $ad_pathoriginals . DS . $org_screenshot_name);
                }
              }
            }
            if (!$ad_orgresize) {
              if (strlen($org_screenshot) > 0 && $org_screenshot != "none") {
                copy($org_screenshot, JPATH_SITE . $ad_pathoriginals . DS . $org_screenshot_name);
              }
            }
            if (strlen($org_screenshot) > 0 && $org_screenshot != "none") {
              if ($imginfo[0] > $ad_maxwidth || $imginfo[1] > $ad_maxheight) {
                dgImageCreate($org_screenshot, JPATH_SITE . $ad_pathimages . DS . $org_screenshot_name, $ad_maxwidth, $ad_maxheight, $ad_thumbquality, "1");
              }
              else {
                copy($org_screenshot, JPATH_SITE . $ad_pathimages . DS . $org_screenshot_name);
              }
            }
            if ($thumbcreation)
              dgImageCreate($org_screenshot, JPATH_SITE . $ad_paththumbs . DS . $org_screenshot_name, $ad_thumbwidth, $ad_thumbheight, $ad_thumbquality, $ad_crsc);
            $row = new DatsoImages($db);
          if (!$row->bind(JRequest::get('post', 'approved owner published ordering'))) {
            return JError::raiseWarning(500, $row->getError());
          }
          $db->setQuery("select ordering from #__datsogallery where catid='" . $row->catid . "' order by ordering desc limit 1");
          $ordering1 = $db->loadResult();
          $ordering = $ordering1 + 1;
          $row->ordering = $ordering;
          $row->imgdate = mktime();
          $row->owner = $user->username;
          $row->published = 1;
          if ($ad_approve) {
            $row->approved = 0;
          }
          else {
            $row->approved = 1;
          }
          if ($row->owner == $is_editor) {
            $row->approved = 1;
          }
          $row->imgoriginalname = $org_screenshot_name;
          $row->imgfilename = $org_screenshot_name;
          $row->imgthumbname = $org_screenshot_name;
          if ($row->owner == $is_editor) {
            $row->useruploaded = 0;
          }
          else {
            $row->useruploaded = 1;
          }
          if (!$row->store()) {
            echo "<script> alert('" . $row->getError() . "'); window.history.go(-1); </script>";
            exit ();
          }
          else {
            require_once (JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_messages' . DS . 'tables' . DS . 'message.php');
            $lang = & JFactory::getLanguage();
            $lang->load('com_messages');
            $query = 'SELECT id FROM #__users WHERE sendEmail = 1';
            $db->setQuery($query);
            $users = $db->loadResultArray();
            foreach ($users as $user_id) {
              $msg = new TableMessage($db);
              $msg->send($user->id, $user_id, _DG_NEW_PIC_SUBMITED, sprintf(_DG_NEW_CONTENT_SUBMITED . "%s " . _DG_TITLED . " %s.", $user->username, $row->imgtitle));
            }
          }
          $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid, false), _DG_PIC_SUCCESSFULLY_ADD);
          break;
        case "userpannel":
          if (!$user->username) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=showupload&Itemid=" . $Itemid, false), _DG_YOU_NOT_LOGED);
          }
          GalleryHeader();
          userPannel();
          break;
        case "send2friend":
          $Itemid = JRequest::getVar('Itemid', '', 'get', 'int');
          $send2friendname = JRequest::getVar('send2friendname', '', 'post', 'string');
          $send2friendemail = JRequest::getVar('send2friendemail', '', 'post', 'string');
          $from2friendname = JRequest::getVar('from2friendname', '', 'post', 'string');
          $from2friendemail = JRequest::getVar('from2friendemail', '', 'post', 'string');
          $id = JRequest::getVar('id', 0, 'post', 'int');
          //$siteurl = JFactory::getURI()->toString(array('scheme', 'host'));
          $text = $from2friendname . " (" . $from2friendemail . ")" . " " . _DG_INVITE_VIEW_PIC . " \r \n";
          $link = JRoute::_("index.php?option=com_datsogallery&func=detail&catid=" . $catid . "&id=" . $id . "&Itemid=" . $Itemid);
          $text .= $siteurl . $link . "\r\n";
          $subject = $mainframe->getCfg('sitename') . ' - ' . _DG_RECCOMEND_PIC_FROM_FREND;
          JUtility::sendMail($from2friendemail, $from2friendname, $send2friendemail, $subject, $text);
          $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=detail&catid=" . $catid . "&id=" . $id . "&Itemid=" . $Itemid), _DG_MAIL_SENT);
          break;
        default:
          GalleryHeader();
          echo dgCategories($catid);
          break;
      }
      GalleryFooter();
      function showUpload($option, $batchul) {
        global $mainframe;
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
        $is_editor = (strtolower($user->usertype) == 'editor' || strtolower($user->usertype) == 'administrator' || strtolower($user->usertype) == 'super administrator');
        $mainframe->setPageTitle(_DG_NEW_PICTURE);
        $db->setQuery("select count(*) from #__datsogallery where owner = '" . $user->username . "'");
        $count_pic = $db->loadResult();
        if ($is_editor) {
          $count_pic = false;
        }
        if ($count_pic >= $ad_maxuserimage) {
          $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid), _DG_MAY_ADD_MAX_OFF . ' ' . $ad_maxuserimage . ' ' . _DG_PICTURES);
        }
        $clist = ShowDropDownCategoryList($ad_category, "catid", ' size="1"');
      ?>
      <script type="text/javascript">
      function checkMe() {
      var form = document.adminForm;
      if (form.imgtitle.value == "") {
      alert("<?php echo _DG_PIC_MUST_HAVE_TITLE;?>");
      return false;
      } else if (form.catid.value == "0") {
      alert("<?php echo _DG_MUST_SELECT_CATEGORY;?>");
      return false;
      } else if (form.org_screenshot.value == "") {
      alert("<?php echo _DG_MUST_HAVE_FNAME;?>");
      return false;
      } else {
      form.submit();
      dgLoading();
      }
      }
      </script>
        <?php
          echo "<script type=\"text/javascript\">\n";
          echo "var xmlhttp;\n";
          echo "try{xmlhttp = new XMLHttpRequest();}catch(e){\n";
          echo "try{xmlhttp = new ActiveXObject(\"Msxml2.XMLHTTP\");}catch(e){\n";
          echo "try{xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");}catch(e){}}}\n";
          echo "function dgLoading() {\n";
          echo "if(!xmlhttp)return alert(\"No Http Transport.\");\n";
          echo "xmlhttp.open(\"GET\",document.location.href,true);\n";
          echo "xmlhttp.onreadystatechange = function() {\n";
          echo "if (xmlhttp.readyState == 4) {\n";
          echo "document.getElementById(\"status\").innerHTML = '<img src=\"" . JURI::base() . "components/com_datsogallery/images/loading.gif\" border=\"0\" align=\"absmiddle\">'\n";
          echo "}\n";
          echo "}\n";
          echo "xmlhttp.send(null);\n";
          echo "}\n";
          echo "</script>";
          echo "<table cellpadding='4' cellspacing='0' border='0' width='100%'>\n";
          echo "<tr>\n";
          echo "<td class='sectiontableheader'>\n" . _DG_NEW_PICTURE . "</td>\n";
          echo "</tr>\n";
          echo "</table>\n";
          echo "<table cellpadding='0' cellspacing='0' border='0' width='100%'>\n";
          echo "<form action='" . JRoute::_("index.php?option=com_datsogallery&func=uploadhandler&Itemid=" . $Itemid) . "' method='post' name='adminForm' enctype='multipart/form-data' onsubmit='checkform();'>";
          echo "<input type='hidden' name='option' value='" . $option . "'/>";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td width='20%' align='right'> " . _DG_TITLE . ":</td>\n";
          echo "<td width='80%'>\n";
          echo "<input class='inputbox' type='text' name='imgtitle' size='50' maxlength='100' value='" . htmlspecialchars(@ $row->imgtitle, ENT_QUOTES) . "' />";
          echo "<td valign='top'>" . dgTip(_DG_SHOWUPLOAD_1) . "</td>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign='top' align='right'>" . _DG_CATEGORY . ":</td>\n";
          echo "<td>\n";
          echo $clist;
          echo "<td valign='top'>" . dgTip(_DG_SHOWUPLOAD_2) . "</td>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign='top' align='right'>" . _DG_DESCRIPTION . ":</td>\n";
          echo "<td>\n";
          echo "<textarea class='inputbox' cols='47' rows='5' name='imgtext'>";
          echo htmlspecialchars(@ $row->imgtext, ENT_QUOTES);
          echo "</textarea>";
          echo "<td valign='top'>" . dgTip(_DG_SHOWUPLOAD_3) . "</td>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign='top' align='right'>" . _DG_AUTHOR_OWNER . ":</td>\n";
          echo "<td>\n";
          echo "<input class='inputbox' type='text' name='imgauthor' value='" . @ $row->imgauthor . "' size='50' maxlength='100' />";
          echo "<td valign='top'>" . dgTip(_DG_SHOWUPLOAD_4) . "</td>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign='top' align='right'>" . _DG_PICTURE . ":</td>\n";
          echo "<td>\n";
          echo "<input class='inputbox' type='file' name='org_screenshot'/><span style='padding:0 6px;font-weight:400'>" . _DG_TYPE . ":<span style='color:#669900;padding:0 6px'>JPEG, JPG, PNG, GIF</span></span>";
          echo "<td valign='top'>" . dgTip(_DG_SHOWUPLOAD_5 . $ad_maxwidth . ' x ' . $ad_maxheight . ' ' . _DG_MIN_WH_TWO . _DG_SHOWUPLOAD_6 . format_filesize($ad_maxfilesize) . '<br />' . _DG_SHOWUPLOAD_7) . "</td>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td colspan='3' align='center'>\n";
          echo "<input type='hidden' name='screenshot' value='ON' checked />";
          echo "<input type='hidden' name='thumbcreation' value='ON' checked />";
          echo "<div id='status'><input type='button' value='" . _DG_UPLOAD . "' class='button' onclick='checkMe();' />";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value='" . _DG_CANCEL_TB . "' class='button' onclick='javascript:history.go(-1);' /></div>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "</table>\n";
          echo "<input type='hidden' name='id' value='" . @ $row->id . "' />";
          echo "<input type='hidden' name='option' value='" . $option . "' />";
          echo "<input type='hidden' name='task' value=''/>";
          echo "</form>";
        }
        function editPic($uid, $option, $thumbnailpath) {
          global $mainframe;
          require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
          $db = & JFactory::getDBO();
          $user = & JFactory::getUser();
          $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
          $mainframe->setPageTitle(_DG_NSDES);
          $row = new DatsoImages($db);
          $row->load($uid);
          if ($row->owner != $user->username) {
            $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid), _DG_NOT_ALOWED_EDIT_PIC);
          }
          $clist = ShowDropDownCategoryList($row->catid, "catid", ' size="1"');
        ?>
      <script type="text/javascript">
      function checkMe() {
      var form = document.adminForm;
      if (form.imgtitle.value == '') {
      alert("<?php echo _DG_PIC_MUST_HAVE_TITLE;?>");
      return false;
      } else if (form.catid.value == '0') {
      alert("<?php echo _DG_MUST_SELECT_CATEGORY;?>");
      return false;
      } else {
      form.submit();
      dgLoading();
      }
      }
      </script>
        <?php
          echo "<script type=\"text/javascript\">\n";
          echo "var xmlhttp;\n";
          echo "try{xmlhttp = new XMLHttpRequest();}catch(e){\n";
          echo "try{xmlhttp = new ActiveXObject(\"Msxml2.XMLHTTP\");}catch(e){\n";
          echo "try{xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");}catch(e){}}}\n";
          echo "function dgLoading() {\n";
          echo "if(!xmlhttp)return alert(\"No Http Transport.\");\n";
          echo "xmlhttp.open(\"GET\",document.location.href,true);\n";
          echo "xmlhttp.onreadystatechange = function() {\n";
          echo "if (xmlhttp.readyState == 4) {\n";
          echo "document.getElementById(\"status\").innerHTML = '<img src=\"" . JURI::base() . "/components/com_datsogallery/images/loading.gif\" border=\"0\" align=\"absmiddle\">'\n";
          echo "}\n";
          echo "}\n";
          echo "xmlhttp.send(null);\n";
          echo "}\n";
          echo "</script>";
          echo "<table width='100%' cellpadding='0' cellspacing='0' border='0'>\n";
          echo "<tr>\n";
          echo "<td class='sectiontableheader'>\n " . _DG_NSDES . " </td>\n";
          echo "</tr>\n";
          echo "</table>\n";
          echo "<table cellpadding='0' cellspacing='0' border='0' width='100%'>\n";
          echo "<form action ='" . JRoute::_("index.php?option=com_datsogallery&func=savepic&Itemid=" . $Itemid) . "' method='post' name='adminForm' enctype='multipart/form-data' onsubmit='checkform();'>";
          echo "<input type = 'hidden' name = 'option' value = '" . $option . "'/>";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td width = '20%' align = 'right'>" . _DG_TITLE . ":</td>\n";
          echo "<td width = '80%'>";
          echo "<input class='inputbox' type='text' name='imgtitle' size='51' maxlength='100' value='" . htmlspecialchars($row->imgtitle, ENT_QUOTES) . "'/>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign='top' align='right'>" . _DG_CATEGORY . ":</td>\n";
          echo "<td>\n";
          echo $clist;
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign = 'top' align = 'right'>" . _DG_DESCRIPTION . ":</td>\n";
          echo "<td>\n";
          echo "<textarea class='inputbox' cols='47' rows='5' name='imgtext'>";
          echo htmlspecialchars($row->imgtext, ENT_QUOTES);
          echo "</textarea>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign = 'top' align = 'right'>" . _DG_AUTHOR_OWNER . ":</td>\n";
          echo "<td>\n";
          echo "<input class='inputbox' type='text' name='imgauthor' value='" . $row->imgauthor . "' size='51' maxlength='100' />";
          echo "</td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td valign = 'top' align = 'right'>" . _DG_PICTURE . ":</td>\n";
          echo "<td>\n<img src='" . $thumbnailpath . "/" . $row->imgthumbname . "' name='imagelib' id='dg-image' title='" . _DG_THUMB_PREVIEW . "' alt='' /></td>\n";
          echo "</tr>\n";
          echo "<tr class='sectiontableentry2'>\n";
          echo "<td colspan='2' align='center'>";
          echo "<div id='status'><input type='button' value='" . _DG_SAVE . "' class='button' onclick='checkMe();' />";
          echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='button' value='" . _DG_CANCEL_TB . "' class='button' onclick='javascript:history.go(-1);' /></div>";
          echo "</td>\n";
          echo "</tr>\n";
          echo "</table>\n";
          echo "<input type='hidden' name='id' value='" . $row->id . "' />";
          echo "<input type='hidden' name='option' value='" . $option . "' />";
          echo "<input type='hidden' name='task' value='savepic' />";
          echo "</form>";
        }
        function userPannel() {
          global $mainframe;
          require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
          $db = & JFactory::getDBO();
          $user = & JFactory::getUser();
          $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
          $db->setQuery("select count(*) from #__datsogallery where owner='$user->username' order by ordering desc");
          $total = $db->loadResult();
          $limit = JRequest::getVar('limit', $mainframe->getCfg('list_limit'));
          $limitstart = JRequest::getVar('limitstart', 0);
          jimport('joomla.html.pagination');
          $pageNav = new JPagination($total, $limitstart, $limit);
          $mainframe->setPageTitle(_DG_USER_PANEL);
        ?>
<script type="text/javascript">
function showThumb(title, name, dimensions) {
  html = '<div style="width:100%;text-align:center;vertical-align:middle;">'+title+'<img id="dg-image" style="margin:20px" src='+name+' name="imagelib" alt="No Pics" /><div style="text-align:left">'+dimensions+'</div></div>';
  showttip(html)
  }
</script>
      <?php
        echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>\n";
        echo "<tr>\n";
        echo "<td align='right'>\n";
        echo "<input type='button' name='Button' value='" . _DG_NEW_PICTURE . "'";
        echo "onclick = \"javascript:location.href='" . JRoute::_("index.php?option=com_datsogallery&func=showupload&Itemid=" . $Itemid) . "';\"";
        echo "class='button'>";
        echo "</td>\n";
        echo "</tr>\n";
        echo "<tr class='sectiontableheader'>";
        echo "<td width='40%'>" . _DG_PIC_NAME . "</td>\n";
        echo "<td width='60%'>" . _DG_CATEGORY . "</td>\n";
        echo "<td colspan='2'>" . _DG_ACTION . "</td>\n";
        if ($ad_approve) {
          echo "<td>\n" . _DG_APPROWED . "</td>\n";
        }
        echo "</tr>\n";
        $db->setQuery("select * from #__datsogallery where owner='$user->username' order by id desc limit $limitstart, $limit");
        $rows = $db->loadObjectList();
        $k = 0;
        if (count($rows)) {
          foreach ($rows as $row) {
            $k = 1 - $k;
            $kp = $k + 1;
            $imgprev = JURI::base() . $ad_paththumbs . "/$row->imgthumbname";
            $db->setQuery("SELECT cmtid FROM #__datsogallery_comments WHERE cmtpic='$row->id'");
            $comments_result = $db->query();
            $comments = mysql_num_rows($comments_result);
            $overlib = '<table>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_DATE_ADD;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= strftime("%d.%m.%Y %H:%M",$row->imgdate);
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_HITS;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $row->imgcounter;
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_DOWNLOADS;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $row->imgdownloaded;
            $overlib .= '</td>';
            $overlib .= '</tr>';
            if($row->imgvotes>0) {
            $fimgvotesum=number_format($row->imgvotesum / $row->imgvotes, 2, ",", ".");
              $dgvotes = "$fimgvotesum / $row->imgvotes";
            }
            else{
              $dgvotes = _DG_NO_VOTES;
            }
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_RATING;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $dgvotes;
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_COMMENT1;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $comments;
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '</table>';
            echo "<tr class = 'sectiontableentry" . $kp . "'>\n";
            echo "<td>\n<a href='" . JRoute::_("index.php?option=com_datsogallery&func=editpic&uid=$row->id&Itemid=" . $Itemid) . "' onmouseover=\"showThumb('" . _DG_EDIT . " : " . jsspecialchars($row->imgtitle) . "', '" . $imgprev . "', '".jsspecialchars($overlib)."')\" onmouseout=\"hidettip();\">" . $row->imgtitle . "</a></td>\n";
            echo "<td>\n" . ShowCategoryPath($row->catid) . "</td>\n";
            echo "<td align='center' width='20'>";
            echo "<a href='" . JRoute::_("index.php?option=com_datsogallery&func=editpic&uid=$row->id&Itemid=" . $Itemid) . "'>";
            echo "<img src='" . JURI::base() . "components/com_datsogallery/images/dg-edit-image-icon.png' width='16' height='16' border='0' title='" . _DG_NSDES . "' /></a>";
            echo "</td>\n";
            echo "<td align='center' width'20'>";
            echo "<a href=\"javascript:if (confirm('" . _DG_SURE_DELETE_SELECT_ITEM . "')){ location.href='" . JRoute::_("index.php?option=com_datsogallery&func=deletepic&uid=" . $row->id . "&Itemid=" . $Itemid) . "';}\" title='" . _DG_DELETE . "'>";
            echo "<img src='" . JURI::base() . "components/com_datsogallery/images/dg-delete-image-icon.png' width='16' border='0' /></a>\n";
            echo "</td>\n";
            if ($ad_approve) {
              if ($row->approved) {
                $a_pic = dgTip(_DG_PIC_APPROVED, 'dg-accept-icon.png');
              }
              else {
                $a_pic = dgTip(_DG_PIC_PENDING, 'dg-pending-icon.png');
              }
              echo "<td align='center' width='20'>" . $a_pic . "</td>\n";
            }
            echo "</tr>\n";
          }
        }
        else {
          echo "<tr class = 'sectiontableentry'" . @ $kp . "''>";
          echo "<td width='15' align='center' valign='middle'>";
          echo "<div align='center'><img src='images/M_images/arrow.png' width='9' height='9' /></div>";
          echo "</td>\n";
          echo "<td colspan='5'>" . _DG_NOT_HAVE_PIC . "</td>\n";
          echo "</tr>\n";
        }
        echo "</table>\n";
        echo "<br />";
        echo "<div align='center'>";
        echo $pageNav->getPagesLinks();
        echo "</div>";
      }
      function savePic($option) {
        global $mainframe;
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
        $is_editor = (strtolower($user->usertype) == 'editor' || strtolower($user->usertype) == 'administrator' || strtolower($user->usertype) == 'super administrator');
        $post = JRequest::get('post');
        $row = new DatsoImages($db);
        if (!$row->bind($post, "approved owner published orgimagename imgfilename imgthumbname")) {
          JError::raiseError(500, $row->getError());
        }
        $row->owner = $user->username;
        $row->published = 1;
        if ($ad_approve) {
          $row->approved = 0;
        }
        else {
          $row->approved = 1;
        }
        if ($row->owner == $is_editor) {
          $row->approved = 1;
        }
        if (!$row->store()) {
          JError::raiseError(500, $row->getError());
        }
        $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid, false), _DG_UIC_SUCCESS_IPDATED);
      }
      function deletePic($uid, $option) {
        global $mainframe;
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
        $ad_pathimages = str_replace('/', DS, $ad_pathimages);
        $ad_paththumbs = str_replace('/', DS, $ad_paththumbs);
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
        $db->setQuery("select owner from #__datsogallery where id=" . intval($uid));
        $own = $db->loadResult();
        if ($own !== $user->username) {
          $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid), _DG_NOT_ALOWED_DELETE_PIC);
        }
        if ($uid) {
          $row = new DatsoImages($db);
          $row->load($uid);
          if (file_exists(JPATH_SITE . $ad_pathoriginals . DS . $row->imgoriginalname)) {
            unlink(JPATH_SITE . $ad_pathoriginals . DS . $row->imgoriginalname);
          }
          if (file_exists(JPATH_SITE . $ad_pathimages . DS . $row->imgfilename)) {
            unlink(JPATH_SITE . $ad_pathimages . DS . $row->imgfilename);
          }
          if (file_exists(JPATH_SITE . $ad_paththumbs . DS . $row->imgthumbname)) {
            unlink(JPATH_SITE . $ad_paththumbs . DS . $row->imgthumbname);
          }
          $db->setQuery("delete from #__datsogallery_comments where cmtpic=$uid");
          if (!$db->query()) {
            echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
          }
          $db->setQuery("delete from #__datsogallery where id=$uid");
          if (!$db->query()) {
            echo "<script> alert('" . $db->getErrorMsg() . "'); window.history.go(-1); </script>\n";
          }
        }
        $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&func=userpannel&Itemid=" . $Itemid), _DG_PIC_COMMENT_DELETED);
      }
      function ShowDropDownCategoryList($cat, $cname = "cat", $extra = null, $flag = 0) {
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $arr_cat = explode(",", $ad_category);
        $category = "<select name=\"$cname\" class=\"inputbox\" $extra>";
        if ($flag == 1) {
          $add_category = true;
        }
        if (@ $add_category) {
          $category .= "<option value=0></option>";
        }
        else {
          $category .= "<option value='0'>" . _DG_SUBCAT_SELECT . "</option>";
        }
        $db->setQuery(" select * from #__datsogallery_catg where access<='" . $user->get('aid') . "' and published='1' order by ordering desc");
        $result = $db->query();
        $num_rows = mysql_num_rows($result);
        $i = 0;
        while ($i < $num_rows) {
          $category_id = mysql_result($result, $i, 'cid');
          $category_name = mysql_result($result, $i, 'name');
          if (in_array($category_id, $arr_cat)) {
            @ $category_list .= "<option value='$category_id' ";
            if ($category_id == $cat) {
              $category_list .= "selected";
            }
            $category_list .= ">" . ShowCategoryPath($category_id) . "</option>\n";
          }
          $i++;
        }
        $categories = explode("\n", $category_list);
        $category .= implode("\n", $categories);
        $category .= "</select>";
        return $category;
      }
      function dgCategories($catid) {
        global $mainframe;
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $thumbnailpath = JURI::base() . $ad_paththumbs . "/";
        $catid = JRequest::getVar('catid', 0, 'get', 'int');
        $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
        $limit = JRequest::getVar('limit', $ad_catsperpage);
        $limitstart = JRequest::getVar('limitstart', 0);
        $par = "select count(*) from #__datsogallery_catg as cid where parent=$catid and published='1' and access<='" . $user->get('aid') . "'";
        $db->setQuery($par);
        $total = $db->loadResult();
        jimport('joomla.html.pagination');
        $pageNav = new JPagination($total, $limitstart, $limit);
        $query = " select d.* " . " from #__datsogallery_catg as d " . " where d.parent=$catid and d.published='1' and access<='" . $user->get('aid') . "' " . " order by d.ordering desc limit " . $limitstart . ", " . $limit . " ";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        $num_rows = count($rows);
        $index = 0;
        if ($ad_ncsc > $num_rows) {
          $ad_ncsc = $num_rows;
        }
        else {
          $ad_ncsc = $ad_ncsc;
        }
        if ($ad_ncsc == '1') {
          $cw = '100%';
        }
        else
          if ($ad_ncsc == '2') {
            $cw = '50%';
          }
          else
            if ($ad_ncsc == '3') {
              $cw = '34%';
            }
            else
              if ($ad_ncsc == '4') {
                $cw = '25%';
              }
              else
                if ($ad_ncsc == '5') {
                  $cw = '20%';
                }
                $colspan = $ad_ncsc * 2;
        $output = '<table cellspacing="1" cellpadding="0" border="0" width="100%">';
        if (@ $rows[0]->parent) {
          $output .= '<tr><td align="left" colspan="' . $colspan . '" class="sectiontableheader">' . _DG_SUBCATEGORIES . '</td></tr>';
        }
        else
          if (@ $rows[0]->cid) {
            $output .= '<tr><td align="left" colspan="' . $colspan . '" class="sectiontableheader">' . _DG_CATEGORIES . '</td></tr>';
          }
          if ($num_rows)
            for ($row_count = 0; $row_count < ($num_rows / $ad_ncsc); $row_count++) {
              $output .= '<tr class="sectiontableentry2">';
              for ($i = 0; $i < $ad_ncsc; $i++) {
                $cur_name = @ $rows[$index];
                $output .= '<td align="center" valign="middle">';
                if (@ $cur_name->cid) {
                  $output .= '<a href="' . JRoute::_("index.php?option=com_datsogallery&func=viewcategory&catid=" . $cur_name->cid . "&Itemid=" . $Itemid) . '">';
                }
                if (!@ $cur_name->cid) {
                  $output .= '</td><td>&nbsp;</td>';
                }
                else {
                  $catid = $cur_name->cid;
                  $query = "select *, c.access from #__datsogallery as p " . " left join #__datsogallery_catg as c on c.cid=p.catid " . " where " . ($catid ? " ( p.catid in (" . $catid . ") )":'') . " and p.published = '1' and p.approved='1' and c.access<='" . $user->get('aid') . "' " . " || " . ($catid ? " ( c.parent in (" . $catid . ") )":'') . " and p.published = '1' and p.approved='1' and c.access<='" . $user->get('aid') . "' " . " order by rand() limit 1";
                  $db->setQuery($query);
                  $rows2 = $db->loadObjectList();
                  $row2 = & $rows2[0];
                  $db->setQuery($query);
                  $count = $db->loadResult();
                  if ($count > 0) {
                    $output .= '<img src="' . $thumbnailpath . $row2->imgthumbname . '" id="dg-image" title="' . _DG_OPEN_CAT . '" alt="" /></a></td>';
                    $output .= '<td class="sectiontableentry2" align="left" valign="top" width="' . $cw . '">';
                  }
                  else
                    if (GetThumbsInCats($cur_name->cid)) {
                      $output .= '<img src="' . $thumbnailpath . GetThumbsInCats($cur_name->cid) . '" id="dg-image" title="' . _DG_OPEN_CAT . '" alt="" /></a></td>';
                      $output .= '<td class="sectiontableentry2" align="left" valign="top" width="' . $cw . '">';
                    }
                    else
                      if (!$count) {
                        $output .= '<div style="background:url(' . JURI::base() . '/components/com_datsogallery/images/blank.gif) no-repeat;display:block;background-position: 50% 50%;width:' . $ad_thumbwidth . 'px;height:' . $ad_thumbheight . 'px"></div></td>';
                        $output .= '<td class="sectiontableentry2" align="left" valign="top" width="' . $cw . '">';
                      }
                }
                if ($cur_name && ($count) || (GetThumbsInCats(@ $cur_name->cid))) {
                  $output .= '<a href="' . JRoute::_("index.php?option=com_datsogallery&func=viewcategory&catid=" . @ $cur_name->cid . "&Itemid=" . $Itemid) . '">';
                  $output .= '<strong>' . @ $cur_name->name . '</strong></a>';
                }
                else
                  if ($cur_name) {
                    $output .= '<strong>' . $cur_name->name . '</strong>';
                  }
                  if (@ $cur_name->name) {
                    $output .= '<br /><span class="small">(' . GetNumberOfLinks($cur_name->cid) . ')';
                    if ($ad_showinformer) {
                      $output .= '&nbsp;' . GetNewPics($cur_name->cid);
                    }
                    $output .= '</span>';
                  }
                  $output .= '<br />' . @ $cur_name->description . '</td>';
                $index++;
              }
              $output .= '</tr>';
        }
        $output .= '</table>';
        if (@ $rows[0]->parent) {
          $parcid = $rows[0]->parent;
          if ($total > $ad_catsperpage) {
            $output .= "<div align='center'>";
            $output .= $pageNav->getPagesLinks("index.php?option=com_datsogallery&func=viewcategory&catid=" . $parcid . "&Itemid=" . $Itemid);
            $output .= "</div>";
          }
        }
        elseif (@ $rows[0]->cid) {
          if ($total > $ad_catsperpage) {
            $output .= "<div align='center'>";
            $output .= $pageNav->getPagesLinks("index.php?option=com_datsogallery&Itemid=" . $Itemid);
            $output .= "</div>";
          }
        }
        return $output;
      }
      function DatsoGalleryPathway($cat) {
        global $mainframe;
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $id = JRequest::getVar('id', 0, 'get', 'int');
        $catid = JRequest::getVar('catid', 0, '', 'int');
        $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
        $home = '<img src="' . JURI::base() . '/components/com_datsogallery/images/dg-home-icon.gif" hspace="6" border="0" align="left" alt="" />' . _DG_HOME . '</a>';
        $arrow = 'templates/' . $mainframe->getTemplate() . '/images/arrow.png';
        if (file_exists(JPATH_SITE . DS . $arrow)) {
          $picarrow = '<img src="' . JURI::base() . '/' . $arrow . '" hspace="4" alt="" />';
        }
        else {
          $arrow = '/images/M_images/arrow.png';
          if (file_exists(JPATH_SITE . DS . $arrow)) {
            $picarrow = '<img src="' . JURI::base() . '/images/M_images/arrow.png" hspace="4" alt="" />';
          }
          else {
            $picarrow = '&raquo;';
          }
        }
        $cat = intval($cat);
        $parent = 1000;
        while ($parent) {
          $db->setQuery(" select * from #__datsogallery_catg where cid=" . $cat . " and published=1 and access<='" . $user->get('aid') . "' ");
          $rows = $db->loadObjectList();
          $row = & $rows[0];
          $name = @ $row->name;
          $parent = @ $row->parent;
          $cid = @ $row->cid;
          $query = "select imgtitle from #__datsogallery where catid = $cat and id = $id";
          $db->setQuery($query);
          $pname = $db->loadResult();
          $name1 = $name;
          $name2 = "<a href='" . JRoute::_("index.php?option=com_datsogallery&func=viewcategory&catid=" . $cat . "&Itemid=" . $Itemid) . "'>" . $name . "</a>";
          if (empty ($path) && (!$id)) {
            $path = $name1;
          }
          else {
            $path = $name2 . $picarrow . @ $path . $pname;
          }
          $cat = $parent;
        }
        if (!$ad_pathway) {
          $pathName = $home . $picarrow . $path;
          return $pathName;
        }
      }
      function JoomlaPathway($catid, $id, $func = '', $sorting = '') {
        $mainframe = & JFactory::getApplication('site');
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $pathway = & $mainframe->getPathway();
        $Itemid = JRequest::getVar('Itemid', 0, 'get', 'int');
        $uid = JRequest::getVar('uid', 0, 'get', 'int');
        $sorting = JRequest::getCmd('sorting');
        switch ($func) {
          case 'userpannel':
            $pathway->addItem(_DG_USER_PANEL);
            break;
          case 'uploadhandler':
          case 'showupload':
            $pathway->addItem(_DG_USER_PANEL, 'index.php?option=com_datsogallery&func=userpannel&Itemid=' . $Itemid);
            $pathway->addItem(_DG_NEW_PICTURE);
            break;
          case 'editpic':
            $pathway->addItem(_DG_NSDES, 'index.php?option=com_datsogallery&func=editpic&uid=' . $uid . '&Itemid=' . $Itemid);
            break;
          case 'special':
            $pathway->addItem(_DG_MOST_VIEWED, 'index.php?option=com_datsogallery&func=special&Itemid=' . $Itemid);
            break;
        }
        switch ($sorting) {
          case 'rating':
            $pathway->addItem(_DG_TOP_RATED);
            break;
          case 'lastadd':
            $pathway->addItem(_DG_LAST_ADDED);
            break;
          case 'lastcomment':
            $pathway->addItem(_DG_LAST_COMMENTED);
            break;
        }
        if ($func != '' && $func != 'viewcategory' && $func != 'detail') {
          return;
        }
        if ($catid == 0 || $func == 'detail') {
          if ($id != 0) {
            $db->setQuery("SELECT a.id,a.imgtitle,a.catid
FROM #__datsogallery AS a, #__datsogallery_catg AS cc
WHERE a.catid = cc.cid AND a.id = $id AND cc.access <= '" . $user->get('aid') . "'");
            if (!$row = $db->loadObject()) {
              return false;
            }
            $catid = $row->catid;
          }
          else {
            return false;
          }
        }
        $cat_ids = array($catid);
        $cat_names = array();
        while ($catid != 0) {
          $db->setQuery("SELECT * FROM #__datsogallery_catg
WHERE cid = '" . $catid . "' AND published = '1' AND access <= '" . $user->get('aid') . "'");
          if (!$rows = $db->loadObjectList()) {
            $catid = 0;
          }
          else {
            $catid = $rows[0]->parent;
          }
          if ($catid != 0) {
            array_unshift($cat_ids, $catid);
          }
          @ array_unshift($cat_names, $rows[0]->name);
        }
        for ($i = 0; $i < count($cat_names); $i++) {
          $pathway->addItem($cat_names[$i], 'index.php?option=com_datsogallery&func=viewcategory&catid=' . $cat_ids[$i] . '&Itemid=' . $Itemid);
        }
        if (isset ($row->id)) {
          $pathway->addItem($row->imgtitle, 'index.php?option=com_datsogallery&func=detail&id=' . $row->id . '&Itemid=' . $Itemid);
        }
      }
      function GetNumberOfLinks($cat) {
        $db = & JFactory::getDBO();
        $queue[] = intval($cat);
        while (list($key, $cat) = each($queue)) {
          $db->setQuery("select cid from #__datsogallery_catg where parent=$cat and published=1");
          $result = $db->query();
          $total = mysql_num_rows($result);
          $j = 0;
          while ($j < $total) {
            $val = mysql_fetch_row($result);
            $queue[] = $val[0];
            $j++;
          }
        }
        reset($queue);
        $query = "select count(*) from #__datsogallery  where ( 0!=0";
        while (list($key, $cat) = each($queue)) {
          $query .= " or catid = $cat";
        }
        $query = $query . " ) and published=1 and approved = 1";
        $db->setQuery($query);
        $result = $db->query();
        $val = mysql_fetch_row($result);
        if ($val[0] == 1) {
          $capics = _DG_COUNT_PIC_ONE;
        }
        else
          if ($val[0] > 1 && ($val[0] < 5)) {
            $capics = _DG_COUNT_PIC_TWO_TO_FOUR;
          }
          else
            if ($val[0] > 4) {
              $capics = _DG_COUNT_PIC_MORE_THAN_FOUR;
            }
            else
              if ($val[0] == 0) {
                $capics = _DG_NO_PICS;
              }
              if ($val[0] == 0) {
                return $capics;
              }
              else {
                return $val[0] . ' ' . $capics;
        }
      }
      function ShowCategoryPath($cat) {
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $cat = intval($cat);
        $parent = 1000;
        while ($parent) {
          $db->setQuery("select * from #__datsogallery_catg where cid=$cat and access<='" . $user->get('aid') . "' ");
          $rows = $db->loadObjectList();
          $row = & $rows[0];
          $parent = $row->parent;
          $name = $row->name;
          if (empty ($path)) {
            $path = $name;
          }
          else {
            $path = $name . ' &raquo; ' . $path;
          }
          $cat = $parent;
        }
        return $path . " ";
      }
      function GetThumbsInCats($cat) {
        $db = & JFactory::getDBO();
        $queue[] = intval($cat);
        while (list($key, $cat) = each($queue)) {
          $db->setQuery("select cid from #__datsogallery_catg where parent=$cat and published=1");
          $result = $db->query();
          $total = mysql_num_rows($result);
          $j = 0;
          while ($j < $total) {
            $val = mysql_fetch_row($result);
            $queue[] = $val[0];
            $j++;
          }
        }
        reset($queue);
        $query = "select imgthumbname from #__datsogallery  where ( 0!=0";
        while (list($key, $cat) = each($queue)) {
          $query .= " or catid = $cat";
        }
        $query = $query . " ) and published=1 and approved = 1 order by rand() limit 1";
        $db->setQuery($query);
        $result = $db->query();
        $thumb = mysql_fetch_row($result);
        return $thumb[0];
      }
      function GetNewPics($cat) {
        global $mainframe;
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $db = & JFactory::getDBO();
        $queue[] = intval($cat);
        while (list($key, $cat) = each($queue)) {
          $db->setQuery("select cid from #__datsogallery_catg where parent=$cat and published=1");
          $result = $db->query();
          $total = mysql_num_rows($result);
          $j = 0;
          while ($j < $total) {
            $val = mysql_fetch_row($result);
            $queue[] = $val[0];
            $j++;
          }
        }
        reset($queue);
        $query = "select imgdate from #__datsogallery  where ( 0!=0";
        while (list($key, $cat) = each($queue)) {
          $query .= " or catid = $cat";
        }
        $query = $query . " ) and published=1 and approved = 1 order by imgdate desc limit 1";
        $db->setQuery($query);
        $result = $db->query();
        $newpics = mysql_fetch_row($result);
        $today = strtotime('now');
        $diff = intval(($today - $newpics[0]) / $ad_periods);
        if (!$diff) {
            return dgTip(_DG_INFORMER_TIP, 'new.gif', '', '', 0);
        }
        else {
          return false;
        }
      }
      function format_filesize($tfilesize) {
        global $dgfilesize;
        $format = array(_DG_FILESIZE_BYTES, _DG_FILESIZE_KB, _DG_FILESIZE_MB, _DG_FILESIZE_GB);
        $i = 0;
        while ($tfilesize >= 1024) {
          $i++;
          $tfilesize = $tfilesize / 1024;
        }
        return number_format($tfilesize, ($i ? 2:0), ",", ".") . " " . $format[$i];
      }
      function is_image($filename) {
        $ext = strtolower(strrchr($filename, "."));
        return ($ext == ".jpg" || $ext == ".jpeg" || $ext == ".png" || $ext == ".gif");
      }
      function is_zip($filename) {
        $ext = strtolower(strrchr($filename, "."));
        return ($ext == ".zip");
      }
      function dgImgId($catid, $imgext) {
        return substr(strtoupper(md5(uniqid(time()))), 5, 12) . '-' . $catid . '.' . strtolower($imgext);
      }
      function jsspecialchars($s) {
        $r = str_replace(array('\\', '"', "'"), array('\\\\', '&quot;', "&#039;"), $s);
        return htmlspecialchars($r, ENT_QUOTES);
      }
      function ampStrip($url) {
        $url = str_replace('&amp;', '&', $url);
        return $url;
      }
      function recordVote() {
        $db = & JFactory::getDBO();
        $rating = $cmtname = JRequest::getVar('rating', 'post');
        $id = JRequest::getVar('id', 0, 'get', 'int');
        if (($rating >= 1) && ($rating <= 5)) {
          $vip = $_SERVER['REMOTE_ADDR'];
          $db->setQuery("SELECT * FROM #__datsogallery_votes WHERE vpic = " . (int) $id . " AND vip LIKE '%" . $vip . "%'");
          $row = $db->loadObject();
          if (!$row) {
            $query = "INSERT INTO #__datsogallery_votes VALUES ( $id, '$vip' )";
            $db->setQuery($query);
            $db->query() or die($db->stderr());
            $query = "UPDATE #__datsogallery SET imgvotes = imgvotes + 1, imgvotesum = imgvotesum + " . (int) $rating . " WHERE id = " . (int) $id;
            $db->setQuery($query);
            $db->query() or die($db->stderr());
            echo 'thanks';
            exit;
          }
          else {
            echo 'voted';
            exit;
          }
        }
      }
      function dgTip($dgtip, $image = 'dg-info-icon.png', $text = '', $href = '#', $link = 0) {
        global $mainframe;
        if (!$text) {
          $image = JURI::base() . '/components/com_datsogallery/images/' . $image;
          $text = '<img src="' . $image . '" border="0" alt="dgtip"/>';
        }
        $style = 'style="text-decoration:none;color:#333;cursor:help"';
        if ($href) {
          $style = '';
        }
        else {
          $href = '#';
        }
        $mousover = 'showttip(\'' . jsspecialchars($dgtip) . '\');';
        $tip = "";
        if ($link) {
          $tip .= '<a href="' . $href . '" onmouseover="' . $mousover . '" onmouseout="hidettip();" ' . $style . '>' . $text . '</a>';
        }
        else {
          $tip .= '<span onmouseover="' . $mousover . '" onmouseout="hidettip();" ' . $style . '>' . $text . '</span>';
        }
        return $tip;
      }
      function DatsoDownload($id) {
        global $mainframe;
        $db = & JFactory::getDBO();
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $id = JRequest::getVar('id');
        $Itemid = JRequest::getVar('Itemid');
        $db->setQuery("select a.imgoriginalname " . " from #__datsogallery as a " . " where a.id = $id ");
        $imgoriginalname = $db->loadResult();
        $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
        $dir = JPATH_SITE . $ad_pathoriginals . DS;
        $filename = $dir . DS . $imgoriginalname;
        $filesize = filesize($filename);
        $ext = strtolower(substr(strrchr($filename, '.'), 1));
        if ($ext != 'jpg' && $ext != 'jpeg' && $ext != 'png' && $ext != 'gif') {
          $mainframe->redirect(JRoute::_("index.php?option=com_datsogallery&Itemid=" . $Itemid));
        }
        else {
          if (is_file($filename)) {
            $db->setQuery("update #__datsogallery set imgdownloaded = imgdownloaded + 1 where id = $id ");
            $db->query();
            ob_clean();
            header('Pragma: public');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Cache-Control: pre-check=0, post-check=0, max-age=0');
            header('Content-Transfer-Encoding: none');
            header('Accept-Ranges: bytes');
            header('Content-Length: ' . $filesize);
            header('Content-Type: application/force-download');
            header('Content-Disposition: attachment; filename=' . $imgoriginalname . '');
            echo @ readfile($filename);
            exit;
            ob_end_flush();
          }
        }
      }
      function get_ip($host) {
        $hostip = @ gethostbyname($host);
        $ip = ($hostip == $host) ? $host:long2ip(ip2long($hostip));
        return $ip;
      }
      function html2txt($document) {
        $search = array('@<script[^>]*?>.*?</script>@si', '@<[\/\!]*?[^<>]*?>@si', '@<style[^>]*?>.*?</style>@siU', '@<![\s\S]*?--[ \t\n\r]*>@');
        $text = preg_replace($search, '', $document);
        return $text;
      }
      function greatCommonDivisor($int1, $int2) {
        if (0 == $int1) {
          return 0 == $int2 ? 1:$int2;
        }
        if (0 == $int2) {
          return 1;
        }
        if ($int1 == $int2) {
          return $int1;
        }
        if (0 == $int1 % 2 && 0 == $int2 % 2) {
          return 2 * greatCommonDivisor((integer) ($int1 / 2), (integer) ($int2 / 2));
        }
        if (0 == $int1 % 2) {
          return greatCommonDivisor((integer) ($int1 / 2), $int2);
        }
        if (0 == $int2 % 2) {
          return greatCommonDivisor((integer) ($int2 / 2), $int1);
        }
        return greatCommonDivisor($int1, abs($int2 - $int1));
      }
      function simplifyFraction($fraction) {
        if (preg_match('/^(\d+)\/(\d+)$/', $fraction, $matches)) {
          $numerator = $matches[1];
          $denominator = isset ($matches[2]) && $matches[2] ? $matches[2]:1;
          $gcd = greatCommonDivisor($numerator, $denominator);
          return sprintf('%d/%d', $numerator / $gcd, $denominator / $gcd);
        }
        return $fraction;
      }
      function evalRational($value) {
        if (preg_match('/^(\d+)\/(\d+)$/', $value, $matches)) {
          $value = $matches[2] ? ($matches[1] / $matches[2]):0;
        }
        return (float) $value;
      }
      function metaGen($meta) {
        global $mainframe;
        $lang = & JFactory::getLanguage();
        $datsolang = strtolower($lang->getBackwardLang());
        $words = JPATH_COMPONENT . DS . 'words2ignore-' . $datsolang . '.txt';
        if (file_exists($words)) {
          $words = $words;
        }
        else {
          $msg = sprintf(_DG_META_GENERATOR_MSG, 'words2ignore-' . $datsolang . '.txt');
          $msg = $mainframe->enqueueMessage($msg, 'notice');
          return $msg;
        }
        $parsearray[] = trim($meta);
        $parsestring = mb_strtolower(join($parsearray, " "), "utf-8");
        $toremove = array('—', '“', '"', ',', '.', '-', '?', '•', ',', '.', ':', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '-', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.', ';', '{', '}', '[', ']', '|', '/', '<', '>', '+', '=');
        $parsestring = preg_replace('/[\r\n\t\s]+/s', ' ', $parsestring);
        $parsestring = html2txt($parsestring);
        $parsestring = str_replace($toremove, "", $parsestring);
        $commonwords = "";
        $fp = fopen($words, 'r');
        while (!feof($fp)) {
          $commonwords .= fread($fp, 1024);
        }
        fclose($fp);
        $commonwords = explode(" ", $commonwords);
        for ($i = 0; $i < count($commonwords); $i++) {
          $parsestring = str_replace(" " . $commonwords[$i] . " ", " ", $parsestring);
        }
        $parsestring = str_replace("  ", " ", $parsestring);
        $wordsarray = split(" ", $parsestring);
        for ($i = 0; $i < count($wordsarray); $i++) {
          $word = $wordsarray[$i];
          if (@ $freqarray[$word]) {
            $freqarray[$word] += 1;
          }
          else {
            $freqarray[$word] = 1;
          }
        }
        @ arsort($freqarray);
        $i = 0;
        while (list($key, $val) = @ each($freqarray)) {
          $i++;
          $freqall[$key] = $val;
          if ($i == 10) {
            break;
          }
        }
        for ($i = 0; $i < count($wordsarray) - 1; $i++) {
          $j = $i + 1;
          $word2 = $wordsarray[$i] . " " . $wordsarray[$j];
          if (@ $freqarray2[$word2]) {
            $freqarray2[$word2] += 1;
          }
          else {
            $freqarray2[$word2] = 1;
          }
        }
        @ arsort($freqarray2);
        $i = 0;
        while (list($key, $val) = @ each($freqarray2)) {
          $i++;
          $freqall[$key] = $val;
          if ($i == 3) {
            break;
          }
        }
        for ($i = 0; $i < count($wordsarray) - 2; $i++) {
          $j = $i + 1;
          $word3 = $wordsarray[$i] . " " . $wordsarray[$j] . " " . $wordsarray[$j + 1];
          if (@ $freqarray3[$word3]) {
            $freqarray3[$word3] += 1;
          }
          else {
            $freqarray3[$word3] = 1;
          }
        }
        @ arsort($freqarray3);
        $i = 0;
        while (list($key, $val) = @ each($freqarray3)) {
          $i++;
          $freqall[$key] = $val;
          if ($i == 1) {
            break;
          }
        }
        arsort($freqall);
        $pagecontents = "";
        $keys = "";
        while (list($key, $val) = each($freqall)) {
          $keys .= $key . ", ";
        }
        chop($keys);
        return rtrim($keys, ', ');
      }
      function limit_words($string, $word_limit) {
        $words = explode(" ", $string);
        $toremove = array('—', '“', '"', ',', '.', '-', '?', '•', ',', '.', ':', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '-', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '.', ';', '{', '}', '[', ']', '|', '/', '<', '>', '+', '=');
        $words = str_replace($toremove, "", $words);
        $words = preg_replace('/[\r\n\t\s]+/s', ' ', $words);
        $words = html2txt($words);
        return implode(" ", array_splice($words, 0, $word_limit));
      }
      function exifData($imagefile) {
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        if (function_exists('exif_read_data')) {
          if ($ad_exif) {
            $ext = strtolower(substr(strrchr(JPATH_SITE . $ad_pathoriginals . DS . $imagefile, '.'), 1));
            if ($ext == 'jpg' || $ext == 'jpeg') {
              $exif_data = exif_read_data(JPATH_SITE . $ad_pathoriginals . DS . $imagefile, 'IFD0');
              $dg_exif = "";
              if (isset ($exif_data['Make']) != "") {
                echo "<span style='float: right'>";
                if ($exif_data['Make']) {
                  $dg_exif .= "<span class=exifcamera>" . $exif_data['Make'] . "</span><br />";
                }
                if (isset ($exif_data['Model']) != "") {
                  $dg_exif .= "<span class=exifgray>" . _DG_EXIF_MODEL . ": <span class=exifolivedrab>" . $exif_data['Model'] . "</span></span><br />";
                }
                if (isset ($exif_data['ExposureTime']) != "") {
                  $dg_exif .= "<span class=exifgray>" . _DG_EXIF_EXPOSURE . ": <span class=exifolivedrab>" . sprintf('%s (%01.3f sec)', simplifyFraction($exif_data['ExposureTime']), evalRational($exif_data['ExposureTime'])) . "</span></span><br />";
                }
                if (isset ($exif_data['FNumber']) != "") {
                  $dg_exif .= "<span class=exifgray>" . _DG_EXIF_APERTURE . ": <span class=exifolivedrab>" . sprintf('f/%01.1f', evalRational($exif_data['FNumber'])) . "</span></span><br />";
                }
                if (isset ($exif_data['FocalLength']) != "") {
                  $dg_exif .= "<span class=exifgray>" . _DG_EXIF_FOCALLENGTH . ": <span class=exifolivedrab>" . sprintf('%01.1f mm', evalRational($exif_data['FocalLength'])) . "</span></span><br />";
                }
                if (isset ($exif_data['ISOSpeedRatings']) != "") {
                  $dg_exif .= "<span class=exifgray>" . _DG_EXIF_ISO . ": <span class=exifolivedrab>" . $exif_data['ISOSpeedRatings'] . "</span></span><br />";
                }
                if (isset ($exif_data['DateTime']) != "") {
                  $dg_exif .= "<span class=exifgray>" . _DG_EXIF_DATETIME . ": <span class=exifolivedrab>" . $exif_data['DateTime'] . "</span></span><p></p>";
                }
                echo dgTip($dg_exif, 'camera.png', '', '', 0);
                echo "</span>";
              }
            }
          }
        }
      }
      function delComment() {
        global $mainframe;
        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $is_editor = (strtolower($user->usertype) == 'editor' || strtolower($user->usertype) == 'administrator' || strtolower($user->usertype) == 'super administrator');
        $cmtid = JRequest::getVar('cmtid', 0, 'post', 'int');
        $param = JRequest::getVar('param', 'delete', 'post');
        if ($is_editor) {
          if ($cmtid) {
            $db->setQuery("DELETE FROM #__datsogallery_comments WHERE cmtid = " . $cmtid);
            $db->query() or die($db->stderr());
            exit;
          }
        }
      }
      function getGravatar($email) {
        require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
        $lowercase = strtolower($email);
        $md5 = md5($lowercase);
        $default = JURI::base() . "components/com_datsogallery/images/guest.gif";
        $gravatar = "http://www.gravatar.com/avatar.php?gravatar_id=";
        $gravatar .= $md5;
        $gravatar .= "&amp;";
        $gravatar .= "default=" . urlencode($default);
        $gravatar .= "&amp;size=50";
        echo "<img src='" . $gravatar . "' class='dg-avatar' alt='Gravatar' />";
      }
      function getjsAvatar($thumb) {
        echo "<img src='" . JURI::base() . $thumb . "' class='dg-avatar' alt='Avatar' />";
      }
      function dgPath($path){
        $path = str_replace('/', DS, $path);
        return $path;
      }
      function mb_preg_replace  ($pattern , $replacement , $subject)
            {
                return preg_replace($pattern."u",$replacement, $subject);
            }

      function DatsoBookmarker( $id, $title, $desc )
{
    require (JPATH_COMPONENT_ADMINISTRATOR . DS . 'config.datsogallery.php');
    $desc_tags 			= addslashes(str_replace("\n","",  $title ));
	$desc_tags 			= trim($desc_tags);
	$desc_tags_space	= str_replace(',', ' ', @$desc_tags_space);
	$desc_tags_semi 	= str_replace(',', ';', @$desc_tags_semi);
	$desc_tags_space    = str_replace('  ', ' ', @$desc_tags_space);
	$description1    	= strip_tags( $desc );
 	$description2    	= str_replace("'", '', strip_tags($description1));
	$description    	= str_replace('"', '', strip_tags($description2));
	$markme_title = $desc_tags;
	$markme_ddesc = substr($description,0,400).'...';


 	$baseurl = JURI::base();
	$google 	= JRequest::getVar('google', '1');
	$facebook 	= JRequest::getVar('facebook', '1');
	$twitter 	= JRequest::getVar('twitter', '1');
	$myspace 	= JRequest::getVar('myspace', '1');
	$linkedin 	= JRequest::getVar('linkedin', '1');
	$yahoo 		= JRequest::getVar('yahoo', '1');
	$digg 		= JRequest::getVar('digg', '1');
	$del 		= JRequest::getVar('del', '1');
	$live 		= JRequest::getVar('live', '1');
	$furl 		= JRequest::getVar('furl', '1');
	$reddit 	= JRequest::getVar('reddit', '1');
	$technorati = JRequest::getVar('technorati', '1');

    $html = '';

		$html.= ' <div onmouseover="javascript:if(document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display ==\'none\'){document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display =\'block\';}"
					onmouseout="javascript:if(document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display ==\'block\'){document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display =\'none\';}"
 					style="cursor:pointer">
 						<div>
							<img src="'.$baseurl."components/com_datsogallery/images/bookmarker/star.png".'" title="'._DG_ADD_TO_BOOKMARKS.'" border="0" alt="" width="16" height="16px" /></div>
						<div style="clear:both"></div>
					</div> ';


	$html.= '<div  onmouseover="javascript:if(document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display ==\'none\'){document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display =\'block\';}"
					onmouseout="javascript:if(document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display ==\'block\'){document.getElementById(\'divShowAddBookmarker'.$id.'\').style.display =\'none\';}"
					id="divShowAddBookmarker'.$id.'" style="font-size:10px;font-weight:bold;display:none;position:absolute;color:#333;background-color:#FFFFE0;width:210px;padding:3px;border:1px solid #E9E9A1;z-index:999">
 			<div style="padding:2px;">';
	if( $ad_google == 1 ) {
		$html.= '<div style="width:100px;float:left">
					<a style="text-decoration:none;" href="http://www.google.com" onclick="window.open(\'http://www.google.com/bookmarks/mark?op=add&amp;hl=en&amp;bkmk=\'+encodeURIComponent(location.href)+\'&amp;annotation='.$markme_ddesc.'&amp;labels='.$desc_tags.'&amp;title='.$markme_title.'\');return false;">
						<img style="vertical-align:bottom;padding:1px;" align="baseline" src="'.$baseurl."components/com_datsogallery/images/bookmarker/google.png".'" title="Google" name="Google" border="0" id="Google" alt="" />
						'.JText::_( 'Google' ).'
					</a>
				</div>';
 	}
	if( $ad_facebook == 1 ) {
		$html.= '<div style="width:100px;float:left">
					<a style="text-decoration:none;" href="http://www.facebook.com/" onclick="window.open(\'http://www.facebook.com/share.php?u=\'+encodeURIComponent(location.href)+\'&amp;t='.$markme_title.'&amp;d='.$markme_ddesc.'\');return false;">
					<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/facebook.png".'" title="Facebook" name="facebook" border="0" id="facebook" alt="" />
					'.JText::_( 'Facebook' ).'
				</a>
				</div>';
 	}
	if( $ad_twitter == 1 ) {
		$html.= '<div style="width:100px;float:left">
					<a style="text-decoration:none;" href="http://www.twitter.com/" onclick="window.open(\'http://twitter.com/home/?status=\'+encodeURIComponent(location.href)+\'-'.$markme_ddesc.'\');return false;">
						<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/twitter.png".'" title="twitter" name="twitter" border="0" id="twitter" alt="" />
						'.JText::_( 'Twitter' ).'
					</a>
				</div>';
 	}
	if( $ad_myspace == 1 ) {
		$html.= '<div style="width:100px;float:left">
					<a style="text-decoration:none;" href="http://www.myspace.com/" onclick="window.open(\'http://www.myspace.com/index.cfm?fuseaction=postto&amp;\' + \'t='.$markme_title.'&amp;u=\' + encodeURIComponent(location.href));return false;">
						<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/myspace.png".'" title="Myspace" name="myspace" border="0" id="myspace" alt="" />
						'.JText::_( 'Myspace' ).'
					</a>
				</div>';
 	}
	if( $ad_linkedin == 1 ) {
		$html.= '<div style="width:100px;float:left">
					<a style="text-decoration:none;" href="http://www.linkedin.com/" onclick="window.open(\'http://www.linkedin.com/shareArticle?mini=true&amp;url=\'+encodeURIComponent(location.href)+\'&amp;title='.$markme_title.'&amp;summary='.$markme_ddesc.'\');return false;">
						<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/linkedin.png".'" title="LinkedIn" name="linkedin" border="0" id="linkedin" alt="" />
						'.JText::_( 'Linkedin' ).'
					</a>
				</div>';
	}
	if( $ad_yahoo == 1 ) {
		$html.= '<div style="width:100px;float:left">
					<a style="text-decoration:none;" href="http://www.yahoo.com" onclick="window.open(\'http://myweb2.search.yahoo.com/myresults/bookmarklet?t='.$markme_title.'&amp;d='.$markme_ddesc.'&amp;tag='.$desc_tags.'&amp;u=\'+encodeURIComponent(location.href)); return false;">
						<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/yahoo.png".'" title="Yahoo" name="Yahoo" border="0" id="Yahoo" alt="" />
					'.JText::_( 'Yahoo' ).'
					</a>
				</div>';
	}
	if( $ad_digg == 1 ) {
		$html.= '<div style="width:100px;float:left">
		<a style="text-decoration:none;" href="http://digg.com" onclick="window.open(\'http://digg.com/submit?phase=2&amp;url=\'+encodeURIComponent(location.href)+\'&amp;bodytext='.$markme_ddesc.'&amp;tags='.$desc_tags_space.'&amp;title='.$markme_title.'\');return false;">
			<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/digg.png".'" title="Digg" name="Digg" border="0" id="Digg" alt="" />
			'.JText::_( 'Digg' ).'
		</a>
		</div>';
	}
	if( $ad_del == 1 ) {
		$html.= '<div style="width:100px;float:left">
		<a style="text-decoration:none;" href="http://del.icio.us" onclick="window.open(\'http://del.icio.us/post?v=2&amp;url=\'+encodeURIComponent(location.href)+\'&amp;notes='.$markme_ddesc.'&amp;tags='.$desc_tags_space.'&amp;title='.$markme_title.'\');return false;">
			<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/delicious.png".'" title="Del.icoi.us" name="Delicious" border="0" id="Delicious" alt="" />
			'.JText::_( 'Del.icoi.us' ).'
		</a>
		</div>';
	}
	if( $ad_live == 1 ) {
		$html.= '<div style="width:100px;float:left">
		<a style="text-decoration:none;" href="https://favorites.live.com/" onclick="window.open(\'https://favorites.live.com/quickadd.aspx?url=\'+encodeURIComponent(location.href));return false;">
			<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/windows.png".'" title="Windows Live" name="WindowsLive" border="0" id="WindowsLive" alt="" />
			'.JText::_( 'Windows Live' ).'
		</a>
		</div>';
	}
	if( $ad_furl == 1 ) {
		$html.= '<div style="width:100px;float:left">
		<a style="text-decoration:none;" href="http://www.furl.net/" onclick="window.open(\'http://www.furl.net/storeIt.jsp?u=\'+encodeURIComponent(location.href)+\'&amp;keywords='.$desc_tags.'&amp;t='.$markme_title.'\');return false; ">
			<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/furl.png".'" title="Furl" name="Furl" border="0" id="Furl" alt="" />
			'.JText::_( 'Furl' ).'
		</a>
		</div>';
 	}
	if( $ad_reddit == 1 ) {
		$html.= '<div style="width:100px;float:left">
			<a style="text-decoration:none;" href="http://reddit.com" onclick="window.open(\'http://reddit.com/submit?url=\'+encodeURIComponent(location.href)+\'&amp;title='.$markme_title.'\');return false;">
				<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/reddit.png".'" title="Reddit" name="Reddit" border="0" id="Reddit" alt="" />
				'.JText::_( 'Reddit' ).'
			</a>
		</div>';
	}
	if( $ad_technorati == 1 ) {
		$html.= '<div style="width:100px;float:left">
		<a style="text-decoration:none;" href="http://www.technorati.com/" onclick="window.open(\'http://technorati.com/faves?add=\'+encodeURIComponent(location.href)+\'&amp;tag='.$desc_tags_space.');return false; ">
			<img style="vertical-align:bottom;padding:1px;" src="'.$baseurl."components/com_datsogallery/images/bookmarker/technorati.png".'" title="Technorati" name="Technorati" border="0" id="Technorati" alt="" />
			'.JText::_( 'Technorati' ).'
		</a>
		</div>';
	}

	$html.= '<div style="clear:both"></div>
			</div>
			</div>';

	return $html;
}
    ?>
