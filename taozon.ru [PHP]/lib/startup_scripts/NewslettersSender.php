<?php

OTBase::import('system.model.data_mappers.SubscriberMapper');
OTBase::import('system.model.data_mappers.NewsletterMailMapper');
OTBase::import('system.model.data_mappers.NewsletterMapper');

ini_set('memory_limit', '512M');

class NewslettersSender
{
    /**
     * @var NewsletterMapper
     */
    protected $newsletterMapper;

    /**
     * @var SubscriberMapper
     */
    protected $subscriberMapper;

    /**
     * @var NewsletterMailMapper
     */
    protected $newsletterMailMapper;

    public function __construct()
    {
        $cms = new CMS();
        $this->newsletterMapper = new NewsletterMapper($cms);
        $this->subscriberMapper = new SubscriberMapper($cms);
        $this->newsletterMailMapper = new NewsletterMailMapper($cms);
    }

    public function sendQueue($limit, $fromEmail, $fromName)
    {
        if (rand(0, 1000) > 100) {
            return false;
        }

        try {
            $lastSentTime = $this->newsletterMailMapper->findLastSentTime();
            $now = new DateTime();

            $interval = defined('CFG_NEWSLETTER_INTERVAL_SEND_QUEUE') ? CFG_NEWSLETTER_INTERVAL_SEND_QUEUE : 120; // sek
            if ($now->getTimestamp() - $lastSentTime->getTimestamp() < $interval) {
                return false;
            }
            $newsletter = $this->newsletterMapper->findFirstNewsletterToSend();
            if (is_null($newsletter)) {
                return false;
            }

            $subscribers = $this->subscriberMapper->findSubscribersForNewsletterSend($newsletter->getId(), $limit);

            foreach ($subscribers as $subscriber) {
                $sentMail = new NewsletterMailEntity();
                $sentMail->setNewsletterId($newsletter->getId());
                $sentMail->setSubscriberId($subscriber->getId());
                $sentMail->setStatus('OK');
                try {
                    General::mail_utf8($subscriber->getEmail(), $fromName, $fromEmail, $newsletter->getTitle(), $newsletter->getText());
                } catch (Exception $e) {
                    $sentMail->setStatus('ERROR: ' . $e->getMessage());
                    ErrorLog::WriteErrorLog('newsletter_send', array(), $e->getMessage(), 'NEWSLETTER_ERROR');
                }
                $this->newsletterMailMapper->save($sentMail);
            }

            // check newsletter completed
            $subscribers = $this->subscriberMapper->findSubscribersForNewsletterSend($newsletter->getId(), $limit);
            if (count($subscribers) == 0) {
                $newsletter->setCompleted(true);
                $this->newsletterMapper->save($newsletter);
            }

            return true;
        } catch (Exception $e) {
            ErrorLog::WriteErrorLog('newsletter_send', array(), $e->getMessage(), 'NEWSLETTER_ERROR');
            return false;
        }
    }
}