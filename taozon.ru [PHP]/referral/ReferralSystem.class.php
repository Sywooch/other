<?php

namespace Referral;

require_once __DIR__ . '/repository/UserRepository.class.php';
require_once __DIR__ . '/repository/OrderRepository.class.php';
require_once __DIR__ . '/repository/PresentsRepository.class.php';
require_once __DIR__ . '/repository/MessagesRepository.class.php';
require_once __DIR__ . '/notification/Email.class.php';

use Referral\Repository\UserRepository;
use Referral\Repository\OrderRepository;
use Referral\Repository\PresentsRepository;
use Referral\Repository\MessagesRepository;
use Referral\Notification\Email;

/**
 * Входные параметры берутся из GET запроса
 * обязательные параметры:
 * - act=название метода, который совершает обработку запроса
 * - login=логин пользователя в системе
 * - order=номер заявки
 * - purchase=сумма заказа
 *
 * Пример запроса для оплаты заказа http://opentao.ru/referral.php?act=payment&id=USR-0000000000&order=2&purchase=80
 * Пример запроса для отправки посылки http://opentao.loc/referral.php?act=sending&id=USR-0000000000&order=3&purchase=87.7
 *
 */

class ReferralSystem
{
    /**
     * @var \CMS
     */
    protected $cms;

    /**
     * @var Email
     */
    private $email;

    /**
     * @var \Logger
     */
    private $logger;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var MessagesRepository
     */
    private $messagesRepository;

    /**
     * @var PresentsRepository
     */
    private $giftRepository;

    private $config;

    private $discountGroups;
    private $operatorSession;

    /**
     * @param \CMS $cms
     * @param array $config
     */
    public function __construct($cms, $config) {
        $this->cms = $cms;
        $this->config = $config;
        $this->config['from_json'] = json_decode(file_get_contents(__DIR__ . '/config.json'));

        $this->userRepository = new UserRepository($this->cms);
        $this->orderRepository = new OrderRepository($this->cms);
        $this->giftRepository = new PresentsRepository($this->cms);

        $this->logger = new \Logger($this->cms);
        $this->email = new Email($this->logger);

        $this->getDiscountGroups();
        $this->messagesRepository = new MessagesRepository($this->cms, $this->operatorSession);
    }

    private function getDiscountGroups(){
        list($login, $pass) = require_once __DIR__ . '/config.php';
        global $otapilib;
        $otapilib->setErrorsAsExceptionsOn();

        $authentication = $otapilib->AuthenticateInstanceOperator($login, $pass);
        $this->operatorSession = $authentication['SessionId'];
        $this->discountGroups = $otapilib->GetDiscountGroupList($this->operatorSession);
    }

    /**
     * @param \RequestWrapper $request
     */
    public function doMethod(\RequestWrapper $request)
    {
        $this->logger->log($request->getValue('act') . " action", $request->getAll());
        $this->{$request->getValue('act').'Action'}($request);
    }

    /**
     * @param \RequestWrapper $request
     */
    public function paymentAction(\RequestWrapper $request){
        $user = $this->userRepository->GetByBLId($request->getValue('id'));

        $this->registerOrder($user['id'], $request->getValue('order'), $request->getValue('purchase'));

        $this->updateUserRank($user['id']);
        $this->refreshParentUsersRanks($user['id']);
    }

    /**
     * Сохраняем информацию об оплате заказа
     * @param $referralId
     * @param $orderId
     * @param $paymentAmount
     * @internal param $userId
     */
    public function registerOrder($referralId, $orderId, $paymentAmount){
        $this->logger->log("Adding order ", array($referralId, $orderId, $paymentAmount));

        $isFirstOrder = !$this->orderRepository->ExistOrdersForUser($referralId);
        $referralOrderId = $this->orderRepository->AddOrder($referralId, $orderId, $paymentAmount);

        if($isFirstOrder && $this->config['min_purchase_for_gift'] <= $paymentAmount){
            $this->sendGift($referralId, $referralOrderId);
        }
    }

