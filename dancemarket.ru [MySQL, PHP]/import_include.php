<?php 

$xml = simplexml_load_file($url_xml);
//$xml = simplexml_load_string("http://www.dancemarket.info/upload_xml/export.xml");

//print_r($xml);

//var_dump($xml);


//извлечение категорий
//echo $xml->shop->name;

$category_total = count($xml->shop->categories->category);
//echo $category_total;


//for ($i = ($category_total - 1); $i >= 0; --$i) {
//	echo $xml->shop->categories->category[$i];
//	
//	echo"<br>";
//	
//}




//формирование таблицы родственных связей категорий 
$rs1 = $mysqli->query("SELECT * FROM `category`");
while ($row1 = mysqli_fetch_assoc($rs1)){
	$id=$row1['id'];
	$name=$row1['name'];
	$parent=$row1['parent'];//идентификатор родителя
	
	
	
	//вытащить наименование родительской категории
	$rs2 = $mysqli->query("SELECT * FROM `category` WHERE id='".$parent."'");	
	if ($rs2===false) {
		printf("Ошибка #1: %s\n", $mysqli->error);
	}
	$parent_name="";
	while ($row2 = mysqli_fetch_assoc($rs2)){
		$parent_name=$row2['name'];	
		
	}
	//echo "=".$parent_name."=".$parent."=".$name."=".$id."=<br>";
	
	
	$rs3 = $mysqli->query("SELECT * FROM `categories_names` WHERE parent='".$parent_name."' AND child='".$name."' AND parent_id='".$parent."' AND child_id='".$id."'");
	if(mysqli_num_rows($rs3)){
		
	}else{
	
		$rs_insert = $mysqli->query("INSERT INTO `categories_names` (parent,child,parent_id,child_id) VALUES ('".$parent_name."','".$name."','".$parent."','".$id."')");
		if ($rs_insert===false) {
			printf("Ошибка #2: %s\n", $mysqli->error);
		}
	
	}
	
	
	
	
	
}




//функция получения id категории-источника по id категории-приёмника 
function category_ist_pr($shop,$id2){
	
	$rs1 = $mysqli->query("SELECT * FROM `import_categories` WHERE id2='".$id2."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){
		while ($row1 = mysqli_fetch_assoc($rs1)){
			$id1=$row1['id1'];	
		}
		return $id1;
		
	}else{
		return false;
	}
	
		
}



//функция получения id категории-приёмника по id категории-источника
function category_pr_ist($shop,$id1){
	
	$rs1 = $mysqli->query("SELECT * FROM `import_categories` WHERE id1='".$id1."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){
		while ($row1 = mysqli_fetch_assoc($rs1)){
			$id2=$row1['id2'];	
		}
		return $id2;
		
	}else{
		return false;
	}
	
		
}



//функция получения id товара-источника по id товара-приёмника
function item_ist_pr($shop,$id2){
	
	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id2='".$id2."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){
		while ($row1 = mysqli_fetch_assoc($rs1)){
			$id1=$row1['id1'];	
		}
		return $id1;
		
	}else{
		return false;
	}
	
		
}



//функция получения id товара-приёмника по id товара-источника
function item_pr_ist($shop,$id1){
	
	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id1='".$id1."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){
		while ($row1 = mysqli_fetch_assoc($rs1)){
			$id2=$row1['id2'];	
		}
		return $id2;
		
	}else{
		return false;
	}
	
		
}










//генерация случайного числа
//$global_id=rand().date('U');
//$global_id=substr($global_id,0,5);

