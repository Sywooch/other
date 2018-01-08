<?php
  defined('_JEXEC') or die('Restricted access');

  function com_install() {
    jimport('joomla.filesystem.file');
    jimport('joomla.filesystem.folder');
    $lang = & JFactory::getLanguage();
    $datsolang = strtolower($lang->getBackwardLang());
    if (JFile::exists(JPATH_ROOT . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . $datsolang . '.php')) {
      require (JPATH_ROOT . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . $datsolang . '.php');
    }
    else {
      require (JPATH_ROOT . DS . 'components' . DS . 'com_datsogallery' . DS . 'language' . DS . 'english.php');
    }
    if (JFile::exists(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.php')) {
      JFile::delete(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.bak');
    }
    else {
      JFile::move(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.bak', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_datsogallery' . DS . 'config.datsogallery.php');
    }
    if (!JFolder::exists(JPATH_ROOT . DS . 'zipimport')) {
      JFolder::create(JPATH_ROOT . DS . 'zipimport');
      JFile::write(JPATH_ROOT . DS . 'zipimport' . DS . 'index.html', '<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>');
    }
    if (!JFolder::exists(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_originals')) {
      JFolder::create(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_originals');
      JFile::write(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_originals' . DS . 'index.html', '<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>');
    }
    if (!JFolder::exists(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_pictures')) {
      JFolder::create(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_pictures');
      JFile::write(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_pictures' . DS . 'index.html', '<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>');
    }
    if (!JFolder::exists(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_thumbnails')) {
      JFolder::create(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_thumbnails');
      JFile::write(JPATH_ROOT . DS . 'images' . DS . 'stories' . DS . 'dg_thumbnails' . DS . 'index.html', '<html>\n<body bgcolor=\"#FFFFFF\">\n</body>\n</html>');
    }
  ?>

   <div style='display:block;margin:20px auto;width:360px;border:1px solid #CCC;background:#F8F8FF'>
   <div style='padding:20px'>
      <p style='text-align:center'><img src='components/com_datsogallery/images/datsogallery-box.png' alt="datsogallery box" /></p>
      <p><h2><?php echo _DG_INSTALL_DESC;?></h2></p>
      <p style='color:DimGray'>Version <?php echo _DG_INSTALL_VERSION;?></p>
      <p><h1><?php echo _DG_INSTALL_FINISHED;?></h1></p>
      <p>&copy; 2006-2009 <a href="http://www.datso.fr">Andrey Datso</a></p>
      </div>
   </div>
 <?php
}
