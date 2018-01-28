<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 29.07.2017
 * Time: 22:04
 */
?>
<?


$currentProjectID = $_GET["ID"];
$currentProjectKey = array_search ($currentProjectID, $arProjectsIDs);
if($currentProjectKey > 0){
    $prevProjectKey = $currentProjectKey - 1;
}else{
    $prevProjectKey = $currentProjectKey;
}

if($currentProjectKey == count($arProjectsIDs) - 1){
    $nextProjectKey = $currentProjectKey;
}else{
    $nextProjectKey = $currentProjectKey + 1;
}

$nextProjectID = $arProjectsIDs[$nextProjectKey];
$prevProjectID = $arProjectsIDs[$prevProjectKey];


$arPrevProject = get_post( $prevProjectID, ARRAY_A);
$arNextProject = get_post( $nextProjectID, ARRAY_A);

$thumb_id_PrevProject = get_post_thumbnail_id($arPrevProject["ID"]);
$thumb_url_medium_PrevProject = wp_get_attachment_image_src($thumb_id_PrevProject, 'large',
    false);
$thumb_url_medium_PrevProject[0] = str_replace(get_site_url(),
    PORTFOLIO_WP_URL,
    $thumb_url_medium_PrevProject[0]);

$thumb_url_medium_PrevProject_thumbnail = wp_get_attachment_image_src($thumb_id_PrevProject, 'thumbnail',
    false);
$thumb_url_medium_PrevProject_thumbnail[0] = str_replace(get_site_url(),
    PORTFOLIO_WP_URL,
    $thumb_url_medium_PrevProject_thumbnail[0]);


$thumb_id_NextProject = get_post_thumbnail_id($arNextProject["ID"]);
$thumb_url_medium_NextProject = wp_get_attachment_image_src($thumb_id_NextProject, 'large',
    false);
$thumb_url_medium_NextProject[0] = str_replace(get_site_url(),
    PORTFOLIO_WP_URL,
    $thumb_url_medium_NextProject[0]);


$thumb_url_medium_NextProject_thumbnail = wp_get_attachment_image_src($thumb_id_NextProject, 'thumbnail',
    false);
$thumb_url_medium_NextProject_thumbnail[0] = str_replace(get_site_url(),
    PORTFOLIO_WP_URL,
    $thumb_url_medium_NextProject_thumbnail[0]);


//$title = $post_id_7['post_title'];
?>

<div class="next-previous-bottom">
    <div class="next-previous-project xs-display-none">

        <?php if($nextProjectID != $currentProjectID){ ?>
        <div class="next-project"><a rel="next" href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $nextProjectID; ?>"><img
                    alt="<?php echo $arNextProject["post_title"];?>"
                    class="next-project-img"
                    src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/themes/h-code/assets/images/next-project.png"
                    width="33" height="83">
                <span><?php echo $arNextProject["post_title"];?></span>
                <div class="img"
                     style="background-image:url(<?php echo $thumb_url_medium_NextProject_thumbnail[0]; ?>);"></div>

            </a>
        </div>
        <?php } ?>

        <?php if($prevProjectID != $currentProjectID){ ?>
        <div class="previous-project"><a rel="prev"
                                         href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $prevProjectID; ?>">
                <div class="img"
                     style="background-image:url(<?php echo $thumb_url_medium_PrevProject_thumbnail[0]; ?>);"></div>
                <img
                    alt="<?php echo $arPrevProject["post_title"];?>" class="previous-project-img"
                    src="<?php echo PERSONAL_WP_HCODE_URL; ?>/h-code/wp-content/themes/h-code/assets/images/previous-project.png"
                    width="33" height="83"><span><?php echo $arPrevProject["post_title"];?></span></a></div>
        <?php } ?>



    </div>
</div>

