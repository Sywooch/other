<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<p itemprop="breadcrumb">
	<?php if(array_key_exists('lblYouAreHere', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblYouAreHere']); } else { ?>{$lblYouAreHere|ucfirst}<?php } ?>:
	<?php
					if(!isset($this->variables['breadcrumb']))
					{
						?>{iteration:breadcrumb}<?php
						$this->variables['breadcrumb'] = array();
						$this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['fail'] = true;
					}
				if(isset(${'breadcrumb'})) $this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['old'] = ${'breadcrumb'};
				$this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['iteration'] = $this->variables['breadcrumb'];
				$this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['i'] = 1;
				$this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['count'] = count($this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['iteration']);
				foreach((array) $this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['iteration'] as ${'breadcrumb'})
				{
					if(!isset(${'breadcrumb'}['first']) && $this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['i'] == 1) ${'breadcrumb'}['first'] = true;
					if(!isset(${'breadcrumb'}['last']) && $this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['i'] == $this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['count']) ${'breadcrumb'}['last'] = true;
					if(isset(${'breadcrumb'}['formElements']) && is_array(${'breadcrumb'}['formElements']))
					{
						foreach(${'breadcrumb'}['formElements'] as $name => $object)
						{
							${'breadcrumb'}[$name] = $object->parse();
							${'breadcrumb'}[$name .'Error'] = (is_callable(array($object, 'getErrors')) && $object->getErrors() != '') ? '<span class="formError">' . $object->getErrors() .'</span>' : '';
						}
					} ?>
		<?php
					if(isset(${'breadcrumb'}['url']) && count(${'breadcrumb'}['url']) != 0 && ${'breadcrumb'}['url'] != '' && ${'breadcrumb'}['url'] !== false)
					{
						?><a href="<?php if(array_key_exists('url', (array) ${'breadcrumb'})) { echo ${'breadcrumb'}['url']; } else { ?>{$breadcrumb->url}<?php } ?>" title="<?php if(array_key_exists('title', (array) ${'breadcrumb'})) { echo ${'breadcrumb'}['title']; } else { ?>{$breadcrumb->title}<?php } ?>"><?php } ?><?php if(array_key_exists('title', (array) ${'breadcrumb'})) { echo ${'breadcrumb'}['title']; } else { ?>{$breadcrumb->title}<?php } ?><?php
					if(isset(${'breadcrumb'}['url']) && count(${'breadcrumb'}['url']) != 0 && ${'breadcrumb'}['url'] != '' && ${'breadcrumb'}['url'] !== false)
					{
						?></a><?php } ?>
		<?php if(!isset(${'breadcrumb'}['last']) || count(${'breadcrumb'}['last']) == 0 || ${'breadcrumb'}['last'] == '' || ${'breadcrumb'}['last'] === false): ?> › <?php endif; ?>
	<?php
					$this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['i']++;
				}
					if(isset($this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['fail']) && $this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['fail'] == true)
					{
						?>{/iteration:breadcrumb}<?php
					}
				if(isset($this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['old'])) ${'breadcrumb'} = $this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']['old'];
				else unset($this->iterations['71366dac086088bcd37eeaeaf4df9ccc_Breadcrumb.tpl.php_1']);
				?>
</p>