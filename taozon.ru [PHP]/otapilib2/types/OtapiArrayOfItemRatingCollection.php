<?php

class OtapiArrayOfItemRatingCollection extends BaseOtapiType{
    /**
     * @return OtapiItemRatingCollection[]
     */
    public function GetItemRatingCollection(){
        return isset($this->xmlData->ItemRatingCollection) ? new UnboundedElementsIterator(
                $this->xmlData->ItemRatingCollection,
                array(
                    'type' => 'complexType',
                    'name' => 'OtapiItemRatingCollection'
                )
            ) : array();
    }
}