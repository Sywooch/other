<?php
class OrderOutCancaled
{
    public static function ExportOrderCut($mass){
	   $tmp = array();
	   foreach($mass['SalesLinesList'] as $number => $line){
       		if (($line['statusid']!=12) and ($line['statusid']!=13)) { 
				$tmp[$number] = $line;
			}
	   }
	   $mass['SalesLinesList'] = array();
	   $mass['SalesLinesList'] = $tmp;	   
	   return $mass;
    }

    
}
