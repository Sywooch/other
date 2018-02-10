<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<td id="pagesTree">
	<table>
		<tr>
			<td id="treeHolder">
				<div id="tree">
					<?php if(array_key_exists('tree', (array) $this->variables)) { echo $this->variables['tree']; } else { ?>{$tree}<?php } ?>
				</div>
			</td>
		</tr>
	</table>
</td>