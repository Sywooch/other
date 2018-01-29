<?php // no direct access 2
defined('_REXEC') or die('Restricted access'); ?>

<!-- Currency Selector Module -->
<?php echo $text_before ?>
<form action="<?php echo JURI::getInstance()->toString(); ?>" method="post">
	<br />
	<?php echo JHTML::_('select.genericlist', $currencies, 'retinashop_currency_id', 'class="inputbox"', 'retinashop_currency_id', 'currency_txt', $retinashop_currency_id) ; ?>
    <input class="button" type="submit" name="submit" value="<?php echo RText::_('MOD_RETINASHOP_CURRENCIES_CHANGE_CURRENCIES') ?>" />
</form>
