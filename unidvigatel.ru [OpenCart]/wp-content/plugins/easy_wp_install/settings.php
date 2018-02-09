<?php

define('SETTINGS', '../wp-content/plugins/easy_wp_install/easybasket/settings.php');
define('TRANSFORM', '../wp-content/plugins/easy_wp_install/settings.xsl');
define('NEW_SETTINGS', '../wp-content/plugins/easy_wp_install/easybasket/new.xsl');

switch ($_SERVER['REQUEST_METHOD']) {
	case 'GET' : handle_get(); break;
	case 'POST' : handle_save(); break;
}

function handle_get() {

	$proc = new XSLTProcessor();
	$xml = get_file(SETTINGS);
	echo transform("<root>$xml</root>", TRANSFORM, $proc);
}

function handle_save() {
	
	$proc = new XSLTProcessor();
	$proc->setParameter('', 'timestamp', date('c'));
	$proc->setParameter('', 'http_form', urldecode(file_get_contents("php://input")));
	$xml = transform(get_file(SETTINGS), NEW_SETTINGS, $proc);
	$x = "<?php header('Location: index.php') ?>";
	$flg = file_put_contents(SETTINGS, $xml.$x);
	
	$xml = get_file(SETTINGS);
	echo transform("<root>$xml</root>", TRANSFORM, $proc);
}

function transform($strXml, $filename, &$proc) {
	$input = new DOMDocument();
	$input->loadXML($strXml);

	$trans = new DOMDocument();
	$t = file_get_contents($filename) or die('cwd='.getcwd());
	$trans->loadXML($t);

	$proc->importStylesheet($trans);
	$strResult = $proc->transformToXML($input);

	return pretty($strResult);
}

function get_file($file) {
	$t = file_get_contents($file) or die('No File!');
	return $t;
}

function pretty($strXml) {
	$pretty = new DOMDocument();
	$pretty->preserveWhiteSpace = false;
	$pretty->formatOutput = true;
	$pretty->loadXML($strXml);
	return $pretty->saveXML($pretty->documentElement);
}
?>