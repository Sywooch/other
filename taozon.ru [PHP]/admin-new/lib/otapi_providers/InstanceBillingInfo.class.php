<?php

class InstanceBillingInfo
{
    /**
     * @var OtapiBillInfoListAnswer
     */
    private $bills = null;

    /**
     * @return OtapiBillInfoListAnswer
     */
    public function getBills()
    {
        return $this->bills;
    }

    /**
     * @return OtapiInstanceOptionsInfoAnswer
     */
    public function getInstanceOptions()
    {
        return $this->instanceOptions;
    }

    /**
     * @return OtapiTariffChangeHistoryAnswer
     */
    public function getRateHistory()
    {
        return $this->rateHistory;
    }

    /**
     * @var OtapiTariffChangeHistoryAnswer
     */
    private $rateHistory = null;

    /**
     * @var OtapiInstanceOptionsInfoAnswer
     */
    private $instanceOptions = null;

    /**
     * @var OtapiCalculateRentResponse
     */
    private $calculateRent = null;
    
    /**
     * @return OtapiCalculateRentResponse
     */
    public function getCalculateRent()
    {
        return $this->calculateRent;
    }
    
    /**
    * @var $answers OtapiBillInfoListAnswer
    */
    public function initSearchBills($sid)
    {
        OTAPILib2::SearchBills($sid, '<BillSearchParameters></BillSearchParameters>', '0', '100', $this->bills);
    }
    
    /**
    * @var $answers OtapiCalculateRentResponse
    */
    public function initCalculateRent($sid)
    {
        $dates = new DateTime('NOW');
        $fromDate = date('c', strtotime($dates->format('Y-m') .'-01'));
        $toDate = date('c', strtotime($dates->format('Y-m-d').' 23:59:59'));        
        OTAPILib2::CalculateRent($sid, $fromDate, $toDate, 'false', $this->calculateRent);
    }
    
    /**
    * @var $answers OtapiCalculateRentResponse
    */
    public function initCalculateRentToBill($sid, $fromDate, $toDate)
    {               
        OTAPILib2::CalculateRent($sid, $fromDate, $toDate, 'true', $this->calculateRent);
    }
    
    /**
    * @var $answers OtapiTariffChangeHistoryAnswer
    */
    public function initRateHistory($sid)
    {
        OTAPILib2::GetTariffChangeHistory($sid, $this->rateHistory);
    }
    
    /**
    * @var $answers OtapiInstanceOptionsInfoAnswer
    */
    public function initInstanceOptions($sid)
    {
        OTAPILib2::GetInstanceOptionsInfo($sid, $this->instanceOptions);
    }
    
    public function doRequests()
    {
        OTAPILib2::makeRequests();
    }
}