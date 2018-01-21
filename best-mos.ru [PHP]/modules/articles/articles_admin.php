<?php
#
#  Админка статей
#
#  Modified         :
#  Version          : 1.0
#  Author           : Alexander Kirillin
#  Programmer                : Kormishin Vladimir
#  Copyright        : (c) «Мастерская Водопьянова»
#


class mod_articles
{
        var $std;
        var $output;

        function process_module()
        {
                // выводим навигацию по модулю "Галерея"
                $this->output        = '<br><table><tr><td width="50"></td><td>';

                $this->output        .= '</td>';
                $id = -1;
                if (isset($this->std->output['id']))
                {
                        $id = $this->std->output['id'];
                }

                if( isset($this->std->input['alias'])  and $this->std->input['alias']!='')
                {
                        $this->std->input['alias'] = strtolower($this->std->input['alias']);
                }

                $this->output        .= "<td><a href='?action=articles&id=-1'>Список</a> </td>";
                $this->output        .= "<td>| <a href='?action=articles_add&id=".$id."'>Новая</a> </td>";
                # если тематикаи включены - создание ссылки на редактирование тематик
                if ($this->std->settings["articles_gen_cat"])
				{
					 $this->output        .= "<td>| <a href='?action=articles_cat'>Редактирование тематик</a> </td>";
				}
               

                if ($id != '-1')
                {
                        $sql = "select pid from `se_articles` where id='".$id."'";
                        if ($this->std->db->query($sql, $rows) > 0)
                        {
                                $this->output        .= "<td>| <a href='?action=articles&id=".$rows[0]['pid']."'>На уровень выше</a></td>";
                        }
                }

                $this->output        .= '</tr></table>';

                switch(@$this->std->input['action'])
                {
                        case 'articles':
                              $this->articles_content();
                              break;

                        case 'articles_add':
                              $this->articles_add( );
                              break;
                        case 'articles_cat':
                              $this->articles_cat( );
                              break;
                        case 'articles_del':
                              $itemid = $this->std->input['itemid'];
                              $this->articles_del($itemid, 0 /* удалять */);
                              $this->articles_content( );
                              break;
                        case 'articles_active':
                              $this->articles_active();
                              $this->articles_content( );
                              break;
                        case 'articles_order':
                             $this->articles_order();
                             break;

                        default:
                                $this->articles_content();
                }

        }

/**************************************************************************************
         вывод подкаталогов определённого уровня
***************************************************************************************/
        function articles_content( )
        {
                $this->output        .= "<script language=javascript>
                                                function doConfirm(message, url) {
                                                        if(confirm(message)) location.href = url;
                                                }
                                        </script>";

                // определение идентификатора каталога
                if (empty($this->std->input['id'])){
                        $id = -1;
                }else{
                        $id                 = $this->std->input['id'];  // айдишник родителя
                }

                $alias_arr        = array();



                /***************************************************************************
                        формирование таблички пунктов каталога
                ****************************************************************************/
                $this->output        .= "<center>";
                // запрашиваем пункты
                $sql         = "select * from `se_articles` order by timestamp desc";
                if ($this->std->db->query($sql, $rows) > 0){


                        $this->output         .= '<table border="1">';
                        $this->output        .= '<tr><td align=center>&nbsp;</td><td align=center>*</td><td align=left>Название</td><td align=left>Дата формирования</td><td align=left>Алиас</td><td>&nbsp;</td></tr>';


                        $i = 0;
                        foreach ($rows as $row)
                        {
                                // определение астивности пунктов меню
                                 $item_active        = '';
                                 $title                        = 'активировать';
                                 if ($row['is_active'] == 1){
                                         $item_active        = ' checked ';
                                         $title                        = 'деактивировать';
                                 }

                                // перекрашиваем строки в зависимости от активности (не активности)
                                if ($item_active != ''){
                                         $this->output .= '<tr style="background:#CCFFCC;">';
                                }else{
                                        $this->output .= '<tr style="background:#FFDDDD;">';
                                }


                                 $this->output        .= '<td width=30 align=center><a href="/admin/?action=articles_add&id='.$id."&itemid=".$row['id'].'"  title="Редактировать"><img src="/'.ADMIN_FOLDER.'/image/img_edit.png"></a></td>';

                                 $this->output        .= '<td align=center><input name="'.$row['id'].'_item_active" type="checkbox" '.$item_active.' title="'.$title.'"
                                                                        OnClick="document.location.href =\'/admin/?action=articles_active&id='.$id.'&itemid='.$row['id'].'\'"></td>';

                                 /****конец: определение астивности пунктов меню*************************************/


                                $row['timestamp'] = $this->std->getNormalTime($row['timestamp']);

                                $this->output        .= '<td width=200>'.$row['title'].'</td>
                                                        <td width=200>'.$row['timestamp'].'</td>
                                                        <td width=200>'.$row['alias'].'</td>';

                                $this->output   .=         '<td width=30 align=center><a href=
                                                                 "javascript:doConfirm(\'Удалить статья?\',\'/admin/?action=articles_del&id='.$id.'&itemid='.$row['id'].'\')"
                                                                 title="Удалить"><img src="/'.ADMIN_FOLDER.'/image/img_del.png"></a></td>';

                                $i++;
                        }
                        $this->output         .= ' </table>';
                }
                else
                {
                        $this->output        .= 'Статей нет';
                }
                $this->output        .= '</center>';


                //------------------------------------------------------------

                $this->output        .= "<hr><center><h4>Настройки новостной страницы</h4>";

                if( $this->std->input['request_method'] != 'post' )
                {

                        $this->std->db->do_query( "SELECT * FROM se_static WHERE alias='articles' AND pid='-1' ORDER BY id DESC LIMIT 0, 1" );
                        $row = $this->std->db->fetch_row();
                        $title       = $row['title'];
                        $menu        = $row['menu'];
                        $description = $row['description'];
                        $keywords    = $row['keywords'];
                        //$depth_count = $row['depth_count'];
                        $h1          = $row['h1'];
                        $body        = $row['body'];
                        // checkbox - активность
                        if (!$row['is_active'])
                        {
                                $active   = '';
                        }
                        else
                        {
                                $active  = 'checked';
                        }
                }
                else
                {
                        extract( $this->std->input );
                        $title = trim( $title );
                        if( $title )
                        {
                                $this->std->db->do_update( 'static', array(  'title'       => $title,
                                                                             'menu'        => $menu ? $menu : $title,
                                                                             'description' => $description,
                                                                             'keywords'    => $keywords,
                                                                             'h1'          => $h1 ? $h1 : $title,
                                                                             'is_active'   => @$active ? 1 : 0,
                                                                             'body'        => $_POST['body'],
                                                                             ), "alias='articles' AND pid='-1'" );
                                // обновляем запись в данных меню

                                // берем всех родителей
                                $this->std->db->do_query( "SELECT id FROM se_mitems WHERE pid=-1" );
                                $father_ids = array();
                                while( $father = $this->std->db->fetch_row() )
                                {
                                        $father_ids[] = $father['id'];
                                }

                                if( count($father_ids) < 1 )
                                {
                                        $father_ids[] = 0;
                                }

                                $this->std->db->do_query( "SELECT id FROM se_mitems WHERE alias='/articles/' AND pid IN(".implode(',', $father_ids).")" );
                                if( $this->std->db->getNumRows() )
                                {
                                        while($menu_array = $this->std->db->fetch_row())
                                        {
                                                $r[] = $menu_array;
                                        }

                                        foreach( $r as $smap_id => $smap_data )
                                        {
                                                if( isset($active ))
                                                {
                                                        $this->std->db->do_update( 'mitems', array( 'title'     => trim($menu) ? $menu : $title,
                                                                                                    'is_active' => 1,
                                                                                             ), 'id='.$smap_data['id'] );

                                                }
                                                else
                                                {
                                                        $this->std->db->do_update('mitems', array( 'is_active' => 0,),'id='.$smap_data['id'] );
                                                }
                                        }
                                }

                                /*----------------------------------------------------------*/
		                        // С модулем нужно провести туже операцию, что и со страницей.
		                        // Актив/Деактив
		                        /*----------------------------------------------------------*/
		                        {
                        				$this->std->db->do_update( 'modules',
                        									array( 'is_active' => @$active ? 1 : 0),
                        									"modulename='articles'" );
		                        }


                                // переход на список, на главную страницу админки модуля
                                header('Location: /admin/?action=articles');
                                exit();
                        }
                        else
                        {
                                // checkbox - активность
                                if (empty($active))
                                {
                                        $active           = '';
                                }
                                else
                                {
                                        $active           = 'checked';
                                }

                                $this->output .= "<br><center><font color=red><li>Заголовок обязателен к заполнению</li></font></center><br>";
                        }

                }


                $this->output .= '<center><form method=post enctype=multipart/form-data>
                        <table border=0 width=90%>
                        <tr>
                        <td align=right>Активировать страницу вывода статей:</td>
                        <td>
                        <input type=checkbox name=active '.$active.'>
                        </td>
                        </tr>
                        <tr>
                        <tr>
                        <td align=right><font color=red>*</font> Название (title):
                        </td>
                        <td width=75%>
                        <input type=text name=title value="'.$title.'">
                        </td>
                        </tr>

                        <tr>
                        <td align=right><font color=red></font> Название в меню:
                        </td>
                        <td width=75%>
                        <input type=text name=menu value="'.$menu.'">
                        </td>
                        </tr>

                        <tr>
                        <td align=right>Заголовок (h1):
                        </td>
                        <td width=75%>
                        <input type=text name=h1 value="'.$h1.'">
                        </td>
                        </tr>

                       <script type="text/javascript" src="/'.ADMIN_FOLDER.'/editor/fckeditor.js"></script>

                        <script type="text/javascript">
                          window.onload = function() {
                            var oFCKeditor = new FCKeditor( \'body\', \'100%\', \'100%\' ) ;
                            oFCKeditor.BasePath = "/'.ADMIN_FOLDER.'/editor/" ;
                            oFCKeditor.ReplaceTextarea() ;
                          }
                        </script>


                        <tr>
                        <td align=right valign=top>
                        </font> Содержимое страницы<br>(HTML-код)</td>
                        <td width=80% height=600>
                        <textarea rows=37 cols=80 name=body >'.$body.'</textarea>
                        </td>
                        </tr>



                        <tr>
                            <td align=right>Описание:</td>
                            <td><input type=text name=description value="'.$description.'" style="width:60%;" class=f3 maxlength=255></td>
                        </tr>

                        <tr>
                            <td align=right>Ключевые слова:</td>
                            <td><input type=text name=keywords value="'.$keywords.'" style="width:60%;" class=f3 maxlength=255> <nobr></nobr></td>
                        </tr>
                        <td>
                        </td>
                        <td>
                        <input type=submit value="Сохранить" class=f2>
                        </td>
                        </tr>
                        </table>
                        </form></center>';

        }



		##################################
        # редактирование категорий статьи
		##################################

        function articles_cat()
        {
			

				


				# если выключен модуль - не выполняем функцию
				if (!$this->std->settings["articles_gen_cat"])
				{
					return;
				}
                # активируем при нажатие на чекбокс
				if ($_GET['change']=='on')
				{
						$this->std->db->do_query("UPDATE `se_articles_cats` SET `is_active`=1 WHERE id='".$_GET['id']."' ");
				}
				# деактивируем при нажатие на чекбокс
				elseif ($_GET['change']=='off')
				{

						$this->std->db->do_query("UPDATE `se_articles_cats` SET `is_active`=0 WHERE id='".$_GET['id']."' ");
				}


                # если нажали сохранить
           		if ($_POST['change_titles'])
				{
						
					$this->std->table_order('articles_cats');
						# берем из базы все тематики, для каждой сопоставляем активность и отмеченные чекбоксы
						$sql = "SELECT id FROM `se_articles_cats`";
						$id  = 1;
						if ($this->std->db->query($sql, $rows) > 0)
						{

								foreach ($rows as $row)
								{

										# сохраняем в таблицу значение названия из формы
										$n_title = 'cat_'.$row['id'];
										$this->std->db->do_query("UPDATE `se_articles_cats` SET `title`='".$_POST["$n_title"]."' WHERE id='".$row['id']."' ");

										$id++;

								}

						}

				}



                
		        if ($_GET['act'])
		        {
						

				         $this->std->table_order('articles_cats');

				        
		        }
		        
		        
		        
		        
		        
		        
		        
		        # если добавлена новая категория - добавляем в таблицу
                if($_POST['add_cat'] and $_POST['new_cat'])
                {

						$this->std->db->do_query("SELECT MAX(item_order) as max FROM  se_articles_cats");
						$max = $this->std->db->fetch_row();
						$articles_id = $max['max'] + 1;

                		$this->std->db->do_query("INSERT INTO `se_articles_cats` (`title`, `item_order`) VALUES ('".$_POST['new_cat']."', '".$articles_id."')");

                }



                # если нажали удалить
				# удаляем все записи с удаляемой тематикой в связной таблице
                if ($_GET['del'])
                {
                		$sql = "DELETE FROM `se_articles_relations_cats` WHERE id_cats='".$_GET['del']."'";
						$this->std->db->do_query($sql);

                		$sql = "DELETE FROM `se_articles_cats` WHERE id='".$_GET['del']."'";
						$this->std->db->do_query($sql);



	                # при удалении уменьшаем на 1 порядок всех тематик, которые имеют item_order больше удаляемой
	                $sql         = "SELECT * FROM se_articles_cats ORDER BY item_order ASC";
					$this->std->db->query($sql, $rows);
					$id = 1;
					foreach ($rows as $row)
					{
							$this->std->db->do_query("UPDATE `se_articles_cats` SET `item_order`='".$id."' WHERE id='".$row['id']."' ");
							$id++;

					}

     			}






                $this->output        .= "<center>";
                // запрашиваем пункты
                $sql         = "SELECT * FROM se_articles_cats ORDER BY item_order ASC";
                
                
                $this->std->db->do_query($sql);
                $row_count = $this->std->db->getNumRows();

                if ($row_count > 0)
                {

                        $this->output        .= "<form method='post' action='/admin/?action=articles_cat'><input type='hidden' name='change' value='1'>";
                        $this->output        .= '<table border="1">';
                        $this->output        .= '<tr>
                        						<td align=center>Категория активна</td>
                        						<td align=center>Темитика</td>
                        						<td align=center colspan=2>Порядок</td>
                        						<td>Удалить</td>
                        						</tr>';


                        $i = 0;
                        while ($row = $this->std->db->fetch_row())
                        {

                                // определение астивности пунктов меню
                                 $item_active        = '';
                                 $title                        = 'активировать';

                                 if ($row['is_active'] == 1)
                                 {
                                         $item_active        = ' checked ';
                                 }


                                if ($item_active != '')
                                {
                                		$this->output .= '<tr style="background:#CCFFCC;">';
                                }
                                else
                                {
                                        $this->output .= '<tr style="background:#FFDDDD;">';
                                }


                                if ($item_active == '')
                                {
                                		$change = 'on';
                                }
                                else
                                {
                                        $change = 'off';
                                }


                               //$this->output        .= '<td align=center><input name="'.$row['id'].'_item_active" type="checkbox" '.$item_active.'></td>';




                               $this->output        .= '<td align=center><input name="'.$row['id'].'_item_active" type="checkbox" '.$item_active.'
                                                                        OnClick="document.location.href =\'/admin/?action=articles_cat&change='.$change.'&id='.$row['id'].'\'"></td>';



                                 /****конец: определение астивности пунктов меню*************************************/

                                $row['alias'] = $row['alias'] == 'index' ? "/" : $row['alias'];

                                $this->output        .= '<td width=300><input name="cat_'.$row['id'].'" type="text" value="'.$row['title'].'" size="50"></td>';


                                // кнопки упорядочивания
                                //$this->output .= $this->std->order_button($row_count, $i, $id, $row, 'articles_cat');
                                $io = $row['item_order']-1;
                                $this->output .= $this->std->order_button($row_count, $io, '-1', $row, 'articles_cat');
                                
                                if( $row['alias'] != '/' and
                                    (!@in_array($row['alias'], $modulename) or $id!=-1) )
                                {
                                        $this->output        .= "<td width=30 align=center><a href=";
                                        $this->output        .= "\"javascript:doConfirm('Удалить категорию?','/admin/?action=articles_cat&del=".$row['id']."')\"";
                                        $this->output        .=        'title="Удалить"><img src="/'.ADMIN_FOLDER.'/image/img_del.png"></a></td>';
                                }
                                else
                                {
                                        $this->output .= "<td width=30 align=center>&nbsp;</td>";
                                }

                                $this->output.= '</tr>';
                                $i++;
                        }
                        $this->output         .= '<tr><td colspan=8 align=center><input type="submit" name="change_titles" value="Сохранить" /></tr>
                                                  </table>';
                }else{
                        $this->output        .= 'Нет категорий'."<form method='post' action='/admin/?action=articles_cat'><input type='hidden' name='change' value='1'>";
                }
                $this->output        .= '';

                $this->output        .= '<p><center><table border="1"><tr>
                        						<td align=center>Добавить тематику </td>
                        						</tr><tr style="background:#CCFFCC;"><td align=center><input name="new_cat" type="text" size="50"></td>
                        						  </tr><tr><td colspan=4 align=center><input name="add_cat" type="submit" value="Добавить категорию" /></tr>
                                                  </table></form></center>';
        }









/************************************************************************************************************
          добавление нового пункта меню (или целого меню)
*************************************************************************************************************/
        function articles_add( )
        {
                $err_msg        = '';
                $alias          = '';
                $title          = '';
                $pid            = '';
                $sbody          = '';
                $author         = '';
                $body           = '';
                $active         = '';
                $description    = '';
                $keywords       = '';
                $owner          = "";


                if ($this->std->input['request_method'] == 'post')
                {

                        $parent = -1;

                        // checkbox - активность
                        if (empty($this->std->input['active']))
                        {
                                $is_active        = 0;
                                $active           = '';
                        }
                        else
                        {
                                $is_active        = 1;
                                $active           = 'checked';
                        }

                        if (($this->std->input['title'] != '') )
                        {       // если поля заполнены, значит можно сохранять
                                $err_msg        =        '';


                                if(!$this->std->input['alias'])
                                {
                                        $this->std->input['alias'] = $this->std->trensliterator($this->std->input['title']);
                                }

                                $ttime = $this->std->getTimestamp($this->std->input['timestamp']);

                                $year      = gmdate('Y', $ttime);// A full numeric representation of a year          4 digits    Examples: 1999 or 2003
                                $month     = gmdate('n', $ttime);// Numeric representation of a month                1 through 12
                                $day       = gmdate('j', $ttime);// Numeric representation of the day of the month   1 to 31

                                $timenow    = gmmktime( 0, 0, 1   , $month, $day, $year );
                                $timethen   = gmmktime( 23, 59, 59, $month, $day, $year);

                                if(empty($this->std->input['itemid']))
                                {
                                        $err_msg  = $this->std->clean_alias($this->std->input['alias']);

                                        $sql = "SELECT id FROM se_articles WHERE timestamp>={$timenow} and timestamp<={$timethen} and alias='{$this->std->input['alias']}' and pid='-1'";

                                        if ($this->std->db->query($sql, $rows) > 0)
                                        {
                                                $err_msg .= 'Такое имя алиаса уже есть';
                                        }
                                }
                                else
                                {
                                        $sql = "select alias from se_articles where id=".$this->std->input['itemid'];
                                        $this->std->db->do_query($sql);
                                        $old_data = $this->std->db->fetch_row();

                                        // проверяем на существование алиаса
                                        $sql = "SELECT id FROM se_articles WHERE timestamp>{$timenow} and timestamp<{$timethen} and alias='{$this->std->input['alias']}' and id!='{$this->std->input['itemid']}'";
                                        $this->std->db->do_query($sql);

                                        if( $old_data['alias'] != $this->std->input['alias'] )
                                        {
                                                $err_msg  = $this->std->clean_alias("/".$this->std->input['alias']."/");

                                                if ( $this->std->db->getNumRows() )
                                                {
                                                        $err_msg .= 'Такое имя алиаса уже есть';
                                                }
                                        }
                                        else
                                        {
                                                $err_msg  = $this->std->clean_alias("/".$this->std->input['alias']."/", 1);

                                                if ( $this->std->db->getNumRows())
                                                {
                                                        $err_msg .= 'Такое имя алиаса уже есть';
                                                }

                                        }
                                }

                                $err_msg .= $this->std->clean_title_menu($this->std->input['title']);

                                $err_msg .= $this->std->clean_title_menu($this->std->input['description'], 'menu', 'Описание указано некорректно');
                                $err_msg .= $this->std->clean_title_menu($this->std->input['keywords'], 'menu', 'Ключевые слова указаны некорректно');


                                // если ошибок при проверке не было, тогда надо заносить новый пункт в меню
                                if ($err_msg == ''){


                                            # если статья создается, его id в $_GET['itemid'] нет, езнаем id последней вставленной статьи
                                            if( empty($_GET['itemid']) )
                                            {
                                   				$this->std->db->do_query("SELECT MAX(id) as max FROM  se_articles");
                								$max = $this->std->db->fetch_row();
                								$articles_id = $max['max'] + 1;
                                            }
                                            else
                                            {
                                            	$articles_id = $_GET['itemid'];
                                            }


							                # берем из базы тематики этой статьи
                                            # если статьи нет в селекте - удаляем тематику из статьи

							                /*
							                $this->std->db->do_query( "SELECT * FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."'" );
									        $id  = 1;
									        while($row = $this->std->db->fetch_row())
									        {
										            $id_cats[$id] = $row['id_cats'];
	                        		                $id_articles[$i] = $row['id_articles'];

	                        		                # выключаем показ ошибки, поскольку если в селектлисте нет выбранных элементов, $_POST['subjects'] - не будет массивом
	                        		                if (!(@in_array("$id_cats[$id]", $_POST['subjects'])))
	                        		                {
	                        		                		$this->std->db->do_query("DELETE FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."' AND id_cats='".$row['id_cats']."'");

	                        		                        //mysql_query("DELETE FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."' AND id_cats='".$row['id_cats']."'");
	                        		                        //print "$id_cats[$id]".'<br>'."DELETE FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."' AND id_cats='".$row['id_cats']."'";
	                        		                }
										        	$id++;
									        }

									       */

											if ($this->std->settings['articles_gen_cat'])
											{

									                # берем из базы тематики этой статьи
		                                            # если статьи нет в селекте - удаляем тематику из статьи
		
		                                            $sql = "SELECT * FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."'";
		                                            $id  = 1;
									                if ($this->std->db->query($sql, $rows) > 0)
									                {
		
									                        foreach ($rows as $row)
									                        {
		
														            $id_cats[$id] = $row['id_cats'];
					                        		                $id_articles[$i] = $row['id_articles'];
		
		
					                        		                # выключаем показ ошибки, поскольку если в селектлисте нет выбранных элементов, $_POST['subjects'] - не будет массивом
					                        		                if (!(@in_array("$id_cats[$id]", $_POST['subjects'])))
					                        		                {
					                        		                		$this->std->db->do_query("DELETE FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."'  AND id_cats='".$row['id_cats']."'");
					                        		                }
														        	$id++;
									                        }
									                }






                                            # берем из селектлиста тематики к статьи
                                            # если тематики нет в статьях  - добавляем тематику к статьи
											$i = 0;
											while ($_POST['subjects'][$i])
											{
						                        # если тематики нет в статьях  - добавляем тематику к статьи
						                        if ($this->std->db->query(("SELECT `id_cats` FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."' AND id_cats='".$_POST['subjects'][$i]."'"), $rows) == 0)
						                        //!mysql_num_rows(mysql_query("SELECT `id_cats` FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."' AND id_cats='".$_POST['subjects'][$i]."'")))
						                        {
                        		                	$this->std->db->do_query("INSERT INTO `se_articles_relations_cats` (`id_articles`, `id_cats`) VALUES('".$articles_id."', '".$_POST['subjects'][$i]."' )");
						                        }

                              					$i++;
                                            }



											# разбиваем строку тематик в подстроки, удаляя пробелы, преобразуя все буквы в нижний регистр, разделитель - запятая
											$new_cat = $_POST['new_cat'];
											$new_cat = strtolower ($new_cat);
											$new_cat = explode (",", $new_cat);

											foreach ($new_cat as $key=>$value)
											{
											    $new_cat[$key] = trim($value);
											}




                                            # смотрим в базу - есть ли уже эта категория
											$i = 0;
											while ($new_cat[$i])
											{
												$sql = "SELECT id FROM se_articles_cats WHERE `title`='".$new_cat[$i]."'";
												$this->std->db->do_query($sql);

												# если нет такой тематики - записываем
												if ( !$rows = $this->std->db->fetch_row() )
												{
													$sql = "INSERT INTO `se_articles_cats` (`title`, `item_order`) VALUES ('".$new_cat[$i]."', '".(mysql_result(mysql_query("SELECT MAX(item_order) FROM  se_articles_cats"),0)+1+$i)."')";
													$this->std->db->do_query($sql);
												}

												# узнаём id категории
												$id_cats = mysql_result(mysql_query("SELECT `id` FROM `se_articles_cats` WHERE title='".$new_cat[$i]."'"),0);
												# если тематика не прикреплена к статьи - прикрепляем
						                        if (!mysql_num_rows(mysql_query("SELECT `id_cats` FROM `se_articles_relations_cats` WHERE id_articles='".$articles_id."' AND id_cats='".$id_cats."'")))
						                        {
                        		                	mysql_query("INSERT INTO `se_articles_relations_cats` (`id_articles`, `id_cats`) VALUES('".$articles_id."', '".$id_cats."' )");
						                        }


                                                $i++;
											}


											}


                                        // если $itemid не существует - будет вставка, иначе - редактирование
                                        if (empty($this->std->input['itemid'])) {

                                                // определяем последний каталог в очереди (по очереди)
                                                $sql        = "select max(item_order) as num_order from se_articles where pid=".$this->std->input['id'];
                                                $this->std->db->do_query($sql);
                                                $max_order = -1;
                                                if ($this->std->db->getNumRows())
                                                {
                                                        $row = $this->std->db->fetch_row( );
                                                        $max_order        = $row['num_order']+1;
                                                }

                                                //Проверяем, не существует ли уже данный алиас
                                                $sql = "SELECT id FROM se_articles WHERE timestamp>={$timenow} and timestamp<={$timethen} and alias='{$this->std->input['alias']}' ";
                                                $this->std->db->do_query($sql);

                                                if ( $rows = $this->std->db->fetch_row() )
                                                {
                                                        $err_msg .= 'Такое имя алиаса уже есть';
                                                        $this->output        .= "<br><center><font color=red>$err_msg</font></center><br>";
                                                }
                                                else
												{
                                                $this->std->db->do_insert( 'articles', array( 'pid'       => -1,
                                                                                         'timestamp' => $this->std->getTimestamp($this->std->input['timestamp']),
                                                                                         'alias'     => $this->std->input['alias'],
                                                                                         'title'     => $this->std->input['title'],
                                                                                         'sbody'     => $this->std->input['sbody'],
                                                                                         'body'      => $_POST['body'],
                                                                                         'author'    => $this->std->input['author'],
                                                                                         'is_active' => $is_active,
                                                                                         'item_order' => $max_order,
                                                                                         'lastmodified' => time(),
                                                                                         'owner'      => @$this->std->input['owner'],
                                                                                         'description'  => $this->std->input['description'],
                                                                                         'keywords' => $this->std->input['keywords'],)  );


                                                // идентификатор для загрузки картинки
												$itemid = $this->std->db->get_insert_id();
												}
                                        }
                                        else
                                        {
                                                $itemid = $this->std->input['itemid'];

                                                //Проверяем, не существует ли уже данный алиас
                                                $sql = "SELECT id FROM se_articles WHERE timestamp>={$timenow} and timestamp<={$timethen} and alias='{$this->std->input['alias']}' and id!='{$this->std->input['itemid']}'";
                                                $this->std->db->do_query($sql);
                                                if ( $rows = $this->std->db->fetch_row() )
                                                {
                                                        $err_msg .= 'Такое имя алиаса уже есть';
                                                        $this->output        .= "<br><center><font color=red>$err_msg</font></center><br>";
                                                }
                                                else
                                                {
												//echo $this->std->getTimestamp($this->std->input['timestamp']);
                                                $this->std->db->do_update( 'articles', array( 'timestamp' => $this->std->getTimestamp($this->std->input['timestamp']),
                                                                                         'alias'     => $this->std->input['alias'],
                                                                                         'title'     => $this->std->input['title'],
                                                                                         'sbody'     => $this->std->input['sbody'],
                                                                                         'body'      => $_POST['body'],
                                                                                         'owner'      => @$this->std->member['name'],
                                                                                         'author'    => $this->std->input['author'],
                                                                                         'is_active' => $is_active,
                                                                                         'lastmodified' => time(),
                                                                                         'description'  => $this->std->input['description'],
                                                                                         'keywords' => $this->std->input['keywords'],),"id=".$itemid );
                                                }

                                        }

                                        // переименовываем картинку и инфу о ней в таблицу
                                        if (isset($_FILES["img"]["name"]) && $_FILES["img"]["name"]!="")
                                        {       // есть картинка
		                                        $this->std->uploadFile( $_FILES["img"], $itemid."_big", "articles", &$err_msg);
                                                $img = strstr($_FILES["img"]["name"],".");
                                                if ($err_msg == "")
		                                        {		// в таблице фиксируем тип загруженной картинки
		                                        		$this->std->db->do_query( "UPDATE se_articles SET img = '".strstr($_FILES["img"]["name"],".")."' WHERE id=".$itemid);

		                                        		// библиотека
				                                        require_once( INCLUDE_PATH."/lib/class_image.php" );
				                                        $class_image = new ClassImage();
				                                        $class_image->std = $this->std;
				                                        $class_image->source		= FILES_PATH."/articles/".$itemid."_big".$img;
				                                        $class_image->ResizeType	= $this->std->settings["articles_th_resize"];
				                                        $class_image->ResizeMethod	= $this->std->settings["articles_th_method"];


				                                        // ресайз 1 - картинка для страницы товара
				                                        $class_image->result		= FILES_PATH."/articles/".$itemid.$img;
				                                        $class_image->resize( $this->std->settings["articles_th_width"], $this->std->settings["articles_th_height"] );


				                                        // ресайз 2 - аватар картинки
				                                        $class_image->ResizeType	= $this->std->settings["articles_av_resize"];
				                                        $class_image->ResizeMethod	= $this->std->settings["articles_av_method"];
				                                        $class_image->result		= FILES_PATH."/articles/".$itemid."_av".$img;
				                                        $class_image->resize( $this->std->settings["articles_av_width"], $this->std->settings["articles_av_height"]);

				                                        // ресайз 3 - большая картинка картинки
				                                        $class_image->ResizeType	= $this->std->settings["articles_big_resize"];
				                                        $class_image->ResizeMethod	= $this->std->settings["articles_big_method"];
				                                        $class_image->result		= FILES_PATH."/articles/".$itemid."_big".$img;
				                                        $class_image->resize( $this->std->settings["articles_big_width"], $this->std->settings["articles_big_height"] );
				                                }



		                                }


                                        // переход на список, на главную страницу админки модуля
										
                                        if(empty($err_msg))
										
                                        {
										extract($this->std->input);
                                                header('Location: /admin/?action=articles&id='.$id);
                                        }
                                        else
                                        {
                                                extract($this->std->input);
                                                // checkbox - активность
                                                if (empty($this->std->input['active']))
                                                {
                                                    $is_active        = 0;
                                                    $active                = '';
                                                }
                                                else
                                                {
                                                    $is_active        = 1;
                                                    $active                = 'checked';
                                                }
                                        }

                                }else{
                                        $this->output        .= "<br><center><font color=red>$err_msg</font></center><br>";
                                        extract($this->std->input);
                                        // checkbox - активность
                                        if (empty($this->std->input['active']))
                                        {
                                                $is_active        = 0;
                                                $active                = '';
                                        }
                                        else
                                        {
                                                $is_active        = 1;
                                                $active                = 'checked';
                                        }
                                }

                        }else{
                                $this->output        .= "<br><center><font color=red><li>Не все поля заполнены</li></font></center><br>";
                                extract($this->std->input);
                                // checkbox - активность
                                if (empty($this->std->input['active']))
                                {
                                        $is_active        = 0;
                                        $active                = '';
                                }
                                else
                                {
                                        $is_active        = 1;
                                        $active                = 'checked';
                                }
                        }
                }
                else
                {
                        $id = $this->std->input['id'];
                        if (isset($this->std->input['itemid']))
                        {

                        		// удаление картинки
                                $this->delImg($this->std->input['itemid']);

                                $itemid = $this->std->input['itemid'];
                                $sql = "select * from `se_articles` where id='".$itemid."'";
                                if ($this->std->db->query($sql, $rows) > 0)
                                {
                                        $row              = $rows[0];
                                        $timestamp        = $this->std->getNormalTime($row['timestamp']);
                                        $alias            = $row['alias'];
                                        $title            = $row['title'];
                                        $pid              = $row['pid'];
                                        $sbody            = str_replace("<br />", "\n", $row['sbody']);
                                        $author           = $row['author'];
                                        $body             = $row['body'];
                                        $owner            = $row['owner'];
                                        $active           = '';
                                        $img              = $row['img'];

                                        if ($row['is_active'] == 1)
                                        {
                                                $active                = 'checked';
                                        }
                                        $lastmodified= $this->std->getNormalTime($row['lastmodified']);
                                        $description = $row['description'];
                                        $keywords         = $row['keywords'];


                                }
                        }else{
                                $lastmodified = $timestamp = $this->std->getNormalTime(time());
                                $active                        = ' checked ';
                        }
                }




                $this->output .= '<center><form method=post enctype=multipart/form-data>

                        <table border=0 width=900>

                                                <tr>
                        <td align=right>Активировать сразу:</td>
                        <td>
                        <input type=checkbox name=active '.$active.'>
                        </td>
                        </tr>
                        <tr>


                        <tr>
                        <td align=right>
                         Алиас (URL):
                        </td>
                        <td>
                        <input type=text name=alias value="'.$alias.'">
                        </td>
                        </tr>


                        <tr>
                        <td align=right><font color=red>*</font> Название (title):
                        </td>
                        <td width=75%>
                        <input type=text name=title value="'.$title.'">
                        </td>
                        </tr>

                        <tr>
                         <td align=right>Дата формирования:</td>
                         <td>

<input type="text" name=timestamp id="f_date_c" size="20" value="'.$timestamp.'" >
<img src="image/img.gif"  align="absmiddle" id="f_trigger_c" style="cursor: pointer; border: 0" title="Выбор даты с помощью календаря"/>
<script type="text/javascript">
    Calendar.setup({
        inputField     :    "f_date_c",        // id of the input field
        ifFormat       :    "%d.%m.%Y %H:%M", // format of the input field
        button         :    "f_trigger_c",    // trigger for the calendar (button ID)
        align          :    "Br",             // alignment
        timeFormat     :    "24",
        showsTime      :    true,
        singleClick    :    true
    });
</script>


                         </td>
                        </tr>

                        <tr>
                         <td align=right>Дата последней редакции:</td>
                         <td><input type=text name=lastmodified value="'.@$lastmodified.'" disabled> (дд.мм.гггг чч:мм)</td>
                        </tr>

                <tr>
                 <td align=right>Автор:</td>
                 <td><input type=text name=author value="'.$author.'" style="width:60%;" class=f3 maxlength=100> <nobr>(а-Яa-Z_0-9 -!)</nobr></td>
                </tr>';


                // картинка
                /*
				if (empty($img) || $img == "")
                {
	                	$this->output .= '<tr><td align=right>Картинка:</td><td><input type=file name=img style="width:60%;" class=f3 size=74></td>';
                }
                else
                {
                		$this->output .= '<tr><td align=right>Картинка:</td><td><input type=hidden name=img value="'.$img.'"><img src="/'.FILES_PATH.'/articles/'.$itemid."_av".$img.'"><a href="/admin/?action=articles_add&id='.$id.'&itemid='.$itemid.'&imgdel=yes">Удалить</a></td>';
                }
				*/



				if ($this->std->settings['articles_gen_cat'])
				{
				        # запрос к базе, получение тематик, отмечаем выбранные тематики
		                $this->std->db->do_query( "SELECT * FROM `se_articles_cats`  ORDER BY item_order ASC" );
		
				        $id  = 1;
		
						$subjects = '<select name="subjects[]" multiple>{select_list}</select>';
		                $select_list ='';
		
				        while($row = $this->std->db->fetch_row())
				        {
				                $articles_title[$id] = $row['title'];
		                        //$articles_id[$i] = $row['id'];
		
		                        # если тематика выбрана для данной статьи - отмечаем в селекте
		                        if (@mysql_result(mysql_query("SELECT `id_cats` FROM `se_articles_relations_cats` WHERE id_articles='".$_GET['itemid']."'  AND id_cats='".$row['id']."' "),0))
		                        {
		                        	$select_list .= "\n<option value='".$row['id']."' selected='selected'>".$row['title']."</option>\n";
		                        }
		                        else
		                        {
		                        	$select_list .= "\n<option value='".$row['id']."'>".$row['title']."</option>\n";
		                        }
		
		
				                $id++;
				        }
		
		                if (!$articles_title[1] )
		                {
		                	$subjects = 'Нет категорий.';
		                }
		                else
		                {
		                	$subjects = str_replace('{select_list}',$select_list,$subjects);
		                }
				}


                $this->output .=       '<tr>
                        <td align=right valign=top>
                        </font> Анонс страницы<br>(HTML-код)</td>
                        <td>
                        <textarea name=sbody style="width:100%; height=100">'.$sbody.'</textarea>
                        </tr>

                        <script type="text/javascript" src="/'.ADMIN_FOLDER.'/editor/fckeditor.js"></script>

                        <script type="text/javascript">
                          window.onload = function() {
                            var oFCKeditor = new FCKeditor( \'body\', \'100%\', \'600\' ) ;
                            oFCKeditor.BasePath = "/'.ADMIN_FOLDER.'/editor/" ;
                            oFCKeditor.ReplaceTextarea() ;
                          }
                        </script>


                        <tr>
                        <td align=right valign=top>
                        </font> Содержимое страницы<br>(HTML-код)</td>
                        <td width=600>
                        <textarea name=body  rows=37 cols=80 >'.$body.'</textarea>
                        </td>
                        </tr>


                        <tr>
                 <td align=right>Описание:</td>
                 <td><input type=text name=description value="'.$description.'" style="width:60%;" class=f3 maxlength=255> <nobr>(а-Яa-Z_0-9 -!)</nobr></td>
                </tr>

                <tr>
                 <td align=right>Ключевые слова:</td>
                 <td><input type=text name=keywords value="'.$keywords.'" style="width:60%;" class=f3 maxlength=255> <nobr></nobr></td>
                </tr>



';
      if ($this->std->settings['articles_gen_cat']) $this->output .= '
 						<tr>
                            <td align=right>Тематика статьи</td>
                            <td>'.$subjects.'<nobr></nobr></td>

                        </tr>


                        <tr>
                            <td align=right></td>
                            <td><font color="333333">Для выбора нескольких тематик, удерживайте клавишу "Ctrl".</font><nobr></nobr></td>
                        </tr>
                        <tr>
                            <td align=right></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td align=right>Ввести новую тематику</td>
                            <td><input type=text name=new_cat style="width:60%;" class=f3 maxlength=255> <nobr></nobr></td>
                        </tr>

                        <tr>
                            <td align=right></td>
                            <td><font color="333333">При вводе нескольких тематик, разделять запятыми.</font><nobr></nobr></td>
                        </tr>

';

        $this->output .= '

                        <td>
                        </td>
                        <td>
                        <input type=submit value="Сохранить" class=f2>
                        </td>
                        </tr>
                        </table>
                        </form></center>';

        }

        /**
         * функция удаляет все подчинённые подменю и далее в глубину (используется реккурсия)
         * $id  - вершина, от неё и вни начинается удаление
         * $delnode  - флаг, 0 - удалять и главную вершину, 1 - не удалять её
         */
        function articles_recurs_del($id, $delnode = 0)
        {
                $sql        = "select * from se_articles where pid=".$id;
                $result      = $this->std->db->do_query($sql);
                if ($this->std->db->getNumRows( ) )
                {
                        while($row = $this->std->db->fetch_row( ))
                        {
                                $this->articles_recurs_del($row['id']);  // очередной реккурсивный вызов
                        }
                }

                // удалять саму вершину или удалить только её подчинённых

                if ($delnode != 1)
                {
                        $sql = "delete from se_articles where id=".$id;
                        $this->std->db->do_query($sql);
                }
        }

/************************************************************************************************************
          удаление пункта меню любого уровня
*************************************************************************************************************/
        function articles_del($id, $delnode = 0  /* признак, удалять саму вершину или удалить только её подчинённых */)
        {
                $this->articles_recurs_del($id, $delnode);
        }

/***********************************************************************
        функция либо делает пункт меню активным либо деактивирует его
************************************************************************/
        function articles_active( )
        {
                $id     = $this->std->input['id'];
                $itemid = $this->std->input['itemid'];

                $sql        = "select is_active from `se_articles` where id=".$itemid;
                if ($this->std->db->query($sql, $rows) > 0)
                {
                        // меняем данные обрабатываемого каталога, делаем его активным либо неактивным
                        $this->std->db->do_update( 'articles', array( 'is_active' => $rows[0]['is_active'] ? 0 : 1), "id=".$itemid );
                }

        }


/************************************************************************************************
        функция меняет порядок следования пунктов в меню
*************************************************************************************************/
   /*     function articles_order( )
        {
                $id         = $this->std->input['id'];
                $itemid     = $this->std->input['itemid'];
                $act        = $this->std->input['act'];
                $order      = $this->std->input['order'];

                // получаем список пунктов
                $sql = "select id, item_order from `se_articles` where pid='".$id."' order by item_order";
                $this->std->db->query($sql);
                $row_count = $this->std->db->getNumRows();
                if ( $row = $this->std->db->fetch_row())
                {
                        if ($act == 'up')
                        {
                                        if ($row['item_order'] == $order-1)
                                        {
                                                $this->std->db->do_update( 'articles', array( 'item_order' => ($order-1) ), "id=".$itemid );
                                                $this->std->db->do_update( 'articles', array( 'item_order' => $order ), "id=".$row['id'] );
                                                break;
                                        }
                                }else{
                                        if ($row['item_order'] == $order+1){
                                                $this->std->db->do_update( 'articles', array( 'item_order' => ($order+1) ), "id=".$itemid );
                                                $this->std->db->do_update( 'articles', array( 'item_order' => $order ), "id=".$row['id'] );
                                                break;
                                        }
                                }
                }

                header('Location: /admin/?action=articles&id='.$id);
        }
*/

        // формирование меню, составление дерева ссылок
        // Для составления меню, необходимы прямые ссылки на страницы. Все страницы подчинены правилу построения дерева.
        // данная функция вызывается из "admin_menu.php" из функции "menu_content"
        function articles_menu($alias_arr)
        {

                $cheched = '';
                if (in_array("/articles/",$alias_arr))
                {
                        $cheched = 'checked';
                }
                $form = @$nbsp."<table><tr><td width='0'></td><td align=left>
                                                                                        - <input type='checkbox' name='-1_checkbox' $cheched>&nbsp;Модуль вывода статей
                                                                                          <input type='hidden' name='-1_url' value='/articles/'>
                                                                                          <input type='hidden' name='-1_name' value='Статьи'>
                                                                                </td></tr></table>";

                $form = "<input type='hidden' name='module_list_id' value='-1'>
                                         <input type='hidden' name='module_tablename' value='-1'>
                                         <table border=1><tr><td align=left bgcolor='#FFFFFF'>".$form."</td></tr></table>
                                                        <input type='submit' value='Обновить меню'>";
                return $form;
        }


		/**
         * Удаление картинки
         *
         */
        function delImg($itemid)
        {
	            if (isset($this->std->input["imgdel"]))
	            {       // удаляем картинку
	                    $sql = "SELECT img FROM se_articles where id={$itemid}";
	                    if ($this->std->db->query($sql, $rows) > 0)
	                    {

                                $this->std->db->do_update("articles", array("img" => ""), "id={$itemid}");

                                @unlink(FILES_PATH."/articles/".$itemid.$rows[0]["img"]);	// удаление оригинала
                                @unlink(FILES_PATH."/articles/".$itemid."_big".$rows[0]["img"]);	// удаление основной
     							@unlink(FILES_PATH."/articles/".$itemid."_av".$rows[0]["img"]);	// удаление аватара
	                    }
	            }
        }

}

?>