<?php
// Access
defined('_REXEC') or die('Restricted access');

// Category and Columns Counter
$iCol = 1;
$iCategory = 1;

// Calculating Categories Per Row
$categories_per_row = rsConfig::get('categories_per_row', 3);
$category_cellwidth = ' width' . floor(100 / $categories_per_row);

// Separator
$verticalseparator = " vertical-separator";
?>

<div class="category-view" style="margin-top:0px !important">

    <!--<h4><?php //echo RText::_('COM_RETINASHOP_CATEGORIES') ?></h4>-->

    <?php
    // Start the Output
    foreach ($this->categories as $category) {

	// Show the horizontal seperator
	if ($iCol == 1 && $iCategory > $categories_per_row) {
	    ?>
	   <!-- <div class="horizontal-separator"></div>-->
	<?php
	}

	// this is an indicator wether a row needs to be opened or not
	if ($iCol == 1) {
	    ?>
	    <div class="row" style="background-color:white !important; 
		background-image:url('../../../../../images/stories/retinashop/pictures/kontekst_fon.png') !important;
		margin-top:10px !important; margin-bottom:30px !important; background-repeat:no-repeat !important;">
	    <?php
	    }

	    // Show the vertical seperator
	    if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {
		$show_vertical_separator = ' ';
	    } else {
		$show_vertical_separator = $verticalseparator;
	    }

	    // Category Link
	    $caturl = JRoute::_('index.php?option=com_retinashop&view=category&retinashop_category_id=' . $category->retinashop_category_id);

	    // Show Category
	    ?>
    	<div class="category floatleft<?php echo $category_cellwidth . $show_vertical_separator ?>">
    	    <div class="spacer">
    		<h2>
    	<div style="height:180px; ">	   
    		<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">	
	    <?php
	    if (!empty($category->images)) {
		echo $category->images[0]->displayMediaThumb("", false);
	    }
	    ?>
		</a>
		</div>
	<!--	<br />-->
		
		 <a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>" style="color:#878787 !important">
    <strong><?php echo $category->category_name ?></strong>
		
    		    </a>
    		</h2>
    	    </div>
    	</div>
	<?php
	$iCategory++;

	// Do we need to close the current row now?
	if ($iCol == $categories_per_row) {
	    ?>
		<div class="clear"></div>
	    </div>
	<?php
	$iCol = 1;
    } else {
	$iCol++;
    }
}
// Do we need a final closing row tag?
if ($iCol != 1) {
    ?>
        <div class="clear"></div>
    </div>
    <?php
}
?>
</div>