<?php
/*
    @package Skeletos
*/
?>



    <div id="main">


        <div id="content" class="column" role="main">




            <?php


            $categories = get_the_category();
            $category_id = $categories[0]->cat_ID;

            $currentPostId = get_the_ID();
            $arCategoriesSidebar = array("5", "6", "8");

            if( in_array($category_id, $arCategoriesSidebar) ) {
                ?>

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

                                                $tmpCurrentClass = "";

                                                if($post->ID == $currentPostId){ $tmpCurrentClass = "current"; };


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

                <h1 class="title" id="page-title"><span><?php the_title(); ?></span></h1>

                <article class="node-17264 node node-post view-mode-full clearfix" about="" typeof="sioc:Item foaf:Document">

                    <header>
                        <span property="dc:title" content="Снова в экспедицию" class="rdf-meta element-hidden"></span>
                        <p class="submitted">
                    <span property="dc:date dc:created" content="2016-10-07T00:00:00+03:00" datatype="xsd:dateTime"
                          rel="sioc:has_creator"><time pubdate=""><?php the_time(get_option('date_format')); ?></time></span>
                        </p>

                    </header>





                    <!---content--->
                    <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                        <div class="field-items">
                            <div class="field-item even" property="content:encoded">
                                <?php

                                $categories = get_the_category();


                                $category_id = $categories[0]->cat_ID;
                                if($category_id == "6"){

                                    $content = get_the_content();



                                    $content = preg_replace('/<a href=(\S*)>(.*?)<\/a>/', '<a href=$1 target="_blank">$2</a>', $content);

                                    $pattern = "~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|)\.pdf~";
                                    $patternDoc = "~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|)\.doc~";
                                    $patternDocx = "~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|)\.docx~";
                                    $patternRtf = "~(http|https|ftp|ftps)://(.*?)(\s|\n|[,.?!](\s|\n)|)\.rtf~";


                                    //$content = preg_replace($pattern, 'http://docs.google.com/viewer?url=$1://$2', $content);

                                    //$pattern = "(https?):\/\/(.*?)(\s|\n|[,.?!](\s|\n)|)\.pdf";
                                    $content = preg_replace($pattern, 'http://docs.google.com/viewer?url=$1://$2.pdf', $content);
                                    $content = preg_replace($patternDoc, 'http://docs.google.com/viewer?url=$1://$2.doc', $content);
                                    $content = preg_replace($patternDocx, 'http://docs.google.com/viewer?url=$1://$2.docx', $content);
                                    $content = preg_replace($patternRtf, 'http://docs.google.com/viewer?url=$1://$2.rtf', $content);

                                    echo $content;
                                }else{
                                    the_content();
                                }
                                ?>


                             

                            </div>
                        </div>
                    </div>



                </article>
            </div>

        </div><!-- /#content -->

        <div id="navigation">



        </div><!-- /#navigation -->




    </div>



<?php /* ?>

<article <?php post_class(); ?>>

    <?php get_template_part('partials/featured-image', get_post_format()); ?>

    <header>

        <h1 class="page-title"><?php the_title(); ?></h1>

        <p class="date">
            posted by: <?php the_author_link(); ?><br />
            <time datetime="<?php the_time('c'); ?>"><?php the_time(get_option('date_format')); ?></time><br />
            <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;' ); ?>
        </p>

    </header>

    <?php

    the_content();

    get_template_part('partials/meta', get_post_format());

    comments_template();

    ?>

</article>

<?php */ ?>