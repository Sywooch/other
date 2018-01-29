<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dima
 * Date: 27.10.13
 * Time: 9:54
 * To change this template use File | Settings | File Templates.
 */

class UsersVisitsRepository extends Repository {
    private $table = 'site_user_visits';

    public function AddVisit($ip = '', $cookie = '', $username = ''){
        $ipSafe = $ip ? $this->cms->escape($ip) : 0;
        $cookieSafe = $this->cms->escape($cookie);
        $usernameSafe = $this->cms->escape($username);
        $this->cms->query("
            INSERT INTO {$this->table} SET
            user_ip = '$ipSafe',
            cookie = '$cookieSafe',
            username = '$usernameSafe',
            added = NOW(),
            sent = 0
        ", array($this->table));
    }

    public function GetNewVisitsCount(){
        return $this->cms->querySingleValue("
            SELECT COUNT(*) FROM {$this->table} WHERE sent = 0
        ", array($this->table));
    }

    public function GetNewVisits(){
        return $this->cms->queryMakeArray("
            SELECT * FROM {$this->table} WHERE sent = 0
        ", array($this->table));
    }

    public function SetNewVisitsAsSent(){
        return $this->cms->queryMakeArray("
            UPDATE {$this->table} SET sent = 1
        ", array($this->table));
    }

    public function DeleteOldVisits(){
        return $this->cms->query("
            DELETE FROM {$this->table} WHERE added < NOW() - INTERVAL 1 DAY
        ", array($this->table));
    }
}