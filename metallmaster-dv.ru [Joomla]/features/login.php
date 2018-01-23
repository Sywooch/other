<?php
/**
 * @package     gantry
 * @subpackage  features
 * @version    ${rt-gantry-j15 ver. 3.0.10. ColorStudio by http://www.7Studio.eu/} ${10.09.2010}
 * @author    RocketTheme http://www.rockettheme.com
 * @copyright   Copyright (C) 2007 - ${copyright_year} RocketTheme, LLC
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
 *
 * Gantry uses the Joomla Framework (http://www.joomla.org), a GNU/GPLv2 content management system
 *
 */

defined('JPATH_BASE') or die();

gantry_import('core.gantryfeature');

class GantryFeatureLogin extends GantryFeature {
    var $_feature_name = 'login';

  function render($position="") {
      ob_start();
      ?>
	  
    <div id="rt-login-button">
      <a href="#" class="login_button" rel="rokbox[215 300][module=rt-popup]">
        <span><?php $user = & JFactory::getUser(); if($user->guest) echo $this->get('text'); else{ echo $this->get('text1');} ?></span>
      </a>
    </div><div class="clear"></div>
    <?php
      return ob_get_clean();
  }
}

