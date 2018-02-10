<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<table<?php
					if(isset($this->variables['summary']) && count($this->variables['summary']) != 0 && $this->variables['summary'] != '' && $this->variables['summary'] !== false)
					{
						?> summary="<?php if(array_key_exists('summary', (array) $this->variables)) { echo $this->variables['summary']; } else { ?>{$summary}<?php } ?>"<?php } ?><?php if(array_key_exists('attributes', (array) $this->variables)) { echo $this->variables['attributes']; } else { ?>{$attributes}<?php } ?>>
	<?php
					if(isset($this->variables['caption']) && count($this->variables['caption']) != 0 && $this->variables['caption'] != '' && $this->variables['caption'] !== false)
					{
						?><caption><?php if(array_key_exists('caption', (array) $this->variables)) { echo $this->variables['caption']; } else { ?>{$caption}<?php } ?></caption><?php } ?>
	<thead>
		<tr>
			<?php
					if(!isset($this->variables['headers']))
					{
						?>{iteration:headers}<?php
						$this->variables['headers'] = array();
						$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['fail'] = true;
					}
				if(isset(${'headers'})) $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['old'] = ${'headers'};
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['iteration'] = $this->variables['headers'];
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['i'] = 1;
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['count'] = count($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['iteration'] as ${'headers'})
				{
					if(!isset(${'headers'}['first']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['i'] == 1) ${'headers'}['first'] = true;
					if(!isset(${'headers'}['last']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['i'] == $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['count']) ${'headers'}['last'] = true;
					if(isset(${'headers'}['formElements']) && is_array(${'headers'}['formElements']))
					{
						foreach(${'headers'}['formElements'] as $name => $object)
						{
							${'headers'}[$name] = $object->parse();
							${'headers'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
				<th<?php if(array_key_exists('attributes', (array) ${'headers'})) { echo ${'headers'}['attributes']; } else { ?>{$headers->attributes}<?php } ?>>
					<?php
					if(isset(${'headers'}['sorting']) && count(${'headers'}['sorting']) != 0 && ${'headers'}['sorting'] != '' && ${'headers'}['sorting'] !== false)
					{
						?>
						<?php
					if(isset(${'headers'}['sorted']) && count(${'headers'}['sorted']) != 0 && ${'headers'}['sorted'] != '' && ${'headers'}['sorted'] !== false)
					{
						?>
							<a href="<?php if(array_key_exists('sortingURL', (array) ${'headers'})) { echo ${'headers'}['sortingURL']; } else { ?>{$headers->sortingURL}<?php } ?>" title="<?php if(array_key_exists('sortingLabel', (array) ${'headers'})) { echo ${'headers'}['sortingLabel']; } else { ?>{$headers->sortingLabel}<?php } ?>" class="sortable sorted<?php
					if(isset(${'headers'}['sortedAsc']) && count(${'headers'}['sortedAsc']) != 0 && ${'headers'}['sortedAsc'] != '' && ${'headers'}['sortedAsc'] !== false)
					{
						?> sortedAsc<?php } ?><?php
					if(isset(${'headers'}['sortedDesc']) && count(${'headers'}['sortedDesc']) != 0 && ${'headers'}['sortedDesc'] != '' && ${'headers'}['sortedDesc'] !== false)
					{
						?> sortedDesc<?php } ?>"><?php if(array_key_exists('label', (array) ${'headers'})) { echo ${'headers'}['label']; } else { ?>{$headers->label}<?php } ?></a>
						<?php } ?>
						<?php
					if(isset(${'headers'}['notSorted']) && count(${'headers'}['notSorted']) != 0 && ${'headers'}['notSorted'] != '' && ${'headers'}['notSorted'] !== false)
					{
						?>
							<a href="<?php if(array_key_exists('sortingURL', (array) ${'headers'})) { echo ${'headers'}['sortingURL']; } else { ?>{$headers->sortingURL}<?php } ?>" title="<?php if(array_key_exists('sortingLabel', (array) ${'headers'})) { echo ${'headers'}['sortingLabel']; } else { ?>{$headers->sortingLabel}<?php } ?>" class="sortable"><?php if(array_key_exists('label', (array) ${'headers'})) { echo ${'headers'}['label']; } else { ?>{$headers->label}<?php } ?></a>
						<?php } ?>
					<?php } ?>

					<?php
					if(isset(${'headers'}['noSorting']) && count(${'headers'}['noSorting']) != 0 && ${'headers'}['noSorting'] != '' && ${'headers'}['noSorting'] !== false)
					{
						?>
						<?php
					if(isset(${'headers'}['label']) && count(${'headers'}['label']) != 0 && ${'headers'}['label'] != '' && ${'headers'}['label'] !== false)
					{
						?><span><?php if(array_key_exists('label', (array) ${'headers'})) { echo ${'headers'}['label']; } else { ?>{$headers->label}<?php } ?></span><?php } ?>
						<?php if(!isset(${'headers'}['label']) || count(${'headers'}['label']) == 0 || ${'headers'}['label'] == '' || ${'headers'}['label'] === false): ?><span>&#160;</span><?php endif; ?>
					<?php } ?>
				</th>
			<?php
					$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['fail']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:headers}<?php
					}
				if(isset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['old'])) ${'headers'} = $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']['old'];
				else unset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_1']);
				?>
		</tr>
	</thead>
	<tbody>
		<?php
					if(!isset($this->variables['rows']))
					{
						?>{iteration:rows}<?php
						$this->variables['rows'] = array();
						$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['fail'] = true;
					}
				if(isset(${'rows'})) $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['old'] = ${'rows'};
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['iteration'] = $this->variables['rows'];
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['i'] = 1;
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['count'] = count($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['iteration'] as ${'rows'})
				{
					if(!isset(${'rows'}['first']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['i'] == 1) ${'rows'}['first'] = true;
					if(!isset(${'rows'}['last']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['i'] == $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['count']) ${'rows'}['last'] = true;
					if(isset(${'rows'}['formElements']) && is_array(${'rows'}['formElements']))
					{
						foreach(${'rows'}['formElements'] as $name => $object)
						{
							${'rows'}[$name] = $object->parse();
							${'rows'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<tr<?php if(array_key_exists('attributes', (array) ${'rows'})) { echo ${'rows'}['attributes']; } else { ?>{$rows->attributes}<?php } ?>>
				<?php
					if(!isset(${'rows'}['columns']))
					{
						?>{iteration:rows->columns}<?php
						${'rows'}['columns'] = array();
						$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['fail'] = true;
					}
				if(isset(${'rows'}['columns'])) $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['old'] = ${'rows'}['columns'];
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['iteration'] = ${'rows'}['columns'];
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['i'] = 1;
				$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['count'] = count($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['iteration']);
				foreach((array) $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['iteration'] as ${'rows'}['columns'])
				{
					if(!isset(${'rows'}['columns']['first']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['i'] == 1) ${'rows'}['columns']['first'] = true;
					if(!isset(${'rows'}['columns']['last']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['i'] == $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['count']) ${'rows'}['columns']['last'] = true;
					if(isset(${'rows'}['columns']['formElements']) && is_array(${'rows'}['columns']['formElements']))
					{
						foreach(${'rows'}['columns']['formElements'] as $name => $object)
						{
							${'rows'}['columns'][$name] = $object->parse();
							${'rows'}['columns'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?><td<?php if(isset(${'rows'}['columns']) && array_key_exists('attributes', (array) ${'rows'}['columns'])) { echo ${'rows'}['columns']['attributes']; } else { ?>{$rows->columns.attributes}<?php } ?>><?php if(isset(${'rows'}['columns']) && array_key_exists('value', (array) ${'rows'}['columns'])) { echo ${'rows'}['columns']['value']; } else { ?>{$rows->columns.value}<?php } ?></td><?php
					$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['i']++;
				}
					if(isset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['fail']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['fail'] == true)
					{
						?>{/iteration:rows->columns}<?php
					}
				if(isset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['old'])) ${'rows'}['columns'] = $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']['old'];
				else unset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_3']['columns']);
				?>
			</tr>
		<?php
					$this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['fail']) && $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:rows}<?php
					}
				if(isset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['old'])) ${'rows'} = $this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']['old'];
				else unset($this->iterations['400cd04882daa00882808a671a68b22c_Datagrid.tpl.php_2']);
				?>
	</tbody>
	<?php
					if(isset($this->variables['footer']) && count($this->variables['footer']) != 0 && $this->variables['footer'] != '' && $this->variables['footer'] !== false)
					{
						?>
		<tfoot>
			<tr<?php if(array_key_exists('footerAttributes', (array) $this->variables)) { echo $this->variables['footerAttributes']; } else { ?>{$footerAttributes}<?php } ?>>
				<td colspan="<?php if(array_key_exists('numColumns', (array) $this->variables)) { echo $this->variables['numColumns']; } else { ?>{$numColumns}<?php } ?>">
					<div class="tableOptionsHolder">
						<div class="tableOptions">
							<?php
					if(isset($this->variables['massAction']) && count($this->variables['massAction']) != 0 && $this->variables['massAction'] != '' && $this->variables['massAction'] !== false)
					{
						?><div class="oneLiner massAction"><?php if(array_key_exists('massAction', (array) $this->variables)) { echo $this->variables['massAction']; } else { ?>{$massAction}<?php } ?></div><?php } ?>
							<?php
					if(isset($this->variables['paging']) && count($this->variables['paging']) != 0 && $this->variables['paging'] != '' && $this->variables['paging'] !== false)
					{
						?><div class="pagination"><?php if(array_key_exists('paging', (array) $this->variables)) { echo $this->variables['paging']; } else { ?>{$paging}<?php } ?></div><?php } ?>
						</div>
					</div>
				</td>
			</tr>
		</tfoot>
	<?php } ?>
</table>

<?php
					if(isset($this->variables['excludedCheckboxesData']) && count($this->variables['excludedCheckboxesData']) != 0 && $this->variables['excludedCheckboxesData'] != '' && $this->variables['excludedCheckboxesData'] !== false)
					{
						?>
<script type="text/javascript">
	//<![CDATA[
		window.onload = function()
		{
			if(typeof excludedCheckboxesData != undefined) var excludedCheckboxesData = [];
			excludedCheckboxesData['<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } else { ?>{$excludedCheckboxesData.id}<?php } ?>'] = <?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('JSON', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['JSON']; } else { ?>{$excludedCheckboxesData.JSON}<?php } ?>;

			// loop and remove elements
			for(var i in excludedCheckboxesData['<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } else { ?>{$excludedCheckboxesData.id}<?php } ?>']) $('#<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } else { ?>{$excludedCheckboxesData.id}<?php } ?> input[value='+ excludedCheckboxesData['<?php if(isset($this->variables['excludedCheckboxesData']) && array_key_exists('id', (array) $this->variables['excludedCheckboxesData'])) { echo $this->variables['excludedCheckboxesData']['id']; } else { ?>{$excludedCheckboxesData.id}<?php } ?>'][i] +']').remove();
		}
	//]]>
</script>
<?php } ?>

<?php
					if(isset($this->variables['checkedCheckboxesData']) && count($this->variables['checkedCheckboxesData']) != 0 && $this->variables['checkedCheckboxesData'] != '' && $this->variables['checkedCheckboxesData'] !== false)
					{
						?>
<script type="text/javascript">
	//<![CDATA[
		window.onload = function()
		{
			if(typeof checkedCheckboxesData != undefined) var checkedCheckboxesData = [];
			checkedCheckboxesData['<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } else { ?>{$checkedCheckboxesData.id}<?php } ?>'] = <?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('JSON', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['JSON']; } else { ?>{$checkedCheckboxesData.JSON}<?php } ?>;

			// loop and remove elements
			for(var i in checkedCheckboxesData['<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } else { ?>{$checkedCheckboxesData.id}<?php } ?>']) $('#<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } else { ?>{$checkedCheckboxesData.id}<?php } ?> input[value='+ checkedCheckboxesData['<?php if(isset($this->variables['checkedCheckboxesData']) && array_key_exists('id', (array) $this->variables['checkedCheckboxesData'])) { echo $this->variables['checkedCheckboxesData']['id']; } else { ?>{$checkedCheckboxesData.id}<?php } ?>'][i] +']').prop('checked', true);
		}
	//]]>
</script>
<?php } ?>