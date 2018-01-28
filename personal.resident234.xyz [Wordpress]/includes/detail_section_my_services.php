<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 12.08.2017
 * Time: 2:11
 */
?>
<section class="  no-padding-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                <div class="vc-column-innner-wrapper"><h3
                            class="section-title  black-text no-padding-bottom">Мои услуги</h3></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 text-center center-col no-padding margin-five">
                <div class="vc-column-innner-wrapper">
                    <div id="animated-tab2" class="hcode-animated-tabs animated-tab2">
                        <ul class="nav nav-tabs margin-five no-margin-top">

                            <?php

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

                            $i = 0;
                            foreach ($posts as $post) {
                                setup_postdata($post);


                                ?>

                                <li class="nav <?php if($i == 0){ ?>active<?php } ?>">
                                    <a href="#hcode-1500813643-2112791938-<?php echo $i; ?>"
                                       class="xs-min-height-inherit xs-no-padding"
                                       data-toggle="tab"><span><i
                                                    class="icon-<?php echo $post->post_content;?>"></i></span></a><br><a
                                            href="#hcode-1500813643-2112791938-<?php echo $i; ?>"
                                            class="xs-min-height-inherit xs-no-padding body-text"
                                            data-toggle="tab"><span
                                                class="text-small text-uppercase letter-spacing-3 margin-bottom-5px margin-top-5px font-weight-600 xs-letter-spacing-none xs-display-none"><?php echo $post->post_title;?></span></a>
                                </li>

                                <?php
                                $i++;
                            }

                            wp_reset_postdata();
                            ?>





                        </ul>



                        <div class="tab-content">

                            <?php
                            $i = 0;
                            foreach ($posts as $post) {
                                setup_postdata($post);

                                ?>
                                <div class="text-center center-col tab-pane fade in <?php if($i == 0){ ?>active<?php } ?>"
                                     id="hcode-1500813643-2112791938-<?php echo $i; ?>">
                                    <div
                                            class="col-lg-6 col-md-6 no-padding corporate-standards-img position-relative cover-background js-background"
                                            style="background-image:url();" data-image="<?php displayRandomElement($currentBackgroundImage); ?>">

                                        <div class="opacity-medium bg-dark-gray"></div>
                                        <p class="title-small text-uppercase corporate-standards-title white-text letter-spacing-7">
                                                        <span
                                                                class="title-extra-large no-letter-spacing yellow-text">0<?php echo $i + 1; ?></span><br><?php echo $post->post_title;?>
                                        </p></div>
                                    <div
                                            class="col-lg-6 col-md-6 corporate-standards-text sm-margin-lr-four sm-margin-top-four xs-padding-tb-ten">
                                        <div class="img-border-small-fix border-gray"></div>
                                        <i class="icon-<?php echo $post->post_content;?> large-icon yellow-text"></i>
                                        <h1 class="margin-ten no-margin-bottom"><?php echo $post->post_title;?></h1>
                                        <p class="text-med margin-ten width-80 center-col xs-width-100"></p>
                                        <p class="text-med margin-ten width-80 center-col xs-width-100">
                                        </p>
                                        <p></p><a
                                                class="text-small highlight-link text-uppercase bg-black white-text"
                                                href="/projects/"
                                                target="_self">Посмотреть проекты <i
                                                    class="fa fa-long-arrow-right extra-small-icon white-text"></i></a>
                                    </div>
                                </div>
                                <?php
                                $i++;
                            }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>