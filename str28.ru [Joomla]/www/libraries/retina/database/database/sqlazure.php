<?php
/**
 * @package     retina.Platform
 * @subpackage  Database
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

JLoader::register('JDatabaseSQLSrv', dirname(__FILE__) . '/sqlsrv.php');

JLoader::register('JDatabaseQuerySQLAzure', dirname(__FILE__) . '/sqlazurequery.php');

/**
 * SQL Server database driver
 *
 * @package     retina.Platform
 * @subpackage  Database
 * @see         http://msdn.microsoft.com/en-us/library/ee336279.aspx
 * @since       11.1
 */
class JDatabaseSQLAzure extends JDatabaseSQLSrv
{
	/**
	 * The name of the database driver.
	 *
	 * @var    string
	 * @since  11.1
	 */
	public $name = 'sqlzure';

	/**
	 * Get the current query or new JDatabaseQuery object.
	 *
	 * @param   boolean  $new  False to return the last query set, True to return a new JDatabaseQuery object.
	 *
	 * @return  mixed  The current value of the internal SQL variable or a new JDatabaseQuery object.
	 *
	 * @since   11.1
	 * @throws  DatabaseException
	 */
	public function getQuery($new = false)
	{
		if ($new)
		{
			// Make sure we have a query class for this driver.
			if (!class_exists('JDatabaseQuerySQLAzure'))
			{
				throw new DatabaseException(RText::_('RLIB_DATABASE_ERROR_MISSING_QUERY'));
			}

			return new JDatabaseQuerySQLAzure($this);
		}
		else
		{
			return $this->sql;
		}
	}

}
