<?php
require_once __DIR__ . '/../../referral/repository/OrderRepository.class.php';
require_once __DIR__ . '/../../referral/repository/PresentsRepository.class.php';
require_once __DIR__ . '/../../referral/repository/UserRepository.class.php';

use Referral\Repository\OrderRepository;
use Referral\Repository\UserRepository;
use Referral\Repository\PresentsRepository;

class Referrals extends GeneralUtil
{
    protected $_cache = false;
    protected $_life_time = 3600;
    protected $_template = 'index';
    protected $_template_path = 'referrals/';

    private $userRepository;
    private $giftsRepository;

    public function __construct(){
        parent::__construct();
        $this->userRepository = new UserRepository($this->cms);
        $this->giftsRepository = new PresentsRepository($this->cms);
    }

    /**
     * @return bool|void
     */
    public function defaultAction(){
        $request = new \RequestWrapper();
        if(!$this->checkAuth()) return false;
        if(!$this->cmsStatus) return false;
        $parent = $request->getValue('parent');

        $users = $this->getReferralsByParent($parent ?: 0);

        $this->tpl->assign('referrals', $users);

        if($parent)
            $user = $this->userRepository->GetById($parent);

        $this->tpl->assign('currentUserStatus',
            ($parent && isset($user['status'])) ? $user['status'] : 0);

        $this->tpl->assign('chain',  $this->getReferralsChain($parent ?: 0));

        print $this->fetchTemplate();
    }

    /**
     * @param \RequestWrapper $request
     */
    public function sendGiftAction($request){
        $this->giftsRepository->SendGiftFromUser($request->getValue('from'));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    private function getReferralsChain($parent){
        if($parent == 0)
            return array();

        $chain = array_reverse(array_merge(array($parent),$this->userRepository->GetParentsIds($parent)));
        unset($chain[0]);
        foreach($chain as &$id){
            if(!$id) continue;
            $id = $this->userRepository->GetById($id);
        }

        return $chain;
    }

    private function getReferralsByParent($parent){
        $users = $this->userRepository->GetUsersTree($parent);
        $users = $this->setGiftsCount($users);
        return $users;
    }

    private function setGiftsCount($users){
        foreach($users as &$user){
            $user['gifts_from_children'] = count($this->giftsRepository->GetGiftsForUser($user['id']));
            $user['gift_exists_to_parent'] = count($this->giftsRepository->GetGiftsFromUser($user['id']));
            $user['sent_gift_exists_to_parent'] = count($this->giftsRepository->GetGiftsFromUser($user['id'], 1));
            if(isset($user['children']) && is_array($user['children']))
                $user['children'] = $this->setGiftsCount($user['children']);
        }
        return $users;
    }
}
