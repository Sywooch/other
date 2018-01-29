<?php

class PricingProvider {
    /**
     * @var OTAPIlib
     */
    private $otapilib;

    public function __construct($otapilib)
    {
        $this->otapilib = $otapilib;
    }
    
    public function GetShowCase() 
    {
        $this->otapilib->setResultInXMLOn();
        $r = $this->otapilib->GetShowcase(Session::get('sid'));
        $this->otapilib->setResultInXMLOff();
        return $r;
    }

    public function GetShowcaseCurrencyRates()
    {
        $this->otapilib->setResultInXMLOn();
        $result = $this->otapilib->GetShowcaseCurrencyRates();
        $this->otapilib->setResultInXMLOff();
        return $result;
    }
    
    public function GetCurrencyList() 
    {
        return $this->otapilib->GetCurrencyList(Session::get('sid'));
    }
    
    
    public function GetCurrenciesSettings() 
    {
        $this->otapilib->setResultInXMLOn();
        $r = $this->otapilib->GetInstanceCurrenciesSettings(Session::get('sid'));
        $this->otapilib->setResultInXMLOff();
        return $r;
    }
    
    public function GetCurrencySynchronizationModeList() 
    {                
        return $this->otapilib->GetCurrencySynchronizationModeList(Session::get('sid'));
    }
    
    public function GetPriceFormationSettings() 
    {
        return $this->otapilib->GetPriceFormationSettings(Session::get('sid'));        
    }
    
    public function RemoveCurrencyRate($request) 
    {        
        $this->otapilib->RemoveCurrencyRate(Session::get('sid'), $request->getValue('firstCode'), $request->getValue('secondCode'));        
    }   
    
    public function saveSettingsCost($request) 
    {
        $xmlParams = $this->_getCostXML($request);
        $this->otapilib->SetShowcaseSettings(Session::get('sid'), $xmlParams);
    }
    
    public function saveSettingsRound($request) 
    {
        $xml = "<EditablePriceFormationSettings PriceRoundingFactor='{$request->getValue('value')}' />";         
        $this->otapilib->EditPriceFormationSettings(Session::get('sid'), $xml);
    }
	
	public function UpdateInstanceCurrenciesSettings($request) {
        $xmlParams = $this->_getCurrencyXML($request->getValue('currency'));
		$xmlParams = $this->_getCBXML($request, $xmlParams);
		$xmlParams = $this->_getRatesXML($request, $xmlParams);
        $this->otapilib->UpdateInstanceCurrenciesSettings(Session::get('sid'), $xmlParams);
    }
    
    private function _generateFilters($request) 
    {
        $xmlParams = new SimpleXMLElement('<UserFilterParameters></UserFilterParameters>');
        $xmlParams->addChild('Login', @htmlspecialchars($request->getValue('nme')));        
        return str_replace('<?xml version="1.0"?>', '', $xmlParams->asXML());
    }

    /**
     * @param RequestWrapper $request
     * @return string
     */
    private function _getCBXML($request, $xmlParams) 
    {               
        foreach ($request->getAll() as $name => $value) {
            if ($name == 'syncMode') {                
                if (! empty($value)) {
                    $xmlParams .=  "<SyncMode>{$value}</SyncMode>";
                }
            }
            if ($name == 'margin_value') {
                $margin = (float)str_replace(array(',', ' '), array('.', ''), $value);
                $marginProportion = round($margin / 100 + 1, 3);

                $xmlParams .=  "<MarginRate>{$marginProportion}</MarginRate>";
            }
        }        
        return $xmlParams;
    }
    
    private function _getRatesXML($request, $xmlParams) 
    {
        $rates = $request->getValue('rates');        
        $xmlParams .= '<CurrencyRateList>';

        if(is_array($rates))
            foreach ($rates as $rate) {
                $rate = explode(',', $rate);
                if (! (float)$rate[2]) {
                    throw new Exception(LangAdmin::get('Rate_must_be_float'));
                }
                $rate_xml =  new SimpleXMLElement('<CurrencyRate>'.htmlspecialchars($rate[2]).'</CurrencyRate>');
                $rate_xml->addAttribute('FirstCode', $rate[0]);
                $rate_xml->addAttribute('SecondCode', $rate[1]);
                $xmlParams .= str_replace('<?xml version="1.0"?>', '', $rate_xml->asXML());
            }
        
        $xmlParams .= '</CurrencyRateList></CurrencySettings>';                   
        return $xmlParams;
    }
    
