/**
 * Created by GSU on 26.11.2016.
 */
$(window).on("load", function () {

    var bxajaxid = $("[name='bxajaxid']").attr("id");
    var bxajaxidValue = $("[name='bxajaxid']").val();

    var basketForm = top.BX(bxajaxid).form;
    BX.ajax.submitComponentForm(basketForm, 'comp_'+bxajaxidValue, true);
    BX.submit(basketForm);
 
});

BX.addCustomEvent('onAjaxSuccess', function(){
    setTimeout(function () {


        var bxajaxid = $("[name='bxajaxid']").attr("id");
        var bxajaxidValue = $("[name='bxajaxid']").val();



        function _processform_8BACKi(){

            var obForm = top.BX(bxajaxid).form;
            top.BX.bind(obForm, 'submit', function() {

                BX.ajax.submitComponentForm(this, 'comp_'+bxajaxidValue, true);
            });
            top.BX.removeCustomEvent('onAjaxSuccess', _processform_8BACKi);
        }
        if (top.BX(bxajaxid))
            _processform_8BACKi();
        else
            top.BX.addCustomEvent('onAjaxSuccess', _processform_8BACKi);




    }, 300);

});