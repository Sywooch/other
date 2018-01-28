<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package AccessPress Root
 */

get_header(); 
$single_page_layout = of_get_option('single_page_layout');
?>

<?php
if( (!is_page('5'))&&(!is_page('7')) ){

?>




	<div class="page_header_wrap clearfix">
		<div class="ak-container">


			<h1 class="head1">Подключение безлимитных тарифов<br>для абонентов МТС и Билайн по всей России</h1>
			
			<div class="form1">
				<span class="note1">Много разговариваете по телефону? 
Подключите один из<br>наших тарифов и сэкономьте на общении от 5000 руб. в год. <a href="#head">Посмотреть тарифы</a></span>




<?php if ( is_active_sidebar( 'primary-widget-area3' ) ) : ?>
    <div id="primary" role="complementary">
        <ul>
            <?php dynamic_sidebar( 'primary-widget-area3' ); ?>
        </ul>
    </div>
<?php endif; ?>

<span class="per">ПЕРЕЗВОНИМ ЗА 1 МИНУТУ - 00:<span id="min1">59</span></span>



			</div>

			

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<?php accesspress_breadcrumbs() ?>
		</div>
	</div>
<?php
}
?>

<?php
if( (!is_page('5'))&&(!is_page('7')) ){
?>

	<div class="page_header_wrap2">
		<div class="ak-container">
			<a name="head"></a>
			<h1 class="head1">Выберите безлимитный тариф</h1>
			<div class="block1">
				<span class="note1">Эксклюзивное предложение!</span>
				<span class="note2">БЕЗЛИМИТ ПО МОСКВЕ И МО</span>
				<div class="num1"></div>
				<div class="num2"></div>
				<div class="num3"></div>
				<span class="txt1">МИНУТ<br>SMS<br>В МЕСЯЦ</span>
				<span class="txt2">ГИГАБАЙТ<br>ИНТЕРНЕТА</span>
				<span class="txt3">ВСЕГО ЗА</span>
				<span class="txt4">РУБ</span>
				<span class="txt5">МЕС</span>
				<span class="txt6">+ Безлимитные звонки на MTC по всей Российской Федерации</span>
				<span class="txt7">* данный тариф нельзя подключить на свою сим-карту</span>

				<div class="img1"></div>
				<span class="txt8">Цена снижена до СРЕДЫ!</span>
				<span class="txt9">3600 <span></span></span>
				<span class="txt10">1999 <span></span></span>
				<a href="/?page_id=5"  target="_blank" class="button1">Подключить тариф</a>


			</div>


		<div class="block_tar">
			<div class="left">
				<div class="left1">
					<div class="logo"></div>
					<div class="line"></div>
					<span class="head">Тариф для звонков по Москве и МО</span>
<div class="line2"></div>
<div class="div1">
	<div class="div_left">
		<span class="span1">* Абонентская плата<br>1180 руб/мес с НДС</span>
		<span class="span2">* Бесплатная доставка</span>
		<span class="span3">* Подключение со своим<br>номером дополнительно<br>500 рублей</span>
		<a href="/?page_id=5" class="button"  target="_blank">Подключить тариф</a>	
	</div>
	<div class="div_right">
		<span class="span1">* Безлимитное<br>количество минут</span>
		<span class="span2">* 3000 СМС</span>
		<span class="span3">* 15 Гигабайт<br>4G-интернета</span>	
		<span class="price">999</span>
	</div>
	<div class="link"><a onclick="tar1();" >подробнее от тарифе</a></div>
</div>
				</div>
				<div class="left2">
					<div class="logo"></div>
					<div class="line"></div>
					<span class="head">Тариф для звонков по России<br>при нахождении в Московском регионе</span>
<div class="line2"></div>
<div class="div1">
	<div class="div_left">
		<span class="span1">* Абонентская плата<br>1680 руб/мес с НДС</span>
		<span class="span2">* Бесплатная доставка</span>
		<span class="span3">* Подключение со своим<br>номером дополнительно<br>500 рублей</span>
		<a href="/?page_id=5" class="button" target="_blank">Подключить тариф</a>	
	</div>
	<div class="div_right">
		<span class="span1">* Безлимитное<br>количество минут</span>
		<span class="span2">* 3000 СМС</span>
		<span class="span3">* 15 Гигабайт<br>4G-интернета</span>
		<span class="price">999</span>	
	</div>
	<div class="link"><a onclick="tar2();">подробнее от тарифе</a></div>

</div>
				</div>	
			</div>
			<div class="right">
				<div class="right1">
					<div class="logo"></div>
					<div class="line"></div>
					<span class="head">Тариф для звонков по России<br>с бесплатным Роумингом по РФ</span>
<div class="line2"></div>
<div class="div1">
	<div class="div_left">
		<span class="span1">* Абонентская плата<br>2800 руб/мес с НДС</span>
		<span class="span2">* Бесплатная доставка</span>
		<span class="span3">* Подключение со своим<br>номером дополнительно<br>500 рублей</span>
		<a href="/?page_id=5" class="button" target="_blank">Подключить тариф</a>	
	</div>
	<div class="div_right">
		<span class="span1">* Безлимитное<br>количество минут</span>
		<span class="span2">* 3000 СМС</span>
		<span class="span3">* 15 Гигабайт<br>4G-интернета</span>
		<span class="price">999</span>	
	</div>
	<div class="link"><a onclick="tar3();">подробнее от тарифе</a></div>

</div>
				</div>
				<div class="right2">
					<div class="logo"></div>
					<div class="line"></div>
					<span class="head">Тариф для звонков по России<br>и Миру с бесплатной связью по России</span>
<div class="line2"></div>
<div class="div1">
	<div class="div_left">
		<span class="span1">* Абонентская плата<br>6100 руб/мес с НДС</span>
		<span class="span2">* Бесплатная доставка</span>
		<span class="span3">* Подключение со своим<br>номером дополнительно<br>500 рублей</span>
		<span class="price">999</span>
		<a href="/?page_id=5" class="button" target="_blank">Подключить тариф</a>	
		<div class="link"><a onclick="tar4();">подробнее от тарифе</a></div>
	</div>
	<div class="div_right">
		<span class="span1">* Безлимитное<br>кол-во минут по<br>Москве и МО и по<br>России, находясь в<br>любой точке России</span>
		<span class="span2">* 2450 минут для<br>звонков в любые<br>страны мира,<br>находясь в<br>Московском<br>регионе</span>
		<span class="span3">* 6000 СМС</span>	
		<span class="span4">* 20 Гигабайт<br>4G-интернета</span>
		
	</div>
	

</div>
				</div>
			</div>
				
		</div>



		</div>
	</div>
<?php
}
?>