//echo $global_id."<br>";
//////////////////////////////////////////////////////////////////////////////////////////
//categories - start
foreach ($xml->shop->categories->category as $item) {
	
	//echo $item." = ".$item["id"]." = ".$item["parentId"]."<br>";
	
	
	
	
	//проверить, существует ли категория с заданным именем
	
	if($item["parentId"]=="0"){
		//категория корневая
		$rs1 = $mysqli->query("SELECT * FROM `category` WHERE name='$item'");
		if(mysqli_num_rows($rs1)){
			//корневая категория с заданныи именем существует, то не добавляем её, а просто делаем запись в таблицу соответствий
			$id_cat_1=$item["id"]; // идентификатор категории из xml файла
			while ($row1 = mysqli_fetch_assoc($rs1)){
				$id_cat_2=$row1['id'];//идентификатор категории на сайте
			}
			$rs_insert = $mysqli->query("INSERT INTO `import_categories` (shop,id1,id2) VALUES ('".$shop."','".$id_cat_1."','".$id_cat_2."')");
			if ($rs_insert===false) {
				printf("Ошибка #3: %s\n", $mysqli->error);
			}


				
		}else{
			
			
			
			
			
			//существует ли идентификатор категории в таблице соответствий

			$rs1 = $mysqli->query("SELECT * FROM `import_categories` WHERE id1='".$item["id"]."'");
			if(mysqli_num_rows($rs1)){




			}else{

				$rs2 = $mysqli->query("INSERT INTO `category` (parent,name) VALUES ('".($item["parentId"])."','".$item."')");
				if ($rs2===false) {
					printf("Ошибка #4: %s\n", $mysqli->error);
				}
				//получить идентификатор только-что вставленной категории
				$id_last_cat = $mysqli->insert_id;
				
				
				//$rs1_into = $mysqli->query("UPDATE `import_id` SET import='".$global_id."' WHERE id='1'");
				$rs_insert = $mysqli->query("INSERT INTO `import_categories` (shop,id1,id2) VALUES ('".$shop."','".$item["id"]."','".$id_last_cat."')");
				if ($rs_insert===false) {
					printf("Ошибка #5: %s\n", $mysqli->error);
				}

			}


			
			
		}








		
	}else{
	//категория дочерняя
//	echo $item."==";
		
		//$item - наименование категории , $item["id"] - идентификатор категории
		//$item["parentId"] - идентификатор родительской категории
		//
		$parent_name_xml="";
		foreach ($xml->shop->categories->category as $item2) {
			//echo '='.$item2["id"].' -- ='.$item["parentId"]." +++ ";
			
			//echo ($item2['id'])."==".($item['parentId'])." ";
			
			$str1="".$item2['id'];
			$str2="".$item['parentId'];
			//echo "=".$item2["id"]."=".$item["parentId"]."=  ";
			if(($str1)==($str2)){
				//echo"1111=====";
				$parent_name_xml=$item2;//наименование родительской категории
				//echo $parent_name_xml."-----";
			}
			
		}
		
		
		
		
		
		//поиск совпадений в таблице родственных связей
		$rs1 = $mysqli->query("SELECT * FROM `categories_names` WHERE parent='$parent_name_xml' AND child='$item'");
		
		//echo "parent=".$parent_name_xml." -- child=".$item;
		
		
		if(mysqli_num_rows($rs1)){
			//совпадение найдено, вставка не производится
			//получить идентификаторы и вставить их в import_categories
			while ($row1 = mysqli_fetch_assoc($rs1)){
				$parent_id=$row1['parent_id'];
				$child_id=$row1['child_id'];
			}
			$rs_insert2 = $mysqli->query("INSERT INTO `import_categories` (shop,id1,id2) VALUES ('".$shop."','".$item["id"]."','".$child_id."')");
			if ($rs_insert2===false) {
				printf("Ошибка #6: %s\n", $mysqli->error);
			}
			
			
			
		}else{
			
			//echo "+++  ";
			
			$rs1 = $mysqli->query("SELECT * FROM `import_categories` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
			
			
			
			
			if(mysqli_num_rows($rs1)){


			}else{
				//вставка категории
				//получить идентификатор родительской категории
				//$item["parentId"]
				
				
				$rs_parent = $mysqli->query("SELECT * FROM `import_categories` WHERE id1='".$item["parentId"]."' AND shop='".$shop."'");
				while ($row_parent = mysqli_fetch_assoc($rs_parent)){
					$parent_id=$row_parent['id2'];	
				}
				
				$rs1_into = $mysqli->query("INSERT INTO `category` (parent,name) VALUES ('".$parent_id."','".$item."')");
				$id_1 = $mysqli->insert_id;
				
				$rs_insert = $mysqli->query("INSERT INTO `import_categories` (shop,id1,id2) VALUES ('".$shop."','".$item["id"]."','".$id_1."')");
				if ($rs_insert===false) {
					printf("Ошибка #6: %s\n", $mysqli->error);
				}
					
				
			}
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*
		//имеется ли дочерняя категория с указанным именем, и если имеется, то проверить имя её родителя
		$rs1 = $mysqli->query("SELECT * FROM `category` WHERE name='$item'");
		if(mysqli_num_rows($rs1)){
			//имеется ли родитель на корневом уровне?
			$id_parent=$item["parentId"];
			//$id_parent=$global_id.$id_parent;
			
			
			//$rs2 = $mysqli->query("SELECT * FROM `category` WHERE id='$id_parent'");
			//if(mysqli_num_rows($rs2)){
			
				
				
			if(category_pr_ist($shop,$item["parentId"])!=false){		
				//нашли родителя по идентификатору
				
				
				
				
			}else{
				//родитель не найден по идентификатору, видимо он не был вставлен только-что, а существовал ранее, поиск по имени
				//получить имя родителя
				$parent_name_xml="";
				foreach ($xml->shop->categories->category as $item2) {
					if($item2["id"]==$item["parentId"]){
						$parent_name_xml=$item2;
					}
				}
				
				//поиск родителя по имени
				$rs3 = $mysqli->query("SELECT * FROM `category` WHERE name='$parent_name_xml'");
				if(mysqli_num_rows($rs3)){
							
				}else{
					//допускается, что могут существовать две категории не корневого уровня с одинаковыми именами,
					//но имеющие разных родителей
					//вставка дочерней категории
					//echo"000";
					
					$rs1 = $mysqli->query("SELECT * FROM `import_categories` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
					if(mysqli_num_rows($rs1)){




					}else{	


						$rs_into = $mysqli->query("INSERT INTO `category` (id,parent,name) VALUES ('".($global_id.$item["id"])."','".($global_id.$item["parentId"])."','".$item."')");
						$rs1_into = $mysqli->query("UPDATE `import_id` SET import='".$global_id."' WHERE id='1'");
						$rs_insert = $mysqli->query("INSERT INTO `import_categories` (shop,id1,id2) VALUES ('".$shop."','".$item["id"]."','".($global_id.$item["id"])."')");
						if ($rs_insert===false) {
							printf("Ошибка: %s\n", $mysqli->error);
						}

					}

	

				}
		
		
						
			}
				
		}else{
			//вставка дочерней категории
			//echo "".$global_id." -- ".$item["id"]." -- ".$global_id.$item["id"]."<br>";
			
			$rs1 = $mysqli->query("SELECT * FROM `import_categories` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
			if(mysqli_num_rows($rs1)){


			}else{


				$rs1_into = $mysqli->query("INSERT INTO `category` (id,parent,name) VALUES ('".($global_id.$item["id"])."','".($global_id.$item["parentId"])."','".$item."')");
				
				$rs1_into = $mysqli->query("UPDATE `import_id` SET import='".$global_id."' WHERE id='1'");
				$rs_insert = $mysqli->query("INSERT INTO `import_categories` (shop,id1,id2) VALUES ('".$shop."','".$item["id"]."','".($global_id.$item["id"])."')");
				if ($rs_insert===false) {
					printf("Ошибка: %s\n", $mysqli->error);
				}



			}





		}


		*/

		
	}
	
	
	
	
}
//categories - end
///////////////////////////////////////////////////////////////////////////////////





$tovar_total = count($xml->shop->offers->offer);

//echo "---".$tovar_total."---";

//извлечение идентификатора импорта
//$rs3 = $mysqli->query("SELECT * FROM `import_id` WHERE id='1'");
//if ($rs3===false) {
//				printf("Ошибка 2: %s\n", $mysqli->error);
//			}
//while ($row3 = mysqli_fetch_assoc($rs3)){
//	$import_id=$row3['import'];
//}


foreach ($xml->shop->offers->offer as $item) {
	
	//echo $item["id"]." - ".($item->currencyId)." - ".($item->categoryId)." - ".($item->name)." - ".($item->description)."<br>";
	//echo ($item->description)."<br>";
	
	
	
	
	
	
	
	
	$descritpion_mas=explode("-!-",($item->description));
	
	///////////////////////////////////////////////////////////////////////
	
	
	$pos = strpos($item->description, '[color]');
	
	if ($pos === false) {
	//формат 1
		
		if(($item->description=="")||($item->description==NULL)){
		
			$kabluk="";
			$price="";
			$prajka="";
			$podoshva="";
			$model="";
			$color="";
			$size="";
			$text="";
		
			
		}else{
		
			$kabluk=$descritpion_mas[1];
			$price=$descritpion_mas[3];
			$prajka=$descritpion_mas[4];
			$podoshva=$descritpion_mas[5];
			$model=$descritpion_mas[7];
			$color=$descritpion_mas[0];
			$size=$descritpion_mas[2];
			$text="";
		
		}
		
		
		unset($price_m);
		unset($color_m);
		unset($size_m);
		
		foreach ($item->prices->price as $item_price) {
			$price_m[]=$item_price." ".$item_price["text"]."";
			$price=$price.$item_price." ".$item_price["text"]." ";
		}
		
		
		//$price=$item->price;
		
		
		foreach ($item->colors->color as $item_color) {
			$color_m[]=$item_color."";
			$color=$color.$item_color." ";
		}
		
		
		
		//$color=$item->color;
		//$size=$item->size;
		
		
		foreach ($item->sizes->size as $item_size) {
			$size_m[]=$item_size."";
			$size=$size.$item_size." ";
		}
		
		
	
	
	//формат 1
	
	}else{
	//формат 2
		
		$kabluk=str_replace("[kabluk]","",$descritpion_mas[1]);
		$price=str_replace("[price]","",$descritpion_mas[3]);
		$prajka="";
		$podoshva=str_replace("[podoshva]","",$descritpion_mas[4]);
		$model=str_replace("[model]","",$descritpion_mas[5]);
		$color=str_replace("[color]","",$descritpion_mas[0]);
		$material=str_replace("[material]","",$descritpion_mas[7]);
		$color=$color.",".$material;
		$size=str_replace("[size]","",$descritpion_mas[2]);
		$text=str_replace("[text]","",$descritpion_mas[6]);	
		
		
		//$price=str_replace("[price]","",$item->price);
		//$color=str_replace("[color]","",$item->color).",".$material;
		//$size=str_replace("[size]","",$item->size);
		
		
		foreach ($item->prices->price as $item_price) {
			$price=$price.str_replace("[price]","",$item_price)." ".$item_price["text"].";";
		}
		
		//$price=$item->price;
		
		
		foreach ($item->colors->color as $item_color) {
			$color=$color.str_replace("[color]","",$item_color).",".$material.";";
		}
		
		
		
		//$color=$item->color;
		//$size=$item->size;
		
		
		foreach ($item->sizes->size as $item_size) {
			$size=$size.str_replace("[size]","",$item_size).";";
		}
		
		
		
	//формат 2
		
		
	
	
	}
	
	
	
	
	//
	

	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	
	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){

	}else{

		
		
		$rs_c = $mysqli->query("SELECT * FROM `import_categories` WHERE id1='".$item->categoryId."' AND shop='".$shop."'");
		while ($row_c = mysqli_fetch_assoc($rs_c)){
			$id_cat=$row_c['id2'];
			
		}
		
		
		
		
			///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	$vendor=$item->vendor;
	$outer_url=$item->url;
	//
	$rs = $mysqli->query("SELECT * FROM `brand` WHERE name='".$vendor."'");
	if ($rs===false) {
				printf("Ошибка #12: %s\n", $mysqli->error);
			}
	if(mysqli_num_rows($rs)){
	//
	
		while ($row = mysqli_fetch_assoc($rs)){
			$id_vendor=$row['id'];	
			
		}
			
	}else{
	//		
		$rs = $mysqli->query("INSERT INTO `brand` (name) VALUES ('".$vendor."')");
		if ($rs===false) {
			printf("Ошибка #13: %s\n", $mysqli->error);
		}
		//$id_size=mysqli_insert_id($rs);
		$rs = $mysqli->query("SELECT MAX(`id`) FROM `brand`");
		if ($rs===false) {
			printf("Ошибка #14: %s\n", $mysqli->error);
		}
		//$id_size = $mysqli->insert_id;
		//$row=$rs->fetch_object();
		//$id_size=$row->id;
		//echo "==2=".$id_size;
		
		//while ($row = mysqli_fetch_assoc($rs)){
		//	$id_size=$row['id'];	
		//	
		///}
		$id_vendor = $mysqli->insert_id;


	}
	
	
	
			///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////


		
		
		
		
		
		

		$rs = $mysqli->query("INSERT INTO `tovar` (shop, category, price, currency, name, text, brand, country, artikul, outer_url) 
		VALUES ('".$shop."','".$id_cat."','".$price."','".($item->currencyId)."','".($item->name)."','".$text."','".$id_vendor."','1','','".$outer_url."')");
		if ($rs===false) {
			printf("Ошибка #7: %s\n", $mysqli->error);
		}
		$id_tovar = $mysqli->insert_id;

		
		//$rs_insert = $mysqli->query("INSERT INTO `import_items` (shop,id1,id2) VALUES ('1','".$item["id"]."','".($import_id.$item["id"])."')");
		//if ($rs_insert===false) {
		//	printf("Ошибка: %s\n", $mysqli->error);
		//}
		

	}



	




///...............................................................................///


	//вставка изображений товара
	//$images=$item->images;
	
	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){

	}else{
	
		foreach ($item->images->image as $item2) {

			$rs3  = $mysqli->query("SELECT * FROM `tovar_images` WHERE id_tovar='".$id_tovar."' AND url='".$item2."'");
			if ($rs3===false) {
				printf("Ошибка #89: %s\n", $mysqli->error);
			}
			
			if(mysqli_num_rows($rs3)){
			//если картинка существует,то вставку не делать
		
			
			}else{	

				$rs = $mysqli->query("INSERT INTO `tovar_images` (id_tovar, url) VALUES ('".($id_tovar)."','".$item2."')");
				if ($rs===false) {
					printf("Ошибка #8: %s\n", $mysqli->error);
				}
			
		
			}
		



		}	


	}

///...............................................................................///





	
	
	
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	
	
	

	
	
	
	
	
	
	
unset($id_color_m);
unset($id_size_m);
	
	
for($i=0;$i<count($color_m);$i++){	 


$color_m[$i]=str_replace("\n","",$color_m[$i]);
if(($color_m[$i]==NULL)||($color_m[$i]=="NULL")){ continue; }



	
	
	$rs = $mysqli->query("SELECT * FROM `color` WHERE name='".$color_m[$i]."'");
	if ($rs===false) {
				printf("Ошибка #9: %s\n", $mysqli->error);
			}
	if(mysqli_num_rows($rs)){
	//получить id цвета
	
		while ($row = mysqli_fetch_assoc($rs)){
			$id_color_m[]=$row['id'];	
			
		}
			
	}else{
	//добавить цвет в таблицу и получить его id
		
		$rs = $mysqli->query("INSERT INTO `color` (name) VALUES ('".$color_m[$i]."')");
		if ($rs===false) {
			printf("Ошибка #10: %s\n", $mysqli->error);
		}
		
		
		//$id_color=mysqli_insert_id($rs);
		//$rs = $mysqli->query("SELECT MAX(`id`) FROM `color`");
		//if ($rs===false) {
		//	printf("Ошибка 2: %s\n", $mysqli->error);
		//}

		$id_color_m[] = $mysqli->insert_id;
		//$id_color = $mysqli->insert_id;
		//$row=$rs->fetch_object();
		//$id_color=$row->id;	
		//echo "==1=".$id_color;
		//while ($row = mysqli_fetch_assoc($rs)){
		//	$id_color=$row['id'];	
		//	
		//}


		
		
	}
	
	
	
}
	
	
	
	


	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){

	}else{
		
		if(isset($id_color_m)){
		for($i=0;$i<count($id_color_m);$i++){
			
			//echo $id_color_m[$i]."=";

		$rs = $mysqli->query("INSERT INTO `tovar_color` (tovar, color) VALUES ('".$id_tovar."','".$id_color_m[$i]."')");
		if ($rs===false) {
			printf("Ошибка #11: %s\n", $mysqli->error);
		}

		}
		}
		//echo "[]\n";

		//$rs_insert = $mysqli->query("INSERT INTO `import_items` (shop,id1,id2) VALUES ('1','".$item["id"]."','".($global_id.$item["id"])."')");
		//if ($rs_insert===false) {
		//	printf("Ошибка: %s\n", $mysqli->error);
		//}



	}


	



	
	
	
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	
for($i=0;$i<count($size_m);$i++){	
	//
	
	$size_m[$i]=str_replace("\n","",$size_m[$i]);
	if(($size_m[$i]==NULL)||($size_m[$i]=="NULL")){ continue; }

	
	
	$rs = $mysqli->query("SELECT * FROM `size` WHERE name='".$size_m[$i]."'");
	if ($rs===false) {
				printf("Ошибка #12: %s\n", $mysqli->error);
			}
	if(mysqli_num_rows($rs)){
	//
	
		while ($row = mysqli_fetch_assoc($rs)){
			$id_size_m[]=$row['id'];	
			
		}
			
	}else{
	//		
		$rs = $mysqli->query("INSERT INTO `size` (name) VALUES ('".$size_m[$i]."')");
		if ($rs===false) {
			printf("Ошибка #13: %s\n", $mysqli->error);
		}
		//$id_size=mysqli_insert_id($rs);
		$rs = $mysqli->query("SELECT MAX(`id`) FROM `size`");
		if ($rs===false) {
			printf("Ошибка #14: %s\n", $mysqli->error);
		}
		//$id_size = $mysqli->insert_id;
		//$row=$rs->fetch_object();
		//$id_size=$row->id;
		//echo "==2=".$id_size;
		
		//while ($row = mysqli_fetch_assoc($rs)){
		//	$id_size=$row['id'];	
		//	
		///}
		$id_size_m[] = $mysqli->insert_id;


	}
	
	
	



	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id1='".$item["id"]."'  AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){



	}else{

		for($i=0;$i<count($id_size_m);$i++){
		$rs = $mysqli->query("INSERT INTO `tovar_size` (tovar, size) VALUES ('".($id_tovar)."','".$id_size_m[$i]."')");
		if ($rs===false) {
				printf("Ошибка #15: %s\n", $mysqli->error);
		}
		}
		
		
		//$rs_insert = $mysqli->query("INSERT INTO `import_items` (shop,id1,id2) VALUES ('1','".$item["id"]."','".($global_id.$item["id"])."')");
		//if ($rs_insert===false) {
		//	printf("Ошибка: %s\n", $mysqli->error);
		//}




	}
	
}

	
	
	
	
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////






	


	


	
	
	
	
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////



	
	
	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
	if(mysqli_num_rows($rs1)){

	}else{

		$rs = $mysqli->query("INSERT INTO `tovar_option` (tovar, color, size, count) VALUES ('".($id_tovar)."','','','1')");
		if ($rs===false) {
			printf("Ошибка #16: %s\n", $mysqli->error);
		}
		$rs_insert = $mysqli->query("INSERT INTO `import_items` (shop,id1,id2) VALUES ('".$shop."','".$item["id"]."','".($id_tovar)."')");
		if ($rs_insert===false) {
			printf("Ошибка #17: %s\n", $mysqli->error);
		}
	


	}


	
	
	
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	
	
	
	
	
	///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	
	/*
	
	
	
	*/
	
}


//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////
//обновление характеристик товаров 




foreach ($xml->shop->offers->offer as $item) {

	//echo $item["id"]." - ".($item->currencyId)." - ".($item->categoryId)." - ".($item->name)." - ".($item->description)."<br>";
	//echo ($item->description)."<br>";
	
		
	$descritpion_mas=explode("-!-",($item->description));

	//$item["id"];
	$rs1 = $mysqli->query("SELECT * FROM `import_items` WHERE id1='".$item["id"]."' AND shop='".$shop."'");
	while ($row1 = mysqli_fetch_assoc($rs1)){
		$update_id_tovar=$row1['id2'];
	}



	//$update_id_tovar=$global_id.$item["id"];





	//$descritpion_mas=explode("-!-",($item->description));
	
	///////////////////////////////////////////////////////////////////////
	
	$pos = strpos($item->description, '[color]');
	
	//echo $item->description." == ";
	
	if ($pos === false) {
	//формат 1
		
		if(($item->description=="")||($item->description==NULL)){
		
			$kabluk="";
			$price="";
			$prajka="";
			$podoshva="";
			$model="";
			$color="";
			$size="";
			$text="";
		
			
		}else{
		
			$kabluk=$descritpion_mas[1];
			//$price=$descritpion_mas[3];
			$price="";
			$prajka=$descritpion_mas[4];
			$podoshva=$descritpion_mas[5];
			$model=$descritpion_mas[7];
			//$color=$descritpion_mas[0];
			//$size=$descritpion_mas[2];
			$color="";
			$size="";
			$text="";
		
		}
		
		unset($price_m);
		unset($color_m);
		unset($size_m);
		
		foreach ($item->prices->price as $item_price) {
			$price=$price."".$item_price." ".$item_price["text"]."";
			$price_m[]=$item_price." ".$item_price["text"]."";
		}
		
		//$price=$item->price;
		
		
		foreach ($item->colors->color as $item_color) {
			$color=$color."".$item_color."";
			$color_m[]=$item_color."";
		}
		
		
		
		//$color=$item->color;
		//$size=$item->size;
		
		
		foreach ($item->sizes->size as $item_size) {
			$size=$size."".$item_size."";
			$size_m[]=$item_size."";
		}
		
		
	
	
	//формат 1
	
	}else{
	//формат 2
	
		$kabluk=str_replace("[kabluk]","",$descritpion_mas[1]);
		//$price=str_replace("[price]","",$descritpion_mas[3]);
		$price="";
		$prajka="";
		$podoshva=str_replace("[podoshva]","",$descritpion_mas[4]);
		$model=str_replace("[model]","",$descritpion_mas[5]);
		//$color=str_replace("[color]","",$descritpion_mas[0]);
		$material=str_replace("[material]","",$descritpion_mas[7]);
		//$color=$color.",".$material;
		//$size=str_replace("[size]","",$descritpion_mas[2]);
		$color="";
		$size="";
		$text=str_replace("[text]","",$descritpion_mas[6]);	
		
		
		
		
		//$price=str_replace("[price]","",$item->price);
		//$color=str_replace("[color]","",$item->color).",".$material;
		//$size=str_replace("[size]","",$item->size);
		
		
		foreach ($item->prices->price as $item_price) {
			$price=$price.str_replace("[price]","",$item_price)." ".$item_price["text"]."";
		}
		
		//$price=$item->price;
		
		
		foreach ($item->colors->color as $item_color) {
			$color=$color.str_replace("[color]","",$item_color).",".$material."";
		}
		
		
		
		//$color=$item->color;
		//$size=$item->size;
		
		
		foreach ($item->sizes->size as $item_size) {
			$size=$size.str_replace("[size]","",$item_size)."";
		}
		
		
		
	//формат 2
		
		
	
	
	}
	
	

	
//echo "price=".$price."\n";
//echo "color=".$color."\n";
//echo "size=".$size."\n";
//echo "\n";



//	$color=$descritpion_mas[0]; 
	
	//
unset($id_color_m);	
	
	
for($i=0;$i<count($color_m);$i++){		
	
	$color_m[$i]=str_replace("\n","",$color_m[$i]);
if(($color_m[$i]==NULL)||($color_m[$i]=="NULL")){ continue; }
	
	
	$rs = $mysqli->query("SELECT * FROM `color` WHERE name='".$color_m[$i]."'");
	if ($rs===false) {
				printf("Ошибка #18: %s\n", $mysqli->error);
			}
	if(mysqli_num_rows($rs)){
	//получить id цвета
	
		while ($row = mysqli_fetch_assoc($rs)){
			$id_color_m[]=$row['id'];	
			
		}
			
	}else{
	//добавить цвет в таблицу и получить его id
		
		$rs = $mysqli->query("INSERT INTO `color` (name) VALUES ('".$color_m[$i]."')");
		if ($rs===false) {
				printf("Ошибка #19: %s\n", $mysqli->error);
			}
		//$id_color=mysqli_insert_id($rs);
		$rs = $mysqli->query("SELECT MAX(`id`) FROM `color`");
		//$id_color = $mysqli->insert_id;
		//$row=$rs->fetch_object();
		//$id_color=$row->id;	
		$id_color_m[] = $mysqli->insert_id;
		
		
	}
	
	
	
	

	



}
/*
$rs = $mysqli->query("UPDATE `tovar_color` SET color='".$id_color_m[]."' WHERE tovar='".$update_id_tovar."' ");
	if ($rs===false) {
		printf("Ошибка #20: %s\n", $mysqli->error);
	}
	*/
	$rs = $mysqli->query("DELETE FROM `tovar_color` WHERE tovar='".($id_tovar)."' ");
		if ($rs===false) {
				printf("Ошибка #15: %s\n", $mysqli->error);
		}
	
	if(isset($id_color_m)){
	for($i=0;$i<count($id_color_m);$i++){
		$rs = $mysqli->query("INSERT INTO `tovar_color` (tovar, color) VALUES ('".($id_tovar)."','".$id_color_m[$i]."')");
		if ($rs===false) {
				printf("Ошибка #15: %s\n", $mysqli->error);
		}
	
	}
	}



//	$size=$descritpion_mas[2];
	
	//
	
unset($id_size_m);	
	
for($i=0;$i<count($size_m);$i++){	
	
	$color_m[$i]=str_replace("\n","",$color_m[$i]);
if(($color_m[$i]==NULL)||($color_m[$i]=="NULL")){ continue; }
	
	$rs = $mysqli->query("SELECT * FROM `size` WHERE name='".$size_m[$i]."'");
	if ($rs===false) {
				printf("Ошибка #21: %s\n", $mysqli->error);
			}
	if(mysqli_num_rows($rs)){
	//
	
		while ($row = mysqli_fetch_assoc($rs)){
			$id_size_m[]=$row['id'];	
			
		}
			
	}else{
	//		
		$rs = $mysqli->query("INSERT INTO `size` (name) VALUES ('".$size_m[$i]."')");
		if ($rs===false) {
				printf("Ошибка #22: %s\n", $mysqli->error);
			}
		//$id_size=mysqli_insert_id($rs);
		$rs = $mysqli->query("SELECT MAX(`id`) FROM `size`");
		//$id_size = $mysqli->insert_id;
		//$row=$rs->fetch_object();
		//$id_size=$row->id;
		$id_size_m[] = $mysqli->insert_id;

		
	}
	
	

/*
	$rs = $mysqli->query("UPDATE `tovar_size` SET size='".$id_size."' WHERE tovar='".$update_id_tovar."' ");
		if ($rs===false) {
				printf("Ошибка #23: %s\n", $mysqli->error);
		}
*/
}



$rs = $mysqli->query("DELETE FROM `tovar_size` WHERE tovar='".($id_tovar)."' ");
		if ($rs===false) {
				printf("Ошибка #15: %s\n", $mysqli->error);
		}
	
	if(isset($id_size_m)){
	for($i=0;$i<count($id_size_m);$i++){
		$rs = $mysqli->query("INSERT INTO `tovar_size` (tovar, size) VALUES ('".($id_tovar)."','".$id_size_m[$i]."')");
		if ($rs===false) {
				printf("Ошибка #15: %s\n", $mysqli->error);
		}
	}
	}








//	$price=$descritpion_mas[3];

//	$rs = $mysqli->query("UPDATE `tovar` SET price='".$price."' WHERE id='".$update_id_tovar."' ");
//	if ($rs===false) {
//		printf("Ошибка #24: %s\n", $mysqli->error);
//	}


			///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////
	
	$vendor=$item->vendor;
	$outer_url=$item->url;
	//
	$rs = $mysqli->query("SELECT * FROM `brand` WHERE name='".$vendor."'");
	if ($rs===false) {
				printf("Ошибка #12: %s\n", $mysqli->error);
			}
	if(mysqli_num_rows($rs)){
	//
	
		while ($row = mysqli_fetch_assoc($rs)){
			$id_vendor=$row['id'];	
			
		}
			
	}else{
	//		
		$rs = $mysqli->query("INSERT INTO `brand` (name) VALUES ('".$vendor."')");
		if ($rs===false) {
			printf("Ошибка #13: %s\n", $mysqli->error);
		}
		//$id_size=mysqli_insert_id($rs);
		$rs = $mysqli->query("SELECT MAX(`id`) FROM `brand`");
		if ($rs===false) {
			printf("Ошибка #14: %s\n", $mysqli->error);
		}
		//$id_size = $mysqli->insert_id;
		//$row=$rs->fetch_object();
		//$id_size=$row->id;
		//echo "==2=".$id_size;
		
		//while ($row = mysqli_fetch_assoc($rs)){
		//	$id_size=$row['id'];	
		//	
		///}
		$id_vendor = $mysqli->insert_id;


	}
	
	
	
			///////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////


		
	



//echo $text."==";




$rs = $mysqli->query("UPDATE `tovar` SET price='".$price."', name='".$item->name."', text='".$text."', brand='".$id_vendor."', outer_url='".$outer_url."' WHERE id='".$update_id_tovar."' ");
if ($rs===false) {
	printf("Ошибка #25: %s\n", $mysqli->error);
}








	//$rs = $mysqli->query("UPDATE `tovar_option` SET color='".$id_color."', size='".$id_size."' WHERE tovar='".$update_id_tovar."' ");
	//if ($rs===false) {
	//	printf("Ошибка #25: %s\n", $mysqli->error);
	//}



















}









//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////


//убрать дубликаты картинок
$rs = $mysqli->query("CREATE TABLE tovar_images2 SELECT id, id_tovar, url FROM tovar_images GROUP BY id_tovar, url");
if ($rs===false) {
	printf("Ошибка #26: %s\n", $mysqli->error);
}

$rs = $mysqli->query("TRUNCATE TABLE tovar_images");
if ($rs===false) {
	printf("Ошибка #27: %s\n", $mysqli->error);
}

$rs = $mysqli->query("INSERT INTO `tovar_images` SELECT * FROM `tovar_images2`");
if ($rs===false) {
	printf("Ошибка #28: %s\n", $mysqli->error);
}

$rs = $mysqli->query("DROP TABLE `tovar_images2`");
if ($rs===false) {
	printf("Ошибка #29: %s\n", $mysqli->error);
}




//////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////




//формирование таблицы родственных связей категорий 
$rs1 = $mysqli->query("SELECT * FROM `category`");
while ($row1 = mysqli_fetch_assoc($rs1)){
	$id=$row1['id'];
	$name=$row1['name'];
	$parent=$row1['parent'];//идентификатор родителя
	
	
	
	//вытащить наименование родительской категории
	$rs2 = $mysqli->query("SELECT * FROM `category` WHERE id='".$parent."'");	
	if ($rs2===false) {
		printf("Ошибка #30: %s\n", $mysqli->error);
	}
	$parent_name="";
	while ($row2 = mysqli_fetch_assoc($rs2)){
		$parent_name=$row2['name'];	
		
	}
	//echo "=".$parent_name."=".$parent."=".$name."=".$id."=<br>";
	
	
	$rs3 = $mysqli->query("SELECT * FROM `categories_names` WHERE parent='".$parent_name."' AND child='".$name."' AND parent_id='".$parent."' AND child_id='".$id."'");
	if(mysqli_num_rows($rs3)){
		
	}else{
	
		$rs_insert = $mysqli->query("INSERT INTO `categories_names` (parent,child,parent_id,child_id) VALUES ('".$parent_name."','".$name."','".$parent."','".$id."')");
		if ($rs_insert===false) {
			printf("Ошибка #31: %s\n", $mysqli->error);
		}
	
	}
	
	
	
	
	
}




?>
