<?php

class OtapiWebUISettings extends BaseOtapiType{
    /**
     * @return OtapiArrayOfNamedProperty
     */
    public function GetTranslateTypes(){
        $value = isset($this->xmlData->TranslateTypes) ? $this->xmlData->TranslateTypes : false;
        return new OtapiArrayOfNamedProperty($value);
    }
    /**
     * @return string
     */
    public function GetSelectedTranslateType(){
        $value = isset($this->xmlData->SelectedTranslateType) ? (string)$this->xmlData->SelectedTranslateType : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return string
     */
    public function GetLanguage(){
        $value = isset($this->xmlData->Language) ? (string)$this->xmlData->Language : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return OtapiArrayOfString3
     */
    public function GetUsedLanguages(){
        $value = isset($this->xmlData->UsedLanguages) ? $this->xmlData->UsedLanguages : false;
        return new OtapiArrayOfString3($value);
    }
    /**
     * @return OtapiArrayOfString3
     */
    public function GetUsedSystemLanguages(){
        $value = isset($this->xmlData->UsedSystemLanguages) ? $this->xmlData->UsedSystemLanguages : false;
        return new OtapiArrayOfString3($value);
    }
    /**
     * @return OtapiArrayOfNamedProperty
     */
    public function GetLanguages(){
        $value = isset($this->xmlData->Languages) ? $this->xmlData->Languages : false;
        return new OtapiArrayOfNamedProperty($value);
    }
    /**
     * @return string
     */
    public function GetSelectedCategoryStructureType(){
        $value = isset($this->xmlData->SelectedCategoryStructureType) ? (string)$this->xmlData->SelectedCategoryStructureType : false;
        $propertyType = 'string';
        return $propertyType == 'boolean' ? $value == 'true' : $value;
    }
    /**
     * @return OtapiArrayOfNamedProperty
     */
    public function GetCategoryStructureTypes(){
        $value = isset($this->xmlData->CategoryStructureTypes) ? $this->xmlData->CategoryStructureTypes : false;
        return new OtapiArrayOfNamedProperty($value);
    }
}