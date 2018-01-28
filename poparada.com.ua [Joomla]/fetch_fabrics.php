<?php

  // connect to the database
  include_once("../../configuration.php");
  $cg = new JConfig;
  $con = mysqli_connect($cg->host, $cg->user, $cg->password, $cg->db);
 // mail("gsu1234@mail.ru", "fetch_fabrics1", "fetch_fabrics1", "From: info@poparada.com.ua\r\n");
  
  if (mysqli_connect_errno())
    die('n/a');
 // mail("gsu1234@mail.ru", "fetch_fabrics2", "fetch_fabrics2", "From: info@poparada.com.ua\r\n");
  mysqli_set_charset($con, "utf8");
  $query = "SELECT c.name, c.description, i.id, i.title, i.alias, i.hits, i.extra_fields
            FROM ".$cg->dbprefix."k2_categories as c
            INNER JOIN  ".$cg->dbprefix."k2_items as i ON c.id = i.catid
            WHERE c.parent = 13 AND i.published=1 AND i.trash=0";
  $result = mysqli_query($con, $query);
  $error=mysqli_error();
  //mail("gsu1234@mail.ru", "mysqli_error", $error, "From: info@poparada.com.ua\r\n"); 
  $fabric = array();
  $assoc = array();
  $objects = array();

  //mail("gsu1234@mail.ru", "mysqli_num_rows", $tmp_1, "From: info@poparada.com.ua\r\n"); 
  
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
	//mail("gsu1234@mail.ru", "fetch_fabrics3", "fetch_fabrics3", "From: info@poparada.com.ua\r\n");  
	//mail("gsu1234@mail.ru", "$row[extra_fields]", $row['extra_fields'], "From: info@poparada.com.ua\r\n"); 
	
	
    $extra_fields = json_decode($row['extra_fields'], true);
	//mail("gsu1234@mail.ru", "json_decode", "json_decode", "From: info@poparada.com.ua\r\n");
	
	foreach($extra_fields as $key=>$value)
	{	
		//mail("gsu1234@mail.ru", "extra_fields1", $key." -- ".$value, "From: info@poparada.com.ua\r\n");	
	}	
	
	
	
	
	foreach((array_column($extra_fields, 'id')) as $key=>$value)
	{
		//mail("gsu1234@mail.ru", "array_column", "".$key." -- ".$value."", "From: info@poparada.com.ua\r\n");
	}
	
    $type = array_search('11', array_column($extra_fields, 'id'));
	//mail("gsu1234@mail.ru", "11", "11", "From: info@poparada.com.ua\r\n");
    if($type !== false){
	  //mail("gsu1234@mail.ru", "type", "type", "From: info@poparada.com.ua\r\n"); 
      $type = $extra_fields[$type]['value'];
    }
	
	//mail("gsu1234@mail.ru", "fetch_fabrics6", "fetch_fabrics6", "From: info@poparada.com.ua\r\n"); 
	
    $color = array_search('12', array_column($extra_fields, 'id'));
    if($color !== false){
      $color = $extra_fields[$color]['value'];
    }
	
	//mail("gsu1234@mail.ru", "fetch_fabrics7", "fetch_fabrics7", "From: info@poparada.com.ua\r\n"); 
	
    $image = array_search('4', array_column($extra_fields, 'id'));
    if($image !== false){
      $image = $extra_fields[$image]['value'];
    }
	
	//mail("gsu1234@mail.ru", "fetch_fabrics8", "fetch_fabrics8", "From: info@poparada.com.ua\r\n"); 
	
	$colorOrigin = array_search('9', array_column($extra_fields, 'id'));
	if($colorOrigin !== false){
		$colorOrigin = $extra_fields[$colorOrigin]['value'];
    }
	
	//mail("gsu1234@mail.ru", "fetch_fabrics9", "fetch_fabrics9", "From: info@poparada.com.ua\r\n"); 
			  
    $values = array( 'id' => $row['id'],
                     'alias' => $row['alias'],
                     'title' => $row['title'],
                     'hits' => $row['hits'],
                     // 'extra_fields' => json_decode($row['extra_fields']),
                     // 'fabric' => $row['fabric'],
                     'color' => $color,
					 'colorOrigin' => $colorOrigin,
                     'image' => $image);

	//mail("gsu1234@mail.ru", "fetch_fabrics10", "fetch_fabrics10", "From: info@poparada.com.ua\r\n"); 
	
    if(isset($assoc[$row['name']])){
      $fabric[] = $values;
      $hits += $row['hits'];
        $assoc[$row['name']]['hits'] = $hits;
        $assoc[$row['name']]['items'] = $fabric;

    }else{

        $fabric = array();
        $description = strip_tags($row['description'], '<br><br/>');
        $hits = $row['hits'];
      $fabric[] = $values;
      $assoc[$row['name']] = array(
        'name' => $row['name'],
        'hits' => $hits,
        'items' => $fabric,
        'description' => $description,
        'fabric' => $type);
    };
	
	//mail("gsu1234@mail.ru", "fetch_fabrics5", "fetch_fabrics5", "From: info@poparada.com.ua\r\n"); 
	
  }


  foreach ($assoc as $key => $value) {
    $objects[] = $value;
	//mail("gsu1234@mail.ru", "fetch_fabrics4", "fetch_fabrics4", "From: info@poparada.com.ua\r\n"); 
  }
//   var_dump($assoc);
  $json = json_encode($objects);
  echo($json);

  // $new_hits = mysqli_fetch_all($result);
  // close the connection to the database
  mysqli_close($con);

?>