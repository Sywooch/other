<?php

class ShopReviewsRepository extends Repository
{
    public function GetReviews($from, $perpage)
    {
        $this->cms->checkTable('shop_reviews');
        $result = $this->cms->queryMakeArray("SELECT * FROM `shop_reviews` WHERE `accepted` = '1' ORDER BY `created` DESC LIMIT ".$from." , ".$perpage.""); 
		foreach ($result as &$item) {
			$preparedDate = explode(' ', $item['created']);
			$item['created'] = $preparedDate[0];
			$preparedDate = explode(' ', $item['answer_date']);
			$item['answer_date'] = $preparedDate[0];
		}
		return $result;
    }
	
	public function GetCount()
    {
        $result = $this->cms->querySingleValue("SELECT COUNT(*) FROM `shop_reviews`"); 
		return $result;
    }
	
	public function GetModeratedCount()
    {
        $result = $this->cms->querySingleValue("SELECT COUNT(*) FROM `shop_reviews` WHERE `accepted` = '1'"); 
		return $result;
    }
	
	public function AddReview($data)
    {
		if (strlen($data['txt']) > 0) {
        	$this->cms->query("INSERT INTO `shop_reviews` (`review_id`, `name`, `text`, `answer`, `accepted`, `created`,`rating`) VALUES (NULL, '".$this->cms->escape($data['name'])."', '".$this->cms->escape($data['txt'])."', '', '0', CURRENT_TIMESTAMP, '0')"); 
			return true;			
		} else {
			return false;
		}
		
    }
	
	
	public function SetRatingReview($mark, $id)
    {
        $result = $this->cms->queryMakeArray("SELECT * FROM `shop_reviews` WHERE `review_id` = ".$this->cms->escape($id).""); 
		$mark=='minus' ? $tmp=-1 : $tmp=1;
		$new_rate = $result[0]['rating'] +  $tmp;
		$res = mysql_query("UPDATE  `shop_reviews` SET  `rating` =  '".$new_rate."' WHERE  `review_id` =".$this->cms->escape($id)."");
		$_SESSION['shop_rating'][] = $id;		
    }
	
		
	
}
