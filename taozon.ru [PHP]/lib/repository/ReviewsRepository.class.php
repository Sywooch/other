<?php

class ReviewsRepository extends Repository
{
    protected $excludeCategories = array(
        'pristroy',
    );

    public function GetItemsIdsWithReviews($itemsCount)
    {
        $itemsIdsQ = $this->cms->queryMakeArray('
            SELECT `item_id` FROM `reviews`
            WHERE `category_id` NOT IN ("' . implode('", "', $this->excludeCategories) . '")
            GROUP BY `item_id` ORDER BY RAND() LIMIT ' . (int)$itemsCount . '
        ', array('reviews'));
        $itemsIds = array();
        foreach ($itemsIdsQ as $itemId) {
            $itemsIds[] = $itemId['item_id'];
        }

        return $itemsIds;
    }
	
	public function GetCatsList(){
		$this->cms->checkTable('reviews');		
		$res = $this->cms->query('SELECT t1.category_id as ID, COUNT(t1.item_id) as ItemCount from (select distinct category_id, item_id from `reviews` group by item_id) as t1 group by t1.category_id');
		$data['tempList'] = array();
		$data['itemCount'] = array();
		while($row = mysql_fetch_assoc($res)){
			$data['tempList'][] = $row['ID'];
			$data['itemCount'][$row['ID']] = $row['ItemCount'];
		}
		return $data;
    }
	
	
	public function GetItemList($where,$from,$perpage){
		$this->cms->checkTable('reviews');		
		$res = $this->cms->query('SELECT item_id as ID from `reviews` '.$where.' group by item_id limit '.$from.','.($perpage));
		$data = array();
		while($row = mysql_fetch_assoc($res))
			$data[] = $row['ID'];	
		return $data;
    }
	
	public function GetTotalCount($where){
		$this->cms->checkTable('reviews');
		$res = $this->cms->query('SELECT distinct count(t1.item_id) as TotalCount from (select distinct item_id from `reviews` '.$where.' group by item_id) as t1');
		$row = mysql_fetch_assoc($res);
		return $row['TotalCount'];
		
		
		
    }
	
	public function GetAllReviews($from,$cout){
		$this->cms->checkTable('reviews');
		$data = $this->cms->queryMakeArray('SELECT * from `reviews` LIMIT '.$from.', '.$cout);
		return $data;
    }
	
	public function DeleteReviews($data){
		$this->cms->checkTable('reviews');
		foreach ($data as $item)
			$this->cms->query("DELETE from `reviews` WHERE `item_id`='".$item."'");			
		
    }
	
	public function GetCatItemCount(){
		$this->cms->checkTable('reviews');
		$res = $this->cms->query('SELECT t1.category_id as ID, COUNT(t1.item_id) as ItemCount from (select distinct category_id, item_id from `reviews` group by item_id) as t1 group by t1.category_id');
		$itemCount = array();
		while($row = mysql_fetch_assoc($res)){            
            $itemCount[$row['ID']] = $row['ItemCount'];
        }
		return $itemCount;
    }
	
	
}
