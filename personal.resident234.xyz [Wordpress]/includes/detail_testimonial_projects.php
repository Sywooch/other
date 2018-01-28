<section id="testimonial" class=" " style=" background-color:#000000; ">
    <div class="container">
        <div class="row">
            <div
                    class="wpb_column hcode-column-container  col-md-12 col-xs-mobile-fullwidth text-center">
                <div class="vc-column-innner-wrapper"><h3 class="section-title  white-text no-padding"
                                                          style="font-weight:600 !important;;">
                        Проекты</h3></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-md-6 col-xs-mobile-fullwidth col-sm-10 text-center center-col">
                <div class="vc-column-innner-wrapper">
                    <div class="testimonial-slider position-relative no-transition">
                        <div id="hcode-testimonial"
                             class="owl-pagination-bottom position-relative  round-pagination light-pagination white-cursor">
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

                                <div
                                        class="col-md-12 col-sm-12 col-xs-12 testimonial-style2 center-col
                                                text-center margin-three no-margin-top">
                                    <p>
                                        <?php
                                        echo kama_excerpt( array('text'=>$post->post_content, 'maxchar'=>200) );?>
                                    </p>
                                    <span class="name light-gray-text2">
                                                    <?php echo $post->post_title; ?>
                                                </span>
                                </div>

                                <?php

                                $i++;
                            }

                            wp_reset_postdata(); // сброс
                            ?>


                        </div>
                    </div>
                    <script type="text/javascript">/*<![CDATA[*/
                        jQuery(document).ready(function () {
                            jQuery("#hcode-testimonial").owlCarousel({
                                pagination: true,
                                singleItem: true,
                                navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"]
                            });
                        });
                        /*]]>*/</script>
                </div>
            </div>
        </div>
    </div>
</section>

