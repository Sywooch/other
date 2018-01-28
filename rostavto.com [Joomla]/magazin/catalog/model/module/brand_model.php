<?php
/**
 * Class ModelModuleBrandModel
 * @property DB $db
 */
class ModelModuleBrandModel extends Model {
    public function getModels($data = array())
    {
        $sql = "SELECT model FROM " . DB_PREFIX . "product WHERE status = '1'";

        if (isset($data['filter_manufacturer_id'])) {
            $sql .= " AND manufacturer_id = '".(int)$data['filter_manufacturer_id']."'";
        }

        $sql .= " GROUP BY model ORDER BY model ASC";

        $query = $this->db->query($sql);

        return $query->rows;
    }
}