<?php
/**
 * SEF component for Joomla! 1.5
 *
 * @author      ARTIO s.r.o.
 * @copyright   ARTIO s.r.o., http://www.artio.cz
 * @package     JoomSEF
 * @version     3.1.0
 * @license     GNU/GPLv3 http://www.artio.net/license/gnu-general-public-license
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class SEFModelImport extends JModel
{
    var $type = 'None';
    var $total = 0;
    var $imported = 0;
    var $notImported = 0;

    var $aceSefTablePresent = false;
    var $shSefTablePresent = false;
    var $dbChecked = false;

    /**
     * Constructor that retrieves variables from the request
     */
    function __construct()
    {
        parent::__construct();
    }

    function import()
    {
        // Get the uploaded file information
        $userfile = JRequest::getVar('importfile', null, 'files', 'array' );

        // Make sure that file uploads are enabled in php
        if (!(bool) ini_get('file_uploads')) {
            JError::raiseWarning(100, JText::_('Uploads not allowed.'));
            return false;
        }

        // If there is no uploaded file, we have a problem...
        if (!is_array($userfile)) {
            JError::raiseWarning(100, JText::_('No file selected'));
            return false;
        }

        // Check if there was a problem uploading the file.
        if ($userfile['error'] || $userfile['size'] < 1) {
            JError::raiseWarning(100, JText::_('Error while uploading the file.'));
            return false;
        }

        // Build the appropriate paths
        $config     =& JFactory::getConfig();
        $tmp_dest 	= $config->getValue('config.tmp_path').DS.$userfile['name'];
        $tmp_src	= $userfile['tmp_name'];

        // Move uploaded file
        jimport('joomla.filesystem.file');
        $uploaded = JFile::upload($tmp_src, $tmp_dest);
        if( !$uploaded ) {
            JError::raiseWarning( 100, JText::_('Could not upload the file.') );
            return false;
        }

        // load SQL
        $lines = file($tmp_dest);

        // We can delete the file now
        JFile::delete($tmp_dest);

        if( !is_array($lines) )
        {
            JError::raiseWarning( 100, JText::_('Could not load the file.') );
            return false;
        }

        // Determine the export type (JoomSEF, sh404SEF, AceSEF)
        $type = $this->_determineType($lines);

        $result = true;
        $this->total = $this->imported = $this->notImported = 0;
        
        switch($type)
        {
            case 'JoomSEF':
                $this->type = JText::_('JoomSEF URLs');
                $result = $this->_importJoomSEF($lines);
                break;

            case 'sh404SEF':
                $this->type = JText::_('sh404SEF URLs');
                $result = $this->_importSh404SEF($lines);
                break;

            case 'sh404SEFmeta':
                $this->type = JText::_('sh404SEF Meta tags');
                $result = $this->_importSh404SEFmeta($lines);
                break;
                
            case 'sh404SEF_2_2_7_981':
                $this->type = JText::_('sh404SEF URLs (2.2.7.981)');
                $result = $this->_importSh404SEF_2_2_7_981($lines);
                break;

            case 'AceSEF':
                $this->type = JText::_('AceSEF URLs');
                $result = $this->_importAceSEF($lines);
                break;

            default:
                $this->type = JText::_('Unknown');
                JError::raiseWarning( 100, JText::_('Unrecognized file format.') );
                $result = false;
        }
        $this->total = $this->imported + $this->notImported;

        return $result;
    }

    function importDBAce()
    {
        $fieldsMap = array( 'cpt' => 'cpt',
        'sefurl' => 'url_sef',
        'origurl' => 'url_real',
        'Itemid' => 'Itemid',
        'metadesc' => 'metadesc',
        'metakey' => 'metakey',
        'metatitle' => 'metatitle',
        'metalang' => 'metalang',
        'metarobots' => 'metarobots',
        'metagoogle' => 'metagoogle',
        'canonicallink' => 'metacanonical',
        'dateadd' => 'date',
        'priority' => 'ordering');

        $db =& JFactory::getDBO();

        // Get all the data we need
        $query = "SELECT * FROM `#__acesef_urls`";
        $db->setQuery($query);
        $rows = $db->loadAssocList();

        $result = true;
        for( $i = 0, $n = count($rows); $i < $n; $i++ ) {
            $row =& $rows[$i];

            // Modify the assoc array to match our needs
            $row['cpt'] = 0;
            $row['Itemid'] = SEFTools::extractVariable($row['url_real'], 'Itemid');

            // Insert line to database
            if( !SEFModelImport::_insertLine($row, $fieldsMap) ) {
                $result = false;
            }
        }
        
        $this->type = 'AceSEF Database';

        return $result;
    }

    function importDBSh()
    {
        $fieldsMap = array( 'cpt' => 'cpt',
        'sefurl' => 'oldurl',
        'origurl' => 'newurl',
        'Itemid' => 'Itemid',
        'metadesc' => 'metadesc',
        'metakey' => 'metakey',
        'metatitle' => 'metatitle',
        'metalang' => 'metalang',
        'metarobots' => 'metarobots',
        'metagoogle' => 'metagoogle',
        'canonicallink' => 'canonicallink',
        'dateadd' => 'dateadd',
        'priority' => 'rank');

        $db =& JFactory::getDBO();

        // Get all the data we need
        $query = "SELECT `r`.*, `m`.`metadesc`, `m`.`metakey`, `m`.`metatitle`, `m`.`metalang`, `m`.`metarobots` FROM `#__redirection` AS `r` LEFT JOIN `#__sh404sef_meta` AS `m` ON (`m`.`newurl` = `r`.`newurl`)";
        $db->setQuery($query);
        $rows = $db->loadAssocList();
        
        $result = true;
        for( $i = 0, $n = count($rows); $i < $n; $i++ ) {
            $row =& $rows[$i];

            // Modify the assoc array to match our needs
            $row['Itemid'] = SEFTools::extractVariable($row['newurl'], 'Itemid');
            if (isset($row['rank'])) {
                if ($row['rank'] != '0') {
                    $row['rank'] = '100';
                }
            }
            else {
                if( !empty($row['Itemid']) ) {
                    $row['rank'] = 90;
                } else {
                    $row['rank'] = 95;
                }
            }

            // Insert line to database
            if( !SEFModelImport::_insertLine($row, $fieldsMap) ) {
                $result = false;
            }
        }
        
        $this->type = 'sh404SEF Database';

        return $result;
    }

    function getAceSefTablePresent()
    {
        if( !$this->dbChecked )
        {
            $this->_checkDB();
        }

        return $this->aceSefTablePresent;
    }

    function getShTablePresent()
    {
        if( !$this->dbChecked )
        {
            $this->_checkDB();
        }

        return $this->shSefTablePresent;
    }

    function _determineType(&$lines)
    {
        $type = 'Unknown';

        $n = count($lines);
        if( $n == 0 )
        {
            return $type;
        }

        // Loop through lines trying to determine file format
        for( $i = 0; $i < $n; $i++ )
        {
            $line = trim($lines[$i]);

            if( preg_match('/^INSERT\s+INTO\s+`?\w+(redirection|sefurls)`?/i', $line) > 0 )
            {
                $type = 'JoomSEF';
                break;
            }

            if( preg_match('/^INSERT\s+INTO\s+`?\w+acesef_urls`?/i', $line) > 0 )
            {
                $type = 'AceSEF';
                break;
            }

            if( strpos(strtolower($line), '"id","count","rank","sef url","non-sef url","date added"') !== false )
            {
                $type = 'sh404SEF';
                break;
            }

            if( strpos(strtolower($line), '"id","newurl","metadesc","metakey","metatitle","metalang","metarobots"') !== false )
            {
                $type = 'sh404SEFmeta';
                break;
            }
            
            if( strpos(strtolower($line), '"nbr","sef url","non sef url","hits","rank","date added","page title","page description","page keywords","page language","robots tag"') !== false )
            {
                $type = 'sh404SEF_2_2_7_981';
                break;
            }
        }

        return $type;
    }

    function _importJoomSEF(&$lines)
    {
        $config =& JFactory::getConfig();
        $dbprefix = $config->getValue('config.dbprefix');

        $result = true;
        for ($i = 0, $n = count($lines); $i < $n; $i++) {
            // Trim line
            $line = trim($lines[$i]);
            // Ignore empty lines
            if (strlen($line) == 0) continue;

            // If the query continues at the next line.
            while (substr($line, -1) != ';' && $i + 1 < count($lines)) {
                $i++;
                $newLine = trim($lines[$i]);
                if (strlen($newLine) == 0) continue;
                $line .= ' '.$lines[$i];
            }

            if (preg_match('/^INSERT(\s)+INTO(\s)+`?(\w)+(redirection|sefurls)`?/i', $line) > 0) {
                // fix for files exported from versions older than 1.3.0
                if (strstr($line, "redirection` VALUES") != false) {
                    $line = str_replace("redirection` VALUES", "redirection` (id, cpt, sefurl, origurl, dateadd) VALUES", $line);
                }

                // fix for files exported from versions prior to 2.0.0
                if (!strstr($line, 'origurl') && stristr($line, "newurl, Itemid") == false) {
                    $url = preg_replace('/.*VALUES\s*\(\'[^\']*\',\s*\'[^\']*\',\s*\'[^\']*\',\s*\'([^\']*)\'.*/', '$1', $line);
                    $itemid = preg_replace('/.*[&?]Itemid=([^&]*).*/', '$1', $url);

                    //$newurl = eregi_replace("Itemid=[^&]*", '', $url);
                    
                    $newurl = preg_replace('/Itemid=[^&]*/i', '', $url);
                    $newurl = trim($newurl, '&?');
                    $trans = array( '&&' => '&', '?&' => '?' );
                    $newurl = strtr($newurl, $trans);

                    $line = str_replace('newurl,', 'newurl, Itemid,', $line);
                    $line = str_replace("'$url'", "'$newurl','$itemid'", $line);
                }

                // upgrade to 3.3.0
                $line = str_replace(array('redirection', 'newurl', 'oldurl'), array('sefurls', 'origurl', 'sefurl'), $line);

                // Fix the table name for different prefix
                $line = str_replace('jos_sefurls', "{$dbprefix}sefurls", $line);
                
                // Fix the old URLs exported from Joomla 1.0.x
                $line = $this->_fixJoomla10($line);

                $this->_db->setQuery($line);
                if (!$this->_db->query()) {
                    $this->notImported++;
                    JError::raiseWarning( 100, JText::_('Error importing line') . ': ' . $line . '<br />' . $this->_db->getErrorMsg());
                    $result = false;
                }
                else {
                    $this->imported++;
                }
            }
            else {
                JError::raiseWarning(100, JText::_('Ignoring line') . ': ' . $line);
            }
        }

        return $result;
    }
    
    function _fixJoomla10($line)
    {
        // Get the old URL
        if (!preg_match("/index.php?[^,')]+/", $line, $matches)) {
            return $line;
        }
        $oldUrl = $matches[0];
        $oldQuery = str_replace('index.php?', '', $oldUrl);
        
        // Get the variables
        parse_str($oldQuery, $vars);
        
        // Check option
        if (!isset($vars['option'])) {
            return $line;
        }
        $fn = '_fixJoomla10_'.$vars['option'];
        if (!method_exists($this, $fn)) {
            return $line;
        }
        
        // Call the function to fix URL
        if (!$this->$fn($vars)) {
            // Nothing changed
            return $line;
        }
        
        // The URL is changed, build new URL (sort variables first)
        ksort($vars);
        $opt = $vars['option'];
        unset($vars['option']);
        $vars = array_merge(array('option' => $opt), $vars);
        $newQuery = http_build_query($vars);
        $newUrl = 'index.php?'.$newQuery;
        
        // Fix the URL in the line
        $line = str_replace($oldUrl, $newUrl, $line);
        
        return $line;
    }
    
    function _fixJoomla10_com_frontpage(&$vars)
    {
        $vars['option'] = 'com_content';
        $vars['view'] = 'frontpage';
        
        return true;
    }
    
    function _fixJoomla10_com_content(&$vars)
    {
        if (!isset($vars['task'])) {
            return false;
        }
        
        switch($vars['task']) {
            case 'view':
                unset($vars['task']);
                $vars['view'] = 'article';
                return true;
                
            case 'edit':
                $vars['task'] = 'edit';
                $vars['view'] = 'article';
                return true;
                
            case 'new':
                unset($vars['task']);
                $vars['view'] = 'article';
                $vars['layout'] = 'form';
                if (isset($vars['sectionid'])) {
                    unset($vars['sectionid']);
                }
                return true;
                
            case 'category':
                unset($vars['task']);
                $vars['view'] = 'category';
                $vars['layout'] = 'default';
                if (isset($vars['sectionid'])) {
                    unset($vars['sectionid']);
                }
                return true;
                
            case 'blogcategory':
                unset($vars['task']);
                $vars['view'] = 'category';
                $vars['layout'] = 'blog';
                if (isset($vars['sectionid'])) {
                    unset($vars['sectionid']);
                }
                return true;
                
            case 'section':
                unset($vars['task']);
                $vars['view'] = 'section';
                return true;
                
            case 'blogsection':
                unset($vars['task']);
                $vars['view'] = 'section';
                $vars['layout'] = 'blog';
                return true;
                
            case 'archivesection':
            case 'archivecategory':
                unset($vars['task']);
                $vars['view'] = 'archive';
                if (isset($vars['id'])) {
                    unset($vars['id']);
                }
                return true;
        }
        
        return false;
    }

    function _fixJoomla10_com_contact(&$vars)
    {
        if (!isset($vars['task'])) {
            $vars['view'] = 'category';
            return true;
        }
        
        switch($vars['task']) {
            case 'view':
                unset($vars['task']);
                $vars['view'] = 'contact';
                $vars['id'] = $vars['contact_id'];
                unset($vars['contact_id']);
                return true;
        }
        
        return false;
    }
    
    function _fixJoomla10_com_newsfeeds(&$vars)
    {
        if (!isset($vars['task'])) {
            if (!isset($vars['catid'])) {
                $vars['view'] = 'categories';
            }
            else {
                $vars['view'] = 'category';
                $vars['id'] = $vars['catid'];
                unset($vars['catid']);
            }
            return true;
        }
        
        switch($vars['task']) {
            case 'view':
                unset($vars['task']);
                $vars['view'] = 'newsfeed';
                $vars['id'] = $vars['feedid'];
                unset($vars['feedid']);
                return true;
        }
        
        return false;
    }
    
    function _fixJoomla10_com_registration(&$vars)
    {
        if (!isset($vars['task'])) {
            return false;
        }
        
        switch($vars['task']) {
            case 'register':
                unset($vars['task']);
                $vars['option'] = 'com_user';
                $vars['view'] = 'register';
                return true;
                
            case 'lostPassword':
                unset($vars['task']);
                $vars['option'] = 'com_user';
                $vars['view'] = 'reset';
                return true;
        }
        
        return false;
    }
    
    function _fixJoomla10_com_login(&$vars)
    {
        $vars['option'] = 'com_user';
        $vars['view'] = 'login';
        
        return true;
    }
    
    function _fixJoomla10_com_user(&$vars)
    {
        if (!isset($vars['task'])) {
            return false;
        }
        
        switch($vars['task']) {
            case 'UserDetails':
                $vars['task'] = 'edit';
                $vars['view'] = 'user';
                return true;
        }
        
        return false;
    }
    
    function _fixJoomla10_com_weblinks(&$vars)
    {
        if (!isset($vars['task'])) {
            if (!isset($vars['catid'])) {
                $vars['view'] = 'categories';
            }
            else {
                $vars['view'] = 'category';
                $vars['id'] = $vars['catid'];
                unset($vars['catid']);
            }
            return true;
        }
        
        switch($vars['task']) {
            case 'view':
                unset($vars['task']);
                $vars['view'] = 'weblink';
                return true;
                
            case 'new':
                unset($vars['task']);
                $vars['view'] = 'weblink';
                $vars['layout'] = 'form';
                return true;
        }
        
        return false;
    }
    
    function _fixJoomla10_com_wrapper(&$vars)
    {
        $vars['view'] = 'wrapper';
        return true;
    }
    
    function _importSh404SEF(&$lines)
    {
        $fieldsMap = array( 'cpt' => 'Count',
        'sefurl' => 'SEF URL',
        'origurl' => 'non-SEF URL',
        'Itemid' => 'Itemid',
        'metadesc' => 'metadesc',
        'metakey' => 'metakey',
        'metatitle' => 'metatitle',
        'metalang' => 'metalang',
        'metarobots' => 'metarobots',
        'metagoogle' => 'metagoogle',
        'canonicallink' => 'canonicallink',
        'dateadd' => 'Date added',
        'priority' => 'priority');

        $result = true;
        $fields = array();
        for ($i = 0, $n = count($lines); $i < $n; $i++) {
            // Trim line
            $line = trim($lines[$i]);
            // Ignore empty lines
            if (strlen($line) == 0) continue;

            // Split the line to values
            $values = $this->_parseCsvLine($line);
            $this->_cleanFields($values);

            // If this is the first parsed line, use it for field names
            if( count($fields) == 0 ) {
                $fields = $values;
                continue;
            }
            
            // Create the associative array of fields and values
            $assoc = array_combine($fields, $values);

            // Modify the assoc array to match our needs
            $assoc['Itemid'] = SEFTools::extractVariable($assoc['non-SEF URL'], 'Itemid');
            if( !empty($assoc['Itemid']) ) {
                $assoc['priority'] = 90;
            } else {
                $assoc['priority'] = 95;
            }

            // Insert line to database
            if( !SEFModelImport::_insertLine($assoc, $fieldsMap) ) {
                $result = false;
            }
        }

        return $result;
    }
    
    function _importSh404SEF_2_2_7_981(&$lines)
    {
        $fieldsMap = array( 'cpt' => 'Hits',
        'sefurl' => 'Sef url',
        'origurl' => 'Non sef url',
        'Itemid' => 'Itemid',
        'metadesc' => 'Page description',
        'metakey' => 'Page keywords',
        'metatitle' => 'Page title',
        'metalang' => 'Page language',
        'metarobots' => 'Robots tag',
        'metagoogle' => 'metagoogle',
        'canonicallink' => 'canonicallink',
        'dateadd' => 'Date added',
        'priority' => 'Rank');

        $result = true;
        $fields = array();
        for ($i = 0, $n = count($lines); $i < $n; $i++) {
            // Trim line
            $line = trim($lines[$i]);
            // Ignore empty lines
            if (strlen($line) == 0) continue;

            // Split the line to values
            $values = $this->_parseCsvLine($line);
            $this->_cleanFields($values);

            // If this is the first parsed line, use it for field names
            if( count($fields) == 0 ) {
                $fields = $values;
                continue;
            }
            
            // Create the associative array of fields and values
            $assoc = array_combine($fields, $values);

            // Modify the assoc array to match our needs
            $assoc['Itemid'] = SEFTools::extractVariable($assoc['Non sef url'], 'Itemid');
            if (isset($assoc['Rank'])) {
                if ($assoc['Rank'] != '0') {
                    $assoc['Rank'] = '100';
                }
            }

            // Insert line to database
            if( !SEFModelImport::_insertLine($assoc, $fieldsMap) ) {
                $result = false;
            }
        }

        return $result;
    }
    
    function _parseCsvLine($line)
    {
        if (strpos($line, '"') === false) {
            return explode(',', $line);
        }
        
        $len = strlen($line);
        $values = array();
        while ($len > 0) {
            $pos_comma = strpos($line, ',');
            $pos_quote = strpos($line, '"');
            
            if (is_int($pos_comma)) {
                // More values
                if (!is_int($pos_quote) || ($pos_comma < $pos_quote)) {
                    // Value without enclosure
                    $value = substr($line, 0, $pos_comma);
                    $line = substr($line, $pos_comma + 1);
                }
                else {
                    // Enclosed value
                    $found = false;
                    $offset = $pos_quote + 1;
                    while (!$found) {
                        $pos_quote2 = strpos($line, '"', $offset);
                        if ($pos_quote2 === false) {
                            return false;
                        }
                        if (($pos_quote2 == $offset) || ($line[$pos_quote2 - 1] != '\\')) {
                            // Ending enclosure
                            $value = substr($line, $pos_quote + 1, $pos_quote2 - $pos_quote - 1);
                            $value = str_replace('\"', '"', $value);
                            $line = substr($line, $pos_comma + 1);
                            $found = true;
                        }
                        else {
                            // Escaped enclosure
                            $offset = $pos_quote2 + 1;
                        }
                    }
                }
            }
            else if (!is_int($pos_comma)) {
                // Last value
                if (is_int($pos_quote)) {
                    // Enclosed
                    $value = trim($line);
                    $value = trim($value, '"');
                    $value = str_replace('\"', '"', $value);
                }
                else {
                    // Not enclosed
                    $value = $line;
                }
                $line = '';
            }
            
            $values[] = $value;
            $len = strlen($line);
        }
        
        return $values;
    }

    function _importSh404SEFmeta(&$lines)
    {
        $fieldsMap = array( 'origurl' => 'newurl',
        'Itemid' => 'Itemid',
        'metadesc' => 'metadesc',
        'metakey' => 'metakey',
        'metatitle' => 'metatitle',
        'metalang' => 'metalang',
        'metarobots' => 'metarobots');

        $updateKeys = array('origurl', 'Itemid');

        $result = true;
        $fields = array();
        for ($i = 0, $n = count($lines); $i < $n; $i++) {
            // Trim line
            $line = trim($lines[$i]);
            // Ignore empty lines
            if (strlen($line) == 0) continue;

            // Split the line to values
            $values = $this->_parseCsvLine($line);
            $this->_cleanFields($values);
            $this->_shUnEmptyFields($values);

            // If this is the first parsed line, use it for field names
            if( count($fields) == 0 ) {
                $fields = $values;
                continue;
            }

            // Create the associative array of fields and values
            $assoc = array_combine($fields, $values);

            // Modify the assoc array to match our needs
            $assoc['Itemid'] = SEFTools::extractVariable($assoc['newurl'], 'Itemid');

            // Update line in database
            if( !SEFModelImport::_updateLine($assoc, $fieldsMap, $updateKeys) ) {
                $result = false;
            }
        }

        return $result;
    }

    function _importAceSEF(&$lines)
    {
        $fieldsMap = array( 'cpt' => 'cpt',
        'sefurl' => 'url_sef',
        'origurl' => 'url_real',
        'Itemid' => 'Itemid',
        'metadesc' => 'metadesc',
        'metakey' => 'metakey',
        'metatitle' => 'metatitle',
        'metalang' => 'metalang',
        'metarobots' => 'metarobots',
        'metagoogle' => 'metagoogle',
        'canonicallink' => 'metacanonical',
        'dateadd' => 'date',
        'priority' => 'ordering');

        $result = true;
        for ($i = 0, $n = count($lines); $i < $n; $i++) {
            // Trim line
            $line = trim($lines[$i]);
            // Ignore empty lines
            if (strlen($line) == 0) continue;

            // If the query continues at the next line.
            while (substr($line, -1) != ';' && $i + 1 < count($lines)) {
                $i++;
                $newLine = trim($lines[$i]);
                if (strlen($newLine) == 0) continue;
                $line .= ' '.$lines[$i];
            }

            if (preg_match('/^INSERT\s+INTO\s+`?\w+acesef_urls`?/i', $line) > 0) {
                // Parse the line
                $pos = strpos($line, '(');
                if( $pos !== false ) {
                    $line = substr($line, $pos+1);
                }
                $line = str_replace(');', '', $line);

                // Split the line to fields and values
                list($fields, $values) = explode(') VALUES (', $line);

                $fields = explode(',', $fields);
                $values = explode("', '", $values);

                $this->_cleanFields($fields);
                $this->_cleanFields($values);

                // Create the associative array of fields and values
                $assoc = array_combine($fields, $values);

                // Modify the assoc array to match our needs
                $assoc['cpt'] = 0;
                $assoc['Itemid'] = SEFTools::extractVariable($assoc['url_real'], 'Itemid');

                // Insert line to database
                if( !SEFModelImport::_insertLine($assoc, $fieldsMap) ) {
                    $result = false;
                }
            }
            else {
                JError::raiseWarning(100, JText::_('Ignoring line') . ': ' . $line);
            }
        }

        return $result;
    }

    function _cleanFields(&$fields)
    {
        for( $i = 0, $n = count($fields); $i < $n; $i++ ) {
            $fields[$i] = trim($fields[$i], " `'\"");
        }
    }

    function _shUnEmptyFields(&$fields)
    {
        for( $i = 0, $n = count($fields); $i < $n; $i++ ) {
            if( $fields[$i] == '&nbsp' ) {
                $fields[$i] = '';
            }
        }
    }

    function _insertLine(&$assoc, &$fieldsMap)
    {
        // Build the SQL query
        $query = "INSERT INTO `#__sefurls` (";
        $keys = array_keys($fieldsMap);
        $query .= '`' . implode('`, `', $keys) . '`) VALUES (';

        for( $j = 0, $n2 = count($keys); $j < $n2; $j++ )
        {
            $key = $keys[$j];
            $map = $fieldsMap[$key];

            if( isset($assoc[$map]) ) {
                $query .= "'" . $assoc[$map] . "'";
            }
            else {
                $query .= "''";
            }

            if( $j < ($n2 - 1) ) {
                $query .= ', ';
            }
        }
        $query .= ')';

        // Try to run the query
        $this->_db->setQuery($query);
        if (!$this->_db->query()) {
            $this->notImported++;
            JError::raiseWarning( 100, JText::_('Error importing line') . ': ' . $query . '<br />' . $this->_db->getErrorMsg());
            return false;
        }
        else {
            $this->imported++;
        }

        return true;
    }

    function _updateLine(&$assoc, &$fieldsMap, &$updateKeys)
    {
        // Build the SQL query
        $query = "UPDATE `#__sefurls` SET ";
        $keys = array_keys($fieldsMap);

        $set = array();
        $where = array();

        for( $j = 0, $n2 = count($keys); $j < $n2; $j++ )
        {
            $key = $keys[$j];
            $map = $fieldsMap[$key];

            if( isset($assoc[$map]) ) {
                $value = "`$key` = '{$assoc[$map]}'";
                if( in_array($key, $updateKeys) ) {
                    $where[] = '(' . $value . ')';
                }
                else {
                    $set[] = $value;
                }
            }
        }

        if( (count($set) == 0 )|| (count($where) == 0) ) {
            return false;
        }

        // Add the set, where and limit parts
        $query .= implode(', ', $set);
        $query .= ' WHERE ' . implode(' AND ', $where);
        $query .= ' LIMIT 1';

        // Try to run the query
        $this->_db->setQuery($query);
        if (!$this->_db->query()) {
            $this->notImported++;
            JError::raiseWarning( 100, JText::_('Error importing line') . ': ' . $query . '<br />' . $this->_db->getErrorMsg());
            return false;
        }
        else {
            $this->imported++;
        }

        return true;
    }

    function _checkDB()
    {
        $db =& JFactory::getDBO();

        // Check AceSEF installation
        $query = "SELECT * FROM `#__acesef_urls` LIMIT 1";
        $db->setQuery($query);
        $row = $db->loadObject();
        if( !is_null($row) ) {
            $this->aceSefTablePresent = true;
        }

        // Check sh404SEF installation
        $query = "SELECT * FROM `#__redirection` LIMIT 1";
        $db->setQuery($query);
        $row = $db->loadObject();
        if( !is_null($row) ) {
            if( isset($row->oldurl) && isset($row->newurl) ) {
                $this->shSefTablePresent = true;
            }
        }

        $this->dbChecked = true;
    }
}
?>