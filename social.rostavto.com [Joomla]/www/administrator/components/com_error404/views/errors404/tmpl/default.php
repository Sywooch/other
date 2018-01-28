<?php

// No direct access

defined('_JEXEC') or die('Restricted access');
$id_abonnes=$this->id_abonnes;
$errors=$this->errors;
$redirectActivated=$this->redirectActivated;
$error404Activated=$this->error404Activated;
// Must be logged in
		if ($id_abonnes < 1) {
			JError::raiseError( 403, JText::_('ALERTNONAUTH') );
			return;
		}
?>
<form action="index.php" method="post" name="adminForm">
<?php
echo "<br /><h1>".JTEXT::_("COM_ERROR404_TITRE_PLUGIN")."</h1>"; 		
echo "<p>".JTEXT::_("COM_ERROR404_PLUGIN_DESCRIPTION")."</p>";
echo "<p>".JTEXT::_("COM_ERROR404_PLUGIN_REDIRECT")." : ".$redirectActivated."</p>";
echo "<p>".JTEXT::_("COM_ERROR404_PLUGIN_ERROR404")." : ".$error404Activated."</p>";
echo "<h1>".JTEXT::_("COM_ERROR404_LISTE_ERREURS")."</h1>";
echo "<p>".JTEXT::_("COM_ERROR404_TEXTE_AVANT_TABLEAU")."</p>";
?>
<div class="width-60">

<table class="adminlist">
<thead>
<tr>
<th width="20">
    <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->errors ); ?>);" />
</th>
<th width="20">Id</th><th><?php echo JTEXT::_("COM_ERROR404_CHAINE");?></th><th width="20"><?php echo JTEXT::_("COM_ERROR404_TYPE");?></th>
</tr>
</thead>
<tbody>
<?php 
	$k=0;
	for ($i=0,$n=count($this->errors);$i<$n;$i++)
	{
		$row=& $this->errors[$i];
		$checked=JHTML::_('grid.id,',$i,$row->id_error404);
		$link = JRoute::_( 'index.php?option=com_error404&controller=error404&task=edit&cid[]='. $row->id_error404 );
		echo "<tr class=\"row$k\"><td>$checked</td><td>".$row->id_error404."</td><td><a href=\"".$link."\">".$row->chaine."</a></td><td>".$row->type."</td></tr>";
		$k=1-$k;	
	}
?>
</tbody>
</table>
</div>
<?php 
echo "<h1>".JTEXT::_("COM_ERROR404_PARAMETRES")."</h1>";
echo "<p>".JTEXT::_("COM_ERROR404_CLIQUER_PARAMETRES")."</p>";
?>

<input type="hidden" name="option" value="com_error404" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="error404" />
</form>