<?php
if( (!is_page('5'))&&(!is_page('7')) ){
?>

<div class="page_header_wrap3">
	<div class="ak-container">
		<span class="head">Как начать экономить на общении?</span>	
		<div class="block1">
			<div class="b1">
				<span class="span1">01</span>
				<div class="div1"></div>
				<span class="span2">ЗАЯВКА</span>
			</div>
			<div class="b1">
				<span class="span1">02</span>
				<div class="div2"></div>
				<span class="span2">ДОСТАВКА</span>
					
			</div>
			<div class="b1">
				<span class="span1">03</span>
				<div class="div3"></div>
				<span class="span2">АКТИВАЦИЯ</span>
				
			</div>
			<div class="b1">
				<span class="span1">04</span>
				<div class="div4"></div>
				<span class="span2">ЭКОНОМИЯ</span>
			
			</div>
		</div>

		<a href="/?page_id=7"  target="_blank" class="button_2">Оставить заявку</a>
		<span class="span_1">Доставка сим-карты</span>
		<span class="span_2">(или подключение тарифа на вашу)</span>
		<span class="span_3">Экономия денег<br>уже началась</span>
		<span class="span_4">После этих простых шагов, на руках у вас останется сим карта и договор</span>
		<span class="span_5">оплата при получении</span>	

	</div>
</div>

<?php
}
?>

