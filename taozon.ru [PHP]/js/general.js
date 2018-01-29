// Подсказка для поиска, храним значение в глобальной переменной при переключении востанавливаем значение.
var search_placeholder;

function checkIntValue(object) { 
    object.value = object.value.replace(/[^0-9]+/g,'');
}

function activateSearchCategory(cid, text){
    $('.dropdown.dropdown-search a').addClass('active');
    $('.search [name="cid"]').val(cid);

    $('.search .search-floating .selection span').text(text);
    $('.search .search-floating .selection span').attr('title', text);

    $(this).css('color', '#ED1C24');
    $('.dropdown.dropdown-search').hide();
}

function assignSearchCategoriesClick(){
    $('.dropdown.dropdown-search a').click(function() {
        $.each($('.dropdown.dropdown-search a'), function(i, e){
            $(e).css('font-weight', 'normal');
        });
        $(this).css('font-weight', 'bold');
        activateSearchCategory($(this).attr('cid'), $(this).text());
        return false;
    });
}

function DisableSubmit(id_button,form){

    $('#'+id_button).attr("disabled", "disabled");
    $('#'+id_button).css("color", "#999");
    $('#'+form).submit();
}

function AnableSubmit(id_button,form){
    $('#'+id_button).removeAttr("disabled");
    $('#'+id_button).css("color", "#fff");    
}

