<?php

class NewsBlock extends GenerateBlock
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'newsblock';
    protected $_template_path = '/main/';

    public function __construct()
    {
        parent::__construct(true);
    }

    protected function setVars() {
        if (!CMS::IsFeatureEnabled('News'))
            return;
        $cms = new CMS();
        $status = $cms->Check();
        if ($status) {
            $allNews = $cms->GetAllNews();
            $count = (isset(General::$siteConf['news_count_print'])) ? General::$siteConf['news_count_print'] : 5;
            $this->tpl->assign('newsBlock', @array_slice($allNews, 0, $count));
        }
    }
}

?>
