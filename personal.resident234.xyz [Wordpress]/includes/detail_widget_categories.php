<div id="categories-6" class="widget widget_categories"><h5 class="widget-title font-alt">
        Разделы</h5>
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
            </a> <span class="light-gray-text"></span></li>

        <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                    href="/projects/first/">
                Одни из первых проектов
            </a> <span class="light-gray-text"></span></li>

        <li class="cat-item widget-category-list light-gray-text cat-item-16"><a
                    href="/projects/episodic/">
                Эпизодическое участие
            </a> <span class="light-gray-text"></span></li>


    </ul>
</div>