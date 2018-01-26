<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_MODULES_PATH']; ?>/Dashboard/Layout/Templates/StructureStart.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
?>

<div id="dashboardWidgets" class="clearfix">
	<div id="editDashboardMessage" class="generalMessage infoMessage" style="display:none; margin: 12px;">
		<?php echo $this->variables['msgHelpEditDashboard']; ?>
		<a href="#" id="doneEditingDashboard"><?php echo SpoonFilter::ucfirst($this->variables['lblDone']); ?></a>
	</div>

	<div class="leftColumn column">
		<?php
				if(isset(${'leftColumn'})) $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['old'] = ${'leftColumn'};
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['iteration'] = $this->variables['leftColumn'];
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['i'] = 1;
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['count'] = count($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['iteration'] as ${'leftColumn'})
				{
					if(!isset(${'leftColumn'}['first']) && $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['i'] == 1) ${'leftColumn'}['first'] = true;
					if(!isset(${'leftColumn'}['last']) && $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['i'] == $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['count']) ${'leftColumn'}['last'] = true;
					if(isset(${'leftColumn'}['formElements']) && is_array(${'leftColumn'}['formElements']))
					{
						foreach(${'leftColumn'}['formElements'] as $name => $object)
						{
							${'leftColumn'}[$name] = $object->parse();
							${'leftColumn'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<div class="sortableWidget<?php
					if(isset(${'leftColumn'}['hidden']) && count(${'leftColumn'}['hidden']) != 0 && ${'leftColumn'}['hidden'] != '' && ${'leftColumn'}['hidden'] !== false)
					{
						?> isRemoved<?php } ?>" data-module="<?php echo ${'leftColumn'}['module']; ?>" data-widget="<?php echo ${'leftColumn'}['widget']; ?>" data-title="<?php echo ${'leftColumn'}['title']; ?>"<?php
					if(isset(${'leftColumn'}['hidden']) && count(${'leftColumn'}['hidden']) != 0 && ${'leftColumn'}['hidden'] != '' && ${'leftColumn'}['hidden'] !== false)
					{
						?> style="display: none;"<?php } ?>>
				<a href="#" class="editDashboardClose ui-dialog-titlebar-close ui-corner-all" style="display: none;"><span class="ui-icon ui-icon-closethick">close</span></a>
				<?php
					if(isset(${'leftColumn'}['hidden']) && count(${'leftColumn'}['hidden']) != 0 && ${'leftColumn'}['hidden'] != '' && ${'leftColumn'}['hidden'] !== false)
					{
						?>
					<div id="widgetBlogComments" class="box">
						<div class="heading">
							<h3><?php echo ${'leftColumn'}['title']; ?></h3>
						</div>
						<div class="options" style="display: none;">
							<?php echo $this->variables['msgWillBeEnabledOnSave']; ?>
						</div>
					</div>
				<?php } ?>
				<?php if(!isset(${'leftColumn'}['hidden']) || count(${'leftColumn'}['hidden']) == 0 || ${'leftColumn'}['hidden'] == '' || ${'leftColumn'}['hidden'] === false): ?>
					<?php
				ob_start();
				?><?php echo ${'leftColumn'}['template']; ?><?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
?>
				<?php endif; ?>
			</div>
		<?php
					$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['old'])) ${'leftColumn'} = $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']['old'];
				else unset($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_1']);
				?>
		&#160;
	</div>

	<div class="middleColumn column">
		<?php
				if(isset(${'middleColumn'})) $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['old'] = ${'middleColumn'};
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['iteration'] = $this->variables['middleColumn'];
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['i'] = 1;
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['count'] = count($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['iteration'] as ${'middleColumn'})
				{
					if(!isset(${'middleColumn'}['first']) && $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['i'] == 1) ${'middleColumn'}['first'] = true;
					if(!isset(${'middleColumn'}['last']) && $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['i'] == $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['count']) ${'middleColumn'}['last'] = true;
					if(isset(${'middleColumn'}['formElements']) && is_array(${'middleColumn'}['formElements']))
					{
						foreach(${'middleColumn'}['formElements'] as $name => $object)
						{
							${'middleColumn'}[$name] = $object->parse();
							${'middleColumn'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<div class="sortableWidget<?php
					if(isset(${'middleColumn'}['hidden']) && count(${'middleColumn'}['hidden']) != 0 && ${'middleColumn'}['hidden'] != '' && ${'middleColumn'}['hidden'] !== false)
					{
						?> isRemoved<?php } ?>" data-module="<?php echo ${'middleColumn'}['module']; ?>" data-widget="<?php echo ${'middleColumn'}['widget']; ?>" data-title="<?php echo ${'middleColumn'}['title']; ?>"<?php
					if(isset(${'middleColumn'}['hidden']) && count(${'middleColumn'}['hidden']) != 0 && ${'middleColumn'}['hidden'] != '' && ${'middleColumn'}['hidden'] !== false)
					{
						?> style="display: none;"<?php } ?>>
				<a href="#" class="editDashboardClose ui-dialog-titlebar-close ui-corner-all" style="display: none;"><span class="ui-icon ui-icon-closethick">close</span></a>
				<?php
					if(isset(${'middleColumn'}['hidden']) && count(${'middleColumn'}['hidden']) != 0 && ${'middleColumn'}['hidden'] != '' && ${'middleColumn'}['hidden'] !== false)
					{
						?>
					<div id="widgetBlogComments" class="box">
						<div class="heading">
							<h3><?php echo ${'middleColumn'}['title']; ?></h3>
						</div>
						<div class="options" style="display: none;">
							<?php echo $this->variables['msgWillBeEnabledOnSave']; ?>
						</div>
					</div>
				<?php } ?>
				<?php if(!isset(${'middleColumn'}['hidden']) || count(${'middleColumn'}['hidden']) == 0 || ${'middleColumn'}['hidden'] == '' || ${'middleColumn'}['hidden'] === false): ?>
					<?php
				ob_start();
				?><?php echo ${'middleColumn'}['template']; ?><?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
?>
				<?php endif; ?>
			</div>
		<?php
					$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['i']++;
				}
				if(isset($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['old'])) ${'middleColumn'} = $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']['old'];
				else unset($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_2']);
				?>
		&#160;
	</div>

	<div class="rightColumn column">
		<?php
				if(isset(${'rightColumn'})) $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['old'] = ${'rightColumn'};
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['iteration'] = $this->variables['rightColumn'];
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['i'] = 1;
				$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['count'] = count($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['iteration'] as ${'rightColumn'})
				{
					if(!isset(${'rightColumn'}['first']) && $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['i'] == 1) ${'rightColumn'}['first'] = true;
					if(!isset(${'rightColumn'}['last']) && $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['i'] == $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['count']) ${'rightColumn'}['last'] = true;
					if(isset(${'rightColumn'}['formElements']) && is_array(${'rightColumn'}['formElements']))
					{
						foreach(${'rightColumn'}['formElements'] as $name => $object)
						{
							${'rightColumn'}[$name] = $object->parse();
							${'rightColumn'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<div class="sortableWidget<?php
					if(isset(${'rightColumn'}['hidden']) && count(${'rightColumn'}['hidden']) != 0 && ${'rightColumn'}['hidden'] != '' && ${'rightColumn'}['hidden'] !== false)
					{
						?> isRemoved<?php } ?>" data-module="<?php echo ${'rightColumn'}['module']; ?>" data-widget="<?php echo ${'rightColumn'}['widget']; ?>" data-title="<?php echo ${'rightColumn'}['title']; ?>"<?php
					if(isset(${'rightColumn'}['hidden']) && count(${'rightColumn'}['hidden']) != 0 && ${'rightColumn'}['hidden'] != '' && ${'rightColumn'}['hidden'] !== false)
					{
						?> style="display: none;"<?php } ?>>
				<a href="#" class="editDashboardClose ui-dialog-titlebar-close ui-corner-all" style="display: none;"><span class="ui-icon ui-icon-closethick">close</span></a>
				<?php
					if(isset(${'rightColumn'}['hidden']) && count(${'rightColumn'}['hidden']) != 0 && ${'rightColumn'}['hidden'] != '' && ${'rightColumn'}['hidden'] !== false)
					{
						?>
					<div id="widgetBlogComments" class="box">
						<div class="heading">
							<h3><?php echo ${'rightColumn'}['title']; ?></h3>
						</div>
						<div class="options" style="display: none;">
							<?php echo $this->variables['msgWillBeEnabledOnSave']; ?>
						</div>
					</div>
				<?php } ?>
				<?php if(!isset(${'rightColumn'}['hidden']) || count(${'rightColumn'}['hidden']) == 0 || ${'rightColumn'}['hidden'] == '' || ${'rightColumn'}['hidden'] === false): ?>
					<?php
				ob_start();
				?><?php echo ${'rightColumn'}['template']; ?><?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
?>
				<?php endif; ?>
			</div>
		<?php
					$this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['i']++;
				}
				if(isset($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['old'])) ${'rightColumn'} = $this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']['old'];
				else unset($this->iterations['9187d7c0fe5055a5f45b89c25d37bad3_Index.tpl.php_3']);
				?>
		&#160;
	</div>
</div>

<p>
	<small>
		<a href="#" id="editDashboard">
			<?php echo $this->variables['msgEditYourDashboard']; ?>
		</a>
	</small>
</p>

<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_MODULES_PATH']; ?>/Dashboard/Layout/Templates/StructureEnd.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
?>
<?php
				ob_start();
				?><?php echo $this->variables['BACKEND_CORE_PATH']; ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/anastosi/domains/anastosi.ru/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
?>
