<?php

/*

//-----------------------------------
// Get XML
//-----------------------------------

require_once( './class_xml.php' );

$xml = new class_xml();

$xmlfile = './awards_macro.xml';

$setting_content = @implode( "", @file($xmlfile) );

$xml->xml_parse_document( $setting_content );


if ( ! is_array( $xml->xml_array['macroexport']['macro'] ) )
{
		die( "Error with {$xmlfile} - could not process XML properly" );
}

//print_r($xml->xml_array['macroexport']['macro']);die();



//-----------------------------------------
// Start...
//-----------------------------------------
$xml->doc_type = "UTF-8";
//$xml->xml_set_root( 'denloh', array( 'exported' => time(), 'versionid' => '2.1.0', 'type' => 'master' ) );

//-----------------------------------------
// Get group
//-----------------------------------------

$xml->xml_add_group( 'permsgroup' );

//-------------------------------
// ...Check for matches
//-------------------------------

//foreach( $master as $_name => $data )
//{

					$content = array();

					$content[] = $xml->xml_build_simple_tag( 'acpperm_bit'    , "данные 1" );
					$content[] = $xml->xml_build_simple_tag( 'acpperm_main'   , "данные 2" );
					$content[] = $xml->xml_build_simple_tag( 'acpperm_child'  , "данные 3" );

					$entry[] = $xml->xml_build_entry( 'perm', $content );


					$content[] = $xml->xml_build_simple_tag( 'acpperm_bit'    , "данные 4" );
					$content[] = $xml->xml_build_simple_tag( 'acpperm_main'   , "данные 5" );
					$content[] = $xml->xml_build_simple_tag( 'acpperm_child'  , "данные 6" );

					$entry[] = $xml->xml_build_entry( 'perm', $content );
//}

$xml->xml_add_entry_to_group( 'permsgroup', $entry );

$xml->xml_format_document();

//-----------------------------------------
// Send to browser.
//-----------------------------------------

print($xml->xml_document);

*/



class class_xml
{


	var $root_tag          = '';


	var $root_attributes   = "";


	var $entries           = array();


	var $xml_document      = "";


	var $depth             = 0;


	var $tmp_doc           = "";


	var $groups            = "";


	var $index_numeric     = 0;


	var $collapse_dups     = 1;


	var $xml_array         = array();


	var $collapse_newlines = 1;


	var $lite_parser       = 0;


	var $doc_type = 'iso-8859-1';

	var $use_doctype = 1;


	/*-------------------------------------------------------------------------*/
	// Parse an XML document into arrays
	/*-------------------------------------------------------------------------*/

	function xml_parse_document( $xml )
	{
		$i = -1;

		if ( $this->use_doctype && in_array( strtolower($this->doc_type), array( 'us-ascii', 'utf-8', 'iso-8859-1' ) ) )
		{
			$parser = xml_parser_create( $this->doc_type );
		}
		else
		{
			$parser = xml_parser_create();
		}

		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE  , 0);
		xml_parse_into_struct($parser, $xml, $values);
		xml_parser_free($parser);

