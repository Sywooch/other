<?php
/**
 * Created by PhpStorm.
 * User: GSU
 * Date: 12.08.2017
 * Time: 0:09
 */

if (!function_exists('randomText')) {
    function randomText()
    {

        $categoryId = PORTFOLIO_WP_TEXT_1_ID;

        $args = array(
            'numberposts' => 1,
            'category' => $categoryId,
            'orderby' => 'rand',
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

        unset($currentDetailTitle);
        unset($currentDetailDescription);
        foreach ($posts as $post) {
            setup_postdata($post);


            $currentDetailTitle = $post->post_title;
            $currentDetailDescription = $post->post_content;

        }

        unset($return);
        $return[] = $currentDetailTitle;
        $return[] = $currentDetailDescription;
        return $return;

    }
}

if (!function_exists('postTagName')) {
    function postTagName($arPostTagsNames, $i)
    {
        if ($arPostTagsNames[$i]) {
            echo $arPostTagsNames[$i];
        }
    }
}

if (!function_exists('displayElement')) {
    function displayElement($currentDetailTitle, $i)
    {
        if ($currentDetailTitle[$i]) {
            echo $currentDetailTitle[$i];
        }
    }
}

if (!function_exists('displayRandomElement')) {
    function displayRandomElement($currentDetailTitle)
    {
        if (count($currentDetailTitle) == 1) {
            echo $currentDetailTitle[0];
        } else {
            echo $currentDetailTitle[wp_rand(0, count($currentDetailTitle) - 1)];
        }
    }
}

if (!function_exists('getRandomElement')) {
    function getRandomElement($currentDetailTitle)
    {
        if (count($currentDetailTitle) == 1) {
            return $currentDetailTitle[0];
        } else {
            return $currentDetailTitle[wp_rand(0, count($currentDetailTitle) - 1)];
        }
    }
}

if (!function_exists('getKeyValueRandomElement')) {
    function getKeyValueRandomElement($currentDetailTitle)
    {
        $rand_key = array_rand($currentDetailTitle);
        return array($rand_key, $currentDetailTitle[$rand_key]);
    }
}