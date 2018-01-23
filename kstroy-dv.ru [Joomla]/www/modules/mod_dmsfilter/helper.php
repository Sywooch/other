<?php
/**
 * @package     mod_dmsfilter
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later
 * @author      Misha Datsko <misha@datsko.info> - http://datsko.info
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

class modDmsfilterHelper{
    function getFilterdata(&$params){
		$db = JFactory::getDbo();
		$result = array();
		if($params->get('show_categories','0')){
			$query = $db->getQuery(true)
				->select('c.*,c.virtuemart_category_id AS id,cru.category_name AS filtername')
				->from('#__virtuemart_categories c')
				->join('LEFT','#__virtuemart_categories_ru_ru cru ON cru.virtuemart_category_id=c.virtuemart_category_id')
				->where('c.published=1')
				->order('c.ordering');
			$db->setQuery($query);
			$categories = $db->loadObjectList();
			$result = array();
			$result['categories']['data'] = $categories;
			$result['categories']['filtertype'] = 'checkbox';
		}
		if($params->get('show_manufacturers','0')){
			$query = $db->getQuery(true)
				->select('m.*,m.virtuemart_manufacturer_id AS id,mru.mf_name AS filtername')
				->from('#__virtuemart_manufacturers m')
				->join('LEFT','#__virtuemart_manufacturers_ru_ru mru ON mru.virtuemart_manufacturer_id=m.virtuemart_manufacturer_id')
				->where('m.published=1')
				->order('mru.mf_name');
			$db->setQuery($query);
			$manufacturers = $db->loadObjectList();
			$result['manufacturers']['data'] = $manufacturers;
			$result['manufacturers']['filtertype'] = 'checkbox';
		}
		if($params->get('show_prices','0')){
			$query = $db->getQuery(true)
				->select('MIN(pp.product_price) AS min,MAX(pp.product_price) AS max')
				->from('#__virtuemart_products p')
				->join('LEFT','#__virtuemart_product_prices pp ON pp.virtuemart_product_id=p.virtuemart_product_id')
				->where('p.published=1');
			$db->setQuery($query);
			$manufacturers = $db->loadObjectList();
			
			$result['prices']['data'] = $manufacturers;
			$result['prices']['filtertype'] = 'slider';
			
			$result = json_decode(json_encode($result), FALSE);
        }
		return $result;
	}
	function getProducts(){
		$module = JModuleHelper::getModule('mod_dmsfilter');
		$params = new JRegistry;
		$params->loadString($module->params);
		$catids = JRequest::getVar('categories');
		$manids = JRequest::getVar('manufacturers');
		$pricesmin = JRequest::getVar('pricesmin');
		$pricesmax = JRequest::getVar('pricesmax');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
            ->select('DISTINCT p.virtuemart_product_id,p.*,pru.product_name,m.file_url,mnru.mf_name,pp.product_price,pp.product_tax_id,cl.calc_value_mathop,cl.calc_value,cr.currency_symbol,pc.virtuemart_category_id')
    	    ->from('#__virtuemart_products p')
    	    ->join('LEFT','#__virtuemart_product_categories pc ON p.virtuemart_product_id=pc.virtuemart_product_id')
    	    ->join('LEFT','#__virtuemart_products_ru_ru pru ON pru.virtuemart_product_id=p.virtuemart_product_id')
    	    ->join('LEFT','#__virtuemart_product_medias pm ON pm.virtuemart_product_id=p.virtuemart_product_id AND pm.ordering=1')
    	    ->join('LEFT','#__virtuemart_medias m ON m.virtuemart_media_id=pm.virtuemart_media_id')
    	    ->join('LEFT','#__virtuemart_product_manufacturers pmn ON pmn.virtuemart_product_id=p.virtuemart_product_id')
    	    ->join('LEFT','#__virtuemart_manufacturers_ru_ru mnru ON mnru.virtuemart_manufacturer_id=pmn.virtuemart_manufacturer_id')
    	    ->join('LEFT','#__virtuemart_product_prices pp ON pp.virtuemart_product_id=p.virtuemart_product_id')
    	    ->join('LEFT','#__virtuemart_calcs cl ON cl.virtuemart_calc_id=pp.product_tax_id')
    	    ->join('LEFT','#__virtuemart_currencies cr ON cr.virtuemart_currency_id=pp.product_currency')
            ->where('p.published=1'.($catids?' AND pc.virtuemart_category_id IN ('.implode(',',$catids).')':'').($manids?' AND pmn.virtuemart_manufacturer_id IN ('.implode(',',$manids).')':'').($pricesmin?' AND pp.product_price>='.$pricesmin:'').($pricesmax?' AND pp.product_price<='.$pricesmax:''))
            ->order('p.virtuemart_product_id LIMIT 300');
        $db->setQuery($query);
		$products_object = $db->loadObjectList();
		$products = array();
		foreach($products_object as $p){
			$p->file_url = '/'.$p->file_url;
			
			if($p->product_tax_id){
				switch($p->calc_value_mathop){
					case'-%':{
						$p->product_tax_price = self::getPriceformated(((int)$p->product_price-((int)$p->product_price*(int)$p->calc_value/100)),$p);
						break;
					}
					case'+%':{
						$p->product_tax_price = self::getPriceformated(((int)$p->product_price+((int)$p->product_price*(int)$p->calc_value/100)),$p);
						break;
					}
					case'-':{
						$p->product_tax_price = self::getPriceformated(((int)$p->product_price-(int)$p->calc_value),$p);
						break;
					}
					case'+':{
						$p->product_tax_price = self::getPriceformated(((int)$p->product_price+(int)$p->calc_value),$p);
						break;
					}
					default:{
						$p->product_tax_price = 0;
						break;
					}
				}
			}
			$p->product_price = self::getPriceformated($p->product_price,$p);
			$p->product_url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$p->virtuemart_product_id.'&virtuemart_category_id='.$p->virtuemart_category_id.($params->get('inmodal')?'&tmpl=component':''));
			$products[] = $p;
		}
		return $products;
	}
	function getPriceformated($price=0,$p){
		$price = '<b>'.number_format($price,0,'.',' ').'</b> '.$p->currency_symbol;
		return $price;
	}
	function getAjax(){
		switch(JRequest::getVar('act')){
			default:{
				$data = base64_encode(json_encode(self::getProducts()));
				break;
			}
		}
		return $data;
	}
}
?>
