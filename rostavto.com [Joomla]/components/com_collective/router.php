<?php

defined('_JEXEC') or die ;

// Никому это все равно не понадобится
function CollectiveBuildRoute(&$query) {
    return $query;
}
// Какого-то хрена ничего не работает (Кеширование косячит???)
// см. "../com_content/router.php"
function CollectiveParseRoute($segments) {
    die('Parse!');
}
