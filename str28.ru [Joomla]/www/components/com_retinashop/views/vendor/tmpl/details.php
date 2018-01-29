<?php
/**
*
* Description
*
* @package	Magazin
* @subpackage vendor
* @author Kohl Patrick, Eugen Stranz
* @link http://www.retinashop.net
* 
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* 
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: default.php 2701 2011-02-11 15:16:49Z impleri $
*/

// Check to ensure this file is included in Retina
defined('_REXEC') or die('Restricted access');

?>

<div class="vendor-details-view">
	<h1><?php echo $this->vendor->vendor_store_name;
	if (!empty($this->vendor->images[0])) { ?>
		<div class="vendor-image">
		<?php echo $this->vendor->images[0]->displayMediaThumb('',false); ?>
		</div>
	<?php
	}
?>	</h1></div>

<div class="vendor-description">
<?php echo $this->vendor->vendor_store_desc.'<br>';

	foreach($this->userFields as $userfields){

		foreach($userfields['fields'] as $element){
			if(!empty($element['value'])){
				if($element['name']==='agreed'){
					$element['value'] =  ($element['value']===0) ? RText::_('COM_RETINASHOP_USER_FORM_BILLTO_TOS_NO'):RText::_('COM_RETINASHOP_USER_FORM_BILLTO_TOS_YES');
				}
			?><!-- span class="titles"><?php echo $element['title'] ?></span -->
						<span class="values rs2<?php echo '-'.$element['name'] ?>" ><?php echo $this->escape($element['value']) ?></span>
					<?php if ($element['name'] != 'title' and $element['name'] != 'first_name' and $element['name'] != 'middle_name' and $element['name'] != 'zip') { ?>
						<br class="clear" />
					<?php
				}
			}
		}
	}

	?></div>

<?php	echo $this->vendor->vendor_legal_info; ?>

	<br class="clear" />
	<?php echo $this->linktos ?>

	<br class="clear" />

	<?php echo $this->linkcontact ?>

	<br class="clear" />