    /**
     * Вносим изменения в информацию о пользователе в соответсвие с бонусной программой
     * @param $referralId
     * @internal param $userIdInBL
     */
    public function updateUserRank($referralId){
        $user = $this->userRepository->GetById($referralId);
        $currentStatus = $user['status'];
        $newStatus = $this->calculateUserRank($referralId);
        $this->logger->log("Update user $referralId rank. New status: $newStatus");

        $config = $this->config['from_json'];
        $discountGroup = array_filter($this->discountGroups, function($discount) use ($config, $newStatus){
            return $discount['Name'] == $config->statuses[$newStatus-1]->name;
        });

        if($discountGroup){
            $currentDiscount = current($discountGroup);
            $this->logger->log("Update user $referralId discount. New group: " . $currentDiscount['Name']);
            $user = $this->userRepository->GetById($referralId);
            global $otapilib;
            $otapilib->AddUserToDiscountGroup($this->operatorSession, (string)$currentDiscount['Id'], $user['user_id']);
        }

        $this->userRepository->SetStatus($referralId, $newStatus);
        if($currentStatus != $newStatus){
            $parent = $user['parent_id'] ? $this->userRepository->GetById($user['parent_id']) : false;
            $this->messagesRepository->NewRank($user, $parent, $newStatus);
        }
    }

    public function calculateUserRank($referralId){
        if(!$this->orderRepository->ExistOrdersForUser($referralId))
            return 0;

        $rank = 1;
        $statusesCount = count($this->config['from_json']->statuses);

        $childrenPerStatus = $this->userRepository->GetChildrenGroupedByStatus($referralId);
        for($i=1; $i<$statusesCount; ++$i){
            $suitableChildren = 0;
            for($j = $i; $j <= $statusesCount; ++$j){
                $suitableChildren += $childrenPerStatus[$j];
            }
            if($suitableChildren >= $this->config['from_json']->statuses[$i]->need_children)
                $rank = $i+1;
        }

        return $rank;
    }

    /**
     * Обновление данныых о пользователях, стоящих выше в бонусной системе
     * @param $referralId
     */
    public function refreshParentUsersRanks($referralId){
        $parents = $this->userRepository->GetParentsIds($referralId);
        $filteredParents = array_filter($parents);
        foreach($filteredParents as $parent){
            $this->updateUserRank($parent);
        }
    }

    /**
     * Отправка подарка
     * @param $referralId
     * @param $referralOrderId
     */
    public function sendGift($referralId, $referralOrderId){
        $this->logger->log("Send gift from order $referralOrderId.");
        $this->giftRepository->RegisterGift($referralOrderId);
    }

    /**
     * @param \RequestWrapper $request
     */
    public function sendingAction(\RequestWrapper $request){
        $this->logger->log("Add commission to balance.", $request->getAll());

        $user = $this->userRepository->GetByBLId($request->getValue('id'));
        $parents = $this->userRepository->GetParentsIds($user['id']);
        if(count($parents) < 3) return ;

        $grandParent = $this->userRepository->GetById($parents[1]);
        $commission = $this->config['from_json']->statuses[$grandParent['status']-1]->commission;

        $this->logger->log("Add commission to grandparent balance.", array($grandParent, $commission));
        $this->userRepository->SetBalance($parents[1], $grandParent['balance'] + ($commission / 100) * $request->getValue('purchase'));

        if($parents[2]){
            $grandGrandParent = $this->userRepository->GetById($parents[2]);
            $commission = $grandGrandParent['status'] > 2 ?
                $this->config['from_json']->statuses[$grandGrandParent['status']-1]->commission : 0;
            $this->logger->log("Add commission to grand grandparent balance.", array($grandGrandParent, $commission));
            $this->userRepository->SetBalance($parents[2], $grandGrandParent['balance'] + ($commission / 100) * $request->getValue('purchase'));
        }
    }
}
