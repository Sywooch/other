<?php
  defined('_JEXEC') or die('Restricted access'); // no direct access
?>
<div class="breadcrumbs<?php echo $moduleclass_sfx; ?>">
<?php if ($params->get('showHere', 1))
	{
		echo '<span class="showHere">' .JText::_('BREADCRUMBSADV_HERE').'</span>';
	}
    // default skin
	$tmp_count=1;
    for ($i = 0; $i < $count; $i++) {
    	// If not the last item in the breadcrumbs add the separator
    	if ($i < $count -1) {

    		if(!empty($list[$i]->link)) {
          if ($i == 0 && $homePath != '') {
            echo '<a href="'.$list[$i]->link.$homePath.'" class="pathway">'.$list[$i]->name.'</a>';
          } else {
		  
		  $tmp_list_name=str_replace("Home","Главная",$list[$i]->name);
		  $tmp_list_name=str_replace("Online Store","Категории",$tmp_list_name);
		  
		  if($tmp_count!=1){
			echo '<a href="'.$list[$i]->link.'" class="pathway nofirst">'.$tmp_list_name.'</a>';
          }else{
          	echo '<a href="'.$list[$i]->link.'" class="pathway">'.$tmp_list_name.'</a>';
          }
		  
		  }
    		} else {
    			echo $list[$i]->name;
    		};
    		if ($i < $count -2)
          echo ' / ';

    	}  else if ($showLast && $count > 1) { // when $i == $count -1 and 'showLast' is true

          echo ' / ';
          if ( ($cutLast) && (strlen($list[$i]->name) > $cutAt) ) { // when cutLast is true and length of breadcrumb is bigger than cutAt
    	      echo  mb_substr($list[$i]->name, 0 , $cutAt, 'UTF-8').$cutChar;
          } else {
            echo $list[$i]->name;
          };

    	} else if ($count == 1) {
        if ($clickHome) {
          if ($homePath != '') {
            echo '<a href="'.$list[0]->link.$homePath.'" class="pathway">'.$list[0]->name.'</a>';
          } else {
          	echo '<a href="'.$list[0]->link.'" class="pathway">'.$list[0]->name.'</a>';
          }
        } else {
          echo $list[0]->name;
        }
    	};
		
		$tmp_count++;
		
  	}; //endfor
?>
</div>

