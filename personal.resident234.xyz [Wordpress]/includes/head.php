<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 0:50
 */

$templateDirectory =  str_replace($_SERVER['DOCUMENT_ROOT'], "", get_template_directory());

global $wp;
$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );


if($_GET["mode"] == "private"){

    $_SESSION["mode"] = "private";
    //header('Location: /');
    header('Location: ' . $current_url);

}else{
    if(!isset($_SESSION["mode"])) {
        $_SESSION["mode"] = "public";
    }
}

$categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;
global $wpdb;
$wpdb->set_prefix('portfolio_');

unset($arProjectsIDs);

$args = array(
    'numberposts' => 1000,
    'category' => $categoryId,
    'orderby' => 'meta_value_num',//meta_value_ORDER
    'order' => 'ASC',
    'include' => array(),
    'exclude' => array(),
    'meta_key' => 'ORDER',
    'meta_value' => '',
    'post_type' => 'post',
    'suppress_filters' => true
);

$posts = get_posts($args);
unset($arAllProjectsMockups);
foreach ($posts as $post) {

    $private = get_post_meta($post->ID, 'PRIVATE');

    //?mode=private
    if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
        ($private[0] == "1")) continue;

    setup_postdata($post);

    $arProjectsIDs[] = $post->ID;

    //$arAllProjectsMockups[]

    $gal = get_post_gallery($post->ID, false);
    $arIDs = explode(',', $gal['ids']);

    foreach ($arIDs as $keyImageID => $itemImageID) {

        $arMetaImage = wp_get_attachment_metadata($itemImageID);

        $thumb_img = get_post($itemImageID);

        if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP") {

            $arAllProjectsMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "" . $arMetaImage["file"];

        }




    }




}

wp_reset_postdata();

require_once ABSPATH . 'wp-admin/includes/file.php';

unset($arDetailTemplates);
$files = list_files( ABSPATH . "detail/" );
foreach($files as $file){
    $arFile = explode("/", $file);
    $fileName = $arFile[count($arFile) - 1];
    //$filetype = wp_check_filetype($fileName);
    //$fileName = str_replace($filetype['ext'], "", $fileName);
    $arDetailTemplates[] = $fileName;
}

$categoryId = PORTFOLIO_WP_TEXT_1_ID;

$args = array(
    'numberposts' => 50,
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

unset($currentDetailTitle);
unset($currentDetailDescription);
foreach ($posts as $post) {
    setup_postdata($post);


    $currentDetailTitle[] = $post->post_title;
    $currentDetailDescription[] = $post->post_content;

}



$categoryId = PORTFOLIO_WP_STOCK_FOTOS_ID;

$args = array(
    'numberposts' => 20,
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

//unset($arSkills);
foreach ($posts as $post) {
    setup_postdata($post);

    $currentBackgroundImage[] = $post->post_title;

}


wp_reset_postdata();


$categoryId = PORTFOLIO_WP_STOCK_FOTOS_DARK_ID;

$args = array(
    'numberposts' => 20,
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

//unset($arSkills);
foreach ($posts as $post) {
    setup_postdata($post);

    $currentBackgroundDarkImage[] = $post->post_title;

}


wp_reset_postdata();





$arProjectsTypesCountsProjects = array();

$categoryId = WP_CATEGORY_PROJECTS_ID;

$args = array(
    'numberposts' => 1000,
    'category' => $categoryId,
    'orderby' => 'meta_value_num',//meta_value_ORDER
    'order' => 'ASC',
    'include' => array(),
    'exclude' => array(),
    'meta_key' => 'ORDER',
    'meta_value' => '',
    'post_type' => 'post',
    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    /*'meta_query'	=> array(
        array(
            'key'	  	=> 'PRIVATE ',
            'value'	  	=> '1',
            'compare' 	=> 'NOT IN',
        ),
    ), */
);

$posts = get_posts($args);
$i = 1;

$countProjects = count($posts);


?>

<?php
foreach ($posts as $post){

    $private = get_post_meta($post->ID, 'PRIVATE');

    //?mode=private
    if((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
        ($private[0] == "1")) continue;

    setup_postdata($post);

    ?>

    <?php

    $arPostTags = wp_get_post_tags($post->ID);
    //print_r($arPostTags);
    foreach ($arPostTags as $keyTag => $tag) {
        $postTagId = $tag->term_id;
        $postTagName = $tag->name;

        //echo $postTagName;


        if($arProjectsTypesCountsProjects[$postTagName]){
            $arProjectsTypesCountsProjects[$postTagName]++;
        }else{
            $arProjectsTypesCountsProjects[$postTagName] = 1;
        }


    }

    $i++;

}

wp_reset_postdata(); // сброс


include $_SERVER['DOCUMENT_ROOT'] . '/includes/head_functions.php';
