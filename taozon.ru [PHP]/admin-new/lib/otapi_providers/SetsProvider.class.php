<?php

class SetsProvider extends Repository
{
    /**
     * @var OTAPIlib
     */
    private $otapilib;

    public function __construct($cms, $otapilib)
    {
        parent::__construct($cms);
        $this->otapilib = $otapilib;
    }

    public function GetBrandRatingList($itemRatingTypeId, $numberItem, $categoryId, $language = 'ru', $predefinedData = false)
    {
        return $this->otapilib->GetBrandRatingList($itemRatingTypeId, $numberItem, $categoryId, $language, $predefinedData = false);
    }

    public function RemoveElementsSetRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $itemList, $predefinedData = "")
    {
        return $this->otapilib->RemoveElementsSetRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $itemList, $predefinedData);
    }

    public function RemoveAllElementsRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $predefinedData = "")
    {
        return $this->otapilib->RemoveAllElementsRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $predefinedData);
    }

    public function AddElementsSetToRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $itemList, $predefinedData = "")
    {
        return $this->otapilib->AddElementsSetToRatingList($sessionId, $itemRatingTypeId, $contentType, $categoryId, $itemList, $predefinedData);
    }

    public function GetBrandInfoList($predefinedData = "")
    {
        return $this->otapilib->GetBrandInfoList($predefinedData);
    }

    public function GetVendorRatingList($itemRatingTypeId, $numberItem, $categoryId, $language = 'ru', $predefinedData = false)
    {
        return $this->otapilib->GetVendorRatingList($itemRatingTypeId, $numberItem, $categoryId, $language, $predefinedData);
    }

    public function GetVendorInfo($vendorId, $predefinedData = "")
    {
        return $this->otapilib->GetVendorInfo($vendorId, $predefinedData);
    }

    public function saveSetSellerInfo($vendorId, $displayName, $imageUrl, $language = 'ru')
    {
        $this->cms->checkTable('site_vendors_images');
        $vendorId = mysql_real_escape_string($vendorId);
        $vendorName = $displayName ? mysql_real_escape_string($displayName) : $vendorId;

        $result = mysql_query('
                INSERT INTO `site_vendors_images`
                SET `vendor_id`="' . $vendorId . '"
                ,`vendor_name`="' . $vendorName . '"
                ,`image_path`="' . $imageUrl . '"
                , `lang`="' . $language . '"
                ');
    }
    
    public function updateSetSellerInfo($vendorId, $displayName, $imageUrl, $language = 'ru')
    {
        $this->cms->checkTable('site_vendors_images');
        $vendorId = mysql_real_escape_string($vendorId);
        $vendorName = $displayName ? mysql_real_escape_string($displayName) : $vendorId;
    
        $sql = 'UPDATE `site_vendors_images` SET `vendor_name`="' . $vendorName . '" ,`image_path`="' . $imageUrl . '" WHERE `vendor_id`="' . $vendorId .'" and `lang`="' . $language . '" ';
        $result = mysql_query($sql);
    }
    

    public function getSetSellerInfo($id, $language = 'ru')
    {
        $this->cms->Check();
        $this->cms->checkTable('site_vendors_images');
        $id = mysql_real_escape_string($id);
        $q = mysql_query('SELECT * FROM `site_vendors_images` WHERE `vendor_id`="'.$id.'" and `lang`="' . $language . '"');
        return @mysql_fetch_assoc($q);
    }
    
    public function GetItemRatingList($itemRatingTypeId, $numberItem, $categoryId, $language, $predefinedData = "")
    {
        return $this->otapilib->GetItemRatingList($itemRatingTypeId, $numberItem, $categoryId, $language, $predefinedData);
    }
    
    public function EditTranslateByKey($sessionId, $lang, $text, $key, $idInContext, $predefinedData = "")
    {
        return $this->otapilib->EditTranslateByKey($sessionId, $lang, $text, $key, $idInContext, $predefinedData);
    }
    
    public function GetItemFullInfo($itemId, $language, $predefinedData = "")
    {
        return $this->otapilib->GetItemFullInfo($itemId, $language, $predefinedData);
    }
    
    public function GetItemDescription($itemId, $language, $predefinedData = "")
    {
        return $this->otapilib->GetItemDescription($itemId, $language, $predefinedData);
    }
    
    public function ResetInstanceCaches($predefinedData = "")
    {
        return $this->otapilib->ResetInstanceCaches($predefinedData);
    }
}

