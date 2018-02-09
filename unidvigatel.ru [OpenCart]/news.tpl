<?php
// News Module for Opencart v1.5.5, modified by villagedefrance (contact@villagedefrance.net)
?>

<?php if ($news) { ?>
<?php if($box) { ?>
	<div class="box">
		<div class="box-heading">
			<?php if($icon) { ?>
				<div style="float: left; margin-right: 8px;"><img src="catalog/view/theme/default/image/message.png" alt="" /></div>
			<?php } ?>
			<?php if($customtitle) { ?>
				<?php echo $customtitle; ?>
			<?php } ?>
		</div>
		<div class="box-content">
		<?php foreach ($news as $news_story) { ?>
			<div class="box-news">

				<?php if ($show_headline) { ?>
					<h4><?php echo $news_story['title']; ?></h4>
				<?php } ?>
				<p>
				   <a class="newsa" href="<?php echo $news_story['href']; ?>">
				   <img style="margin-bottom: 1px; vertical-align: middle;" src="catalog/view/theme/default/image/message-news.png" alt="" />
				   </a> 
				   <span><?php echo $news_story['posted']; ?></span>
				</p>

				<p><a class="newsimage" href="<?php echo $news_story['href']; ?>"><?php if ($news_story['thumb']) { ?><img  src="<?php echo $news_story['thumb']; ?>"><?php } ?></a><?php echo $news_story['description']; ?> .. </p>
				<p><a class="button" href="<?php echo $news_story['href']; ?>"> <?php echo $text_more; ?></a></p>
			</div>
		<?php } ?>
		<?php if($showbutton) { ?>
			<div style="text-align:right;">
				<a href="<?php echo $newslist; ?>" class="button"><span><?php echo $buttonlist; ?></span></a>
			</div>
		<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<div>

	<link rel="stylesheet" href="/css/flexslider.css" type="text/css" media="screen" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script defer src="/js/jquery.flexslider.js"></script>
	
	<script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
    </script>

<!--

	<div id="main" role="main">
      <section class="slider">
        <div class="flexslider">
          <ul class="slides">
                <li>
  	    	    <img src="/img/kitchen_adventurer_cheesecake_brownie.jpg" />
  	    		</li>
  	    		<li>
  	    	    <img src="/img/kitchen_adventurer_lemon.jpg" />
  	    		</li>
  	    		<li>
  	    	    <img src="/img/kitchen_adventurer_donut.jpg" />
  	    		</li>
  	    		<li>
  	    	    <img src="/img/kitchen_adventurer_caramel.jpg" />
  	    		</li>
          </ul>
        </div>
      </section>
    </div>
  
  
-->

	
		<?php foreach ($news as $news_story) { ?>
<!-------------------------------------------------->		
<div style="width:100%; background-color:transparent;">

<div id="container" class="cf">-->

<table width="100%" border="0">
<tr>
<td><?php if ($show_headline) { ?>
					<h4><?php echo $news_story['title']; ?></h4>
				<?php } ?>
				<?php echo $news_story['description']; ?> .. <br />
				<a href="<?php echo $news_story['href']; ?>"> <?php echo $text_more; ?></a></td>
<td><img  src="<?php echo $news_story['thumb']; ?>"></td>
</tr>
</table>

</div>

</div>

<!-------------------------------------------------->
		<?php } ?>
		



		
		
		<?php if($showbutton) { ?>
			<div style="text-align:right;">
				<a href="<?php echo $newslist; ?>" class="button"><span><?php echo $buttonlist; ?></span></a>
			</div>
		<?php } ?>
	</div>
<?php } ?>
<?php } ?>
