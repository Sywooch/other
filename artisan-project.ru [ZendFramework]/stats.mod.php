<?php
class StatsModel extends CMS_Model
{
	public function getDealersStat($params)
	{
		$dealers = $this->db->fullKarr('SELECT id, title, login FROM ?t AS d', $this->model('dealers', 'dealers')->tables['dealers'], 1);
		$dls = $this->db->karr(
			'SELECT
				d.id AS dealer_id,
				COUNT(dls.date) AS dls
			FROM ?t AS d
			LEFT JOIN ?t AS dls ON d.id = dls.dealer_id
			WHERE dls.date BETWEEN ? AND ?
			GROUP BY d.id',
			$this->model('dealers', 'dealers')->tables['dealers'],
			$this->model('dealers')->tables['dealers_login_stats'],
			date('Ymd000000', strtotime($params['sdate'])),
			date('Ymd235959', strtotime($params['edate']))
		);
		$requests = $this->db->karr(
			'SELECT
				d.id AS dealer_id,
				COUNT(r.id) AS requests
			FROM ?t AS d
			LEFT JOIN ?t AS r ON d.id = r.dealer_id
			WHERE r.cdate BETWEEN ? AND ?
			GROUP BY d.id',
			$this->model('dealers', 'dealers')->tables['dealers'],
			$this->model('requests', 'requests')->tables['requests'],
			date('Y-m-d 00:00:00', strtotime($params['sdate'])),
			date('Y-m-d 23:59:59', strtotime($params['edate']))
		);
		foreach ($dealers as $dealer_id => &$dealer) {
			if (isset($dls[$dealer_id])) {
				$dealer['dls'] = $dls[$dealer_id];
			}
			if (isset($requests[$dealer_id])) {
				$dealer['requests'] = $requests[$dealer_id];
			}
		}
		unset($dealer);
		return $dealers;
	}
	
	public function getBestGoods($params)
	{
		return $this->db->query(
			'SELECT rg.good_id, rg.good_title,
				COUNT(rg.good_id) AS requests_count, SUM(rg.good_count) AS goods_count,
				SUM(rg.good_count * rg.good_price) AS goods_total
			FROM ?t AS rg
			JOIN ?t AS r ON rg.request_id = r.id
			WHERE r.cdate BETWEEN ? AND ?
			GROUP BY rg.good_id
			ORDER BY requests_count DESC, goods_total DESC',
			$this->model('requests', 'requests')->tables['requests_goods'],
			$this->model('requests', 'requests')->tables['requests'],
			date('Y-m-d 00:00:00', strtotime($params['sdate'])),
			date('Y-m-d 23:59:59', strtotime($params['edate']))
		);
	}
}