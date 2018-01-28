<?php
/**
 * error404 table class
 * 
 * @package    error404
 * @subpackage Components
 * @link http://www.cdprof.com
 * @license        GNU/GPL
 */
 
// No direct access
defined('_JEXEC') or die('Restricted access');
 
/**
 * Error404 Table class
 *
 * @package error404    
 * @subpackage Components
 */
class TableError404 extends JTable
{
    /**
     * Primary Key
     *
     * @var int
     */
    var $id_error404 = null;
 
    /**
     * @var string
     */
    var $chaine = null;
    var $type = null;
 
    /**
     * Constructor
     *
     * @param object Database connector object
     */
    function TableError404( &$db ) {
        parent::__construct('#__error404', 'id_error404', $db);
    }
}
