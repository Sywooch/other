<?php
/**
 * @package     retina.Platform
 * @subpackage  Database
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

require_once dirname(__FILE__) . '/mysqlexporter.php';

/**
 * MySQL export driver.
 *
 * @package     retina.Platform
 * @subpackage  Database
 * @since       11.1
 */
class JDatabaseExporterMySQLi extends JDatabaseExporterMySQL
{
	/**
	 * Checks if all data and options are in order prior to exporting.
	 *
	 * @return  JDatabaseExporterMySQLi  Method supports chaining.
	 *
	 * @since   11.1
	 * @throws  Exception if an error is encountered.
	 */
	public function check()
	{
		// Check if the db connector has been set.
		if (!($this->db instanceof JDatabaseMySqli))
		{
			throw new Exception('JPLATFORM_ERROR_DATABASE_CONNECTOR_WRONG_TYPE');
		}

		// Check if the tables have been specified.
		if (empty($this->from))
		{
			throw new Exception('JPLATFORM_ERROR_NO_TABLES_SPECIFIED');
		}

		return $this;
	}

	/**
	 * Sets the database connector to use for exporting structure and/or data from MySQL.
	 *
	 * @param   JDatabaseMySQLi  $db  The database connector.
	 *
	 * @return  JDatabaseExporterMySQLi  Method supports chaining.
	 *
	 * @since   11.1
	 */
	public function setDbo(JDatabaseMySQLi $db)
	{
		$this->db = $db;

		return $this;
	}
}
