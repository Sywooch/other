<?php
/*
    @package Skeletos
*/

get_header();
?>



<?php
if( is_front_page() ) {
    ?>


    <div id="main">


        <div id="content" class="column" role="main">



            <?php
            echo do_shortcode("[metaslider id=231]");
            ?>



            <a id="main-content"></a>



            <div class="term-listing-heading">
                <div id="taxonomy-term-997" class="taxonomy-term vocabulary-regional-category">


                    <div class="content">
                        <div
                            class="view view-headimage-category view-id-headimage_category view-display-id-entity_view_1 view-dom-id-cafe480cd4c2317d371c17d208c1aeb8">


                            <div class="view-content">

                                <div class="skin-default">

                                    <div id="views_slideshow_cycle_main_headimage_category-entity_view_1"
                                         class="views_slideshow_cycle_main views_slideshow_main">
                                        <div id="views_slideshow_cycle_teaser_section_headimage_category-entity_view_1"
                                             class="views-slideshow-cycle-main-frame views_slideshow_cycle_teaser_section">
                                            <div id="views_slideshow_cycle_div_headimage_category-entity_view_1_0"
                                                 class="views-slideshow-cycle-main-frame-row views_slideshow_cycle_slide views_slideshow_slide views-row-1 views-row-odd">
                                                <div
                                                    class="views-slideshow-cycle-main-frame-row-item views-row views-row-0 views-row-odd views-row-first">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
            <div id="block-views-articles-articles-feed" class="block block-views last even">

                <h2 class="block__title block-title"><span>Новости </span></h2>

                <div
                    class="view view-articles view-id-articles view-display-id-articles_feed view-dom-id-876b63ab0d763fd15f50b0dbb23ecc29">


                    <div class="view-content">


                        <?php dynamic_sidebar( 'main-news' ); ?>






                    </div>








                    <div class="item-list" style="text-align: center;">

                        <a href="/news/category/all/">Все новости</a>





                    </div>


                </div>
            </div><!-- /.block -->
        </div><!-- /#content -->

        <div id="navigation">


        </div><!-- /#navigation -->


    </div><!-- /#main -->

    <?php
} else {
    ?>


    <??>
<div class="ss-page-content"><div class="wrapper clearfix">

    <main class="ss-page-main" role="main">













        <div id="main" class="tmp2">




            <?php


            //$categories = get_the_category();
            //$category_id = $categories[0]->cat_ID;


            if ($post->post_parent == 1001 || $post->post_parent == 1041){

                ?>
                <style type="text/css">
                    .menu-item-105 a{
                        background-color:#dc0000;
                    }

                </style>
                <!-- left menu -->
                <aside class="sidebars" style='float:left; width:25%;';>
                    <section class="region region-sidebar-first column sidebar">
                        <div id="block-views-menu-side-menu-side-reg" class="block block-views first last odd">


                            <div
                                class="view view-menu-side view-id-menu_side view-display-id-menu_side_reg view-dom-id-22096a5f6076d23393dbf859e0afc2dd">


                                <div class="view-content">
                                    <div class="item-list tmp3">
                                        <ul>


                                            <?php

                                            $args = array(
                                                'depth'        => 0,
                                                'show_date'    => '',
                                                'date_format'  => get_option('date_format'),
                                                'child_of'     => $post->post_parent,
                                                'exclude'      => '',
                                                'exclude_tree' => '',
                                                'include'      => '',
                                                'title_li'     => "",
                                                'echo'         => 1,
                                                'authors'      => '',
                                                'sort_column'  => 'menu_order, post_title',
                                                'sort_order'   => 'ASC',
                                                'link_before'  => '',
                                                'link_after'   => '',
                                                'meta_key'     => '',
                                                'meta_value'   => '',
                                                'number'       => '',
                                                'offset'       => '',
                                                'walker'       => '',
                                                'post_type'    => 'page', // из функции get_pages()
                                            );

                                            wp_list_pages( $args );



                                            ?>




                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div><!-- /.block -->
                    </section>
                </aside>


                <!-- left menu -->
                <?php


            };

            ?>





            <div id="content" class="column" role="main"
                 <?php  if ($post->post_parent == 1001 || $post->post_parent == 1041){
                  ?> style="width:calc(75% - 10px); float:right; padding-left:0px;padding-right:0px;"
                    <?php } ?>
            >


                <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                    <div class="field-items">
                        <div class="field-item even" property="content:encoded">


    <?php

    while (have_posts()) {

        the_post();

        echo '<h1 class="title" id="page-title">' . get_the_title() . '</h1>';


        ?>


        <?php

        the_content();

    } //end while

    edit_post_link('Edit this entry.', '<p class="clear">', '</p>');
    wp_link_pages();

    ?>
                        </div>
                    </div>
                </div>





            </div>
        </div>

    </main><!--/end ss-page-main-->
</div></div><!--/end ss-page-content-->
<?php  ?>

    <?php
}
    ?>




<?php get_footer(); ?>