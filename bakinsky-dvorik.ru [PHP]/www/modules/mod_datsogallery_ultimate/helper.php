<?php

  defined('_JEXEC') or die('Restricted access');

  class ModDatsoGalleryUltimateHelper
  {

    function getItems(&$params)
    {
      global $mainframe;
      $db            = &JFactory::getDBO();
      $user          = &JFactory::getUser();

      $catid         = trim($params->get('catid'));
      $sort          = $params->get('sort');
      $limit         = (int) $params->get('limit');
      $border_width  = $params->get('border_width');
      $border_style  = $params->get('border_style');
      $border_color  = $params->get('border_color');
      $padding 	     = $params->get('padding');
      $margin        = $params->get('margin');
      $bg_color 	 = $params->get('bg_color');
      $mod_id        = $params->get('mod_id');

      $css  ="<style type='text/css'>\n";
      $css .=".dgu_img".$mod_id." {\n";
      $css .="  border-width:".$border_width."px;\n";
      $css .="  border-style:".$border_style.";\n";
      $css .="  border-color:".$border_color.";\n";
      $css .="  padding:".$padding."px;\n";
      $css .="  margin:".$margin."px;\n";
      $css .="  background-color:".$bg_color."\n";
      $css .="}\n";
      if($params->get('view') == 'dgu_hor'){
      $css .=".dgu_hor".$mod_id." {\n";
      $css .="  font-size:10px;\n";
      $css .="  float:left\n";
      $css .="}\n";
      } else {
      $css .=".dgu_ver".$mod_id." {\n";
      $css .="  font-size:10px;\n";
      $css .="  text-align:center\n";
      $css .="}\n";
      }
      $css .="</style>";
      $mainframe->addCustomHeadTag($css);

      switch ($sort) {
      case 'lastcomment':
      $db->setQuery('SELECT a.*, cc.cmtid '
      . ' FROM #__datsogallery AS a,'
      . ' #__datsogallery_comments AS cc,'
      . ' #__datsogallery_catg AS ca'
      . ' WHERE a.id=cc.cmtpic'
      . ' AND ca.cid = a.catid'
      . ( $catid ? ' AND ( catid IN ( '.$catid.' ) )' : '' )
      . ' AND cc.cmtid = (SELECT MAX(ab.cmtid)'
      . ' FROM #__datsogallery_comments AS ab'
      . ' WHERE a.id = ab.cmtpic)'
      . ' AND a.published = 1'
      . ' AND a.approved = 1'
      . ' AND ca.published = 1'
      . ' AND ca.access <= ' . (int) $user->get('aid')
      . ' GROUP BY a.id ORDER BY cc.cmtid DESC LIMIT ' . $limit
      );
      break;

      case 'lastadd':
      $db->setQuery('SELECT * '
      . ' FROM #__datsogallery AS a'
      . ' LEFT JOIN #__datsogallery_catg AS ca ON ca.cid = a.catid'
      . ( $catid ? ' AND ( catid IN ( '.$catid.' ) )' : '' )
      . ' WHERE a.catid = ca.cid'
      . ' AND a.published = 1'
      . ' AND a.approved = 1'
      . ' AND ca.published = 1'
      . ' AND ca.access <= ' . (int) $user->get('aid')
      . ' ORDER BY a.id DESC LIMIT ' . $limit
      );
      break;

      case 'rating':
      $db->setQuery('SELECT *, imgvotesum '
      . ' AS rating FROM #__datsogallery AS a'
      . ' LEFT JOIN #__datsogallery_catg AS ca ON ca.cid = a.catid'
      . ( $catid ? ' AND ( catid IN ( '.$catid.' ) )' : '' )
      . ' WHERE a.catid = ca.cid'
      . ' AND a.imgvotes > 0'
      . ' AND a.published = 1'
      . ' AND a.approved = 1'
      . ' AND ca.published = 1'
      . ' AND ca.access <= ' . (int) $user->get('aid')
      . ' ORDER BY rating DESC LIMIT ' . $limit
      );
      break;

      case 'popular':
      $db->setQuery('SELECT * '
      . ' FROM #__datsogallery AS a'
      . ' LEFT JOIN #__datsogallery_catg AS ca ON ca.cid = a.catid'
      . ( $catid ? ' AND ( catid IN ( '.$catid.' ) )' : '' )
      . ' WHERE a.catid = ca.cid'
      . ' AND a.published = 1'
      . ' AND a.approved = 1'
      . ' AND ca.published = 1'
      . ' AND ca.access <= ' . (int) $user->get('aid')
      . ' ORDER BY imgcounter DESC LIMIT ' . $limit
      );
      break;

      default:
      $db->setQuery('SELECT * '
      . ' FROM #__datsogallery AS a '
      . ' LEFT JOIN #__datsogallery_catg AS c ON c.cid = a.catid '
      . ( $catid ? ' AND ( catid in ( '.$catid.' ) )' : '' )
      . ' WHERE a.catid = c.cid'
      . ' AND a.published = 1'
      . ' AND a.approved = 1'
      . ' AND c.published = 1'
      . ' AND c.access <= ' . (int) $user->get('aid')
      . ' ORDER BY rand() DESC LIMIT ' . $limit
      );
      break;
      }
      $items = ($items = $db->loadObjectList()) ? $items : array();
      return $items;
    }

  }

    function short_name($str, $chars)
  {
    if ($chars < 3)
    {
      $chars = 3;
    }
    if (strlen($str) > $chars)
    {
      return mb_substr($str, 0, $chars - 3) . '...';
    }
    else
    {
      return $str;
    }
  }