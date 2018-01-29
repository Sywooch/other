<?

$file = 'cache/Valuta.php';

if (file_exists($file))
{
    @eval(file_get_contents($file));
};

if (file_exists($file) && filemtime($file) < time()-60*60)
{
    //
} else {
    $x = @simplexml_load_file('http://www.cbr.ru/scripts/XML_daily.asp');
    if ($x)
    {
        $cnyrub = 0;
        $usdrub = 0;
        foreach($x->Valute as $curs)
        {
            if ((string)$curs->CharCode == 'CNY')
            {
                $cnyrub = str_replace(',', '.', (string)$curs->Value) / (int)$curs->Nominal;
            }
            if ((string)$curs->CharCode == 'USD')
            {
                $usdrub = str_replace(',', '.', (string)$curs->Value) / (int)$curs->Nominal;
            }
        }
        $cnyusd = $cnyrub / $usdrub;
        $data = '<? $cnyrub = '.$cnyrub.'; $cnyusd = '.$cnyusd.'; ?>';
        @file_put_contents($file, $data);
    }
}

$GLOBALS['cnyrub'] = $cnyrub;
$GLOBALS['cnyusd'] = $cnyusd;

?>