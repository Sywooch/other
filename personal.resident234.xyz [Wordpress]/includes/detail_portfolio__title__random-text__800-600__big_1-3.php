<section id="portfolio" class="  no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                <div class="vc-column-innner-wrapper"><h3 class="section-title
                                black-text no-padding">
                        Проекты</h3></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-two-top">
                <div class="vc-column-innner-wrapper"><h4 class="gray-text">
                        <?php echo $currentDetailTitle[0]; ?>
                    </h4></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-xs-mobile-fullwidth col-sm-12 no-padding margin-four-top">
                <div class="vc-column-innner-wrapper">
                    <div class="col-md-12 text-center">
                        <div class="text-center">
                            <ul class="portfolio-filter nav nav-tabs height-auto__bottom-20">
                                <?php
                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="work-4col  ">
                        <div
                                class="col-md-12  no-padding margin-top-20px grid-gallery overflow-hidden
                                            content-section">
                            <div class="tab-content">


                                <?php
                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                                ?>

                                <ul class="grid masonry-items ">
                                    <?php
                                    $i = 1;
                                    foreach ($posts as $post) {

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



                                        $height = 600;
                                        if($i == 1 || $i == 3){
                                            $height = 1200;
                                        }

                                        $width = 800;
                                        $fileNew = "/wp-content/uploads/" . basename($filename);
                                        $fileNew = cropImage($filename,
                                            $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                            $width, $height);

                                        $arPostTags = wp_get_post_tags($post->ID);
                                        unset($arCurrentPostTagsNames);
                                        foreach ($arPostTags as $tag){
                                            $arCurrentPostTagsNames[] = $tag->name;
                                        }
                                        ?>


                                        <li class="<?php
                                        foreach ($arPostTags as $keyTag => $tag) {
                                            echo " portfolio-filter-".$tag->term_id;

                                        }
                                        ?>">
                                            <figure>
                                                <div class="gallery-img"><a
                                                            href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"><img alt=""
                                                                                                                                              src="<?php echo $fileNew; ?>"
                                                                                                                                              width="<?php echo $width; ?>"
                                                                                                                                              height="<?php echo $height; ?>"/></a>
                                                </div>
                                                <figcaption><h3><a
                                                                href="/detail/<?php echo basename(__FILE__); ?>?ID=<?php echo $post->ID; ?>"
                                                        ><?php echo $post->post_title; ?></a></h3>
                                                    <p><?php echo implode(" | ", $arCurrentPostTagsNames); ?></p></figcaption>
                                            </figure>
                                        </li>

                                        <?php

                                        if($i == 6) break;
                                        $i++;
                                    }
                                    ?>
                                </ul>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>