$(function(){

	var $ftitle = $('.ftitle');
	
	$ftitle.click(function(){
		var $parent = $ftitle.parent();
		if($parent.hasClass('opened')){
			$parent.removeClass('opened').addClass('closed');
		}
		else{
			$parent.removeClass('closed').addClass('opened');
		}
	})
        
	var $cat = $('.category');
	var $drop = $('.uluserbar').next('.dropdown');
	$cat.click(function(e){
		e.preventDefault();
		$(this).addClass('active');
		$drop.toggle();
		e.stopPropagation();
	})
	
	var $all = $('.allplace')
	var $searchDropdown = $('.field .dropdown');
	$all.click(function(){
		$searchDropdown.toggle();
		return false;
	})
	
	$searchDropdown.click(function(e){
		e.stopPropagation();
	})
	
	
	$(document).click(function(){
        if(typeof event !== 'undefined' && !$(event.target).closest('.dropdown').length){
            $searchDropdown.hide();
            $drop.hide();
            $cat.removeClass('active');
        }
	})
	
	var $filter = $('.filters li.opening a.opening-a');
	
	$filter.click(function(e){
		//e.preventDefault();
		if($(this).parent().hasClass('open')){
			$(this).parent().removeClass('open');
		}
		else{
			$(this).parent().addClass('open');
		}
                return false;
	})
        
        $('.smt').click(function(){
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
            $(this).removeClass('show-prop').addClass('show-prop');
            return false;
        });
});
