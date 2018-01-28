<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package AccessPress Root
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=958px, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,100,900italic,900,700italic,700,500italic,500,400italic&subset=latin,cyrillic' rel='stylesheet' type='text/css'> 
<link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100&subset=latin,cyrillic' rel='stylesheet' type='text/css'>



<script type="text/javascript" src="/js/jquery-1.7.2.min.js" ></script>
<script type="text/javascript" src="/js/jquery.maskedinput-1.3.js"></script>

<script type="text/javascript">
function min(t1){
var m=59;
if(t1.indexOf('sent-ok') + 1) {

var t = setInterval (function ()
   
{
if(m==0){
$('#mess1').fadeIn(1500);

clearInterval(t);

}
$('#min1').text(m);
m=m-1;

   
   }, 1000);


}

}

</script>

</head>

<body <?php body_class(); ?>>



<div class="fon_tar" id="fon_tar1" onclick="tar_1();">
<div id="tar1" class="tar"><i onclick="tar_1();" class="icon-remove icon-white" style="margin-top:-7px; float:right; cursor:pointer;"></i>Описание тарифа 1</div>
</div>

<div class="fon_tar" id="fon_tar2" onclick="tar_2();">
<div id="tar2" class="tar"><i onclick="tar_2();" class="icon-remove icon-white" style="margin-top:-7px; float:right; cursor:pointer;"></i>Описание тарифа 2</div>
</div>

<div class="fon_tar" id="fon_tar3" onclick="tar_3();">
<div id="tar3" class="tar"><i onclick="tar_3();" class="icon-remove icon-white" style="margin-top:-7px; float:right; cursor:pointer;"></i>Описание тарифа 3</div>
</div>

<div class="fon_tar" id="fon_tar4" onclick="tar_4();">
<div id="tar4" class="tar"><i onclick="tar_4();" class="icon-remove icon-white" style="margin-top:-7px; float:right; cursor:pointer;"></i>Описание тарифа 4</div>
</div>





<div id="outer-wrap">
<div id="inner-wrap"> 
<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="ak-container">

<!----------->

<div style="  width: 400px;
  height: 135px; 
padding:10px;
text-align:center; background-color:black; position:fixed; color:#fff; left:50%; top:50%;margin-left:-210px; margin-top:-55px; display:none; z-index:99999;" id="mess1">
Если наш менеджер еще не перезвонил Вам, значит он в данный момент разговаривает с другим клиентом. Пожалуйста подождите еще немного.
</div>





          <a class="logo" href="/"></a>
<span class="note1">Свяжитесь с нашим менеджером по Skype</span>
<span class="skype"><a href="skype:gsu_resident234?call">Позвонить менеджеру</a></span>

<span class="note3">Позвоните нам<br>Бесплатно</span>
<span class="number">8(800)234-44-74</span>

<!----------->

<a name="top2"></a>
<div id="site-branding" class="clearfix">
			<?php if(of_get_option('logo_setting') == 'image' || of_get_option('logo_setting') == 'image_text') : 
				if(of_get_option('logo')): ?>
				<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url(of_get_option('logo')); ?>" alt="<?php bloginfo( 'name' ); ?>"/> </a> 
			<?php endif;
			endif;
			if(of_get_option('logo_setting') == 'text' || of_get_option('logo_setting') == 'image_text'): ?>
				<a class="site-text" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</a>
			<?php endif; ?>	
			</div><!-- .site-branding -->

			<div class="right-header">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<a class="menu-toggle"><?php _e( 'Menu', 'accesspress-root' ); ?></a>
					<?php wp_nav_menu( array( 
					'theme_location' => 'primary',
					'container'       => '', 
					) ); ?>
				</nav><!-- #site-navigation -->

				<div class="search-icon">
					<a href="javascript:void(0)"><i class="fa fa-search"></i></a>

					<div class="search-box">
						<div class="close"> &times; </div>
						<?php get_search_form(); ?>
					</div>
				</div> <!--  search-icon-->
			</div> <!-- right-header -->
			<div id="top" class="hide"> 
				<div class="block">
					<a href="#nav" id="nav-open-btn" class="nav-btn">
						<span class="nav-row"> </span>
						<span class="nav-row"> </span>
						<span class="nav-row"> </span>
					</a>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

