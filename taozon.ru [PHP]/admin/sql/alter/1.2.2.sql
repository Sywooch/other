UPDATE `pages` SET `is_service` = 1 WHERE `alias` IN ("paymentsuccess", "robo_success", "paymentfail", "robo_fail", "depositsuccess", "depositfail", "site_unavailable");
ALTER table `newsletters` CHANGE COLUMN `content` `content` LONGTEXT;
ALTER table `newsletters_mails` ADD COLUMN `status` VARCHAR(2048) NOT NULL DEFAULT '';
ALTER table `newsletters_mails` ADD INDEX `idx_status` (`status`);