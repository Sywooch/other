<?php
namespace Referral\Repository;

class MessagesRepository
{
    /**
     * @var \CMS
     */
    protected $cms;

    private $messages;

    private $otapilib;

    private $operatorSession;

    /**
     * @param \CMS $cms
     * @param $operatorSession
     */
    public function __construct($cms, $operatorSession){
        $this->otapilib = new \OTAPIlib();
        $this->operatorSession = $operatorSession;
        $this->cms = $cms;
        $this->messages = json_decode(file_get_contents( __DIR__ . '/../notification/messages.json' ));
    }

    public function NewRank($user, $parent, $newStatus){
        $this->Send($user['user_id'], $this->messages->new_rank[$newStatus]->subject,
            file_get_contents(__DIR__ . '/../notification/mail_templates/get_status_'.$newStatus.'.tpl'));

        if($parent)
            $this->Send($parent['user_id'],
                str_replace('##login##',$user['login'],$this->messages->new_rank[$newStatus]->subject_for_parent),
                $this->messages->new_rank[$newStatus]->message_to_parent);
    }

    public function Gift($toUserId){
        $this->Send($toUserId, $this->messages->new_gift->subject, $this->messages->new_gift->message);
    }

    public function Send($toUserId, $subject, $message){
        $toUserIdSafe = $this->cms->escape($toUserId);
        $subjectSafe = $this->cms->escape($subject);
        $messageSafe = $this->cms->escape($message);
        $added = time();
        $this->cms->query("
            INSERT INTO `site_support`
            SET `subject` ='$subjectSafe'
                ,`message` = '$messageSafe'
                ,`categoryid` = 'REFERRAL'
                ,`userid` = $toUserIdSafe
                ,`direction` = 'Out'
                ,`added` = $added
        ", array('site_support'));

        $user = $this->otapilib->GetUserInfoForOperator($this->operatorSession, $toUserId);
        \General::mail_utf8($user['Email'], $user['Login'], 'referral@'.$_SERVER['SERVER_NAME'], $subject, $message);
    }
}
