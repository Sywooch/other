<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Head.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Dashboard/Layout/Templates/StructureStart.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Dashboard/Layout/Templates/StructureStart.tpl}<?php
				}
?>

<div id="dashboardWidgets" class="clearfix">
	<div id="editDashboardMessage" class="generalMessage infoMessage" style="display:none; margin: 12px;">
		<?php if(array_key_exists('msgHelpEditDashboard', (array) $this->variables)) { echo $this->variables['msgHelpEditDashboard']; } else { ?>{$msgHelpEditDashboard}<?php } ?>
		<a href="#" id="doneEditingDashboard"><?php if(array_key_exists('lblDone', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblDone']); } else { ?>{$lblDone|ucfirst}<?php } ?></a>
	</div>

	<div class="leftColumn column">
		<?php
					if(!isset($this->variables['leftColumn']))
					{
						?>{iteration:leftColumn}<?php
						$this->variables['leftColumn'] = array();
						$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['fail'] = true;
					}
				if(isset(${'leftColumn'})) $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['old'] = ${'leftColumn'};
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['iteration'] = $this->variables['leftColumn'];
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['i'] = 1;
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['count'] = count($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['iteration'] as ${'leftColumn'})
				{
					if(!isset(${'leftColumn'}['first']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['i'] == 1) ${'leftColumn'}['first'] = true;
					if(!isset(${'leftColumn'}['last']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['i'] == $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['count']) ${'leftColumn'}['last'] = true;
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
						?> isRemoved<?php } ?>" data-module="<?php if(array_key_exists('module', (array) ${'leftColumn'})) { echo ${'leftColumn'}['module']; } else { ?>{$leftColumn->module}<?php } ?>" data-widget="<?php if(array_key_exists('widget', (array) ${'leftColumn'})) { echo ${'leftColumn'}['widget']; } else { ?>{$leftColumn->widget}<?php } ?>" data-title="<?php if(array_key_exists('title', (array) ${'leftColumn'})) { echo ${'leftColumn'}['title']; } else { ?>{$leftColumn->title}<?php } ?>"<?php
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
							<h3><?php if(array_key_exists('title', (array) ${'leftColumn'})) { echo ${'leftColumn'}['title']; } else { ?>{$leftColumn->title}<?php } ?></h3>
						</div>
						<div class="options" style="display: none;">
							<?php if(array_key_exists('msgWillBeEnabledOnSave', (array) $this->variables)) { echo $this->variables['msgWillBeEnabledOnSave']; } else { ?>{$msgWillBeEnabledOnSave}<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php if(!isset(${'leftColumn'}['hidden']) || count(${'leftColumn'}['hidden']) == 0 || ${'leftColumn'}['hidden'] == '' || ${'leftColumn'}['hidden'] === false): ?>
					<?php
				ob_start();
				?><?php if(array_key_exists('template', (array) ${'leftColumn'})) { echo ${'leftColumn'}['template']; } else { ?>{$leftColumn->template}<?php } ?><?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('template', (array) ${'leftColumn'})) { echo ${'leftColumn'}['template']; } else { ?>{$leftColumn->template}<?php } ?>}<?php
				}
?>
				<?php endif; ?>
			</div>
		<?php
					$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['fail']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:leftColumn}<?php
					}
				if(isset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['old'])) ${'leftColumn'} = $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']['old'];
				else unset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_1']);
				?>
		&#160;
	</div>

	<div class="middleColumn column">
		<?php
					if(!isset($this->variables['middleColumn']))
					{
						?>{iteration:middleColumn}<?php
						$this->variables['middleColumn'] = array();
						$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['fail'] = true;
					}
				if(isset(${'middleColumn'})) $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['old'] = ${'middleColumn'};
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['iteration'] = $this->variables['middleColumn'];
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['i'] = 1;
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['count'] = count($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['iteration']);
				foreach((array) $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['iteration'] as ${'middleColumn'})
				{
					if(!isset(${'middleColumn'}['first']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['i'] == 1) ${'middleColumn'}['first'] = true;
					if(!isset(${'middleColumn'}['last']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['i'] == $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['count']) ${'middleColumn'}['last'] = true;
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
						?> isRemoved<?php } ?>" data-module="<?php if(array_key_exists('module', (array) ${'middleColumn'})) { echo ${'middleColumn'}['module']; } else { ?>{$middleColumn->module}<?php } ?>" data-widget="<?php if(array_key_exists('widget', (array) ${'middleColumn'})) { echo ${'middleColumn'}['widget']; } else { ?>{$middleColumn->widget}<?php } ?>" data-title="<?php if(array_key_exists('title', (array) ${'middleColumn'})) { echo ${'middleColumn'}['title']; } else { ?>{$middleColumn->title}<?php } ?>"<?php
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
							<h3><?php if(array_key_exists('title', (array) ${'middleColumn'})) { echo ${'middleColumn'}['title']; } else { ?>{$middleColumn->title}<?php } ?></h3>
						</div>
						<div class="options" style="display: none;">
							<?php if(array_key_exists('msgWillBeEnabledOnSave', (array) $this->variables)) { echo $this->variables['msgWillBeEnabledOnSave']; } else { ?>{$msgWillBeEnabledOnSave}<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php if(!isset(${'middleColumn'}['hidden']) || count(${'middleColumn'}['hidden']) == 0 || ${'middleColumn'}['hidden'] == '' || ${'middleColumn'}['hidden'] === false): ?>
					<?php
				ob_start();
				?><?php if(array_key_exists('template', (array) ${'middleColumn'})) { echo ${'middleColumn'}['template']; } else { ?>{$middleColumn->template}<?php } ?><?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('template', (array) ${'middleColumn'})) { echo ${'middleColumn'}['template']; } else { ?>{$middleColumn->template}<?php } ?>}<?php
				}
