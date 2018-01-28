<?php
    require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

    //собрать список навыков.
    //имя, картинка, цвет категории
    $categoryId = WP_CATEGORY_SKILLS_ID;

    $args = array(
        'numberposts' => 1000,
        'category' => $categoryId,
        'orderby' => 'ID',
        'order' => 'ASC',
        'include' => array(),
        'exclude' => array(),
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'post',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    );

    $posts = get_posts($args);

    unset($arSkills);
    foreach ($posts as $post) {
        setup_postdata($post);
        $idImage = get_post_thumbnail_id($post->ID);

        $paddingLeft = get_post_meta($post->ID, 'PADDING_LEFT');
        $arSkills[$post->post_title]["paddingLeft"] = $paddingLeft[0];

        $image_attributes = wp_get_attachment_image_src($idImage);
        //echo $image_attributes[0];
        $arSkills[$post->post_title]["image"] = $image_attributes[0];
        $cat = get_the_category($post->ID);
        $categoryDescription = $cat[0]->description;
        $arCategoryDescription = explode(":", $categoryDescription);
        $categoryBackgroundColor = $arCategoryDescription[0];
        $categoryTextColor = $arCategoryDescription[2];
        $arSkills[$post->post_title]["backgroundColor"] = $categoryBackgroundColor;
        $arSkills[$post->post_title]["textColor"] = $categoryTextColor;

    }


    wp_reset_postdata();





    $categoryId = WP_CATEGORY_OTHER_ID;

    $args = array(
        'numberposts' => 1000,
        'category' => $categoryId,
        'orderby' => 'ID',
        'order' => 'ASC',
        'include' => array(),
        'exclude' => array(),
        'meta_key' => '',
        'meta_value' => '',
        'post_type' => 'post',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    );

    $posts = get_posts($args);

    unset($arOtherLabels);
    foreach ($posts as $post) {
        setup_postdata($post);

        $postContent = $post->post_content;
        $arPostContent = explode(":", $postContent);

        $arOtherLabels[$post->post_title]["backgroundColor"] = $arPostContent[0];
        $arOtherLabels[$post->post_title]["textColor"] = $arPostContent[2];



    }

    wp_reset_postdata();

