<?php

/*
  Plugin Name: WP Content Copy Protection
  Plugin URI: http://securiilock.com
  Description: WP Content Copy Protection prevents plagiarism and protects most of your valuable content (such as source code, text content, and images) from being copied by others. Our Pro version includes much more ! See <a href="options-general.php?page=wpcp_options">Settings -> WP Content Copy Protection</a> to learn more about our advanced protection !
  Version: 1.0.6.2
  Author: RSPublishing
  Author URI: http://securiilock.com
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/*
  Copyright 2013  Rynaldo Stoltz  (email : support@securiilock.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

if(is_admin()) {
	add_action('admin_menu', 'constr_menu');
}

function constr_menu() {
	add_options_page('WP Content Copy Protection', 'WP Content Copy Protection', 'manage_options', 'wpcp_options', 'return_settings');
}

function return_settings() {
	require_once('settings.php');
}

add_action('wp_head', 'fwpcon_pro');
update_option('image_default_link_type','none');

function fwpcon_pro() { ?>

<!-- WP Content Copy Protection (Copyright Protection) script by Rynaldo Stoltz Starts -->

<div align="center"><noscript>
   <div style="position:fixed; top:0px; left:0px; z-index:3000; height:100%; width:100%; background-color:#FFFFFF">
   <div style="font-family: Tahoma; font-size: 14px; background-color:#FFF000; padding: 10pt;">Please enable your Javascript to see this page as it is meant to appear!</div></div>
</noscript></div>

<script type="text/javascript">
window.onload = function() {
	disableSelection(document.body)
}
 
function disableSelection(target){
if (typeof target.onselectstart!="undefined")
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined")
	target.style.MozUserSelect="none"
else 
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}
</script>

<script type="text/javascript">
function mousedwn(e) {
try { if (event.button == 2||event.button == 3) return false; }
catch (e) { if (e.which == 3) return false; }
}
	document.oncontextmenu = function() { return false; }
	document.ondragstart   = function() { return false; }
	document.onmousedown   = mousedwn;
</script>

<script type="text/javascript">
if (top.location != self.location) top.location.replace(self.location);
</script>

<style type="text/css">
* : (input, textarea) {

    -webkit-touch-callout: none;
    -webkit-user-select: none;

}

img {
	-webkit-touch-callout: none;
	-webkit-user-select: none;		
    }
</style>

<script type='text/javascript'>
window.addEventListener("keydown",function (e) {
    if (e.ctrlKey && (e.which == 65 || e.which == 67 || e.which == 85 || e.which == 80)) {
        e.preventDefault();
    }
})
        document.keypress = function(e) {
        if (e.ctrlKey && (e.which == 65 || e.which == 67 || e.which == 85 || e.which == 80)) {
	}
		return false;
				};
</script>

<!-- WP Content Copy Protection (Copyright Protection) script by Rynaldo Stoltz Ends -->

































<?php 

} 
?>