<?php

class UsersPurchasesRepository extends Repository {
    private $table = 'site_user_purchases';

    public function AddPurchase($orderId, $amount, $ip = '', $cookie = '', $username = ''){
        $ipSafe = $ip ? $this->cms->escape($ip) : 0;
        $cookieSafe = $this->cms->escape($cookie);
        $usernameSafe = $this->cms->escape($username);
        $orderId = $this->cms->escape($orderId);
        $amount = floatval($amount);
        $this->cms->query("
            INSERT INTO {$this->table} SET
            user_ip = '$ipSafe',
            cookie = '$cookieSafe',
            username = '$usernameSafe',
            order_id = '$orderId',
            amount = $amount,
            added = NOW(),
            sent = 0
        ", array($this->table));
    }

    public function GetNewPurchasesCount(){
        return $this->cms->querySingleValue("
            SELECT COUNT(*) FROM {$this->table} WHERE sent = 0
        ", array($this->table));
    }

    public function GetNewPurchases(){
        return $this->cms->queryMakeArray("
            SELECT * FROM {$this->table} WHERE sent = 0
        ", array($this->table));
    }

    public function SetNewPurchasesAsSent(){
        return $this->cms->queryMakeArray("
            UPDATE {$this->table} SET sent = 1
        ", array($this->table));
    }

    public function DeleteOldPurchases(){
        return $this->cms->query("
            DELETE FROM {$this->table} WHERE added < NOW() - INTERVAL 1 WEEK
        ", array($this->table));
    }
}