<?php
/**
 * @package dompdf
 * @link    http://www.dompdf.com/
 * @author  Benj Carson <benjcarson@digitaljunkies.ca>
 * @author  Fabien Ménager <fabien.menager@gmail.com>
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 * @version $Id: autoload.inc.php 448 2011-11-13 13:00:03Z fabien.menager $
 */
 
/**
 * DOMPDF autoload function
 *
 * If you have an existing autoload function, add a call to this function
 * from your existing __autoload() implementation.
 *
 * @param string $class
 */
function DOMPDF_autoload($class) {
  $filename = DOMPDF_INC_DIR . "/" . mb_strtolower($class) . ".cls.php";
  
  if ( is_file($filename) )
    require_once($filename);
	
	if (version_compare(JVERSION, '1.6.0', '>=')) {
		JLoader::load($class);
	}
	else {
		$jloader = new JLoader();
		$jloader->load($class);
	}
}

// If SPL autoload functions are available (PHP >= 5.1.2)
if ( function_exists("spl_autoload_register") ) {
  $autoload = "DOMPDF_autoload";
  $funcs = spl_autoload_functions();
  
  // No functions currently in the stack. 
  if ( $funcs === false ) { 
    spl_autoload_register($autoload); 
  }
  
  // If PHP >= 5.3 the $prepend argument is available
  else if ( version_compare(PHP_VERSION, '5.3', '>=') ) {
    spl_autoload_register($autoload, true, true); 
  }
  
  else {
    // Unregister existing autoloaders... 
    $compat = version_compare(PHP_VERSION, '5.1.2', '<=') && 
              version_compare(PHP_VERSION, '5.1.0', '>=');
     
    foreach ($funcs as $func) { 
      if (is_array($func)) { 
        // :TRICKY: There are some compatibility issues and some 
        // places where we need to error out 
		if (is_object($func[0])) continue;
        $reflector = new ReflectionMethod($func[0], $func[1]); 
        if (!$reflector->isStatic()) { 
          throw new Exception('This function is not compatible with non-static object methods due to PHP Bug #44144.'); 
        }
        
        // Suprisingly, spl_autoload_register supports the 
        // Class::staticMethod callback format, although call_user_func doesn't 
        if ($compat) $func = implode('::', $func); 
      }
      
      spl_autoload_unregister($func); 
    } 
    
    // Register the new one, thus putting it at the front of the stack... 
    spl_autoload_register($autoload); 
	
    // Now, go back and re-register all of our old ones. 
    foreach ($funcs as $func) { 
		if (is_callable($func))
			spl_autoload_register($func); 
    }
    
    // Be polite and ensure that userland autoload gets retained
    if ( function_exists("__autoload") ) {
      spl_autoload_register("__autoload");
    }
	
	if (class_exists('JLoader'))
	{
		if (method_exists('JLoader', 'setup')) 
			JLoader::setup();
	}
	if (class_exists('JCmsLoader'))
	{
		if (method_exists('JCmsLoader', 'setup')) 
			JCmsLoader::setup();
	}
  }
}

else if ( !function_exists("__autoload") ) {
  /**
   * Default __autoload() function
   *
   * @param string $class
   */
  function __autoload($class) {
    DOMPDF_autoload($class);
  }
}

// ### End of user-configurable options ###
