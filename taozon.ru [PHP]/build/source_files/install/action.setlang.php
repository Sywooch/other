<?php

@$_SESSION['active_lang'] = @$_POST['lang'];
header('Location: '.$_POST['from']);