?>
				<?php endif; ?>
			</div>
		<?php
					$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['i']++;
				}
					if(isset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['fail']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['fail'] == true)
					{
						?>{/iteration:middleColumn}<?php
					}
				if(isset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['old'])) ${'middleColumn'} = $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']['old'];
				else unset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_2']);
				?>
		&#160;
	</div>

	<div class="rightColumn column">
		<?php
					if(!isset($this->variables['rightColumn']))
					{
						?>{iteration:rightColumn}<?php
						$this->variables['rightColumn'] = array();
						$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['fail'] = true;
					}
				if(isset(${'rightColumn'})) $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['old'] = ${'rightColumn'};
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['iteration'] = $this->variables['rightColumn'];
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['i'] = 1;
				$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['count'] = count($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['iteration']);
				foreach((array) $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['iteration'] as ${'rightColumn'})
				{
					if(!isset(${'rightColumn'}['first']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['i'] == 1) ${'rightColumn'}['first'] = true;
					if(!isset(${'rightColumn'}['last']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['i'] == $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['count']) ${'rightColumn'}['last'] = true;
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
						?> isRemoved<?php } ?>" data-module="<?php if(array_key_exists('module', (array) ${'rightColumn'})) { echo ${'rightColumn'}['module']; } else { ?>{$rightColumn->module}<?php } ?>" data-widget="<?php if(array_key_exists('widget', (array) ${'rightColumn'})) { echo ${'rightColumn'}['widget']; } else { ?>{$rightColumn->widget}<?php } ?>" data-title="<?php if(array_key_exists('title', (array) ${'rightColumn'})) { echo ${'rightColumn'}['title']; } else { ?>{$rightColumn->title}<?php } ?>"<?php
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
							<h3><?php if(array_key_exists('title', (array) ${'rightColumn'})) { echo ${'rightColumn'}['title']; } else { ?>{$rightColumn->title}<?php } ?></h3>
						</div>
						<div class="options" style="display: none;">
							<?php if(array_key_exists('msgWillBeEnabledOnSave', (array) $this->variables)) { echo $this->variables['msgWillBeEnabledOnSave']; } else { ?>{$msgWillBeEnabledOnSave}<?php } ?>
						</div>
					</div>
				<?php } ?>
				<?php if(!isset(${'rightColumn'}['hidden']) || count(${'rightColumn'}['hidden']) == 0 || ${'rightColumn'}['hidden'] == '' || ${'rightColumn'}['hidden'] === false): ?>
					<?php
				ob_start();
				?><?php if(array_key_exists('template', (array) ${'rightColumn'})) { echo ${'rightColumn'}['template']; } else { ?>{$rightColumn->template}<?php } ?><?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('template', (array) ${'rightColumn'})) { echo ${'rightColumn'}['template']; } else { ?>{$rightColumn->template}<?php } ?>}<?php
				}
?>
				<?php endif; ?>
			</div>
		<?php
					$this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['i']++;
				}
					if(isset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['fail']) && $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['fail'] == true)
					{
						?>{/iteration:rightColumn}<?php
					}
				if(isset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['old'])) ${'rightColumn'} = $this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']['old'];
				else unset($this->iterations['093479ccf6a146d9ad94516c1614ce7f_Index.tpl.php_3']);
				?>
		&#160;
	</div>
</div>

<p>
	<small>
		<a href="#" id="editDashboard">
			<?php if(array_key_exists('msgEditYourDashboard', (array) $this->variables)) { echo $this->variables['msgEditYourDashboard']; } else { ?>{$msgEditYourDashboard}<?php } ?>
		</a>
	</small>
</p>

<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Dashboard/Layout/Templates/StructureEnd.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_MODULES_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_MODULES_PATH']; } else { ?>{$BACKEND_MODULES_PATH}<?php } ?>/Dashboard/Layout/Templates/StructureEnd.tpl}<?php
				}
?>
<?php
				ob_start();
				?><?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Backend/Modules/Dashboard/Layout/Templates');
				}
if($return === false)
				{
					?>{include:<?php if(array_key_exists('BACKEND_CORE_PATH', (array) $this->variables)) { echo $this->variables['BACKEND_CORE_PATH']; } else { ?>{$BACKEND_CORE_PATH}<?php } ?>/Layout/Templates/Footer.tpl}<?php
				}
?>