/**
 * escape через jquery
**/
var escapeData = function (text) {
    var decoded = jQuery('<div />').text(text).html();
    decoded = decoded.replace(/'/g, '&#039;').replace(/\"/g, '&quot;');
    return decoded;
}

var decodeData = function (text) {
    return jQuery('<div />').html(text).text();
}


$(function(){
    var $all = $('.allplace');
    var $searchDropdown = $('.field .dropdown');
    var $drop = $('.uluserbar').next('.dropdown');
    var $cat = $('.category');

    $('#search-submit').click(function(){
        $(this).closest('form').submit();
        return false;
    });
    // При клике на поисковую строку убираем надпись подсказку и оставляем введенное юзером
    $('#full_search').click(function(){
       if( $(this).val() != '' ){ return false; }
        search_placeholder = $(this).attr('placeholder');
        $(this).attr('placeholder','');
        return false;
    });

    // При уходе из поисковой строки, если ничего не ввели то возвращаем подсказку
    $("#full_search").focusout(function() {
        if ( $(this).val() == '' && search_placeholder != '' ) {
            $(this).attr('placeholder', search_placeholder );
        }
    });
    
    
    $all.on('mouseover', function(){
        $(this).find('span').css("width", "auto");
    });
    $all.on('mouseout', function(){
        $(this).find('span').css("width", "30px");
    });
    
    $all.on('click', function(e){
        $(document).unbind('click.myEvent');
        if($drop+':visible'){ $cat.removeClass('active'); $drop.hide(); }
        e.preventDefault();

        $searchDropdown.toggle('show',function(){
          if($all.hasClass('active')){
            $all.removeClass('active');
          }
          else
          {
            $all.addClass('active');
          }
        });

        var firstClick = true;
        $(document).bind('click.myEvent', function(e) {
            if (!firstClick && $(e.target).closest('.selection-search').length == 0) {
                $searchDropdown.hide();
                $all.removeClass('active');
                $(document).unbind('click.myEvent');
            }
            firstClick = false;
        });
    });
    $searchDropdown.click(function(e){
        e.stopPropagation();
    });

    var $langmenu = $('.menu-lang');
    var $langmenu_item = $('a.lang', $langmenu);
    var $langbutton = $('.lang.arrow');
    $langbutton.on('click', function(e){
        e.preventDefault();
        $langmenu.toggle();
    })

    $langmenu_item.on('click', function(e){
        e.preventDefault();
            $('#lang').val( $(this).find('i').attr('class') );
            $('#lang').closest('form').submit();
    })

    $langmenu.bind('mouseleave', function(){
        $(this).hide();
    });

    $('.delete').click(function(){
        if($(this).hasClass('go'))
            return true;
        $(this).next().find('input').removeAttr('checked');
        $(this).closest('form').submit();
        return false;
    });

    $('.more-options').on('click', function(e){

        var parent = $(this).parent().parent();

        if(parent.hasClass('open'))
        { parent.removeClass('open') }
        else
        { parent.addClass('open') }

        e.preventDefault();
    });

    $('.js-form-send').on('click', function(e){
        $(this).closest('form').submit();
        e.preventDefault();
    })

    $('.tabs1 li a').click(function(){
        return true;
    });

    $('#add-vendor-to-favourites').click(function(){

        showOverlay();
        var id = $(this).attr('vendorId');
        $.ajax({
            url: 'index.php?p=add_to_favourite_vendors',
            type: 'POST',
            data: {id: id}
        })
            .success(function(data){
                hideOverlay();
                $().toastmessage('showToast', {'text': langs.vendor_added_to_favourites, 'stayTime': 6000, 'type': 'success'});
                $('#add-vendor-to-favourites').hide();
                $('#vendor-added-to-favourites').show();
                if (data.vendors && data.vendors.elements) {
                	var vendorId = false;
                	for ( var i in data.vendors.elements) {
                		var vendor = data.vendors.elements[i];
                		if (vendor.itemid == id) {
                			vendorId = vendor.id;
                			break;
                		}
                	}
                	if (vendorId) {
                		$('#vendor-added-to-favourites').attr('itemId', vendorId);
                	}
                }
                
            })
            .error(function(jqXHR, textStatus, errorThrown){
                hideOverlay();
                if (errorThrown=='NotAvailable') {
                    error = NotAvailableError;
                } else {
                    error = errorThrown;
                }
                $().toastmessage('showToast', {'text': error, 'stayTime': 6000, 'type': 'error'});
            });
        return false;
    });
    
    $('#vendor-added-to-favourites').click(function(){

        showOverlay();
        var id = $(this).attr('itemid');
        $.ajax({
            url: 'index.php?p=delete_from_favourite_vendors',
            type: 'GET',
            data: {id: id}
        })
            .success(function(data){
                hideOverlay();
                $().toastmessage('showToast', {'text': langs.vendor_removed_from_favourites, 'stayTime': 6000, 'type': 'success'});
                $('#add-vendor-to-favourites').show();
                $('#vendor-added-to-favourites').hide();
            })
            .error(function(jqXHR, textStatus, errorThrown){
                hideOverlay();
                if (errorThrown=='NotAvailable') {
                    error = NotAvailableError;
                } else {
                    error = errorThrown;
                }
                $().toastmessage('showToast', {'text': error, 'stayTime': 6000, 'type': 'error'});
            });
        return false;
    });


    $(".input_numeric_only").keydown(function(event) {
        // Разрешаем: backspace, delete, tab и escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
             // Разрешаем: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
             // Разрешаем: home, end, влево, вправо
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // Ничего не делаем
                 return;
        }
        else {
            // Обеждаемся, что это цифра, и останавливаем событие keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    $('select#profiles_select').live('change', function() {
        $('.profile-data').hide();
        $('#profile-' + $(this).val()).show();
    });

    $('select#profiles_select_step3').live('change', function() {
        var profile_id = $(this).val();
        render_delivery_profile(profile_id);
    });

    $('input#delete-delivery-profile').click(function(e) {
        e.preventDefault();
        var profile_id = $(this).attr('data-profile-id');
        confirm_delete_profile(profile_id);
    });

    $('#cancel_new_profile').live('click', function(e) {
        e.preventDefault();
        location.href = 'index.php?p=profile&mode=delivery';
    });

    $('#shopreviewCommentForm').submit(function(ev) {
        $('input[type=submit]', this).attr('disabled', 'disabled');
    });

    $('.review-sented').delay(3000).hide('slow');
    

    $('.confirm-operation').click(function(){
        var message = $(this).attr('data-message');
        var title = $(this).attr('data-title');
        var yes = trans.get('yes');
        var no = trans.get('no');
        var that = this;

        var div = $('<div></div>')
            .attr('title', title)
            .append(
                $('<div></div>').html(message)
            );
        $('body').append(div);

        var onSuccess = $(this).attr('onSuccess');
        buttons = {};
        buttons[yes] = function(){
            eval(onSuccess);
            return true;
        };
        buttons[no] = function(){
            div.dialog('close');
            return false;
        };
        div.dialog({
            autoOpen:false,
            modal: true,
            width: 350,
            buttons: buttons
        });
        div.dialog('open');

        return false;
    });

    $('body').livequery('.numeric-field', function (element) {
        $(element).numeric();
    });
    $('body').livequery('.price-field', function (element) {
        $(element).numeric({allow:"."});
    });
});


function limitText(field, maxChar) {
    var ref = $(field),
        val = ref.val();
    if (val.length >= maxChar) {
        ref.val(function() {
            return val.substr(0, maxChar);       
        });
    }
}


function init_delivery_profile () {
    render_delivery_profile($('select#profiles_select_step3').val());
}

function render_delivery_profile (id) {
    var profile = '';
    $.each(profiles, function(i, item){
        if (item.Id == id) {
            profile = item;
        }
    });

    if (profile) {
        $('#LastName').val(profile.LastName);
        $('#FirstName').val(profile.FirstName);
        $('#MiddleName').val(profile.MiddleName);
        if ($('#PassportNumber').length) $('#PassportNumber').val(profile.PassportNumber);
        if ($('#RegistrationAddress').length) $('#RegistrationAddress').val(profile.RegistrationAddress);
        $('#PostalCode').val(profile.PostalCode);
        $('#Region').val(profile.Region);
        $('#City').val(profile.City);
        $('#Address').val(profile.Address);
        $('#Phone').val(profile.Phone);
        $('#ProfileId').val(profile.Id);

        $("#Country option").removeAttr('selected');
        $("#Country option[value='" + profile.CountryCode + "']").attr("selected", "selected");
        
        $("#Country").trigger('change');
    }
}

function confirm_delete_profile(profile_id) {
    $("#confirm-profile-dialog-form").dialog("open");
    $("#confirm-profile-dialog-form #error").hide();
    $("#confirm-profile-dialog-form").find('input[name=profile_id]').val(profile_id);
}


function ChechSupportForm(){
    var can = true;
    var str = $('#Subject').val();
    str = str.replace(/\s/g, '');
    if (str.length==0) {
        $('#Subject').css('border-color','red');
        can = false;
    }
    str = $('#Text').val();
    str = str.replace(/\s/g, '');
    if (str.length==0) {
        $('#Text').css('border-color','red');
        can = false;
    }
    str = $('#CategoryId').val();
    str = str.replace(/\s/g, '');
    if (str.length==0) {
        $('#CategoryId').css('border-color','red');
        can = false;
    }
    return can;
}

function ChechSupportChat(){
    var can = true;

    var str = $('#Text').val();
    str = str.replace(/\s/g, '');
    if (str.length==0) {
        $('#Text').css('border-color','red');
        can = false;
    }
    return can;
}

$(function() {
    $( "#dialog-error:ui-dialog" ).dialog( "destroy" );

    $( "#dialog-error" ).dialog({
        autoOpen: false,
        width:280,
        height:160,
        modal: true,
        buttons: {
            "Ok": function() {
                $(this).dialog("close");
            }
        }
    });
});

function show_error(data) {
    $('#dialog-error .error').html(data);
    $('#dialog-error').dialog('open');
}
