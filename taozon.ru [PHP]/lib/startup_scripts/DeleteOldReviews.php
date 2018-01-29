<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Программист
 * Date: 24.09.13
 * Time: 16:08
 * To change this template use File | Settings | File Templates.
 */

class DeleteOldReviews {

    public static function run(){
        if(rand(0,1000) < 10){
            $position = self::getReviewsStartPosition(); //На какой позиции
            $data = self::getReviewsFromDB($position,10);
            self::checkReviewsFromDB($data);
            self::setReviewsStartPosition($position,$data['TotalCount']);  //Сохраняем где остановилсь
        }
    }

    private static function getReviewsStartPosition() {
        $position = @file_get_contents(CFG_APP_ROOT . DIRECTORY_SEPARATOR . 'cache/cron_reviews.txt');
        if (!$position)
            $position=0;
        return $position;
    }

    private static function setReviewsStartPosition($position,$count) {
        if ($position+10>=$count) {
            $position = 0;
        }
        file_put_contents(CFG_APP_ROOT . DIRECTORY_SEPARATOR . 'cache/cron_reviews.txt', $position);
    }

    private static function getReviewsFromDB($position,$count) {
        $reviewsRepository = new ReviewsRepository(new CMS());
        try {
            $data = $reviewsRepository->GetAllReviews($position,$count);
            $data['TotalCount'] = $reviewsRepository->GetTotalCount('');
        } catch (DBException $e) {
            $data = array('TotalCount' => 0);
            Session::setError($e->getMessage(), 'DB_REVIEWS_GetAllReviews|GetTotalCount_ERROR');
        }
        return $data;
    }

    private static function checkReviewsFromDB($data) {
        global $otapilib;
        if ($data['TotalCount']>0) {
            $data_items = array();
            foreach ($data as $item) {
                if (isset($item['item_id']))
                    $data_items[] = $item['item_id'];
            }
            $itemInfo = $otapilib->GetItemInfoList(implode(';',$data_items));
            $delete_items = array();
            foreach ($itemInfo as $item) {
                if ($item['ErrorCode']=='NotFound') {
                    $delete_items[]=$item['Id'];
                }
            }
            try {
                $reviewsRepository = new ReviewsRepository(new CMS());
                $reviewsRepository->DeleteReviews($delete_items);
            } catch (DBException $e) {
                Session::setError($e->getMessage(), 'DB_REVIEWS_DeleteReviews_ERROR');
            }
        }
    }
}