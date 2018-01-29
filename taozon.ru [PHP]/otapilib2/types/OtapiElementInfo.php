<?php

class OtapiElementInfo extends OtapiAbstractCustomizablePrice{
    /**
     * @return int
     */
    public function GetId(){
        $value = isset($this->xmlData->Id) ? (string)$this->xmlData->Id : false;
        $propertyType = 'int';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetItemId(){
        $value = isset($this->xmlData->ItemId) ? (string)$this->xmlData->ItemId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetConfigurationId(){
        $value = isset($this->xmlData->ConfigurationId) ? (string)$this->xmlData->ConfigurationId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return decimal
     */
    public function GetPrice(){
        $value = isset($this->xmlData->Price) ? (string)$this->xmlData->Price : false;
        $propertyType = 'decimal';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return int
     */
    public function GetQuantity(){
        $value = isset($this->xmlData->Quantity) ? (string)$this->xmlData->Quantity : false;
        $propertyType = 'int';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return decimal
     */
    public function GetTotalCost(){
        $value = isset($this->xmlData->TotalCost) ? (string)$this->xmlData->TotalCost : false;
        $propertyType = 'decimal';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return OtapiPrice
     */
    public function GetFullTotalCost(){
        $value = isset($this->xmlData->FullTotalCost) ? $this->xmlData->FullTotalCost : false;
        return new OtapiPrice($value);
    }
    /**
     * @return OtapiPrice
     */
    public function GetFullPrice(){
        $value = isset($this->xmlData->FullPrice) ? $this->xmlData->FullPrice : false;
        return new OtapiPrice($value);
    }
    /**
     * @return OtapiPrice
     */
    public function GetFullTotalCostWithoutDiscount(){
        $value = isset($this->xmlData->FullTotalCostWithoutDiscount) ? $this->xmlData->FullTotalCostWithoutDiscount : false;
        return new OtapiPrice($value);
    }
    /**
     * @return OtapiPrice
     */
    public function GetFullPriceWithoutDiscount(){
        $value = isset($this->xmlData->FullPriceWithoutDiscount) ? $this->xmlData->FullPriceWithoutDiscount : false;
        return new OtapiPrice($value);
    }
    /**
     * @return ArrayOfOtapiFieldInfo
     */
    public function GetFields(){
        $value = isset($this->xmlData->Fields) ? $this->xmlData->Fields : false;
        return new ArrayOfOtapiFieldInfo($value);
    }
    /**
     * @return string
     */
    public function GetCurrencySign(){
        $value = isset($this->xmlData->CurrencySign) ? (string)$this->xmlData->CurrencySign : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetCurrencyCode(){
        $value = isset($this->xmlData->CurrencyCode) ? (string)$this->xmlData->CurrencyCode : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetCategoryId(){
        $value = isset($this->xmlData->CategoryId) ? (string)$this->xmlData->CategoryId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetVendorId(){
        $value = isset($this->xmlData->VendorId) ? (string)$this->xmlData->VendorId : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetCategoryName(){
        $value = isset($this->xmlData->CategoryName) ? (string)$this->xmlData->CategoryName : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetProviderType(){
        $value = isset($this->xmlData->ProviderType) ? (string)$this->xmlData->ProviderType : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
}