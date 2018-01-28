<section class="  position-relative" style=" background-color:#000000; ">
    <div class="container-fluid">
        <div class="row">
            <div
                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                <div class="vc-column-innner-wrapper"><h3
                            class="section-title  white-text no-padding-bottom">Проекты</h3></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth col-sm-12 no-padding margin-four-top sm-margin-eight-top">
                <div class="vc-column-innner-wrapper">
                    <div class="feature-owl position-relative">
                        <div class="container">
                            <div class="row">
                                <div id="approach-slider"
                                     class="owl-carousel owl-theme bottom-pagination white-cursor dot-pagination light-navigation dark-pagination">
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

                                        $arPostTags = wp_get_post_tags($post->ID);
                                        unset($arCurrentPostTagsNames);
                                        foreach ($arPostTags as $tag){
                                            $arCurrentPostTagsNames[] = $tag->name;
                                        }
                                        ?>

                                        <div class="item margin-ten no-margin-top">
                                            <div class="text-center margin-four wow fadeIn "><i
                                                        class="icon-laptop medium-icon no-margin-bottom
                                                                white-text"></i>
                                                <h5 class="white-text margin-ten no-margin-bottom
                                                            xs-margin-top-five">
                                                    <?php echo $post->post_title; ?></h5><span
                                                        class="approach-details feature-owlslide-content
                                                                light-gray-text2">
                                                            <?php echo implode("  ", $arCurrentPostTagsNames);?>
                                                            </span>
                                            </div>
                                        </div>

                                        <?php

                                    }

                                    wp_reset_postdata(); // сброс
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="feature_nav"><a class="prev left carousel-control"><img alt=""
                                                                                            src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-pre.png"
                                                                                            width="96"
                                                                                            height="96"></a><a
                                    class="next right carousel-control"><img alt=""
                                                                             src="http://wpdemos.themezaa.com/h-code/wp-content/themes/h-code/assets/images/arrow-next.png"
                                                                             width="96" height="96"></a>
                        </div>
                    </div>
                    <script type="text/javascript">jQuery(document).ready(function () {
                            jQuery("#approach-slider").owlCarousel({
                                pagination: false,
                                autoPlay: false,
                                stopOnHover: true,
                                items: 4,
                                itemsDesktop: [1200, 4],
                                itemsTablet: [991, 3],
                                itemsMobile: [700, 1],
                            });
                        });</script>
                </div>
            </div>
        </div>
    </div>
</section>