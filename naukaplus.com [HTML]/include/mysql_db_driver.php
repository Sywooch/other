<?php

#
# Драйвер для работы с базой данных MySQL 4
#

class db_driver
{

    #global vars in this class
    var $dbobj = array ( "sql_database"     => ""         ,
                         "sql_user"         => "root"     ,
                         "sql_pass"         => ""         ,
                         "sql_host"         => "localhost",
                         "sql_tbl_prefix"   => "se_"      ,
                         "cached_queries"   => array(),
                         );

	 var $std               = null;
     var $error             = "";
     var $sql               = "";
     var $cur_query         = "";
     var $do_query_id       = "";
     var $connection_id     = "";
     var $do_query_count    = 0;
     var $return_die        = 0;
     var $failed            = 0;
     var $record_row        = array();
     var $connect_vars      = array();

    /*------------------------------------------------------------------------*/
    // CONSTRUCTOR...
    // /**
    //  * @param no paremetres input ;)
    //  */
    /*------------------------------------------------------------------------*/

     function db_driver()
     {
             //--------------------------
             // Set up any required connect
             // vars here:
             // Will be populated by obj
             // caller
             //--------------------------

             $this->connect_vars = array();
     }

    /*------------------------------------------------------------------------*/
    // Connect to the database
    // /**
    //  * @param no parametres input
    //  */
    /*------------------------------------------------------------------------*/

    function connect()
    {
                //--------------------------
                // Done SQL prefix yet?
                //--------------------------

                if ( ! defined( 'TABLENAME_PREFIX' ) )
                {
                        $this->dbobj['sql_tbl_prefix'] = $this->dbobj['sql_tbl_prefix'] ? $this->dbobj['sql_tbl_prefix'] : 'se_';

                        define( 'TABLENAME_PREFIX', $this->dbobj['sql_tbl_prefix'] );
                }

                //--------------------------
                // Connect
                //--------------------------

                $this->connection_id = @mysql_connect( $this->dbobj['sql_host'] ,
                                                       $this->dbobj['sql_user'] ,
                                                       $this->dbobj['sql_pass']
                                                      );


                if ( ! $this->connection_id )
                {
                        $this->fatal_error();
                        return FALSE;
                }

                //--------------------------
                // selcet data base
                //--------------------------

                $this->select_db( $this->dbobj['sql_database'] );
	$this->do_query("SET NAMES 'cp1251'");

                return TRUE;
    }

    /*------------------------------------------------------------------------*/
    // If we are have two or more connection on one session chenge select DB
    // /**
    //  * @param name data base
    //  */
    /*------------------------------------------------------------------------*/

    function select_db($database = "")
    {
            if($database != "")
            {
                        $this->dbobj['sql_database'] = $database;
            }

            if(!mysql_select_db($this->dbobj['sql_database'], $this->connection_id))
            {
                        $this->fatal_error();
                        return FALSE;
            }
    }

    /*------------------------------------------------------------------------*/
    // Quick function
    /*------------------------------------------------------------------------*/

    /**
     * Update table function
     *
     * @param table name
     * @param DB query string
     * @param WHERE SQL queryes
     */

    function do_update( $tbl, $arr, $where="" )
    {
            $dba = $this->compile_db_update_string( $arr );

            $query = "UPDATE ".TABLENAME_PREFIX."$tbl SET $dba";

            if ( $where )
            {
                    $query .= " WHERE ".$where;
            }

            $ci = $this->do_query( $query );

            return $ci;

    }

    /**
    * Insert string to table
    *
    * @param table name
    * @param DB query string
    */

    function do_insert( $tbl, $arr )
    {
            $dba = $this->compile_db_insert_string( $arr );

            $ci = $this->do_query("INSERT INTO ".TABLENAME_PREFIX."$tbl ({$dba['FIELD_NAMES']}) VALUES({$dba['FIELD_VALUES']})");

            return $ci;
    }

    /**
     * ищет и заменяет префикс после ключевого слова
     * вспомогательная функция для replace_pfx
     *
     * @param unknown_type $search - ключевое слово
     * @param unknown_type $str - запрос
     * @return unknown запрос с новым префиксом
     */
	function findpfxafter($search, $str)
	{
//			$pfx = substr($this->dbobj['sql_tbl_prefix'], 0, strlen($this->dbobj['sql_tbl_prefix'])-1);
			$pfx = $this->dbobj['sql_tbl_prefix'];
		
			$strlen = strlen($str);
			$pos = strpos($str, $search) + strlen($search);
			// ищем префикс
			
			$pos = strpos($str, "se_", $pos);
			
/*			
			while ($pos < $strlen)
			{
					if (!($str[$pos] == ' ' || $str[$pos] == '`')) break;
					$pos++;
			}
*/			
			if ($pos === false) return $str;

/*			
			// ищем _
			$pos2 = $pos;
			while ($pos2 < $strlen)
			{
					if ($str[$pos2] == '_') break;
					$pos2++;
			}
			if ($pos2 == $strlen) return $str;
*/			
			$pos2 = $pos + strlen("se_");
						
			$str1 = substr($str, 0, $pos);
			$str2 = substr($str, $pos2);
			
			return $str1.$pfx.$str2;
	}
	
