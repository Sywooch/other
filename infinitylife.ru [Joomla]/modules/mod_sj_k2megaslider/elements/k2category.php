<?php
/*------------------------------------------------------------------------
 # Sj K2 Mega Slider  - Version 1.1
 # Copyright (C) 2011 SmartAddons.Com. All Rights Reserved.
 # @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 # Author: SmartAddons.Com
 # Websites: http://www.smartaddons.com/
 -------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

if((K2_JVERSION=='16') || (K2_JVERSION=='25')){
    jimport('joomla.form.formfield');
    class JFormFieldK2category extends JFormField {

        var    $type = 'k2category';

        function getInput(){
            return JElementK2category::fetchElement($this->name, $this->value, $this->element, $this->options['control']);
        }
    }
}

jimport('joomla.html.parameter.element');

class JElementK2category extends JElement
{

    var    $_name = 'k2category';

    function fetchElement($name, $value, &$node, $control_name){
      
        $db = &JFactory::getDBO();
        $query = 'SELECT m.* FROM #__k2_categories m WHERE published=1 AND trash = 0 ORDER BY parent, ordering';
        $db->setQuery( $query );
        $mitems = $db->loadObjectList();
        $children = array();
        if ($mitems){
            foreach ( $mitems as $v ){
               if((K2_JVERSION=='16') || (K2_JVERSION=='25')){
                    $v->title = $v->name;
                    $v->parent_id = $v->parent;
                }
                $pt = $v->parent;
                $list = @$children[$pt] ? $children[$pt] : array();
                array_push( $list, $v );
                $children[$pt] = $list;
            }
        }
        $list = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
       
        $mitems = array();

        $mitems[] = JHTML::_('select.option', '0', JText::_('All Categories'));
        foreach ( $list as $item ) {
            $item->treename = JString::str_ireplace('&#160;', '- ', $item->treename);
            $mitems[] = JHTML::_('select.option',  $item->id, '   '.$item->treename );
        }
      
        if((K2_JVERSION=='16') || (K2_JVERSION=='25')){
            $fieldName = $name.'[]';
        }
        else {
            $fieldName = $control_name.'['.$name.'][]';
        }
      
        $output= JHTML::_('select.genericlist',  $mitems, $fieldName, 'class="inputbox" style="width:60%;" multiple="multiple" size="10"', 'value', 'text', $value );
        return $output;
    }
}
