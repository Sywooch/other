<?php

class OtapiCommonRegistrationOptionsInfo extends BaseOtapiType{
    /**
     * @return boolean
     */
    public function IsSimpleRegistrationAllowed(){
        $value = isset($this->xmlData->IsSimpleRegistrationAllowed) ? (string)$this->xmlData->IsSimpleRegistrationAllowed : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}