


<section class="  parallax-fix parallax3 js-background"
         style=" background-image: url(); "
         data-image="<?php displayRandomElement($currentBackgroundDarkImage); ?>">
    <div class="selection-overlay" style=" opacity:0.6; background-color:#1b161c;"></div>
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


            $categoryId = PORTFOLIO_WP_CATEGORY_SERTIFICATES_ID;

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

            $countSertificates = count($posts);

            $diffDateRemote =  current_time('timestamp') - strtotime("01-12-2012");
            $humanYearsRemote = floor($diffDateRemote / 31536000);

            include $_SERVER['DOCUMENT_ROOT'] . '/includes/GitHub.php';

            ?>




            <div
                    class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                    data-wow-duration=300ms>
                <div class="vc-column-innner-wrapper">
                    <div class="counter-section"><i class="icon-heart medium-icon"></i><span
                                id="counter_1" data-to="<?php echo $countPosts;?>"
                                class="counter-number white-text"><?php echo $countPosts;?></span>
                        <span class="counter-title"
                              style="color: #ababab">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Проект', 'Проекта', 'Проектов'));
                                            ?></span>
                    </div>
                </div>
            </div>
            <div
                    class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center sm-margin-ten-bottom wow fadeInUp"
                    data-wow-duration=600ms>
                <div class="vc-column-innner-wrapper">
                    <div class="counter-section"><i class="icon-happy medium-icon"></i><span
                                id="counter_2" data-to="<?php echo $countSertificates;?>"
                                class="counter-number white-text"><?php echo $countSertificates;?></span>
                        <span class="counter-title"
                              style="color: #ababab">
                                            <?php
                                            echo numberof($countPosts, '',
                                                array('Сертификат', 'Сертификата', 'Сертификатов'));
                                            ?>
                                        </span>
                    </div>
                </div>
            </div>
            <div
                    class="wpb_column hcode-column-container  counter-section col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center xs-margin-ten-bottom wow fadeInUp"
                    data-wow-duration=900ms>
                <div class="vc-column-innner-wrapper">
                    <div class="counter-section"><i class="icon-anchor medium-icon"></i><span
                                id="counter_3" data-to="<?php echo $countFilesInRepo; ?>"
                                class="counter-number white-text"><?php echo $countFilesInRepo; ?></span>
                        <span class="counter-title"
                              style="color: #ababab">
                                            Файлов с кодом в репозитории
                                        </span>
                    </div>
                </div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-md-3 col-xs-mobile-fullwidth col-sm-6 text-center wow fadeInUp"
                    data-wow-duration=1200ms>
                <div class="vc-column-innner-wrapper">
                    <div class="counter-section"><i class="icon-chat medium-icon"></i><span
                                id="counter_4" data-to="<?php echo $humanYearsRemote; ?>"
                                class="counter-number white-text"><?php echo $humanYearsRemote; ?></span><span class="counter-title"
                                                                                                               style="color: #ababab">
                                            <?php
                                            echo numberof($humanYearsRemote, '', array('год', 'года', 'лет'));
                                            ?> опыта работы
                                        </span>
                    </div>
                </div>
            </div>




        </div>
    </div>
</section>