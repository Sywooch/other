<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.html.pane');
$pane =& JPane::getInstance('sliders', array('startOffset'=>0));
?>
<form action="index.php" method="post" name="adminForm" id="adminForm">
<?php 
echo $pane->startPane( 'pane' );
echo $pane->startPanel( 'Liste des erreurs 404', 'panel1' );
echo JTEXT::_("COM_ERROR404_INTRO_STATS");?>
<table class="adminlist">
<thead>
<tr>
<th width="20">Id</th><th>Referrer</th><th>URI</th><th>User Agent</th><th>IP</th>
</tr>
</thead>
<tbody>
<?php 
	$k=0;
	for ($i=0,$n=count($this->error);$i<$n;$i++)
	{
		$row=& $this->error[$i];
		echo "<tr class=\"row$k\"><td>$row->id_error404_stats</td><td>".$row->referrer."</td><td>".$row->uri."</a></td><td>".$row->useragent."</td><td>".$row->ip."</tr>";
		$k=1-$k;	
	}
?>
</tbody>
<tfoot>
    <tr>
      <td colspan="5"><?php echo $this->pagination->getListFooter(); ?></td>
    </tr>
  </tfoot>

</table>
<?php echo $pane->endPanel(); ?>
<br />
<?php echo "<h1>".JTEXT::_("COM_ERROR404_CHOISIR_STATS")."</h1>";
//<br />
//<div class='col'><div class='width-45'>
//<div class="padding">
echo $pane->startPanel( 'Top 10 des URI', 'panel2' );
//<p>Top 10 des URI :</p>
?>
<table class="adminlist">
<thead>
<tr>
<th>URI</th><th>Total</th>
</tr>
</thead>
<tbody>
<?php 
foreach ($this->top10uri as $value)
{
	echo "<tr><td>".$value->uri."</td><td>".$value->total."</td></tr>";
}
?>
</tbody>
</table>
<?php echo $pane->endPanel();
//</div></div></div>
//<div class="col"><div class="width-45"><div class="padding">
echo $pane->startPanel( 'Top 10 des User Agent', 'panel3' );

//<p>Top 10 des User Agent :</p>
?>
<table class="adminlist">
<thead>
<tr>
<th>User Agent</th><th>Total</th>
</tr>
</thead>
<tbody>
<?php 
foreach ($this->top15ua as $value)
{
	echo "<tr><td>".$value->useragent."</td><td>".$value->total."</td></tr>";
}
?>
</tbody>
</table>
<?php echo $pane->endPanel();
echo $pane->endPane();

//</div></div></div>
?>
<input type="hidden" name="option" value="com_error404" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="error404" />
<input type="hidden" name="view" value="stats" />
</form>
 

