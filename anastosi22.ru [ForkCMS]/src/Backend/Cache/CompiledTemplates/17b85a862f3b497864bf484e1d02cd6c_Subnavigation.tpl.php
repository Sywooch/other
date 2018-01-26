<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<td id="subnavigation">
	<table>
		<tr>
			<td id="moduleHolder">
				<?php echo Backend\Core\Engine\TemplateModifiers::getNavigation($this->variables['var']); ?>
			</td>
		</tr>
	</table>
</td>