<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 0:50
 */

$arProject = get_post($_GET["ID"], ARRAY_A);


$categoryId = PORTFOLIO_WP_TEXT_1_ID;

$args = array(
    'numberposts' => 5,
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


wp_reset_postdata();


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


$gal = get_post_gallery($arProject["ID"], false);
$arIDs = explode(',', $gal['ids']);

foreach ($arIDs as $keyImageID => $itemImageID) {

    $arMetaImage = wp_get_attachment_metadata($itemImageID);

    $thumb_img = get_post($itemImageID);

    if ($thumb_img->post_excerpt == "PERSONAL_MOCKUP") {

        $arProjectMockups[] = PORTFOLIO_WP_UPLOAD_DIR_URL . "" . $arMetaImage["file"];

    }

if($thumb_img->post_excerpt == ""){

                                    $arProjectImages[] = PORTFOLIO_WP_UPLOAD_DIR_URL."".$arMetaImage["file"];

                                }


}

$thumb_id = get_post_thumbnail_id($arProject["ID"]);
$thumb_url = wp_get_attachment_image_src($thumb_id, 'full',
    false);

$thumb_url[0] = str_replace(get_site_url(),
    PORTFOLIO_WP_URL,
    $thumb_url[0]);
$thimbnailProjectImage = $thumb_url[0];

if (!$arProjectMockups) {
    $arProjectMockups[] = $thumb_url[0];
}


$arProjectAllImages = array_merge($arProjectMockups, $arProjectImages);

$arPostTags = wp_get_post_tags($arProject["ID"]);
                                                            unset($arPostTagsNames);
                                                            foreach ($arPostTags as $keyTag => $tag) {
                                                                $postTagId = $tag->term_id;
                                                                $arPostTagsNames[] = $tag->name;

                                                            }

$arProject["post_content"] =  preg_replace("/\\[.+\\]/m","", $arProject["post_content"]);
$arProject["post_content_formatted"] = str_replace("\n","<br>", $arProject["post_content"]);

$URL = get_post_meta($arProject["ID"], 'URL');
$YEAR = get_post_meta($arProject["ID"], 'YEAR')[0];
$ProjectURL = get_post_meta($arProject["ID"], 'URL')[0];


$ProjectCLIENT = get_post_meta($arProject["ID"], 'CLIENT')[0];
$ProjectTYPE = get_post_meta($arProject["ID"], 'TYPE')[0];




                                        $categoryId = PORTFOLIO_WP_CATEGORY_LINKS_ID;

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


                                        foreach ($posts as $post) {

                                            setup_postdata($post);
                                            $imageMeta = get_post_meta($post->ID, 'PREVIEW_IMAGE', true);
                                            $URL = get_post_meta($post->ID, 'URL', true);

                                            $arLink["post"] = $post;
                                            $arLink["imageMeta"] = $imageMeta;
                                            $arLink["URL"] = $URL;

                                            $arLinks[] = $arLink;

                                        }


                                        wp_reset_postdata();

$projectURL = "";
$projectURL = get_post_meta($arProject["ID"], 'URL')[0];



unset($arSkillsCategoriesIDs);
$categories=  get_categories();//'child_of=2'
foreach ($categories as $category) {
    if($category->category_parent == PORTFOLIO_WP_CATEGORY_SKILLS_ID)  {
        $arSkillsCategoriesIDs[] = $category->cat_ID;
    }

}



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
unset($postsSkillsImages);
unset($arProjectSkills);

$i = 0;
foreach ($postsSkills as $postSkill) {
    setup_postdata($postSkill);

    $description = get_post_meta($postSkill->ID, 'DESCRIPTION');
    $image = get_post_meta($postSkill->ID, 'PREVIEW_IMAGE', true);

    if (!in_array($postSkill->post_title, $arPostTagsNames)) {
        continue;
    }
    if (!$image) {
        continue;
    }

    $postsSkillsImages[] = $image;

    $postSkill->image = $image;

    $arProjectSkills[] = $postSkill;

}

wp_reset_postdata(); // сброс






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

?>

