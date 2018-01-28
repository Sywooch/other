
<section id="about-us" class="  no-padding-bottom">
    <div class="container-fluid">

        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
        ?>

        <div class="row">
            <div
                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                <div class="vc-column-innner-wrapper"><h3 class="section-title  no-padding"
                                                          style=" color:#464646; ">Проекты</h3></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-lg-3 col-md-5 col-xs-mobile-fullwidth col-sm-7 text-center center-col margin-five">
                <div class="vc-column-innner-wrapper"><h4 class="gray-text">
                        <?php displayRandomElement($currentDetailTitle); ?>
                    </h4></div>
            </div>
            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth"
                 style=" background:#f6f6f6;">
                <div class="vc-column-innner-wrapper">
                    <div id="hcode-bootstrap-content-slider3"
                         class="carousel slide carousel- round-pagination dark-pagination dark-navigation ">
                        <ol class="carousel-indicators">

                            <?php
                            foreach ($posts as $keyPost => $post) {
                                ?>
                                <li data-target="#hcode-bootstrap-content-slider3"
                                    data-slide-to="<?php echo $keyPost; ?>"></li>
                                <?php
                            }
                            ?>

                        </ol>
                        <div class="carousel-inner">



                            <?php
                            $i = 1;
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


                                $arPostTags = wp_get_post_tags($post->ID);
                                ?>


                                <div class="item">
                                    <div
                                            data-image="<?php echo $thumb_url_full[0]; ?>"
                                            style="background-image:url();"
                                            class="fill__no-width xs-display-none js-background
col-lg-5 col-md-3 col-sm-2"></div><!---->
                                    <div class="case-study-slider clearfix">
                                        <div class="col-lg-7 col-md-9 col-sm-10 pull-right">
                                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span
                                                        class="about-number alt-font black-text font-weight-400 letter-spacing-2 xs-no-border xs-no-padding-left"
                                                        style="color:#000000 !important;"><?php echo $keyPost + 1; ?></span></div>
                                            <div
                                                    class="col-lg-8 col-md-9 col-sm-9 col-xs-12 about-text position-relative">
                                                <p class="title-small text-uppercase letter-spacing-3 black-text no-margin-bottom">
                                                    <a class="inner-link"
                                                       href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                       style="color:#000000 !important;">
                                                        <?php echo $post->post_title;?>
                                                    </a></p><span
                                                        class="case-study-work letter-spacing-2">
                                                                <?php echo implode(" | ", $arPostTagsNames); ?>
                                                            </span>
                                                <p class="width-80"><?php
                                                    echo kama_excerpt( array('text'=>$arProject["post_content"], 'maxchar'=>500) );?>
                                                </p> <a
                                                        class="highlight-button-black-border btn btn-small no-margin-bottom inner-link"
                                                        href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                        target="_self">Детали</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php

                            }
                            ?>


                        </div>
                        <a class="left carousel-control" href="#hcode-bootstrap-content-slider3"
                           data-slide="prev"><img
                                    src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre.png"
                                    alt="" width="96" height="96"/></a><a class="right carousel-control"
                                                                          href="#hcode-bootstrap-content-slider3"
                                                                          data-slide="next"><img
                                    src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next.png"
                                    alt="" width="96" height="96"/></a></div>
                    <script type="text/javascript">jQuery(document).ready(function () {
                            jQuery("#hcode-bootstrap-content-slider3").carousel({
                                interval: false,
                                pause: false,
                            });
                        });</script>
                </div>
            </div>
        </div>
    </div>
</section>