$contentLeft = "";

    ob_start();


    ?>


        <div class="galleryHolder">



            <div class="imageHolder">

                <!----DETAIL---------->


                <?php

                //echo $_POST["postId"];

                ?>


                                <div class="com_content view-category task- itemid-188 body__splash">

                                    <div id="wrapper" class="row-container">
                                        <div class="container">
                                            <div class="row">

                                                <div id="top-row">
                                                    <div class="row-container">
                                                        <div class="moduletable ">
                                                            <div id="camera-slideshow"
                                                                 class="camera_wrap pattern_1"
                                                                 style="display: block;">
                                                                <div class="camera_fakehover">
                                                                    <div class="camera_src camerastarted hovered">


                                                                        <?php
                                                                        $post = get_post( $_POST["postId"] );

                                                                        $gal = get_post_gallery( $_POST["postId"], false );


                                                                        foreach($gal["src"] as $itemImage) {

                                                                            ?>

                                                                            <div class="camera-item"
                                                                                 data-src="<?php echo $itemImage; ?>"
                                                                                 data-thumb="<?php echo $itemImage; ?>"
                                                                                 data-target="_self"
                                                                                 style="background-image:url(<?php echo $itemImage; ?>);">
                                                                            </div>

                                                                            <?php
                                                                        }
                                                                        ?>





                                                                    </div>









               <div class="camera_target">
                   <div class="cameraCont">


                       <?php
                       $i = 1;
                       foreach($gal["src"] as $itemImage) {
                       ?>


                       <div class="cameraSlide cameraSlide_<?php echo $i; ?>
                       <?php
                       if($i == 1){ echo "cameracurrent"; }
                       if($i == 2){ echo "cameranext"; }
                       $imageSizes = getimagesize ( $itemImage );

                       ?>"
                            data-number="<?php echo $i; ?>"
                            data-img="<?php echo $itemImage; ?>"
                            data-img-height="<?php echo $imageSizes[1]; ?>"
                            data-img-width="<?php echo $imageSizes[0]; ?>"

                            style="
                            <?php
                            if($i == 1) {
                                echo "visibility: visible;";
                                echo "display: block;";
                                echo "z-index: 999;";
                            }else{
                                echo "display: none; z-index: 1;";
                            }



                            ?>

                            background-image:url(<?php echo $itemImage; ?>);">
                           <img
                               src="<?php echo $itemImage; ?>"
                               class="imgLoaded" style="visibility: visible; height: 853.75px; margin-left: 0px;
                                margin-top: -95.875px; position: absolute; width: 1366px;" data-alignment=""
                               data-portrait="" width="1600" height="1000">
                           <div class="camerarelative" style="width: 1366px; height: 662px;
                           background-color: url(<?php echo $itemImage; ?>);">

                           </div>
                       </div>

                        <?php
                           $i++;
                        }
                       ?>



                   </div>
               </div>









                                                                    <div class="camera_target_content">
                                                                        <div class="cameraContents">
                                                                            <div class="cameraContent" style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent"
                                                                                 style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent cameracurrent"
                                                                                 style="display: block;"></div>
                                                                            <div class="cameraContent"
                                                                                 style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent" style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent" style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent" style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent" style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent" style="display: none;">

                                                                            </div>
                                                                            <div class="cameraContent" style="display: none;">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="camera_bar"
                                                                         style="display: none; top: auto;
                                                                    height: 7px;">
                                                                        <span class="camera_bar_cont"
                                                                              style="opacity: 0.8; position: absolute;
                                                                              left: 0px; right: 0px; top: 0px;
                                                                              bottom: 0px; background-color: rgb(34, 34, 34);">
                                                                            <span id="pie_0"
                                                                                  style="opacity: 0.8; position: absolute;
                                                                                  background-color: rgb(238, 238, 238);
                                                                                  left: 0px; right: 0px; top: 2px;
                                                                                  bottom: 2px; display: none;">

                                                                            </span>
                                                                        </span>
                                                                    </div>

                                                                </div>
                                                                <div class="camera_loader" style="display: none;
                                                                visibility: visible;">

                                                                </div>
                                                            </div>




                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                        <div id="push"></div>
                                    </div>





                                </div>


                <div class="camera_counter">
                    <span class="current_slide">1</span>/<span class="all_slides"><?php echo count($gal["src"]); ?></span>

                    <div class="camera_prev">
                        <span></span>
                    </div>
                    <div class="camera_next">
                        <span></span>
                    </div>
                </div>

                <!---DETAIL----------->



                <div class="camera_top">
                    <span></span>
                </div>

                <div class="camera_bottom">
                    <span></span>
                </div>


            </div>
        </div>


        <div class="inner">


        </div>


<?php

$contentLeft = ob_get_contents();
ob_end_clean();



    $contentRight = "";

    ob_start();
    ?>




<?php
include $_SERVER["DOCUMENT_ROOT"]."/includes/detail.php";
?>




<div style="clear:both;"></div>

        <?php
        $URL = get_post_meta($_POST["postId"], 'URL');

        if(!empty($URL)) {

            ?>

            <p class="skills" style="opacity: 1; bottom: 0px;">

                                <span class="color_link label_link"
                                      style="background-color:#dbdb0c;
                                          color:#000; padding-left:10px;">
                                    <a href="<?php echo $URL[0]; ?>" target="_blank"
                                       style="color:#000;">
                                        <?php echo $URL[0]; ?>
                                    </a>
                                </span>

            </p>

            <?php
        }

        ?>


    <?php

    $contentRight = ob_get_contents();
    ob_end_clean();

    //echo $contentLeft;
    //echo $contentRight;


    //получить id предыдущей и следующей записей

    $nextPostID = getNextPostID($_POST["postId"], WP_CATEGORY_PROJECTS_ID);
    $prevPostID = getPrevPostID($_POST["postId"], WP_CATEGORY_PROJECTS_ID);

    $arResult = array($contentLeft, $contentRight, $nextPostID, $prevPostID);

    echo wp_json_encode($arResult);
    
    ?>