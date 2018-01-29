<?php

class OtapiRentalPaymentSummaryInfo extends BaseOtapiType{
    /**
     * @return OtapiRentalPaymentInfo
     */
    public function GetTotalRent(){
        $value = isset($this->xmlData->TotalRent) ? $this->xmlData->TotalRent : false;
        return new OtapiRentalPaymentInfo($value);
    }
    /**
     * @return OtapiArrayOfRentalPaymentInfo
     */
    public function GetRentPerPeriods(){
        $value = isset($this->xmlData->RentPerPeriods) ? $this->xmlData->RentPerPeriods : false;
        return new OtapiArrayOfRentalPaymentInfo($value);
    }
}