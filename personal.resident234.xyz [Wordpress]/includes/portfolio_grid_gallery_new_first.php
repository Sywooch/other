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
    'posts_per_page' => 4000
);
$query = new WP_Query;
$my_posts = $query->query($args);

foreach( $my_posts as $my_post ){

    $private = get_post_meta($my_post->ID, 'PRIVATE');

    //?mode=private
    if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
        ($private[0] == "1")
    ) {
        continue;
    }


    $arNewProjects[] = $my_post;
}
?>



<?php
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
$i = 1;

?>