<?php
if(is_page('5')){
?>

<div class="page_header_wrap8 clearfix">
<div class="ak-container">


<div class="form">

<span class="note_1">Мы вышлем вам инструкцию<br>по активации сим-карты</span>

<a href="/" class="back">Назад</a>


<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
    <div id="primary" role="complementary">
        <ul>
            <?php dynamic_sidebar( 'primary-widget-area' ); ?>
        </ul>
    </div>
<?php endif; ?>

<span class="per2">Наш менеджер перезвонит Вам <br> за 1 минуту - <span class="blue">00:<span id="min1">59</span></span></span>
</div>


</div>
</div>




<?php
}
?>



<?php
if(is_page('7')){
?>

<div class="page_header_wrap8 clearfix">
<div class="ak-container">


<div class="form2">

<div class="layer"></div>



<ul class="nav">
  <li><a style=" padding-top: 15px;" class="item1">Москва и Московская область</a><span>1999</span>
    <ul>
      <li><a>*4000 минут<br>*4000 СМС<br>*10 Гб Интернета 4G<br>*Абонентская плата 690 рублей/месяц<br><br>*Бесплатная доставка<br><br>Цена подключения 1999 рублей</a></li>
    </ul>
  </li>
  <li><a style=" padding-top: 15px;" class="item2">Москва и Московская область</a><span>999</span>
    <ul>
      <li><a>*Безлимитное количество минут<br>*3000 СМС<br>*15 Гб 4G-интернета <br>*Абонентская плата 1180 рублей/месяц<br><br>*Бесплатная доставка<br>*Подключение со своим номером дополнительно 500 рублей<br><br>Цена подключения 999 рублей</a></li>
    </ul>
  </li>
  <li><a style="padding-top:9px;" class="item3">Звонки по России при нахождении<br>в Московском регионе</a><span>999</span>
<ul>
      <li><a>*Безлимитное количество минут<br>*3000 СМС<br>*15 Гб 4G-интернета <br>*Абонентская плата 1680 рублей/месяц<br><br>*Бесплатная доставка<br>*Подключение со своим номером дополнительно 500 рублей<br><br>Цена подключения 999 рублей</a></li>
    </ul>
</li>
  <li><a style="padding-top:9px;" class="item4">Звонки по России с бесплатным<br>Роумингом по РФ</a><span>999</span>
<ul>
      <li><a>*Безлимитное количество минут<br>*3000 СМС<br>*15 Гб 4G-интернета <br>*Абонентская плата 2800 рублей/месяц<br><br>*Бесплатная доставка<br>*Подключение со своим номером дополнительно 500 рублей<br><br>Цена подключения 999 рублей</a></li>
    </ul>
</li>
  <li style="border-bottom-width:0px;"><a style="padding-top:9px; " class="item5">Звонки по России и Миру с<br>бесплатной связью по России</a><span>999</span>
<ul>
      <li><a>*Безлимитное кол-во минут по Москве и МО и по России, находясь в любой точке России<br>*2450 минут для звонков в любые страны мира, находясь в Московском регионе<br>*6000 СМС<br>*20 Гб 4G-интернета <br><br>*Бесплатная доставка<br>*Подключение со своим номером дополнительно<br>500 рублей<br><br>Цена подключения<br>999 рублей</a></li>
    </ul>
</li>
</ul>






<span class="note_1">Мы вышлем вам инструкцию<br>по активации сим-карты</span>
<a href="/" class="back">Назад</a>

<?php if ( is_active_sidebar( 'primary-widget-area2' ) ) : ?>
    <div id="primary" role="complementary">
        <ul>
            <?php dynamic_sidebar( 'primary-widget-area2' ); ?>
        </ul>
    </div>
<?php endif; ?>


<span class="per2">Наш менеджер перезвонит Вам <br> за 1 минуту - <span class="blue">00:<span id="min1">59</span></span></span>
</div>


</div>
</div>




<?php
}
?>





	<nav id="nav" role="navigation" class="hide"> 
		<div class="block">
			<?php wp_nav_menu( array( 
			'theme_location' => 'primary',
			'container'       => '', 
			) ); ?>
			<a href="#top" id="nav-close-btn" class="close-btn">&times;</a>
		</div>
	</nav><!-- #site-navigation -->

	<div id="content" class="site-content">
	<?php 
	if(is_home() || is_front_page()) :
		do_action('accesspress_bxslider'); 
	endif;
	?>