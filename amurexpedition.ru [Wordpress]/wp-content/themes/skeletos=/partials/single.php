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
                                       <div class="item-list">
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
                                                   //echo "<pre>";
                                                   //print_r($post);
                                                   //echo "</pre>"; //'.$post["post_title"].' ID

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


           <!--
            <div class="view view-headimage-node view-id-headimage_node view-display-id-entity_view_1
            view-dom-id-3d318dd3d14ab64c6e259563f3af5741">




                <div class="view-content">

                    <div class="skin-default">

                        <div id="views_slideshow_cycle_main_headimage_node-entity_view_1" class="views_slideshow_cycle_main views_slideshow_main viewsSlideshowCycle-processed"><div id="views_slideshow_cycle_teaser_section_headimage_node-entity_view_1" class="views-slideshow-cycle-main-frame views_slideshow_cycle_teaser_section">
                                <div id="views_slideshow_cycle_div_headimage_node-entity_view_1_0" class="views-slideshow-cycle-main-frame-row views_slideshow_cycle_slide views_slideshow_slide views-row-1 views-row-odd">
                                    <div class="views-slideshow-cycle-main-frame-row-item views-row views-row-0 views-row-odd views-row-first">

                                        <div class="views-field views-field-field-headimage">        <div class="field-content">

                                                <div style="display:none;"><?php $newId = the_ID();
                                                    //$image = the_post_thumbnail_url( 'medium' );
                                                    $image = get_the_post_thumbnail($newId, 'full');
                                                    ?></div>


                                                <?php


                                                if($image == ""){
                                                  /*  echo '<img typeof="foaf:Image"
                     src="/wp-content/uploads/2016/12/noimage.gif"
                     width="225" height="150" alt="" title="">';
                                                   */
                                                }else{
                                                    echo $image;
                                                };
                                                ?>


                                                <?php
                                                if($image != "") {
                                                    ?>
                                                    <div class="image-title">Фото предоставлено Амурским областным
                                                        отделением РГО
                                                    </div>
                                                    <?php
                                                }
                                                    ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            -->


            <!---content--->
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
                <div class="field-items">
                    <div class="field-item even" property="content:encoded">
            <?php
            the_content();
            ?>
                    </div>
                </div>
            </div>
            <!--
            <div class="field field-name-body field-type-text-with-summary field-label-hidden">
            <div class="field-items">
            <div class="field-item even" property="content:encoded">


            <p>7 октября стартовал последний в этом экспедиционном году или, как предпочитают говорить путешественники - крайний, полевой маршрут Верхне-Амурской партии Амурской бассейновой комплексной экспедиции Русского географического общества.</p>
                        <p>Полевой маршрут пройдет в форме водного сплава по реке Бурее между створами Бурейской ГЭС и Нижне-Бурейской ГЭС. Основная задача маршрута - съемка материалов для документального фильма об участке долины реки Буреи, который в ближайшем будущем уйдет под воду и станет акваторией Нижне-Бурейского водохранилища.</p>
                        <p>
                        </p><div class="media media-element-container media-full_width">
                            <div id="file-77608" class="file file-image file-image-jpeg">
                                <h2 class="element-invisible"><a href="/ru/file/bureya-1-2016-10-07jpeg">bureya_1_2016-10-07.jpeg</a></h2>
                                <div class="content">
                                    <a href="/sites/default/files/styles/full_view/public/media/2016/10/bureya_1_2016-10-07.jpeg?itok=B9QDYESf" title="Фото предоставлено Амурским областным отделением РГО" class="colorbox init-colorbox-processed cboxElement" data-colorbox-gallery="gallery-file-77608-hcvkoL3MW0M"><img class="media-element file-full-width" title="Фото предоставлено Амурским областным отделением РГО" typeof="foaf:Image" src="/sites/default/files/styles/article_full/public/media/2016/10/bureya_1_2016-10-07.jpeg?itok=eaWFlQ4E" alt=""></a><br><div class="field field-name-field-file-image-title-text field-type-text field-label-hidden">
                                        <div class="field-items">
                                            <div class="field-item even">Фото предоставлено Амурским областным отделением РГО</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>&nbsp;</p>
                        <p>Маршрут осуществляется силами Бурейского полевого отряда Экспедиции численностью в 12 человек, в числе которых съемочная группа студии "Регион ТВ" (город Свободный), волонтеры Русского географического общества, действительные члены Русского географического общества.</p>
                        <p>
                        </p><div class="media media-element-container media-full_width">
                            <div id="file-77609" class="file file-image file-image-jpeg">
                                <h2 class="element-invisible"><a href="/ru/file/bureya-2-2016-10-07jpeg">bureya_2_2016-10-07.jpeg</a></h2>
                                <div class="content">
                                    <a href="/sites/default/files/styles/full_view/public/media/2016/10/bureya_2_2016-10-07.jpeg?itok=9pn53rTT" title="Фото предоставлено Амурским областным отделением РГО" class="colorbox init-colorbox-processed cboxElement" data-colorbox-gallery="gallery-file-77609-hcvkoL3MW0M"><img class="media-element file-full-width" title="Фото предоставлено Амурским областным отделением РГО" typeof="foaf:Image" src="/sites/default/files/styles/article_full/public/media/2016/10/bureya_2_2016-10-07.jpeg?itok=48Shwl7z" alt=""></a><br><div class="field field-name-field-file-image-title-text field-type-text field-label-hidden">
                                        <div class="field-items">
                                            <div class="field-item even">Фото предоставлено Амурским областным отделением РГО</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p>&nbsp;</p>
                        <p>Работе отряда оказывают поддержку&nbsp;Министерство внутренней и информационной политики Амурской области, Администрация Бурейского района Амурской области, акционерное общество "Нижне-Бурейская ГЭС" ПАО "РусГидро".</p>
                    </div></div></div>
-->



            <!---content--->




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