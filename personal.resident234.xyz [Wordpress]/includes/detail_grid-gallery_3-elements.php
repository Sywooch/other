
<section class="clear-both no-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center"><h3 class="section-title">Реализованные проекты</h3></div>
            <div class="work-3col gutter work-with-title ipad-3col">
                <div class="col-md-12 grid-gallery overflow-hidden content-section">
                    <div class="tab-content">
                        <ul class="grid masonry-items">

                            <?php
                            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
                            ?>
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

                                $fileNew = cropImage($filename,
                                    $_SERVER['DOCUMENT_ROOT'] . $fileNew,
                                    374, 234);
                                ?>

                                <li class="portfolio-id-14579 post-14579 portfolio type-portfolio status-publish
                            format-standard has-post-thumbnail hentry portfolio-category-sample portfolio-tags-both-sidebar">
                                    <figure>
                                        <div class="gallery-img"><a
                                                    href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"><img
                                                        src="" class="js-img" data-image="<?php echo $fileNew; ?>"
                                                        width="374" height="234" alt=""/></a></div>
                                        <figcaption><h3 class="entry-title"><a
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                                                    <?php echo $post->post_title; ?>
                                                </a></h3>
                                            <p><?php echo implode(" ", $arCurrentPostTagsNames); ?></p>
                                        </figcaption>
                                    </figure>
                                </li>

                                <?php
                                if($i == 3) break;
                                $i++;

                            }
                            ?>



                            <?php

                            wp_reset_postdata(); // сброс
                            ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

