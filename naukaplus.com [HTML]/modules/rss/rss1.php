<?

$rss = "http://www.rian.ru/export/rss2/science/index.xml";
$file = './files/rss/rss1.txt';


// ������� ����� 
$time_sec=time(); 
// ����� ��������� ����� 
$time_file=filemtime($file); 
// ����� ������ ������� ������ ������� (� ��������) 
$time=$time_sec-$time_file;


if ($time > 60*60*4) // 
{
	# ����� 4 ����� ������, �� ���������
	rss1($file, $rss);
	echo file_get_contents($file);
}
else
{
	echo file_get_contents($file);
}









function rss1($file, $rss)
{	
	require_once 'inc.rss2array.php';
	$rss_array = rss2array($rss);

	
	file_put_contents($file, '
							<tr><td></td><td>
							<p class="date"></p>
							<p>'.iconv('UTF-8', 'cp1251', $rss_array['items'][0]['title']).'</p>
							<p class="link"><noindex><a href="'.$rss_array['items'][0]['link'].'" target="_new">�����</a></noindex></p>
						</td><td></td></tr>
						<tr><td></td><td id="news-dot"></td><td></td></tr>
	');
}
?>