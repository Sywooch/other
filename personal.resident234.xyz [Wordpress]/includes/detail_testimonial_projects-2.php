<section class="  fix-background wow fadeIn  js-background"
         style=" background-image: url(); "
         data-image="<?php displayRandomElement($currentBackgroundImage); ?>">
    <div class="selection-overlay" style=" opacity:0.8; background-color:#252525;"></div>
    <div class="container">
        <div class="row">
            <div
                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 center-col wow fadeIn">
                <div class="vc-column-innner-wrapper">
                    <div class="testimonial-slider position-relative no-transition">
                        <div id="hcode-testimonial"
                             class="owl-pagination-bottom position-relative  round-pagination light-pagination white-cursor">




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
                            $new_filen = $_SERVER["DOCUMENT_ROOT"] . '/wp-content/uploads/' . basename($filename);

                            $height = 300;
                            $width = 300;

                            $fileNew = "/wp-content/uploads/" . basename($filename);


                            $fileNew = cropImage($filename,
                                $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                $width, $height);


                            $arPostTags = wp_get_post_tags($post->ID);
                            ?>

                            <div
                                    class="col-md-12 col-sm-12 col-xs-12 testimonial-style2 center-col text-center margin-three no-margin-top">
                                <img alt=""
                                     src="<?php echo $fileNew; ?>"
                                     width="300" height="300">
                                <p class="text-med white-text">
                                    <?php
                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                        $post->post_content);
                                    //$post_content = str_replace("\n","<br>",
                                    //    $post_content);

                                    echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>1500,
                                        'autop' => false) );

                                    ?>
                                </p> <span class="name light-gray-text2" style="color:#ffffff">
                                     <?php echo $post->post_title; ?>
                                </span><i
                                        class="fa fa-quote-left small-icon display-block margin-five
                                        no-margin-bottom"
                                        style="color:#e6af2a"></i></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <script type="text/javascript">/*<![CDATA[*/
                        jQuery(document).ready(function () {
                            jQuery("#hcode-testimonial").owlCarousel({
                                pagination: true,
                                singleItem: true,
                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                            });
                        });
                        /*]]>*/</script>
                </div>
            </div>
        </div>
    </div>
</section>

