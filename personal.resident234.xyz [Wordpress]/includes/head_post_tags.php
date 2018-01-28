<section class="padding-top-40px no-padding-bottom clear-both">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center no-padding">
                <div class="blog-date no-padding-top">
                    <?php
                    $arPostTags = wp_get_post_tags($arProject["ID"]);
                    unset($arPostTagsNames);
                    foreach ($arPostTags as $keyTag => $tag) {
                        $postTagId = $tag->term_id;
                        $arPostTagsNames[] = $tag->name;

                    }

                    echo implode(" | ", $arPostTagsNames);
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>