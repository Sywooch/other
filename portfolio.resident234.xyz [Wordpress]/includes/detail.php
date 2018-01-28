<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 18.04.2017
 * Time: 2:15
 */
?>
<h1><?php echo $post->post_title; ?></h1>
<div style="clear: both;"></div>
<p>
    <?php

    $postContent = $post->post_content;
    $postContent = preg_replace("/\\[.+\\]/m","",$postContent);

    echo $postContent;

    ?>
</p>
<div style="clear: both;"></div>



<?php
$arPostTags = wp_get_post_tags($post->ID);
//print_r($arPostTags);
if(count($arPostTags)) {
    ?>
    <p class="skills" style="opacity: 1; bottom: 0px;">
        <?php

        foreach ($arPostTags as $keyTag => $tag) {
            $postTagId = $tag->term_id;
            $postTagName = $tag->name;

            if (isset($arSkills[$postTagName])) {

                ?>

                <span class="color_base
                                label_php"
                      style="background-color:<?php echo $arSkills[$postTagName]["backgroundColor"]; ?>;
                          color:<?php echo $arSkills[$postTagName]["textColor"]; ?>;
                          background-image:url(<?php echo $arSkills[$postTagName]["image"]; ?>);
                          padding-left:<?php echo $arSkills[$postTagName]["paddingLeft"]; ?>px;">
                    <?php echo $postTagName; ?>
                </span>

                <?php


            }

        }
        ?>
    </p>
    <?php
}
?>





<div style="clear: both;"></div>







<?php



if(count($arPostTags) && isset($arOtherLabels[$postTagName])) {
    ?>
    <p class="skills" style="opacity: 1; bottom: 0px; ">
        <?php

        foreach ($arPostTags as $keyTag => $tag) {
            $postTagId = $tag->term_id;
            $postTagName = $tag->name;

            if (isset($arOtherLabels[$postTagName])) {
                ?>
                <span class="color_backendframeworks
                                label_zendframework"
                      style="background-color:<?php echo $arOtherLabels[$postTagName]["backgroundColor"]; ?>;
                          color:<?php echo $arOtherLabels[$postTagName]["textColor"]; ?>;
                          padding-left: 10px;">
					<?php echo $postTagName; ?>
                </span>
                <?php
            }
        }
        ?>
    </p>
    <?php
}
?>



