<?php

class OtapiRentalPaymentInfo extends BaseOtapiType{
    /**
     * @return dateTime
     */
    public function GetDateFrom(){
        $value = isset($this->xmlData->DateFrom) ? (string)$this->xmlData->DateFrom : false;
        $propertyType = 'dateTime';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return dateTime
     */
    public function GetDateTo(){
        $value = isset($this->xmlData->DateTo) ? (string)$this->xmlData->DateTo : false;
        $propertyType = 'dateTime';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return OtapiTurnoverInfo
     */
    public function GetTurnover(){
        $value = isset($this->xmlData->Turnover) ? $this->xmlData->Turnover : false;
        return new OtapiTurnoverInfo($value);
    }
    /**
     * @return long
     */
    public function GetCallCount(){
        $value = isset($this->xmlData->CallCount) ? (string)$this->xmlData->CallCount : false;
        $propertyType = 'long';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return OtapiTariffInfo
     */
    public function GetTariff(){
        $value = isset($this->xmlData->Tariff) ? $this->xmlData->Tariff : false;
        return new OtapiTariffInfo($value);
    }
    /**
     * @return OtapiBasePrice
     */
    public function GetSum(){
        $value = isset($this->xmlData->Sum) ? $this->xmlData->Sum : false;
        return new OtapiBasePrice($value);
    }
}