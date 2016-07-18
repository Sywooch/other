<?php

defined('_JEXEC') or die;

?>

<!-- Start K2 Category Layout -->
<div id="event_container">


	<?php if((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))): ?>
	<!-- Item list -->
	<div id="event_itemList">

		<?php if(isset($this->primary) && count($this->primary)): ?>
		<!-- Primary items -->
		<div id="event_itemListPrimary">
		    <?php
		    
		    $num=0;
		    
		    ?>
		    
		    
			<?php foreach($this->primary as $key=>$item): ?>
            
            
            <?php
			
			
			
			?>
            
			
			<?php
			// Define a CSS class for the last container on each row
			if( (($key+1)%($this->params->get('num_primary_columns'))==0) || count($this->primary)<$this->params->get('num_primary_columns') )
				$lastContainer= ' itemContainerLast';
			else
				$lastContainer='';
			?>
			
            
            <?php
			
			
			if( (isset($_GET['type'])) && (isset($_GET['type_text'])) && (isset($_GET['city'])) && (isset($_GET['city_text'])) ){
			
			//print_r($this->item->extra_fields); //$this->item->id;
			$ext_json=json_decode($this->item->extra_fields);
			
			//echo "-".count($ext_json[0]->value)."-"; 
			//echo $ext_json[0]->value;// echo $json[1]->value;
			$log=0;
			for($i1=0;$i1<count($ext_json[0]->value);$i1++){
			//	echo " city=".$ext_json[0]->value[$i1]."-".$_GET['city']; //city
				if(($_GET['city']!="all")&&($_GET['city']==($ext_json[0]->value[$i1]))){
				   $log=1;
				}
			}
			//echo" +".$log."++ ";
			
			for($i1=0;$i1<count($ext_json[1]->value);$i1++){
				//echo " type=".$ext_json[1]->value[$i1]; //type
				if(($_GET['type']!="all")&&($_GET['type']==($ext_json[1]->value[$i1]))){
			//	    $log=1;
				}
			}
			
			if($log==0){
			  //  continue;
			  ?>
			  
			  
			  <?php
			  
			}
			
			}
			?>
            
            <?php
            //echo $log; echo" == ";
            if(($log==0)&&((isset($_GET['city'])))){
            //continue;
            ?>
            <!--<style type="text/css">
                #event_itemContainer.item_<?php echo $num;  ?>{
                    display:none;
                    
                }
                
            </style>
            -->
            
            <?php
                
            }
            
            ?>
            
            
			<div id="event_itemContainer" class="tmp3 item_<?php echo $num;   $num++; ?>">
				<?php
					// Load category_item.php by default
					$this->item=$item;
					echo $this->loadTemplate('item');
				?>
			</div>
			
			
			
			
			
			<?php if(($key+1)%($this->params->get('num_primary_columns'))==0): ?>
			<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
                
                
	</div>

	<!-- Pagination -->
	<?php if($this->pagination->getPagesLinks()): ?>
        <div id="clr"></div>
	<div id="event_k2Pagination">
		<?php if($this->params->get('catPagination')) echo $this->pagination->getPagesLinks(); ?>
	</div>
	<?php endif; ?>

	<?php endif; ?>
</div>
<!-- End K2 Category Layout -->
