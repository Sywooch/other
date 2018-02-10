<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<td id="subnavigation">
	<table>
		<tr>
			<td id="moduleHolder">
				<?php if(array_key_exists('var', (array) $this->variables)) { echo Backend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var']); } else { ?>{$var|getnavigation}<?php } ?>
			</td>
		</tr>
	</table>
</td>