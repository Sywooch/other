<style type="text/css">
	.bxslider li{
		margin-top:-28px;

	}
	.bx-caption{
	padding-bottom:20px;
	margin-bottom:-20px;
	}
	.a{

		color:transparent;
		background-color:transparent;
	}

	.a:active{
		color:transparent;
		background-color:transparent;

	}

.bx-wrapper .bx-next:hover {
		background-position:top center !important;
}
.bx-wrapper .bx-prev:hover {
		background-position:top center !important;
}

.bx-wrapper .bx-prev {
		left:0;

	}

.bx-wrapper .bx-next {
		right:0;

	}

.bx-wrapper .bx-pager {
		padding-top:0px;
		background-color:transparent !important;


	}

.bx-wrapper .bx-pager a{
		margin-top:-50px !important;

	}

.bx-wrapper	.bx-pager .bx-default-pager{


	}

	.bx-viewport{


  -moz-border-radius: 5px; /* Firefox */
    -webkit-border-radius: 5px; /* Safari, Google Chrome */
    -khtml-border-radius: 5px; /* KHTML */
    -o-border-radius: 5px; /* Opera */
    -ms-border-radius: 5px; /* IE8 */
    -icab-border-radius: 5px; /* Icab */
    border-radius: 5px; /* CSS3 */

	}


.bx-wrapper .bx-pager a {

		margin-bottom:0px !important;
		margin-top:0px !important;
	}
</style>

<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();?>



<ul class="bxslider" style="background-color:transparent;">
<? foreach($arResult as $category): ?>
	<li style="background-color:transparent;"> <!--$category["HREF"] -->
		<?if($arParams["HREF_IMG"]):?>
			<a href="/news/galereya/<?=$category["HREF"] ?>/" title="<?=$category["NAME"]?>"  style="color:transparent;">
				<img src="<?=$category["DETAIL_PICTURE"]?>" title="<?=$category["NAME"]?>" style="margin-bottom:-20px;">
			</a>
		<?else:?>
			<img src="<?=$category["DETAIL_PICTURE"]?>" title="<?=$category["NAME"]?>" style="margin-bottom:-20px;">
		<?endif;?>
	</li>
<? endforeach; ?>
</ul>