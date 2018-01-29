<?php
namespace Referral\Repository;

class UserRepository
{
    /**
     * @var \CMS
     */
    protected $cms;
    /**
     * @param \CMS $cms
     */
    public function __construct($cms){
        $this->cms = $cms;
    }

    /**
     * @throws \DBException
     */
    public function AddUser($username, $userIdInBL, $parentUserId = 0){
        $usernameSafe = $this->cms->escape($username);
        $userIdInBLSafe = $this->cms->escape($userIdInBL);
        $parentUserIdSafe = $this->cms->escape($parentUserId);

        $this->cms->query("
            INSERT INTO `site_referrals`
            SET `user_id` = $userIdInBLSafe,
              `parent_id` = $parentUserIdSafe,
              `login` = '$usernameSafe'
        ", array('site_referrals'));

        return $this->cms->insertedId();
    }

    /**
     * @throws \DBException
     */
    public function DeleteUserByBLId($userId){
        $userIdSafe = $this->cms->escape($userId);
        $this->cms->query("
            DELETE FROM `site_referrals`
            WHERE `user_id` = $userIdSafe
        ", array('site_referrals'));
    }

    /**
     * @throws \DBException
     */
    public function GetUsersTree($parentId = 0){
        $parentIdSafe = $this->cms->escape($parentId);
        $users = $this->cms->queryMakeArray("
            SELECT * FROM `site_referrals`
            WHERE `parent_id` = $parentIdSafe
        ", array('site_referrals'));

        $usersGroupedById = array();
        foreach($users as $user){
            $usersGroupedById[$user['id']] = $user;
            $usersGroupedById[$user['id']]['children'] = $this->GetUsersTree($user['id']);
        }
        return $usersGroupedById;
    }

    /**
     * @throws \DBException
     */
    public function GetById($id){
        $idSafe = $this->cms->escape($id);
        $user = $this->cms->queryMakeArray("
            SELECT * FROM `site_referrals`
            WHERE `id` = $idSafe
        ", array('site_referrals'));
        if(!count($user))
            throw new \NotFoundException('There is no user with id '.$idSafe);
        return $user[0];
    }

    /**
     * @throws \DBException
     */
    public function GetByLogin($login){
        $loginSafe = $this->cms->escape($login);
        $user = $this->cms->queryMakeArray("
            SELECT * FROM `site_referrals`
            WHERE `login` = '$loginSafe'
        ", array('site_referrals'));
        if(!count($user))
            throw new \NotFoundException('There is no user with id '.$idSafe);
        return $user[0];
    }

    /**
     * @throws \DBException
     */
    public function GetByBLId($userId){
        $userIdSafe = $this->cms->escape($userId);
        $user = $this->cms->queryMakeArray("
            SELECT * FROM `site_referrals`
            WHERE `user_id` = $userIdSafe
        ", array('site_referrals'));
        if(!count($user))
            throw new \NotFoundException('There is no user with BL id '.$userId);
        return $user[0];
    }

    /**
     * Получение количества приведенных пользователей по статусам
     * @throws \DBException
     */
    public function GetChildrenGroupedByStatus($parentId){
        $childrenGroupedByStatus = $this->cms->queryMakeArray("
            SELECT `status`, COUNT(`status`) AS `users_per_status` FROM `site_referrals`
            WHERE parent_id = $parentId GROUP BY `status`
        ", array('site_referrals'));

        $childrenPerStatus = array(0,0,0,0,0,0);
        foreach($childrenGroupedByStatus as $children){
            $childrenPerStatus[$children['status']] = $children['users_per_status'];
        }

        return $childrenPerStatus;
    }

    /**
     * Получение списка id родителей
     * @throws \DBException
     */
    public function GetParentsIds($referralId){
        $user = $this->GetById($referralId);

        $parents = array($user['parent_id']);
        if(!$user['parent_id']) return $parents;

        do{
            $grandParent = $this->GetById($parents[count($parents)-1]);
            $parents[] = $grandParent['parent_id'];
        }
        while($grandParent['parent_id'] != 0);

        return $parents;
    }

    /**
     * @throws \DBException
     */
    public function SetStatus($id, $status){
        $idSafe = $this->cms->escape($id);
        $statusSafe = $this->cms->escape($status);
        $this->cms->query("
            UPDATE `site_referrals`
            SET `status` = '$statusSafe'
            WHERE `id` = $idSafe
        ");
    }

    /**
     * @throws \DBException
     */
    public function SetBalance($id, $balance){
        $idSafe = $this->cms->escape($id);
        $balanceSafe = $this->cms->escape($balance);
        $this->cms->query("
            UPDATE `site_referrals`
            SET `balance` = '$balanceSafe'
            WHERE `id` = $idSafe
        ");
    }

    /**
     * @throws \DBException
     */
    public function SetAwaitingAmount($id, $amount){
        $idSafe = $this->cms->escape($id);
        $amountSafe = $this->cms->escape($amount);
        $this->cms->query("
            UPDATE `site_referrals`
            SET `awaiting_money` = '$amountSafe'
            WHERE `id` = $idSafe
        ");
    }
}