		$this->xml_array = $this->_xml_unconvert_data($values, $i);
	}

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Build a nested array of children
	/*-------------------------------------------------------------------------*/

	function _xml_unconvert_data($values, &$i)
	{
		$children = array();

		//-----------------------------------
		// CDATA before children
		//-----------------------------------

		if ( $i > -1 && isset( $values[$i]['value'] ) )
		{
			$children['VALUE'] = $this->_xml_unconvert_safecdata( $values[$i]['value'] );
		}

		//-----------------------------------
		// Loopy loo
		//-----------------------------------

		while( ++$i < count( $values ) )
		{
			$type = $values[$i]['type'];

			//-----------------------------------
			// CDATA after children
			//-----------------------------------

			if ($type === 'cdata')
			{
				$children['VALUE'] .= $this->_xml_unconvert_safecdata( $values[$i]['value'] );
			}

			//-----------------------------------
			// COMPLETE: At end of current branch
			// OPEN:    Node has children, recurse
			//-----------------------------------

			else if ( $type === 'complete' OR $type === 'open' )
			{
				$tag = $this->_xml_build_tag( $values[$i], $values, $i, $type );

				if ( $this->index_numeric )
				{
					$tag['TAG'] = $values[$i]['tag'];
					$children[] = $tag;
				}
				else
				{
					$children[$values[$i]['tag']][] = $tag;
				}
			}

			//-----------------------------------
			// End of node?
			//-----------------------------------

			else if ($type === 'close')
			{
				break;
			}
		}

		if ( $this->collapse_dups )
		{
			foreach( $children as $key => $value )
			{
				if ( is_array($value) && (count($value) == 1) )
				{
					$children[$key] = $value[0];
				}
			}
		}

		return $children;
	}

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Build tree node
	/*-------------------------------------------------------------------------*/

	function _xml_build_tag( $thisvals, $values, &$i, $type )
	{
		$tag = array();

		if ( isset($thisvals['attributes']) )
		{
			$tag['ATTRIBUTES'] = $this->_xml_decode_attribute($thisvals['attributes']);
		}

		if ( $type === 'complete' )
		{
			if( isset( $thisvals['value'] ) )
			{
				$tag['VALUE'] = $this->_xml_unconvert_safecdata( $thisvals['value'] );
			}
			else
			{
				$tag['VALUE'] = '';
			}
		}
		else
		{
			$tag = array_merge( $tag, $this->_xml_unconvert_data($values, $i) );
		}

		return $tag;
	}


	function _xml_unconvert_safecdata( $v )
	{
		# Legacy
		$v = str_replace( "<!ў|CDATA|", "<![CDATA[", $v );
		$v = str_replace( "|ў]>"      , "]]>"      , $v );

		# New
		$v = str_replace( "<!#^#|CDATA|", "<![CDATA[", $v );
		$v = str_replace( "|#^#]>"      , "]]>"      , $v );

		return $v;
	}




	/*-------------------------------------------------------------------------*/
	// Format the XML document
	/*-------------------------------------------------------------------------*/

	function xml_format_document( $entry=array() )
	{
		$this->header = '<?xml version="1.0" encoding="'.$this->doc_type.'"?'.'>';
        $this->xml_document .= $this->header;

        if( $this->root_tag )
		$this->xml_document .= "<".$this->root_tag.$this->root_attributes.">\n";

		$this->xml_document .= $this->tmp_doc;

        if($this->root_tag)
		$this->xml_document .= "\n</".$this->root_tag.">";

		$this->tmp_doc       = "";
	}

	/*-------------------------------------------------------------------------*/
	// Set the root tags
	/*-------------------------------------------------------------------------*/

	function xml_set_root($tag, $attributes=array() )
	{
		$this->root_tag        = $tag;
		$this->root_attributes = $this->_xml_build_attribute_string( $attributes );
	}

	/*-------------------------------------------------------------------------*/
	// Add entries to the group
	/*-------------------------------------------------------------------------*/

	function xml_add_entry_to_group($tag, $entry=array(), $return_txt = 0 )
	{
		$resault_xml = "";

		if( !$return_txt )
		{
			$this->tmp_doc .= "\t".$this->groups[ $tag ];
		}
		else
		{
			$resault_xml = "\t\t".$this->groups[ $tag ];
		}

		if ( is_array( $entry ) and count( $entry ) )
		{
			foreach( $entry as $e )
			{
				if( !$return_txt )
				{
					$this->tmp_doc .=  "\n\t\t".$e."\n";
				}
				else
				{
					$resault_xml .= "\n\t\t\t".$e."\n";
				}
			}
		}

		if( !$return_txt )
		{
			$this->tmp_doc .= "\t</".$tag.">\n";
		}
		else
		{
			$resault_xml .= "\t\t</".$tag.">\n";
		}

		return $resault_xml;
	}

	/*-------------------------------------------------------------------------*/
	// Builds an entry
	/*-------------------------------------------------------------------------*/

	function xml_build_entry( $tag, $content=array(), $attributes=array() )
	{
		$entry = "<" . $tag . $this->_xml_build_attribute_string($attributes) . ">\n";

		if ( is_array( $content ) and count( $content ) )
		{
			foreach( $content as $c )
			{
				$entry .= "\t\t\t".$c."\n";
			}
		}

		$entry .= "\t\t</" . $tag . ">";

		return $entry;
	}

	/*-------------------------------------------------------------------------*/
	// Add a group
	/*-------------------------------------------------------------------------*/

	function xml_add_group( $tag, $attributes=array() )
	{
		$this->groups[ $tag ] = "<" . $tag . $this->_xml_build_attribute_string($attributes) . ">";
	}

	/*-------------------------------------------------------------------------*/
	// Builds a simple <tag [key="value"]>content</tag> structure
	/*-------------------------------------------------------------------------*/

	function xml_build_simple_tag( $tag, $description="", $attributes=array(), $safe_entry = 0 )
	{
		if( !$safe_entry )
		{
			return "<" . $tag . $this->_xml_build_attribute_string($attributes) . ">" . $this->_xml_encode_string($description) . "</" . $tag . ">";
		}
		else
		{
			return "<" . $tag . $this->_xml_build_attribute_string($attributes) . ">\n" . $description . "\n</" . $tag . ">";
		}
	}

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Builds attribute string
	/*-------------------------------------------------------------------------*/

	function _xml_build_attribute_string( $array = array() )
	{
		if ( is_array( $array ) and count( $array ) )
		{
			$string = array();

			foreach( $array as $k => $v )
			{
				$v = trim( $this->_xml_encode_attribute($v) );

				$string[] = $k.'="'.$v.'"';
			}

			return ' ' . implode( " ", $string );
		}
	}

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Encodes an attribute string
	/*-------------------------------------------------------------------------*/

	function _xml_encode_attribute( $t )
	{
		$t = preg_replace("/&(?!#[0-9]+;)/s", '&amp;', $t );
		$t = str_replace( "<", "&lt;"  , $t );
		$t = str_replace( ">", "&gt;"  , $t );
		$t = str_replace( '"', "&quot;", $t );
		$t = str_replace( "'", '&#039;', $t );

		return $t;
	}

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Encodes an attribute string
	/*-------------------------------------------------------------------------*/

	function _xml_decode_attribute( $t )
	{
		$t = str_replace( "&amp;" , "&", $t );
		$t = str_replace( "&lt;"  , "<", $t );
		$t = str_replace( "&gt;"  , ">", $t );
		$t = str_replace( "&quot;", '"', $t );
		$t = str_replace( "&#039;", "'", $t );

		return $t;
	}

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Encodes a string to make it safe (uses cdata)
	/*-------------------------------------------------------------------------*/

	function _xml_encode_string( $v )
	{
		if ( preg_match( "/['\"\[\]<>&]/", $v ) )
		{
			// ПОКА УБЕРУ конвертирование в <![CDATA
			//$v = "<![CDATA[" . $this->_xml_convert_safecdata($v) . "]]>";
		}

		if ( $this->collapse_newlines )
		{
			$v = str_replace( "\r\n", "\n", $v );
		}

		return $v;
	}

	/*-------------------------------------------------------------------------*/
	// INTERNAL: Ensures no embedding of cdata
	/*-------------------------------------------------------------------------*/

	function _xml_convert_safecdata( $v )
	{
		# Legacy
		//$v = str_replace( "<![CDATA[", "<!ў|CDATA|", $v );
		//$v = str_replace( "]]>"      , "|ў]>"      , $v );

		# New
		$v = str_replace( "<![CDATA[", "<!#^#|CDATA|", $v );
		$v = str_replace( "]]>"      , "|#^#]>"      , $v );

		return $v;
	}



}



?>