<?php
  function DatsoGalleryBuildRoute(&$query) {
    $segments=array();
    $itemid=null;
    if(isset ($query['func'])) {
      $segments[]=$query['func'];
      unset ($query['func']);
    }
    if(isset ($query['sorting'])) {
      $segments[]=$query['sorting'];
      unset ($query['sorting']);
    }
    if(isset ($query['catid'])) {
      $segments[]=$query['catid'];
      unset ($query['catid']);
    }
    if(isset ($query['id'])) {
      $segments[]=$query['id'];
      unset ($query['id']);
    }
    if(isset ($query['uid'])) {
      $segments[]=$query['uid'];
      unset ($query['uid']);
    }
    if(isset ($query['op'])) {
      $segments[]=$query['op'];
      unset ($query['op']);
    }
    if(isset ($query['mid'])) {
      $segments[]=$query['mid'];
      unset ($query['mid']);
    }
    if(isset ($query['oid'])) {
      $segments[]=$query['oid'];
      unset ($query['oid']);
    }
    if(isset ($query['cmtid'])) {
      $segments[]=$query['cmtid'];
      unset ($query['cmtid']);
    }
    return $segments;
  }
  function DatsoGalleryParseRoute($segments) {
    $vars=array();
    $count=count($segments);
    switch($segments[0]) {
      case 'deletecomment':
        $vars['func']='deletecomment';
        $catid=explode(':',$segments[1]);
        $vars['catid']=(int) $catid[0];
        $cmtid=explode(':',$segments[2]);
        $vars['cmtid']=(int) $cmtid[0];
        break;
      case 'deletepic':
        $vars['func']='deletepic';
        $uid=explode(':',$segments[1]);
        $vars['uid']=(int) $uid[0];
        break;
      case 'userpannel':
        $vars['func']='userpannel';
        break;
      case 'editpic':
        $vars['func']='editpic';
        $uid=explode(':',$segments[1]);
        $vars['uid']=(int) $uid[0];
        break;
      case 'savepic':
        $vars['func']='savepic';
        break;
      case 'showupload':
        $vars['func']='showupload';
        break;
      case 'uploadhandler':
        $vars['func']='uploadhandler';
        break;
      case 'download':
        $vars['func']='download';
        $id=explode(':',$segments[1]);
        $vars['id']=(int) $id[0];
        break;
      case 'viewcategory':
        $vars['func']='viewcategory';
        $catid=explode(':',$segments[1]);
        $vars['catid']=(int) $catid[0];
        break;
      case 'detail':
        $vars['func']='detail';
        $catid=explode(':',$segments[1]);
        $vars['catid']=(int) $catid[0];
        $id=explode(':',$segments[2]);
        $vars['id']=(int) $id[0];
        break;
      case 'special':
        if($count==2) {
          $vars['func']='special';
          $vars['sorting']=$segments[1];
        }
        elseif($count==3) {
          $vars['func']='special';
          $vars['sorting']=$segments[1];
          $op=explode(':',$segments[2]);
          $vars['op']=(int) $op[0];
        }
        else{
          $vars['func']='special';
        }
        break;
    }
    return $vars;
  }