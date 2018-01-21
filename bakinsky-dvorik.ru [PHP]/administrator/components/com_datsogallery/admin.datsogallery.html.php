<?php

defined('_JEXEC') or die('Restricted access');

class datsogallery_html
{

  function showPictures($option, &$rows, &$clist, &$slist, &$search, &$pageNav)
  {
    global $mainframe;
    $db = & JFactory :: getDBO();
    require (JPATH_COMPONENT.DS.'config.datsogallery.php');

//    $db->setQuery( "ALTER TABLE `#__datsogallery` ADD `imgdownloaded` int(11) NOT NULL default '0' AFTER `imgcounter`");
//    if (!$db->query()) {}
//    $db->setQuery( "ALTER TABLE `#__datsogallery_comments` ADD `cmtmail` varchar(100) NOT NULL default '' AFTER `cmtname`");
//    if (!$db->query()) {}
    ?>

  <form action="index2.php" method="post" name="adminForm">
    <table>
      <tr>
        <td align="left" width="100%"><?php echo _DG_SEAR;?>:&nbsp;
          <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onchange="document.adminForm.submit();" /></td>
        <td nowrap="nowrap"><?php echo $clist;?></td>
        <td nowrap="nowrap"><?php echo $slist;?></td>
      </tr>
    </table>
    <table class="adminlist">
      <tr>
      <thead>
      <th align="center">#ID</th>
        <th><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" /></th>
        <th class="title" width="12%"><?php echo _DG_TITLE;?></th>
        <th width="28%" align="left"><?php echo _DG_CATEGORY;?></th>
        <th width="5%"><?php echo _DG_HITS;?></th>
        <th width="10%" align="left"><?php echo _DG_RATING;?></th>
        <th width="5%"> <span align="center"><?php echo _DG_ORDER;?></span> </th>
        <th width="5%"> <span align="center">
        <a href="javascript: saveorder( <?php echo count($rows) - 1;?> )"> <img src="images/filesave.png" border="0" width="16" title="<?php echo _DG_SAVEORDER_PICS;?>" alt="" /></a></span> </th>
        <th width="5%"><?php echo _DG_PUBLISHED;?></th>
        <th width="5%"><?php echo _DG_APPROWED;?></th>
        <th width="10%"><?php echo _DG_AUTHOR_OWNER;?></th>
        <th width="5%"><?php echo _DG_TYPE;?></th>
        <th width="10%"><?php echo _DG_DATE_ADD;?></th>
        </thead>
      </tr>
          <?php

          $k = 0;
          for ( $i = 0, $n = count($rows); $i < $n; $i++ )
          {
            $row = & $rows[$i];
            if ($row->imgvotes > 0)
            {
              $fimgvotesum = number_format($row->imgvotesum / $row->imgvotes, 2, ",", ".");
              $frating = "$fimgvotesum / $row->imgvotes";
            }
            else
            {
              $frating = _DG_NO_VOTES;
            }
            $taska = $row->approved ? 'rejectpic':'approvepic';
            $imga = $row->approved ? 'dg-accept-icon.png':'dg-pending-icon.png';
            $task = $row->published ? 'unpublish':'publish';
            $img = $row->published ? 'dg-accept-icon.png':'dg-pending-icon.png';
            $db->setQuery("select id from #__users where username='$row->owner'");
            $userid = $db->loadResult();
            $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
            $imgprev = $mainframe->getSiteURL().$ad_paththumbs.'/'.$row->imgthumbname;
            $info = getimagesize(JPATH_SITE.$ad_pathoriginals.DS.$row->imgoriginalname);
            $size = filesize(JPATH_SITE.$ad_pathoriginals.DS.$row->imgoriginalname);
            $type = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
            $info[2] = $type[$info[2]];
            $fsize = format_filesize($size);
            $overlib = '<table>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_ORG_WIDTH;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $info[0].' '._DG_PIXELS;
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_ORG_HEIGHT;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $info[1].' '._DG_PIXELS;
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_ORG_TYPE;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $info[2];
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '<tr>';
            $overlib .= '<td>';
            $overlib .= _DG_FILESIZE;
            $overlib .= '</td>';
            $overlib .= '<td>: ';
            $overlib .= $fsize;
            $overlib .= '</td>';
            $overlib .= '</tr>';
            $overlib .= '</table>';


            ?>
  <script type="text/javascript">
  function showInfo(title, name, dimensions) {
  html = '<div style="width:100%;text-align:center;vertical-align:middle;">'+title+'<img id="dg-image" style="margin:20px" src='+name+' name="imagelib" alt="No Pics" /><div style="text-align:left">'+dimensions+'</div></div>';
  showttip(html)
  }
  function editEntry(number) {
  var elm = document.getElementById('cb'+number);
  if (elm) {
  elm.checked = true;
  }
  }
  </script>
      <tr class="<?php echo "row$k";?>">
        <td><?php echo $row->id;?></td>
        <td><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->id;?>" onclick="isChecked(this.checked);" /></td>
        <td><a href="javascript:editEntry(<?php echo $i;?>); submitform('edit');"
  onmouseover="showInfo('<?php echo jsspecialchars($row->imgtitle);?>', '<?php echo $imgprev;?>', '<?php echo $overlib;?>')" onmouseout="hidettip();"><b><?php echo $row->imgtitle;?></b></a></td>
        <td><?php echo ShowCategoryPath($row->catid);?></td>
        <td align="center"><?php echo $row->imgcounter;?></td>
        <td><?php echo $frating;?></td>
        <td class="order"><?php echo $pageNav->orderUpIcon( $i, ($row->catid == @ $rows[$i - 1]->catid));?>&nbsp;&nbsp; <?php echo $pageNav->orderDownIcon( $i, $n, ($row->catid == @ $rows[$i + 1]->catid));?></td>
        <td align="center"><input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" class="text_area" style="text-align:center" /></td>
        <td align='center'><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"> <img src="<?php echo $mainframe->getSiteURL();?>/components/com_datsogallery/images/<?php echo $img;?>" width="16" height="16" border="0" alt="" /></a></td>
        <td align='center'><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $taska;?>')"> <img src="<?php echo $mainframe->getSiteURL();?>/components/com_datsogallery/images/<?php echo $imga;?>" width="16" height="16" border="0" alt="" /></a></td>
        <td align="center"><b><?php echo $row->owner;?></b></td>
        <td align="center"><?php if ($row->useruploaded) {?>
          <img src="<?php echo $mainframe->getSiteURL();?>/components/com_datsogallery/images/dg-user-icon.png" title="<?php echo _DG_USER_UPLOAD;?>">
          <?php }else {?>
          <img src="<?php echo $mainframe->getSiteURL();?>/components/com_datsogallery/images/dg-admin-icon.png" title="<?php echo _DG_ADMIN_UPLOAD;?>">
          <?php }?></td>
        <td width="10%" align="center"><?php echo strftime("%d.%m.%Y %H:%M", $row->imgdate);?></td>
              <?php

              $k = 1 - $k;
              echo "</tr>";
            }


            ?>
      <tfoot>
      <th colspan="13"> <?php echo $pageNav->getListFooter();?></th>
        </tfoot>
      </tr>
    </table>
    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
  </form>
      <?php

    }

