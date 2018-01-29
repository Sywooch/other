<?php

class OtapiItemInfo extends OtapiBaseItemInfo{
    /**
     * @return OtapiBasePrice
     */
    public function GetPromotionPrice(){
        $value = isset($this->xmlData->PromotionPrice) ? $this->xmlData->PromotionPrice : false;
        return new OtapiBasePrice($value);
    }
}