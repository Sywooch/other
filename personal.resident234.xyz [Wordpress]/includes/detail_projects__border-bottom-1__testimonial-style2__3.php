<section style="border-top: 1px solid #e5e5e5;">
    <div class="container">
        <div class="row">

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
            ?>

            <?php
            $i = 0;
            foreach ($posts as $post) {

                $private = get_post_meta($post->ID, 'PRIVATE');

                //?mode=private
                if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                    ($private[0] == "1")
                ) {
                    continue;
                }

                setup_postdata($post);

                ?>

                <?php
                $thumb_id = get_post_thumbnail_id($post->ID);
                $thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
                    false);

                $thumb_url[0] = str_replace(get_site_url(),
                    PORTFOLIO_WP_URL,
                    $thumb_url[0]);

                $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'large',
                    false);
                $thumb_url_medium[0] = str_replace(get_site_url(),
                    PORTFOLIO_WP_URL,
                    $thumb_url_medium[0]);

                $arPostTags = wp_get_post_tags($post->ID);

                unset($arCurrentPostTagsNames);
                foreach ($arPostTags as $tag){
                    $arCurrentPostTagsNames[] = $tag->name;
                }



                $filename = $thumb_url[0];
                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                $fileNew = "/wp-content/uploads/" . basename($filename);

                $fileNew = cropImage($thumb_url[0],
                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                    300, 300);

                ?>




                <div
                        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom wow zoomInUp">
                    <div class="vc-column-innner-wrapper">
                        <div class="testimonial-style2"><img
                                    class="js-img" alt=""
                                    data-image="<?php echo $fileNew; ?>"
                                    width="300" height="300"/>
                            <p class="center-col width-90">
                                <?php
                                $post_content = preg_replace("/\\[.+\\]/m","",
                                    $post->post_content);
                                //$post_content = str_replace("\n","<br>",
                                //    $post_content);

                                echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                                    'autop' => false) );

                                ?>
                            </p>
                            <span class="name light-gray-text2"
                                  style="color:#000000;"><?php echo $post->post_title; ?></span><i
                                    class="fa fa-quote-left small-icon display-block margin-five
                                    no-margin-bottom"
                                    style="color:#e6af2a;"></i></div>
                    </div>
                </div>

                <?php
                if($i == 2) break;
                $i++;

            }
            ?>



            <?php

            wp_reset_postdata(); // сброс
            ?>




        </div>
    </div>
</section>


				