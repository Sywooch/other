<?php
/**
* @version 1.4.0
* @package RSform!Pro 1.4.0
* @copyright (C) 2007-2011 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class RSFormPDF
{
	var $pdf;
	var $lib;
	
	function _getPDF()
	{
		if (!isset($this->pdf))
		{
			if ($this->lib == 'tcpdf')
			{
				require_once JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/pdf/tcpdf/tcpdf.php';
				$this->pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			}
			elseif ($this->lib == 'dompdf')
			{
				require_once JPATH_ADMINISTRATOR.'/components/com_rsform/helpers/pdf/dompdf6/dompdf_config.inc.php';
				$this->pdf = new DOMPDF();
			}
		}
		
		return $this->pdf;
	}
	
	function RSFormPDF($lib='dompdf')
	{
		$this->lib = $lib;
	}
	
	function write($filename, $html, $output=false)
	{
		// suppress errors
		if (strlen($html) > 0) {
			if ($this->lib == 'tcpdf')
				return $this->_writeTCPDF($filename, $html, $output);
			elseif ($this->lib == 'dompdf')
				return $this->_writeDOMPDF($filename, $html, $output);
		}
	}
	
	function _convertASCII($str)
	{
		$count	= 1;
		$out	= '';
		$temp	= array();
		
		for ($i = 0, $s = strlen($str); $i < $s; $i++) {
			$ordinal = ord($str[$i]);
			if ($ordinal < 128) {
				$out .= $str[$i];
			}
			else
			{
				if (count($temp) == 0) {
					$count = ($ordinal < 224) ? 2 : 3;
				}
			
				$temp[] = $ordinal;
			
				if (count($temp) == $count) {
					$number = ($count == 3) ? (($temp['0'] % 16) * 4096) + (($temp['1'] % 64) * 64) + ($temp['2'] % 64) : (($temp['0'] % 32) * 64) + ($temp['1'] % 64);

					$out .= '&#'.$number.';';
					$count = 1;
					$temp = array();
				}
			}
		}
		
		return $out;
	}
	
	function _writeDOMPDF($filename, $html, $output=false)
	{
		$dompdf	= $this->_getPDF();
		
		if (preg_match_all('#[^\x00-\x7F]#u', $html, $matches)) {
			foreach ($matches[0] as $match) {
				$html = str_replace($match, $this->_convertASCII($match), $html);
			}
		}
		
		$dompdf->load_html(utf8_decode($html), 'utf-8');
		$dompdf->set_paper(RSFormProHelper::getConfig('pdf.paper', 'a4'), RSFormProHelper::getConfig('pdf.orientation', 'portrait'));
		$dompdf->render();
		
		if ($output)
		{
			ob_end_clean();
			$dompdf->stream($filename);
		}
		else
			return $dompdf->output();
	}
	
	function _writeTCPDF($filename, $html, $output=false)
	{
		$pdf_info = new stdClass();
		$pdf	  = $this->_getPDF();
		
		// Author
		$pdf_info->created = '';
		$pdf_info->author  = '';
		$pdf_info->title   = '';

		// Header
		//$pdf_info->header_logo = 'logo.jpg';
		//$pdf_info->header_width = 20;
		//$pdf_info->header_title = 'header title';
		//$pdf_info->header_string = 'header string';
		
		$pdf->SetCreator($pdf_info->created);
		$pdf->SetAuthor($pdf_info->author);
		$pdf->SetTitle($pdf_info->title);
		//$pdf->SetHeaderData($pdf_info->header_logo, $pdf_info->header_width, $pdf_info->header_title, $pdf_info->header_string);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		//set margins
		$margin_left  = 5;
		$margin_right = 5;
		$margin_top   = 10;
		$pdf->SetMargins($margin_left, $margin_top, $margin_right);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);

		//set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		//set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		$pdf->SetFont('helvetica', '', 8);

		$pdf->AddPage();
		
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->lastPage();
		
		ob_end_clean();
		
		return $pdf->Output($filename, $ouput ? 'I' : 'S');
	}
}