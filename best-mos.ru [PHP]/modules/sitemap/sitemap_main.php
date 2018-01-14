<?php
#
#        Объект - построение дерева сайта
#        Вызов: /sitemap/
#
#  Modified         :
#  Version          : 1.0
#



class main_sitemap extends AbstractClass {


        # global lib
        var $std;

        # global
        var $modules                      = array();
        var $used_template                = '';

        # vars in this module
        var $depth_count                  = 1;
        var $depth_id                     = 0;
        var $last_level                   = 0;

        /*---------------------------------------------------------------------------------------------------*/
        // Функция которая запустится по умолчанию первой(конструктор нам не подходит)
        /*---------------------------------------------------------------------------------------------------*/

        function SITEMAPClass(        $sub_alias /*запрашиваемая страница разложенная в массив*/        )
        {


                $this->AbstractClass(
                                                                $sub_alias,         // путь разложенный в массив
                                                                'se_static',        // название таблицы с которой будем работать
                                                                'sitemap'           // название модуля (то как модуль называется в таблице modules)
                                                        );

                // проверка, нужно ли запускать инициализацию переменных
                // ПРОВЕРЯЕМ вызывется ли имеено данный модуль


                global
                        $template,               // имя используемого
                        $title,                  // заголовок
                        $h1,                     // главная надпись
                        $body,                   // тело новости
                        $sitemap,                // карта сайта
                        $_sitemap_depth_guide,   // глубина вложенности
                        $count_pages         ,   // кол-во выведенных страниц
                        $description,            // описание страницы
                        $keywords;               // ключевые слова

                $this->depth_guide = $_sitemap_depth_guide;

                if (isset($this->current_url_array[0]) && $this->current_url_array[0] == $this->module_name) // если вызывается карта сайта
                {
                        if (count($this->current_url_array) == 1)
                        {

                                //обрабатываем данные полученные из ДБ для формирования данной страницы
                                $this->std->db->do_query( "SELECT * FROM se_static WHERE alias='sitemap' AND `pid`='-1'");

                                if ($this->std->db->getNumRows())// если в структуре статических страниц заведён раздел "карта сайта", то покажем всё что в этом разделе написано
                                {
                                        $rows = $this->std->db->fetch_row();
                                        $title               = $rows['title'];
                                        $h1                  = $rows['h1'];
                                        $body                = $rows['body'];
                                        $this->depth_id      = $this->std->settings['sitemap_depth_count'];
                                        // выводим keywords и если таковые присутвуют
                                        $keywords    = $this->std->build_meta_tags( $rows['keywords'], 'keywords' );
                                        $description = $this->std->build_meta_tags( $rows['description'], 'description');

                                        // проверяем, не задан ли какой-то особенный шаблон
                                        //$template         = 'sitemap';
                                        $template         = 'static';

                                        $body = $this->getSiteMap();
                                        $count_pages    = ($this->depth_count - 1);

                                }
                                else
                                {
                                        $template        = 'error';
                                }
                        }
                        else
                        {
                                $template        = 'error';
                                $this->ModulError("Error {SiteMapClass:init} Обращение по ошибочной ссылке.");
                        }
                }

        }

        /*---------------------------------------------------------------------------------------------------*/
        // Функция строит карту сайта
        /*---------------------------------------------------------------------------------------------------*/

        function getSiteMap( )
        {
                $tree         = '';

                // выбираем те рутовые меню которые надо рендерить
                $render_tree = array();
                $tree        = '';
                                if(count($this->std->menu_array)!=0)
                {
                     foreach( $this->std->menu_array['root'] as $_mid => $data )
                     {
                             if( $data['inc_in_sitemap'] )
                             {
                                     $render_tree[ $_mid ] = $_mid;
                             }
                     }
                }

                // рендерим само меню путем обхода по дереву
                foreach( $render_tree as $_mid => $_ids )
                {
                        $tree .= $this->render_recur( $_ids  );
                }

                return $tree;
        }

        /*---------------------------------------------------------------------------------------------------*/
        // Pекурсивная функция генерации карты сайта
        /*---------------------------------------------------------------------------------------------------*/

        function render_recur( $root_id, $jump_string = '', $depth_guide="", $depth_id = 0)
        {
                global $_sitemap, $_sitemap_bullet, $_sitemap_space;

                $init_begin_sitemap_html = 0;
                // если существует скин то применяем его а если нет то используем дефолтный
                $template_num = $depth_id+1;



                if( isset($_sitemap['tree'][$template_num]) and $template_num > 0 and is_array($_sitemap['tree']))
                {
                        $begin    = $_sitemap['begin'][$template_num];
                        $template = $_sitemap['tree'][$template_num];
                        $end      = $_sitemap['end'][$template_num];
                        $this->last_level = $template_num;
                }
                elseif( $this->last_level )
                {
                        $begin    = $_sitemap['begin'][ $this->last_level ];
                        $template = $_sitemap['tree'][ $this->last_level ];
                        $end      = $_sitemap['end'][ $this->last_level ];
                }
                else
                {
                        $begin    = $_sitemap['begin'];
                        $template = $_sitemap['tree'];
                        $end      = $_sitemap['end'];
                }

                if( @is_array( $this->std->menu_array[ $root_id ] ) )
                {
                        // пробегаемся по блоку подуровня
                        foreach( $this->std->menu_array[ $root_id ] as $menu_data )
                        {
                                // выкидываем из обработки если глыбина достигла критической
                                if( ($depth_id+1) > $this->depth_id and $this->depth_id > 0)
                                {
                                        continue;
                                }

                                // выкидываем из обработки если алиасы являются определенными(специальными)
                                if( strstr( $menu_data['alias'], 'sitemap' ) )
                                {
                                        if( $this->std->menu_by_id[ $menu_data['pid'] ]['pid'] == 'root' )
                                        {
                                                continue;
                                        }
                                }
                                elseif( strstr( $menu_data['alias'], 'end' ) )
                                {
                                        continue;
                                }
                                elseif( strstr( $menu_data['alias'], 'delimiter' ) )
                                {
                                        continue;
                                }
                                elseif( strstr( $menu_data['alias'], 'begin' ) )
                                {
                                        continue;
                                }

                                // подсчитываем количество реальных страниц
                                $this->depth_count++;

                                // для главной страницы переделываем алиас
                                if( $menu_data['alias'] == '/index/' )
                                {
                                        $menu_data['alias'] = '/';
                                }
                                elseif( $menu_data['alias'] == 'index' )
                                {
                                        $menu_data['alias'] = '/';
                                }

                                // печатаем начало тольуо один раз для блока
                                if( !$init_begin_sitemap_html )
                                {
                                        $jump_string .= $begin;
                                        $init_begin_sitemap_html = 1;
                                }

                                // печатаем ссылку
                                $jump_string  .= str_replace( array( '{PREFIX}', '{ALIAS}', "{TITLE}" ), array($depth_guide.$_sitemap_bullet, $menu_data['alias'], $menu_data['title']), $template);

                                $jump_string = $this->render_recur( $menu_data['id'], $jump_string, $depth_guide . $this->depth_guide, ($depth_id+1) );
                        }

                        // добавляем конец
                        $jump_string .= $end;
                }

                // возвращаем результат для определенного блока подуровня
                return $jump_string;
        }
}
?>