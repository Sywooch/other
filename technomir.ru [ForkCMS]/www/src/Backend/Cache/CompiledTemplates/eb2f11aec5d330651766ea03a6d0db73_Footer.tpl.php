<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
	<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Messaging.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Core\Layout\Templates'))) $this->compile('J:\home\technomir.com\www\src\Backend\Core\Layout\Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Core\Layout\Templates');
				if($return === false && $this->compile('J:\home\technomir.com\www\src\Backend\Core\Layout\Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, 'J:\home\technomir.com\www\src\Backend\Core\Layout\Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Messaging.tpl}<?php
				}
?>

	<div id="ajaxSpinner" style="position: fixed; top: 10px; right: 10px; display: none;">
		<img src="/src/Backend/Core/Layout/images/spinner.gif" width="16" height="16" alt="loading" />
	</div>
</body>
</html>
