<section class="  fix-background js-background"
         data-image="<?php displayRandomElement($currentBackgroundImage); ?>"
         style=" background-image: url(); ">
    <div class="selection-overlay" style=" opacity:0.7; background-color:#000000;"></div>
    <div class="container">
        <div class="row">

            <?php

            $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

            $args = array(
                'numberposts' => 1000,
                'category' => $categoryId,
                'orderby' => 'ID',
                'order' => 'ASC',
                'include' => array(),
                'exclude' => array(),
                'meta_key' => '',
                'meta_value' => '',
                'post_type' => 'post',
                'suppress_filters' => true,
                // подавление работы фильтров изменения SQL запроса
            );

            $posts = get_posts($args);

            $countPosts = count($posts);


            $categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

            $args = array(
                'numberposts' => 4,
                'category' => $categoryId,
                'orderby' => 'rand',
                'order' => 'ASC',
                'include' => array(),
                'exclude' => array(),
                'meta_key' => '',
                'meta_value' => '',
                'post_type' => 'post',
                'suppress_filters' => true,
                // подавление работы фильтров изменения SQL запроса
            );

            $posts = get_posts($args);

            foreach ($posts as $post) {
                setup_postdata($post);



                if(!$arProjectsTypesCountsProjects[$post->post_title]){
                    $arProjectsTypesCountsProjects[$post->post_title] = 1;
                }

                //$countPosts
                //$arProjectsTypes[$post->post_title]
                $percentProjects = ceil(($arProjectsTypesCountsProjects[$post->post_title] * 100) / $countPosts);

                ?>




                <div
                        class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-3 text-center">
                    <div class="vc-column-innner-wrapper">
                        <div class="chart-style2">
                            <div class="chart-percent"><span data-percent="<?php echo $percentProjects; ?>"
                                                             class="chart chart-<?php echo $post->ID;?> white-text"><span
                                            class="percent alt-font"><?php echo $percentProjects; ?></span></span></div>
                            <div class="chart-text"><h5 class=" white-text"><?php echo $post->post_title;?></h5>
                                <p><?php echo $arProjectsTypesCountsProjects[$post->post_title]; ?> <?php
                                    echo numberof($arProjectsTypesCountsProjects[$post->post_title], '',
                                        array('Проект', 'Проекта', 'Проектов'));
                                    ?></p></div>
                        </div>
                        <script type="text/javascript">jQuery(function () {
                                jQuery('.chart-<?php echo $post->ID;?>').easyPieChart({
                                    barColor: '#FFF',
                                    trackColor: '#535353',
                                    scaleColor: false,
                                    easing: 'easeOutBounce',
                                    scaleLength: 1,
                                    lineCap: 'round',
                                    lineWidth: 1,
                                    size: 120,
                                    animate: {duration: 2000, enabled: true},
                                    onStep: function (from, to, percent) {
                                        $(this.el).find('.percent').text(Math.round(percent));
                                    }
                                });
                            });</script>
                    </div>
                </div>

                <?php
            }

            wp_reset_postdata();
            ?>





        </div>
    </div>
</section>