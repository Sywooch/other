<?php
defined('_REXEC') or die('');
echo RText::sprintf('COM_RETINASHOP_RECOMMEND_MAIL_MSG', $this->product->product_name, $this->comment);

$uri    = JURI::getInstance();
$prefix = $uri->toString(array('scheme', 'host', 'port'));
$link = JRoute::_ ( 'index.php?option=com_retinashop&view=productdetails&retinashop_product_id='.$this->product->retinashop_product_id );

echo '<br /><b>'.JHTML::_('link',$prefix.$link, $this->product->product_name).'</b>';
include(RPATH_rs_SITE.DS.'views'.DS.'cart'.DS.'tmpl'.DS.'mail_html_footer.php');
