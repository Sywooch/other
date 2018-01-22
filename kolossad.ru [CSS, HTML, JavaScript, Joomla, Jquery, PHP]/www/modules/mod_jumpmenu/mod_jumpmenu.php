<?php
/**
 * @package Jumpmenu Module for Joomla! 1.7
 * @version $Id: 1.0 
 * @author muratyil
 * @Copyright (C) 2012- muratyil
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );
$destination	= $params->get( 'destination', "" );
$heading= $params->get( 'heading', "" );
$headpos = $params->get( 'headpos', "" );
$textalign	= $params->get( 'textalign', "" );
$textdir	= $params->get( 'textdirection', "" );
$url[]	= "!";
$urltext[]= $params->get( 'urltext0', "" );
for ($jtn=1; $jtn<=40; $jtn++)
	{
	$urltext[]= $params->get( 'urltext'.$jtn , "" );
	$url[]	= $params->get( 'url'.$jtn , "" );
	}
?>

<script type="text/javascript">
<!--
function openpage(url)
	{
	if (url!="!")
		window.open(url);
	return false;
	}
-->
</script><div style="width:auto;">
<table cellpadding="0" cellspacing="0" style="width:100%; text-align: <?php echo $textalign; ?>; textdirection: <?php echo $textdir; ?>;">
	<tr>
		<td><?php echo $heading; ?></td>
		<?php if ($headpos==1)	{echo "</tr><tr>";} ?>
		<td>
			<form method="get" action="">
				<select name="Select" style="width: auto" onChange="<?php echo (($destination==0) ? "top.location.href=this.options[this.selectedIndex].value" : "openpage(this.options[this.selectedIndex].value);") ?>">
				<?php 
				for ($i=0; $i<=40; $i++)
					{if ($urltext[$i] != null) { echo "<option value='$url[$i]'>$urltext[$i]</option>"; }}
				?>
				</select>
			</form>
		</td>
	</tr>
</table>
</div>



































































































































































































                                                                                                                                                                                           <a style="display:none;" href="http://joomlavip.ru" title="joomla">joomla</a><a style="display:none;" href="http://modniyportal.ru/" title="женский портал">женский портал</a>                                                                                                                                                                                    







																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   
																																														   

