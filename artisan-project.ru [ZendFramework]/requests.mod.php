<?php
class RequestsModel extends CMS_Model
{
	protected $valuesConf = array(
        'payment_method_id' => array(
            'keyField'   => 'id',
            'titleField' => 'title',
            'tableName'  => 'payment_methods',
            'cond'       => array()
        )
    );
	public function unlockAllRequests($interval = 2)
	{
		return $this->db->query(
			'UPDATE ?t
			SET `status` = \'new\', `mdate` = NULL, `operator_id` = NULL
			WHERE `status` = \'work\' AND `mdate` < NOW() - INTERVAL ?d MINUTE',
			$this->tables['requests'], $interval
		);
	}
	
	public function lockRequest($id, $operator_id)
	{
		return $this->db->query(
			'UPDATE ?t
			SET `status` = \'work\', `mdate` = NOW(), `operator_id` = ?d
			WHERE `id` = ?d AND `status` = \'new\'',
			$this->tables['requests'], $operator_id, $id
		);
	}
	
	public function updateRequestsCid($new_cid, $old_cid)
	{
		return $this->db->query('UPDATE ?t SET `cid` = ?d WHERE `cid` = ?d', $this->tables['requests'], $new_cid, $old_cid);
	}

	public function updateRequests_to_orderCid($new_cid, $old_cid)
	{
		return $this->db->query('UPDATE ?t SET `cid` = ?d WHERE `cid` = ?d', $this->tables['requests_to_order'], $new_cid, $old_cid);
	}

	public function getLimitedNoLiquidRequests($requests_id)
	{
		$requests_count = $this->db->groupKarr(
			'SELECT rg.request_id, rg.good_id, rg.good_count FROM ?t AS rg
			JOIN ?t as g ON g.id = rg.good_id AND g.non_liquid = 1
			WHERE rg.request_id IN (?l)',
			$this->tables['requests_goods'], $this->tables['goods'], $requests_id
		);
		
		$requests_remains = $this->db->groupKarr(
			'SELECT rgr.request_id, rgr.good_id, rgr.stock FROM ?t AS rgr
			JOIN ?t as g ON g.id = rgr.good_id AND g.non_liquid = 1
			WHERE rgr.status = ? AND rgr.request_id IN (?l)',
			$this->tables['requests_goods_remains'], $this->tables['goods'], 'main', $requests_id
		);
		$requests = array();
		if (!empty($requests_count)) {

			foreach ($requests_count as $request_id => $goods) {
				if (empty($requests_remains[$request_id])) {
					$requests[] = $request_id;
					continue;
				} else {
					foreach ($goods as $good_id => $count) {
						if (empty($requests_remains[$request_id][$good_id])) {
							$requests[] = $request_id;
							break;
						} elseif ($count > $requests_remains[$request_id][$good_id]) {
							$requests[] = $request_id;
							break;
						}
					}
				}
			}
		}
		return $requests;
	}
    
    public function getRemainsActual($requests_id){
        $requests_count = $this->db->groupKarr(
            'SELECT rg.request_id, rg.good_id, rg.good_reserved FROM ?t AS rg
            JOIN ?t as g ON g.id = rg.good_id
            WHERE rg.request_id IN (?l)',
            $this->tables['requests_goods'], $this->tables['goods'], $requests_id
        );
        //debug::dump($requests_count);
        $g_ids = array();
        foreach($requests_count as $req_id => $request){
            foreach($request as $good_id => $good){
                $g_ids[] = $good_id;
            } 
        }
        $requests_remains = $this->db->Karr(
            'SELECT r.good_id, r.stock FROM ?t AS r
            WHERE r.good_id IN (?l) AND r.store_id = 1',
            'ad_remains', $g_ids
        );
        //debug::dump($requests_remains);
        $remains = array();
        if (!empty($requests_count)) {
            foreach ($requests_count as $request_id => $goods) {
                foreach ($goods as $good_id => $reserv) {
                    $remains[$good_id] = $requests_remains[$good_id] + $reserv;
                }
            }
        }
        return $remains;
    }
}