<?php
/*
    @package Skeletos
*/
?>

<? /* ?>
<div class="entry">

    <article <?php post_class(); ?>>

        <header>

            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

            <p class="date">
                posted by: <?php the_author_link(); ?><br />
                <a href="<?php the_permalink(); ?>"><time datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time></a><br />
                <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
            </p>

        </header>

        <?php the_excerpt(); ?>

        <?php get_template_part('partials/meta', get_post_format()); ?>

    </article><!--/end article-->

</div><!--/end .entry-->
<? */ ?>




<?php
$getcat = get_the_category();
$catId = $getcat[0]->cat_ID;
//echo $catId;
?>

<div class="views-row views-row-1 views-row-odd views-row-first clearfix">

    <div class="views-field views-field-field-headimage">
        <div class="field-content">
            <a href="<?php the_permalink(); ?>">
                <!--<img typeof="foaf:Image"
                     src="https://www.rgo.ru/sites/default/files/styles/galleries_feed/public/node/17264/bureya-3-2016-10-07.jpeg"
                     width="225" height="150" alt="" title="Фото предоставлено Амурским областным отделением РГО">-->
                <div style="display:none;"><?php $newId = the_ID();
                    //$image = the_post_thumbnail_url( 'medium' );
                    $image = get_the_post_thumbnail($newId, 'medium');
                    ?></div>


                <?php
               
                if($catId != 5 && $catId != 6){
                    if($image == ""){
                        echo '<img typeof="foaf:Image"
                         src="/wp-content/uploads/2016/12/noimage.gif"
                         width="225" height="150" alt="" title="">';

                    }else{
                        echo $image;
                    };
                }
                ?>
            </a>
        </div>
    </div>
    <div class="views-field views-field-field-event-datetime">
        <div class="field-content"><?php the_time(get_option('date_format')); ?></div>
    </div>
    <div class="views-field views-field-title">
        <span class="field-content"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
    </div>


<?php
if($catId != 6){
?>
    <div class="views-field views-field-body">
        <div class="field-content">
            <p><?php the_excerpt(); ?></p>

        </div>
    </div>
    <?php
}
    ?>


    <div class="views-field views-field-php-1">        <span class="field-content"></span>  </div>
    <div class="views-field views-field-php-2">        <span class="field-content">
</span>  </div>  </div>

