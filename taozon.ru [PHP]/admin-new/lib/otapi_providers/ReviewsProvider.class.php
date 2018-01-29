<?php

class ReviewsProvider extends Repository
{
    /**
     * @var OTAPIlib
     */
    private $otapilib;
    private $itemInfoRepository;

    public function __construct($cms, $otapilib)
    {
        parent::__construct($cms);
        $this->otapilib = $otapilib;
        $this->itemInfoRepository = new ItemInfoRepository($cms);
    }
    
    public function getProductsReviews($from, $perpage )
    {
        if (! $this->cms->IsFeatureEnabled('ProductComments')) {
            return array('count' => 0, 'rows' => array());
        }
        
        $query = 'SELECT count(*) FROM `reviews` WHERE `accepted` = 0';
        $count = $this->cms->querySingleValue($query);
         
        $this->cms->checkTable('reviews');
        $query = 'SELECT * FROM `reviews` WHERE `accepted`=0 order by created desc limit ' . $this->cms->escape($from) . ',' . $this->cms->escape($perpage);
        $comments = $this->cms->queryMakeArray($query);
        
        return array('count' => $count, 'rows' => $comments);
    }
    
    public function acceptReview($id)
    {
        $this->itemInfoRepository->acceptComment($id);
    }
    
    public function deleteReview($id)
    {
        $this->itemInfoRepository->deleteComment($id);
    }
    
}
