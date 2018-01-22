<?php
/**
 * @version		2.6.x
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.net
 * @copyright	Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

$app = JFactory::getApplication();
$template = $app->getTemplate('template')->template;
$doc = JFactory::getDocument();
$doc->addStyleSheet($this->baseurl . '/templates/' . $template . '/css/photo.css');
$doc->addScript($this->baseurl . '/templates/' . $template . '/js/photo.js');

echo '<script src="'.$this->baseurl . '/templates/' . $template . '/js/jquery.cycle2.carousel2.js'.'"></script>';

$extraFields = new stdClass();
if($this->item->extra_fields) {
    foreach ($this->item->extra_fields as $extraField) {
        $alias = $extraField->alias;
        $extraFields->$alias = new stdClass();
        $extraFields->$alias = $extraField;
    }
}
?>

<style type="text/css">
.djslider-loader{
display:none;	
}
</style>

<div class="photocontent-top">
    <div class="leftblock">
        <div class="introtext">
           <h2><?php echo $this->item->title; ?></h2>
            <?php echo $this->item->introtext; ?>
        </div>

        <div class="btnblock">
            <span class="point">
                <?php echo $extraFields->point->value;?>
            </span>

            <span class="date"><a><?php echo str_replace(" ", ".", JHTML::_('date', $this->item->created , "d m Y")); ?></a></span>
        </div>
        <!--<h3>
            <?php echo $this->item->title; ?>
        </h3>-->
    </div>
    <div class="rightblock">
        <img src="<?php echo $this->item->imageXLarge; ?>" alt=""/>
        <div class="bg" style="background: url('<?php echo $this->item->imageXLarge; ?>')"></div>
    </div>




    <!--<div class="scrollbanners" data-cycle-fx=carousel2 data-cycle-timeout=0 data-allow-wrap=false
         data-cycle-next=".next"
         data-cycle-prev=".prev"
         >
        <?php $i = 0; foreach($gallery as $count=>$photo): ?>
            <div>
                <a>
                    <img class="sigProImg" src="<?php echo $photo->thumbImageFilePath; ?>">
                </a>

                <div class="buttons">
                    <a href="<?php echo $photo->sourceImageFilePath; ?>" class="sigProLink<?php echo $extraClass; ?>"
                       rel="<?php echo $relName; ?>[gallery<?php echo $gal_id; ?>]"
                       title="<?php echo $photo->downloadLink; ?>"
                       target="_blank"<?php echo $customLinkAttributes; ?>></a>
                    <a href=# class="prev">&lt;&lt; Prev </a>
                    <a href=# class="next"> Next &gt;&gt; </a>
                    <a href=# onclick="jQuery('.scrollbanners').cycle('goto', <?php echo $i++; ?>); return false;"
                       class="select"></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>-->
</div>

<div class="photocontent-center <?php if( count(JModuleHelper::getModules('rightmenu')) ) echo "rightmenu" ?>">
    <span class="back"><a href="/" onclick="window.history.back();" >Вернуться</a></span>
</div>

<div class="photocontent-bottom">

    <table border="0" cellspacing="0" width="100%">
        <tr>
            <td class="banner">
                <div class="photobanner left">
                    <?php
                    $module = JModuleHelper::getModules('photobanner-left');
                    $attribs['style'] = 'none';
                    echo JModuleHelper::renderModule( $module[0], $attribs );
                    ?>
                </div>
            </td>
            <td>
                <div id="k2Container" class="itemListView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
                    <!-- Item list -->
                    <div class="itemList">
                        <!-- Leading items -->
                        <div id="itemListLeading">
                            <?php echo $this->item->gallery;?>
                            <div class="clr"></div>
                        </div>
                    </div>
                </div>
            </td>
            <td class="banner">
                <div class="photobanner right <?php if( count(JModuleHelper::getModules('rightmenu')) ) echo "rightmenu" ?>">
                    <?php
                    $module = JModuleHelper::getModules('photobanner-right');
                    $attribs['style'] = 'none';
                    echo JModuleHelper::renderModule( $module[0], $attribs );
                    ?>
                </div>
            </td>
        </tr>
    </table>

</div>