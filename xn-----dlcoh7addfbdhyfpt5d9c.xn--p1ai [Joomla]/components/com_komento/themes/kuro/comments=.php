<?php
/**
 * @package		Komento
 * @copyright	Copyright (C) 2012 Stack Ideas Private Limited. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 *
 * Komento is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
defined('_JEXEC') or die('Restricted access');
?>

<ul class="kmt-list reset-child">
<?php
$count_comments=0;
$count_comments2=0;
?>

	<?php if( $comments ) {
		foreach( $comments as $row ) {

			// Set all row data
			$this->set( 'row', $row );

			echo $this->fetch( 'comment/item.php' );
			
			$count_comments++;
			if($count_comments==3){ break; };
		}
	} else { ?>
		<li class="kmt-empty-comment">
			<?php echo JText::_( 'COM_KOMENTO_COMMENTS_NO_COMMENT' ); ?>
		</li>
	<?php } ?>
</ul>

<?php if( $comments ) {
foreach( $comments as $row ) {
$count_comments2++;
}
}
?>

<?php
//echo $count_comments2;
?>

		<table width="100%" border="0" class="comments_buttons">

  		<tr>

    	<td align="center" style="color:#494949; text-align:center;">&lt; <strong> 1</strong> 
        <?php  $count_comments2=$count_comments2-3; ?>
        <?php 
		if($count_comments2<=10){
		
		echo "| 2";
		
		}else{
		
		$count1=$count_comments2/10; 
				
		for($i=2;$i<=$count1+1;$i++){
		echo "| ".$i;
		}
        
		}
		?>
        &gt;
        <?php //echo $count_comments; ?>
        </td>

  		</tr>

		</table>
        
        
        

