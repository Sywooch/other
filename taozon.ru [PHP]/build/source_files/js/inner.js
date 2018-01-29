$(function(){

	var $ftitle = $('.ftitle');
	
	$ftitle.live('click', function(){
		var $parent = $ftitle.parent();
		var d = new Date();
		if($parent.hasClass('opened')){
			$parent.removeClass('opened').addClass('closed');
			document.cookie="ftitle" + "=" + "closed"
		}
		else{
			$parent.removeClass('closed').addClass('opened');
			document.cookie="ftitle" + "=" + "opened"
//			document.setCookie("ftitle", "opened");
		}
	})
        
	var $cat = $('.category');
	var $drop = $('.uluserbar').next('.dropdown');
	var $searchDropdown = $('.field .dropdown');
	$cat.on('click',function(e){
		$(document).unbind('click.myEvent');
		if($searchDropdown+':visible'){ $searchDropdown.hide(); }
		e.preventDefault();
                if($(this).hasClass('active'))
                    $(this).removeClass('active');
                else
                    $(this).addClass('active');
		$drop.toggle();
        var firstClick = true;
        $(document).bind('click.myEvent', function(e) {
            if (!firstClick && $(e.target).closest('.selection-search').length == 0) {
                $drop.hide();
				 $cat.removeClass('active');
                $(document).unbind('click.myEvent');
            }
            firstClick = false;
        });		
	})
	
	$drop.click(function(e){
        e.stopPropagation();
    })	
	
	var $filter = $('.filters li.opening a.opening-a');
	
	$filter.live('click', function(e){
		//e.preventDefault();
		if($(this).parent().hasClass('open')){
			$(this).parent().removeClass('open');
		}
		else{
			$(this).parent().addClass('open');
		}
                return false;
	})
        
        $('.smt').live('click', function(){
            $(this).closest('form').submit();
            return false;
        });
	
	var $tabs = $('#product-tabs li');
	
	
	$tabs.click(function(e){
		var $tabs_active = $('.tabs li.active');
		var $blockContent = $('.tabs li.active').attr('tab');
		$blockContent = '#' + $blockContent;
		e.preventDefault();
		if(!$(this).hasClass('active')){
			$($blockContent).hide();
			$blockContent = $(this).attr('tab');
			$('#'+$blockContent).show();
			$tabs_active.removeClass('active');
			$(this).addClass('active');
		}
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
            $(this).removeClass('hide-prop').addClass('show-prop');
            return false;
        });
});


$(function(){

	var $tabs = $('.tabs li');

	$tabs.click(function(e){
                if($(this).parent().hasClass('tabs1')){
                    return true;
                }
		var $tabs_active = $('.tabs li.active');
		var $blockContent = $('.tabs li.active').attr('tab');
		$blockContent = '#' + $blockContent;
		e.preventDefault();
		if(!$(this).hasClass('active')){
			$($blockContent).hide();
			$blockContent = $(this).attr('tab');
			$('#'+$blockContent).show();
			$tabs_active.removeClass('active');
			$(this).addClass('active');
			
		}
	})
});