    function movePic($rows, $lists)
    {
      global $mainframe;
      $cid        = JRequest::getVar( 'cid', array(0), '', 'array' );
      require (JPATH_COMPONENT.DS.'config.datsogallery.php');
    ?>
  <script type="text/javascript">
  function showInfo(title, name) {
  html = '<div style="width:100%;text-align:center;vertical-align:middle;">'+title+'<img id="dg-image" style="margin:20px" src='+name+' name="imagelib" alt="No Pics" /></div>';
  showttip(html)
  }
  function editEntry(number) {
  var elm = document.getElementById('cb'+number);
  if (elm) {
  elm.checked = true;
  }
  }
  </script>
  <form action="index2.php" method="post" name="adminForm" >
    <fieldset>
      <legend>&nbsp;<?php echo _DG_MASS_MOVING_OF_PICS;?>&nbsp;</legend>
      <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminheading">
        <tr>
          <td><?php echo $lists['catgs'] ?></td>
          <td width="100%">&nbsp;&nbsp;<?php echo dgTip(_DG_MOVE_TO_CATEGORY);?></td>
        </tr>
      </table>
      <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist">
        <tr>
          <th width="2%">#ID</th>
          <th class="title" width="20%"> <?php echo _DG_PICS_TO_MOVING;?> </th>
          <th width="75%"> <div align="left"> <?php echo _DG_CURRENT_CATEGORY;?> </div>
          </th>
        </tr>
            <?php
            if(count($rows) > 0)
            foreach($rows as $row) {
              $imgprev = $mainframe->getSiteURL().$ad_paththumbs.'/'.$row->imgthumbname;
             ?>
        <tr>
          <td align="center" width="2%" style="padding:7px"><?php echo $row->id;?></td>
          <td align="left" width="20%"><a href="javascript:void(0);" onmouseover="showInfo('<?php echo $row->imgtitle;?>', '<?php echo $imgprev;?>')" onmouseout="hidettip();" style="cursor: default"><b><?php echo $row->imgtitle;?></b></a></td>
          <td><div align="left" width="75%"> <?php echo ShowCategoryPath($row->catid);?> </div></td>
        </tr>
              <?php

            }


            ?>
        <tr>
          <th align="center" colspan="3"> </th>
        </tr>
      </table>
    </fieldset>
    <input type="hidden" name="option" value="com_datsogallery" />
    <input type="hidden" name="task" value="movepicres" />
    <input type="hidden" name="boxchecked" value="1" />
        <?php

        foreach ($cid as $cids)
        {
          echo "<input type='hidden' name='id[]' value='".$cids."' />";
        }


        ?>
  </form>
      <?php

    }

