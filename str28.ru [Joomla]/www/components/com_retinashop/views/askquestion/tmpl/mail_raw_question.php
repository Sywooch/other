<?php
defined('_REXEC') or die('');

echo RText::sprintf('COM_RETINASHOP_WELCOME_VENDOR', $this->vendor->vendor_store_name) . "\n" . "\n";
echo RText::_('COM_RETINASHOP_QUESTION_ABOUT') . ' '. $this->product->product_name."\n" . "\n";
echo RText::sprintf('COM_RETINASHOP_QUESTION_MAIL_FROM', $this->user->name, $this->user->email) . "\n";
 
echo $this->comment. "\n";
