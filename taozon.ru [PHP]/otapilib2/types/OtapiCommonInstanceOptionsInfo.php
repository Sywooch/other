<?php

class OtapiCommonInstanceOptionsInfo extends BaseOtapiType{
    /**
     * @return OtapiCommonRegistrationOptionsInfo
     */
    public function GetRegistration(){
        $value = isset($this->xmlData->Registration) ? $this->xmlData->Registration : false;
        return new OtapiCommonRegistrationOptionsInfo($value);
    }
    /**
     * @return OtapiCommonOrderOptionsInfo
     */
    public function GetOrder(){
        $value = isset($this->xmlData->Order) ? $this->xmlData->Order : false;
        return new OtapiCommonOrderOptionsInfo($value);
    }
}