<?php

class ShopreviewsBlock extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'shopreviewsblocknew';
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars()
    {
		
		$cms = new CMS();
        $status = $cms->Check();
        if ($status) {
			$allPosts = array();
			$to=5;
			if (General::getSiteConfig('shopreviews_main')) $to=General::getSiteConfig('shopreviews_main');
			$res = mysql_query("SELECT * FROM `shop_reviews` WHERE `accepted` NOT LIKE 0 ORDER BY `created` DESC LIMIT 0 , ".$to."");
            if($res)
			while ($row = mysql_fetch_assoc($res))  {            
				$allPosts[] = $row;            
        	}
			$this->tpl->assign('allPosts', $allPosts);
		
		}        
    }
}

?>
