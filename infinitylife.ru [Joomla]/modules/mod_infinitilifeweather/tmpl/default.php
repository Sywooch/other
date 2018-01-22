<?php
/**
 * @package     Ghost_Russia.JoomlaSite
 * @subpackage  Templates.Ghost_Russia.mod_infinitilifeWeather
 *
 * @copyright   Copyright (C) 2007 - 2015 Ghost_Russia. All rights reserved.
 * @author      Vladislav Fursov
 */

defined('_JEXEC') or die;
?>

<div class="weather <?php echo $moduleclass_sfx ?> wth2">
    <div class="clicked ">
        <div style="background-image: url('/templates/infinitilife/images/weather/blue/<?php echo $weather->image ?>.png')" class="img "></div>
        <div><?php echo $weather->temp ?>°C</div>
        <div><?php echo $weather->type ?></div>
    </div>
    <div class="weatherfull wth2">
        <table class="main" border="0" cellpadding="0" cellspacing="0">
            <tr>
                <td class="temperature"><?php echo $weather->temp ?>°</td>
                <td style="background-image: url('/templates/infinitilife/images/weather/<?php echo $weather->image ?>.png')" class="img <?php echo $weather->image ?>"></td>
            </tr>
            <tr>
                <td class="date"><?php echo $weather->day.", ".$weather->day_num ?></td>
                <td class="wind_speed"><?php echo $weather->wind ?> м/с</td>
            </tr>
        </table>
        <div>
            <table border="0" cellpadding="0" cellspacing="0">
                <tr class="img">
                    <?php for($i = 0; $i <= 6; $i++){
                            echo '<td onclick="day_f(\''.$i.'\');" style="cursor:pointer; background-image: url(\'/templates/infinitilife/images/weather/'. $weather->$i->image .'.png\')" class="'.$weather->$i->image.'" title="'.$weather->$i->temp.'"></td>';
                        } ?>
                </tr>
                <tr class="days" style="font-size:16px;">
                    <?php for($i = 0; $i <= 6; $i++){
                        echo '<td onclick="day_f(\''.$i.'\');"  title="'.$weather->$i->temp.'" style="cursor:pointer;">'.$weather->$i->day.'</td>';
                        //echo $weather->$i->image;
                        //echo"  ";
                        
                    } ?>
                </tr>
            </table>
        </div>
        
        
        <?php
        
        $database =& JFactory::getDBO();

		
		$database->setQuery("SELECT * FROM #__banners WHERE catid='16'");
		$list = $database->loadObjectList();
 
		foreach($list as $it) {
		    
		    $url=$it->params;
		    $m=explode('":"',$url);
		    $url=$m[1];
		    $m=explode('","',$url);
		    $url=$m[0];
		    $url=str_replace("\\","",$url);
		    
		    $width=$it->params;
		    $m=explode(',"',$width);
		    $width=$m[1];
		    $m=explode('":',$width);
		    $width=$m[1];
		    
		    $height=$it->params;
		    $m=explode(',"',$height);
		    $height=$m[2];
		    
		    $m=explode('":',$height);
		    $height=$m[1];
		   
		    
 ?>

    <img src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" class="banner wth2"/>    
 
 
 <?php
 	  	 
        
		}
        ?>
        
        
        
    </div>
</div>

<script type="text/javascript">
var image=new Array();
var temp=new Array();
var type=new Array();
var day=new Array();
var day_num=new Array();
var wind=new Array();

<?php for($i = 0; $i <= 6; $i++){

echo '  image['.$i.']="'.$weather->$i->image.'";   '; 
echo '  temp['.$i.']="'.$weather->$i->temp.'";   '; 
echo '  type['.$i.']="'.$weather->$i->type.'";   '; 
echo '  day['.$i.']="'.$weather->$i->full_day_of_week.'";   '; 
echo '  day_num['.$i.']="'.$weather->$i->day_num.'";   '; 
echo '  wind['.$i.']="'.$weather->$i->wind.'";   '; 
 
}

?>
var $j = jQuery.noConflict();


function day_f(n){

$j('.main .img').css({'background-image' : 'url(/templates/infinitilife/images/weather/'+image[n]+'.png)'}); 

$j('.main .temperature').html(temp[n]); 


$j('.main .date').html(day[n]+", "+day_num[n]); 
$j('.main .wind_speed').html(wind[n]+" м/с");


}


</script>


