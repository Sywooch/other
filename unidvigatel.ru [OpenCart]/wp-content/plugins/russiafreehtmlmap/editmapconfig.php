<?php

?>
<script>
    var focus_el;
    /*tinyMCE.init({
        mode:"none",
        theme:"advanced",
        theme_advanced_buttons1 : "bold,italic,fontsizeselect,cut,copy,paste,outdent,indent,undo,redo,link,unlink,anchor,image,cleanup,code,forecolor,backcolor",
        theme_advanced_buttons2 : "",
        theme_advanced_buttons3 : "",
        theme_advanced_buttons4 : ""
    });*/

    jQuery(function() {
        jQuery( "#tabs-settings" ).tabs();

        jQuery('.color').each(function(){

            jQuery(this).ColorPicker({
                color: '#'+this.value,
                onShow: function (colpkr) {

                    //jQuery(colpkr).offset({top:0, left:200});
                    jQuery(colpkr).fadeIn(500);
                    return false;
                },
                onHide: function (colpkr) {
                    jQuery(colpkr).fadeOut(500);
                    return false;
                },
                onChange: function (hsb, hex, rgb) {
                    jQuery(focus_el).css('background-color', '#' + hex).css('color', '#' + (16777215-parseInt(hex,16)).toString(16)).val(hex);
                }
            });
            jQuery(this).bind('focus', function(){
                focus_el=this;
            });

        });

        jQuery('input:radio').click(function(){
            //alert(jQuery(this).attr('id'));
            var el_id = jQuery(this).attr('id').substring(1);
            if(jQuery(this).attr('id').charAt(0)=='n'){
                jQuery("#URL"+el_id).attr("value", "");
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='d'){
                jQuery("#URL"+el_id).attr("value", "#");
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='o'){
                jQuery("#URL"+el_id).attr("value", "http://");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeIn(0);
                jQuery("#stateDescr"+el_id).fadeOut(0);
            }
            else if(jQuery(this).attr('id').charAt(0)=='m'){
                jQuery("#URL"+el_id).attr("value", "javascript:set_text("+el_id+");");
                //jQuery("#URL"+el_id).attr("readonly", false);
                jQuery("#stateURL"+el_id).fadeOut(0);
                jQuery("#stateDescr"+el_id).fadeIn(0);
            }
        });
        jQuery('#a1').click(function(){
            jQuery("#save_btn").fadeIn(0);
        });
        jQuery('#a2').click(function(){
            jQuery("#save_btn").fadeIn(0);
        });
        jQuery('#a3').click(function(){
            jQuery("#save_btn").fadeOut(0);
        });
        jQuery('#a4').click(function(){
            jQuery("#save_btn").fadeOut(0);
        });

        jQuery('.tipsy-q').tipsy({gravity: 'w'}).css('cursor', 'default');

    });


</script>

<div class="main_div">
<form method="post" action="" id="edit_form">
<div id="tabs-settings">
<ul>
    <li><a id="a1" href="#tabs-1">General Settings</a></li>
    <li><a id="a2" href="#tabs-2">States Settings</a></li>
    <li><a id="a3" href="#tabs-3">Revisions</a></li>
    <li><a id="a4" href="#tabs-4">Layers</a></li>
</ul>
<div class="tab-text" id="tabs-1">
1
</div>
<div class="tab-text" id="tabs-2">
2
</div>
<div class="tab-text" id="tabs-3">
3
</div>
<div class="tab-text" id="tabs-4">
4
</div>

<input class="btn primary" id="save_btn" name="subm" type="submit" value="Save" />
</div>
</form>
</div>