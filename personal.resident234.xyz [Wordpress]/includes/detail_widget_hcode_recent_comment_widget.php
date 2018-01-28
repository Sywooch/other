
<div id="hcode_recent_comment_widget-9" class="widget widget_hcode_recent_comment_widget">
    <div class="widget">
        <h5 class="widget-title font-alt">Новые проекты</h5>

        <div class="thin-separator-line bg-dark-gray no-margin-lr"></div>
        <div class="widget-body">
            <ul class="widget-posts">

                <?php
                foreach($arNewProjects as $newProjectID) {
                    $private = get_post_meta($newProjectID, 'PRIVATE');

                    //?mode=private
                    if ((!isset($_SESSION["mode"]) || ($_SESSION["mode"] != "private")) &&
                        ($private[0] == "1")
                    ) {
                        continue;
                    }

                    if($newProjectID == $_GET["ID"]) continue;

                    $arNewProject = get_post( $newProjectID, ARRAY_A);

                    ?>

                    <li class="clearfix">
                        <div class="widget-posts-details">
                            <a class="author"

                               href="<?php echo $_SERVER["SCRIPT_NAME"]. "?ID=" . $newProjectID; ?>">
                                <?php echo $arNewProject["post_title"]; ?>
                            </a>
                        </div>
                    </li>

                    <?php
                }
                ?>




            </ul>
        </div>
    </div>
</div>