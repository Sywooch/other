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


<script type="text/javascript">/*<![CDATA[*/
    $(document).ready(function () {
        var $buythemediv = '<?php if($prevProjectID != $currentProjectID){ ?><div class="buy-theme xs-display-none"><a href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $prevProjectID; ?>"><span>Предыдущий проект</span></a></div><?php } ?><?php if($nextProjectID != $currentProjectID){ ?><div class="quick-question xs-display-none"><a href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $nextProjectID; ?>"><span>Следующий проект</span></a></div><?php } ?>';
        $('body').append($buythemediv);
    });
    /*]]>*/</script>

