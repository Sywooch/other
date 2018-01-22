<?php
/**
 * sh404SEF - SEO extension for Joomla!
 *
 * @author      Yannick Gaultier
 * @copyright   (c) Yannick Gaultier 2012
 * @package     sh404sef
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     3.6.3.1478
 * @date		2012-10-24
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_JEXEC')) die('Direct Access to this location is not allowed.');

?>
  	<tr>
       <td>
         <?php 
           if (!empty( $this->analytics->filters)) {
             foreach( $this->analytics->filters as $filter) {
               echo $filter;
             }
           }
         ?>
       </td>
    </tr>
    
