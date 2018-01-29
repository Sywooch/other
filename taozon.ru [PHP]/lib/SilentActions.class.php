<?php

OTBase::import('system.lib.startup_scripts.*');

class SilentActions {

    public static function clearOldReviews()
    {
        DeleteOldReviews::run();
    }

    public static function sendTHSNotification()
    {
        THSNotifier::run();
    }
    
    public static function backupMainPage($pageHtml = null)
    {
        if (date('i') % 5 != 0) {
            return;
        }
        MainPage::backup($pageHtml);
    }    
    
    public static function updateMainPageCache()
    {
        if (date('i') % 5 != 0) {
            return;
        }
        MainPage::updateCache();
    }

    public static function usersVisitStat()
    {
        UsersVisits::saveVisit();
        UsersVisits::notifyOnNewPurchases();
        UsersVisits::notifyOnNewVisits();
    }

    public static function sendNewsletters()
    {
        $N = new NewslettersSender();
        $N->sendQueue(
            General::getConfigValue('newsletter_per_send_limit', 5),
            General::getConfigValue('newsletter_from_email', General::getConfigValue('notification_send_from')),
            General::getConfigValue('newsletter_from_name', 'Newsletter')
        );
    }
}
