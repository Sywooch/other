<?php error_reporting(0); ini_set('display_errors', 'Off'); ?>
<?php $includes = array();
                ob_start();
                ?>/Core/Layout/Templates/Mails/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/bootstrap//Core/Layout/Templates/Mails/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend//Core/Layout/Templates/Mails/Header.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails');
                }
?>

<h2><?php echo $this->variables['SITE_TITLE']; ?>: <?php echo sprintf($this->variables['msgFormBuilderSubject'], $this->variables['name']); ?></h2>
<hr/>

<h3><?php echo SpoonFilter::ucfirst($this->variables['lblSenderInformation']); ?></h3>
<p>
  <strong><?php echo SpoonFilter::ucfirst($this->variables['lblSentOn']); ?>:</strong><br/>
  <?php echo SpoonTemplateModifiers::date($this->variables['sentOn'], $this->variables['dateFormatLong'], $this->variables['LANGUAGE']); ?>
</p>

<h3><?php echo SpoonFilter::ucfirst($this->variables['lblContent']); ?></h3>
<?php
				if(isset(${'fields'})) $this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['old'] = ${'fields'};
				$this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['iteration'] = $this->variables['fields'];
				$this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['i'] = 1;
				$this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['count'] = count($this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['iteration'] as ${'fields'})
				{
					if(!isset(${'fields'}['first']) && $this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['i'] == 1) ${'fields'}['first'] = true;
					if(!isset(${'fields'}['last']) && $this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['i'] == $this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['count']) ${'fields'}['last'] = true;
					if(isset(${'fields'}['formElements']) && is_array(${'fields'}['formElements']))
					{
						foreach(${'fields'}['formElements'] as $name => $object)
						{
							${'fields'}[$name] = $object->parse();
							${'fields'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
  <p><strong><?php echo ${'fields'}['label']; ?>:</strong><br/> <?php echo ${'fields'}['value']; ?></p>
<?php
					$this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['i']++;
				}
				if(isset($this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['old'])) ${'fields'} = $this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']['old'];
				else unset($this->iterations['1d6626107e1b24d3434ecb836454ee76_Form.tpl.php_1']);
				?>

<?php $includes = array();
                ob_start();
                ?>/Core/Layout/Templates/Mails/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend/Themes/bootstrap//Core/Layout/Templates/Mails/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                ob_start();
                ?>/home/segaz/domains/techno-mir.net/public_html/app/../src/Frontend//Core/Layout/Templates/Mails/Footer.tpl<?php
                $includes[] = str_replace('//', '/', eval('return \'' . str_replace('\'', '\\\'', ob_get_clean()) .'\';'));
                foreach($includes as $include) if(@file_exists($include) && is_file($include)) break;
                if($this->getForceCompile() || !file_exists($this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails'))) $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails', $include);
                $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails');
                if($return === false && $this->compile('/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails', $include)) {
                    $return = @include $this->getCompileDirectory() .'/' . $this->getCompileName($include, '/home/segaz/domains/techno-mir.net/public_html/src/Frontend/Modules/FormBuilder/Layout/Templates/Mails');
                }
?>