	/**
	 * заменяет префикс в запросе
	 *
	 * @param unknown_type $str - запрос
	 * @return unknown
	 */
	function replace_pfx($str)
	{
			// отсекаем пробелы
			$str = trim($str);
		
			$words = explode(" ", $str);
			
			// удаляем повторяющиеся пробелы
			foreach ($words as $id => $cell) if ($cell == '') unset($words[$id]);		
			
			if (count($words) == 0) return 0;
	
			
			$result = -1;
			$strlen = strlen($str);
			switch ($words[0])
			{
				case 'select' : case 'delete' : $result = $this->findpfxafter(" from ", $str);
								break;
				case 'insert' : $result = $this->findpfxafter(" into ", $str);
								break;
				case 'update' : $result = $this->findpfxafter("update ", $str);
								break;
				default : $result = preg_replace("/se_(\S+?)([\s\.,]|$)/", "".$this->dbobj['sql_tbl_prefix']."\\1\\2", $str);
			}
			
			return $result;
	}
    
    /*------------------------------------------------------------------------*/
    // Process a manual query
    // /**
    //  * main function on this class
    //  *
    //  * @param get colums name
    //  * @param bypass if table have another prefix
    //  */
    /*------------------------------------------------------------------------*/

    function do_query($the_query, $bypass=0)
    {
            //--------------------------------------
            // Change the table prefix if needed
            //--------------------------------------

            if ($bypass != 1)
            {
                        if ( $this->dbobj['sql_tbl_prefix'] != "se_" and ! $this->prefix_changed )
                        {
//                        	$the_query = $this->replace_pfx($the_query);
                           $the_query = preg_replace("/se_(\S+?)([\s\.,]|$)/", "".$this->dbobj['sql_tbl_prefix']."\\1\\2", $the_query);
//                           $the_query = preg_replace("/(`)se_(\S+?)([\s\.,]|$)/", "`".$this->dbobj['sql_tbl_prefix']."\\1\\2", $the_query);
                        }
            }

            $this->do_query_id = mysql_query($the_query, $this->connection_id);

            //--------------------------------------
            // Reset array...
            //--------------------------------------

            if (! $this->do_query_id )
            {
                    $this->fatal_error("mySQL ошибка запроса: $the_query");
            }

            $this->do_query_count++;

            $this->dbobj['cached_queries'][] = $the_query;

            return $this->do_query_id;
    }

    /*------------------------------------------------------------------------*/
    // Process a manual query(mod)
    // /**
    //  * main function on this class
    //  *
    //  * @param sql query
    //  * @param array return rows
    //  */
    /*------------------------------------------------------------------------*/

    function query($sql, &$rows)
    {
        $row_count        = 0;
        $rows             = array();
        $this->do_query( $sql );
        $row_count        = $this->getNumRows( );

        if ($row_count > 0)
        {
                while ($row = $this->fetch_row( ))
                {
                        $rows[] = $row;
                }
        }

        $this->free_result( );  // освобождаем рессурсы

        if ($row_count > 0)
        {
        	return true;
        }
        else
        {
        	return false;
        }
    }


    /*------------------------------------------------------------------------*/
    // Fetch a row based on the last query
    // /**
    //  * @param input needs ID query
    //  */
    /*------------------------------------------------------------------------*/

    function fetch_row($query_id = "")
    {
            if ($query_id == "")
            {
                    $query_id = $this->do_query_id;
            }

            $this->record_row = mysql_fetch_array($query_id, MYSQL_ASSOC);

            return $this->record_row;

    }


    /*------------------------------------------------------------------------*/
    // Test to see if a field exists by forcing and trapping an error.
    // /**
    //  * @param table name
    //  * @param need fields name
    //  */
    /*------------------------------------------------------------------------*/

    function field_exists($field, $table)
    {

                $this->return_die = 1;
                $this->error = "";

                $this->do_query("SELECT COUNT($field) as count FROM ".TABLENAME_PREFIX."$table");

                $return = 1;

                if ( $this->failed )
                {
                        $return = 0;
                }

                $this->error = "";
                $this->return_die = 0;
                $this->error_no   = 0;
                $this->failed     = 0;

                return $return;
    }