    function editPicture($option, & $row, & $clist, & $originallist, & $imagelist, & $thumblist, & $ad_pathoriginals, & $ad_pathimages, & $ad_paththumbs, & $ad_thumbwidth, & $ad_thumbheight)
    {
      global $mainframe;
      $ad_pathoriginals = str_replace('/', DS, $ad_pathoriginals);
      $info = getimagesize(JPATH_SITE.$ad_pathoriginals.DS.$row->imgoriginalname);
      $size = filesize(JPATH_SITE.$ad_pathoriginals.DS.$row->imgoriginalname);


      ?>
  <script type="text/javascript">
  function submitbutton(pressbutton) {
  var form = document.adminForm;
  if (pressbutton == 'cancel') {
  submitform( pressbutton );
  return;
  }
  if (form.imgtitle.value == ""){
  alert( "<?php echo _DG_PIC_ENTER_TITLE;?>" );
  } else if (form.catid.value == "0"){
  alert( "<?php echo _DG_SELECT_CAT;?>" );
  } else if (form.imgoriginalname.value == ""){
  alert( "<?php echo _DG_SELECT_ORG_PIC;?>" );
  } else if (form.imgfilename.value == ""){
  alert( "<?php echo _DG_SELECT_MED_PIC;?>" );
  } else if (form.imgthumbname.value == ""){
  alert( "<?php echo _DG_SELECT_THUMB_PIC;?>" );
  } else {
  submitform( pressbutton );
  }
  }
  </script>
  <table width="100%" border="0" cellspacing="0" cellpadding="6" class="adminlist" style="table-layout: auto; white-space: nowrap;">
    <tr>
      <td width="50" align="left" valign="top"><form action="index2.php" method="post" name="adminForm" id="adminForm">
          <table class="adminlist">
            <tr>
              <td width="20%"><b><?php echo _DG_TITLE;?>:</b></td>
              <td width="80%"><input class="inputbox" type="text" name="imgtitle" size="39" maxlength="100" value="<?php echo htmlspecialchars($row->imgtitle, ENT_QUOTES);?>" /></td>
            </tr>
            <tr>
              <td valign="top"><b><?php echo _DG_CATEGORY;?>:</b></td>
              <td><?php echo $clist;?></td>
            </tr>
            <tr>
              <td valign="top"><b><?php echo _DG_DESCRIPTION;?>:</b></td>
              <td>
              <textarea name="imgtext" id="imgtext" rows="5" cols="45" class="inputbox"><?php echo $row->imgtext;?></textarea>
                <?php
                //$editor =& JFactory::getEditor();
                //echo $editor->display( 'imgtext',  htmlspecialchars($row->imgtext, ENT_QUOTES), '550', '300', '60', '20', array('image', 'pagebreak', 'readmore') );
                ?>
                </td>
            </tr>
            <tr>
              <td valign="top"><b><?php echo _DG_AUTHOR_OWNER;?>:</b></td>
              <td><input class="inputbox" type="text" name="imgauthor" value="<?php echo $row->imgauthor;?>" size="39" maxlength="100" /></td>
            </tr>
          </table>
          <input type="hidden" name="id" value="<?php echo $row->id;?>" />
          <input type='hidden' name="imgoriginalname" value="<?php echo $row->imgoriginalname;?>" />
          <input type='hidden' name="imgfilename" value="<?php echo $row->imgfilename;?>" />
          <input type='hidden' name="imgthumbname" value="<?php echo $row->imgthumbname;?>" />
          <input type="hidden" name="option" value="<?php echo $option;?>" />
          <input type="hidden" name="task" value="" />
          <input type="hidden" name="owner" value="<?php if ($row->owner) {echo $row->owner;}else {echo $my->username;}?>" />
          <input type="hidden" name="approved" value="<?php if ($row->approved == "") {echo "1";}else {echo $row->approved;}?>" />
        </form></td>
      <td width="50" align="left" valign="top">
    <?php

    $type = array(1 => 'GIF', 2 => 'JPG', 3 => 'PNG');
    $info[2] = $type[$info[2]];
    $fsize = format_filesize($size);
    $orginfo = '<table>';
    $orginfo .= '<tr>';
    $orginfo .= '<td>';
    $orginfo .= _DG_ORG_WIDTH;
    $orginfo .= '</td>';
    $orginfo .= '<td>: ';
    $orginfo .= $info[0].' '._DG_PIXELS;
    $orginfo .= '</td>';
    $orginfo .= '</tr>';
    $orginfo .= '<tr>';
    $orginfo .= '<td>';
    $orginfo .= _DG_ORG_HEIGHT;
    $orginfo .= '</td>';
    $orginfo .= '<td>: ';
    $orginfo .= $info[1].' '._DG_PIXELS;
    $orginfo .= '</td>';
    $orginfo .= '</tr>';
    $orginfo .= '<tr>';
    $orginfo .= '<td>';
    $orginfo .= _DG_ORG_TYPE;
    $orginfo .= '</td>';
    $orginfo .= '<td>: ';
    $orginfo .= $info[2];
    $orginfo .= '</td>';
    $orginfo .= '</tr>';
    $orginfo .= '<tr>';
    $orginfo .= '<td>';
    $orginfo .= _DG_FILESIZE;
    $orginfo .= '</td>';
    $orginfo .= '<td>: ';
    $orginfo .= $fsize;
    $orginfo .= '</td>';
    $orginfo .= '</tr>';
    $orginfo .= '</table>';


    ?>
        <table width="50%" border="0" cellspacing="0" cellpadding="0" align="center">
          <tr>
            <td><fieldset>
                <legend>&nbsp;<?php echo _DG_ORG_PIC_INFO;?>&nbsp;</legend>
                <div style="text-align:center"><img src="<?php echo $mainframe->getSiteURL().$ad_paththumbs.'/'.$row->imgthumbname;?>" id="dg-image" title="<?php echo _DG_THUMB_PIC_PREVIEW;?>" /></div>
                <br />
                <br />
                <?php echo $orginfo;?>
              </fieldset></td>
          </tr>
        </table></td>
    </tr>
  </table>
      <?php

    }

