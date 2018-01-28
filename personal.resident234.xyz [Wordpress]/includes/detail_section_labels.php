<section style="border-bottom: 1px solid #e5e5e5;">
    <div class="container">
        <div class="row">

            <?php
            //$categoryId = PORTFOLIO_WP_CATEGORY_SKILLS_ID;

            $args = array(
                'numberposts' => 1000,
                'category' => $arSkillsCategoriesIDs,
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

            $postsSkills = get_posts($args);


            $i = 0;
            foreach ($postsSkills as $postSkill) {
                setup_postdata($postSkill);

                $description = get_post_meta($postSkill->ID, 'DESCRIPTION');
                $image = get_post_meta($postSkill->ID, 'PREVIEW_IMAGE', true);

                if(!in_array($postSkill->post_title, $arPostTagsNames)) continue;
                if(!$image) continue;

                ?>


                <div
                        class="wpb_column hcode-column-container  col-md-4
                                        col-xs-mobile-fullwidth col-sm-4 text-center xs-margin-ten-bottom
                                        wow zoomInUp">
                    <div class="vc-column-innner-wrapper">
                        <div class="testimonial-style2"><img
                                    src="" class="js-img"
                                    data-image="<?php echo $image; ?>"
                                    alt="" width="300" height="300"/>
                            <p class="center-col width-90"><?php echo $description[0]; ?></p>
                            <span class="name light-gray-text2" style="color:#000000;">
                                                <?php echo $postSkill->post_title; ?>
                                            </span><i
                                    class="fa fa-quote-left small-icon display-block
                                                    margin-five no-margin-bottom"
                                    style="color:#e6af2a;"></i></div>
                    </div>
                </div>


                <?php
                if($i == 2) break;
                $i++;
            }

            wp_reset_postdata(); // сброс
            ?>







        </div>
    </div>
</section>