<?php

class VendorRepository extends Repository
{
	/**
	 * Извлечение данных о продавце из локальной базы
	 * @param string $vendorId        Id продавца 
	 */
    public function GetVendorInfo($vendorId, $language = 'ru')
    {
        $vendorIdSafe = $this->cms->escape($vendorId);
        $vendorInfo = $this->cms->queryMakeArray('
                SELECT * FROM `site_vendors_images`
                WHERE `vendor_id`="' . $vendorIdSafe . '" and `lang`="' . $language . '"
            ', array('site_vendors_images'));
			
        return $vendorInfo;
    }
	
	/**
	 * Добавление данных в локальную базу о продавце
	 * @param string $vendorId
	 * @param string $imageUrl        url изображения продавца локально
	 * @param string $VendorName      Введенное название продавца
	 */
    public function addVendorImage($vendorId, $imageUrl, $VendorName)
    {
        $imageUrl = $this->cms->escape($imageUrl);
        $vendorId = $this->cms->escape($vendorId);
		$VendorName = $this->cms->escape($VendorName);
        return (bool) $this->cms->queryMakeArray('
                INSERT INTO `site_vendors_images`
                SET `vendor_id` = "' . $vendorId . '"
                   ,`vendor_name` = "' . $VendorName . '"
                   ,`image_path` = "' . $imageUrl . '"
            ', array('site_vendors_images'));
    }
	
	/**
	 * Редактирование данных о продавце в локальной базе
	 * @param string $vendorId
	 * @param string $imageUrl       
	 * @param string $VendorName
	 */
	public function editVendorImage($vendorId, $VendorName, $imageUrl)
	{
	$vendorId = $this->cms->escape($vendorId);
	$imageUrl = $this->cms->escape($imageUrl);
	$VendorName = $this->cms->escape($VendorName);
	return $res = mysql_query('
                UPDATE `site_vendors_images`
                SET `vendor_name` = "' . $VendorName . '"
                   ,`image_path` = "' . $imageUrl . '"
                WHERE `vendor_id` = "' . $vendorId . '"');
	}
	
	 /**
	 * Удаление данных о продавце из локальной базы
	 * @param string $vendorId
	 */
	public function deleteVendorImage($vendorId)
	{
	$vendorId = $this->cms->escape($vendorId);
	$imageUrl = $this->cms->escape($imageUrl);
	return $res = mysql_query('DELETE FROM `site_vendors_images`
							   WHERE `vendor_id` = "' . $vendorId . '"');
	}
	
	/**
	 * Получение массива всех id продавцов из локальной базы
	 */
	public function getVendorId ()
	{
	$vendorIds = array();
	$result = mysql_query('SELECT `vendor_id` 
						   FROM `site_vendors_images`');
	if (!$result) 
		die (mysql_error());
	while ($data = mysql_fetch_array($result)) {
	$vendorIds[] = $data['vendor_id'];
	}
	return $vendorIds;
	}
}
