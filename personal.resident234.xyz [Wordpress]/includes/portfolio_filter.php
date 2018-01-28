<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 25.06.2017
 * Time: 0:50
 */

?>



<li class="nav  active ">
    <a href="#" data-filter="*">Все проекты</a>
</li>


<li class="nav ">
    <a href="#"
       data-filter=".portfolio-filter-<?php echo PORTFOLIO_WP_BEST_PROJECTS_LABEL_ID; ?>">
        Лучшие проекты
    </a>
</li>


<li class="nav ">
    <a href="#"
       data-filter=".portfolio-filter-<?php echo PORTFOLIO_WP_EPISODIC_PARTICIPATION_LABEL_ID; ?>">
        Эпизодическое участие
    </a>
</li>


<li class="nav ">
    <a href="#"
       data-filter=".portfolio-filter-<?php echo PORTFOLIO_WP_FIRST_PROJECT_LABEL_ID; ?>">
        Один из первых проектов
    </a>
</li>

<?php



//собрать список навыков.
//имя, картинка, цвет категории
$categoryId = PORTFOLIO_WP_CATEGORY_SKILLS_ID;

$args = array(
    'numberposts' => 1000,
    'category' => $arSkillsCategoriesIDs,
    'orderby' => 'ID',
    'order' => 'ASC',
    'include' => array(),
    'exclude' => array(),
    'meta_key' => '',
    'meta_value' => '',
    'post_type' => 'post',
    'suppress_filters' => true,
    // подавление работы фильтров изменения SQL запроса
);

$posts = get_posts($args);

//unset($arSkills);
foreach ($posts as $post) {
    setup_postdata($post);


    $personal = get_post_meta($post->ID, 'PERSONAL');
    if($personal && $personal[0] == "1"){


        $labels = wp_get_post_tags($post->ID);

        //$labels[0]->term_id
        //$labels[0]->name


        $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

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
            'suppress_filters' => true,
            'tag__in' => array($labels[0]->term_id)
            // подавление работы фильтров изменения SQL запроса
        );

        $elements = get_posts($args);

        if(count($elements)){

            ?>
            <li class="nav ">
                <a href="#"
                   data-filter=".portfolio-filter-<?php echo $labels[0]->term_id;?>">
                    <?php echo $labels[0]->name;?>
                </a>
            </li>
            <?php

        }


    };


    ?>

    <?php

}


wp_reset_postdata();
?>



<?php



$categoryId = PORTFOLIO_WP_CATEGORY_SITES_ID;

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
    'suppress_filters' => true,
    // подавление работы фильтров изменения SQL запроса
);

$posts = get_posts($args);

//unset($arSkills);
foreach ($posts as $post) {
    setup_postdata($post);



    $labels = wp_get_post_tags($post->ID);

    //$labels[0]->term_id
    //$labels[0]->name


    $categoryId = PORTFOLIO_WP_CATEGORY_PROJECTS_ID;

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
        'suppress_filters' => true,
        'tag__in' => array($labels[0]->term_id)
        // подавление работы фильтров изменения SQL запроса
    );

    $elements = get_posts($args);

    if(count($elements)){

        ?>
        <li class="nav ">
            <a href="#"
               data-filter=".portfolio-filter-<?php echo $labels[0]->term_id;?>">
                <?php echo $labels[0]->name;?>
            </a>
        </li>
        <?php

    }



    ?>

    <?php

}


wp_reset_postdata();
?>



