
<section class=" " style=" background-color:#000000; ">
    <div class="container">
        <div class="row">



            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
            ?>


            <?php
            $i = 1;
            foreach ($posts as $keyPost => $post) {

                $private = get_post_meta($post->ID, 'PRIVATE');

                //?mode=private
                if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                    ($private[0] == "1")
                ) {
                    continue;
                }

                setup_postdata($post);

                //$arPostTags = wp_get_post_tags($post->ID);

                $arPostTagsWidget = wp_get_post_tags($post->ID);
                unset($arPostTagsNamesWidget);
                foreach ($arPostTagsWidget as $keyTag => $tag) {
                    //$postTagId = $tag->term_id;
                    $arPostTagsNamesWidget[] = $tag->name;

                }


                $thumb_id = get_post_thumbnail_id($post->ID);
                $thumb_url = wp_get_attachment_image_src($thumb_id, 'thumbnail',
                    false);

                $thumb_url[0] = str_replace(get_site_url(),
                    PORTFOLIO_WP_URL,
                    $thumb_url[0]);


                $thumb_url_medium = wp_get_attachment_image_src($thumb_id, 'medium',
                    false);

                $thumb_url_medium[0] = str_replace(get_site_url(),
                    PORTFOLIO_WP_URL,
                    $thumb_url_medium[0]);


                $thumb_url_full = wp_get_attachment_image_src($thumb_id, 'full',
                    false);

                $thumb_url_full[0] = str_replace(get_site_url(),
                    PORTFOLIO_WP_URL,
                    $thumb_url_full[0]);



                $filename = $thumb_url_full[0];
                $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);

                $height = 89;

                $width = 350;

                $fileNew = "/wp-content/uploads/" . basename($filename);


                $fileNew = cropImage($filename,
                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                    $width, $height);


                $arPostTags = wp_get_post_tags($post->ID);
                ?>



                <div class="wpb_column hcode-column-container  col-md-3 col-xs-6 col-sm-3 padding-five-lr">
                    <div class="vc-column-innner-wrapper"><img
                                src="" class="js-img"
                                data-image="<?php echo $fileNew; ?>"
                                width="350" height="89" alt=""></div>
                </div>


                <?php

                if($i == 4) break;
                $i++;
            }
            ?>




        </div>
    </div>
</section>


