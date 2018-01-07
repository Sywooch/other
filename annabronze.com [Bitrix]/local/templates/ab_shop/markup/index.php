<?
$dh  = opendir("./");
while (false !== ($filename = readdir($dh))) {

    $files[] = $filename;
}
sort($files);

foreach($files as $filename){
if(strstr($filename,".html"))
echo "<a href='$filename#open'>$filename</a><br />";
}