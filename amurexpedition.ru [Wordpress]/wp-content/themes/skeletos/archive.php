<?php
/*
    @package Skeletos
*/
get_header(); ?>




<!-------==========================================---------->


<div class="ss-page-content has-sidebar"><div class="wrapper clearfix">
    <div id="main">

        <div id="content" class="column" role="main">




            <div id="block-views-articles-articles-feed" class="block block-views last even">


                <div class="view view-articles view-id-articles view-display-id-articles_feed view-dom-id-62b7bf7d28a918708fcb2a1cd2debf5a">





                <?php

    $archive_title = 'Новости';

    if (is_day()) {

        $archive_title = 'Daily Archives: ' . get_the_date();

    } elseif (is_month()) {

        $archive_title =  'Monthly Archives: ' . get_the_date('F Y');

    } elseif (is_year()) {

        $archive_title =  'Yearly Archives: ' . get_the_date('Y');

    } else if (is_category()) {

        $archive_title = 'Category: ' . single_cat_title('', false);

    } else if (is_tag()) {

        $archive_title = 'Tag: ' . single_cat_title('', false);

    }

    $current_category = single_cat_title('', false);




    ?>

    <main class="ss-page-main" role="main">


<?php
$categories = get_the_category();
$category_id = $categories[0]->cat_ID;
$arCategoriesSidebar = array("5", "6", "8");
$currentPostId = get_the_ID();

if(in_array($category_id, $arCategoriesSidebar)) {
    ?>

    <!-- left menu -->
    <aside class="sidebars" style='float:left; width:25%;';>
        <section class="region region-sidebar-first column sidebar">
            <div id="block-views-menu-side-menu-side-reg" class="block block-views first last odd">


                <div
                    class="view view-menu-side view-id-menu_side view-display-id-menu_side_reg view-dom-id-22096a5f6076d23393dbf859e0afc2dd">


                    <div class="view-content">
                        <div class="item-list tmp1">
                            <ul>
                            <?php
                            /*
                                while (have_posts()) { the_post(); ?>
                                
                                    <li class="views-row-odd views-row-first tid-1839">
                                        <a href="<?php the_permalink() ?>"><?php the_title(); ?><span></span></a></li>
                                <?
                                }*/
                            ?>



                                <?php
                                $args = array(
                                    'numberposts' => 100,
                                    'category'    => $category_id,
                                    'orderby'     => 'name',
                                    'order'       => 'ASC',
                                    'include'     => array(),
                                    'exclude'     => array(),
                                    'meta_key'    => '',
                                    'meta_value'  =>'',
                                    'post_type'   => 'post',
                                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                                );

                                $posts = get_posts( $args );

                                foreach($posts as $post){ setup_postdata($post);
                                    //echo "<pre>";
                                    //print_r($post);
                                    //echo "</pre>"; //'.$post["post_title"].' ID

                                    $tmpCurrentClass = "";
                                    //if($post->ID == $currentPostId){ $tmpCurrentClass = "current"; };


                                    echo '<li class="views-row-odd views-row-first '.$tmpCurrentClass.'">
                                                       <a href="'.get_permalink($post->ID).'"><span>'.$post->post_title.'</span></a></li>';

                                    // формат вывода
                                }

                                wp_reset_postdata(); // сброс



                                /*while (have_posts()) { ?>


                                    <?
                                }*/
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
}
        ?>




<div <?php if(in_array($category_id, $arCategoriesSidebar)){ echo " style=\"float:right; width:74%;\"  "; }; ?> >
    <?php

    if(empty($current_category)){ $current_category = $archive_title; }

    echo '<h1 class="title" id="page-title"><span>'.$current_category.'</span></h1>';

    if (have_posts() ){

        while (have_posts() ){

            the_post();

            get_template_part('partials/excerpt', get_post_format());

        } //end while

        get_template_part('partials/pagination', get_post_format());



    } else {

        get_template_part('partials/404', get_post_format());

    } //end if  ?>

</div>






    </main><!--/end ss-page-main-->




        </div>
    </div>









    </div>
    </div>
<?php //get_sidebar(); ?>
</div></div><!--/end ss-page-content-->
<?php get_footer(); ?>
