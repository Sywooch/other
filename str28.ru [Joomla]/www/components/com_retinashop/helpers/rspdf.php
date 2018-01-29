<?php
defined('_REXEC') or die('');
/**
 * abstract controller class containing get,store,delete,publish and pagination
 *
 *
 * This class provides the functions for the calculatoins
 *
 * @package	Magazin
 * @subpackage Helpers
 * @author Max Milbers
 * @copyright Copyright (c) 2011 retinashop Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * 
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See /admin/components/com_retinashop/COPYRIGHT.php for copyright notices and details.
 *
 * http://retinashop.net
 */

if (!class_exists( 'rsConfig' )) require(RPATH_admin . DS . 'components' . DS . 'com_retinashop'.DS.'helpers'.DS.'config.php');
rsConfig::loadConfig();

/*class rsPdf {

	function creatersPdf($view=0){

//		if($view ===0){
			$view = new stdClass;
			$retinashop_vendor_id=1;
			$vendorModel = rsModel::getModel('vendor');
			$view->vendor = $vendorModel->getVendor($retinashop_vendor_id);
			$vendorModel->addImages($view->vendor);
// 		}

		if(!file_exists(RPATH_rs_LIBRARIES.DS.'tcpdf'.DS.'tcpdf.php')){
			rsError('rsPdf: For the pdf, you must install the tcpdf library at '.RPATH_rs_LIBRARIES.DS.'tcpdf');
			return 0;
		}
		// create new PDF document
		$this->myTcPDF = new myTcPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$this->myTcPDF->SetCreator('Invoice by retinashop 2, used library tcpdf');
		$this->myTcPDF->SetAuthor($view->vendor->vendor_name);

		$this->myTcPDF->SetTitle(RText::_('COM_RETINASHOP_INVOICE_TITLE'));
		$this->myTcPDF->SetSubject(RText::sprintf('COM_RETINASHOP_INVOICE_SUBJ',$view->vendor->vendor_store_name));
		$this->myTcPDF->SetKeywords('Invoice by retinashop 2');

		//retinashop.cloudaccess.net/index.php?option=com_retinashop&view=invoice&layout=details&retinashop_order_id=18&order_number=6e074d9b&order_pass=p_9cb9e2&task=checkStoreInvoice
		if(empty($view->vendor->images[0])){
			rsError('Vendor image given path empty ');
		} else if(empty($view->vendor->images[0]->file_url_folder) or empty($view->vendor->images[0]->file_name) or empty($view->vendor->images[0]->file_extension) ){
			rsError('Vendor image given image is not complete '.$view->vendor->images[0]->file_url_folder.$view->vendor->images[0]->file_name.'.'.$view->vendor->images[0]->file_extension);
			rsdebug('Vendor image given image is not complete, the given media',$view->vendor->images[0]);
		} else if(!empty($view->vendor->images[0]->file_extension) and strtolower($view->vendor->images[0]->file_extension)=='png'){
			rsError('Warning extension of the image is a png, tpcdf has problems with that in the header, choose a jpg or gif');
		} else {
			$imagePath = DS. str_replace('/',DS, $view->vendor->images[0]->file_url_folder.$view->vendor->images[0]->file_name.'.'.$view->vendor->images[0]->file_extension);
			if(!file_exists(RPATH_ROOT.$imagePath)){
				rsError('Vendor image missing '.$imagePath);
			} else {
				$this->myTcPDF->SetHeaderData($imagePath, 60, $view->vendor->vendor_store_name, $view->vendorAddress);
			}
		}

		// set header and footer fonts
		$this->myTcPDF->setHeaderFont(Array('helvetica', '', 8));
		$this->myTcPDF->setFooterFont(Array('helvetica', '', 10));

		// set default monospaced font
		$this->myTcPDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$this->myTcPDF->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->myTcPDF->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->myTcPDF->SetFooterMargin(PDF_MARGIN_FOOTER);

		//set auto page breaks
		$this->myTcPDF->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		$this->myTcPDF->setImageScale(PDF_IMAGE_SCALE_RATIO);

		//TODO include the right file (in libraries/tcpdf/config/lang set some language-dependent strings
		$l='';
		$this->myTcPDF->setLanguageArray($l);

		// set default font subsetting mode
		$this->myTcPDF->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$this->myTcPDF->SetFont('helvetica', '', 8, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$this->myTcPDF->AddPage();

		// Set some content to print
		// $html =

		// Print text using writeHTMLCell()
		$this->myTcPDF->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);


		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$this->myTcPDF->Output($path, 'F');

		// 			rsdebug('Pdf object ',$this->myTcPDF);
		// 		rsdebug('checkStoreInvoice start');
		return $path;

	}
}
*/
if(!file_exists(RPATH_rs_LIBRARIES.DS.'tcpdf'.DS.'tcpdf.php')){
	rsError('rsPdf: For the pdf, you must install the tcpdf library at '.RPATH_rs_LIBRARIES.DS.'tcpdf');
} else {
	if(!class_exists('TCPDF'))	require(RPATH_rs_LIBRARIES.DS.'tcpdf'.DS.'tcpdf.php');
	// Extend the TCPDF class to create custom Header and Footer
	class myTcPDF extends TCPDF {

		public function __construct() {
			parent::__construct(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		}

		function creatersPdf($view=0){

			$path = 0;

			if($view ===0){
			$view = new stdClass();
			jimport( 'retina.database.table' );
// 			JTable::addIncludePath(RPATH_rs_admin . DS . 'tables');

			$retinashop_vendor_id=1;

			$vendorModel = rsModel::getModel('vendor');
			$view->vendor = $vendorModel->getVendor($retinashop_vendor_id);
			$vendorModel->addImages($view->vendor);
			}

			if(!file_exists(RPATH_rs_LIBRARIES.DS.'tcpdf'.DS.'tcpdf.php')){
				rsError('rsPdf: For the pdf, you must install the tcpdf library at '.RPATH_rs_LIBRARIES.DS.'tcpdf');
				return 0;
			}
			// create new PDF document
// 			$this->myTcPDF = new myTcPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			// set document information
			$this->SetCreator('Invoice by retinashop 2, used library tcpdf');
			$this->SetAuthor($view->vendor->vendor_name);

			$this->SetTitle(RText::_('COM_RETINASHOP_INVOICE_TITLE'));
			$this->SetSubject(RText::sprintf('COM_RETINASHOP_INVOICE_SUBJ',$view->vendor->vendor_store_name));
			$this->SetKeywords('Invoice by retinashop 2');

			//retinashop.cloudaccess.net/index.php?option=com_retinashop&view=invoice&layout=details&retinashop_order_id=18&order_number=6e074d9b&order_pass=p_9cb9e2&task=checkStoreInvoice
			if(empty($view->vendor->images[0])){
				rsError('Vendor image given path empty ');
			} else if(empty($view->vendor->images[0]->file_url_folder) or empty($view->vendor->images[0]->file_name) or empty($view->vendor->images[0]->file_extension) ){
				rsError('Vendor image given image is not complete '.$view->vendor->images[0]->file_url_folder.$view->vendor->images[0]->file_name.'.'.$view->vendor->images[0]->file_extension);
				rsdebug('Vendor image given image is not complete, the given media',$view->vendor->images[0]);
			} else if(!empty($view->vendor->images[0]->file_extension) and strtolower($view->vendor->images[0]->file_extension)=='png'){
				rsError('Warning extension of the image is a png, tpcdf has problems with that in the header, choose a jpg or gif');
			} else {
				$imagePath = DS. str_replace('/',DS, $view->vendor->images[0]->file_url_folder.$view->vendor->images[0]->file_name.'.'.$view->vendor->images[0]->file_extension);
				if(!file_exists(RPATH_ROOT.$imagePath)){
					rsError('Vendor image missing '.$imagePath);
				} else {
					$this->SetHeaderData($imagePath, 60, $view->vendor->vendor_store_name, $view->vendorAddress);
				}
			}

			// set header and footer fonts
			$this->setHeaderFont(Array('helvetica', '', 8));
			$this->setFooterFont(Array('helvetica', '', 10));

			// set default monospaced font
			$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

			//set margins
			$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$this->SetHeaderMargin(PDF_MARGIN_HEADER);
			$this->SetFooterMargin(PDF_MARGIN_FOOTER);

			//set auto page breaks
			$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

			//set image scale factor
			$this->setImageScale(PDF_IMAGE_SCALE_RATIO);

			//TODO include the right file (in libraries/tcpdf/config/lang set some language-dependent strings
			$l='';
			$this->setLanguageArray($l);

			// set default font subsetting mode
			$this->setFontSubsetting(true);

			// Set font
			// dejavusans is a UTF-8 Unicode font, if you only need to
			// print standard ASCII chars, you can use core fonts like
			// helvetica or times to reduce file size.
			$this->SetFont('helvetica', '', 8, '', true);

			// Add a page
			// This method has several options, check the source code documentation for more information.
			$this->AddPage();

			// Set some content to print
			// $html =

			// Print text using writeHTMLCell()
			$this->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);


			// Close and output PDF document
			// This method has several options, check the source code documentation for more information.
			$this->Output($path, 'F');

			// 			rsdebug('Pdf object ',$this->myTcPDF);
			// 		rsdebug('checkStoreInvoice start');
			return $path;

		}

		//Page header
		/*	public function Header() {
		// Logo
		$image_file = K_PATH_IMAGES.'logo_example.jpg';
		$this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		}*/

		// Page footer
		public function Footer() {
			// Position at 15 mm from bottom
			$this->SetY(-15);
			// Set font
			$this->SetFont('helvetica', 'I', 8);

			$vendorModel = rsModel::getModel('vendor');
			$vendor = & $vendorModel->getVendor();
			// 			$this->assignRef('vendor', $vendor);
			$vendorModel->addImages($vendor,1);
			//rsdebug('$vendor',$vendor);
			$html = $vendor->vendor_legal_info."<br /> Page ".$this->getAliasNumPage().'/'.$this->getAliasNbPages();
			// Page number
			$this->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

			// 		$this->writeHTML(0, 10, $vendor->vendor_legal_info."<br /> Page ".$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
		}
	}
}

