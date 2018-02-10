<?php error_reporting(E_ALL | E_STRICT); ini_set('display_errors', 'On'); ?>
<ul>
	<?php
					if(isset($this->variables['widgetPagesNavigation']['previous']) && count($this->variables['widgetPagesNavigation']['previous']) != 0 && $this->variables['widgetPagesNavigation']['previous'] != '' && $this->variables['widgetPagesNavigation']['previous'] !== false)
					{
						?>
		<li class="previousLink">
			<a href="<?php if(isset($this->variables['widgetPagesNavigation']['previous']) && array_key_exists('url', (array) $this->variables['widgetPagesNavigation']['previous'])) { echo $this->variables['widgetPagesNavigation']['previous']['url']; } else { ?>{$widgetPagesNavigation.previous.url}<?php } ?>" rel="prev"><?php if(array_key_exists('lblPreviousPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblPreviousPage']); } else { ?>{$lblPreviousPage|ucfirst}<?php } ?>: <?php if(isset($this->variables['widgetPagesNavigation']['previous']) && array_key_exists('title', (array) $this->variables['widgetPagesNavigation']['previous'])) { echo $this->variables['widgetPagesNavigation']['previous']['title']; } else { ?>{$widgetPagesNavigation.previous.title}<?php } ?></a>
		</li>
	<?php } ?>

	<?php
					if(isset($this->variables['widgetPagesNavigation']['parent']) && count($this->variables['widgetPagesNavigation']['parent']) != 0 && $this->variables['widgetPagesNavigation']['parent'] != '' && $this->variables['widgetPagesNavigation']['parent'] !== false)
					{
						?>
		<li class="parentLink">
			<a href="<?php if(isset($this->variables['widgetPagesNavigation']['parent']) && array_key_exists('full_url', (array) $this->variables['widgetPagesNavigation']['parent'])) { echo $this->variables['widgetPagesNavigation']['parent']['full_url']; } else { ?>{$widgetPagesNavigation.parent.full_url}<?php } ?>" rel="prev"><?php if(array_key_exists('lblParentPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblParentPage']); } else { ?>{$lblParentPage|ucfirst}<?php } ?>: <?php if(isset($this->variables['widgetPagesNavigation']['parent']) && array_key_exists('title', (array) $this->variables['widgetPagesNavigation']['parent'])) { echo $this->variables['widgetPagesNavigation']['parent']['title']; } else { ?>{$widgetPagesNavigation.parent.title}<?php } ?></a>
		</li>
	<?php } ?>

	<?php
					if(isset($this->variables['widgetPagesNavigation']['next']) && count($this->variables['widgetPagesNavigation']['next']) != 0 && $this->variables['widgetPagesNavigation']['next'] != '' && $this->variables['widgetPagesNavigation']['next'] !== false)
					{
						?>
		<li class="nextLink">
			<a href="<?php if(isset($this->variables['widgetPagesNavigation']['next']) && array_key_exists('url', (array) $this->variables['widgetPagesNavigation']['next'])) { echo $this->variables['widgetPagesNavigation']['next']['url']; } else { ?>{$widgetPagesNavigation.next.url}<?php } ?>" rel="next"><?php if(array_key_exists('lblNextPage', (array) $this->variables)) { echo SpoonFilter::ucfirst($this->variables['lblNextPage']); } else { ?>{$lblNextPage|ucfirst}<?php } ?>: <?php if(isset($this->variables['widgetPagesNavigation']['next']) && array_key_exists('title', (array) $this->variables['widgetPagesNavigation']['next'])) { echo $this->variables['widgetPagesNavigation']['next']['title']; } else { ?>{$widgetPagesNavigation.next.title}<?php } ?></a>
		</li>
	<?php } ?>
</ul>