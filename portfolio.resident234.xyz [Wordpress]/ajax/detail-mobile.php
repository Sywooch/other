
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
<?php
$post = get_post( $_GET["id"] );

$gal = get_post_gallery( $_GET["id"], false );


?>

<div data-id="fashion" class="gall_indent detailMobile"
style="background-image:url(<?php echo $gal["src"][0]; ?>);">
<a href="#" class="closeIconMobile closeIconGalleryMobile"></a>



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




    <div class="textContainer ajaxContainer2">


        <div class="overlay"></div>
        <?php
        $post = get_post( $_GET["id"] );
        include $_SERVER["DOCUMENT_ROOT"]."/includes/detail-mobile.php";
        ?>


<div style="clear:both;"></div>

        <?php
        $URL = get_post_meta($_GET["id"], 'URL');

        if(!empty($URL)) {

            ?>

            <h1 class="skills url" style="opacity: 1; bottom: 0px;">

                                <span class="color_link label_link"
                                      style="background-color:#dbdb0c;
                                          color:#000; padding-left:10px;">
                                    <a href="<?php echo $URL[0]; ?>" target="_blank"
                                       style="color:#000;">
                                        <?php echo $URL[0]; ?>
                                    </a>
                                </span>

            </h1>

            <?php
        }

        ?>


        <div style="clear:both; height:20px;"></div>


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