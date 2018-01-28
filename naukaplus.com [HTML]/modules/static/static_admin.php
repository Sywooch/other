<?
#
#  Ядро системы и разделы сайта
#  Админка статических страниц
#


class mod_static
{
        var $std;
        var $navi_action = array();
        var $output = '';
        var $global_ids = array();
        var $is_father_enable = true;

        function process_module()
        {	
        		# меню админки
				$this->std->setPul('admin', 'menu', '<li><a class=menu href="/admin/?action=static">Страницы</a></li>');
        	
        		if ((count($this->std->alias) == 2) && isset($_GET['action']) && !in_array($_GET['action'], $this->navi_action))
        		{
        			return;
        		}
        		elseif((count($this->std->alias) > 1) && !isset($_GET['action']))
        		{
        			return;
        		}
        		
        		// модуль c конфигурационными данными
                require_once('static_config.php');
        		
        		
        	
        		# заголовок
        		$this->std->setPul('admin', 'h1', 'Статические страницы');

                // выводим навигацию                
                $id = -1;
                if( isset($this->std->input['alias'])  and $this->std->input['alias']!='')
                {
                        $this->std->input['alias'] = strtolower($this->std->input['alias']);
                }

                if (isset($this->std->input['id']))
                {
                        $id = $this->std->input['id'];
                }


                $this->std->setPul('admin', 'mod_menu', "<a href='?action=static&id={$id}'>Список</a>&nbsp;&nbsp;");
                $this->std->setPul('admin', 'mod_menu', "<a href='?action=static_add&id=".$id."'>Новая страница</a>&nbsp;&nbsp;");
                

                if ($id != '-1')
                {
                        $sql = "select pid, is_active from `se_static` where id='".$id."'";
                        $this->std->db->do_query($sql);

                        if ( $rows = $this->std->db->fetch_row() )
                        {
                                if( !$rows['is_active'] )
                                {
                                        $this->is_father_enable = false;
                                }

                                $this->std->setPul('admin', 'mod_menu', "<a href='?action=static&id=".$rows['pid']."'>На уровень выше</a>&nbsp;&nbsp;");
                            
                        }
                }

                

                switch($this->std->input['action'])
                {
                        case 'static':
                                $this->static_content( );
                                break;
                        case 'static_add':
                                $this->static_add( );
                                break;
                        case 'static_del':
                                $itemid = $this->std->input['itemid'];
                                $this->static_del($itemid, 0 /* удалять */);
                                $this->static_renum($id);
                                $this->static_addTreeToMenu();
                                $this->static_content( );
                                break;
                        case 'static_active':
                                $itemid = $this->std->input['itemid'];
                                $this->static_active($itemid);
                                $this->static_addTreeToMenu();
                                $this->static_content( );
                                break;
                        case 'static_order':
                                $this->static_order();
                                $this->static_addTreeToMenu();
                                header('Location: /admin/?action=static&id='.$id);
                                break;
                        default:
                                $this->static_content();
                                break;
                }
        }

/**************************************************************************************
         вывод подкаталогов определённого уровня
***************************************************************************************/
        function static_content( )
        {
        		$this->output = '';

                // определение идентификатора каталога
                $id  = isset($this->std->input['id']) ? $this->std->input['id'] : -1;  // айдишник родителя

                $alias_arr        = array();

                /***************************************************************************
                        формирование таблички пунктов каталога
                ****************************************************************************/
                

                $sql = "select modulename from se_modules";
                $this->std->db->do_query($sql);
                $modulename  = array();
                while ($row = $this->std->db->fetch_row())
                {
                        $modulename[] = $row['modulename'];
                }

                // запрашиваем пункты
                $sql         = "select c1.*, count(c2.id) as childs from `se_static` c1
                                                left join `se_static` c2 on (c2.pid=c1.id)
                                    where c1.pid='".$id."'
                                    group by c1.id order by c1.item_order";
                $this->std->db->do_query($sql);
                $row_count = $this->std->db->getNumRows();

                if ($row_count > 0)
                {

                        $this->output        .= "<form method='post' action='/admin/?action=static_order&id=".$id."'>";
                        $this->output        .= '<table class="work_tab" width=90%>';
                        $this->output        .= '<tr><td width="5%"></td><td width="5%"></td><td width="5%"></td><td align=left>Название</td><td align=left>Алиас</td><td align=center colspan=2>Порядок</td><td>&nbsp;</td></tr>';


                        $i = 0;
                        while ($row = $this->std->db->fetch_row())
                        {
                                // определение астивности пунктов меню                                                                                
		                        $color = $row['is_active'] == 1 ? 'CCFFCC' : 'dedede';
								$is_active_src = $row['is_active'] == 1 ? '/'.$this->std->config['folder_admin'].'/image/play.png' : '/'.$this->std->config['folder_admin'].'/image/stop.png';
								$is_active_title = $row['is_active'] == 1 ? 'Декативировать' : 'Активировать';
		                         
		                        $this->output .= '<tr style="background:#'.$color.';">';



                                 $this->output   .=         '<td width=30 align=center><a href="/admin/?action=static_add&id='.$id."&itemid=".$row['id'].'"  title="Редактировать"><img src="/'.$this->std->config['path_admin'].'/image/img_edit.png"></a></td>';

                                 if ($row['childs'] > 0){
                                         $this->output   .= '<td width=30 align=center><a href="/admin/?action=static&id='.$row['id'].'"  title="Просмотреть подразделы"><img src="/'.$this->std->config['path_admin'].'/image/catalog.png"></a></td>';
                                 }else{
                                         $this->output   .= '<td width=30 align=center>-</td>';
                                 }

                                 if( $row['alias'] == 'index'  )
                                 {
                                         $this->output        .= '<td align=center>-</td>';
                                         
                                 }
                                 elseif( !$this->is_father_enable )
                                 {
                                         $this->output        .= '<td align=center>-</td>';
                                 }
                                 else
                                 {                                         
                                         $this->output        .= '<td align=center><a href="/admin/?action=static_active&id='.$id.'&itemid='.$row['id'].'" title="'.$is_active_title.'"><img src="'.$is_active_src.'"></a></td>';
                                 }

                                 /****конец: определение астивности пунктов меню*************************************/

                                $row['alias'] = $row['alias'] == 'index' ? "/" : $row['alias'];

                                $this->output        .= '<td width=300>'.$row['title'].'</td>
                                                        <td width=300>'.$row['alias'].'</td>';


                                // кнопки упорядочивания
                                $this->output .= $this->std->order_button($row_count, $i, $id, $row, 'static_order');

                                if( $row['alias'] != '/' and
                                    (!in_array($row['alias'], $modulename) or $id!=-1) )
                                {
                                        $this->output        .= "<td width=30 align=center><a href=";
                                        $this->output        .= "\"javascript:doConfirm('Удалить подраздел?','/admin/?action=static_del&id=".$id."&itemid=".$row['id']."')\"";
                                        $this->output        .=        'title="Удалить"><img src="/'.$this->std->config['path_admin'].'/image/img_del.png"></a></td>';
                                }
                                else
                                {
                                        $this->output .= "<td width=30 align=center>&nbsp;</td>";
                                }

                                $this->output.= '</tr>';
                                $i++;
                        }
                        $this->output         .= '<tr><td colspan=8 align=right><input type="submit" value="Обновить позиции" /></tr>
                                                  </table></form>';
                }else{
                        $this->output        .= 'Раздел пуст';
                }
                

        }

/************************************************************************************************************
          добавление нового пункта меню (или целого меню)
*************************************************************************************************************/
        function static_add( )
        {
                $err_msg        = '';
                $alias                = '';
                $title                = '';
                $pid                = '';
                $sbody                = '';
                $author                = '';
                $body                = '';
                $active                = '';
                $menu                = '';
                $description = '';
                $keywords         = '';
                $h1                         = '';
                $template         = '';

                $disabled_owner = 'disabled';

                if ($this->std->input['request_method'] == 'post')
                {
                        extract($this->std->input);

                        if ($title != '') // если поля заполнены, значит можно сохранять
                        {
                                $err_msg        =        '';

                                if(!$alias)
                                {
                                        $alias = $this->std->trensliterator($title);
                                }

                                if( $alias == '/' )
                                {
                                        $alias = 'index';
                                }
                                if( $this->std->input['type'] == 'index' )
                                {
                                        $alias  = 'index';
                                        $active = 1;
                                        $parent = -1;
                                }

                                if(!isset($itemid))
                                {
                                        $err_msg  = $this->std->clean_alias($alias);
                                        $err_msg  .= $this->std->double_clean_alias($alias, 0, $parent, 'static');
                                }
                                else
                                {
                                        $sql = "select pid, alias from se_static where id=".$itemid;
                                        $this->std->db->do_query($sql);
                                        $old_data = $this->std->db->fetch_row();

                                        if( $old_data['alias'] != $alias)
                                        {
                                                $err_msg  = $this->std->clean_alias("/".$alias."/");
                                                $err_msg  .= $this->std->double_clean_alias($alias, 0, $parent, 'static');
                                        }
                                        else
                                        {
                                                $err_msg  = $this->std->clean_alias("/".$alias."/", 1);
                                                $err_msg  .= $this->std->double_clean_alias($alias, 1, $parent, 'static');
                                        }


                                        //-----------------------------------------
                                        // Are we trying to do something stupid
                                        // like running with scissors or moving
                                        // the parent of a category into itself
                                        // spot?
                                        //-----------------------------------------

                                        if ( $parent != $old_data['pid'] )
                                        {
                                                $parents_array = array();
                                                $sql="SELECT id,pid FROM se_static order by pid,item_order ASC";
                                                $this->std->db->do_query($sql);
                                                while( $rr = $this->std->db->fetch_row() )
                                                {
                                                        $parents_array[ $rr['pid'] ][ $rr['id'] ] = $rr;
                                                }

                                                $ids   = $this->std->_get_children( $parents_array, $itemid );
                                                $ids[] = $itemid;
                                                if ( in_array( $parent, $ids ) )
                                                {
                                                        $err_msg .= "Извините, невозможно перенести структуру саму в себя.";
                                                }



                                                // проверка на совпадение алиасов привязываемной вершины и имеющихся на новом уровне
                                                $sql = "SELECT id FROM se_static WHERE pid = '{$parent}' AND alias = '{$alias}'";
                                                if ($this->std->db->query($sql, $rows) > 0)
                                                {        // если совпадение алиасов есть, то перенос невозможен, генерим ошибку
                                                                $err_msg .= "Такой алиас присуствует в системе, укажите уникальный алиас.";
                                                }
                                                else
                                                {        // если совпадений нет, то определяем номер последней вершины и ставим переносимую за последней
                                                                $sql = "SELECT max(item_order) AS item_order FROM se_static WHERE pid = '{$parent}'";
                                                                if ($this->std->db->query($sql, $rows) > 0)
                                                                {
                                                                                $sql = "UPDATE se_static SET item_order = ".($rows[0]["item_order"]+1)." WHERE id='{$itemid}'";
                                                                                $this->std->db->do_query($sql);
                                                                }

                                                }
                                        }
                                }


                                $err_msg .= $this->std->clean_title_menu($title);
                                $err_msg .= $this->std->clean_title_menu($menu, 'menu');
                                $err_msg .= $this->std->clean_title_menu($description, 'menu', 'Описание указано некорректно');
                                $err_msg .= $this->std->clean_title_menu($keywords, 'menu', 'Ключевые слова указаны некорректно');


                                // если заголовой не заполнен, то ставим ему значения заголовка страницы
                                if ($h1 == ''){
                                        $h1  = $title;
                                }

                                // если название в меню не заполнено, то ставим ему значения заголовка страницы
                                if ($menu == ''){
                                        $menu  = $title;
                                }

                                // checkbox - активность
                                if (empty($active))
                                {
                                        $is_active        = 0;
                                        $active           = '';
                                }
                                else
                                {
                                        $is_active        = 1;
                                        $active           = 'checked';
                                }


                                // если ошибок при проверке не было, тогда надо заносить новый пункт в меню
                                if ($err_msg == ''){//Если всё ништяк - пишем в базу, да.

                                                // установлен ли флаг региректа
                                                $isredirect = isset($isredirect) ? "1" : "0";

                                        // если название в меню не заполнено, то ставим ему значения заголовка страницы
                                        if ($menu == ''){
                                                $menu  = $title;
                                        }

                                        // если $itemid не существует - будет вставка, иначе - это редактирование
                                        if (!isset($itemid)) {

                                                // определяем последний каталог в очереди (по очереди)
                                                $sql        = "select max(item_order) as num_order from se_static where pid=".$id;
                                                $this->std->db->do_query($sql);
                                                $rows = $this->std->db->fetch_row();
                                                $max_order  = $rows['num_order']+1;

                                                //Проверяем, не существует ли уже данный алиас
                                                $sql = "SELECT id FROM se_static WHERE alias='$alias' and pid='$parent'";
                                                $this->std->db->do_query($sql);
                                                if ($this->std->db->getNumRows())
                                                {
                                                        $err_msg .= 'Такое имя алиаса уже есть';
                                                }

                                                $this->std->db->do_insert( 'static', array( 'pid'       => $parent,
                                                                                     'timestamp' => $this->std->getTimestamp($timestamp),
                                                                                     'alias'     => $alias,
                                                                                     'title'     => $title,
                                                                                     'menu'      => $menu,
                                                                                     'sbody'     => $sbody,
                                                                                     'body'      => str_replace("'", "&#146", $_POST["body"]),
                                                                                     'author'       => $author,
                                                                                     'is_active'    => $is_active,
                                                                                     'item_order'   => $max_order,
                                                                                     'lastmodified' => time(),
                                                                                     'description' => $description,
                                                                                     'keywords'    => $keywords,
                                                                                     'owner'      => $owner ? $owner : $this->std->member['user_name'],
                                                                                     'h1'         => $h1,
                                                                                     'template'   => $template,
                                                                                     'is_redirect' => $isredirect ) );


                                        }
                                        else
                                        {


                                                $this->std->db->do_update( 'static', array( 'pid'       => $parent,
                                                                                     'timestamp' => $this->std->getTimestamp($timestamp),
                                                                                     'alias'     => $alias,
                                                                                     'title'     => $title,
                                                                                     'menu'      => $menu,
                                                                                     'sbody'     => $sbody,
                                                                                     'owner'     => $owner ? $owner : $this->std->member['user_name'],
                                                                                     'body'      => str_replace("'", "&#146", $_POST["body"]),
                                                                                     'author'    => $author,
                                                                                     'is_active' => $is_active,
                                                                                     'lastmodified' => time(),
                                                                                     'description' => $description,
                                                                                     'keywords'    => $keywords,
                                                                                     'h1'         => $h1,
                                                                                     'template'   => $template,
                                                                                     'is_redirect' => $isredirect ), "id=$itemid" );

                                                // рекурсивная автивация или деактивация
                                                $this->static_active_recurs($itemid, $is_active);



                                        }


                                        // перенумеровка пунктов
                                        $this->static_renum($id);
                                        $this->static_renum($parent);

                                        // обновление меню
                                        $this->static_addTreeToMenu();


                                        /*----------------------------------------------------------*/
				                        // С модулем нужно провести туже операцию, что и со страницей.
				                        // Актив/Деактив
				                        // запускаем только для тех вершин, которые стоят на 1-м уровне
				                        /*----------------------------------------------------------*/
				                        if ($parent == -1)
				                        {
		                        				$this->std->db->do_update( 'modules',
		                        									array( 'is_active' => $active ? 1 : 0),
		                        									"modulename='$alias' AND modulename <> 'menu' AND modulename<>'static' AND modulename <> 'modules' AND modulename <> 'zsett'" );
				                        }

                                        // переход на список, на главную страницу админки модуля
                                        header('Location: /admin/?action=static&id='.$id);

                                }else{
                                        $this->output        .= "<br><center><font color=red>$err_msg</font></center><br>";
                                }
                        }
                        else
                        {
                                if( $alias == '/' )
                                {
                                        $alias = 'index';
                                }
                                if( $this->std->input['type'] == 'index' )
                                {
                                        $alias  = 'index';
                                        $active = 1;
                                }
                                // checkbox - активность
                                if (empty($active))
                                {
                                        $is_active        = 0;
                                        $active           = '';
                                }
                                else
                                {
                                        $is_active        = 1;
                                        $active           = 'checked';
                                }

                                $this->output        .= "<br><center><font color=red>Не все поля заполнены</font></center><br>";
                        }
                }
                else
                {
                        $id = $this->std->input['id'];
                        if (isset($this->std->input['itemid']))
                        {        // если переходит именно к редактированию страницы, то возможно нужно будет перекинуть на определённый модуль, для редактирования контента уже там
                                $itemid = $this->std->input['itemid'];
                                $sql = "select * from `se_static` where id='".$itemid."'";
                                $this->std->db->do_query($sql);

                                if ($row = $this->std->db->fetch_row())
                                {
                                        $timestamp           = $this->std->getNormalTime($row['timestamp']);
                                        $alias               = $row['alias'];
                                        $title               = $row['title'];
                                        $pid                 = $row['pid'];
                                        $sbody               = str_replace( "<br />", "\n", $row['sbody']);
                                        $author              = $row['author'];
                                        $body                = $row['body'];
                                        $menu                = $row['menu'];
                                        $table_father		= $row['table_father'];
                                        $active              = '';
                                        $owner               = $row['owner'];

                                        if ($row['is_active'] == 1)
                                        {
                                                $active  = ' checked ';
                                        }
                                        $lastmodified     = $this->std->getNormalTime($row['lastmodified']);
                                        $description      = $row['description'];
                                        $keywords         = $row['keywords'];
                                        $h1               = $row['h1'];
                                        $template         = $row['template'];

                                        // берем активность отца
                                        $sql = "select is_active from `se_static` where id='".$pid."'";
                                        $this->std->db->do_query($sql);

                                        $father = $this->std->db->fetch_row();

                                        if( $alias == 'index' )
                                        {
                                                $alias = "/";
                                                $disabled = ' disabled ';
                                                $disabled_checkbox = ' disabled ';
                                                $hidden   = "<input type=hidden name=type value='index'>";
                                        }
                                        elseif((is_array($father) && ($father['is_active'] == 0)))
                                        {
                                                $disabled_checkbox = ' disabled ';
                                        }
                                        else
                                        {
                                                $disabled = '';
                                                $disabled_checkbox = '';
                                                $hidden   = "";
                                        }


                                        // опциональный редирект на первого ребёнка
                                                        if (count($this->std->getChildsOfNodeById($row['id'], "se_static")) > 0)
                                                        {
                                                                $isredirect = $row['is_redirect'] == "1" ?  "checked" :  "";        // галка активации редиректа
                                                                $isredirect = '<tr>
                                                                                <td align=right>Активировать редирект на первого наследника:</td>
                                                                                        <td>
                                                                                                <input type=checkbox name=isredirect '.$isredirect.'>
                                                                                        </td>
                                                                                        </tr>';
                                                        }
                                                        // конец: опциональный редирект на первого ребёнка
                                }
                                
                                
                                if ($table_father != '')
                                {
                                	$disabled = ' disabled ';
                                }

                               

                                // поле авторедиректа на какую-то подчинённую страницу
                                // появляется только при редактировании страницы
                                $autoRedirect = '
                                        <tr>
                                                <td align=right>Родительская страница:</td>
                                                <td>

                                                </td>
                                                </tr>';

                        }
                        else
                        {
                                $lastmodified = $timestamp = $this->std->getNormalTime(time());
                                $active       = ' checked ';

                                if( !$template )
                                {
                                        if( $this->std->input['action'] == 'static_add' and $this->std->input['id'] > 0 )
                                        {
                                                $this->std->input['id'] = intval($this->std->input['id']);

                                                // определяем последний каталог в очереди (по очереди)
                                                $sql          = "select template from se_static where id=".$this->std->input['id'];
                                                $this->std->db->do_query($sql);
                                                $template_row = $this->std->db->fetch_row();
                                                $template     = $template_row['template'];
                                        }
                                }
                        }
                }

                $owner = $owner ? $owner : $this->std->member['user_name'];

                $templ_arr = $this->std->get_templates_names();

                $resault_template_array = array();

                foreach( $templ_arr as $_tep_id => $tpl_name )
                {
                        $resault_template_array[] = array( $tpl_name, $tpl_name );
                }

                array_unshift( $resault_template_array, array( '', '--Выберите шаблон из списка, если это требуется--' ) );

                $this->output .= '<form method=post enctype=multipart/form-data>
                        '.$hidden.'
                        <table border=0 width=90%>

                        <tr>
                        <td align=right>Активировать сразу:</td>
                        <td>
                        <input type=checkbox '.$disabled_checkbox.' name=active '.$active.'>
                        </td>
                        </tr>
                        <tr>


                        ';
				if ($disabled == '')
				{
					$this->output .= '
					<tr>
                        <td align=right>
                        Алиас (URL):
                        </td>
                        <td>
                        	<input type=text name=alias value="'.$alias.'">
                        </td>
                    </tr>';
				}
				else
				{
					$this->output .= '
					<tr>
                        <td align=right>
                        Алиас (URL):
                        </td>
                        <td>
                        	'.$alias.'<input type=hidden name=alias value="'.$alias.'">
                        </td>
                    </tr>';
				}
                	
                        
				


				$this->output .= '
						<tr>
                        <td align=right><font color=red>*</font> Название (title):
                        </td>
                        <td width=75%>
                        <input type=text name=title value="'.$title.'" style="width:100%;">
                        </td>
                        </tr>

                        <tr>
                        <td align=right>Заголовок (h1):
                        </td>
                        <td width=75%>
                        <input type=text name=h1 value="'.$h1.'" style="width:100%;">
                        </td>
                        </tr>

                        <tr>
                        <td align=right><font color=red></font> Название в меню:
                        </td>
                        <td width=75%>
                        <input type=text name=menu value="'.$menu.'" style="width:100%;">
                        </td>
                        </tr>

                        <tr>
                         <td align=right>Дата формирования:</td>

                         <td>
                        <script type="text/javascript">
                        <!--

                        function date_insert()
                        {
                                timeinput = document.getElementById(\'f_date_c\');

                                mydate  = new Date();

                                year   = mydate.getFullYear();
                                day    = mydate.getDate();

                                day = day < 10 ? "0" + day : day;
                                month  = mydate.getMonth();
                                month += 1;
                                month  = month < 10 ? "0" + month : month;

                                var hours=mydate.getHours();
                                hours = hours < 10 ? "0" + hours : hours;
                                var minutes=mydate.getMinutes();
                                minutes = minutes < 10 ? "0" + minutes : minutes;

                                timeinput.value = day + "." + month + "." + year + " " + hours + ":" + minutes;
                        }

                        //-->
                        </script>
<input type="text" onDblClick="date_insert()" name=timestamp id="f_date_c" size="20" value="'.$timestamp.'" >

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
                         <td><input type=text name=lastmodified value="'.$lastmodified.'" disabled> (дд.мм.гггг чч:мм)</td>
                        </tr>


                        <tr>
                        <td align=right>Родительская страница:</td>
                        <td>
                        <select name=parent style="width:100%;">';

                		if ($disabled == '')
                		{
		                        $sql="SELECT id,pid,title FROM se_static WHERE alias != 'index' order by pid,item_order ASC";
		                        $this->std->db->do_query($sql);
		
		                        if ($this->std->db->getNumRows())
		                        {
		                                while ($row = $this->std->db->fetch_row())
		                                {
		                                        if( $row['pid'] < 1 )
		                                        {
		                                                $row['pid'] = 'root';
		                                        }
		
		                                        $r[ $row['pid'] ][ $row['id'] ] = $row;
		                                }
		
		                                $this->output .= $this->std->get_list_pages($r);
		                        }
		                        else
		                        {
		                                $this->output .= $this->std->get_list_pages(array());
		                        }
                		}
                		else
                		{
                				$this->output .= '<option value="-1">Главная';
                		}

                        $this->output .= '</select>
                        </td>
                        </tr>';



                        // опциональный редирект на первого ребёнка
                        $this->output .= $isredirect;


                        $this->output .= '

                <tr>
                 <td align=right>Автор:</td>
                 <td><input type=text name=author value="'.$author.'" style="width:60%;" class=f3 maxlength=100> <nobr>(а-Яa-Z_0-9 -!)</nobr></td>
                </tr>
                <tr>
                 <td align=right>Собственник:</td>
                 <td><input type=text name=owner value="'.$owner.'" style="width:60%;" class=f3 maxlength=100 '.$disabled_owner.'> <nobr>(а-Яa-Z_0-9 -!)</nobr></td>
                </tr>


                        <tr>
                        <td align=right valign=top>
                        </font> Анонс страницы<br>(HTML-код)</td>
                        <td>
                        <textarea name=sbody style="width:100%;">'.$sbody.'</textarea>
                        </tr>

                        <script type="text/javascript" src="/'.$this->std->config['path_admin'].'/editor/fckeditor.js"></script>

                        <script type="text/javascript">
                          window.onload = function() {
                            var oFCKeditor = new FCKeditor( \'body\', \'100%\', \'100%\' ) ;
                            oFCKeditor.BasePath = "/'.$this->std->config['path_admin'].'/editor/" ;
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
                 <td><input type=text name=description value="'.$description.'"  style="width:100%;" class=f3> <nobr>(а-Яa-Z_0-9 -!)</nobr></td>
                </tr>

                <tr>
                 <td align=right>Ключевые слова:</td>
                 <td><input type=text name=keywords value="'.$keywords.'"  style="width:100%;" class=f3> <nobr></nobr></td>
                </tr>

                <tr>
                 <td align=right>Шаблон:</td>
                 <td>'.$this->_dropdown('template', $resault_template_array, $template).' <nobr></nobr></td>
                </tr>

                        <td>
                        </td>
                        <td>
                        <input type=submit value="Сохранить" class=f2>
                        </td>
                        </tr>
                        </table>
                        </form>';

        }


        function _dropdown($name, $list=array(), $default_val="")
        {

                $html = "<select name='$name'>\n";

                foreach ($list as $v)
                {
                        $selected = "";

                        if ( ($default_val != "") and ($v[0] == $default_val) )
                        {
                                $selected = ' selected';
                        }

                        $html .= "<option value='".$v[0]."'".$selected.">".$v[1]."</option>\n";
                }

                $html .= "</select>\n\n";

                return $html;


        }


        /**
         * функция делает вершину либо активной либо деактивирует её
         *
         */
        function static_active($id)
        {
                // инфо о деактивируемой вершины
                $sql   = "select is_active, pid, alias from `se_static` where id=".$id;
                $this->std->db->do_query($sql);

                if ( $rows = $this->std->db->fetch_row())
                {
                        // меняем данные обрабатываемого каталога, делаем его активным либо неактивным
                        $this->static_active_recurs($id, ($rows['is_active'] ? 0 : 1));



                        /*----------------------------------------------------------*/
                        // Если страничка стоит на первом уровне, то возможно она
                        // является главной страницей модуля.
                        // С модулем нужно провести туже операцию, что и со страницей.
                        // Актив/Деактив
                        /*----------------------------------------------------------*/
                        if ($rows['pid'] == -1)
                        {
                        		$this->std->db->do_update( 'modules',
                        									array( 'is_active' => $rows['is_active'] == 1 ? 0 : 1),
                        									"modulename='".$rows['alias']."'" );
                        		header("Location: /admin/");
                        }
                }

        }


        /**
         * Реккурсивное изменение статусов активности у всего подчинённого дерева
         *
         * @param unknown_type $id
         */
        function static_active_recurs($id, $is_active)
        {
                $sql          = "select * from se_static where pid=".$id;
                $this->std->db->do_query($sql);

                if ($this->std->db->getNumRows())
                {
                        while($rows = $this->std->db->fetch_row())
                        {
                                $r[] = $rows;
                        }


                        foreach($r as $_id => $row)
                        {
                                $this->static_active_recurs($row['id'], $is_active);  // очередной реккурсивный вызов
                        }
                }

                // инфо о деактивируемой вершины
                $sql        = "select is_active from `se_static` where id=".$id;
                $this->std->db->do_query($sql);

                if ( $rows = $this->std->db->fetch_row())
                {
                        // меняем данные обрабатываемого каталога, делаем его активным либо неактивным
                        $this->std->db->do_update( 'static', array( 'is_active' => $is_active), "id=".$id );
                }

        }


        /**
         * рекурсивное удаление вершины и всех её потомков
         *
         * @param unknown_type $id                - идентификатор вершины
         * @param unknown_type $delnode        - удалять ли саму вершину? 1 - нет
         */
        function static_recurs_del($id, $delnode = 0)
        {
                $sql        = "select * from se_static where pid=".$id;
                $this->std->db->do_query($sql);

                if ($this->std->db->getNumRows())
                {
                        while($rows = $this->std->db->fetch_row())
                        {
                                $r[] = $rows;
                        }


                        foreach($r as $_id => $row)
                        {
                                $this->static_recurs_del($row['id']);  // очередной реккурсивный вызов
                        }
                }

                // удалять ли саму вершину или удалить только её подчинённых
                if ($delnode != 1)
                {
                        $sql = "delete from se_static where id=".$id;
                        $this->std->db->do_query($sql);
                }
        }

        /**
         * удаление вершины любого уровня
         *
         * @param unknown_type $id                - идентификатор вершины
         * @param unknown_type $delnode        - удалять ли саму вершину? 1 - нет
         */
        function static_del($id, $delnode = 0)
        {
                $this->static_recurs_del($id, $delnode);
        }


        /**
         * функция меняет порядок следования вершин
         */
        function static_order()
        {
                $this->std->table_order('static');
        }


        /**
         * перенумерация каталогов
         *
         * @param unknown_type $id        - идентификатор предка
         */
        function static_renum($id)
        {
                $sql = "select id from `se_static` where pid='".$id."' order by item_order";
                //$this->std->db->query($sql, $r);

                if ( $this->std->db->query($sql, $r) )
                {
                        $i = 1;
                        foreach ($r as $row)
                        {
                                $this->std->db->do_update( 'static', array( 'item_order' => $i ), "id=".$row['id']  );
                                $i++;
                        }
                }
        }

        /***************************************************************************************************
                РАЗДЕЛ РАБОТЫ С МЕНЮ
        ***************************************************************************************************/



        /**
         * построения девера наследования для переноса информации в меню
         *
         * @param unknown_type $pid                       - родитель
         * @param unknown_type $tab                       - отступы (наведение красоты)
         * @param unknown_type $form                      - форма вывода
         * @param unknown_type $alias                     - путь (заносится в пункты меню)
         * @param unknown_type $alias_arr                 -
         * @param unknown_type $id                        - список используемых ID (участвующих в списке)
         */
        function setStaticTree($pid, $tab, &$form, $alias, $alias_arr)
        {
                $sql        = "select * from se_static where is_active = 1 and pid = ".$pid." AND table_father = ''  ORDER BY pid, item_order";  // странички с определённым родителем
                $this->std->db->do_query($sql);

                $alias = str_replace("//", '/', $alias);

                // если статические страницы уже есть в системе
                if ( $this->std->db->getNumRows() )
                {
                        while ($rows = $this->std->db->fetch_row())
                        {  // по все найденым страницам
                              $data[] = $rows;
                        }

                        foreach($data as $id => $row)
                        {
                                $cheched        = '';
                                if (in_array($alias.$row['alias']."/",$alias_arr))
                                {
                                        $cheched = 'checked';
                                }

                                // фиксим интересный баг, даже не понимаю откуда он взялся
                                $alias = preg_replace("#^index#is", "", $alias);

                                $form .= $nbsp."<table><tr><td width=".($tab*10)."></td><td align=left>
                                                                        - <input type='checkbox' name='".$row['id']."_checkbox' $cheched>&nbsp;".$row['menu']."
                                                                          <input type='hidden' name='".$row['id']."_url' value='".$alias.$row['alias']."/'>
                                                                          <input type='hidden' name='".$row['id']."_name' value='".$row['menu']."'>
                                                                </td></tr></table>";
                                $this->global_ids[] = $row['id'];

                                $this->setStaticTree($row['id'], $tab+3, $form, $alias.$row['alias']."/", $alias_arr);
                        }
                }
        }
        // формирование меню, составление дерева ссылок
        // Для составления меню, необходимы прямые ссылки на страницы. Все страницы подчинены правилу построения дерева.
        // данная функция вызывается из "admin_menu.php" из функции "menu_content"
        function static_menu($alias_arr)
        {

                $cheched = '';
                if (in_array("/static/",$alias_arr))
                {
                        $cheched = 'checked';
                }

                $form = $nbsp."<table><tr><td width='0'></td><td align=left>
                                                                                        - <input type='checkbox' name='-1_checkbox' $cheched>&nbsp;Статические страницы
                                                                                          <input type='hidden' name='-1_url' value='/'>
                                                                                          <input type='hidden' name='-1_name' value='Статические страницы'>
                                                                                </td></tr></table>";

                $sql        = "select alias from se_static where is_active = 1 and pid = -1 ORDER BY pid, item_order, id";  // пункты вурхнего уровня, у них нет родителей
                $this->std->db->do_query($sql);
                $this->global_ids[]    = -1;  // строка будет содержать строку с перечнем айдишников
                // если статические страницы уже есть в системе

                if ($row = $this->std->db->fetch_row())
                {
                       $this->setStaticTree(-1, 3, $form, "/", $alias_arr, $id);
                }

                $form = "<input type='hidden' name='module_list_id' value='".implode(' ', $this->global_ids)."'>
                                         <input type='hidden' name='module_tablename' value='static'>
                                         <table border=1><tr><td align=left bgcolor='#FFFFFF'>".$form."</td></tr></table>
                                                        <input type='submit' value='Обновить меню'>";
                return $form;
        }

/*****************************************************************************
        функция составления полной строки адреса по пришедшему идентификатору,
        проходит вверх по дереву до корня и получает правильный полный адрес
******************************************************************************/
        function getPagePathById($id, &$alias)
        {
                $this->std->_getPagePathById($id, &$alias, 'static');
        }


/*******************************************************************************************
        рекурсивное обновление таблицы меню в соответствии со структурой таблицы STATIC_TABLE
        вызывается из функции static_MoveToMenu
*******************************************************************************************/
        function setRecursStatic($id  /* идентификатор вершины в таблице */, $pid  /* идентификатор отца в таблице меню*/)
        {
                $this->std->_MoveToMenuRecurc($id, $pid, 'static');
        }


/*****************************************************************************************
        функция для переноса структуры модуля в структуру меню, начиная с указанной вершины
*******************************************************************************************/
        function static_MoveToMenu($id  /* идентификатор вершины в таблице */, $pid  /* идентификатор отца в таблице меню*/)
        {
                $this->std->_MoveToMenu($id, $pid, 'static');
        }

        /**********************************************************************************
                функция для пересоздания подчинённых динамических вершин в меню
        ***********************************************************************************/
        function static_addTreeToMenu()
        {
                $this->std->_addTreeToMenu('static');

                // тут вызов
                // $this->staticRebildAllModules();

        }


        /*function staticRebildAllModules()
        {

                        $sql = "SELECT id FROM se_mitems WHERE alias = 'static'";
                        if ($this->std->db->query($sql, $rows) > 0)
                        {
                                        $pid = $rows[0]["id"];

                                        // сначала беру записи где father_table = ""
                                        $sql = "SELECT * FROM se_static WHERE table_father <> '' ORDER BY item_order";                                       
                                        if ($this->std->db->query($sql, $rows) > 0)
                                        {
                                                foreach ($rows as $row)
                                                {
                                                                $father = $row["table_father"];
                                                                $timestamp = $row["timestamp"];


                                                                // вставка пункта в таблицу меню
                                                                $this->std->db->do_update("mitems", array(                                                                                                          									"table_name" => $father,
                                                                											"timestamp" => $timestamp,
                                                                											"item_simple" => 0),
                                                                						"pid = {$pid} AND alias='/".$father."/'");

                                                                        // ну а теперь перенос структуры модуля в меню
                                                                if( file_exists($this->std->config['path_modules']."/{$father}/{$father}_admin.php") )
                                                            	{
		                                                                $counstructor = 'mod_'.$father;
		                                                                $method       = $father.'_renum';

		                                                                if( file_exists($this->std->config['path_modules']."/{$father}/{$father}_config.php") )
		                                                                {
		                                                                        require_once $this->std->config['path_modules']."/{$father}/{$father}_config.php";
		                                                                }

		                                                                require_once $this->std->config['path_modules']."/{$father}/{$father}_admin.php";

		                                                                $module_run = new  $counstructor();
		                                                                $module_run->std = &$this->std;
		                                                                // перенумеровка пунктов
		                                                                if( method_exists($module_run, $method) )
		                                                                {
		                                                                        $module_run->$method(-1);
		                                                                }

		                                                                $rebuild_menu = "{$father}_addTreeToMenu";

		                                                                if( method_exists($module_run, $rebuild_menu ) )
		                                                                {
		                                                                        // обновление меню
		                                                                        $module_run->$rebuild_menu();
		                                                                }

		                                                                $this->std->db->do_update("mitems", array("timestamp" => $timestamp), "pid = {$pid} AND alias='/".$father."/'");
                                                            	}
                                                }





                                        }
                        }

        }*/



}


?>