<?php
class Taoadmin
{
    public function defaultAction(){
        header('Location: /taoadmin/index.php?cmd=Logout');
    }
}