    /*------------------------------------------------------------------------*/
    // Test to see if a table exists by forcing and trapping an error.
    // /**
    //  * @param table name
    //  */
    /*------------------------------------------------------------------------*/

    function table_exists($table)
    {

                $this->return_die = 1;
                $this->error = "";

                $this->do_query("SELECT COUNT(*) FROM $table");

                $return = 1;

                if ( $this->failed )
                {
                        $return = 0;
                }

                $this->error = "";
                $this->return_die = 0;
                $this->error_no   = 0;
                $this->failed     = 0;

                return $return;
    }

    /*------------------------------------------------------------------------*/
    // DROP FIELD
    // /**
    //  * @param table name
    //  * @param field name
    //  */
    /*------------------------------------------------------------------------*/

    function dropField( $table, $field )
    {
            $this->do_query( "ALTER TABLE ".TABLENAME_PREFIX."{$table} DROP $field" );
    }

    /*------------------------------------------------------------------------*/
    // DROP FIELD
    // /**
    //  * @param table name
    //  * @param field name
    //  */
    /*------------------------------------------------------------------------*/

    function dropTable( $table )
    {
            $this->do_query( "DROP TABLE {$table}" );
    }

    /*------------------------------------------------------------------------*/
    // ADD MANUAL
    // /**
    //  * @param table name
    //  * @param field add(add string)
    //  */
    /*------------------------------------------------------------------------*/

    function alterTable( $table, $field )
    {
            $this->do_query( "ALTER TABLE ".TABLENAME_PREFIX."{$table} ADD {$field}" );
    }

    /*------------------------------------------------------------------------*/
    // PRE DB PARSE STRING
    // /**
    //  * @param string input
    //  */
    /*------------------------------------------------------------------------*/

    function escape_string( $t )
    {
            return mysql_escape_string( $t );
    }

    /*------------------------------------------------------------------------*/
    // OPTIMIZE FIELD
    // /**
    //  * @param table name
    //  */
    /*------------------------------------------------------------------------*/

    function optimizeTable( $table )
    {
            $this->do_query( "OPTIMIZE TABLE ".TABLENAME_PREFIX."{$table}" );
    }


    /*------------------------------------------------------------------------*/
    // Return the version number of the SQL server
    // /**
    //  * @param no parametryes input
    //  */
    /*------------------------------------------------------------------------*/

    function getVersion()
    {
            if ( ! $this->mysql_version and ! $this->true_version )
            {
                    $this->do_query("SELECT VERSION() AS version");

                    if ( ! $row = $this->fetch_row() )
                    {
                                $this->do_query("SHOW VARIABLES LIKE 'version'");
                                $row = $this->fetch_row();
                    }

                    $this->true_version = $row['version'];
                    $tmp                = explode( '.', preg_replace( "#[^\d\.]#", "\\1", $row['version'] ) );

                    $this->mysql_version = sprintf('%d%02d%02d', $tmp[0], $tmp[1], $tmp[2] );
            }
    }

    /*------------------------------------------------------------------------*/
    // Fetch the number of rows in a result set
    // /**
    //  * @param no parametryes input
    //  */
    /*------------------------------------------------------------------------*/

    function getNumRows()
    {
            return @mysql_num_rows($this->do_query_id);
    }

    /*------------------------------------------------------------------------*/
    // Fetch the last insert id from an sql autoincrement
    // /**
    //  * @param no parametryes input
    //  */
    /*------------------------------------------------------------------------*/

    function get_insert_id()
    {
            return mysql_insert_id($this->connection_id);
    }

    /*------------------------------------------------------------------------*/
    // Return the amount of queries used
    // /**
    //  * @param no parametryes input
    //  */
    /*------------------------------------------------------------------------*/

    function get_query_count()
    {
            return $this->do_query_count;
    }

    /*------------------------------------------------------------------------*/
    // Free the result set from mySQLs memory
    // /**
    //  * @param no parametryes input
    //  */
    /*------------------------------------------------------------------------*/

    function free_result($query_id="")
    {
            if ($query_id == "")
            {
                    $query_id = $this->do_query_id;
            }

            @mysql_free_result($query_id);
    }

    /*------------------------------------------------------------------------*/
    // Shut down the database
    // /**
    //  * close data base connection
    //  *
    //  * @param no parametryes input
    //  */
    /*------------------------------------------------------------------------*/

    function close_db()
    {
            if ( $this->connection_id )
            {
                    return @mysql_close( $this->connection_id );
            }
    }