<?php
if( (!is_page('5'))&&(!is_page('7')) ){
?>

<div class="page_header_wrap4">
	<div class="ak-container">
		<div class="div_head">
			<span class="head">Подробнее о</span>
		</div>

		<div class="info">
			<span class="txt1">SkiMobile - компания, помогающая экономить ваши средства на общении через мобильные телефоны. Мы занимаемся подключением безлимитных тарифных планов для абонентов МТС и Билайн по всей России.</span>
			<span class="txt2">Кто наши клиенты.</span>
			<span class="txt3">Вы мужчина или женщина, вам 20 или 45 лет? Не имеет значения. Мы сможем вам помочь сэкономить деньги, если вы подходите под эти 2 простых критерия:</span><span class="txt3_1">1) Вы пользуетесь сим-картой компании МТС или Билайн<br>2) Много общаетесь по мобильному телефону</span>
			<span class="txt4">Каждый клиент, получивший нашу сим-карту или подключивший безлимитный тариф к своей сим-карте, гарантированно получает достойную техническую поддержку.<br>Все тарифные планы вы можете скачать по данной ссылке: <a  href="#head">Тарифные планы</a></span>
<span class="txt5">Возникли вопросы?<br>Получить бесплатную консультацию можно по тел.: 8 (800) 234-44-74<br>или же заказать бесплатную обратную связь</span>

<a href="#top2" class="big_button">ЗАКАЗАТЬ ОБРАТНЫЙ ЗВОНОК</a>
<span class="txt6">Наш менеджер перезвонит вам за 1 минуту: <span class="red">00:59 секунд</span></span>

		</div>

	</div>
</div>






<?php
}
?>


<div id="masthead2" class="page_header_wrap5">
	<div class="ak-container">

<!----------->
<a href="/" class="logo"></a>


<span class="note3">Звоните по РФ<br>Бесплатно</span>
<span class="number">8(800)234-44-74</span>

<!----------->


<div id="site-branding" class="clearfix">
				
			</div><!-- .site-branding -->

			<div class="right-header">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<a class="menu-toggle">Menu</a>
					<ul><li class="page_item page-item-2 current_page_item"><a href="http://landing3/">Пример страницы</a></li></ul>
				</nav><!-- #site-navigation -->

				<div class="search-icon">
					<a href="javascript:void(0)"><i class="fa fa-search"></i></a>

					<div class="search-box">
						<div class="close"> × </div>
							<form method="get" class="searchform" action="http://landing3/" role="search">
		<input type="text" name="s" value="" class="search-field" placeholder="Type something and hit Enter to begin your search...">
        <button type="submit" name="submit" class="searchsubmit"><i class="fa fa-search"></i></button> 
	</form>
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
</div>


	<main id="main" class="site-main clearfix <?php echo $single_page_layout; ?>" style="display:none;">
		<?php if($single_page_layout == 'both-sidebar'): ?>
			<div id="primary-wrap" class="clearfix">
		<?php endif; ?>
		
		<div id="primary" class="content-area">

			<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #primary -->

		<?php 
		if($single_page_layout == 'both-sidebar' || $single_page_layout == 'left-sidebar'): 
			get_sidebar('left');
		endif; 
		?>

		<?php if($single_page_layout == 'both-sidebar'): ?>
			</div>
		<?php endif; ?>
		
		<?php 
		if($single_page_layout == 'both-sidebar' || $single_page_layout == 'right-sidebar'): 
			get_sidebar('right');
		endif; 
		?>
	</main>

 <script type="text/javascript">
jQuery(function($){
   $(".wpcf7-tel").mask("+7(999) 999-99-99");

});
 </script>

 <script type="text/javascript">
