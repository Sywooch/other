<?php
/**
 * @package     retina.Platform
 * @subpackage  Database
 *
 * @copyright   
 * @license     
 */

defined('RPATH_PLATFORM') or die;

/**
 * Query Building Class.
 *
 * @package     retina.Platform
 * @subpackage  Database
 * @since       11.1
 */
class JDatabaseQueryMySQL extends JDatabaseQuery
{
	/**
	 * Concatenates an array of column names or values.
	 *
	 * @param   array   $values     An array of values to concatenate.
	 * @param   string  $separator  As separator to place between each value.
	 *
	 * @return  string  The concatenated values.
	 *
	 * @since   11.1
	 */
	public function concatenate($values, $separator = null)
	{
		if ($separator)
		{
			$concat_string = 'CONCAT_WS(' . $this->quote($separator);

			foreach ($values as $value)
			{
				$concat_string .= ', ' . $value;
			}

			return $concat_string . ')';
		}
		else
		{
			return 'CONCAT(' . implode(',', $values) . ')';
		}
	}
}