    /*------------------------------------------------------------------------*/
    // Basic error handler
    // /**
    //  * if query error? show this query and code error(www.mysql.com search error for code)
    //  *
    //  * @param error text
    //  */
    /*------------------------------------------------------------------------*/

    function fatal_error($the_error="")
    {
            // Are we simply returning the error?

            if ($this->return_die == 1)
            {
                    $this->error    = @mysql_error($this->connection_id);
                    $this->error_no = @mysql_errno($this->connection_id);
                    $this->failed   = 1;
                    return;
            }

           // $the_error .= "<br />Ошибка mySQL: ".@mysql_error($this->connection_id)."<br />";
           // $the_error .= "Код ошибки mySQL: ".@mysql_errno($this->connection_id)."<br />";
            //$the_error .= "Дата: ".date("l dS of F Y h:i:s A");
			
			$log_res = "";
			$log_res .= "".date("d-m-Y h:i:s")." | ";
			$log_res .= "[".$_SERVER['REQUEST_URI']."] | ";
			$log_res .= "Код ошибки:".@mysql_errno($this->connection_id)." | ";
			$log_res .= $the_error.";\n";
			$filename = $this->std->config['errorlog'];
			$r=fopen($filename,'r');
			$text=@fread($r,filesize($filename));
			fclose($r);
			$text .= $log_res;
			$w=fopen($filename,'w'); 
			fwrite($w,$text);  
			fclose($w);  


            $out = "<html>
                       <head><title>Ошибка базы данных</title>
                       <style>P,BODY{ font-family:arial,sans-serif; font-size:11px;}</style>
                       </head>
                       <body>
                       <br /><b>Произошла ошибка базы данных.</b><br />
                       Вы можете попробовать обновить эту страницу, кликнув на <a href=\"javascript:window.location=window.location;\">эту ссылку</a>.
                       ";
					   //<br><br><b>Возвращаемая ошибка:</b><br />
                       //".$the_error."
                       $out .="<br />Приносим свои извинения за доставленные неудобства!
                       </body>
                       </html>";

        print($out);
        die();
    }

    /*------------------------------------------------------------------------*/
    // /**
    //  * Create an array from a multidimensional array returning formatted
    //  * strings ready to use in an INSERT query, saves having to manually format
    //  * the (INSERT INTO table) ('field', 'field', 'field') VALUES ('val', 'val')
    //  *
    //  * @param array input
    //  */
    /*------------------------------------------------------------------------*/

    function compile_db_insert_string($data)
    {
            $field_names  = "";
            $field_values = "";

            foreach ($data as $k => $v)
            {

                    $v = preg_replace( "/'/", "\\'", $v );

                    $field_names  .= "$k,";

                    if ( is_numeric( $v ) and (intval($v) == $v and strlen($v) == strlen(intval($v)) ) )
                    {
                            $field_values .= $v.",";
                    }
                    else
                    {
                            $field_values .= "'$v',";
                    }
            }

            $field_names  = preg_replace( "/,$/" , "" , $field_names  );
            $field_values = preg_replace( "/,$/" , "" , $field_values );

            return array( 'FIELD_NAMES'  => $field_names,
                          'FIELD_VALUES' => $field_values,
                          );

    }

    /*------------------------------------------------------------------------*/
    // /**
    //  * Create an array from a multidimensional array returning a formatted
    //  * string ready to use in an UPDATE query, saves having to manually format
    //  * the FIELD='val', FIELD='val', FIELD='val'
    //  *
    //  * @param array input
    //  */
    /*------------------------------------------------------------------------*/

    function compile_db_update_string($data)
    {
            $return_string = "";

            foreach ($data as $k => $v)
            {
                    $v = preg_replace( "/'/", "\\'", $v );

                    if ( is_numeric( $v ) and (intval($v) == $v and strlen($v) == strlen(intval($v)) ) )
                    {
                            $return_string .= $k . "=".$v.",";
                    }
                    else
                    {
                            $return_string .= $k . "='".$v."',";
                    }
            }

            $return_string = preg_replace( "/,$/" , "" , $return_string );

            return $return_string;
    }


    /*------------------------------------------------------------------------*/
    // /**
    //  * Return an array of fields
    //  *
    //  * @param QueryID resource
    //  *
    //  * @return fields array
    //  */
    /*------------------------------------------------------------------------*/

    function get_result_fields($query_id="")
    {
            if ($query_id == "")
            {
                    $query_id = $this->do_query_id;
            }

            while ($field = mysql_fetch_field($query_id))
            {
                    $Fields[] = $field;
            }

            return $Fields;
    }

} // end class


?>