$('.tarif1 .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').focus(function(){
$('.tarif1 .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val("");
});

$('.tarif1 .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').blur(function(){
if($('.tarif1 .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val()==""){
$('.tarif1 .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val("Как вас зовут?");
}
});

$('.form2 .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').focus(function(){
$('.form2 .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val("");
});
$('.form2 .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').blur(function(){
if($('.form2 .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val()==""){
$('.form2 .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val("Введите ФИО");
}
});

$('.form .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').focus(function(){
$('.form .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val("");
});
$('.form .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').blur(function(){
if($('.form .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val()==""){
$('.form .wpcf7-form-control-wrap.your-name .wpcf7-form-control.wpcf7-text.wpcf7-validates-as-required').val("Введите ФИО");
}
});


$('.form2 .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').focus(function(){
$('.form2 .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').val("");
});
$('.form2 .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').blur(function(){
if($('.form2 .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').val()==""){
$('.form2 .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').val("Введите адрес доставки");
}
});


$('.form .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').focus(function(){
$('.form .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').val("");
});
$('.form .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').blur(function(){
if($('.form .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').val()==""){
$('.form .wpcf7-form-control-wrap.text-132 .wpcf7-form-control.wpcf7-text').val("Введите адрес доставки");
}
});





$('.form2 .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').focus(function(){
$('.form2 .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').val("");
});
$('.form2 .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').blur(function(){
if($('.form2 .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').val()==""){
$('.form2 .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').val("Введите E-mail");
}
});



$('.form .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').focus(function(){
$('.form .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').val("");
});
$('.form .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').blur(function(){
if($('.form .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').val()==""){
$('.form .wpcf7-form-control-wrap.your-email .wpcf7-form-control.wpcf7-text.wpcf7-email.wpcf7-validates-as-required.wpcf7-validates-as-email').val("Введите E-mail");
}
});


 </script>



<script type="text/javascript">
function tar1(){
$('#fon_tar1').fadeIn(1500);

}
function tar2(){
$('#fon_tar2').fadeIn(1500);

}
function tar3(){
$('#fon_tar3').fadeIn(1500);

}
function tar4(){
$('#fon_tar4').fadeIn(1500);

}

function tar_1(){
$('#fon_tar1').fadeOut(1500);
}

function tar_2(){
$('#fon_tar2').fadeOut(1500);
}

function tar_3(){
$('#fon_tar3').fadeOut(1500);
}

function tar_4(){
$('#fon_tar4').fadeOut(1500);
}
</script>

<script type="text/javascript">
$(document).ready(function(){
$('input[name="tel-983"]').focus();
$('input[name="tel-983"]').blur();
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('input[name="tel-573"]').focus();
$('input[name="tel-573"]').blur();



});
</script>

<script type="text/javascript">
$(document).ready(function(){
$("input:checkbox").attr("checked","checked");
});
</script>


<script type="text/javascript">
$(document).ready(function(){

$('.page_header_wrap8 .form2 .wpcf7-form-control-wrap.menu-593').click(function(){
  $(".page_header_wrap8 .form2 .wpcf7-form-control-wrap.menu-593").css('border', '1px #14b9d6 solid');
$(".page_header_wrap8 .form2 .wpcf7-form-control-wrap.menu-593").css('background-image', 'url(/wp-content/themes/accesspress-root/images/input5_h.png)');
});








//$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').mousedown(function(){
//$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button4_cur.png)');
//$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').css('line-height','60px');
//
//});





$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').mouseup(function(){
$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button4.png)');
$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').css('line-height','50px');

}).mousedown(function(){
$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button4_cur.png)');
$('.page_header_wrap8 .form2 .wpcf7-form-control.wpcf7-submit').css('line-height','60px');

});







//$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').mousedown(function(){
//$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button4_cur.png)');
//$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').css('line-height','60px');
//
//});





$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').mouseup(function(){
$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button4.png)');
$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').css('line-height','50px');

}).mousedown(function(){
$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button4_cur.png)');
$('.page_header_wrap8 .form .wpcf7-form-control.wpcf7-submit').css('line-height','60px');

});






//$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').mousedown(function(){
//$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/pod_cur.png)');
//$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').css('line-height','60px');
//
//});



$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').mouseup(function(){

$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-root/images/pod.png)');
$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').css('line-height','50px');

}).mousedown(function(){

$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').css('background-image', 'url(/wp-content/themes/accesspress-root/images/pod_cur.png)');
$('.page_header_wrap.clearfix .wpcf7-form-control.wpcf7-submit').css('line-height','60px');


});





