
<!doctype html>
<html lang="en">
<head>
    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
    ?>
    <meta charset="UTF-8">
    <?php
    $postHead = get_post( $_GET["id"] );
    ?>

    <title><?php echo $postHead->post_title; ?></title>
    <script type="text/javascript">
        //<![CDATA[
        try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"f918541e18e22df0711d6671c6a0db8f",petok:"0ca618ac97cc58e172df67a310d0750cccf1d11f-1488987206-1800",zone:"template-help.com",rocket:"0",apps:{"abetterbrowser":{"ie":"7"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=f2befc48d1/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
        //]]>
    </script>


</head>
<body>
<div data-id="fashion" class="gall_indent">
<a href="./gallery" class="closeIcon historyBack closeIconGallery"></a>



    <?php echo $post->post_title; ?>

    <?php
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




    ?>


    <div class="galleryContainer ajaxContainer1">
<!--<div class="imgSpinner"></div>-->

        <div class="galleryHolder">



            <div class="imageHolder">

                <!----DETAIL---------->


                    <script type="text/javascript">
                        //<![CDATA[
                        try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"56048f50f7023b715a4387ccb9d31980",petok:"f0d1d05cc45233f073f8c8289d82f7bf0128c0f4-1490112563-1800",zone:"template-help.com",rocket:"0",apps:{"abetterbrowser":{"ie":"7"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=f2befc48d1/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
                        //]]>
                    </script>

                <?php

                //echo $_GET["id"];

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
                                                                        $post = get_post( $_GET["id"] );

                                                                        $gal = get_post_gallery( $_GET["id"], false );


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




                                                            <script type="text/javascript">


                                                                function sliderImagesInitialize(){


                                                                    /***********************************/



                                                                    jQuery(".camera_next").click(function(){
                                                                        var currentNumber = jQuery(".cameracurrent").attr("data-number");
                                                                        if(jQuery(".cameraSlide_"+ (parseInt(currentNumber) + 1)).length){
                                                                            jQuery(".cameraSlide_" + currentNumber).css("zIndex","1");
                                                                            jQuery(".cameraSlide_" + currentNumber).css("display","none");


                                                                            jQuery(".cameraSlide_"+ (parseInt(currentNumber) + 1)).css("zIndex","999");
                                                                            jQuery(".cameraSlide_"+ (parseInt(currentNumber) + 1)).css("display","block");

                                                                            jQuery(".cameraSlide_" + currentNumber).removeClass("cameracurrent");
                                                                            jQuery(".cameraSlide_"+ (parseInt(currentNumber) + 1)).addClass("cameracurrent");

                                                                            jQuery(".current_slide").html(parseInt(currentNumber) + 1);



                                                                        }else{

                                                                            jQuery(".cameraSlide_" + currentNumber).css("zIndex","1");
                                                                            jQuery(".cameraSlide_" + currentNumber).css("display","none");


                                                                            jQuery(".cameraSlide_1").css("zIndex","999");
                                                                            jQuery(".cameraSlide_1").css("display","block");

                                                                            jQuery(".cameraSlide_" + currentNumber).removeClass("cameracurrent");
                                                                            jQuery(".cameraSlide_1").addClass("cameracurrent");

                                                                            jQuery(".current_slide").html("1");


                                                                        }
                                                                        sliderNextPrev();
                                                                    });


                                                                    jQuery(".camera_prev").click(function(){
                                                                        var currentNumber = jQuery(".cameracurrent").attr("data-number");
                                                                        if(jQuery(".cameraSlide_"+ (parseInt(currentNumber) - 1)).length){
                                                                            jQuery(".cameraSlide_" + currentNumber).css("zIndex","1");
                                                                            jQuery(".cameraSlide_" + currentNumber).css("display","none");


                                                                            jQuery(".cameraSlide_"+ (parseInt(currentNumber) - 1)).css("zIndex","999");
                                                                            jQuery(".cameraSlide_"+ (parseInt(currentNumber) - 1)).css("display","block");



                                                                            jQuery(".cameraSlide_" + currentNumber).removeClass("cameracurrent");
                                                                            jQuery(".cameraSlide_"+ (parseInt(currentNumber) - 1)).addClass("cameracurrent");


                                                                            jQuery(".current_slide").html(parseInt(currentNumber) - 1);

                                                                        }else{

                                                                            jQuery(".cameraSlide_" + currentNumber).css("zIndex","1");
                                                                            jQuery(".cameraSlide_" + currentNumber).css("display","none");


                                                                            var allSlides = jQuery(".all_slides").html();

                                                                            jQuery(".cameraSlide_" + allSlides).css("zIndex","999");
                                                                            jQuery(".cameraSlide_" + allSlides).css("display","block");

                                                                            jQuery(".cameraSlide_" + currentNumber).removeClass("cameracurrent");
                                                                            jQuery(".cameraSlide_" + allSlides).addClass("cameracurrent");


                                                                            jQuery(".current_slide").html(allSlides);


                                                                        }
                                                                        sliderNextPrev();
                                                                    });


                                                                    sliderNextPrev();



                                                                    /***********************************/



                                                                }





                                                                function detailHeightWidth(imgWidth, t){
                                                                    /****************/
                                                                    //var containerWidth = $("#camera-slideshow").width();


                                                                    var containerWidthPercent = $(".galleryContainer").width();

                                                                    if(containerWidthPercent < 100){
                                                                        var containerWidth = (containerWidthPercent * document.body.clientWidth) / 100;
                                                                    }else{
                                                                        var containerWidth = containerWidthPercent;
                                                                    }

                                                                    var imgHeight = t.attr("data-img-height");


                                                                    //var containerHeight = $("#camera-slideshow").height();
                                                                    var containerHeight = $(window).height();

                                                                    imgHeight = (containerWidth * imgHeight) / imgWidth;

                                                                    var ar = [imgHeight, containerHeight];

                                                                    return JSON.stringify(ar);
                                                                    /****************/
                                                                }


                                                                function verticalScrollInitialize(){



                                                                    var minTopMargin = 0;
                                                                    var currentTopMargin = minTopMargin;

                                                                    var imgWidth = $(".cameraSlide.cameracurrent").attr("data-img-width");

                                                                    var containerWidthPercent = $(".galleryContainer").width();



                                                                    if(containerWidthPercent < 100){
                                                                        var containerWidth = (containerWidthPercent * document.body.clientWidth) / 100;
                                                                    }else{
                                                                        var containerWidth = containerWidthPercent;
                                                                    }


                                                                    var imgHeight = $(".cameraSlide.cameracurrent").attr("data-img-height");
                                                                    //var containerHeight = $(".galleryContainer").height();
                                                                    //var containerHeight = document.body.clientHeight;

                                                                    var containerHeight = $(window).height();



                                                                    //alert("imgHeight= " + imgHeight);
                                                                    //alert("imgWidth= " + imgWidth);


                                                                    imgHeight = (containerWidth * imgHeight) / imgWidth;

                                                                    //alert(containerHeight);
                                                                    //alert(imgHeight);

                                                                    //var maxTopMargin = containerHeight - imgHeight;
                                                                    var maxTopMargin = imgHeight - containerHeight;


                                                                    $('.camera_top').unbind('click');

                                                                    $('.camera_top').bind('click', function(){

                                                                        if(currentTopMargin > 0) {
                                                                            currentTopMargin = currentTopMargin - 100;

                                                                            $('.cameraCont .cameraSlide.cameracurrent').animate({
                                                                                'backgroundPositionY': '-' + currentTopMargin + 'px',
                                                                                'backgroundPositionX': 'center',
                                                                            }, 1000);

                                                                        }
                                                                    });


                                                                    $('.camera_bottom').unbind('click');

                                                                    $('.camera_bottom').bind('click', function(){

                                                                        //alert(currentTopMargin + " = " + maxTopMargin);

                                                                        if(currentTopMargin < maxTopMargin) {
                                                                            currentTopMargin = currentTopMargin + 100;
                                                                            $('.cameraCont .cameraSlide.cameracurrent').animate({
                                                                                'backgroundPositionY': '-' + currentTopMargin + 'px',
                                                                                'backgroundPositionX': 'center',
                                                                            }, 1000);


                                                                        }
                                                                    });



                                                                }


                                                                function sliderNextPrev(){
                                                                    //alert("==");

                                                                    setTimeout(function() {


                                                                        var imgWidth = $(".cameraSlide.cameracurrent").attr("data-img-width");


                                                                        var ar = detailHeightWidth(imgWidth, $(".cameraSlide.cameracurrent"));

                                                                        ar = JSON.parse(ar);

                                                                        //alert(ar[0] + " -- " + ar[1]);
                                                                        var imgHeight = ar[0];
                                                                        var containerHeight = ar[1];


                                                                        if(imgHeight > containerHeight){

                                                                            //alert(imgHeight + "==" + containerHeight);
                                                                            if($(".camera_top").css("display") == "none"){
                                                                                $(".camera_top").fadeIn(500);
                                                                                $(".camera_bottom").fadeIn(500);
                                                                            }
                                                                            $('.cameraCont .cameraSlide.cameracurrent').animate({
                                                                                'backgroundPositionY': '0px',
                                                                                'backgroundPositionX': 'center',
                                                                            }, 500);

                                                                        }else{
                                                                            if($(".camera_top").css("display") == "block") {

                                                                                $(".camera_top").fadeOut(500);
                                                                                $(".camera_bottom").fadeOut(500);
                                                                            }

                                                                            $('.cameraCont .cameraSlide.cameracurrent').animate({
                                                                                'backgroundPositionY': 'center',
                                                                                'backgroundPositionX': 'center',
                                                                            }, 500);
                                                                        }

                                                                        verticalScrollInitialize();



                                                                    }, 1000)

                                                                }





                                                                jQuery(document).ready(function(){


                                                                    sliderImagesInitialize();



                                                                });
                                                            </script>

                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                        <div id="push"></div>
                                    </div>





                                </div>
                                <noscript>
                                    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-P9FT69"height="0" width="0"
                                            style="display:none;visibility:hidden"></iframe>
                                </noscript>
                                <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
                                        var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
                                        j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                                    })(window,document,'script','dataLayer','GTM-P9FT69');
                                </script><!-- End Google Tag Manager -->


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




    </div>




    <div class="textContainer ajaxContainer2">


        <?php
        include $_SERVER["DOCUMENT_ROOT"]."/includes/detail.php";
        ?>


<div style="clear:both;"></div>

        <?php
        $URL = get_post_meta($_GET["id"], 'URL');

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




    </div>




    <a href="#" data-prev-post-id="<?php echo getPrevPostID($_GET["id"], WP_CATEGORY_PROJECTS_ID); ?>"
       class="prevButton">
        <span></span>
    </a>
    <a href="#" data-next-post-id="<?php echo getNextPostID($_GET["id"], WP_CATEGORY_PROJECTS_ID); ?>"
       class="nextButton">
        <span></span>
    </a>






</div>


<script type="text/javascript">

    function sliderInitialize(data){
        var result = JSON.parse(data);

        //alert(data);

        var leftContent = result[0];
        var rightContent = result[1];

        var nextPostID = result[2];
        var prevPostID = result[3];

        //alert("nextPostID= "+ nextPostID);
        //alert("prevPostID= "+ prevPostID);



        $(".ajaxContainer1").html(leftContent);
        $(".ajaxContainer2").html(rightContent);

        $(".prevButton").attr("data-prev-post-id", prevPostID);
        $(".nextButton").attr("data-next-post-id", nextPostID);


        $(".galleryContainer .camera_wrap img").hide();



        sliderImagesInitialize();



    }



    $(document).ready(function() {
        //
        $(".prevButton").click(function() {
            var idPost = $(this).attr("data-prev-post-id");
            $("#webSiteLoader").fadeIn(500);

            $.post("/ajax/getPost.php", { postId: idPost })
                .done(function(data) {
                    sliderInitialize(data);
                    $("#webSiteLoader").fadeOut(500);
                });

        });

        $(".nextButton").click(function() {
            var idPost = $(this).attr("data-next-post-id");
            $("#webSiteLoader").fadeIn(500);

            $.post("/ajax/getPost.php", { postId: idPost })
                .done(function(data) {
                    sliderInitialize(data);
                    $("#webSiteLoader").fadeOut(500);
                });
        });


    });

</script>



<div id="webSiteLoader" class="webSiteLoaderDetail" style="display:none;">

</div>


<!--
<div class="detail_loader">
    <img src="/img/35.svg" />
</div>
-->






</body> <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-P9FT69"height="0" width="0" style="display:none;visibility:hidden">

    </iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
        var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;
        j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-P9FT69');</script><!-- End Google Tag Manager -->
</html>