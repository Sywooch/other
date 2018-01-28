$(document).ready(function () {
	$('.inpnum').keydown(function (evt) {
	evt = (evt) ? evt : ((window.event) ? event : null);

	if (evt) {
		var elem = (evt.target)
		? evt.target
		: (
		evt.srcElement
			? evt.srcElement
			: null
		);

		if (elem) {
		var charCode = evt.charCode
			? evt.charCode
			: (evt.which
			? evt.which
			: evt.keyCode
			);

		if ((charCode < 32 ) ||
			(charCode > 44 && charCode < 47) ||
			(charCode > 95 && charCode < 106) ||
			(charCode > 47 && charCode < 58) || charCode == 188 || charCode == 191 || charCode == 190 || charCode == 110) {
			return true;
		}
		else {
			return false;
		}
		}
	}
	});
	$('.inp_maxlength').keyup(function () {
		$(this).next(".maxlength").text($(this).attr("maxlength") - $(this).val().length);
	});

	$(".col_3_top a[class^='theme_']").on('click', function () {
		var img = $(this);
		var theme = img.attr('class').replace(/^theme_/, '');
		$.ajax({
			url:window.location.href,
			type:'POST',
			dataType:'json',
			data:{
			action:'change_theme',
			theme:theme,
			check_hash_user:$('.check_hash_user').text()
			},
			success:(function (response) {
			if (response.hash) {
				$('input[name=check_hash_user]').val(response.hash);
				$('.check_hash_user').text(response.hash);
			}
			if (response.background) {
	
				$(".col_3_top a[class^='theme_']").width('');
				img.width('30px');
	
				$("body").css("background-image", 'url(' + response.background + ')');
			}
			})
		});
		return false;
	});

	$('#save input[type=submit]').click(function(){
		$('.errors').remove();
		$("#save input[name=action]").val("validate");
		$('#save input[name=save_redirect]').val($(this).attr('save_redirect'));

		$('#save').ajaxSubmit({
			url: window.location.href,
			type: 'POST',
			dataType:'json',
			success:(function (response, statusText, xhr, form) {
				$("#save input[name=action]").val("");
				if (response.hash) {
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
				if (response.success) {
				
					$("#save").submit();
				}
				if(response.errors){
					var focus = false;
					var other = false;
					$.each(response.errors, function (k, val) {
						if(k) {
							if(! other)
							{
								if($("#"+k).parents('.other').length)
								{
									$('.other').show();
									other = true;
								}
							}
							if(! focus)
							{
								$("#"+k).find("input, submit, textarea").first().focus();
								focus = true;
							}
							$("#"+k).after('<tr class="errors"><td colspan="2"><div class="error">' + prepare(val) + '</div></td></tr>');
						}
						else
						{
							$(".button_block").after('<div class="errors error">' + prepare(val) + '</div>');
						}
					});
				}
			})
		});
		return false;
	});
	$('.save_redirect_0').click(function(){
		$('#noOut').val('0');
	});
	$('.save_redirect_2').click(function(){
		$('#noOut').val('2');
	});


	$('.show_other_block').click(function () {
		if($('.other').css('display') == 'none')
		{
			$('.other').show();
		}
		else
		{
			$('.other').hide();
			return false;
		}
	});

	$('.show_tr_click_checkbox').click(function () {
	show_tr_click_checkbox($(this));
	});
	$('.show_tr_click_checkbox').each(function () {
	show_tr_click_checkbox($(this));
	});
	$('.show_select_div').change(function () {
	show_select_div($(this));
	});
	$('.show_select_div').each(function () {
	show_select_div($(this));
	});
	$('select.redirect').change(function () {
	var path = $(this).attr("rel");
	if ($(this).val()) {
		path = path + $(this).attr("name") + $(this).val() + '/';
	}
	window.location.href = path;
	});

	$("#tabs").tabs();

	var last_tab;
	$('.show_tab_mini').click(function () {
	$('.' + $(this).attr("rel")).show();
	if (last_tab) $(last_tab).hide();
	if (last_tab != '.' + $(this).attr("rel")) last_tab = '.' + $(this).attr("rel");
	});
	$('.check_price input[type=checkbox]').click(function () {
	if ($(this).attr("checked")) {
		$('.check_price').hide();
		$('.price_param').hide();
		$('.select_param').show();
		$('.check_price').attr("checked", null);

		$(this).attr("checked", 'checked');
		$(this).parents('.check_price').show();
		$('#price_param_' + $(this).attr('rel')).show();
		$('#select_param_' + $(this).attr('rel')).hide();
		$('#price').hide();
	}
	else {
		$('.check_price').show();
		$('#price_param_' + $(this).attr('rel')).hide();
		$('#select_param_' + $(this).attr('rel')).show();
		$('#price').show();
	}
	});

	$('input[name=file_type]').change(function () {
	$('.file_type1').hide();
	$('.file_type2').hide();
	$('.file_type3').hide();
	$('.file_type' + $(this).val()).show();
	});

	$('input[name=type]').change(function () {
	$('.type1').hide();
	$('.type2').hide();
	$('.type3').hide();
	$('.type' + $(this).val()).show();
	});

	$(".timecalendar").each(function () {
	if ($(this).attr('showtime') == "true" || $(this).attr('showtime') == "true") {
		$(this).datetimepicker({
		dateFormat:'dd.mm.yy',
				timeFormat:'hh:mm'
		});
	}
	else {
		$(this).datepicker({
		dateFormat:'dd.mm.yy'
		});
	}
	});

	$("ul.list").on('click', 'div.actions a, div.restore-action a', function () {
	var self = $(this);
	if (!self.attr("action")) {
		return true;
	}
	if (self.attr("confirm") && !confirm(self.attr("confirm"))) {
		return false;
	}
	$.ajax({
		url:window.location.href,
		type:'POST',
		dataType:'json',
		data:{
		action:self.attr("action"),
		id:self.parents("tr").find(".actions").attr("row_id"),
		check_hash_user:$('.check_hash_user').text()
		},
		success:(function (response) {
		if (response.redirect) {
			window.location.href = response.redirect;
		}
		})
	});
	return false;
	});


	$("ul.list").on('click', 'td.action_icon a, td.restore-action a', function () {
		var self = $(this);
		if (!self.attr("action")) {
			return true;
		}
		if (self.attr("confirm") && !confirm(self.attr("confirm"))) {
			return false;
		}
		
		$.ajax({
			url:window.location.href,
			type:'POST',
			dataType:'json',
			data:{
				action:self.attr("action"),
				id:self.parents("li").attr("row_id"),
				check_hash_user:$('.check_hash_user').text(),
				ajax:1
			},
			success:function (response) {
				if (response.redirect) {
					//alert(response.redirect);
					window.location.href = response.redirect;
				}
				if (response.error) {
					self.parents("li").after('<div class="error">'+prepare(response.error)+'</div>');
				}
			}
		});
		return false;
	});

	$("span.select_all").click(function () {
		var c = $("#select_all").attr('checked') ? null : 'checked';
			$("#select_all").attr('checked', c);
	
		current = $(this).parents(".group_action").prev(".paginator");
		if(! current.length)
		{
			current = $(this).parents(".group_action");
		}
	
		current.prev("ul").find(".checkbox input[type=checkbox]").each(function () {
			$(this).attr('checked', c);
		});
	});

	$("#select_all, span.select_all").live('click', function () {
		var c = $("#select_all").attr('checked') ? 'checked' : null;
		current = $(this).parents(".group_action").prev(".paginator");
		if(! current.length)
		{
			current = $(this).parents(".group_action");
		}
	
		current.prev("ul").find(".checkbox input[type=checkbox]").each(function () {
			$(this).attr('checked', c);
		});
	});


	$(".group_action select[name='action']").live('change', function () {
		$('.group_action .dop_rows div').hide(150);
		$('.group_action .dop_rows').find('.dop_' + $(this).val()).show(200);
	});

	$("#group_actions").live('click', function () {
		var ids = new Array;
		var form = $(this).parents('form');
		$(".checkbox input[type=checkbox]:checked").each(function (i) {
			ids[i] = $(this).val();
			form.prepend('<input name="ids[]" type="hidden" value="'+ids[i]+'">');
		});

		if (!ids.length) return false;

		var self = $(".group_action select[name='action'] option:selected");
		if (self.attr("confirm") && !confirm(self.attr("confirm"))) {
			return false;
		}
		var module = self.attr('module');
		form.find('input[name=ajax]').val(1);
		form.prepend('<input name="module" type="hidden" value="'+(module ? module : '')+'">');
		form.prepend('<input name="check_hash_user" type="hidden" value="'+$('.check_hash_user').text()+'">');

		var values = form.serializeArray();

		$.ajax({
			url:window.location.href,
			type:'POST',
			dataType:'json',
			data:values,
			success:(function (response) {
				if (response.error) {
					$(".group_action").after('<div class="error">'+prepare(response.error)+'</div>');
					return;
				}
				if (response.redirect) {
					window.location.href = response.redirect;
				}
				else
				{
					window.location.href = window.location.href+'error1/';
				}
			})
		});
		return false;
	});

	$("#change_nastr").live('click', function () {
	$.ajax({
		url:window.location.href,
		type:'POST',
		dataType:'json',
		data:{
		nastr:  $(this).parents('form').find('input[name=nastr]').val(),
		action: 'change_nastr',
		ajax:   1,
		check_hash_user: $('.check_hash_user').text()
		},
		success:(function (response) {
		window.location.href = response.redirect;
		})
	});
	return false;
	});

	$("input[name=check_all]").click(function () {
	$(".checkbox input[type=checkbox]").attr("checked", $(this).attr("checked"));
	});

	$('.user_center font a, .help_close a').click(function () {
	$('.help_top, .help').toggle();
	});

	if ($('input[name=check_hash_user]').length && $('input[name=check_hash_user]').val() != $('.check_hash_user').text()) {
	$('input[name=check_hash_user]').val($('.check_hash_user').text());
	}

	$('.change_parent_id a').live('click', function () {
	$.ajax({
		url:window.location.href,
		type:'POST',
		dataType:'json',
		data:{
		action:'parent',
		parent_id:$('.change_parent_id input[name=parent_id]').val(),
		check_hash_user:$('.check_hash_user').text()
		},
		success:(function (response) {
		$('.change_parent_id').after(prepare(response.data));
		$('.change_parent_id').remove();
		if (response.hash) {
			$('input[name=check_hash_user]').val(response.hash);
			$('.check_hash_user').text(response.hash);
		}
		})
	});
	return false;
	});

	$('.change_sort a').live('click', function () {
	var self = $(this);
	$.ajax({
		url:window.location.href,
		type:'POST',
		dataType:'json',
		data:{
		action:'sort',
		sort:self.attr("sort"),
		cat_id:self.attr("cat_id"),
		name:self.attr("sname"),
		site_id:self.attr("site_id"),
		parent_id:self.attr("parent_id"),
		sort:self.attr("sort"),
		check_hash_user:$('.check_hash_user').text()
		},
		success:(function (response) {
		$('.change_sort').after(prepare(response.data));
		$('.change_sort').remove();
		if (response.hash) {
			$('input[name=check_hash_user]').val(response.hash);
			$('.check_hash_user').text(response.hash);
		}
		})
	});
	return false;
	});

	var old_value = '';
	$(".fast_edit textarea, .fast_edit input").live('click', function () {
		$(this).focus();
		old_value = $(this).val();
	}).live('blur', function () {
		if ($(this).val() == old_value) return false;
		$.ajax({
			url:window.location.href,
			type:'POST',
			dataType:'json',
			data:{
				action:'fast_save',
				name:$(this).attr('name'),
				value:$(this).val(),
				type:$(this).hasClass('inpnum'),
				id:$(this).attr('row_id'),
				check_hash_user:$('.check_hash_user').text()
			},
			success:(function (response) {
				if (response.hash) {
					$('input[name=check_hash_user]').val(response.hash);
					$('.check_hash_user').text(response.hash);
				}
				if (response.res == false) {
					$(this).val(old_value);
				}
			})
		});
	});

	// новая сортировка
	var sort_items = {
		sort_pos:{},
		ajax_events:new Array(),
		this_sort:null,
		f_parent:false,
		f_page:false,

		start:function () {
			$("ul.move").sortable({
				cursor: 'move',
				handle: 'td.move',
				connectWith: "ul.move",

				create:sort_items.actions.create,

				out:function () {
					sort_items.f_parent = true;
				},

				beforeStop:sort_items.actions.move_page,

				stop:function (event, ui) {
					if(sort_items.f_page)
					{
						return;
					}
					sort_items.this_sort = $(this);

					$(this).sortable('disable');

					//if (sort_items.f_parent) {
						sort_items.actions.parent_item(event, ui);
						sort_items.f_parent = false;
					//}

					sort_items.actions.move_item(event, ui);

					sort_items.update();
					$(this).sortable('enable');
				}
			});
			$("ul.move").disableSelection();

			//$(window).on("unload", this.update);
		},

		get_level:function (elem) { return $(elem).attr("class"); },


		actions:{
			create:function (event,ui) {

				var level=1;
				if(!ui.item) {
					sort_items.this_sort = $(this);
					level = sort_items.get_level($(this).find("li:first"));
				}
				else {
					level = sort_items.get_level($(ui.item));
					sort_items.this_sort = $(ui.item).parent("ul.move");
				}

				sort_items.sort_pos[level]=new Array();
				sort_items.this_sort.children("li").each(function (i) {
					var sort_id = parseInt($(this).attr("sort_id"), 10);
					if(sort_id == 0) {$(this).attr("sort_id",i);}
					//alert(i);
					if(sort_id >= 0) {
						
						
						sort_items.sort_pos[level][i] = i;
					}
				});

				sort_items.sort_pos[level].sort(
				function(i, ii) { // По возрастанию
					if (i > ii)
						return 1;
					else if (i < ii)
						return -1;
					else
						return 0;
				}
			);

			},

			// обработка перемещения в родителя элемента
			parent_item:function (event, ui) {
				var parent_id = $(ui.item).attr("parent_id");
				if(parent_id === undefined)
				{
					return;
				}
				parent_id=parseInt(parent_id,10);

				var level = parseInt($(ui.item).attr("class").replace("level_", ""), 10);
				var old_level = level;
				var id = parseInt($(ui.item).attr("row_id"), 10);
				var new_parent_id = -1;

				//ищем текущего родителя
				$(ui.item).parent("ul.move").children().each(function () {
					var p = parseInt($(this).attr('row_id'), 10);
					var pp = parseInt($(this).attr('parent_id'), 10);
					var l = parseInt($(this).attr("class").replace("level_", ""), 10)
					if (p != id) {
						if (pp == 0) {
							new_parent_id = 0;
							level = 1;
							return false;
						}
						else {
							if (pp != parent_id) {
								new_parent_id = pp;
								level = l;
								return false;
							}
						}
					}
				});

				if (new_parent_id == -1 || new_parent_id == parent_id)
				{
					var prev = $(ui.item).prev('li');
					var off = prev.offset();
					if(off !== null)
					{
						// если смещено, относительно верхнего элемента больше, чем на 20 пикселей, то считаем его родителем
						if(ui.offset.left - off.left> 15)
						{
							new_parent_id = prev.attr('row_id');
							level = parseInt(prev.attr("class").replace("level_", ""), 10) + 1;
							if(! prev.find('ul').length)
							{
								prev.find('a').first().after('<ul class="list move ui-sortable"></ul>');
							}
							prev.find('ul').first().append($(ui.item));
						}
					}
				}

				if(new_parent_id != -1 && parent_id != new_parent_id)
				{
					sort_items.ajax.add('move_parent', {id:id, parent_id:new_parent_id},
	
						function (response) {
							$(ui.item).attr("parent_id", new_parent_id);
							var l="level_" + level;
							$(ui.item).attr("class", l);
							sort_items.actions.create(event,ui);
						}
					);
				}

				sort_items.update();
			},
			// определяем перетащили ли на страницу
			move_page:function (event, ui) {
				sort_items.f_page = false;

				$(".paginator a.border").each(function () {
					var off = $(this).offset();
					off['right'] = off.left + $(this).innerWidth();
					off['bottom'] = off.top + $(this).innerHeight();
					if (ui.offset.left >= off.left && ui.offset.left <= off.right) {
						ui.offset.top += $(ui.item).innerHeight();

						if (ui.offset.top >= off.top && ui.offset.top <= off.bottom) {
							$(this).addClass('border_hover');
							var values = {
								page: parseInt($(this).text()),
								id: parseInt(ui.item.attr("row_id"))
							};

							var href = $(this).attr('href');

							sort_items.ajax.add('move_page', values, function() {
								window.location = href;
							});
							sort_items.update();
							sort_items.f_page = true;
						}
					}
				});

			},

			// перемещение элементов
			move_item:function (event, ui) {
				//console.log('> move_item');

				var new_sort = {};
				var level = sort_items.get_level($(ui.item));

				$(ui.item).parent("ul.move").children().each(function (i) {
					var row_id = parseInt($(this).attr("row_id"), 10);
					if (row_id > 0) {
						new_sort[row_id] = sort_items.sort_pos[level][i];
					}
				});

				sort_items.ajax.add('move', {sort:new_sort},null,sort_items.f_page);
			}
		},

		ajax:{
			/**
			 * добавляет ajax обработчик
			 */
			add: function (action, values, success, start_list, stop) {

				stop = stop || false;
				success = success || null;

				var event={action:action,values:values, success:success, stop:stop};
				var exist=false;
				for (var i in sort_items.ajax_events) {
					if(sort_items.ajax_events[i].action == action)
					{
						event.each(function(key) {
							sort_items.ajax_events[i].key=event.key;
						});
						exist=true;
					}
				};

				if(!exist) {
					if(!start_list)
					{
						sort_items.ajax_events.push(event);
					}
					else
					{
						sort_items.ajax_events.unshift(event);
					}
				}
			},

			send:function (event) {

				var data = {
					action:event.action,
					check_hash_user:$('.check_hash_user').text()
				};

				for (var key in event.values) {
					if (!data[key]) data[key] = event.values[key];
				}

				var success = false;

				$.ajax({
					url:window.location.href,
					type:"POST",
					dataType:"json",
					cache:false,
					async:false,
					data:data,

					success:function (response) {

						if (response.hash) {
							$('input[name=check_hash_user]').val(response.hash);
							$('.check_hash_user').text(response.hash);
						}

						if (response.error || !response.status) { // произошла ошибка меняем все обратно
							sort_items.this_sort.sortable('cancel');

						}
						else {
							if (typeof(event.success) == "function") {
								event.success(response);
							}
							success = true;
						}


					}
				});
				return success;
			}

		},

		update:function () {
			for(var i in sort_items.ajax_events){
				var stop = sort_items.ajax_events[i].stop;
				if (sort_items.ajax.send(sort_items.ajax_events[i]) == true) {
					delete sort_items.ajax_events[i];
				}
				if (stop) break;
			}
		}
	};

	sort_items.start();

	$(".table_wrap a.plus").live("click", function () {
	if($(this).hasClass("turn")) {
		tree_minus($(this));
		$(".group_action .plus_all").removeClass("turn").addClass("expand");
		var src = $(".group_action .plus_all img").attr("src");
		src = src.replace("minus", "plus");
		$(".group_action .plus_all img").attr("src", src);
		return false;
	}
	else if($(this).hasClass("expand")) {
		tree_plus($(this), false);
		return false;
	}
	return true;
	});

	$(".group_action .plus_all").live("click", function () {
	if($(this).hasClass("turn")) {
		$(".level_1 .table_wrap a.turn").each(function(){
		tree_minus($(this));
		});
		var src = $(".group_action .plus_all img").attr("src");
		src = src.replace("minus", "plus");
		$(".group_action .plus_all img").attr("src", src);
		$(this).removeClass("turn").addClass("expand");
	}
	else if($(this).hasClass("expand")) {
		$(".table_wrap a.expand").each(function(){
		tree_plus($(this), true);
		});
		var src = $(".group_action .plus_all img").attr("src");
		src = src.replace("plus", "minus");
		$(".group_action .plus_all img").attr("src", src);
		$(this).addClass("turn").removeClass("expand");
	}
	return false;
	});

	function tree_plus(a, plus_all)
	{
	var id = a.attr("rel");
	var img = a.find("img:first");
	var src = img.attr("src");
	var level = a.parents('li').attr("class").replace("level_", "");
	level = parseInt(level, 10) + 1;

	$.ajax({
		url:window.location.href,
		type:"POST",
		dataType:"json",
		cache:false,
		async:false,
		data:{
		ajax:"expand",
		parent_id:id,
		level:level,
		check_hash_user:$('.check_hash_user').text()
		},
		success:function (response) {
		if (response.hash) {
			$('input[name=check_hash_user]').val(response.hash);
			$('.check_hash_user').text(response.hash);
		}
		if (response.html) {
			a.removeClass("expand").addClass("turn");
			src = src.replace("plus", "minus");
			img.attr("src", src);
			a.parents('li:first').append(prepare(response.html));
			sort_items.start();
			//table_width();
			if(plus_all)
			{
			a.parents('li:first').find('.table_wrap a.expand').each(function(){
				tree_plus($(this), true);
			});
			}
		}
		}
	});
	}

	function tree_minus(a)
	{
	var id = a.attr("rel");
	var img = a.find("img:first");
	var src = img.attr("src");
	var level = a.parents('li').attr("class").replace("level_", "");
	level = parseInt(level, 10) + 1;

	a.removeClass("turn").addClass("expand");
	src = src.replace("minus", "plus");
	img.attr("src", src);
	$("ul.list").find('li[parent_id="' + id + '"]').remove();
	a.parents('li').find('.paginator').remove();
	}

	function error_up() {
	var index_elem = {};
	$(".col_2_content").children().each(function (i) {
		var a = $(this).attr("class");
		index_elem[a] = i;
	});

	if (index_elem['tabs'] && index_elem['error']) {
		if (index_elem['tabs'] < index_elem['error']) {
		var html = $(".col_2_content  .error").html();
		$(".col_2_content  .error").remove();

		if (index_elem['config']) {
			$(".col_2_content  .config").after('<div class="error">' + html + '</div>');
		}
		else {
			$(".col_2_content  h1:first").after('<div class="error">' + html + '</div>');
		}

		}
	}

	}

	// error_up();


	function grid_align(name) {
		var width = 0;

		$('table.rows td[class="' + name + '"]').each(function () {

			var w = $(this).width();
			if (w > width) {
				width = w;
			}
		});

		$('table.rows td[class="' + name + '"]').width(width);
	}

	$('.help_img').tooltip({
		track:false,
		bodyHandler:function () {
			return $(this).children('.help_row').html();
		}
	});
});

function prepare(string) {
	string = str_replace('&lt;', '<', string);
	string = str_replace('&gt;', '>', string);
	string = str_replace('&amp;', '&', string);
	return string;
}

function str_replace(search, replace, subject, count) {
	f = [].concat(search),
	r = [].concat(replace),
	s = subject,
	ra = r instanceof Array, sa = s instanceof Array;
	s = [].concat(s);
	if (count) {
	this.window[count] = 0;
	}
	for (i = 0, sl = s.length; i < sl; i++) {
	if (s[i] === '') {
		continue;
	}
	for (j = 0, fl = f.length; j < fl; j++) {
		temp = s[i] + '';
		repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
		s[i] = (temp).split(f[j]).join(repl);
		if (count && s[i] !== temp) {
		this.window[count] += (temp.length - s[i].length) / f[j].length;
		}
	}
	}
	return sa ? s : s[0];
}

function show_tr_click_checkbox(check) {
	var str_arr = check.attr("rel").split(',');
	$.each(str_arr, function (key, str) {
	if (check.attr("checked")) {
		$(str).show();
	}
	else {
		$(str).hide();
		if ($(str).find('.show_tr_click_checkbox').length) {
		$(str).find('.show_tr_click_checkbox').each(function () {
			$(this).attr("checked", null);
			show_tr_click_checkbox($(this));
		});
		}
	}
	});
}

function show_select_div(select) {
	if (select.val() == 1) {
	$('#' + select.attr("rel")).show();
	}
	else {
	$('#' + select.attr("rel")).hide();
	}
}

function show_div(div) {
	$('#' + div).toggle();
}

function table_width()
{
	var count = 0;
	var width = [];
	$('.table_wrap table.rows').each(function(){
		var i = 0;
		$(this).find('td').each(function(){
			if(count == 0)
			{
				width.push($(this).width());
			}
			else
			{
				width[i] += $(this).width();
			}
			i++;
		});
		count++;
	});
	i = 0;
	$.each(width, function(){
		width[i] = width[i] / count;
		i++;
	});
	$('.table_wrap table.rows').each(function(){
		i = 0;
		$(this).find('td').each(function(){
			$(this).width(width[i]);
			i = i+1;
		});
	});
}