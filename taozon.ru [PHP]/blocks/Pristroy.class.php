<?php

class Pristroy extends GenerateBlock
{
    protected $defaultAction = 'list';

    public function __construct()
    {
        if (! CMS::IsFeatureEnabled('FleaMarket')) {
            header('Location: /');
            die();
        }

        parent::__construct();

        $this->pristroy = new PristroyRepository($this->cms);
        $this->item = new ItemInfoRepository($this->cms);
    }

    protected function itemAction()
    {
        $id = (int)RequestWrapper::get('id');
        $item = $this->pristroy->getProduct($id);

        if (! empty($item) && $this->pristroy->isProductApproved($item)) {

            if (RequestWrapper::post('review')) {
                $name = Session::getUserData('username');
                $review = RequestWrapper::post('review');
                $this->item->saveComment($review['text'], $review['item_cid'], $name, $id);
                header('Location: ' . RequestWrapper::env('REQUEST_URI') . '&tab=paymship');
            }

            $iteminfo = $item['fullinfo']['Item'];
            $iteminfo['pristroy'] = $item;

            $sellerItems = $this->pristroy->getListByUserId($item['user_id'], $item['id']);

            $this->tpl->assign('iteminfo', $iteminfo);
            $this->tpl->assign('sellerItems', $sellerItems);
        } else {
            $items = $this->pristroy->getList(0, 16);
            $this->tpl->assign('items', !empty($items['data']) ? $items['data'] : array());
            $this->tpl->assign('notfound_title', Lang::get('Pristroy_item_not_found'));
            $this->_template = 'notfound';
        }
    }

    protected function sellerAction()
    {
        $id = (int)RequestWrapper::get('id');
        $items = $this->pristroy->getListByUserId($id);
        $this->tpl->assign('items', $items);
        if (! empty($items)) {
            $this->tpl->assign('seller', $items[0]['user_login']);
        } else {
            $items = $this->pristroy->getList(0, 16);
            $this->tpl->assign('items', !empty($items['data']) ? $items['data'] : array());
            $this->tpl->assign('notfound_title', Lang::get('Pristroy_seller_not_found'));
            $this->_template = 'notfound';
        }
    }

    protected function listAction($request)
    {
        $perpage = $request->getValue('perpage', 16);
        $page = $request->getValue('page', 0);
        $from = ($page > 1) ? ($page - 1) * $perpage : 0;

        $list = $this->pristroy->getList($from, $perpage);
        $count = $list['rows'];
        $this->tpl->assign('list', $list['data']);
        $this->tpl->assign('paginator', new Paginator($count, $page, $perpage));
    }

}
