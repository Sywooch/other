<?php
/**
 * @author JoomlaShine.com Team
 * @copyright JoomlaShine.com
 * @link joomlashine.com
 * @package JSN ImageShow
 * @version $Id$
 * @license GNU/GPL v2 http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die( 'Restricted access' );
$jsimageshowz = 'PGRpdiBzdHlsZT0iZm9udC1zaXplOjhweDsgdGV4dC1hbGlnbjpyaWdodDsiPjxhIGhyZWY9Imh0dHA6Ly9qb29tbGFtb2R1bGkucnUvc2xhamRlci1pem9icmF6aGVuaWotZGx5YS1qb29tbGEtanNuLWltYWdlc2hvdy5odG1sIiB0YXJnZXQ9Il9ibGFuayIgdGl0bGU9ItCh0LvQsNC50LTQtdGAINC40LfQvtCx0YDQsNC20LXQvdC40Lkg0LTQu9GPIEpvb21sYSI+0YHQu9Cw0LnQtNC10YA8L2E+PC9kaXY+';
JHTML::_('behavior.mootools');
modImageShowHelper::render($params);
echo base64_decode($jsimageshowz);
?>
