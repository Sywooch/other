<?php

class MyItemInfo extends GenerateBlock
{
    protected $_template = 'myiteminfo';
    protected $_template_path = '/main/';

    public function __construct()
    {
		
        parent::__construct(true);
    }

    protected function setVars()
    {
		
		$id = isset($_GET['id']) ? (int) RequestWrapper::getValueSafe('id') : 0;

		if (!$id)
			header('Location: /');

        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;

		$cms = new CMS();
		$status = $cms->Check();

		$cms->checkTable('my_goods');

		$good = $cms->GetGoodsById($id);

        if (!$good){
            $this->_template = 'iteminfoempty';
            $this->tpl->assign('ItemNotExists', true);
            return;
        }

		$item_info = $good[0];
        $GLOBALS['pagetitle'] = $item_info['name'];

		$category = $cms->GetCategoryById($item_info['my_category_id']);
		$GLOBALS['category'] = $category[0];

        $GLOBALS['taoBaoCategoryId'] = $item_info['my_category_id'];

        $this->tpl->assign('inCart', 0);
        $this->tpl->assign('inNote', 0);

        $this->tpl->assign('ItemNotExists', false);
        $this->tpl->assign('iteminfo', $item_info);


		$file_parts = explode('.', $item_info['image']);
		$ext = end($file_parts);
		$image = str_replace('.' . $ext, '_310x310.' . $ext, $item_info['image']);
		$this->tpl->assign('image', $image);
		$cur_list = $this->_getCurrency();
		$this->tpl->assign('currency', $cur_list['sign']);
    }

	private function _getCurrency()
	{
        global $otapilib;
		if(!file_exists(CFG_APP_ROOT.'/cache/GetCurrency.dat') ||
            filemtime(CFG_APP_ROOT.'/cache/GetCurrency.dat')+600<time()){
            $currency = $otapilib->GetCurrency();
            file_put_contents(CFG_APP_ROOT.'/cache/GetCurrency.dat', serialize($currency));
        }
        else{
            $currency = unserialize(file_get_contents(CFG_APP_ROOT.'/cache/GetCurrency.dat'));
        }
        return $currency;
	}
}
