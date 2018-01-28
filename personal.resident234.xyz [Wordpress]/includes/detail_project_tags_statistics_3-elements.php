
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/portfolio_grid_gallery.php';
?>
<?php
$randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
?>
<div
        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-six-top xs-margin-ten-bottom wow fadeInUp">
    <div class="vc-column-innner-wrapper"><i
                class="icon-desktop medium-icon display-block"
                style="color:#000000;"></i>
        <h1 class="font-weight-600 margin-five no-margin-bottom">
            <?php echo $arAllTags[$randomProjectTagName]; ?> <?php
            echo numberof($countPosts, '',
                array('Проект', 'Проекта', 'Проектов'));
            ?>
        </h1>
        <p class="text-uppercase letter-spacing-2 text-small margin-three"
           style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
</div>

<?php
$randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
?>
<div
        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-six-top xs-margin-ten-bottom wow fadeInUp">
    <div class="vc-column-innner-wrapper"><i
                class="icon-desktop medium-icon display-block" style="color:#000000;"></i>
        <h1 class="font-weight-600 margin-five no-margin-bottom">
            <?php echo $arAllTags[$randomProjectTagName]; ?> <?php
            echo numberof($countPosts, '',
                array('Проект', 'Проекта', 'Проектов'));
            ?>
        </h1>
        <p class="text-uppercase letter-spacing-2 text-small margin-three"
           style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
</div>

<?php
$randomProjectTagName = $arPostTagsNames[wp_rand(0, count($arPostTagsNames) - 1)];
?>
<div
        class="wpb_column hcode-column-container  col-md-4 col-xs-mobile-fullwidth col-sm-4 text-center margin-six-top wow fadeInUp">
    <div class="vc-column-innner-wrapper"><i
                class="icon-desktop medium-icon display-block" style="color:#000000;"></i>
        <h1 class="font-weight-600 margin-five no-margin-bottom">
            <?php echo $arAllTags[$randomProjectTagName]; ?> <?php
            echo numberof($countPosts, '',
                array('Проект', 'Проекта', 'Проектов'));
            ?>
        </h1>
        <p class="text-uppercase letter-spacing-2 text-small margin-three"
           style="color:#000000;"><?php echo $randomProjectTagName; ?></p></div>
</div>
