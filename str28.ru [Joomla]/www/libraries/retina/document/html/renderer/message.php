<?php


defined('RPATH_PLATFORM') or die;


class JDocumentRendererMessage extends JDocumentRenderer
{
	/**
	 * Renders the error stack and returns the results as a string
	 *
	 * @param   string  $name     Not used.
	 * @param   array   $params   Associative array of values
	 * @param   string  $content  Not used.
	 *
	 * @return  string  The output of the script
	 *
	 * @since   11.1
	 */
	public function render($name, $params = array (), $content = null)
	{
		// Initialise variables.
		$buffer = null;
		$lists = null;

		// Get the message queue
		$messages = JFactory::getApplication()->getMessageQueue();

		// Build the sorted message list
		if (is_array($messages) && !empty($messages))
		{
			foreach ($messages as $msg)
			{
				if (isset($msg['type']) && isset($msg['message']))
				{
					$lists[$msg['type']][] = $msg['message'];
				}
			}
		}

		// Build the return string
		$buffer .= "\n
		<div id=\"main-message-div-fixed\" style=\"position:fixed !important;  width:500px !important;
		z-index:11111111111 !important; float:left !important; left:50% !important; margin-left:-250px !important;
		margin-top:0px !important; cursor:pointer !important;  background-color:black !important\" 
		onclick=\"\">";

		// If messages exist render them
		if (is_array($lists))
		{
			$buffer .= "\n<dl id=\"main-message\" style=\"background-color:black !important; 
		border:2px white solid !important; height:60px !important;  \" >";
			foreach ($lists as $type => $msgs)
			{
				if (count($msgs))
				{
					$buffer .= "\n<dt class=\"" . strtolower($type) . "\">" . RText::_($type) . "</dt>";
					$buffer .= "\n<dd class=\"" . strtolower($type) . " message\"  style=\"background-color:black !important; 
					color:green !important\">";
					$buffer .= "\n\t<ul>";
					foreach ($msgs as $msg)
					{
						$buffer .= "\n\t\t<li style=\"color:green !important\">" . $msg . "</li>";
					}
					$buffer .= "\n\t</ul>";
					$buffer .= "\n</dd>";
					break;
				}
			}
			$buffer .= "\n</dl>";
		}

		$buffer .= "\n</div>";
		return $buffer;
	}
}
