<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgSystemRSFPVtigerInstallerScript
{
	public function preflight($type, $parent) {
		if ($type == 'uninstall') {
			return true;
		}
		
		$app = JFactory::getApplication();
		
		if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/rsform.php')) {
			$app->enqueueMessage('Please install the RSForm! Pro component before continuing.', 'error');
			return false;
		}
		
		if (!file_exists(JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/version.php')) {
			$app->enqueueMessage('Please upgrade RSForm! Pro to at least R45 before continuing!', 'error');
			return false;
		}
		
		$jversion = new JVersion();
		if (!$jversion->isCompatible('2.5.5')) {
			$app->enqueueMessage('Please upgrade to at least Joomla! 2.5.5 before continuing!', 'error');
			return false;
		}
		
		return true;
	}
	
	public function update($parent) {
		$this->copyFiles($parent);
		
		$db = JFactory::getDbo();
		// vt_accesskey, vt_username, vt_hostname
		$db->setQuery("SHOW COLUMNS FROM `#__rsform_vtiger` WHERE `Field`='vt_hostname'");
		$result = $db->loadObject();
		if (strtolower($result->Type) == 'varchar(50)') {
			$db->setQuery("ALTER TABLE `#__rsform_vtiger` CHANGE `vt_accesskey` `vt_accesskey` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
			$db->execute();
			$db->setQuery("ALTER TABLE `#__rsform_vtiger` CHANGE `vt_username` `vt_username` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
			$db->execute();
			$db->setQuery("ALTER TABLE `#__rsform_vtiger` CHANGE `vt_hostname` `vt_hostname` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL");
			$db->execute();
		}
		
		$db->setQuery("SHOW COLUMNS FROM `#__rsform_vtiger` WHERE `Field`='vt_salutationtype'");
		if (!$db->loadObject()) {
			$db->setQuery("ALTER TABLE `#__rsform_vtiger` ADD `vt_salutationtype` VARCHAR( 255 ) NOT NULL AFTER `vt_leadstatus`");
			$db->execute();
		}
	}
	
	public function install($parent) {
		$this->copyFiles($parent);
	}
	
	protected function copyFiles($parent) {
		$app = JFactory::getApplication();
		$installer = $parent->getParent();
		$src = $installer->getPath('source').'/admin';
		$dest = JPATH_ADMINISTRATOR.'/components/com_rsform';
		
		if (!JFolder::copy($src, $dest, '', true)) {
			$app->enqueueMessage('Could not copy to '.str_replace(JPATH_SITE, '', $dest).', please make sure destination is writable!', 'error');
		}
	}
}