<?php
class ArcaModel
{
    const PAYMENT_BY_VIRTUAL_CARD = 'arca.virttual';
    const PAYMENT_BY_REAL_CARD = 'arca.emv';

    /**
     * @var CMS
     */
    protected $cms;
    /**
     * @var KLogger
     */
    private $log;

    public function __construct(){
        $this->cms = new CMS();
        if(!CMS::CheckStatic()){
            throw new DBException('Connection error: ' . mysql_error(), DBException::CONNECTION_ERROR);
        }

        $this->log = new KLogger(CFG_APP_ROOT . '/site_logs', KLogger::DEBUG);
    }

    public function savePaymentForm($formParameters){
        $this->log->logDebug('Save payment form', $formParameters);

        $exists = $this->cms->checkTable('site_arca_payments');
        if(!$exists) throw new DBException('Can\'t create table', DBException::CANNOT_CREATE_TABLE);

        $formParametersSql = array_map(array($this, 'createAssignment'), $formParameters);
        $sql = "INSERT INTO `site_arca_payments` SET " . implode(', ', $formParametersSql);
        $insertResult = mysql_query($sql);

        if(!$insertResult)
            throw new DBException('Can\'t save payment parameters: '.mysql_error());

        return mysql_insert_id();
    }

    public function getPayment($paymentId){
        $this->log->logDebug('Get payment', $paymentId);
        $paymentId = intval($paymentId);

        $sql = "SELECT * FROM `site_arca_payments` WHERE `id` = $paymentId";
        $getResult = mysql_query($sql);

        if(!$getResult)
            throw new DBException('Can\'t get payment', DBException::QUERY_ERROR);

        return mysql_fetch_assoc($getResult);
    }

    public function getPaymentByOrderId($orderId){
        $this->log->logDebug('Get payment by ' . $orderId);
        $orderId = mysql_real_escape_string($orderId);

        $sql = "SELECT * FROM `site_arca_payments` WHERE `orderID` = $orderId";
        $getResult = mysql_query($sql);

        if(!$getResult)
            throw new DBException('Can\'t get payment', DBException::QUERY_ERROR);

        return mysql_fetch_assoc($getResult);
    }

    public function getPaidPayments($limit = 1, $orderBy = 'id', $orderDir = 'ASC'){
        $this->log->logDebug('Select paid payments', array($limit, $orderBy, $orderDir));

        $limit = intval($limit);
        $orderBy = mysql_real_escape_string($orderBy);
        $orderDir = mysql_real_escape_string($orderDir);
        $paymentType = self::PAYMENT_BY_VIRTUAL_CARD;

        $sql = "SELECT * FROM `site_arca_payments` WHERE `user_paid` = 1 AND `confirmed` IS NULL
                AND `payment_type` = '$paymentType'
                ORDER BY $orderBy $orderDir LIMIT $limit";
        $getResult = mysql_query($sql);
        if(!$getResult)
            throw new DBException('Can\'t get payments', DBException::QUERY_ERROR);

        $payments = array();
        while($row = mysql_fetch_assoc($getResult)){
            $payments[] = $row;
        }

        return $payments;
    }

    public function getConfirmedPayments($limit = 1, $orderBy = 'id', $orderDir = 'ASC'){
        $this->log->logDebug('Select confirmed payments', array($limit, $orderBy, $orderDir));

        $limit = intval($limit);
        $orderBy = mysql_real_escape_string($orderBy);
        $orderDir = mysql_real_escape_string($orderDir);
        $paymentRealCardType = self::PAYMENT_BY_REAL_CARD;

        $sql = "SELECT * FROM `site_arca_payments`
                WHERE
                  (`confirmed` = 1 AND `notified` IS NULL)
                  OR
                  (`user_paid` = 1 AND `notified` IS NULL AND `payment_type` = '$paymentRealCardType')
                ORDER BY $orderBy $orderDir LIMIT $limit";
        $getResult = mysql_query($sql);
        if(!$getResult)
            throw new DBException('Can\'t get payments', DBException::QUERY_ERROR);

        $payments = array();
        while($row = mysql_fetch_assoc($getResult)){
            $payments[] = $row;
        }

        return $payments;
    }

    public function deletePayment($paymentId){
        $this->log->logDebug('Delete payment', $paymentId);
        $paymentId = intval($paymentId);

        $sql = "DELETE FROM `site_arca_payments` WHERE `id` = $paymentId";
        $deleteResult = mysql_query($sql);

        if(!$deleteResult)
            throw new DBException('Can\'t delete payment', DBException::QUERY_ERROR);

        return true;
    }

    public function markPaymentPaid($paymentId, $rrn){
        $this->log->logDebug('Mark payment paid', $paymentId);

        $paymentId = intval($paymentId);
        $rrn = mysql_real_escape_string($rrn);
        $sql = "UPDATE `site_arca_payments` SET `user_paid` = 1, `rrn` = '$rrn' WHERE `id` = $paymentId";

        $updateResult = mysql_query($sql);
        if(!$updateResult)
            throw new DBException($sql.'; '.mysql_error(), DBException::QUERY_ERROR);

        return true;
    }

    public function markPaymentConfirmed($paymentId){
        $this->log->logDebug('Mark payment confirmed', $paymentId);

        $paymentId = intval($paymentId);
        $sql = "UPDATE `site_arca_payments` SET `confirmed` = 1 WHERE `id` = $paymentId";

        $updateResult = mysql_query($sql);
        if(!$updateResult)
            throw new DBException($sql.'; '.mysql_error(), DBException::QUERY_ERROR);

        return true;
    }

    public function markPaymentNotified($paymentId){
        $this->log->logDebug('Mark payment notified', $paymentId);

        $paymentId = intval($paymentId);
        $sql = "UPDATE `site_arca_payments` SET `notified` = 1 WHERE `id` = $paymentId";

        $updateResult = mysql_query($sql);
        if(!$updateResult)
            throw new DBException($sql.'; '.mysql_error(), DBException::QUERY_ERROR);

        return true;
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    private function createAssignment($p){
        $name = mysql_real_escape_string($p['Name']);
        $value = mysql_real_escape_string($p['Value']);
        return "`$name` = '$value'";
    }
}
