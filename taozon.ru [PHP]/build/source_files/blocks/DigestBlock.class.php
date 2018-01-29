<?php

class DigestBlock extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'digestblocknew';
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
            $allPosts = $cms->GetAllPosts(); 
            $this->tpl->assign('digestBlock', @array_slice($allPosts, 0, 3));

        }
    }
}

?>
