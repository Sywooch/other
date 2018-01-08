<?php
/**
 * @param array $params
 * @param Smarty $smarty
 */
function smarty_function_good($params, &$smarty)
{
	$goods = $smarty->get_template_vars('goods');
	$ret = '';
	if (isset($goods[$params['id']])) {
		$smarty->assign('one_good', $goods[$params['id']]);
		$smarty->caching = false;
		$ret = $smarty->fetch(ROOT_PATH.'site/views/catalog/one_good.tpl', $params['id']);
		$smarty->caching = true;
	}
	return $ret; 
}
?>
