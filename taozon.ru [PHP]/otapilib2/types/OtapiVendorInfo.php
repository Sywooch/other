<?php

class OtapiVendorInfo extends OtapiEntity{
    /**
     * @return string
     */
    public function GetName(){
        $value = isset($this->xmlData->Name) ? (string)$this->xmlData->Name : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetSex(){
        $value = isset($this->xmlData->Sex) ? (string)$this->xmlData->Sex : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetEmail(){
        $value = isset($this->xmlData->Email) ? (string)$this->xmlData->Email : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetPictureUrl(){
        $value = isset($this->xmlData->PictureUrl) ? (string)$this->xmlData->PictureUrl : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return OtapiLocation
     */
    public function GetLocation(){
        $value = isset($this->xmlData->Location) ? $this->xmlData->Location : false;
        return new OtapiLocation($value);
    }
    /**
     * @return OtapiVendorRating
     */
    public function GetCredit(){
        $value = isset($this->xmlData->Credit) ? $this->xmlData->Credit : false;
        return new OtapiVendorRating($value);
    }
    /**
     * @return OtapiArrayOfString
     */
    public function GetFeatures(){
        $value = isset($this->xmlData->Features) ? $this->xmlData->Features : false;
        return new OtapiArrayOfString($value);
    }
}