    function showComments($option, & $rows, & $search, & $pageNav)
    {
      global $mainframe;


      ?>
  <form action="index2.php" method="post" name="adminForm">
    <table class="adminheading">
      <tr>
        <td><?php echo _DG_SEAR;?>:&nbsp;
          <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onchange="document.adminForm.submit();" /></td>
      </tr>
    </table>
    <table class="adminlist">
      <tr>
      <thead>
      <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows);?>);" />
        </th>
        <th width="15%"><?php echo _DG_AUTHOR_OWNER;?></th>
        <th width="50%" align="left"><?php echo _DG_TEXT;?></th>
        <th width="10%" align="left"><?php echo _DG_IP;?></th>
        <th width="5%"><?php echo _DG_PUBLISHED;?></th>
        <th width="5%"><?php echo _DG_PIC;?></th>
        <th width="15%"><?php echo _DG_DATE_ADD;?></th>
        </thead>
      </tr>
          <?php

          $k = 0;
          for ( $i = 0, $n = count($rows); $i < $n; $i++ )
          {
            $row = & $rows[$i];
            $row->cmtdate = strftime("%d.%m.%Y %H:%M", $row->cmtdate)


            ?>
      <tr class="<?php echo "row$k";?>">
        <td><input type="checkbox" id="cb<?php echo $i;?>" name="id[]" value="<?php echo $row->cmtid;?>" onclick="isChecked(this.checked);" /></td>
        <td><b><?php echo $row->cmtname;?></b></td>
        <td><?php echo $row->cmttext;?></td>
        <td><?php echo $row->cmtip;?></td>
              <?php

              echo "<td align='center'>";
              if ($row->published == "1")
              {
                echo "<img src='".$mainframe->getSiteURL()."/components/com_datsogallery/images/dg-accept-icon.png'>";
              }
              else
              {
                echo "<img src='".$mainframe->getSiteURL()."/components/com_datsogallery/images/dg-pending-icon.png'>";
              }
              echo "</td>";


              ?>
        <td width="10%" align="center"><?php echo $row->cmtpic;?></td>
        <td width="10%" align="center"><?php echo $row->cmtdate;?></td>
              <?php

              $k = 1 - $k;


              ?>
      </tr>
            <?php

          }


          ?>
      <tr>
      <tfoot>
      <th colspan="8"> <?php echo $pageNav->getListFooter();?></th>
        </tfoot>
      </tr>
    </table>
    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="task" value="comments" />
    <input type="hidden" name="boxchecked" value="0" />
  </form>
      <?php

    }

    function showCatgs(&$rows, $search, $pageNav, $option)
    {
      global $mainframe;


      ?>
  <form action="index2.php" method="post" name="adminForm">
    <table>
      <tr>
        <td><?php echo _DG_SEAR;?>:&nbsp;
          <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onchange="document.adminForm.submit();" /></td>
      </tr>
    </table>
    <table class="adminlist">
      <tr>
      <thead>
      <th width="20">#ID</th>
        <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows);?>);" />
        </th>
        <th class="title" nowrap="nowrap"><?php echo _DG_CATEGORY;?></th>
        <th align="left"><?php echo _DG_PARENT_CAT;?></th>
        <th nowrap="nowrap"><?php echo _DG_FILES_IN_CATEGORY;?></th>
        <th nowrap="nowrap"><?php echo _DG_PUBLISHED;?></th>
        <th nowrap="nowrap"><?php echo _DG_ACCESS;?></th>
        <th colspan="2" nowrap="nowrap"> <div align="center"><?php echo _DG_REORDER;?></div>
        </th>
        </thead>
      </tr>
          <?php

          $k = 0;
          $i = 0;
          for ( $i = 0, $n = count($rows); $i < $n; $i++ )
          {
            $row = & $rows[$i];


            ?>
      <tr class="row<?php echo $k;?>">
        <td align="center"><?php echo $row->cid;?></td>
        <td width="20"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $row->cid;?>" onclick="isChecked(this.checked);"></td>
        <td align="left" width="25%"><a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','editcatg')"><?php echo $row->name;?></a></td>
        <td align="left" width="55%"><?php echo ShowCategoryPath($row->parent);?></td>
        <td align="center" width="5%"><?php echo GetNumberOfLinks($row->cid);?></td>
              <?php

              $task = $row->published ? 'unpublishcatg':'publishcatg';
              $img = $row->published ? 'dg-accept-icon.png':'dg-pending-icon.png';


              ?>
        <td width="10%" align="center" nowrap><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="<?php echo $mainframe->getSiteURL();?>components/com_datsogallery/images/<?php echo $img;?>" width="16" height="16" border="0" alt="" /></a></td>
        <td width="10%" align="center" nowrap><?php echo $row->groupname;?></td>
        <td><?php if ( $i > 0 || ($i + $pageNav->limitstart > 0)) {?>
          <div align="center"><a href="#reorder" onclick="return listItemTask('cb<?php echo $i;?>','orderupcatg')"> <img src="<?php echo JURI :: base();?>images/uparrow.png" width="16" height="16" border="0" title="<?php echo _DG_UP;?>"></a>
            <?php }else {echo "&nbsp;";}?>
          </div></td>
        <td><?php if ($i < $n - 1 || $i + $pageNav->limitstart < $pageNav->total - 1) {?>
          <div align="center"><a href="#reorder" onclick="return listItemTask('cb<?php echo $i;?>','orderdowncatg')"> <img src="<?php echo JURI :: base();?>images/downarrow.png" width="16" height="16" border="0" title="<?php echo _DG_DOWN;?>"></a>
            <?php
            } else {
              echo "&nbsp;";
              }
              ?>
          </div></td>
        <?php $k = 1 - $k;}?>
      </tr>
      <tr>
      <tfoot>
      <th colspan="13"> <?php echo $pageNav->getListFooter();?></th>
        </tfoot>
      </tr>
    </table>
    <input type="hidden" name="option" value="<?php echo $option;?>">
    <input type="hidden" name="task" value="showcatg">
    <input type="hidden" name="boxchecked" value="0">
  </form>
      <?php

    }

    function editCatg(&$row, &$publist, $option, $glist, $Lists, $orderlist)
    {
      global $mainframe;
      jimport('joomla.filter.output');
      JFilterOutput :: objectHTMLSafe($row, ENT_QUOTES, 'description');

      ?>
  <script type="text/javascript">
  function submitbutton(pressbutton) {
  var form = document.adminForm;
  if (pressbutton == 'cancelcatg') {
  submitform( pressbutton );
  return;
  }

  try {
  document.adminForm.onsubmit();
  }
  catch(e){}
  if (form.name.value == ""){
  alert( "<?php echo _DG_CAT_TITLE;?>" );
  } else {
  submitform( pressbutton );
  }
  }
  </script>
  <form action="index2.php" method="post" name="adminForm">
    <table cellpadding="4" cellspacing="0" border="0" width="100%">
      <tr>
        <td><fieldset>
            <legend>&nbsp;<?php echo $row->cid ? _DG_EDIT_CAT:_DG_ADD_CAT;?> <?php echo _DG_CATEGORY1;?>&nbsp;</legend>
            <table class="adminlist">
              <tr>
                <td width="200"><b><?php echo _DG_TITLE;?>:</b></td>
                <td><input class="inputbox" type="text" name="name" size="25" value="<?php echo $row->name;?>"></td>
              </tr>
              <tr>
                <td valign="top" ><b><?php echo _DG_PARENT_CAT;?>:</b></td>
                <td nowrap ><?php echo $Lists["catgs"];?></td>
              </tr>
              <tr>
                <td valign="top"><b><?php echo _DG_DESCRIPTION;?>:</b></td>
                <td>
                <textarea name="description" id="description" rows="5" cols="45" class="inputbox"><?php echo $row->description;?></textarea>
                <?php
                //$editor =& JFactory::getEditor();
                //echo $editor->display( 'description',  htmlspecialchars($row->description, ENT_QUOTES), '550', '300', '60', '20', array('image', 'pagebreak', 'readmore') );
                ?>
                </td>
              </tr>
              <tr>
                <td valign="top" ><b><?php echo _DG_ACCESS;?>:</b></td>
                <td nowrap ><?php echo $glist;?></td>
              </tr>
              <tr>
                <td valign="top" ><b><?php echo _DG_ORDER;?>:</b></td>
                <td nowrap ><?php echo $orderlist;?></td>
              </tr>
              <tr>
                <td valign="top" ><b>Published:</b></td>
                <td nowrap ><?php echo $publist;?></td>
              </tr>
            </table>
          </fieldset></td>
      </tr>
    </table>
    <input type="hidden" name="cid" value="<?php echo $row->cid;?>" />
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="option" value="<?php echo $option;?>" />
  </form>
      <?php

    }

  }



  ?>
