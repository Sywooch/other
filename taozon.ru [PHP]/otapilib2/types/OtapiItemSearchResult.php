<?php

class OtapiItemSearchResult extends BaseOtapiType{
    /**
     * @return DataListOfOtapiSearchCategoryInfo
     */
    public function GetCategories(){
        $value = isset($this->xmlData->Categories) ? $this->xmlData->Categories : false;
        return new DataListOfOtapiSearchCategoryInfo($value);
    }
    /**
     * @return DataSubListOfOtapiItemInfo
     */
    public function GetItems(){
        $value = isset($this->xmlData->Items) ? $this->xmlData->Items : false;
        return new DataSubListOfOtapiItemInfo($value);
    }
    /**
     * @return string
     */
    public function GetTranslatedItemTitle(){
        $value = isset($this->xmlData->TranslatedItemTitle) ? (string)$this->xmlData->TranslatedItemTitle : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetProvider(){
        $value = isset($this->xmlData->Provider) ? (string)$this->xmlData->Provider : false;
        $propertyType = 'string';
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
}