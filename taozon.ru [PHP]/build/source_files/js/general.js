$(function(){
	var $all = $('.allplace');
    var $searchDropdown = $('.field .dropdown');
	var $drop = $('.uluserbar').next('.dropdown');
	var $cat = $('.category');

    setInterval('$.ajax({url:"index.php?p=webcron",async:true});', 5*1000*60);
    
    $('#search-submit').click(function(){
        $(this).closest('form').submit();
        return false;
    });

    $all.on('click', function(e){
		$(document).unbind('click.myEvent');
		if($drop+':visible'){ $cat.removeClass('active'); $drop.hide(); }
        e.preventDefault();
        $searchDropdown.toggle();
        var firstClick = true;
        $(document).bind('click.myEvent', function(e) {
            if (!firstClick && $(e.target).closest('.selection-search').length == 0) {
                $searchDropdown.hide();
                $(document).unbind('click.myEvent');
            }
            firstClick = false;
        });
    })
    $searchDropdown.click(function(e){
        e.stopPropagation();
    })

	$('.dropdown.dropdown-search a').click(function(){
        $('.dropdown.dropdown-search a').css('color', '#666');
        $('form.search [name="cid"]').val($(this).attr('cid'));
		
		$('form.search .search-floating .selection span').text($(this).text());

		
        $(this).css('color', '#ED1C24');
        $('.dropdown.dropdown-search').hide();
        return false;
    });
	
    $('.delete').click(function(){
        $(this).next().find('input').removeAttr('checked');
        $(this).closest('form').submit();
        return false;
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
	})

        var isAllTypesChecked = $('[name="filters[StuffStatus]"]:first').attr('checked');
        var countFilters = $('li.opening input:checked').length;
        
        if((countFilters > 0 && !isAllTypesChecked) || (countFilters > 1)){
            $('#active-search-prop').show();
        }
        
        $('.i.delete').live('click', function(){
            if(!$(this).hasClass('delete-brand-fiter')){
                var id=$(this).attr('href');
                $('#'+id).attr('name', '');
                $('#filterform').submit();
                return false;
            }
        });
        
        $('.show-prop').live('click', function(){
            $(this).parent().prev().show();
            $(this).html('<i class="i arrowright"></i><span>Скрыть варианты</span>');
            $(this).removeClass('show-prop').addClass('hide-prop');
            return false;
        });
        
        $('.hide-prop').live('click', function(){
            $(this).parent().prev().hide();
            $(this).html('<i class="i arrowright"></i><span>Еще варианты</span>');
            $(this).removeClass('hide-prop').addClass('show-prop');
            return false;
        });
        
        $('.tabs1 li a').click(function(){
            return true;
        });

    $('#add-vendor-to-favourites').click(function(){
        showOverlay();
        var id = $(this).attr('vendorId');
        $.ajax({
            url: 'index.php',
            data: {p: 'add_to_favourite_vendors', id: id}
        })
            .success(function(){
                hideOverlay();
                $("#basketinfo").html(langs.vendor_added_to_favourites);
                $("#dialog-form").dialog("open");
                $('#add-vendor-to-favourites').hide();
            })
            .error(function(jqXHR, textStatus, errorThrown){
                hideOverlay();
                $("#basketinfo").html(errorThrown);
                $("#dialog-form").dialog("open");
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
});