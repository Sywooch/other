<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>


<?php if(isset($this->variables['widgetContentBlocks']) && array_key_exists('text', (array) $this->variables['widgetContentBlocks'])) { echo $this->variables['widgetContentBlocks']['text']; } else { ?>{$widgetContentBlocks.text}<?php } ?>