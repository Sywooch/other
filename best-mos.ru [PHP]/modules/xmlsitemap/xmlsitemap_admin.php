<?php
#
# XMLSiteMap - админка
#

class mod_xmlsitemap{


        var $std;
        var $output = '';

        // первая исполняемая функция
        function process_module()
        {


                switch($this->std->input['action'])
                {
                        case 'xmlsitemap':
                              $this->sitemap_content( );
                              break;
                        case 'xmlsitemap_update':
                              $this->sitemap_update( );
                              break;
                }


        }


        // принтуем все гланые меню которые можно отобразить в карте сайта
        function sitemap_content()
        {

                /***************************************************************************
                        формирование таблички пунктов меню
                ****************************************************************************/
                $this->output        .= "<hr><center><h4>Список меню</h4>";

                $this->output        .= "<table border='1'>";
                $this->output        .= "<tr><td align=center>Название</td><td align=center>Включить в дерево</td></tr>";


				# запрос информации о составе xmlsitemap
				$sql = "select * from `se_xmlsitemap`";
                $this->std->db->do_query($sql);
                $xmlsitemap = $this->std->db->fetch_row();
                $xmlsitemap["menu_names"] = unserialize( $xmlsitemap["menu_names"] );	// парсим имена меню


                $sql = "select * from `se_mitems` where item_dynamic=0 and  pid='-1' and is_active=1 order by item_order";
                $this->std->db->do_query($sql);

                while ($row = $this->std->db->fetch_row())
                {
                         $this->output .= "<tr style='background:#CCFFCC;'>";
                         $alias_arr[]        =  $row['alias'];

                         // Включен ли заголовок в карту сайта
                         $item_simple        = '';

                         if ( in_array( $row['alias'], $xmlsitemap["menu_names"] ) )
                         {
                                 $item_simple        = ' checked ';
                         }

                         $this->output        .= '<td align=center><input name="'.$row['id'].'_item_simple" type="checkbox" '.$item_simple.'  OnClick="document.location.href =\'/admin/?action=xmlsitemap_update&menuname='.$row['alias'].'\'"></td>';

                         /****конец: определение свойства пункта меню: сложный пункт или простой*****/

                         $this->output        .= '<td width=300>'.$row['title'].'</td>';

                         $this->output .= "</tr>";
                }

                $this->output         .= '</tr></table>';

                //------------------------------------------------------------



        }



		/**
		 * Добавление/удаление меню в xmlsitemap
		 */
        function sitemap_update()
        {

                if ( isset($this->std->input['menuname']) )
                {
                		# запрос информации о составе xmlsitemap
						$sql = "select * from `se_xmlsitemap`";
		                $this->std->db->do_query($sql);
		                $xmlsitemap = $this->std->db->fetch_row();
		                $xmlsitemap["menu_names"] = unserialize( $xmlsitemap["menu_names"] );	// парсим имена меню

		                if ( in_array($this->std->input['menuname'], $xmlsitemap["menu_names"] ) )
		                {                         		# меню входит в список xmlsitemap
                         		# нужно выкинуть её из списка

                         		unset( $xmlsitemap["menu_names"][$this->std->input['menuname']] );
		                }
		                else
		                {                                # меню не входит в список xmlsitemap
                         		# нужно внести её в список

                         		$xmlsitemap["menu_names"][$this->std->input['menuname']] = $this->std->input['menuname'];
		                }


						//------------------------------------------------------
						// после любого изменения списка нужно
						// переформировать список ссылок в sitemap.xml
						//------------------------------------------------------

						$this->updateXMLSiteMap( $xmlsitemap["menu_names"] );


                        # сохранение текущего состояния списка меню
                        $xmlsitemap["menu_names"] = serialize( $xmlsitemap["menu_names"] );
                		$xmlsitemap["lastmodified"] = time();  // текущее время
		                $this->std->db->do_update( 'xmlsitemap', $xmlsitemap, "");

		                # переход на список, на главную страницу админки модуля
		                header('Location: /admin/?action=xmlsitemap');
		                exit();
                }

        }


		/**
		 * Обновление списка ссылок в sitemap.xml
		 */
        function updateXMLSiteMap( $menu_names )
        {
         		require_once( "xmlsitemap_init.php" );
				$module = new main_xmlsitemap();
				$module->std = $this->std;
				$module->createXMLSiteMap( $menu_names );
        }
}
?>
