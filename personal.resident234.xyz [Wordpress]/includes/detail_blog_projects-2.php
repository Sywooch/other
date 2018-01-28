


<section id="news" style="border-bottom: 1px solid #e5e5e5;">
    <div class="container">
        <div class="row">
            <div
                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center margin-ten-bottom">
                <div class="vc-column-innner-wrapper"><h3
                            class="section-title  margin-one-bottom no-padding" style=" color:#7f7f7f; ">
                        Проекты</h3>
                    <h1 class="section-title  black-text no-padding">Прочие реализованные проекты</h1></div>
            </div>

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
            ?>

            <div
                    class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 xs-margin-ten-bottom">
                <div class="vc-column-innner-wrapper">
                    <div
                            class="post-10469 post type-post status-publish format-standard has-post-thumbnail hentry category-sample">
                        <div class="blog-post">
                            <div class="blog-image"><a
                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>">
                                    <img
                                            width="800" height="500"
                                            src=""
                                            data-image="<?php echo $thumb_url[0]; ?>"
                                            class="attachment-full size-full wp-post-image js-img" alt="" title=""
                                            srcset="<?php echo $thumb_url[0]; ?> 800w,
                                                        <?php echo $thumb_url[0]; ?> 300w,
                                                        <?php echo $thumb_url[0]; ?> 768w,
                                                        <?php echo $thumb_url[0]; ?> 133w,
                                                        <?php echo $thumb_url[0]; ?> 374w"
                                            sizes="(max-width: 800px) 100vw, 800px"/></a></div>
                            <div class="post-details"><a
                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                        class="post-title sm-margin-top-ten xs-no-margin-top entry-title">
                                    <?php echo $post->post_title; ?>
                                </a><span
                                        class="post-author light-gray-text2 author vcard">
                                    <?php echo implode(" | ", $arCurrentPostTagsNames); ?>
                                </span>
                                <p class="entry-content">
                                    <?php
                                    $post_content = preg_replace("/\\[.+\\]/m","",
                                        $post->post_content);
                                    //$post_content = str_replace("\n","<br>",
                                    //    $post_content);

                                    echo kama_excerpt( array('text'=>$post_content,
                                        'maxchar'=>500,
                                        'autop' => false) );

                                    ?>
                                </p></div>
                        </div>
                    </div>
                </div>
            </div>

                <?php
                if($i == 3) break;
                $i++;
            }

            wp_reset_postdata(); // сброс
            ?>
        </div>
    </div>
</section>

