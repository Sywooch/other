<div class="col-md-3 col-sm-4 col-xs-12 col-md-offset-1 xs-margin-top-seven sidebar pull-right">

    <div id="categories-6" class="widget widget_categories">
        <h5 class="widget-title font-alt">
            Разделы
        </h5>
        <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
        <ul>

            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
            ?>

            <?php
            $bestProjectsCount = 0;
            $firstProjectsCount = 0;
            $episodicProjectsCount = 0;

            foreach ($posts as $post) {

                $private = get_post_meta($post->ID, 'PRIVATE');

                //?mode=private
                if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                    ($private[0] == "1")
                ) {
                    continue;
                }

                setup_postdata($post);

                $arPostTags = wp_get_post_tags($post->ID);


                if (in_array_field(PORTFOLIO_WP_BEST_PROJECTS_LABEL_ID, 'term_id', $arPostTags)) {
                    $bestProjectsCount++;
                }

                if (in_array_field(PORTFOLIO_WP_FIRST_PROJECT_LABEL_ID, 'term_id', $arPostTags)) {
                    $firstProjectsCount++;
                }

                if (in_array_field(PORTFOLIO_WP_EPISODIC_PARTICIPATION_LABEL_ID, 'term_id', $arPostTags)) {
                    $episodicProjectsCount++;
                }

            }
            ?>


            <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                        href="/projects/best/">
                    Лучшие проекты
                </a> <span class="light-gray-text">/ <?php echo $bestProjectsCount; ?></span></li>

            <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                        href="/projects/first/">
                    Одни из первых проектов
                </a> <span class="light-gray-text">/ <?php echo $firstProjectsCount; ?></span></li>

            <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                        href="/projects/episodic/">
                    Эпизодическое участие
                </a> <span class="light-gray-text">/ <?php echo $episodicProjectsCount; ?></span></li>



        </ul>
    </div>



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

                    ?>




                    <li class="clearfix">
                        <a
                                href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
                            <img
                                    width="767" height="767"
                                    src="<?php echo $thumb_url[0]; ?>"
                                    class="attachment-full size-full wp-post-image" alt=""
                                    srcset="<?php echo $thumb_url_full[0]; ?> 767w, <?php echo $thumb_url[0]; ?> 150w, <?php echo $thumb_url_medium[0]; ?> 300w"
                                    sizes="(max-width: 767px) 100vw, 767px"/></a>
                        <div class="widget-posts-details"><a
                                    href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $post->ID; ?>">
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
    <div id="tag_cloud-4" class="widget widget_tag_cloud">
        <h5 class="widget-title font-alt">
            Тэги
        </h5>
        <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
        <div class="tagcloud">
            <div class="tags_cloud tags">


                <?php
                foreach($arPostTagsNames as $tagName) {
                    ?>

                    <a href='#'

                       class='tag-link-84 tag-link-position-1'
                       title=''

                       style='font-size: 22pt;'>
                        <?php echo $tagName; ?>
                    </a>

                    <?php
                }
                ?>


            </div>
        </div>
    </div>
    <div id="hcode_recent_comment_widget-9" class="widget widget_hcode_recent_comment_widget">
        <div class="widget">
            <h5 class="widget-title font-alt">Новые проекты</h5>

            <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
            <div class="widget-body">
                <ul class="widget-posts">

                    <?php
                    foreach($arNewProjects as $newProjectID) {
                        $private = get_post_meta($newProjectID, 'PRIVATE');

                        //?mode=private
                        if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                            ($private[0] == "1")
                        ) {
                            continue;
                        }

                        if($newProjectID == $_GET["ID"]) continue;

                        $arNewProject = get_post( $newProjectID, ARRAY_A);

                        ?>

                        <li class="clearfix">
                            <div class="widget-posts-details">
                                <a class="author"

                                   href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $newProjectID; ?>">
                                    <?php echo $arNewProject["post_title"]; ?>
                                </a>
                            </div>
                        </li>

                        <?php
                    }
                    ?>




                </ul>
            </div>
        </div>
    </div>
    <div id="text-8" class="widget widget_text">
        <h5 class="widget-title font-alt">Случайный текст</h5>

        <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
        <div class="textwidget">
            <?php echo $currentDetailTitle[0]; ?>
        </div>
    </div>

</div>