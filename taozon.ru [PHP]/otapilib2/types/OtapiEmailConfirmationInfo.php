<?php

class OtapiEmailConfirmationInfo extends BaseOtapiType{
    /**
     * @return boolean
     */
    public function IsEmailVerificationUsed(){
        $value = isset($this->xmlData->IsEmailVerificationUsed) ? (string)$this->xmlData->IsEmailVerificationUsed : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetEmailConfirmationCode(){
        $value = isset($this->xmlData->EmailConfirmationCode) ? (string)$this->xmlData->EmailConfirmationCode : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}