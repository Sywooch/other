/*
# ------------------------------------------------------------------------
# TCVN Highslide Module for Joomla 2.5
# ------------------------------------------------------------------------
# Copyright(C) 2008-2012 www.Thecoders.vn. All Rights Reserved.
# @license http://www.gnu.org/licenseses/gpl-3.0.html GNU/GPL
# Author: Thecoders.vn
# Websites: http://Thecoders.com
# ------------------------------------------------------------------------
*/
function check_close(id, time, ip){
	if(document.getElementById('check_'+id)!=null && document.getElementById('check_'+id).checked){
		Set_Cookie(ip, true, time, '/', '', '');
	}	
}
function display_none(id){
	if(document.getElementById(id)!=null){
		document.getElementById(id).style.display='none';
	}
}
function display_block(id){
	if(document.getElementById(id)!=null){
		document.getElementById(id).style.display='block';
	}
}
