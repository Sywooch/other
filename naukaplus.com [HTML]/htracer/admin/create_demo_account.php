<?php
	if(!isset($_COOKIE['prefix'])||!$_COOKIE['prefix'])
	{
		$prefix= 'p'.abs(crc32(rand().$_SERVER['REMOTE_ADDR'].time().microtime()));
		setcookie('prefix',$prefix,time() + 60 * 60 * 24,'/');
		$dn=dirname(__FILE__).'/';
		copy($dn.'auto_config.php', $dn.'auto_config'.$prefix.'.php');
		chmod($dn.'auto_config'.$prefix.'.php', 0777);
		$_COOKIE['prefix']=$prefix;
		include('../HTracer.php');
		$l=dirname($_SERVER['REQUEST_URI']);
		HTracer::ImportFromGA(file_get_contents($dn.'ga_demo_data.txt'));
	}
	header("Location: options.php");
?>