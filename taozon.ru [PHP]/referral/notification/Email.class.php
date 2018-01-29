<?php

namespace Referral\Notification;

class Email
{
    private $logger;

    public function __construct(\Logger $logger){
        $this->logger = $logger;
    }

    function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
    }

    /**
     * Send email
     *
     * @param $to
     * @param $fromUser
     * @param $fromEmail
     * @param $subject
     * @param $message
     */
    public function Send($to, $fromUser, $fromEmail, $subject, $message){
        $result = \General::mail_utf8($to, $fromUser, $fromEmail, $subject, $message);
    }
}
