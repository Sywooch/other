<?php

OTBase::import('system.lib.Validation.*');
OTBase::import('system.lib.Validation.Rules.*');

class Shipment extends GeneralUtil
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'general';
    protected $_template_path = 'shipment/';
    /**
     * @var SiteConfigurationRepository
     */
    protected $siteConfigRepository;
    /**
     * @var ShipmentProvider
     */
    protected $shipmentProvider;


    public function __construct()
    {
        parent::__construct();
        $this->cms->checkTable('site_config');
        $this->cms->checkTable('site_langs');
        $this->siteConfigRepository = new SiteConfigurationRepository($this->cms);
        $this->shipmentProvider = new ShipmentProvider($this->getOtapilib());
    }

    public function defaultAction($request)
    {
        $this->authenticationListener->CheckAuthentication($request);
        try{
            $this->tpl->assign('Delivery', $this->shipmentProvider->GetDelivery());
        }
        catch(ServiceException $e) {
            $this->errorHandler->CheckSessionExpired($e, $request);
        }
        $this->tpl->assign('Countries', $this->shipmentProvider->GetCountries());
        $this->tpl->assign('Rates', $this->shipmentProvider->GetRates());

        $this->assignSiteConfig();
        print $this->fetchTemplate();
    }

    public function internalAction($request)
    {
        $this->authenticationListener->CheckAuthentication($request);
        $this->_template = 'internal';
        
        try {
            $this->tpl->assign('Settings', $this->shipmentProvider->GetShowCase());
            $this->tpl->assign('Delivery', $this->shipmentProvider->GetDelivery());
            $this->tpl->assign('Countries', $this->shipmentProvider->GetCountries());
            $this->tpl->assign('Rates', $this->shipmentProvider->GetRates());
        }
        catch (Exception $e) {
            $this->tpl->assign('Settings', array());
            $this->tpl->assign('Delivery', array());
            $this->tpl->assign('Countries', array());
            $this->tpl->assign('Rates', array());
            ErrorHandler::registerError($e);
        }

        $this->assignSiteConfig();
        print $this->fetchTemplate();
    }

    public function tariffsAction($request)
    {
        $this->authenticationListener->CheckAuthentication($request);
        $this->_template = 'tariffs';
        
        try {
            $this->tpl->assign('Delivery', $this->shipmentProvider->GetDeliveriesById());
            $this->tpl->assign('Countries', $this->shipmentProvider->GetCountries());
            $this->tpl->assign('Rates', $this->shipmentProvider->GetRates());
        } catch (Exception $e) {
            $this->tpl->assign('Delivery', array());
            $this->tpl->assign('Countries', array());
            $this->tpl->assign('Rates', array());
            ErrorHandler::registerError($e);
        }
        
        $this->assignSiteConfig();
        print $this->fetchTemplate();
    }

    public function edittariffAction($request)
    {
        $this->authenticationListener->CheckAuthentication($request);

        $this->_template = 'tariff_form';

        try {
            $Delivery = $this->shipmentProvider->GetDeliveriesById();
            if ($request->getValue('delivery')) {
                $this->tpl->assign('DeliveryItem', $Delivery[$request->getValue('delivery')]);
            } 

            $tariff = $this->shipmentProvider->GetRateById($request->getValue('id'));
            $this->tpl->assign('Tariff', $tariff); 
            $this->tpl->assign('Countries', 
                $this->shipmentProvider->GetCountriesWithoutRate(
                    $Delivery[$request->getValue('delivery')], 
                    array($tariff['countrycode'])));
        } catch (Exception $e) {
            $this->tpl->assign('Tariff', array());
            $this->tpl->assign('Countries', array());
            ErrorHandler::registerError($e);
        }
        
        $this->tpl->assign('actionTitle', LangAdmin::get('editing'));

        $this->assignSiteConfig();
        print $this->fetchTemplate();
    }

    /**
     * @param RequestWrapper $request
     */
    public function addTariffAction($request)
    {
        $this->authenticationListener->CheckAuthentication($request);

        $this->_template = 'tariff_form';

        try {
            $Delivery = $this->shipmentProvider->GetDeliveriesById();
            if ($request->getValue('delivery')) {
                if ($Delivery[$request->getValue('delivery')]) {
                    $this->tpl->assign('DeliveryItem', $Delivery[$request->getValue('delivery')]);
                } else {
                    $request->RedirectToReferrer();
                }
            }
            $this->tpl->assign('Countries', $this->shipmentProvider->GetCountriesWithoutRate($Delivery[$request->getValue('delivery')]));
        } catch (Exception $e) {
            $this->tpl->assign('Countries', array());
            ErrorHandler::registerError($e);
        }

        $this->tpl->assign('actionTitle', LangAdmin::get('adding'));

        $this->assignSiteConfig();
        print $this->fetchTemplate();
    }

    public function editDeliveryAction($request)
    {
        $this->authenticationListener->CheckAuthentication($request);
        $this->_template = 'delivery_form';

        if ($request->get('id')) {
            $delivery = $this->shipmentProvider->GetDeliveryById($request->get('id'));
            $parsed_formula = self::ParseFormula($delivery['formula']);
            $this->tpl->assign('Delivery', $delivery);
            $this->tpl->assign('parsed_formula', $parsed_formula);
            $actionTitle = LangAdmin::get('editing');
            $this->tpl->assign('isRoundedStep', strstr($delivery['formula'], 'ceil') !== false);
        } else {
            $actionTitle = LangAdmin::get('adding');
            $this->tpl->assign('isRoundedStep', false);
        }

        $this->tpl->assign('actionTitle', $actionTitle);
        $this->tpl->assign('Countries', $this->shipmentProvider->GetCountries());
        $this->tpl->assign('CurrencyList', $this->shipmentProvider->GetCurrencyInstanceList());
        $this->tpl->assign('integrationTypes', $this->getOtapilib()->GetDeliveryServiceSystemInfoList());

        $this->assignSiteConfig();
        print $this->fetchTemplate();
    }

    public function saveDeliveryAction($request)
    {
        try {
			$params = $this->checkDeliveryData($request);
            $r = $this->shipmentProvider->SaveDelivery($params);			
        }
        catch (ValidationException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    public function deleteDeliveryAction($request)
    {
        try {
            $r = $this->shipmentProvider->DeleteDelivery($request);
        }
        catch (ValidationException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    public function getConfigInJSAction()
    {
        $this->_template_path = 'site_config/';
        $this->_template = 'config_js';
        $this->assignSiteConfig();
        print $this->fetchTemplateWithoutHeaderAndFooter();
    }

    private function assignSiteConfig()
    {
        $this->siteConfigRepository->SetActiveLang(Session::get('active_lang_siteconfiguration'));
        $this->tpl->assign('Config', $this->siteConfigRepository);
    }
	
	private function checkDeliveryData($request)
    {
		$params = $request->getValue('delivery');
		if (! isset($params['name'])) 
		    $params['name'] = '';
		if (! isset($params['step_weight'])) 
		    $params['step_weight'] = 0;
		if (! isset($params['min_price_delivery'])) 
		    $params['min_price_delivery'] = '';
		if (! isset($params['rounding'])) 
		    $params['rounding'] = '';
	    
		$validator = new Validator(array(
            'name'        => $params['name'],
            'choice'      => $params['min_price_delivery'] + $params['step_weight'],					
        ));
        $validator->addRule(new NotEmpty(), 'name', LangAdmin::get('Must_enter_delivery_name'));
        $validator->addRule(new NotEmpty(), 'choice', LangAdmin::get('Must_be_checked_one_of_params_minpricedelivery_or_stepprice'));		

        if (! $validator->validate()) {
		   $errors = $validator->getLastError();		   
		   throw new ValidationException((string)$errors);		   
        }
		return $params;
    }

    public function saveTariffAction($request)
    {
        try {
            $this->shipmentProvider->SaveRate($request);
        }
        catch(ValidationException $e){
            $this->respondAjaxError($e->getMessage());
        }
        catch(Exception $e){
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    public function deleteTariffAction($request)
    {
        try {
            $r = $this->shipmentProvider->DeleteRate($request);
        }
        catch (ValidationException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }

    public function regionsAction($request) 
    {
        try {
            $r = $this->shipmentProvider->GetRegions($request);
        }
        catch(ValidationException $e) {
            $this->respondAjaxError($e->getMessage());
        }
        catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        echo $r;
    }

    public function saveInternalAction($request)
    {
        try {
            $result = $this->shipmentProvider->SaveCase($request);
            if (empty($result)) {
                throw new ServiceException(__METHOD__, '', LangAdmin::get('Notify_error'), 1);
            }
        } catch (ServiceException $e) {
            $this->respondAjaxError($e->getMessage());
        }

        $this->sendAjaxResponse();
    }

    public function ParseFormula($formula)
    {
        //Парсим формулу
        $formula = "_".$formula."_"; //Так как не всегда видит первый и последний символ
        $mass = array();
        //$weight < 2 ? 0 : ($start + (ceil ($weight * 10) - 1) * $step)
        if (strpos($formula, "?")) { //Если есть зависимость от веса
            if ((strpos($formula, "&")) or (strpos($formula, "|"))) {
                //($weight > 20) && ($weight <= 1)) ? 0 : ($start + (ceil ($weight * 10) - 1) * $step)
                //Если формула задана не так увы (((((( и так много проверок
                preg_match_all('/weight >(.*)\)/isU', $formula, $weight1, PREG_PATTERN_ORDER);
                preg_match_all('/weight <=(.*)\)/isU', $formula, $weight2, PREG_PATTERN_ORDER);
                @$mass['max_weight'] = str_replace(' ', '', $weight1[1][0]);
                @$mass['min_weight'] = str_replace(' ', '', $weight2[1][0]);
            } else {
                //$weight < 2
                if (strpos($formula, "<")) {
                    preg_match_all('/weight <(.*)\?/isU', $formula, $weight1, PREG_PATTERN_ORDER);
                    @$mass['max_weight'] = str_replace(' ', '', $weight1[1][0]);
                    @$mass['min_weight'] = '';
                } else {
                    preg_match_all('/weight >(.*)\?/isU', $formula, $weight1, PREG_PATTERN_ORDER);
                    @$mass['max_weight'] = '';
                    @$mass['min_weight'] = str_replace(' ', '', $weight1[1][0]);
                }

            }
            //Выевялем ошибки
            if  (($mass['max_weight'] == '') and ($mass['min_weight'] == ''))   {
                @$mass['errorparse'] = '1';
            }

        } else {
            @$mass['max_weight'] = '';
            @$mass['min_weight'] = '';
        }


        //Шаг по весу
        preg_match_all('/weight \* (.*)\)/isU', $formula, $step_weight, PREG_PATTERN_ORDER);
        if (isset($step_weight[1][0]))
            $mass['step_weight'] = @$step_weight[1][0]/100;

        preg_match_all('/weight \/ (.*)\)/isU', $formula, $step_weight, PREG_PATTERN_ORDER);
        if (@$step_weight[1][0] <> '')
            $mass['step_weight'] = @$step_weight[1][0];
        //Минимальная цена доставки
        if (strpos($formula, htmlspecialchars('$start')))
            $mass['min_price_delivery'] = 'checked';

        //Округляем иль нет
        if (strpos($formula, "ceil"))
            $mass['rounding'] = 'checked';

        
        //Подгатавливаем массив на выход к публике - убираем символу способные попасть в массив при разборе
        foreach ($mass as &$value) {
            $value = str_replace(' ', '', $value);
            $value = str_replace('_', '', $value);
            $value = str_replace(')', '', $value);
            $value = str_replace('(', '', $value);
        }

        return $mass;
    }
}