//$('.page_header_wrap2 .block1 .button1').mousedown(function(){
//$('.page_header_wrap2 .block1 .button1').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button1_cur.png)');
//$('.page_header_wrap2 .block1 .button1').css('line-height','55px');
//
//});




$('.page_header_wrap2 .block1 .button1').mouseup(function(){
$('.page_header_wrap2 .block1 .button1').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button1.png)');
$('.page_header_wrap2 .block1 .button1').css('line-height','44px');

}).mousedown(function(){
$('.page_header_wrap2 .block1 .button1').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button1_cur.png)');
$('.page_header_wrap2 .block1 .button1').css('line-height','55px');

});




//$('.page_header_wrap2 .block_tar .right1 .div_left .button').mousedown(function(){
//$('.page_header_wrap2 .block_tar .right1 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button_cur.png)');
//$('.page_header_wrap2 .block_tar .right1 .div_left .button').css('line-height','45px');
//
//});




$('.page_header_wrap2 .block_tar .right1 .div_left .button').mouseup(function(){
$('.page_header_wrap2 .block_tar .right1 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button.jpg)');
$('.page_header_wrap2 .block_tar .right1 .div_left .button').css('line-height','35px');

}).mousedown(function(){
$('.page_header_wrap2 .block_tar .right1 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button_cur.png)');
$('.page_header_wrap2 .block_tar .right1 .div_left .button').css('line-height','45px');

});





//$('.page_header_wrap2 .block_tar .right2 .div_left .button').mousedown(function(){
//$('.page_header_wrap2 .block_tar .right2 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button_cur.png)');
//$('.page_header_wrap2 .block_tar .right2 .div_left .button').css('line-height','45px');
//
//});




$('.page_header_wrap2 .block_tar .right2 .div_left .button').mouseup(function(){
$('.page_header_wrap2 .block_tar .right2 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button.jpg)');
$('.page_header_wrap2 .block_tar .right2 .div_left .button').css('line-height','35px');

}).mousedown(function(){
$('.page_header_wrap2 .block_tar .right2 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button_cur.png)');
$('.page_header_wrap2 .block_tar .right2 .div_left .button').css('line-height','45px');

});





//$('.page_header_wrap2 .block_tar .left2 .div_left .button').mousedown(function(){
//$('.page_header_wrap2 .block_tar .left2 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button_cur.png)');
//$('.page_header_wrap2 .block_tar .left2 .div_left .button').css('line-height','45px');
//
//});




$('.page_header_wrap2 .block_tar .left2 .div_left .button').mouseup(function(){
$('.page_header_wrap2 .block_tar .left2 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button.jpg)');
$('.page_header_wrap2 .block_tar .left2 .div_left .button').css('line-height','35px');

}).mousedown(function(){
$('.page_header_wrap2 .block_tar .left2 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button_cur.png)');
$('.page_header_wrap2 .block_tar .left2 .div_left .button').css('line-height','45px');

});






//$('.page_header_wrap2 .block_tar .left1 .div_left .button').mousedown(function(){
//$('.page_header_wrap2 .block_tar .left1 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button_cur.png)');
//$('.page_header_wrap2 .block_tar .left1 .div_left .button').css('line-height','35px');
//
//});




