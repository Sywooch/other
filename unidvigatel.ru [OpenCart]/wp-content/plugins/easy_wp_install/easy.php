<?php  
    if($_POST['easy_hidden'] == 'Y') {  
	
        $eblocation = $_POST['easy_location'];  
        update_option('easy_location', $eblocation); 

		if (isset($_POST['easy_enabledd'])) {
			update_option('easy_enabledd', 'true');
		} else {
			update_option('easy_enabledd', 'false');
		}
  
		if (isset($_POST['easy_enablesh'])) {
			update_option('easy_enablesh', 'true');
		} else {
			update_option('easy_enablesh', 'false');
		} 
		
		$ebskinname = $_POST['easy_skinname'];  
        update_option('easy_skinname', $ebskinname);  
		
		$ebcssname = $_POST['easy_cssname'];  
        update_option('easy_cssname', $ebcssname);  	
    } 
	
		$eblocation = get_option('easy_location', 'wp-content/plugins/easy_wp_install/easybasket/');  
        $ebenabledd = get_option('easy_enabledd', 'false');  
        $ebenablesh = get_option('easy_enablesh', 'true'); 
		$ebskinname = get_option('easy_skinname', 'wordpress.xsl'); 
		$ebcssname = get_option('easy_cssname', 'wordpress.css'); 
        ?>  
<div class="wrap">  
	<?php   // echo "<h2>" . __( 'Easy Basket Installation Options | Easy Basket <a href="../wp-content/plugins/easy_wp_install/easybasket/">settings</a>', 'easy_trdom' ) . "</h2>"; ?>  
  
	<form name="easy_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
		<input type="hidden" name="easy_hidden" value="Y">  
		<?php    echo "<h4>" . __( 'Easy Basket Location', 'easy_trdom' ) . "</h4>"; ?>  
		<p><?php _e("Location: " ); ?><input type="text" name="easy_location" value="<?php echo $eblocation; ?>" size="56"><?php _e(" Default Path to Easy Basket." ); ?></p>  
		<hr />  
		<?php    echo "<h4>" . __( 'Easy Basket Drag & Drop', 'easy_trdom' ) . "</h4>"; ?>  
		<p>
			<?php _e("Enable Drag & Drop: " ); ?>
			<input type="checkbox" name="easy_enabledd" <?php if ($ebenabledd == 'true'){echo "checked='yes'";} ?>>
		</p>  
		<hr /> 
		<?php    echo "<h4>" . __( 'Easy Basket Show & Hide', 'easy_trdom' ) . "</h4>"; ?>
		<p>
			<?php _e("Enable Show & Hide: " ); ?>
			<input type="checkbox" name="easy_enablesh" <?php if ($ebenablesh == 'true'){echo "checked='yes'";} ?>>
		</p>  
		<hr /> 
		<?php    echo "<h4>" . __( 'Easy Basket Skin Details', 'easy_trdom' ) . "</h4>"; ?>
		<p><?php _e("Skin Name: " ); ?><input type="text" name="easy_skinname" value="<?php echo $ebskinname; ?>" size="20"><?php _e(" Default: 'wordpress.xsl'"); ?></p>  
		<p><?php _e("Skin CSS Name: " ); ?><input type="text" name="easy_cssname" value="<?php echo $ebcssname; ?>" size="20"><?php _e(" Default: 'wordpress.css'"); ?></p>  
		
		
		<p class="submit">  
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'oscimp_trdom' ) ?>" />  
		</p>  
	</form>  
</div>
