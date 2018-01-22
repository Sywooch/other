<?php

header('Content-type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");
define ( "DB_SERVER", "localhost" ); 
define ( "DB_BASE", "ru3topolya_mgl2" ); 
define ( "DB_USER", "ru3topolya_mgl2" ); 
define ( "DB_PASS", "raEI6VcuHz"); 

//define ( "DB_BASE", "mgl" ); 
//define ( "DB_USER", "root" ); 
//define ( "DB_PASS", ""); 






$dbh=mysql_connect(DB_SERVER,DB_USER,DB_PASS) or die ("Невозможно соединиться с сервером.");
mysql_select_db(DB_BASE) or die ("Невозможно подключиться к базе.");
mysql_query("set character_set_results='utf8'");
			mysql_query("SET NAMES utf8");
mysql_query ("SET COLLATION_CONNECTION=utf8");
mysql_query("SET CHARACTER_SET_CLIENT=utf8");
mysql_query("SET CHARACTER_SET_RESULTS=utf8");


	$mimetypes = Array ( 
    "123" => "application/vnd.lotus-1-2-3", 
    "3ds" => "image/x-3ds", 
    "669" => "audio/x-mod", 
    "a" => "application/x-archive", 
    "abw" => "application/x-abiword", 
    "ac3" => "audio/ac3", 
    "adb" => "text/x-adasrc", 
    "ads" => "text/x-adasrc", 
    "afm" => "application/x-font-afm", 
    "ag" => "image/x-applix-graphics", 
    "ai" => "application/illustrator", 
    "aif" => "audio/x-aiff", 
    "aifc" => "audio/x-aiff", 
    "aiff" => "audio/x-aiff", 
    "al" => "application/x-perl", 
    "arj" => "application/x-arj", 
    "as" => "application/x-applix-spreadsheet", 
    "asc" => "text/plain", 
    "asf" => "video/x-ms-asf", 
    "asp" => "application/x-asp", 
    "asx" => "video/x-ms-asf", 
    "au" => "audio/basic", 
    "avi" => "video/x-msvideo", 
    "aw" => "application/x-applix-word", 
    "bak" => "application/x-trash", 
    "bcpio" => "application/x-bcpio", 
    "bdf" => "application/x-font-bdf", 
    "bib" => "text/x-bibtex", 
    "bin" => "application/octet-stream", 
    "blend" => "application/x-blender", 
    "blender" => "application/x-blender", 
    "bmp" => "image/bmp", 
    "bz" => "application/x-bzip", 
    "bz2" => "application/x-bzip", 
    "c" => "text/x-csrc", 
    "c++" => "text/x-c++src", 
    "cc" => "text/x-c++src", 
    "cdf" => "application/x-netcdf", 
    "cdr" => "application/vnd.corel-draw", 
    "cer" => "application/x-x509-ca-cert", 
    "cert" => "application/x-x509-ca-cert", 
    "cgi" => "application/x-cgi", 
    "cgm" => "image/cgm", 
    "chrt" => "application/x-kchart", 
    "class" => "application/x-java", 
    "cls" => "text/x-tex", 
    "cpio" => "application/x-cpio", 
    "cpp" => "text/x-c++src", 
    "crt" => "application/x-x509-ca-cert", 
    "cs" => "text/x-csharp", 
    "csh" => "application/x-shellscript", 
    "css" => "text/css", 
    "cssl" => "text/css", 
    "csv" => "text/x-comma-separated-values", 
    "cur" => "image/x-win-bitmap", 
    "cxx" => "text/x-c++src", 
    "dat" => "video/mpeg", 
    "dbf" => "application/x-dbase", 
    "dc" => "application/x-dc-rom", 
    "dcl" => "text/x-dcl", 
    "dcm" => "image/x-dcm", 
    "deb" => "application/x-deb", 
    "der" => "application/x-x509-ca-cert", 
    "desktop" => "application/x-desktop", 
    "dia" => "application/x-dia-diagram", 
    "diff" => "text/x-patch", 
    "djv" => "image/vnd.djvu", 
    "djvu" => "image/vnd.djvu", 
    "doc" => "application/vnd.ms-word", 
    "dsl" => "text/x-dsl", 
    "dtd" => "text/x-dtd", 
    "dvi" => "application/x-dvi", 
    "dwg" => "image/vnd.dwg", 
    "dxf" => "image/vnd.dxf", 
    "egon" => "application/x-egon", 
    "el" => "text/x-emacs-lisp", 
    "eps" => "image/x-eps", 
    "epsf" => "image/x-eps", 
    "epsi" => "image/x-eps", 
    "etheme" => "application/x-e-theme", 
    "etx" => "text/x-setext", 
    "exe" => "application/x-ms-dos-executable", 
    "ez" => "application/andrew-inset", 
    "f" => "text/x-fortran", 
    "fig" => "image/x-xfig", 
    "fits" => "image/x-fits", 
    "flac" => "audio/x-flac", 
    "flc" => "video/x-flic", 
    "fli" => "video/x-flic", 
    "flw" => "application/x-kivio", 
    "fo" => "text/x-xslfo", 
    "g3" => "image/fax-g3", 
    "gb" => "application/x-gameboy-rom", 
    "gcrd" => "text/x-vcard", 
    "gen" => "application/x-genesis-rom", 
    "gg" => "application/x-sms-rom", 
    "gif" => "image/gif", 
    "glade" => "application/x-glade", 
    "gmo" => "application/x-gettext-translation", 
    "gnc" => "application/x-gnucash", 
    "gnucash" => "application/x-gnucash", 
    "gnumeric" => "application/x-gnumeric", 
    "gra" => "application/x-graphite", 
    "gsf" => "application/x-font-type1", 
    "gtar" => "application/x-gtar", 
    "gz" => "application/x-gzip", 
    "h" => "text/x-chdr", 
    "h++" => "text/x-chdr", 
    "hdf" => "application/x-hdf", 
    "hh" => "text/x-c++hdr", 
    "hp" => "text/x-chdr", 
    "hpgl" => "application/vnd.hp-hpgl", 
    "hs" => "text/x-haskell", 
    "htm" => "text/html", 
    "html" => "text/html", 
    "icb" => "image/x-icb", 
    "ico" => "image/x-ico", 
    "ics" => "text/calendar", 
    "idl" => "text/x-idl", 
    "ief" => "image/ief", 
    "iff" => "image/x-iff", 
    "ilbm" => "image/x-ilbm", 
    "iso" => "application/x-cd-image", 
    "it" => "audio/x-it", 
    "jar" => "application/x-jar", 
    "java" => "text/x-java", 
    "jng" => "image/x-jng", 
    "jp2" => "image/jpeg2000", 
    "jpe" => "image/jpeg", 
    "jpeg" => "image/jpeg", 
    "jpg" => "image/jpeg", 
    "jpr" => "application/x-jbuilder-project", 
    "jpx" => "application/x-jbuilder-project", 
    "js" => "application/x-javascript", 
    "karbon" => "application/x-karbon", 
    "kdelnk" => "application/x-desktop", 
    "kfo" => "application/x-kformula", 
    "kil" => "application/x-killustrator", 
    "kon" => "application/x-kontour", 
    "kpm" => "application/x-kpovmodeler", 
    "kpr" => "application/x-kpresenter", 
    "kpt" => "application/x-kpresenter", 
    "kra" => "application/x-krita", 
    "ksp" => "application/x-kspread", 
    "kud" => "application/x-kugar", 
    "kwd" => "application/x-kword", 
    "kwt" => "application/x-kword", 
    "la" => "application/x-shared-library-la", 
    "lha" => "application/x-lha", 
    "lhs" => "text/x-literate-haskell", 
    "lhz" => "application/x-lhz", 
    "log" => "text/x-log", 
    "ltx" => "text/x-tex", 
    "lwo" => "image/x-lwo", 
    "lwob" => "image/x-lwo", 
    "lws" => "image/x-lws", 
    "lyx" => "application/x-lyx", 
    "lzh" => "application/x-lha", 
    "lzo" => "application/x-lzop", 
    "m" => "text/x-objcsrc", 
    "m15" => "audio/x-mod", 
    "m3u" => "audio/x-mpegurl", 
    "man" => "application/x-troff-man", 
    "md" => "application/x-genesis-rom", 
    "me" => "text/x-troff-me", 
    "mgp" => "application/x-magicpoint", 
    "mid" => "audio/midi", 
    "midi" => "audio/midi", 
    "mif" => "application/x-mif", 
    "mkv" => "application/x-matroska", 
    "mm" => "text/x-troff-mm", 
    "mml" => "text/mathml", 
    "mng" => "video/x-mng", 
    "moc" => "text/x-moc", 
    "mod" => "audio/x-mod", 
    "moov" => "video/quicktime", 
    "mov" => "video/quicktime", 
    "movie" => "video/x-sgi-movie", 
    "mp2" => "video/mpeg", 
    "mp3" => "audio/x-mp3", 
    "mpe" => "video/mpeg", 
    "mpeg" => "video/mpeg", 
    "mpg" => "video/mpeg", 
    "ms" => "text/x-troff-ms", 
    "msod" => "image/x-msod", 
    "msx" => "application/x-msx-rom", 
    "mtm" => "audio/x-mod", 
    "n64" => "application/x-n64-rom", 
    "nc" => "application/x-netcdf", 
    "nes" => "application/x-nes-rom", 
    "nsv" => "video/x-nsv", 
    "o" => "application/x-object", 
    "obj" => "application/x-tgif", 
    "oda" => "application/oda", 
    "ogg" => "application/ogg", 
    "old" => "application/x-trash", 
    "oleo" => "application/x-oleo", 
    "p" => "text/x-pascal", 
    "p12" => "application/x-pkcs12", 
    "p7s" => "application/pkcs7-signature", 
    "pas" => "text/x-pascal", 
    "patch" => "text/x-patch", 
    "pbm" => "image/x-portable-bitmap", 
    "pcd" => "image/x-photo-cd", 
    "pcf" => "application/x-font-pcf", 
    "pcl" => "application/vnd.hp-pcl", 
    "pdb" => "application/vnd.palm", 
    "pdf" => "application/pdf", 
    "pem" => "application/x-x509-ca-cert", 
    "perl" => "application/x-perl", 
    "pfa" => "application/x-font-type1", 
    "pfb" => "application/x-font-type1", 
    "pfx" => "application/x-pkcs12", 
    "pgm" => "image/x-portable-graymap", 
    "pgn" => "application/x-chess-pgn", 
    "pgp" => "application/pgp", 
    "php" => "application/x-php", 
    "php3" => "application/x-php", 
    "php4" => "application/x-php", 
    "pict" => "image/x-pict", 
    "pict1" => "image/x-pict", 
    "pict2" => "image/x-pict", 
    "pl" => "application/x-perl", 
    "pls" => "audio/x-scpls", 
    "pm" => "application/x-perl", 
    "png" => "image/png", 
    "pnm" => "image/x-portable-anymap", 
    "po" => "text/x-gettext-translation", 
    "pot" => "text/x-gettext-translation-template", 
    "ppm" => "image/x-portable-pixmap", 
    "pps" => "application/vnd.ms-powerpoint", 
    "ppt" => "application/vnd.ms-powerpoint", 
    "ppz" => "application/vnd.ms-powerpoint", 
    "ps" => "application/postscript", 
    "psd" => "image/x-psd", 
    "psf" => "application/x-font-linux-psf", 
    "psid" => "audio/prs.sid", 
    "pw" => "application/x-pw", 
    "py" => "application/x-python", 
    "pyc" => "application/x-python-bytecode", 
    "pyo" => "application/x-python-bytecode", 
    "qif" => "application/x-qw", 
    "qt" => "video/quicktime", 
    "qtvr" => "video/quicktime", 
    "ra" => "audio/x-pn-realaudio", 
    "ram" => "audio/x-pn-realaudio", 
    "rar" => "application/x-rar", 
    "ras" => "image/x-cmu-raster", 
    "rdf" => "text/rdf", 
    "rej" => "application/x-reject", 
    "rgb" => "image/x-rgb", 
    "rle" => "image/rle", 
    "rm" => "audio/x-pn-realaudio", 
    "roff" => "application/x-troff", 
    "rpm" => "application/x-rpm", 
    "rss" => "text/rss", 
    "rtf" => "application/rtf", 
    "rtx" => "text/richtext", 
    "s3m" => "audio/x-s3m", 
    "sam" => "application/x-amipro", 
    "scm" => "text/x-scheme", 
    "sda" => "application/vnd.stardivision.draw", 
    "sdc" => "application/vnd.stardivision.calc", 
    "sdd" => "application/vnd.stardivision.impress", 
    "sdp" => "application/vnd.stardivision.impress", 
    "sds" => "application/vnd.stardivision.chart", 
    "sdw" => "application/vnd.stardivision.writer", 
    "sgi" => "image/x-sgi", 
    "sgl" => "application/vnd.stardivision.writer", 
    "sgm" => "text/sgml", 
    "sgml" => "text/sgml", 
    "sh" => "application/x-shellscript", 
    "shar" => "application/x-shar", 
    "siag" => "application/x-siag", 
    "sid" => "audio/prs.sid", 
    "sik" => "application/x-trash", 
    "slk" => "text/spreadsheet", 
    "smd" => "application/vnd.stardivision.mail", 
    "smf" => "application/vnd.stardivision.math", 
    "smi" => "application/smil", 
    "smil" => "application/smil", 
    "sml" => "application/smil", 
    "sms" => "application/x-sms-rom", 
    "snd" => "audio/basic", 
    "so" => "application/x-sharedlib", 
    "spd" => "application/x-font-speedo", 
    "sql" => "text/x-sql", 
    "src" => "application/x-wais-source", 
    "stc" => "application/vnd.sun.xml.calc.template", 
    "std" => "application/vnd.sun.xml.draw.template", 
    "sti" => "application/vnd.sun.xml.impress.template", 
    "stm" => "audio/x-stm", 
    "stw" => "application/vnd.sun.xml.writer.template", 
    "sty" => "text/x-tex", 
    "sun" => "image/x-sun-raster", 
    "sv4cpio" => "application/x-sv4cpio", 
    "sv4crc" => "application/x-sv4crc", 
    "svg" => "image/svg+xml", 
    "swf" => "application/x-shockwave-flash", 
    "sxc" => "application/vnd.sun.xml.calc", 
    "sxd" => "application/vnd.sun.xml.draw", 
    "sxg" => "application/vnd.sun.xml.writer.global", 
    "sxi" => "application/vnd.sun.xml.impress", 
    "sxm" => "application/vnd.sun.xml.math", 
    "sxw" => "application/vnd.sun.xml.writer", 
    "sylk" => "text/spreadsheet", 
    "t" => "application/x-troff", 
    "tar" => "application/x-tar", 
    "tcl" => "text/x-tcl", 
    "tcpalette" => "application/x-terminal-color-palette", 
    "tex" => "text/x-tex", 
    "texi" => "text/x-texinfo", 
    "texinfo" => "text/x-texinfo", 
    "tga" => "image/x-tga", 
    "tgz" => "application/x-compressed-tar", 
    "theme" => "application/x-theme", 
    "tif" => "image/tiff", 
    "tiff" => "image/tiff", 
    "tk" => "text/x-tcl", 
    "torrent" => "application/x-bittorrent", 
    "tr" => "application/x-troff", 
    "ts" => "application/x-linguist", 
    "tsv" => "text/tab-separated-values", 
    "ttf" => "application/x-font-ttf", 
    "txt" => "text/plain", 
    "tzo" => "application/x-tzo", 
    "ui" => "application/x-designer", 
    "uil" => "text/x-uil", 
    "ult" => "audio/x-mod", 
    "uni" => "audio/x-mod", 
    "uri" => "text/x-uri", 
    "url" => "text/x-uri", 
    "ustar" => "application/x-ustar", 
    "vcf" => "text/x-vcalendar", 
    "vcs" => "text/x-vcalendar", 
    "vct" => "text/x-vcard", 
    "vob" => "video/mpeg", 
    "voc" => "audio/x-voc", 
    "vor" => "application/vnd.stardivision.writer", 
    "vpp" => "application/x-extension-vpp", 
    "wav" => "audio/x-wav", 
    "wb1" => "application/x-quattropro", 
    "wb2" => "application/x-quattropro", 
    "wb3" => "application/x-quattropro", 
    "wk1" => "application/vnd.lotus-1-2-3", 
    "wk3" => "application/vnd.lotus-1-2-3", 
    "wk4" => "application/vnd.lotus-1-2-3", 
    "wks" => "application/vnd.lotus-1-2-3", 
    "wmf" => "image/x-wmf", 
    "wml" => "text/vnd.wap.wml", 
    "wmv" => "video/x-ms-wmv", 
    "wpd" => "application/vnd.wordperfect", 
    "wpg" => "application/x-wpg", 
    "wri" => "application/x-mswrite", 
    "wrl" => "model/vrml", 
    "xac" => "application/x-gnucash", 
    "xbel" => "application/x-xbel", 
    "xbm" => "image/x-xbitmap", 
    "xcf" => "image/x-xcf", 
    "xhtml" => "application/xhtml+xml", 
    "xi" => "audio/x-xi", 
    "xla" => "application/vnd.ms-excel", 
    "xlc" => "application/vnd.ms-excel", 
    "xld" => "application/vnd.ms-excel", 
    "xll" => "application/vnd.ms-excel", 
    "xlm" => "application/vnd.ms-excel", 
    "xls" => "application/vnd.ms-excel", 
    "xlt" => "application/vnd.ms-excel", 
    "xlw" => "application/vnd.ms-excel", 
    "xm" => "audio/x-xm", 
    "xmi" => "text/x-xmi", 
    "xml" => "text/xml", 
    "xpm" => "image/x-xpixmap", 
    "xsl" => "text/x-xslt", 
    "xslfo" => "text/x-xslfo", 
    "xslt" => "text/x-xslt", 
    "xwd" => "image/x-xwindowdump", 
    "z" => "application/x-compress", 
    "zabw" => "application/x-abiword", 
    "zip" => "application/zip", 
    "zoo" => "application/x-zoo" 
); 



function get_mime_type($ext) { 
    // Массив с MIME-типами 
    global $mimetypes; 
    // Расширение в нижний регистр 
    $ext=trim(strtolower($ext)); 
    if ($ext!='' && isset($mimetypes[$ext])) { 
        // Если есть такой MIME-тип, то вернуть его 
        return $mimetypes[$ext]; 
    } 
    else { 
        // Иначе вернуть дефолтный MIME-тип 
        return "application/force-download"; 
    }     
} 



$query="SELECT * FROM p_goods WHERE moderation='2'";
$res=mysql_query($query);
while($row=mysql_fetch_array($res)){

	$good_name=$row['good_name'];
	$good_description=$row['good_description'];
	$good_price=$row['good_price'];
	$good_image1=$row['good_image1'];
	$good_image2=$row['good_image2'];
	$good_image3=$row['good_image3'];
	$good_category=$row['good_category'];
	$good_id=$row['good_id'];
	$good_count=$row['good_count'];

//echo $good_name."<br>";
//echo $good_description."<br>";
//echo $good_price."<br>";
//echo $good_image1."<br>";
//echo $good_image2."<br>";
//echo $good_image3."<br>";
//echo $good_category."<br>";
//echo $good_id."<br>";
//echo "<br>";



	//вставка наименования, описания и т.д.
	
	$max_id = mysql_result(mysql_query("SELECT MAX(virtuemart_product_id) FROM jos_virtuemart_products_ru_ru"),0);

	$max_id=$max_id+1;
	//echo $good_name;
	$slug=mb_strtolower($good_name);
	
	
	//echo $slug;
	$slug=preg_replace('|[^\d\w ]+|ui','-',$slug);
	$slug=str_replace(" ","-",$slug);
	//echo $slug;
	
	 $query = mysql_query("SELECT `slug` FROM `jos_virtuemart_products_ru_ru` WHERE `slug` = '{$slug}' LIMIT 1");
	 if(mysql_num_rows($query) > 0) { 
      $slug=$slug.rand();
     }
	 
	// echo "= ".$slug;
	 
	 
	 
	
	$query_in="INSERT INTO jos_virtuemart_products_ru_ru (virtuemart_product_id,product_s_desc,product_desc,product_name,slug) VALUES ('$max_id','$good_description','$good_description','$good_name','$slug')";
	$res_in=mysql_query($query_in);

	if($res_in==false){
					echo"Ошибка выполнения запроса.#19";
					echo mysql_error();
					exit; }




	//id только что вставленной записи
	//$last_id = mysql_insert_id();
	$last_id=$max_id;
	//echo $last_id;







$query_in="INSERT INTO jos_virtuemart_products (virtuemart_product_id,virtuemart_vendor_id,product_parent_id,product_weight_uom,product_lwh_uom,product_unit,published,layout,product_in_stock) VALUES ('$last_id','1','0','KG','M','KG','1','0','$good_count')";
	$res_in=mysql_query($query_in);

	if($res_in==false){
					echo"Ошибка выполнения запроса.#12";
					echo mysql_error();
					exit; }










	//вставка ценника
	$query_in2="INSERT INTO jos_virtuemart_product_prices (virtuemart_product_id,product_price,virtuemart_shoppergroup_id,override,product_override_price,product_tax_id,product_discount_id,product_currency,product_price_publish_up,product_price_publish_down,price_quantity_start,price_quantity_end) VALUES ('$last_id','$good_price',0,0,0,0,0,0,0,0,0,0)";
	$res_in2=mysql_query($query_in2);

	if($res_in2==false){
					echo"Ошибка выполнения запроса.#13";
					echo mysql_error();
					exit; }
				
	//вставка категории
	//$query2="SELECT * FROM jos_virtuemart_categories_ru_ru WHERE category_name='$good_category'";
	//$res_2=mysql_query($query2);
	//$category_id=mysql_result($res_2,0);

	//echo $category_id;
	//echo $good_category;

 	$query = mysql_query("SELECT `category_name` FROM `jos_virtuemart_categories_ru_ru` WHERE `category_name` = '{$good_category}' LIMIT 1");
		if(mysql_num_rows($query) > 0) { 
			
			$query2="SELECT * FROM jos_virtuemart_categories_ru_ru WHERE category_name='$good_category'";
			$res_2=mysql_query($query2);
			$category_id=mysql_result($res_2,0);	
		
			//$slug=$slug.rand();
    	}else{
			
			
		
			$max_id_cat = mysql_result(mysql_query("SELECT MAX(virtuemart_category_id) FROM jos_virtuemart_categories_ru_ru"),0);
			
			$max_id_cat=$max_id_cat+1;
			$slug_cat=mb_strtolower($good_category);
			$slug_cat=preg_replace('|[^\d\w ]+|ui','-',$slug_cat);
			$slug_cat=str_replace(" ","-",$slug_cat);
			
			
			$query = mysql_query("SELECT `slug` FROM `jos_virtuemart_categories_ru_ru` WHERE `slug` = '{$slug_cat}' LIMIT 1");
	 		if(mysql_num_rows($query) > 0) { 
      			$slug_cat=$slug_cat.rand();
     		}
			
			$query_in="INSERT INTO jos_virtuemart_categories_ru_ru (virtuemart_category_id,category_name,slug) VALUES ('$max_id_cat','$good_category','$slug_cat')";
			$res_in=mysql_query($query_in);

			if($res_in==false){
					echo"Ошибка выполнения запроса.#14";
					echo mysql_error();
					exit; }
					
			$category_id=$max_id_cat;
			
		
		
		
		
		
		
		}
		
		
		//echo $category_id;
		


	

	$query_in3="INSERT INTO jos_virtuemart_product_categories (virtuemart_product_id,virtuemart_category_id) VALUES ('$last_id','$category_id')";
	$res_in3=mysql_query($query_in3);

	if($res_in3==false){
					echo"Ошибка выполнения запроса.#15";
					echo mysql_error();
					exit; }
									


	//$good_image1=$row['good_image1'];
	//$good_image2=$row['good_image2'];
	//$good_image3=$row['good_image3'];

	if($good_image1!=NULL){

	//$query_img1="INSERT INTO jos_virtuemart_product_medias (virtuemart_product_id) VALUES ('$last_id')";
	//$res_img1=mysql_query($query_img1);

	//if($res_img1==false){
	//				echo"Ошибка выполнения запроса.";
	//				echo mysql_error();
	//				exit; }
					
	$media1 = mysql_result(mysql_query("SELECT MAX(virtuemart_media_id) FROM jos_virtuemart_product_medias"),0);
	$media1=$media1+1;
	
	$query_img1="INSERT INTO jos_virtuemart_product_medias (virtuemart_product_id, virtuemart_media_id) VALUES ('$last_id', '$media1')";
	$res_img1=mysql_query($query_img1);

	if($res_img1==false){
					echo"Ошибка выполнения запроса.#17";
					echo mysql_error();
					exit; }
	
	$f_type_m=explode(".",$good_image1);
	
	$f_type=$f_type_m[count($f_type_m)-1];
	//echo $f_type;
	
	




	
	$file_mimetype=get_mime_type($f_type);
	$new_name_file1=rand().date();
	$new_name_file1=$new_name_file1.".".$f_type;
	
	
	if (!copy($good_image1, "/home/r/ru3topolya/domains/mygardenland/public_html/images/stories/virtuemart/product/".$new_name_file1."")) {
    echo "не удалось скопировать";
	}
	

	$query_img1="INSERT INTO jos_virtuemart_medias (virtuemart_media_id, file_url, file_title, file_mimetype) VALUES ('$media1','$new_name_file1','-','$file_mimetype')";
	$res_img1=mysql_query($query_img1);

	if($res_img1==false){
					echo"Ошибка выполнения запроса.#18";
					echo mysql_error();
					exit; }




	}









	if($good_image2!=NULL){

	$media2 = mysql_result(mysql_query("SELECT MAX(virtuemart_media_id) FROM jos_virtuemart_product_medias"),0);
	$media2=$media1+1;
	
	$query_img2="INSERT INTO jos_virtuemart_product_medias (virtuemart_product_id, virtuemart_media_id) VALUES ('$last_id', '$media2')";
	$res_img2=mysql_query($query_img2);

	if($res_img2==false){
					echo"Ошибка выполнения запроса.#1";
					echo mysql_error();
					exit; }
	
	$f_type_m=explode(".",$good_image2);
	
	$f_type=$f_type_m[count($f_type_m)-1];
	//echo $f_type;
	
	




	
	$file_mimetype=get_mime_type($f_type);
	$new_name_file2=rand().date();
	$new_name_file2=$new_name_file2.".".$f_type;
	
	
	if (!copy($good_image2, "/home/r/ru3topolya/domains/mygardenland/public_html/images/stories/virtuemart/product/".$new_name_file2."")) {
    echo "не удалось скопировать";
	}
	

	$query_img2="INSERT INTO jos_virtuemart_medias (virtuemart_media_id, file_url, file_title, file_mimetype) VALUES ('$media2','$new_name_file2','-','$file_mimetype')";
	$res_img2=mysql_query($query_img2);

	if($res_img2==false){
					echo"Ошибка выполнения запроса.#2";
					echo mysql_error();
					exit; }





	}














	if($good_image3!=NULL){

	$media3 = mysql_result(mysql_query("SELECT MAX(virtuemart_media_id) FROM jos_virtuemart_product_medias"),0);
	$media3=$media3+1;
	
	$query_img3="INSERT INTO jos_virtuemart_product_medias (virtuemart_product_id, virtuemart_media_id) VALUES ('$last_id', '$media3')";
	$res_img3=mysql_query($query_img3);

	if($res_img3==false){
					echo"Ошибка выполнения запроса.#3";
					echo mysql_error();
					exit; }
	
	$f_type_m=explode(".",$good_image3);
	
	$f_type=$f_type_m[count($f_type_m)-1];
	//echo $f_type;
	
	




	
	$file_mimetype=get_mime_type($f_type);
	$new_name_file3=rand().date();
	$new_name_file3=$new_name_file3.".".$f_type;
	
	
	if (!copy($good_image3, "/home/r/ru3topolya/domains/mygardenland/public_html/images/stories/virtuemart/product/".$new_name_file3."")) {
    echo "не удалось скопировать";
	}
	

	$query_img3="INSERT INTO jos_virtuemart_medias (virtuemart_media_id, file_url, file_title, file_mimetype) VALUES ('$media3','$new_name_file3','-','$file_mimetype')";
	$res_img3=mysql_query($query_img3);

	if($res_img3==false){
					echo"Ошибка выполнения запроса.#4";
					echo mysql_error();
					exit; }

	
		


	}








	//установка moderation=3 в таблице - доноре.
	//good_id
	$query_upd="UPDATE p_goods SET moderation='3' WHERE good_id='$good_id'";
	$res_upd=mysql_query($query_upd);

	if($res_upd==false){
					echo"Ошибка выполнения запроса.#5";
					echo mysql_error();
					exit; }








}












$query3="SELECT * FROM p_goods WHERE moderation='4'";
$res3=mysql_query($query3);

if($res3==false){
					echo"Ошибка выполнения запроса.#6";
					echo mysql_error();
					exit; }


while($row3=mysql_fetch_array($res3)){
	

$good_name=$row3['good_name'];
//echo $good_name."  = ";


//$query4="SELECT * FROM jos_virtuemart_products_ru_ru WHERE product_name='$good_name'";
//$res_4=mysql_query($query4);


$query = mysql_query("SELECT `product_name` FROM `jos_virtuemart_products_ru_ru` WHERE `product_name` = '{$good_name}' LIMIT 1");
	 if(mysql_num_rows($query) > 0) { 
     //удаляемый продукт существует.
	 //выяснение id удаляемого продукта
	  
	 $query4="SELECT * FROM jos_virtuemart_products_ru_ru WHERE product_name='$good_name'";
	 $res_4=mysql_query($query4);
	 $product_id=mysql_result($res_4,0);
	 //echo $product_id;
	  
     }else{
		continue; 
	 }

//if($res3==false){
//					echo"Ошибка выполнения запроса.#7";
//					echo mysql_error();
//					exit; }


//id продукта, который нужно удалить
//$product_id=mysql_result($res_4,0);




$query_delete1="DELETE FROM jos_virtuemart_products_ru_ru WHERE virtuemart_product_id='$product_id'";
$res_delete1=mysql_query($query_delete1);

if($res_delete1==false){
					echo"Ошибка выполнения запроса.#8";
					echo mysql_error();
					exit; }
					
				
$query_delete2="DELETE FROM jos_virtuemart_product_categories WHERE virtuemart_product_id='$product_id'";
$res_delete2=mysql_query($query_delete2);

if($res_delete2==false){
					echo"Ошибка выполнения запроса.#9";
					echo mysql_error();
					exit; }



$query_delete3="DELETE FROM jos_virtuemart_product_prices WHERE virtuemart_product_id='$product_id'";
$res_delete3=mysql_query($query_delete3);

if($res_delete3==false){
					echo"Ошибка выполнения запроса.#10";
					echo mysql_error();
					exit; }
					
	/*									
					
*/

	
}




?>