<?php

class OtapiCategory extends OtapiEntity{
    /**
     * @return boolean
     */
    public function IsHidden(){
        $value = isset($this->xmlData->IsHidden) ? (string)$this->xmlData->IsHidden : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return boolean
     */
    public function IsVirtual(){
        $value = isset($this->xmlData->IsVirtual) ? (string)$this->xmlData->IsVirtual : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetExternalId(){
        $value = isset($this->xmlData->ExternalId) ? (string)$this->xmlData->ExternalId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetName(){
        $value = isset($this->xmlData->Name) ? (string)$this->xmlData->Name : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return boolean
     */
    public function IsParent(){
        $value = isset($this->xmlData->IsParent) ? (string)$this->xmlData->IsParent : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetParentId(){
        $value = isset($this->xmlData->ParentId) ? (string)$this->xmlData->ParentId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return decimal
     */
    public function GetApproxWeight(){
        $value = isset($this->xmlData->ApproxWeight) ? (string)$this->xmlData->ApproxWeight : false;
        $propertyType = 'decimal';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return boolean
     */
    public function IsSearch(){
        $value = isset($this->xmlData->IsSearch) ? (string)$this->xmlData->IsSearch : false;
        $propertyType = 'boolean';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetSearchMethod(){
        $value = isset($this->xmlData->SearchMethod) ? (string)$this->xmlData->SearchMethod : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return DataListOfOtapiCategory
     */
    public function GetRootPath(){
        $value = isset($this->xmlData->RootPath) ? $this->xmlData->RootPath : false;
        return new DataListOfOtapiCategory($value);
    }
}