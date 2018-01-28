<section id="portfolio" class="  no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                <div class="vc-column-innner-wrapper"><h3 class="section-title  black-text no-padding">
                        Последние проекты</h3></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-three">
                <div class="vc-column-innner-wrapper">
                    <h4 class="gray-text"><?php echo $currentDetailTitle[0]; ?></h4></div>
            </div>
            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                <div class="vc-column-innner-wrapper">
                    <div class="col-md-12 text-center">
                        <div class="text-center">
                            <ul class="portfolio-filter nav nav-tabs nav-tabs-black wow fadeInUp"
                                style="height:auto; padding-bottom:20px;">
                                <?php
                                include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_filter.php';
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="work-4col masonry wide ">
                        <div class="col-md-12  grid-gallery overflow-hidden no-padding content-section">
                            <div class="tab-content">
                                <ul class="grid masonry-items "
                                >


                                    <?php
                                    include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery_new_first.php';
                                    ?>


                                    <?php


                                    $thumb_id = get_post_thumbnail_id($arNewProjects[0]->ID);
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

                                    $arPostTags = wp_get_post_tags($arNewProjects[0]->ID);



                                    $filename = $thumb_url[0];
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($thumb_url[0],
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        800, 600);

                                    ?>


                                    <li class="
                                                      <?php
                                    foreach ($arPostTags as $keyTag => $tag) {
                                        echo " portfolio-filter-".$tag->term_id;

                                    }
                                    ?>">
                                        <figure>
                                            <div class="gallery-img js-gallery-img">
                                                <a
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[0]->ID; ?>"
                                                        class="" target="">
                                                    <img alt=""
                                                         data-image="<?php echo $fileNew; ?>"
                                                         src="<?php echo $fileNew; ?>"
                                                         width="800"
                                                         height="600"/></a></div>
                                            <figcaption><h3><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[0]->ID; ?>"
                                                            class="" target=""><?php echo $arNewProjects[0]->post_title; ?></a></h3>
                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                        </figure>
                                    </li>


                                    <?php


                                    $thumb_id = get_post_thumbnail_id($arNewProjects[4]->ID);
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

                                    $arPostTags = wp_get_post_tags($arNewProjects[4]->ID);



                                    $filename = $thumb_url[0];
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($thumb_url[0],
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        800, 1200);

                                    ?>


                                    <li class="<?php
                                    foreach ($arPostTags as $keyTag => $tag) {
                                        echo " portfolio-filter-".$tag->term_id;

                                    }
                                    ?>">
                                        <figure>
                                            <div class="gallery-img"><a
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[4]->ID; ?>"
                                                        class="" target=""><img alt=""
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                src="<?php echo $fileNew; ?>"
                                                                                width="800" height="1200"/></a>
                                            </div>
                                            <figcaption><h3><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[4]->ID; ?>"
                                                            class="" target=""><?php echo $arNewProjects[4]->post_title; ?></a></h3>
                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                        </figure>
                                    </li>

                                    <?php


                                    $thumb_id = get_post_thumbnail_id($arNewProjects[5]->ID);
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

                                    $arPostTags = wp_get_post_tags($arNewProjects[5]->ID);



                                    $filename = $thumb_url[0];
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($thumb_url[0],
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        800, 600);

                                    ?>

                                    <li class="<?php
                                    foreach ($arPostTags as $keyTag => $tag) {
                                        echo " portfolio-filter-".$tag->term_id;

                                    }
                                    ?>">
                                        <figure>
                                            <div class="gallery-img"><a
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[5]->ID; ?>"
                                                        class="" target=""><img alt=""
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                src="<?php echo $fileNew; ?>"
                                                                                width="800"
                                                                                height="600"/></a></div>
                                            <figcaption><h3><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[5]->ID; ?>"
                                                            class="" target=""><?php echo $arNewProjects[5]->post_title; ?></a></h3>
                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                        </figure>
                                    </li>

                                    <?php


                                    $thumb_id = get_post_thumbnail_id($arNewProjects[1]->ID);
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

                                    $arPostTags = wp_get_post_tags($arNewProjects[1]->ID);



                                    $filename = $thumb_url[0];
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($thumb_url[0],
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        800, 1200);

                                    ?>

                                    <li class="<?php
                                    foreach ($arPostTags as $keyTag => $tag) {
                                        echo " portfolio-filter-".$tag->term_id;

                                    }
                                    ?>">
                                        <figure>
                                            <div class="gallery-img"><a
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[1]->ID; ?>"
                                                        class="" target=""><img alt=""
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                src="<?php echo $fileNew; ?>"
                                                                                width="800" height="1200"/></a>
                                            </div>
                                            <figcaption><h3><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[1]->ID; ?>"
                                                            class="" target=""><?php echo $arNewProjects[1]->post_title; ?></a></h3>
                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                        </figure>
                                    </li>

                                    <?php


                                    $thumb_id = get_post_thumbnail_id($arNewProjects[2]->ID);
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

                                    $arPostTags = wp_get_post_tags($arNewProjects[2]->ID);



                                    $filename = $thumb_url[0];
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($thumb_url[0],
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        800, 600);

                                    ?>

                                    <li class="<?php
                                    foreach ($arPostTags as $keyTag => $tag) {
                                        echo " portfolio-filter-".$tag->term_id;

                                    }
                                    ?>">
                                        <figure>
                                            <div class="gallery-img"><a
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[2]->ID; ?>"
                                                        class="" target=""><img alt=""
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                src="<?php echo $fileNew; ?>"
                                                                                width="800"
                                                                                height="600"/></a></div>
                                            <figcaption><h3><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[2]->ID; ?>"
                                                            class="" target=""><?php echo $arNewProjects[2]->post_title; ?></a></h3>
                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                        </figure>
                                    </li>

                                    <?php


                                    $thumb_id = get_post_thumbnail_id($arNewProjects[3]->ID);
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

                                    $arPostTags = wp_get_post_tags($arNewProjects[3]->ID);



                                    $filename = $thumb_url[0];
                                    $new_filen = $_SERVER["DOCUMENT_ROOT"].'/wp-content/uploads/' . basename($filename);


                                    $fileNew = "/wp-content/uploads/" . basename($filename);

                                    $fileNew = cropImage($thumb_url[0],
                                        $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                        800, 600);

                                    ?>

                                    <li class="<?php
                                    foreach ($arPostTags as $keyTag => $tag) {
                                        echo " portfolio-filter-".$tag->term_id;

                                    }
                                    ?>">
                                        <figure>
                                            <div class="gallery-img"><a
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[3]->ID; ?>"
                                                        class="" target=""><img alt=""
                                                                                data-image="<?php echo $fileNew; ?>"
                                                                                src="<?php echo $fileNew; ?>"
                                                                                width="800"
                                                                                height="600"/></a></div>
                                            <figcaption><h3><a
                                                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $arNewProjects[3]->ID; ?>"
                                                            class="" target=""><?php echo $arNewProjects[3]->post_title; ?></a></h3>
                                                <p><?php displayRandomElement($arPostTagsNames); ?></p></figcaption>
                                        </figure>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



