<section class="  no-padding" style=" background-color:#f6f6f6; ">
    <div class="container-fluid">
        <div class="row">
            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth">
                <div class="vc-column-innner-wrapper">
                    <div id="hcode-owl-content-slider1"
                         class="owl-carousel owl-theme  cursor-black round-pagination dark-pagination dark-navigation main-slider ">


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
                            <div class="item">
                                <div class="col-lg-6 col-md-6 case-study-img cover-background js-background"
                                     style="background-image:url();" data-image="<?php echo $thumb_url[0]; ?>"></div>
                                <div class="col-lg-6 col-md-6 case-study-details">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"><span
                                                class="about-number alt-font black-text font-weight-400
                                                        letter-spacing-2 xs-no-border xs-no-padding-left
                                                        xs-display-none"><?php echo $i; ?></span>
                                    </div>
                                    <div
                                            class="col-lg-8 col-md-9 col-sm-9 col-xs-12 about-text
                                                     position-relative xs-text-center">
                                        <p class="title-small text-uppercase letter-spacing-3
                                                    black-text font-weight-600 no-margin-bottom">
                                            <?php echo $post->post_title; ?></p><span
                                                class="case-study-work letter-spacing-3">
                                                        <?php echo implode(" | ", $arCurrentPostTagsNames); ?>
                                                    </span>
                                        <p class="width-90 xs-width-100"><?php
                                            $post_content = preg_replace("/\\[.+\\]/m","",
                                                $post->post_content);
                                            //$post_content = str_replace("\n","<br>",
                                            //    $post_content);

                                            echo kama_excerpt( array('text'=>$post_content,
                                                'maxchar'=>500,
                                                'autop' => false) );

                                            ?></p> <a
                                                class="highlight-button-black-border btn btn-small no-margin-bottom sm-no-margin"
                                                href="/detail/<?php echo $arDetailTemplates[wp_rand(0, count($arDetailTemplates) - 1)]; ?>?ID=<?php echo $post->ID; ?>"
                                                target="_self">Посмотреть проект</a></div>
                                </div>
                            </div>
                            <?php
                            $i++;

                        }
                        ?>



                        <?php

                        wp_reset_postdata(); // сброс
                        ?>



                    </div>
                    <script type="text/javascript">/*<![CDATA[*/
                        jQuery(document).ready(function () {
                            jQuery("#hcode-owl-content-slider1").owlCarousel({
                                autoPlay: false,
                                stopOnHover: false,
                                addClassActive: false,
                                navigation: false,
                                pagination: true,
                                singleItem: true,
                                paginationSpeed: 400,
                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                            });
                        });
                        /*]]>*/</script>
                </div>
            </div>
        </div>
    </div>
</section>