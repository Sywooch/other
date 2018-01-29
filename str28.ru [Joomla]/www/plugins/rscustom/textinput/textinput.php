<?php
defined('_REXEC') or 	die( 'Direct Access to ' . basename( __FILE__ ) . ' is not allowed.' ) ;
/**
 * @version $Id: standard.php,v 1.4 2005/05/27 19:33:57 ei
 *
 * a special type of 'cash on delivey':
 * its fee depend on total sum
 * @author Max Milbers
 * @version $Id: standard.php 3681 2011-07-08 12:27:36Z alatak $
 * @package retinashop
 * @subpackage payment
 * @copyright Copyright (C) 2004-2008 soeren - All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /admin/components/com_retinashop/COPYRIGHT.php for copyright notices and details.
 *
 * http://retinashop.org
 */

if (!class_exists('rsCustomPlugin')) require(RPATH_rs_PLUGINS . DS . 'rscustomplugin.php');

class plgrsCustomTextinput extends rsCustomPlugin {


	// instance of class
// 	public static $_this = false;

	function __construct(& $subject, $config) {
// 		if(self::$_this) return self::$_this;
		parent::__construct($subject, $config);

		$varsToPush = array(	'custom_size'=>array(0.0,'int'),
						    		'custom_price_by_letter'=>array(0.0,'bool')
		);

		$this->setConfigParameterable('custom_params',$varsToPush);

// 		self::$_this = $this;
	}

	// function plgrsOnOrder($product) {

		// $dbValues['retinashop_product_id'] = $product->retinashop_product_id;
		// $dbValues['textinput'] = $this->_retinashop_paymentmethod_id;
		// $this->writeCustomData($dbValues, '#__retinashop_product_custom_' . $this->_name);
	// }



	// get product param for this plugin on edit
	function plgrsOnProductEdit($field, $product_id, &$row,&$retValue) {
		if ($field->custom_element != $this->_name) return '';
		// $html .='<input type="text" value="'.$field->custom_size.'" size="10" name="custom_param['.$row.'][custom_size]">';
		$this->parseCustomParams($field);

		$html ='
			<fieldset>
				<legend>'. RText::_('rsCUSTOM_TEXTINPUT') .'</legend>
				<table class="admintable">
					'.rsHTML::row('input','rsCUSTOM_TEXTINPUT_SIZE','custom_param['.$row.'][custom_size]',$field->custom_size).'
				</table>
			</fieldset>';
		$retValue .= $html;
		$row++;
		return true ;
	}

	/**
	 * @ idx plugin index
	 * @see components/com_retinashop/helpers/rsCustomPlugin::onDisplayProductFE()
	 * @author Patrick Kohl
	 * eg. name="customPlugin['.$idx.'][comment] save the comment in the cart & order
	 */
	function plgrsOnDisplayProductVariantFE($field,&$idx,&$group) {
		// default return if it's not this plugin
		 if ($field->custom_element != $this->_name) return '';
		$this->getCustomParams($field);
			// ob_start();
			// require($this->getLayoutPath('default'));
			// $html = ob_get_clean();

		$group->display .= $this->renderByLayout('default',array($field,&$idx,&$group ) );


		return true;
//         return $html;
    }
	//function plgrsOnDisplayProductFE( $product, &$idx,&$group){}
	/**
	 * @see components/com_retinashop/helpers/rsCustomPlugin::plgrsOnViewCartModule()
	 * @author Patrick Kohl
	 */
	function plgrsOnViewCartModule( $product,$row,&$html) {
		if (!$plgParam = $this->GetPluginInCart($product)) return false ;
		foreach($plgParam as $k => $element){
			$this->getrsPluginMethod($k);
			if(!empty($element['comment']) ){
				$html .='<span>'.$this->_rspCtable->custom_title.' '.$element['comment'].'</span>';
			}
		 }
		return true;
    }

	/**
	 * @see components/com_retinashop/helpers/rsCustomPlugin::plgrsOnViewCart()
	 * @author Patrick Kohl
	 */
	function plgrsOnViewCart($product,$row,&$html) {
		if (!$plgParam = $this->GetPluginInCart($product)) return '' ;

// 		$html  .= '<div>';
		foreach($plgParam as $k => $element){
			$this->getrsPluginMethod($k);
			if(!empty($element['comment']) ){
				$html .='<span>'.$this->_rspCtable->custom_title.' '.$element['comment'].'</span>';
			}
		 }
// 		$html .='</div>';

		return true;
    }


	/**
	 *
	 * vendor order display BE
	 */
	function plgrsDisplayInOrderBE($element, $row, &$html) {
		if (empty($element->productCustom->custom_element) or $element->productCustom->custom_element != $this->_name) return '';
		$this->plgrsOnViewCart($element,$row,$html); //same render as cart
    }

	/**
	 *
	 * shopper order display FE
	 */
	function plgrsDisplayInOrderFE($element, $row, &$html) {
		if (empty($element->productCustom->custom_element) or $element->productCustom->custom_element != $this->_name) return '';
		$this->plgrsOnViewCart($element,$row,$html); //same render as cart
    }

	/**
	 * We must reimplement this triggers for retina 1.7
	 * rsplugin triggers note by Max Milbers
	 */
	public function plgrsOnStoreInstallPluginTable($psType) {
		//Should the textinput use an own internal variable or store it in the params?
		//Here is no getrsPluginCreateTableSQL defined
// 		return $this->onStoreInstallPluginTable($psType);
	}


	function plgrsDeclarePluginParamsCustom($psType,$name,$id, &$data){
		return $this->declarePluginParams($psType, $name, $id, $data);
	}

	function plgrsSetOnTablePluginParamsCustom($name, $id, &$table){
		return $this->setOnTablePluginParams($name, $id, $table);
	}

	/**
	 * Custom triggers note by Max Milbers
	 */
	function plgrsOnDisplayEdit($retinashop_custom_id,&$customPlugin){
		return $this->onDisplayEditBECustom($retinashop_custom_id,$customPlugin);
	}

	public function plgrsCalculateCustomVariant($product, &$productCustomsPrice,$selected){
		if ($productCustomsPrice->custom_element !==$this->_name) return ;
		$customVariant = $this->getCustomVariant($product, $productCustomsPrice,$selected);
		if (!empty($productCustomsPrice->custom_price)) {
			//TODO adding % and more We should use here $this->interpreteMathOp
			// eg. to calculate the price * comment text length
			if ($productCustomsPrice->custom_price_by_letter ==1) {
				if (!empty($customVariant['comment'])) {
					$charcount = strlen ($customVariant['comment']);
					$productCustomsPrice->custom_price = $charcount * $productCustomsPrice->custom_price ;
				} else {
					$productCustomsPrice->custom_price = 0.0;
				}
			}
		}
		return true;
	}

	public function plgrsDisplayInOrderCustom(&$html,$element, $param,$productCustom, $row ,$view='FE'){
		$this->plgrsDisplayInOrderCustom($html,$element, $param,$productCustom, $row ,$view);
	}

	public function plgrsCreateOrderLinesCustom(&$html,$element,$productCustom, $row ){
// 		$this->createOrderLinesCustom($html,$element,$productCustom, $row );
	}
	function plgrsOnSelfCallFE($type,$name,&$render) {
		$render->html = 'test';
	}

}

// No closing tag