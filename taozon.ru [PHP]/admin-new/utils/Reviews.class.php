<?php

class Reviews extends GeneralUtil
{
    protected $_template = 'reviews';
    protected $_template_path = 'reviews/';
    protected $reviewsProvider;

    public function __construct()
    {
        parent::__construct();
        $this->reviewsProvider = new ReviewsProvider($this->cms, $this->otapilib);
    }

    public function defaultAction($request)
    {
        $sid = Session::get('sid');
        $reviews = array('count' => 0, 'rows' => array());
        try {
            $page = $this->getPageDisplayParams($request);
        
            $perpage = $page['limit'];
            $pageNum = $page['number'];
            $from = $page['offset'];
        
            //get reviews
            $reviews = $this->reviewsProvider->getProductsReviews($from, $perpage);
            
        } catch (Exception $e) {
            ErrorHandler::registerError($e);
        }
        
        $this->tpl->assign('reviews', $reviews);
        $this->tpl->assign('paginator', new Paginator($reviews['count'], $pageNum, $perpage));
        print $this->fetchTemplate();
    }        
    
    public function acceptReviewAction($request)
    {
        try {
            $ids = $request->getValue('ids');
            $ids = explode(';', $ids);
            
            foreach ($ids as $key => $id) {
                $this->reviewsProvider->acceptReview(intval($id));
            }
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();        
    }

    public function deleteReviewAction($request)
    {
        try {
            $ids = $request->getValue('ids');
            $ids = explode(';', $ids);
    
            foreach ($ids as $key => $id) {
                $this->reviewsProvider->deleteReview(intval($id));
            }
        } catch (Exception $e) {
            $this->respondAjaxError($e->getMessage());
        }
        $this->sendAjaxResponse();
    }    
    
}
