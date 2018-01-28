<div id="tag_cloud-4" class="widget widget_tag_cloud">
    <h5 class="widget-title font-alt">
        Тэги
    </h5>
    <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
    <div class="tagcloud">
        <div class="tags_cloud tags">


            <?php
            foreach($arPostTagsNames as $tagName) {
                ?>

                <a href='#'

                   class='tag-link-84 tag-link-position-1'
                   title=''

                   style='font-size: 22pt;'>
                    <?php echo $tagName; ?>
                </a>

                <?php
            }
            ?>


        </div>
    </div>
</div>