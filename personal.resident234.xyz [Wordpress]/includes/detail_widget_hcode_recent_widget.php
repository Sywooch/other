<div id="hcode_recent_widget-14" class="widget widget_hcode_recent_widget"><h5
            class="widget-title font-alt">Другие проекты</h5>
    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
    <div class="widget-body">
        <ul class="widget-posts">


            <?php
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

                $height = 767;
                $width = 767;
                $fileNew767w = "/wp-content/uploads/" . basename($filename);
                $fileNew767w = cropImage($filename,
                    $_SERVER['DOCUMENT_ROOT'] . $fileNew767w,
                    $width, $height);


                $height = 150;
                $width = 150;
                $fileNew150w = "/wp-content/uploads/" . basename($filename);
                $fileNew150w = cropImage($filename,
                    $_SERVER['DOCUMENT_ROOT'] . $fileNew150w,
                    $width, $height);


                $height = 300;
                $width = 300;
                $fileNew300w = "/wp-content/uploads/" . basename($filename);
                $fileNew300w = cropImage($filename,
                    $_SERVER['DOCUMENT_ROOT'] . $fileNew300w,
                    $width, $height);

                ?>




                <li class="clearfix">
                    <a
                            href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                        <img
                                width="767" height="767"
                                src="<?php echo $fileNew767w; ?>"
                                class="attachment-full size-full wp-post-image" alt=""
                                srcset="<?php echo $fileNew767w; ?> 767w,
                                                <?php echo $fileNew150w; ?> 150w,
                                                <?php echo $fileNew300w; ?> 300w"
                                sizes="(max-width: 767px) 100vw, 767px"/></a>
                    <div class="widget-posts-details"><a
                                href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                            <?php echo $post->post_title; ?>
                        </a>
                        <?php echo implode(" , ", $arPostTagsNamesWidget); ?>

                    </div>
                </li>


                <?php
                if($keyPost == 5) break;

            }
            ?>




        </ul>
    </div>
</div>