$('.page_header_wrap2 .block_tar .left1 .div_left .button').mouseup(function(){
$('.page_header_wrap2 .block_tar .left1 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button.jpg)');
$('.page_header_wrap2 .block_tar .left1 .div_left .button').css('line-height','35px');

}).mousedown(function(){
$('.page_header_wrap2 .block_tar .left1 .div_left .button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button_cur.png)');
$('.page_header_wrap2 .block_tar .left1 .div_left .button').css('line-height','45px');

});






//$('.page_header_wrap3 .ak-container .button_2').mousedown(function(){
//$('.page_header_wrap3 .ak-container .button_2').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button2_cur.png)');
//$('.page_header_wrap3 .ak-container .button_2').css('line-height','55px');
//
//});




$('.page_header_wrap3 .ak-container .button_2').mouseup(function(){
$('.page_header_wrap3 .ak-container .button_2').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button2.png)');
$('.page_header_wrap3 .ak-container .button_2').css('line-height','50px');
}).mousedown(function(){
$('.page_header_wrap3 .ak-container .button_2').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button2_cur.png)');
$('.page_header_wrap3 .ak-container .button_2').css('line-height','55px');
});






//$('.page_header_wrap4 .info .big_button').mousedown(function(){
//$('.page_header_wrap4 .info .big_button').css('background-image', 'url(/wp-content/themes/accesspress-//root/images/button3_cur.png)');
//$('.page_header_wrap4 .info .big_button').css('line-height','65px');
//
//});




$('.page_header_wrap4 .info .big_button').mouseup(function(){
$('.page_header_wrap4 .info .big_button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button3.png)');
$('.page_header_wrap4 .info .big_button').css('line-height','60px');

}).mousedown(function(){
$('.page_header_wrap4 .info .big_button').css('background-image', 'url(/wp-content/themes/accesspress-root/images/button3_cur.png)');
$('.page_header_wrap4 .info .big_button').css('line-height','65px');

});





$('.page_header_wrap8 .form2 .layer').click(function(){

$('.page_header_wrap8 .form2 ul.nav').css('display','block');


});


$('.page_header_wrap8 .form2 ul.nav li a.item1').click(function(){
$('.page_header_wrap8 .form2 ul.nav').css('display','none');
$(".wpcf7-select option[value='МТС - Москва и Московская область']").prop("selected", true);
});

$('.page_header_wrap8 .form2 ul.nav li a.item2').click(function(){
$('.page_header_wrap8 .form2 ul.nav').css('display','none');
$(".wpcf7-select option[value='Билайн - Москва и Московская область']").prop("selected", true);

});

$('.page_header_wrap8 .form2 ul.nav li a.item3').click(function(){
$('.page_header_wrap8 .form2 ul.nav').css('display','none');
$(".wpcf7-select option[value='Билайн - Звонки по России при нахождении в Московском регионе']").prop("selected", true);

});

$('.page_header_wrap8 .form2 ul.nav li a.item4').click(function(){
$('.page_header_wrap8 .form2 ul.nav').css('display','none');
$(".wpcf7-select option[value='Билайн - Звонки по России с бесплатным Роумингом по РФ']").prop("selected", true);

});

$('.page_header_wrap8 .form2 ul.nav li a.item5').click(function(){
$('.page_header_wrap8 .form2 ul.nav').css('display','none');
$(".wpcf7-select option[value='Билайн - Звонки по России и Миру с бесплатной связью по России']").prop("selected", true);

});




});
</script>

<img src="/wp-content/themes/accesspress-root/images/button4_cur.png" style="display:none;"/>
<img src="/wp-content/themes/accesspress-root/images/pod_cur.png" style="display:none;"/>
<img src="/wp-content/themes/accesspress-root/images/button1_cur.png" style="display:none;"/>
<img src="/wp-content/themes/accesspress-root/images/button_cur.png" style="display:none;"/>
<img src="/wp-content/themes/accesspress-root/images/button2_cur.png" style="display:none;"/>
<img src="/wp-content/themes/accesspress-root/images/button3_cur.png" style="display:none;"/>
<?php //get_footer(); ?>