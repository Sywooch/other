<?php
/**
* @version 1.0.0
* @package RSEvents!Pro 1.0.0
* @copyright (C) 2007-2012 www.rsjoomla.com
* @license GPL, http://www.gnu.org/copyleft/gpl.html
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class RSEventsProPDF
{
	protected $pdf;
	
	public function __construct() {
		if (!isset($this->pdf)) {
			require_once JPATH_SITE.'/components/com_rseventspro/helpers/pdf/dompdf/dompdf_config.inc.php';
			$this->pdf = new DOMPDF();
		}
	}
	
	public function getInstance() {
		return new RSEventsProPDF();
	}
	
	public function write($html, $orientation = 'portrait') {
		$pdf	  = $this->pdf;
		
		if (preg_match_all('#[^\x00-\x7F]#u', $html, $matches)) {
			foreach ($matches[0] as $match) {
				$html = str_replace($match, $this->_convertASCII($match), $html);
			}
		}
		
		$pdf->load_html(utf8_decode($html), 'utf-8');
		$pdf->set_paper('letter', $orientation);
		$pdf->render();
		
		return $pdf->output();
	}
	
	public function output($html, $name, $orientation = 'portrait') {
		$pdf	  = $this->pdf;
		
		if (preg_match_all('#[^\x00-\x7F]#u', $html, $matches)) {
			foreach ($matches[0] as $match) {
				$html = str_replace($match, $this->_convertASCII($match), $html);
			}
		}
		
		$pdf->load_html(utf8_decode($html), 'utf-8');
		$pdf->set_paper('letter', $orientation);
		$pdf->render();
		
		return $pdf->stream($name);
	}
	
	protected function _convertASCII($str) {
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
	
	public function ticket($id) {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		// Get subscriber details
		$query->clear()
			->select($db->qn('ide'))->select($db->qn('name'))->select($db->qn('discount'))
			->select($db->qn('early_fee'))->select($db->qn('late_fee'))->select($db->qn('tax'))
			->select($db->qn('state'))->select($db->qn('gateway'))->select($db->qn('ip'))
			->select($db->qn('coupon'))->select($db->qn('email'))
			->from($db->qn('#__rseventspro_users'))
			->where($db->qn('id').' = '.(int) $id);
		
		$db->setQuery($query);
		$subscription = $db->loadObject();
			
		if ($subscription->state != 1) {
			return false;
		}
		
		// Get ticket details
		$query->clear()
			->select($db->qn('ticket_pdf'))->select($db->qn('ticket_pdf_layout'))
			->from($db->qn('#__rseventspro_events'))
			->where($db->qn('id').' = '.(int) $subscription->ide);
		
		$db->setQuery($query);
		$ticketpdf = $db->loadObject();
		
		if (empty($ticketpdf) || empty($ticketpdf->ticket_pdf) || empty($ticketpdf->ticket_pdf_layout)) {
			return false;
		}
		
		// Set the ticket layout
		$layout = $ticketpdf->ticket_pdf_layout;
		
		// Get tickets
		$tickets	= rseventsproHelper::getUserTickets($id);
		$info		= '';
		$total		= 0;
		
		if (!empty($tickets)) {
			foreach ($tickets as $ticket) {
				if ($ticket->price > 0) {
					$price = $ticket->price * (int) $ticket->quantity;
					$total += $price;
					$info .= $ticket->quantity . ' x ' .$ticket->name.' ('.rseventsproHelper::currency($ticket->price).') '.rseventsproHelper::getSeats($id,$ticket->id).' <br />';
				} else {
					$info .= $ticket->quantity . ' x ' .$ticket->name.' ('.JText::_('COM_RSEVENTSPRO_GLOBAL_FREE').') <br />';
				}
			}
		}
			
		if (!empty($subscription->discount) && !empty($total))
			$total = $total - $subscription->discount;
		
		if (!empty($subscription->early_fee) && !empty($total))
			$total = $total - $subscription->early_fee;
		
		if (!empty($subscription->late_fee) && !empty($total))
			$total = $total + $subscription->late_fee;
		
		if (!empty($subscription->tax) && !empty($total))
			$total = $total + $subscription->tax;
		
		
		$ticketstotal		= rseventsproHelper::currency($total);
		$ticketsdiscount	= !empty($subscription->discount) ? rseventsproHelper::currency($subscription->discount) : '';
		$subscriptionTax	= !empty($subscription->tax) ? rseventsproHelper::currency($subscription->tax) : '';
		$lateFee			= !empty($subscription->late_fee) ? rseventsproHelper::currency($subscription->late_fee) : '';
		$earlyDiscount		= !empty($subscription->early_fee) ? rseventsproHelper::currency($subscription->early_fee) : '';
		$gateway			= rseventsproHelper::getPayment($subscription->gateway);
		$IP					= $subscription->ip;
		$coupon				= !empty($subscription->coupon) ? $subscription->coupon : '';
		$optionals			= array($info, $ticketstotal, $ticketsdiscount, $subscriptionTax, $lateFee, $earlyDiscount, $gateway, $IP, $coupon);
		
		$layout = rseventsproEmails::placeholders($layout, $subscription->ide, $subscription->name, $optionals);
		$layout = str_replace('{sitepath}',JPATH_SITE,$layout);
		$layout = str_replace('{useremail}',$subscription->email,$layout);
			
		if (strpos($layout,'{barcode}') !== FALSE) {
			jimport('joomla.filesystem.file');
			require_once JPATH_SITE.'/components/com_rseventspro/helpers/pdf/barcodes.php';
			$barcode = new TCPDFBarcode('RST-'.$id, rseventsproHelper::getConfig('barcode'));
			
			ob_start();
			$barcode->getBarcodePNG();
			$thecode = ob_get_contents();
			ob_end_clean();
			
			$file = JPATH_SITE.'/components/com_rseventspro/assets/barcode/rset-'.md5($subscription->name).'.png';
			$upload = JFile::write($file,$thecode);
			$barcodeHTML = $upload ? '<img src="'.$file.'" alt="" />' : '';
			
			$layout = str_replace('{barcode}',$barcodeHTML,$layout);
		}
		
		$layout = str_replace('{barcodetext}','RST-'.$id,$layout);
		$buffer = $this->output($layout, 'Ticket.pdf');
			
		if ($file && file_exists($file))
			JFile::delete($file);
			
		return $buffer;
	}
	
	public function tickets($id) {
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		
		// Get subscribers
		$query->clear()
			->select($db->qn('id'))->select($db->qn('name'))
			->select($db->qn('email'))->select($db->qn('date'))
			->from($db->qn('#__rseventspro_users'))
			->where($db->qn('ide').' = '.(int) $id)
			->where($db->qn('state').' = 1');
		
		$db->setQuery($query);
		$subscribers = $db->loadObjectList();
		
		// Get event name
		$query->clear()
			->select($db->qn('name'))
			->from($db->qn('#__rseventspro_events'))
			->where($db->qn('id').' = '.(int) $id);
		
		$db->setQuery($query);
		$event = $db->loadResult();
		
		$layout = '';
		
		if (!empty($subscribers)) {
			jimport('joomla.filesystem.file');
			require_once JPATH_SITE.'/components/com_rseventspro/helpers/pdf/barcodes.php';
			
			$layout .= '<h2 style="text-align:center;">'.JText::sprintf('COM_RSEVENTSPRO_SUBSCRIBERS_FOR',$event).'</h2>';
			$layout .= '<table width="100%" cellspacing="0" cellpadding="10">';
			
			$remove = array();
			
			$i = 1;
			foreach ($subscribers as $subscriber) {
				$barcode = new TCPDFBarcode('RST-'.$subscriber->id, rseventsproHelper::getConfig('barcode'));
			
				ob_start();
				$barcode->getBarcodePNG();
				$thecode = ob_get_contents();
				ob_end_clean();
				
				$file = JPATH_SITE.'/components/com_rseventspro/assets/barcode/rset-'.md5($subscriber->id.$subscriber->name).'.png';
				$upload = JFile::write($file,$thecode);
				$barcodeHTML = $upload ? '<img src="'.$file.'" alt="" /> <br />RST-'.$subscriber->id : '';
				
				$layout .= '<tr>';
				$layout .= '<td>'.$i.'</td>';
				$layout .= '<td>'.$subscriber->name . ' (' .$subscriber->email.')<br />';
				$layout .= JText::_('COM_RSEVENTSPRO_SUBSCRIBED_ON').' '.rseventsproHelper::date($subscriber->date).'</td>';
				$layout .= '<td align="center">'.$barcodeHTML.'</td>';
				
				$layout .= '</tr>';
				$i++;
				$remove[] = $file;
			}
			
			$layout .= '</table>';
			
			$buffer = $this->output($layout, 'Tickets.pdf');
			
			if (!empty($remove)) {
				foreach ($remove as $file) {
					if (JFile::exists($file)) {
						JFile::delete($file);
					}
				}
			}
			
			return $buffer;
		}
		
		return false;
	}
}