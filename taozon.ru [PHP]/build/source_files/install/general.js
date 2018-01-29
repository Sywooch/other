$(function(){
    $('#search-submit').click(function(){
        $(this).closest('form').submit();
        return false;
    });
    var $categories = $('.dropdown.dropdown-main .bitem, .dropdown.dropdown-inner .bitem').clone();

	$('.dropdown.dropdown-search a').click(function(){
        $('.dropdown.dropdown-search a').css('color', '#666');
        $('form.search [name="cid"]').val($(this).attr('cid'));
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
    $('.lang').click(function(e){
        e.preventDefault();
        $langmenu.toggle();
        if(!$(this).hasClass('arrow')){
            $('#lang').val( $(this).find('i').attr('class') );
            $('#lang').closest('form').submit();
        }
    });
    $('.lang').click(function(e){
            e.stopPropagation();
    })
    
        var isAllTypesChecked = $('[name="filters[StuffStatus]"]:first').attr('checked');
        var countFilters = $('li.opening input:checked').length;
        
        if((countFilters > 0 && !isAllTypesChecked) || (countFilters > 1)){
            $('#active-search-prop').show();
        }
        $('li.opening input:checked').each(function(){
            if($(this).val()){
                var li = $(this).closest('li.opening');
                var title = li.find('a.opening-a').contents()[1].textContent;
                $('#clear-filter').prepend(
                    $('<li><a href="'+$(this).attr('id')+'" class="i delete"></a><div class="cat">'+title+'</div><div class="itemcat">'+$(this).parent().contents()[1].textContent+'</div></li>')
                );
            }
        });
        
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
            $(this).removeClass('show-prop').addClass('show-prop');
            return false;
        });
});