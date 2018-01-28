<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
?>

<section>
    <div class="container">
        <div class="row">
            <div class="wpb_column hcode-column-container  col-xs-mobile-fullwidth text-center">
                <div class="vc-column-innner-wrapper"><h3
                            class="section-title  black-text no-padding-bottom">Прочие проекты</h3></div>
            </div>
            <div
                    class="wpb_column hcode-column-container  col-md-5 col-xs-mobile-fullwidth col-sm-10 text-center center-col margin-five">
                <div class="vc-column-innner-wrapper"><h4 class="gray-text"><?php echo randomText()[0]; ?></h4></div>
            </div>
<?php
$i = 0;
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

    <div
            class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth
                                col-sm-4 text-center wow fadeInUp"
            data-wow-duration=300ms>
        <div class="vc-column-innner-wrapper">
            <div class="key-person ">
                <div class="key-person-img"><img alt=""
                                                 data-image="<?php echo $thumb_url[0]; ?>"
                                                 src="<?php //echo $thumb_url_medium[0]; ?>"
                                                 width="500" height="730"
                                                 class="js-img"></div>
                <div class="key-person-details bg-white">
                    <span class="person-name black-text"><?php echo $post->post_title; ?></span><span
                            class="person-post"><?php echo implode("  ", $arCurrentPostTagsNames); ?></span>
                    <div class="separator-line bg-yellow"></div>
                    <div class="person-social"></div>
                    <p>
                        <?php
                        $post_content = preg_replace("/\\[.+\\]/m","",
                            $post->post_content);
                        //$post_content = str_replace("\n","<br>",
                        //    $post_content);

                        echo kama_excerpt( array('text'=>$post_content, 'maxchar'=>300,
                            'autop' => false) );

                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>




    <?php
    if($i == 2) break;
    $i++;

}
?>



<?php

wp_reset_postdata(); // сброс
?>


</div>
</div>
</section>