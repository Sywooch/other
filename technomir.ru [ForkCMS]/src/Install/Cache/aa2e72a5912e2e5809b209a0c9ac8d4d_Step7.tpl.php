<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php
				ob_start();
				?><?php echo $this->variables['PATH_WWW']; ?>/src/Install/Layout/Templates/Head.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates');
				}
?>

<h2>Installation complete</h2>
<p>Fork CMS is installed! You can now log in using:</p>

<table class="infoGrid">
	<tr>
		<th>Your e-mail</th>
		<td><?php echo $this->variables['email']; ?></td>
	</tr>
	<tr>
		<th>Your password</th>
		<td>
			<span id="plainPassword" class="hidden"><?php echo $this->variables['password']; ?></span>
			<span id="fakePassword">••••••••••••</span>
			<input type="checkbox" id="showPassword" name="showPassword" /> <label for="showPassword">show password</label>
		</td>
	</tr>
</table>

<div class="buttonHolder">
	<a class="button" href="../">View your new website</a>
	<a class="button" href="../private">Log in to Fork CMS</a>
</div>

<?php
					if(isset($this->variables['warnings']) && count($this->variables['warnings']) != 0 && $this->variables['warnings'] != '' && $this->variables['warnings'] !== false)
					{
						?>
	<div class="generalMessage infoMessage">
		<p><strong>There are some warnings for following module(s):</strong></p>
		<?php
				if(isset(${'warnings'})) $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['old'] = ${'warnings'};
				$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['iteration'] = $this->variables['warnings'];
				$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['i'] = 1;
				$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['count'] = count($this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['iteration'] as ${'warnings'})
				{
					if(!isset(${'warnings'}['first']) && $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['i'] == 1) ${'warnings'}['first'] = true;
					if(!isset(${'warnings'}['last']) && $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['i'] == $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['count']) ${'warnings'}['last'] = true;
					if(isset(${'warnings'}['formElements']) && is_array(${'warnings'}['formElements']))
					{
						foreach(${'warnings'}['formElements'] as $name => $object)
						{
							${'warnings'}[$name] = $object->parse();
							${'warnings'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
			<ul>
				<li>
					<strong><?php echo ${'warnings'}['module']; ?></strong>
					<ul>
						<?php
				if(isset(${'warnings'}['warnings'])) $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['old'] = ${'warnings'}['warnings'];
				$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['iteration'] = ${'warnings'}['warnings'];
				$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['i'] = 1;
				$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['count'] = count($this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['iteration']);
				foreach((array) $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['iteration'] as ${'warnings'}['warnings'])
				{
					if(!isset(${'warnings'}['warnings']['first']) && $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['i'] == 1) ${'warnings'}['warnings']['first'] = true;
					if(!isset(${'warnings'}['warnings']['last']) && $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['i'] == $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['count']) ${'warnings'}['warnings']['last'] = true;
					if(isset(${'warnings'}['warnings']['formElements']) && is_array(${'warnings'}['warnings']['formElements']))
					{
						foreach(${'warnings'}['warnings']['formElements'] as $name => $object)
						{
							${'warnings'}['warnings'][$name] = $object->parse();
							${'warnings'}['warnings'][$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
							<li>- <?php echo ${'warnings'}['warnings']['message']; ?></li>
						<?php
					$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['i']++;
				}
				if(isset($this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['old'])) ${'warnings'}['warnings'] = $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']['old'];
				else unset($this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_2']['warnings']);
				?>
					</ul>
				</li>
			</ul>
		<?php
					$this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['old'])) ${'warnings'} = $this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']['old'];
				else unset($this->iterations['aa2e72a5912e2e5809b209a0c9ac8d4d_Step7.tpl.php_1']);
				?>
	</div>
<?php } ?>

<?php
				ob_start();
				?><?php echo $this->variables['PATH_WWW']; ?>/src/Install/Layout/Templates/Foot.tpl<?php
				$include = eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';');
				if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates', $include);
				$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates');
				if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates', $include))
				{
					$return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Install/Layout/Templates');
				}
?>