    private function _getCostXML($request) 
    {
        $xmlParams = '<Settings>';
        
        if ($request->getValue('name') == 'persent') {
            $xmlParams .=  '<MarginPercentage>'.floatval($request->getValue('value')).'</MarginPercentage>';
        }

        if ($request->getValue('name') == 'minimummargin') {
            $xmlParams .= '<MinimumMargin>'.floatval($request->getValue('value')).'</MinimumMargin>';
        }

        if ($request->getValue('name') == 'usediscount') {
            $value = $request->getValue('value') ? 'true' : 'false';
            $xmlParams .= '<UseDiscount>'.$value.'</UseDiscount>';
        }

        if ($request->getValue('name') == 'usevipdiscount') {
            $value = $request->getValue('value') ? 'true' : 'false';
            $xmlParams .= '<UseVipDiscount>'.$value.'</UseVipDiscount>';
        }

        if ($request->getValue('name') == 'discountmode') {
            $value = $request->getValue('value');
            $xmlParams .= '<DiscountMode>'.$value.'</DiscountMode>';
        }
        
        $xmlParams .= '</Settings>';

        return $xmlParams;
    }
    
    
    private function _getRoundSettingsXML($request) 
    {
        $xmlParams = '<Settings>';
        
        if ($request->getValue('name') == 'persent') {
            $xmlParams .=  '<MarginPercentage>'.floatval($request->getValue('value')).'</MarginPercentage>';
        }

        if ($request->getValue('name') == 'minimummargin') {
            $xmlParams .= '<MinimumMargin>'.floatval($request->getValue('value')).'</MinimumMargin>';
        }
        
        $xmlParams .= '</Settings>';

        return $xmlParams;
    }
    
    
    private function _getCurrencyXML($currency_list) 
    {
        $order = 0;
        $xmlParams = '<CurrencySettings>';
        $xmlParams .= '<CurrenciesDisplayingOrder>';
        if (is_array($currency_list))
            foreach ($currency_list as $currency) {
                if($currency == '') continue;
                $currency_xml =  new SimpleXMLElement('<OrderedCurrency></OrderedCurrency>');
                $currency_xml->addAttribute('Code', $currency);
                $currency_xml->addAttribute('Order', $order);
                $xmlParams .= str_replace('<?xml version="1.0"?>', '', $currency_xml->asXML());

                $order++;
            }
        $xmlParams .= '</CurrenciesDisplayingOrder>';       
        
        return $xmlParams;
    }
    
    public function GetPriceFormationGroupList($sessionId) 
    {
        return $this->otapilib->GetPriceFormationGroupList($sessionId);
    }
    
    public function GetPriceFormationStrategyList($sessionId)
    {
        return $this->otapilib->GetPriceFormationStrategyList($sessionId);
    }
    
    public function RemovePriceFormationGroup($sessionId, $priceFormationGroupId) 
    {
        return $this->otapilib->RemovePriceFormationGroup($sessionId, $priceFormationGroupId);
    }
    
    public function AddPriceFormationGroup($sid, $xmlParams)
    {
       return $this->otapilib->AddPriceFormationGroup($sid, $xmlParams, "");
    }
    
    public function SetDefaultPriceFormationGroup($sid, $groupId)
    {
        return $this->otapilib->SetDefaultPriceFormationGroup($sid, $groupId, "");
    }
    
    public function EditPriceFormationGroup($sid, $id, $xmlParams)
    {
        return $this->otapilib->EditPriceFormationGroup($sid, $id, $xmlParams, "");
    }

    public function GetPriceFormationGroup($sessionId, $id)
    {
        return $this->otapilib->GetPriceFormationGroup($sessionId, $id);
    }
    
    public function GetCategoriesOfPriceFormationGroup($sid, $id) 
    {
        return $this->otapilib->GetCategoriesOfPriceFormationGroup($sid, $id, "");
    }
    
    public function SetPriceFormationGroupToCategory($sid, $categoryId, $id) 
    {
        return $this->otapilib->SetPriceFormationGroupToCategory($sid, $categoryId, $id, "");
    }
    
    public function RemoveCategoryFromPriceFormationGroup($sid, $categoryId, $groupId)
    {
        return $this->otapilib->RemoveCategoryFromPriceFormationGroup($sid, $categoryId, $groupId, "");
    }
    
}