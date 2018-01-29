<?php

$img_local = dirname(__FILE__).'/cache/'.end(explode('/',$_POST['src']));
if(!file_exists($img_local)){
    $image = file_get_contents($_POST['src'].'_160x160.jpg');
    file_put_contents($img_local, $image);
}
print $img_local;
