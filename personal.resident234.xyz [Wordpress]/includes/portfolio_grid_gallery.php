<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 0:50
 */

?>



<?php
unset($arNewProjects);

$args = array(
    'post_type' => 'post',
    'cat' => PORTFOLIO_WP_CATEGORY_PROJECTS_ID,
    'orderby' => 'date',
    'order' => 'DESC',
    'posts_per_page' => 4
);
$query = new WP_Query;
$my_posts = $query->query($args);

foreach( $my_posts as $my_post ){
    $arNewProjects[] = $my_post->ID;
}
?>



<?php

$arAllTags = array();
$arAllYears = array();

$categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

$args = array(
    'numberposts' => 1000,
    'category' => $categoryId,
    'orderby' => 'rand',
    'order' => 'ASC',
    'include' => array(),
    'exclude' => array(),
    'meta_key' => 'ORDER',
    'meta_value' => '',
    'post_type' => 'post',
    'suppress_filters' => true,
    // подавление работы фильтров изменения SQL запроса

);

$posts = get_posts($args);

unset($arAllProjectMockups);
unset($arAllProjectImages);
unset($arAllMainImages);


foreach ($posts as $post) {

    $private = get_post_meta($post->ID, 'PRIVATE');
    $year = get_post_meta($post->ID, 'YEAR')[0];

    //?mode=private
    if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
        ($private[0] == "1")
    ) {
        continue;
    }

    setup_postdata($post);


    $arPostTags = wp_get_post_tags($post->ID);

    foreach ($arPostTags as $keyTag => $tag) {
        $arAllTags[$tag->name] = $tag->count;

    }

    if($arAllYears[$year]) {
        $arAllYears[$year]++;
    }else{
        $arAllYears[$year] = 1;
    }



    $gal = get_post_gallery($post->ID, false);
    $arIDs = explode(',', $gal['ids']);


    foreach ($arIDs as $keyImageID => $itemImageID) {

        $arMetaImage = wp_get_attachment_metadata($itemImageID);

        $thumb_img = get_post($itemImageID);

        if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP") {

            $arAllProjectMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "" . $arMetaImage["file"];

        }

        if($thumb_img->post_excerpt == ""){

            $arAllProjectImages[] = PORTFOLIO_WP_UPLOAD_DIR_URL."".$arMetaImage["file"];

        }


    }


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


    $arAllMainImages[] = $thumb_url[0];


    $i++;

}




$countAllProjects = count($posts);

wp_reset_postdata(); // сброс





$i = 1;

?>