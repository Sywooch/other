<?if (!empty($arResult)):?>

<style type="text/css">
.horizontal-multilevel-menu li a{
color:#800d0d;
padding-left:30px; 

}


	#horizontal-multilevel-menu li:hover li:hover a{
		background-color:#d4d4d4;

	}
	#horizontal-multilevel-menu li:hover li:hover li a{
background-color:transparent;

	}

	#horizontal-multilevel-menu li.jshover li.jshover a{
background-color:transparent;

	} 


	#horizontal-multilevel-menu li:hover li:hover li:hover a{
background-color:#d4d4d4;

	}


	#horizontal-multilevel-menu li.jshover li.jshover li.jshover a{
background-color:transparent;

	} 


	#horizontal-multilevel-menu li:hover li:hover li:hover li:hover a{
background-color:transparent;

	} 


#horizontal-multilevel-menu li.jshover li.jshover li.jshover li.jshover a 
	#horizontal-multilevel-menu li:hover li:hover li:hover li:hover li:hover a{
background-color:transparent;

	} 


#horizontal-multilevel-menu li.jshover li.jshover li.jshover li.jshover li.jshover a 
	#horizontal-multilevel-menu li:hover li:hover li:hover li:hover li:hover li:hover a{
background-color:transparent;
	} 


#horizontal-multilevel-menu li.jshover li.jshover li.jshover li.jshover li.jshover li.jshover a{
		background-color:transparent;

	}


#horizontal-multilevel-menu li ul {

 -moz-box-shadow: 0 0 15px black;
 -webkit-box-shadow: 0 0 15px black;

	}




</style>




<ul align="center" id="horizontal-multilevel-menu" style="height:70px; padding-top:0px; ">

<?
$tmp_i=0;
$previousLevel = 0;
foreach($arResult as $arItem):
$tmp_i++; ?>

	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li style="padding-left:0px; padding-right:0px; height:70px; ">
			<table style="border-left:1px #d4d4d4 solid; border-right:0px #d4d4d4 solid;">
			<tr><td style="height:50px;
			background-color:transparent; max-width:200px; padding-left:14px; padding-right:14px;">
				<a href="<?=$arItem["LINK"]?>" style="color:#800d0d !important; font-size:14px;
				font-weight:bold;" 
			class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?> </a>
			</td></tr></table>

<ul style=" margin-top:14px; width:300px !important;  -moz-box-shadow: 0 0 15px black;
 -webkit-box-shadow: 0 0 15px black;
box-shadow: 0 0 15px black;
 -ms-filter: progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=135, Color='black');
 filter: progid:DXImageTransform.Microsoft.Shadow(Strength=10, Direction=135, Color='black');
zoom: 1 !important; 
" class="shadow_ie8">

				<div style="width:100%; height:8px;" class="submenu_line">
				
				</div>
				
		<?else:?>
			<li  <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
			
			<a href="<?=$arItem["LINK"]?>" style="color:#800d0d !important;"  class="parent"><?=$arItem["TEXT"]?></a>
			
				<ul style=" margin-left:300px; width:auto;">
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li style="padding-left:0px; padding-right:0px; height:100%;
                      ">


            <table style="border-left:1px #d4d4d4 solid; border-right:0px #d4d4d4 solid;">
			<tr><td style="height:50px;
max-width:200px; padding-left:10px; padding-right:10px; background-color:transparent;">


				<a href="<?=$arItem["LINK"]?>"
				style="color:#800d0d !important; font-weight:bold; font-size:14px;"   class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>


			</td></tr></table>


				</li>
			<?else:?>
				<li   <?if ($arItem["SELECTED"]):?> 
				class="item-selected"<?endif?> style=" width:100% !important; ">
				
				<a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
				
				</li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li style="padding-left:14px; padding-right:14px;   height:100%;  ">
			
				<a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" 
				title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a>
			
				</li>
			<?else:?>
				<li  style="padding-left:14px; padding-right:14px; height:100%;">
		
				<a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a>
	
				</li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>


<div class="menu-clear-left"></div>
<?endif?>