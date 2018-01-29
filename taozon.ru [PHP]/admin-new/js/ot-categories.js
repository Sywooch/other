var searchMethods;
var dataToSavePredefinedParams;
var categoriesByRoot;
var lastLoadedNodeCategoryRoot;
var tmpSelectedSearchCategory;
var globalDialogBody;
var xhr;

var Categories = new Backbone.Collection();
var CategoriesPage = Backbone.View.extend({
    "el": ".categories-wrapper",
    "events": {
    	"submit #import-upload-form": "checkFileSelection",

    },
    "rootCategory": 'Root_category',
    "lastLoadedNode": null,
    checkFileSelection: function(){
    	var file = $("#import-upload-form input[type=file]").val();
    	if( file == '') {
			showError(trans.get('Please_select_file_before_upload'));
        	$('#import-upload-form .ot-preloader-micro').hide();
        	$('#import-upload-form .btn-primary').removeAttr('disabled');

    		return false;
    	}
    	return true;
    },
    render: function()
    {        
        return this;
    },
    initialize: function() 
    {
        var self = this;
        this.render();
        
        $("#jstree")
            .bind("before.jstree", function(e, data) {
            })
            .bind("open_node.jstree", function(e, data) {                
                data.inst.select_node("#phtml_2", true);
            })
            .jstree({
                // Подключаем плагины
                "plugins" : ["themes","json_data","ui","crrm","dnd","search","types","sort"], 
                "themes" : {
                    "theme" : "classic",
                    "dots" : true,
                    "icons" : true
                },
                "sort": function (a, b) {
                    return parseInt($(a).attr('i')) > parseInt($(b).attr('i')) ? 1 : -1; 
                },
                "json_data" : {
                    "data" : getPreparedCategories(CategoriesCategories.models), // 1
                    'correct_state': true,
                    'progressive_render': true,
                    'progressive_unload': true,
                    "ajax" : {
                        "url" : 'index.php?cmd=Categories&do=getCategories',
                        // the `data` function is executed in the instance's scope
                        // the parameter is the node being loaded
                        // (may be -1, 0, or undefined when loading the root nodes)
                        "data" : function (node) {
                            // the result is fed to the AJAX request `data` option
                            return {
                                "parentId" : node.attr ? node.attr("id") : 0
                            };
                        },
                        "success" : function (data) {
                            if (data.categories) {
                                if (data.categories.length) {
                                    return getPreparedCategories(data.categories);
                                } else if (self.lastLoadedNode) {
                                    self.lastLoadedNode.removeClass('jstree-open').addClass('jstree-leaf');
                                }
                            } else {
                                showError(data);
                            }
                        }
                    }
                }
            })
            .bind("create.jstree", function (e, node) {
                var parentId = 0;
                var categoryId = $(node.rslt.obj).attr('externalid');
                var alias = $(node.rslt.obj).attr('alias');
                var approxWeight = $(node.rslt.obj).attr('approxweight');
                var meta_pagetitle = $(node.rslt.obj).attr('seo_pagetitle');
                var meta_title = $(node.rslt.obj).attr('seo_title');
                var meta_keywords = $(node.rslt.obj).attr('seo_keywords');
                var meta_description = $(node.rslt.obj).attr('seo_description');
                var seoText = $(node.rslt.obj).attr('seoText');
                var parentId = $(node.rslt.obj).attr('parentId');                
                $.post(
                    "index.php?cmd=Categories&do=createCategory",
                    {
                        "parentId" : parentId < 0 ? 0 : parentId,
                        "categoryId": categoryId,
                        "position" : node.rslt.position,
                        "name" : node.rslt.name,
                        "approxweight": approxWeight,
                        "alias": alias,
                        "meta_pagetitle": meta_pagetitle,
                        "meta_title": meta_title,
                        "meta_keywords": meta_keywords,
                        "meta_description": meta_description,
                        "seoText": seoText,
                        "predefinedParams" : dataToSavePredefinedParams
                    },
                    function (data) {
                        if (data.newId) {
                            var li = $(node.rslt.obj);
                            $(li).attr("id", data.newId);
                            $(li).attr("alias", data.aliasToSave);
                            $(li).attr("isparent", data.isParent);
                            if ((typeof dataToSavePredefinedParams.provider === 'undefined') || (dataToSavePredefinedParams.provider == '')) {
                                providerType = ' ';
                            } else {
                                providerType = ' [' + dataToSavePredefinedParams.provider + '] ';
                            }
                            if (approxWeight == '') {
                                titleApproxWeight = ' ';
                            } else {
                            	titleApproxWeight = ' (' + approxWeight + ' ' + trans.get('kg') + ')';
                            }            
                        	var title = $.trim(node.rslt.name + titleApproxWeight + providerType);
                            
                            $(li).attr('name', node.rslt.name);
                            $("#jstree").jstree("rename_node", li, title);
                            $(li).attr("predifenedparams", JSON.stringify(dataToSavePredefinedParams));
                            
                            self.addJSTreeItemTaskBar(li);
                            
                            var ul =$(li).closest('ul'); 
                            
                            $("#jstree").jstree("sort",ul);
                            
                        } else {
                            $.jstree.rollback(node.rlbk);
                            showError(data);
                        }
                    }, 'json'
                );
            })
            .bind("remove.jstree", function (e, node) {
                    $.post(
                        "index.php?cmd=Categories&do=removeCategory",
                        {"id" : node.rslt.obj.attr("id")},
                        function (data) {
                            if (data.error) {
                                node.inst.refresh();
                                showError(data);
                            }
                        }, 'json'
                    );
                return false;
            })
            .bind("rename.jstree", function (e, node) {
                if (node.rslt.new_name == node.rslt.old_name) {
                    return;
                }
                $.post(
                    "index.php?cmd=Categories&do=renameCategory",
                    {"id" : node.rslt.obj.attr("id"), "newName" : node.rslt.new_name},
                    function (data) {
                        if (data.error) {
                            $.jstree.rollback(node.rlbk);
                            showError(data);
                        }
                    }, 'json'
                );
            })
            .bind("move_node.jstree", function (e, node) {
                node.rslt.o.each(function (i) {
                    $.ajax({
                        async : true,
                        type: 'POST',
                        dataType: 'json',
                        url: "index.php?cmd=Categories&do=moveCategory",
                        data : {
                            "id" : node.rslt.o.attr('id'),
                            "parentId" : node.rslt.op.attr("id"),
                            "newParentId" : node.rslt.cr === -1 ? 0 : node.rslt.np.attr("id")
                        },
                        success : function (data) {
                            if (data.error) {
                                $.jstree.rollback(node.rlbk);
                                showError(data);
                            } else {
                                $(node.rslt.oc).attr("id", data.id);
                                if (node.rslt.cy && $(node.rslt.oc).children("UL").length) {
                                    node.inst.refresh(node.inst._get_parent(node.rslt.oc));
                                }
                            }
                        }
                    });
                });
            })
            .one("reopen.jstree", function (event, data) {
            })
            // 3) but if you are using the cookie plugin or the UI `initially_select` option:
            .one("reselect.jstree", function (event, data) {
            })
            .bind("loaded.jstree", function(e, data) {
                $('.categories-wrapper #jstree li').each(function() {
                    self.addJSTreeItemTaskBar(this);
                });
                
                $('.ot_show_crud_cat_item_window').click(function() {
                    dataToSavePredefinedParams = {};
                    $('.ot_crud_cat_item_window .modal-body #categoryName').attr('value', '');
                    
                    $('.ot_crud_cat_item_window .modal-body #alias').attr('value', '');
                	$('.ot_crud_cat_item_window .modal-body #alias').attr('alias-id', 'new');
                    $('.ot_crud_cat_item_window .modal-body #approxweight').attr('value', '');
                    $('.ot_crud_cat_item_window .modal-body #meta_title').attr('value', '');
                    $('.ot_crud_cat_item_window .modal-body #meta_title_prefix').attr('value', '');
                    $('.ot_crud_cat_item_window .modal-body #meta_title_suffix').attr('value', '');
                    $('.ot_crud_cat_item_window .modal-body #meta_keywords').html('');
                    $('.ot_crud_cat_item_window .modal-body #meta_description').html('');
                    $('.ot_crud_cat_item_window .modal-body #seoText').html('');
                    $('.ot_crud_cat_item_window #ot_cat_filters_head').hide();
                    $('.ot_crud_cat_item_window .modal-body #parentCategory').attr('value','');
                    $('.ot_crud_cat_item_window .modal-body #parentCategoryId').attr('value',0);
                    
                    var content = $('.ot_crud_cat_item_window .modal-body').html();                    
                    content = content.replace(new RegExp("ot_cat_data", 'g'), "ot_cat_data1");
                    content = content.replace(new RegExp("ot_cat_meta", 'g'), "ot_cat_meta1");
                    content = content.replace(new RegExp("ot_cat_content", 'g'), "ot_cat_content1");
                    content = content.replace(new RegExp("ot_cat_filters", 'g'), "ot_cat_filters1");
                    content = content.replace(new RegExp("seoText", 'g'), "seoText1");
                    content = content.replace(new RegExp('<div class="editableform-loading"></div>', 'g'), "");

                    removeTinyMCE();
                    
                    modalDialog(trans.get('Add_category'), content, function(body) {
                        var categoryName = $('#categoryName', body).val();
                        var categoryId = $('#categoryId', body).val();
                        var alias = $('#alias', body).val();
                        var approxWeight = $('#approxweight', body).val();
                        var meta_pagetitle = $('#meta_title', body).val();
                        var meta_title = $('#meta_title_prefix', body).val() + '||' + $('#meta_title_suffix', body).val();
                        var meta_keywords = $('#meta_keywords', body).val();
                        var meta_description = $('#meta_description', body).val();
                        if (tinyMCE.editors.length > 0) {
                            var seoText = tinyMCE.editors[0].getContent();
                        } else {
                            var seoText = $('#seoText1', body).html();
                        }
                        var parentId = $('#parentCategoryId', body).val();
                        
                        
                        if (! categoryName.length) {
                            showError(trans.get('Enter_category_name_promt'));
                            return false;
                        }
                        if (isSeoActive) {
                            var aliasPattern = /^[a-z0-9-_]+$/i;                
                            if (! aliasPattern.test(alias) && alias != '') {
                                showError(trans.get('Category_alias_is_invalid'));
                                return false;
                            }
                        }
                        
                        var parentLi = 0;
                        if (parentId && parentId != '0') {
                        	parentLi = $('#jstree li[id="'+parentId+'"]');
                        }
                        if (! checkPredefinedParams()) {                            
                            return false;
                        }                        
                        $("#jstree").jstree("create", parentLi, 'last', categoryName, function(node) {
                            $(node).attr('externalid', categoryId);
                            $(node).attr('alias', alias);
                            $(node).attr('approxweight', approxWeight);
                            $(node).attr('seo_pagetitle', meta_pagetitle);
                            $(node).attr('seo_title', meta_title);
                            $(node).attr('seo_keywords', meta_keywords);
                            $(node).attr('seo_description', meta_description);
                            $(node).attr('seoText', seoText);
                            $(node).attr('parentId', parentId);
                        }, true);
                        return true;
                      }, 
                      {confirm: trans.get('Save'), cancel: trans.get('Cancel') }, function(body) { globalDialogBody = body; });
                      asignProvidersActions(globalDialogBody);
                      $('.ot_cat_content1_toogle', globalDialogBody).click(function() {
                          initTinyMCE();
                      });
                });
            })
            .bind("select_node.jstree", function (event, data) {
            })
            .bind("create_node.jstree", function (event, data) {
            })
            
            .bind("load_node.jstree", function (event, data) {
                if (typeof(data) !== 'undefined') {
                    var item = data.args[0][0];
                    if (typeof(item) !== 'undefined') {
                        $('li',item).each(function() {
                            self.addJSTreeItemTaskBar(this);
                        });
                        self.lastLoadedNode = data.rslt.obj;
                    }
                }
            });
        
        
        $('#import-upload-form').submit(function(){
        	$('#import-upload-form .ot-preloader-micro').show();
        	$('#import-upload-form .btn-primary').attr('disabled','disabled');
        	return true;
        });

    },
    assignItemHandlers: function(item) {
        var self = this;
        $('.ot_cat_actions .add_category_button',item).click(function() {
            var li = $(this).closest('li');
            dataToSavePredefinedParams = {};
            $('.ot_crud_cat_item_window .modal-body #categoryName').attr('value', '');
            
            //$('.ot_crud_cat_item_window .modal-body #categoryId').attr('value', '');
            
            $('.ot_crud_cat_item_window .modal-body #alias').attr('value', '');
        	$('.ot_crud_cat_item_window .modal-body #alias').attr('alias-id', 'new');
            $('.ot_crud_cat_item_window .modal-body #approxweight').attr('value', '');
            
            $('.ot_crud_cat_item_window .modal-body #meta_title').attr('value', '');
            $('.ot_crud_cat_item_window .modal-body #meta_title_prefix').attr('value', '');
            $('.ot_crud_cat_item_window .modal-body #meta_title_suffix').attr('value', '');
            $('.ot_crud_cat_item_window .modal-body #meta_keywords').html('');
            $('.ot_crud_cat_item_window .modal-body #meta_description').html('');
            $('.ot_crud_cat_item_window .modal-body #seoText').html('');
            $('.ot_crud_cat_item_window .modal-body #parentCategory').attr('value',$(li).attr('name').trim());
            $('.ot_crud_cat_item_window .modal-body #parentCategoryId').attr('value',$(li).attr('id'));

            $('#ot_cat_data').tab('show');
            
            $('.ot_crud_cat_item_window #ot_cat_filters_head').hide();
            
            var content = $('.ot_crud_cat_item_window .modal-body').html();            
            content = content.replace(new RegExp("ot_cat_data",'g'),"ot_cat_data1");
            content = content.replace(new RegExp("ot_cat_meta",'g'),"ot_cat_meta1");
            content = content.replace(new RegExp("ot_cat_content",'g'),"ot_cat_content1");
            content = content.replace(new RegExp("ot_cat_filters",'g'),"ot_cat_filters1");
            content = content.replace(new RegExp("seoText",'g'),"seoText1");
            content = content.replace(new RegExp('<div class="editableform-loading"></div>', 'g'), "");
            
            removeTinyMCE();
            
            modalDialog(trans.get('Add_category'), content, function(body) {
                var categoryName = $('#categoryName', body).val();
                var categoryId = $('#categoryId', body).val();
                var alias = $('#alias', body).val();
                var approxWeight = $('#approxweight', body).val();
                var meta_pagetitle = $('#meta_title', body).val();
                var meta_title = $('#meta_title_prefix', body).val() + '||' + $('#meta_title_suffix', body).val();
                var meta_keywords = $('#meta_keywords', body).val();
                var meta_description = $('#meta_description', body).val();
                if (tinyMCE.editors.length > 0) {
                    var seoText = tinyMCE.editors[0].getContent();
                } else {
                    var seoText = $('#seoText1', body).html();
                }
                var parentId = $('#parentCategoryId', body).val();
                if (isSeoActive) {
                    var aliasPattern = /^[a-z0-9-_]+$/i;                
                    if (! aliasPattern.test(alias) && alias != '') {
                        showError(trans.get('Category_alias_is_invalid'));
                        return false;
                    }
                }
                
                if (! categoryName.length) {
                    showError(trans.get('Enter_category_name_promt'));
                    return false;
                }
                
                var parentLi = li;
                if (parentId && parentId != '0') {
                	parentLi = $('#jstree li[id="'+parentId+'"]');
                	if (!parentLi) {
                		parentLi = 0;
                	}
                }
                if (! checkPredefinedParams()) {
                    return false;
                }
                $("#jstree").jstree("create", parentLi, 'last', categoryName, function(node) {
                    $(node).attr('externalid', categoryId);
                    $(node).attr('alias', alias);
                    $(node).attr('name', categoryName);
                    $(node).attr('approxweight', approxWeight);
                    $(node).attr('seo_pagetitle', meta_pagetitle);
                    $(node).attr('seo_title', meta_title);
                    $(node).attr('seo_keywords', meta_keywords);
                    $(node).attr('seo_description', meta_description);
                    $(node).attr('seoText', seoText);
                    $(node).attr('parentId',parentId);
                    $(node).attr("predifenedparams", JSON.stringify(dataToSavePredefinedParams));       
                }, true);
                return true;
              }, {confirm: trans.get('Save'), cancel: trans.get('Cancel') }, function(body) { globalDialogBody = body;});
              asignProvidersActions(globalDialogBody);
              $('.ot_cat_content1_toogle', globalDialogBody).click(function() {
                  initTinyMCE();
              });
        }); 
        $('.ot_cat_actions .rename_category_button', item).click(function() {            
            var li = $(this).closest('li');
            var categoryId = $(li).attr('id');
            var parent = li.parent().closest('li');
            var parentName = parent.attr('name');
            var parentId = parent.attr('id');
            if (typeof(parentName) !== 'undefined') {
                parentName = parentName.trim();
            }
            var oldCategoryName = $(li).attr('name');
            var externalId = $(li).attr('externalid');
            var oldAlias = $(li).attr('alias');
            oldCategoryName = oldCategoryName.trim();
            var oldApproxWeight = $(li).attr('approxweight');
            
            dataToSavePredefinedParams = $.parseJSON($(li).attr('predifenedparams'));            
            
            $('.ot_crud_cat_item_window .modal-body #categoryName').attr('value', oldCategoryName);
            
            //$('.ot_crud_cat_item_window .modal-body #categoryId').attr('value', externalId);            
            
            $('.ot_crud_cat_item_window .modal-body #alias').attr('value', oldAlias);
            
            $('.ot_crud_cat_item_window .modal-body #approxweight').attr('value', oldApproxWeight);
            
            $('.ot_crud_cat_item_window .modal-body #meta_title').attr('value', '');
            $('.ot_crud_cat_item_window .modal-body #meta_title_prefix').attr('value', '');
            $('.ot_crud_cat_item_window .modal-body #meta_title_suffix').attr('value', '');
            $('.ot_crud_cat_item_window .modal-body #meta_keywords').html('');
            $('.ot_crud_cat_item_window .modal-body #meta_description').html('');
            $('.ot_crud_cat_item_window .modal-body #seoText').html('');
            
            $('.ot_crud_cat_item_window .modal-body #parentCategory').attr('value',parentName);
            $('.ot_crud_cat_item_window .modal-body #parentCategoryId').attr('value',parentId);
            
            $('.ot_crud_cat_item_window .modal-body #meta_title').attr('value', $(li).attr('seo_pagetitle'));
            var prefixSuffix = $(li).attr('seo_title');
            if (prefixSuffix) {
                var ps = prefixSuffix.split('||');
                if (ps.length>0) {
                    $('.ot_crud_cat_item_window .modal-body #meta_title_prefix').attr('value', ps[0]);
                }
                if (ps.length>1) {
                    $('.ot_crud_cat_item_window .modal-body #meta_title_suffix').attr('value', ps[1]);
                }
            } else {
                $('.ot_crud_cat_item_window .modal-body #meta_title_prefix').attr('value', '');
                $('.ot_crud_cat_item_window .modal-body #meta_title_suffix').attr('value', '');
                
            }
            
            $('.ot_crud_cat_item_window .modal-body #meta_keywords').html($(li).attr('seo_keywords'));
            $('.ot_crud_cat_item_window .modal-body #meta_description').html($(li).attr('seo_description'));

            $('.ot_crud_cat_item_window #ot_cat_filters_head').show();
            var content = $('.ot_crud_cat_item_window .modal-body').html();            
            content = content.replace(new RegExp("ot_cat_data", 'g'), "ot_cat_data1");
            content = content.replace(new RegExp("ot_cat_meta", 'g'), "ot_cat_meta1");
            content = content.replace(new RegExp("ot_cat_content", 'g'), "ot_cat_content1");
            content = content.replace(new RegExp("ot_cat_filters", 'g'), "ot_cat_filters1");
            content = content.replace(new RegExp("seoText", 'g'), "seoText1");            
            
            removeTinyMCE();
            
            var onConfirmCallback = function(body) {
                var categoryName = $('#categoryName', body).val();
                var alias = $('#alias', body).val();
                var approxWeight = $('#approxweight', body).val();
                var meta_pagetitle = $('#meta_title', body).val();
                var meta_title = $('#meta_title_prefix', body).val() + '||' + $('#meta_title_suffix', body).val();
                var meta_keywords = $('#meta_keywords', body).val();
                var meta_description = $('#meta_description', body).val();
                if (tinyMCE.editors.length > 0) {
                    var seoText = tinyMCE.editors[0].getContent();
                } else {
                    var seoText = $('#seoText1', body).html();
                }
                var externalId = $('#categoryId', body).val();
                var newParentId = $('#parentCategoryId', body).val();
               
                if ( !newParentId ) {
                	newParentId = parentId;
                }
                if (isSeoActive) {
                    var aliasPattern = /^[a-z0-9-_]+$/i;                    
                    if (! aliasPattern.test(alias) && alias != '') {
                        showError(trans.get('Category_alias_is_invalid'));
                        return false;
                    }
                }
                
                if (! categoryName.length) {
                    showError(trans.get('Enter_category_name_promt'));
                    return false;
                }
                if (! checkPredefinedParams()) {
                    return false;
                }
                if (categoryId.length) {
                    $.post(
                        "index.php?cmd=Categories&do=updateCategory",
                        {
							"id" : li.attr("id"), 
							"newName" : categoryName,
							"categoryId": categoryId,
							"parentId": newParentId,
							"externalId": externalId,
							"approxweight": approxWeight,
							"alias": alias,
							"meta_pagetitle": meta_pagetitle,
							"meta_title": meta_title,
							"meta_keywords": meta_keywords,
							"meta_description": meta_description,
							"seoText": seoText,
                            "predefinedParams" : dataToSavePredefinedParams
                        },    
                        function (data) {
                            if (data.error) {
								showError(data);
                                return false;
                            }
                            else {
                            	var externalId = '';
                                if ((typeof dataToSavePredefinedParams.provider === 'undefined') || (dataToSavePredefinedParams.provider == '')) {
                                    providerType = ' ';
                                } else {
                                    providerType = ' [' + dataToSavePredefinedParams.provider + '] ';
                                }
                                if (approxWeight == '') {
                                    titleApproxWeight = ' ';
                                } else {
                                	titleApproxWeight = ' (' + approxWeight + ' ' + trans.get('kg') + ')';
                                }            
                            	var title = $.trim(categoryName + titleApproxWeight + providerType);
								$(li).attr('alias', alias);
                                $(li).attr('name', categoryName);
                                $(li).attr('approxweight', approxWeight);
                                $(li).attr('seo_pagetitle', meta_pagetitle);
                                $(li).attr('seo_title', meta_title);
                                $(li).attr('seo_keywords', meta_keywords);
                                $(li).attr('seo_description', meta_description);
                                if(typeof dataToSavePredefinedParams.category !== 'undefined') {
                                	externalId = dataToSavePredefinedParams.category.id;
                                } else {
                                	externalId = '';
                                }
                                
                                $(li).attr('externalid', externalId);
                                $(li).attr('parentId', parentId);
                                $(li).attr('alias', alias);
                                $(li).attr("predifenedparams", JSON.stringify(dataToSavePredefinedParams));       
                                $("#jstree").jstree("rename_node", li, title);
                                if(newParentId != parentId){
                                    var parentLi = parent;
                                    if (newParentId && newParentId!=='0') {
                                    	parentLi = $('#jstree li[id="'+newParentId+'"]');
                                    	if (!parentLi) {
                                    		parentLi = 0;
                                    	}
                                    }
                                    $('#jstree').jstree('move_node',li, parentLi);
                                }
                                $('.confirmDialog .close').trigger('click');
                            }
                        }, 'json'
                       );
                    return true;
                } else {
                    showError(trans.get('Enter_category_name_promt'));
                    return false;
                }
                return false;
            };
            
            var onShowCallback = function(body){
            	globalDialogBody = body;
                setTimeout(function(){
    	            $.ajax({
    	                async : true,
    	                type: 'POST',
    	                dataType: 'json',
    	                url: "index.php?cmd=Categories&do=getCategoryData",
    	                data : {
    	                    "categoryId" : categoryId,
    	                    "externalId" : externalId,
    	                    "regionId" : regionId
    	                },
    	                success : function (data) {
    	                    if (data.error) {
    	                        showError(data);
    	                        $(globalDialogBody).find('.preDefinedParams').html('');
    	                    } else {
    	                        $('.level-1 .modal-body #seoText1').html(data.seoText);
    	                        initTinyMCE();
    	                        $('.level-1 .modal-body .editableform-loading').remove();
    	                        $('.level-1 .modal-body #search_filters').html(data.filters);
    	                        $('.level-1 .modal-body #search_filters .ot_inline_editable').editable().on('shown', function() {
    	                            var a = $(this).closest('a');
    	                            var form = ('.editableform',a);
    	                            var submitFunction = function(event) {
    	                                form.submit();
    	                                event.stopPropagation();
    	                            };
    	                            $('.btn-primary',form).unbind('click').unbind('submit');
    	                            $('.btn-primary',form).click(submitFunction);
    	                        });
    	                        
    	                        if (typeof dataToSavePredefinedParams.region !== 'undefined') {
    	                            dataToSavePredefinedParams.region.name = data.regionName;
    	                        }
    	                        if (typeof dataToSavePredefinedParams.category !== 'undefined') {
    	                            dataToSavePredefinedParams.category.name = data.externalCategory.name;
    	                        }
    	                        if (typeof dataToSavePredefinedParams.Configurators !== 'undefined') {
    	                            $.each(dataToSavePredefinedParams.Configurators, function(s, conf) {
    	                                if (typeof data.Configurators[conf.pid] !== 'undefined') {
    	                                    conf.name = data.Configurators[conf.pid].name;
    	                                    if (typeof data.Configurators[conf.pid].values[conf.vid] !== 'undefined') {
    	                                        conf.valueName = data.Configurators[conf.pid].values[conf.vid].name;
    	                                    } else {
    	                                        conf.valueName = trans.get('Undefined') + ' ID-' + conf.vid;
    	                                    }
    	                                }
    	                            });
    	                        }
    	                        asignProvidersActions(globalDialogBody);
    	                    }
    	                }
    	            });
                }, 1000);              	
            };
            
            modalDialog(trans.get('Edit_category'), content, onConfirmCallback, {confirm: trans.get('Save'), cancel: trans.get('Cancel') }, onShowCallback);
            var regionId = '';
            if (typeof dataToSavePredefinedParams.region !== 'undefined') {
                regionId = dataToSavePredefinedParams.region.RegionId;
            }
            $(globalDialogBody).find('.preDefinedParams').html('<div class="controls"><div class="ot-preloader-mini"></div></div>');
          
        });
        $('.ot_cat_actions .delete_category_button', item).click(function() {
            var li = $(this).closest('li');
            modalDialog(trans.get('Confirm_needed'), trans.get('Really_delete_this_category'), function() {
                $("#jstree").jstree("remove", li);
            });
        });
        $('.ot_cat_actions .move_category_button', item).mousedown(function(e) {
            var li = $(this).closest('li');
            var a = $('a',li);
            $("#jstree").jstree("start_drag", a, e);
            return false;
        });
        $('.ot_cat_actions .show_category_button', item).mousedown(function(e) {
            var li = $(this).closest('li');
            $(this).hide();            
            $('.ot_cat_actions .procces_category_button', item).show();
            $.post(
                "index.php?cmd=Categories&do=visibleCategory",
                {
                    "categoryId": li.attr('id'),
                    "visible" : 'true'
                },
                function (data) {
                      li.attr('ishidden', 'false');
                      li.attr('IsHiddenUI', 'false');
                       $('.ot_cat_actions .procces_category_button', item).hide();
                       $('.ot_cat_actions .hide_category_button', item).show();
                       $('a:first', item).css('color','');
                }, 'json'
            );
            
            return false;
        });
        $('.ot_cat_actions .hide_category_button', item).mousedown(function(e) {
            var li = $(this).closest('li');
            $(this).hide();            
            $('.ot_cat_actions .procces_category_button', item).show();
            $.post(
                "index.php?cmd=Categories&do=visibleCategory",
                {
                    "categoryId": li.attr('id'),
                    "visible" : 'false'
                },
                function (data) {
                    li.attr('IsHiddenUI', 'true');
                    li.attr('ishidden', 'true');
                    $('a:first', item).css('color', 'gray');
                    $('.ot_cat_actions .procces_category_button', item).hide();
                    $('.ot_cat_actions .show_category_button', item).show();
                }, 'json'
            );
            return false;
        });
        $('.ot_cat_actions .open_category_button', item).mousedown(function(e) {
            var li = $(this).closest('li');
            var id = $(li).attr('id');
            var url = '/index.php?p=subcategory&cid=' + id;
            window.open('http://' + window.location.host + url);
            return false;
        });
        $('.ot_cat_actions .move_down_button', item).click(function() {
            var li = $(this).closest('li');
            var nextLi = $(li).next();
            var categoryId = li.attr('id');
            var ul = li.parent();
            var i = 1;
            $('li', ul).each(function() {
                var id = $(this).attr('id');
                if (id == categoryId) {
                    return false;
                }
                i++;
            });
            if (i == $('li', ul).length) {
                return;
            }
            $.post(
                "index.php?cmd=Categories&do=orderCategory",
                {
                    "categoryId": li.attr('id'),
                    "i" : i+1
                },
                function (data) {
                    nextLi.insertBefore(li);
                }, 'json'
            );
        });
        $('.ot_cat_actions .move_up_button', item).click(function() {
            var li = $(this).closest('li');
            var prevLi = $(li).prev();
            var categoryId = li.attr('id');
            var ul = li.parent();
            var i = 1;
            $('li', ul).each(function() {
                var id = $(this).attr('id');
                if (id == categoryId) {
                    return false;
                }
                i++;
            });
            if (i == 0) {
                return;
            }
            $.post(
                "index.php?cmd=Categories&do=orderCategory",
                {
                    "categoryId": li.attr('id'),
                    "i" : i - 1
                },
                function (data) {
                    prevLi.insertAfter(li);
                }, 'json'
            );
        });

        
        $('.ot_cat_actions .copy_button', item).click(function() {
            var li = $(this).closest('li');
            var categoryName = $(li).attr('name');
            var externalId = $(li).attr('externalid');
            var categoryId = li.attr('id');
            $('.categories-wrapper #clipboard_category_external_id').val(externalId);
            $('.categories-wrapper #clipboard_category_id').val(categoryId);
            $('.categories-wrapper #clipboard_category_name').val(categoryName);
            $('.categories-wrapper #clipboard_op').val('copy');
        });

        $('.ot_cat_actions .cut_button', item).click(function() {
            var li = $(this).closest('li');
            var categoryName = $(li).attr('name');
            var externalId = $(li).attr('externalid');
            var categoryId = li.attr('id');
            $('.categories-wrapper #clipboard_category_external_id').val(externalId);
            $('.categories-wrapper #clipboard_category_id').val(categoryId);
            $('.categories-wrapper #clipboard_category_name').val(categoryName);
            $('.categories-wrapper #clipboard_op').val('cut');
        });
        
        $('.ot_cat_actions .paste_button', item).click(function() {
            var li = $(this).closest('li');
            
            var srcExternalId = $('.categories-wrapper #clipboard_category_external_id').val();
            var srcCategoryId = $('.categories-wrapper #clipboard_category_id').val();
            var srcCategoryName = $('.categories-wrapper #clipboard_category_name').val();
            srcCategoryName = srcCategoryName.trim();
            var op = $('.categories-wrapper #clipboard_op').val();
            
            if (typeof(op) !== 'undefined' && 'cut' == op && typeof(srcCategoryId) !== 'undefined') {
            	$('.ot_cat_actions .paste_button .icon-paste:first',item).hide();
            	$('.ot_cat_actions .paste_button .ot-preloader-micro:first',item).show();
            	var srcLi = $('#jstree li[id="' + srcCategoryId + '"]');
            	$('#jstree').jstree('move_node',srcLi, li);
                $('.ot_cat_actions .paste_button .icon-paste:first',item).show(); 
                $('.ot_cat_actions .paste_button .ot-preloader-micro:first',item).hide();

            } else if (typeof(op) !== 'undefined' && 'copy' == op  && typeof(srcCategoryId) !== 'undefined') {
            	// need copy
            	$('.ot_cat_actions .paste_button .icon-paste:first',item).hide();
            	$('.ot_cat_actions .paste_button .ot-preloader-micro:first',item).show();
                $.ajax({
                    async : true,
                    type: 'POST',
                    dataType: 'json',
                    url: "index.php?cmd=Categories&do=copyPaste",
                    data : {
                        "copiedId" : srcCategoryId,
                        "targetId" : $(li).attr('id'),
                        "copiedName" : srcCategoryName,
                        "copiedExternalId" : srcExternalId
                    },
                    success : function (data) {
                        if (data.error) {
                            showError(data);
                        } else {
                        	//ok 
                        	$('#jstree').jstree('close_node', li);
                        	$(li).addClass('jstree-closed');
                        	$(li).removeClass('jstree-leaf');
                        	setTimeout(function(){
                        		$('#jstree').jstree('open_node', li);
                        	}, 1000);
                        }
                        $('.ot_cat_actions .paste_button .icon-paste:first', item).show(); 
                        $('.ot_cat_actions .paste_button .ot-preloader-micro:first', item).hide();
                    }
                });
            	
            	
/*                $("#jstree").jstree("create", li, 'last', srcCategoryName, function(node) {
                    $(node).attr('externalid', srcExternalId);
                }, true);
                
                if (undefined != srcCategoryId && '' != srcCategoryId) {
                    var copiedLi = $('#'+srcCategoryId);
                    if (copiedLi.length>0) {
                        $("#jstree").jstree("remove", copiedLi);
                    }
                }*/
            }
            $('.categories-wrapper #clipboard_category_internal_id').val('');
            $('.categories-wrapper #clipboard_category_id').val('');
            $('.categories-wrapper #clipboard_category_name').val('');
        });
        
        
        
    },
    addJSTreeItemTaskBar: function(item) {
        var html = '<span class="ot_cat_actions">'+
        '<button class="btn btn-tiny offset-right1 move_category_button" title="' + trans.get("Move_category") + '"><i class="icon-move"></i></button>'+
        '<span class="btn-group">'+
        '    <button class="btn btn-tiny rename_category_button" title="' + trans.get("Edit_category") + '"><i class="icon-pencil"></i></button>' +
        '    <button class="btn btn-tiny ot_show_add_cat_item_window add_category_button" title="' + trans.get("Add_category") + '"><i class="icon-plus"></i></button>' ;
        if ( $(item).attr('IsHiddenUI')=='true') {
            $('a:first',item).css('color','gray');
            html += '    <button class="btn btn-tiny show_category_button" title="' + trans.get("Show_category") + '"><i class="icon-eye-open"></i></button>' +
            '    <button class="btn btn-tiny hide_category_button hide" title="' + trans.get("Hide_category") + '"><i class="icon-eye-close"></i></button>'; 
        }
        else {
            html += '    <button class="btn btn-tiny show_category_button hide" title="' + trans.get("Show_category") + '"><i class="icon-eye-open"></i></button>' +
            '    <button class="btn btn-tiny hide_category_button" title="' + trans.get("Hide_category") + '"><i class="icon-eye-close"></i></button>'; 
        }
        
        html += '    <button class="btn btn-tiny procces_category_button hide" title="' + trans.get("Show_category") + '"><i class="ot-preloader-micro"></i></button>' +
        '    <button class="btn btn-tiny open_category_button" title="' + trans.get("Open_category") + '"><i class="icon-search"></i></button>' +
        '    <button class="btn btn-tiny ot_show_deletion_dialog_modal delete_category_button" title="'+trans.get("Delete_category")+'"><i class="icon-remove"></i></button>' +
        '</span>' +
        '<span class="offset-left1"><span class="btn-group">' +
        '    <button class="btn btn-tiny move_up_button" title="' + trans.get("Move_up_category") + '"><i class="icon-level-up"></i></button>' +
        '    <button class="btn btn-tiny move_down_button" title="' + trans.get("Move_down_category") + '"><i class="icon-level-down"></i></button>' +
        '    <button class="btn btn-tiny copy_button" title="' + trans.get("Copy") + '"><i class="icon-copy"></i></button>' +
        '    <button class="btn btn-tiny cut_button" title="' + trans.get("Cut") + '"><i class="icon-cut"></i></button>' + 
        '     <button class="btn btn-tiny paste_button" title="' + trans.get("Paste") + '"><i class="icon-paste"></i><i class="ot-preloader-micro" style="display: none;"></i></button>' +
        '</span></span>'+
        '</span>';
        
        if ($('span.ot_cat_actions', item).length == 0) {
            var id = $(item).attr('id');
            if (id != 0) {
                $(item).append(html);
                
                this.assignItemHandlers(item);
                
                $('a',item).hover(function() {
                    $('.ot_cat_actions').hide();
                    $(this).parent('li').mouseenter();
                    return false;
                });
                
                $(item).hover(function() {
                    $('.ot_cat_actions').hide();
                    $('.ot_cat_actions:first', this).show();
                    return false;
                },function() {
                    $('.ot_cat_actions').hide();
                    return false;
                });
            }
            
        }
    },
    
});

$(function() {    
    var U = new CategoriesPage();
    
});
//Функции по привязке - в бэкбон не засунуть START
//================================================
//================================================
//================================================
//================================================
    
    
    function asignProvidersActions(body) {  
        $('#isProvider', body).hide();
        
        if (typeof dataToSavePredefinedParams === 'undefined') { 
            $('#preDefineMode :nth-child(1)', body).attr("selected", "selected");            
            $('#provider', body).each(function() {
                $(this).prop("checked",false);
            });
        } else {
            $("#preDefineMode option[value='" + dataToSavePredefinedParams.preDefineMode + "']", body).attr("selected", "selected");
            if (dataToSavePredefinedParams.preDefineMode == 'category') {
                $('#provider', body).each(function() {
                    if (dataToSavePredefinedParams.provider == $(this).val()) {
                        $(this).prop("checked", true);
                    }
                });
                $('#isProvider', body).show();
            }
            if (dataToSavePredefinedParams.preDefineMode == 'search') {                
                $('#provider', body).each(function() {
                    if (dataToSavePredefinedParams.provider == $(this).val()) {
                        $(this).prop("checked", true);
                    }
                });
                $('#isProvider', body).show();
            }
        }
        $('#preDefineMode', body).prop("disabled", false);
        $('#preDefineMode', body).change(function() {
            if (dataToSavePredefinedParams.preDefineMode != $(this).val()) {
                dataToSavePredefinedParams = {};
                showPredefinedParams(body);
            }
            $('#provider', body).each(function() {
                $(this).prop("checked", false);
            });
            if (($(this).val() == 'category') || ($(this).val() == 'search')) {
                $('#isProvider', body).show();
            } else {
                $('#isProvider', body).hide();
            }
            $.extend(dataToSavePredefinedParams, {"preDefineMode" : $(this).val()});
        });
        
        $('#provider', body).click(function() {
            showEditForms(body);
            $.extend(dataToSavePredefinedParams, {"provider" : $('#provider:checked').val()});
        });
        
        // parent category typeahead
        $('#parentCategory', body).typeahead({
        	source: function (query, process) 
        	{
        		return $.get('index.php?cmd=categories&do=getHint&name='+query, {}, function (response) {
        			var data = new Array();
        			$.each(response, function(i, item)
        			{
        				if(typeof(item.id) !== 'undefined' && typeof(item.label) !== 'undefined') {
        					data.push(item.id+'|'+item.label);
        				}
                    });	
        			return process(data);
        		}, 'json');
        	},
        	//output in list
        	highlighter: function(item) 
        	{
        		var parts = item.split('|');
        		return parts[1];
        	},
            //select in list
        	updater: function(item) 
        	{
        		var parts = item.split('|');
                $('#parentCategoryId', body).val(parts[0]);
                return parts[1];
        	},           	
        });
            
        $('.mceEditor', body).show();       
        
        showPredefinedParams(body);
    }
    
    function showEditForms(body) {
        $('#provider', body).each(function() {
            $('#' + $(this).val(), body).removeClass('ot-preloader-micro');
        });
        if ($('#preDefineMode', body).val() == 'category') {            
            var prevBody = body;
            var searchProvider = $('#provider:checked', body).val();
            var categoryRoot = $('#provider:checked', body).attr('categoryRoot');
            var canSearchRootCategory = $('#provider:checked', body).attr('canSearchRootCategory');
            var categories = [];
            $('#' + searchProvider, body).addClass('ot-preloader-micro');
            if (typeof(xhr) !== 'undefined') {
                xhr.abort();
            }
            xhr = $.post(
                "index.php?cmd=Categories&do=getCategoriesByProvider",
                {
                    "categoryRoot": categoryRoot,
                    "canSearchRootCategory": canSearchRootCategory
                },
                function (data) {
                    if (! data.error) {                            
                        categoriesByRoot = data.categories;
                        $('#' + searchProvider, body).removeClass('ot-preloader-micro');
                        modalDialog(trans.get('Categories'), '<div id="jstree-categoryRoot"></div>', function(body){                            
                            if (tmpSelectedSearchCategory.length != 0) {                                    
                                $.extend(dataToSavePredefinedParams, {"category" : tmpSelectedSearchCategory});
                                showPredefinedParams(prevBody)
                                return true;
                            } else {
                                showError(trans.get('Check_category'));
                                return false;
                            }
                        }, {confirm: trans.get('Save'), cancel: trans.get('Cancel')}, getCategoriesByProvider, 2);
                    } else {
                        showError(data);
                        $('#' + searchProvider, body).removeClass('ot-preloader-micro');
                        return false;
                    }
            }, 'json');
        } 
        if ($('#preDefineMode', body).val() == 'search') {
            var prevBody = body;
            var searchProvider = $('#provider:checked', body).val();
            $('#' + searchProvider, body).addClass('ot-preloader-micro');
            if (typeof(xhr) !== 'undefined') {
                xhr.abort();
            }
            xhr = $.post(
                "index.php?cmd=Categories&do=getSearchParamsForm",
                {
                    "searchProvider": searchProvider
                },
                function (data) {
                    if (! data.error) {                            
                        searchMethods = $.parseJSON(data.searchMethods);
                        $('#' + searchProvider, body).removeClass('ot-preloader-micro');
                        modalDialog(trans.get('Category_settings'), data.form, function(body) {
                            $.extend(dataToSavePredefinedParams, {"provider" : $('#provider:checked').val()});
                            $.extend(dataToSavePredefinedParams, {"searchUrl" : $('#serachUrl', body).val()});
                            $.extend(dataToSavePredefinedParams, {"searchWord" : $('#searchWord', body).val()});
                            $.extend(dataToSavePredefinedParams, {"searchMethod" : $('#searchMethod', body).val()});
                            $.extend(dataToSavePredefinedParams, {"vendor" : $('#vendor', body).val()});
                            $.extend(dataToSavePredefinedParams, {"minPrice" : $('#minPrice', body).val()});
                            $.extend(dataToSavePredefinedParams, {"maxPrice" : $('#maxPrice', body).val()});
                            $.extend(dataToSavePredefinedParams, {"brand" : $('#brand', body).val()});
                            $.extend(dataToSavePredefinedParams, {"stuffStatus" : $('#stuffStatus', body).val()});
                            $.extend(dataToSavePredefinedParams, {"featureDiscount" : $('#featureDiscount', body).val()});
                            $.extend(dataToSavePredefinedParams, {"featureAuction" : $('#featureAuction', body).val()});
                            if ($('input[id="categoryFiltersByChecks"]').length > 0) {
                                $.extend(dataToSavePredefinedParams, {"Configurators" : {}});                                
                                $.each($('input[id="categoryFiltersByChecks"]'), function() {                                    
                                    if ($(this).prop("checked") == true) {                                        
                                        tmpFilter = jQuery.parseJSON($(this).val());
                                        $.extend(dataToSavePredefinedParams.Configurators, jQuery.parseJSON($(this).val()));
                                    }
                                });
                            }
                            if (! checkPredefinedParams()) {
                                return false;
                            }
                            showPredefinedParams(prevBody);                                                           
                            return true;
                        }, {confirm: trans.get('Save'), cancel: trans.get('Cancel')}, asignSearchFormActions, 2);
                    } else {
                        showError(data);
                        $('#' + searchProvider, body).removeClass('ot-preloader-micro');
                        return false;
                    }
                }, 'json'
            );
        }
    }
    
    
    function showSearchParamsByMethod(method, body) {
        var current = '';
        $('.isVendor', body).hide();
        $('.isVendorLocation', body).hide();
        $('.isPriceRange', body).hide();
        $('.isBrand', body).hide();
        $('.isStuffStatus', body).hide();
        $('.isConfigurators', body).hide();
        $('.isFeatureDiscount', body).hide();
        $('.isFeatureAuction', body).hide();
        if (method != '') {
            $.each(searchMethods, function(i, item) {
                if (item.method == method) {
                    current = item;                    
                }
            });
            if (current == '') {
                showError(trans.get('Chosen_method_not_exist_imposible'));
                return;
            }
            $.each(current, function(i, item) {                
            	if (item == true) {                    
                    $('.is' + i, body).show();
                }
            });            
        } else {
            //TODO
            //Показываем общие - надо упростить - обобщить... 
            //Вероятно что не выйдет
            var can;            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.Vendor != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isVendor', body).show();
            }
            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.VendorLocation != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isVendorLocation', body).show();
            }
            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.PriceRange != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isPriceRange', body).show();
            }
            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.Brand != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isBrand', body).show();
            }
            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.StuffStatus != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isStuffStatus', body).show();
            }
            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.Configurators != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isConfigurators', body).show();
            }
            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.FeatureDiscount != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isFeatureDiscount', body).show();
            }
            
            can = true;
            $.each(searchMethods, function(i, item) {
                if (item.FeatureAuction != true) {
                    can = false;                    
                }
            });
            if (can == true) {
                $('.isFeatureAuction', body).show();
            }
        }
    }
    
    function asignSearchFormActions(body) {      
        if (typeof dataToSavePredefinedParams.searchWord !== 'undefined') {
            $('#searchWord', body).val(dataToSavePredefinedParams.searchWord);
        }
        if (typeof dataToSavePredefinedParams.category !== 'undefined') {
            $('.chooseSearchCategory', body).html(trans.get('Change'));
            $('#selectedSearchCategory', body).html(dataToSavePredefinedParams.category.name);
        }
        if (typeof dataToSavePredefinedParams.searchMethod !== 'undefined') {  
            $("#searchMethod option[value='" + dataToSavePredefinedParams.searchMethod + "']", body).attr("selected", "selected");
        }
        if (typeof dataToSavePredefinedParams.vendor !== 'undefined') {
            $('#vendor', body).val(dataToSavePredefinedParams.vendor);
        }
        if (typeof dataToSavePredefinedParams.minPrice !== 'undefined') {
            $('#minPrice', body).val(dataToSavePredefinedParams.minPrice);
        }
        if (typeof dataToSavePredefinedParams.maxPrice !== 'undefined') {
            $('#maxPrice', body).val(dataToSavePredefinedParams.maxPrice);
        }
        if (typeof dataToSavePredefinedParams.brand !== 'undefined') {
            $('#brand', body).val(dataToSavePredefinedParams.brand);
        }
        if (typeof dataToSavePredefinedParams.stuffStatus !== 'undefined') {
            $('#stuffStatus', body).val(dataToSavePredefinedParams.stuffStatus);
        }
        if (typeof dataToSavePredefinedParams.region !== 'undefined') {
            $('#selectedVendorLocation', body).html(dataToSavePredefinedParams.region.RegionId + ' ' + dataToSavePredefinedParams.region.name);            
        }
        if (typeof dataToSavePredefinedParams.featureDiscount !== 'undefined') {  
            $("#featureDiscount option[value='" + dataToSavePredefinedParams.featureDiscount + "']", body).attr("selected", "selected");
        }
        if (typeof dataToSavePredefinedParams.featureAuction !== 'undefined') {  
            $("#featureAuction option[value='" + dataToSavePredefinedParams.featureAuction + "']", body).attr("selected", "selected");
        }
        if (typeof dataToSavePredefinedParams.Configurators !== 'undefined') {
            if (typeof dataToSavePredefinedParams.Configurators.name === 'undefined') {
                var tmpName = '';
                $('.isConfigurators', body).find('.controls').html('');
                $.each(dataToSavePredefinedParams.Configurators, function(s, conf) {
                    tmpName = tmpName + conf.name + ':' + conf.valueName + ', ';
                });
                $('.isConfigurators', body).find('.controls').html(tmpName);
            }
        }
        
        showSearchParamsByMethod($('#searchMethod', body).val(), body);        
        $('#searchMethod', body).change(function() {  
            showSearchParamsByMethod($('#searchMethod', body).val(), body);
        });
        $('.chooseSearchCategory', body).click(function() {
            var categoryRoot = $('#provider:checked').attr('categoryRoot');
            var canSearchRootCategory = $('#provider:checked', body).attr('canSearchRootCategory');
            var categories = [];
            $('#searchCategoryPreloader').addClass('ot-preloader-micro');
            $.post(
                "index.php?cmd=Categories&do=getCategoriesByProvider",
                {
                    "categoryRoot": categoryRoot,
                    "canSearchRootCategory" : canSearchRootCategory
                },
                function (data) {
                    if (! data.error) {                            
                        categoriesByRoot = data.categories;
                        $('#searchCategoryPreloader').removeClass('ot-preloader-micro');
                        modalDialog(trans.get('Categories'), '<div id="jstree-categoryRoot"></div>', function(body){                            
                            if (tmpSelectedSearchCategory.length != 0) {
                                $.extend(dataToSavePredefinedParams, {"category" : tmpSelectedSearchCategory});                                
                                $('#selectedSearchCategory').html(dataToSavePredefinedParams.category.name);
                                $('.chooseSearchCategory').html(trans.get('Change')); 
                                $('.isConfigurators').find('.controls').html('<div class="ot-preloader-mini"></div>');
                                //TODO
                                //Список фильтров не то что великоват - он очень большой.. Надо как то сокращать
                                $.post(
                                    "index.php?cmd=Categories&do=getCategoryFiltersData",
                                    {
                                        "categoryId": dataToSavePredefinedParams.category.id
                                    },
                                    function (data) {
                                        if (! data.error) {
                                            $('.isConfigurators').find('.controls').html(data.filters);                                            
                                        } else {
                                            showError(data);
                                            return false;
                                        }
                                    }, 'json'
                                );
                                return true;
                            } else {
                                showError(trans.get('Check_category'));
                                return false;
                            }
                        }, {confirm: trans.get('Save'), cancel: trans.get('Cancel')}, getCategoriesByProvider, 3);
                    } else {
                        showError(data);
                        return false;
                    }
                }, 'json'
            );
            
        });
        $('.chooseVendorLocation', body).click(function() {
            var nModal = modalDialog(trans.get('choice_of_delivery_region'), '<div class="ot-preloader-mini"></div>', function(body){},
            {confirm: false, cancel: trans.get('Cancel')},
            function(body) {
                $(body).append('<ul id="regions"></ul>');
                $("#regions", body).treeview({
                    url: "index.php?cmd=shipment&do=regions",
                    onLoad: function() { 
                        $('.ot-preloader-mini', body).hide();
                        $('.region-select-link', body).click(function() {
                            $.extend(dataToSavePredefinedParams, {"region" : {"RegionId" : $(this).attr('regid'), "name" : $(this).attr('regname')}});                                                               
                            $('#selectedVendorLocation').html($(this).attr('regid')+' '+$(this).attr('regname'));                        
                            nModal.find('.close').trigger('click');
                            return true;
                        });
                    }
                });
            }, 3);
        });
        //Мой колапс - колапс бустрапа закрывает модальное окно при сворачивании
        $('.collapseSearchForm', body).click(function() {
            if (! $('.collapseSearchForm', body).hasClass('disabled')) {
                if ($('.collapsedSearchForm', body).hasClass('hidden-element')) {
                    $('.collapsedSearchForm', body).removeClass('hidden-element').addClass('visible-element');
                    console.log('switch - auto');
                } else {
                    $('.collapsedSearchForm', body).removeClass('visible-element').addClass('hidden-element');
                    console.log('switch - none');
                }
            }
        });
        $('#serachUrl', body).keyup(function() {
            if ($('#serachUrl', body).val() != '') {
                $('.collapseSearchForm', body).addClass('disabled');
                $('.collapsedSearchForm', body).removeClass('visible-element').addClass('hidden-element');
            } else {
                $('.collapseSearchForm', body).removeClass('disabled');
            }
        });
    }
    
    function getCategoriesByProvider(body) {
        //TODO
        //Дерево вносит рутовую категорию не в начало 
        //(если ее можно выбрать - флаг canSearchRootCategory)
        $("#jstree-categoryRoot", body)
        .jstree({
            "plugins" : ["themes","json_data","ui","search","types"], //,'contextmenu',"dnd"
            "themes" : {
            	            "theme" : "classic",
            	            "dots" : true,
            	            "icons" : true
            	        },
            "json_data" : {
                "data" : getPreparedCategories(categoriesByRoot, true),
                'correct_state': true,
                'progressive_render': true,
                'progressive_unload': true,
                "ajax" : {
                    "url" : 'index.php?cmd=Categories&do=getCategoriesByProvider',
                    // the `data` function is executed in the instance's scope
                    // the parameter is the node being loaded
                    // (may be -1, 0, or undefined when loading the root nodes)
                    "data" : function (node) {
                        // the result is fed to the AJAX request `data` option
                        return {
                            "categoryRoot" : node.attr ? node.attr("id") : 0
                        };
                    },
                    "success" : function (data) {
                        if (data.categories) {
                            if (data.categories.length) {
                                return getPreparedCategories(data.categories, true);
                            } else if (lastLoadedNodeCategoryRoot) {
                                lastLoadedNodeCategoryRoot.removeClass('jstree-open').addClass('jstree-leaf');
                            }
                        } else {
                            showError(data);
                        }
                    }
                }
            }
        })
        .one("reopen.jstree", function (event, data) {
        })
        .one("reselect.jstree", function (event, data) {
        })
        .bind("select_node.jstree", function (event, data) {
            var id = data.rslt.obj.attr('id');
            var externalId = data.rslt.obj.attr('externalid');
        	var name = data.rslt.obj.attr('name');
            if (! id) {
                id = $('#provider:checked').attr('categoryRoot');
            }
            tmpSelectedSearchCategory = {};
            $.extend(tmpSelectedSearchCategory, {"name" : name, "id" : externalId}); //id, "externalId": externalId
        })
        .bind("loaded.jstree", function (event, data) { 
        })
        .bind("load_node.jstree", function (event, data) {
            lastLoadedNodeCategoryRoot = data.rslt.obj;
        });
        
    }
    
    function checkPredefinedParams() {
        var can = false;
        var tmpName = '';
        
        if (dataToSavePredefinedParams.preDefineMode == '') {
            showError(trans.get('Set_category_mode'));
            return false;
        }
        if (dataToSavePredefinedParams.preDefineMode == 'virtual') {
            return true;
        }
        $.each(dataToSavePredefinedParams, function(i, item) {            
            if ((i != 'preDefineMode') && (i != 'provider')) {
                if (typeof item == 'object') {
                    if (! $.isEmptyObject(item)) {
                        tmpName = 'object';
                    }
                } else {
                    if (item != '') { 
                        tmpName = item;
                    }
                }
                if (tmpName != '') {
                    can = true;                    
                }
            }
        });
        if (! can) {
            showError(trans.get('Must_set_at_minimum_one_category_setting'));
        }
        return can;
    }
    
    function showPredefinedParams(body) {
        var tmpName;
        $(body).find('.preDefinedParams').html('');
        $.each(dataToSavePredefinedParams, function(i, item) {
            tmpName = '';            
            if (typeof item == 'object') {
                if (typeof item.name === 'undefined') {
                    $.each(item, function(s, conf) {
                        if ((typeof conf !== 'undefined') && (typeof conf.name !== 'undefined')) {
                            tmpName = tmpName + conf.name + ':' + conf.valueName + ', ';
                        }
                    });                    
                } else {
                    tmpName = item.name;
                }
            } else {
                tmpName = item;                
            }
            if (tmpName != '') {
                $(body).find('.preDefinedParams').append('<div class="controls">' + trans.get('search_category_param_' + i) + ' - ' + trans.get(tmpName) + '</div>');
            }
        });        
        if (dataToSavePredefinedParams.preDefineMode != 'virtual') {
            if ($(body).find('.preDefinedParams').html() != '') {
                $(body).find('.preDefinedParams').append('<div class="controls"><span class="blink blink-iconed changePreDefinedParams">' + trans.get('Edit') + '</span></div>');
                $('.changePreDefinedParams', body).click(function() {
                    showEditForms(body);
                });
            }
        }
    }
    
    function getPreparedCategories(categories, showPreviewHref) {
        var preparedCategories = [];
        var providerType;
        var approxWeight;
        
        _.each(categories, function (item) {
            var category = item.attributes ? item.attributes : item;            
            if ((typeof category.ProviderType === 'undefined') || (category.ProviderType == '')) {
                providerType = ' ';
            } else {
                providerType = ' [' + category.ProviderType + '] ';
            }
            if (typeof showPreviewHref === 'undefined') {
                categoryHref = '';
            } else {
                categoryHref = "<a href='http://demo.opentao.net/?p=subcategory&cid=" + category.id + "' target='_blank'>открыть</a>";
            }
            if (category.ApproxWeight == '') {
                approxWeight = ' ';
            } else {
                approxWeight = ' (' + category.ApproxWeight + ' ' + trans.get('kg') + ')';
            }            
            var prepared = {
                "data" : {
                    "title" : $.trim(category.Name + approxWeight + providerType),
                    "metadata" : '<div class="actions"></div>',
                    "icon" : categoryHref
                },
                "attr" : category
            };
            if (category.IsParent == 'true') {
                prepared.icon = 'folder';
                prepared.children = [];
            } else {
                prepared.icon = 'folder';
            }
            if (category.DeleteStatusUI == 'true') {
                prepared.data.icon = 'folderr';
            } 
            
            preparedCategories.push(prepared);
        });
        return preparedCategories;
    }
    
    
//Функции по привязке END======================

function categories_filter_changed(scope, params)
{
    $('form#filter #' + scope.name + '_value').val(scope.value);
    $('form#filter').submit();
} 	

function removeTinyMCE(){
    if (tinyMCE.editors.length > 0) {
    	var count = tinyMCE.editors.length;
    	for ( var int = count-1; int >= 0; int--) {
    		tinyMCE.remove(tinyMCE.editors[int]);
		}
    }      
}

function initTinyMCE()
{
    var width = jQuery(window).width();
    var left = (width-690) / 2;
    if (tinyMCE.editors.length > 0) {
    	return false; 
    }
    tinyMCE.init({
        mode : "exact",
        elements : "seoText1",
        theme : "advanced",
        height: 230,
        plugins : "table,heading,advhr,advimage,advlink,paste,fullscreen,noneditable,contextmenu,inlinepopups,emotions,media,insertdatetime,nonbreaking",
        theme_advanced_buttons1_add_before : "newdocument,separator",
        theme_advanced_buttons1_add_before : "fontselect,fontsizeselect,h1,h2,h3,h4,h5,h6,separator",
        theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle,separator,insertdate,inserttime",
        theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator",
        theme_advanced_buttons3_add_before : "tablecontrols,separator",
        theme_advanced_buttons3_add : "flash,advhr,emotions,media,nonbreaking,separator,fullscreen",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        extended_valid_elements : "hr[class|width|size|noshade],ul[class=listUL],ol[class=listOL],script[language|type|src], object[width|height|classid|codebase|embed|param],param[name|value],embed[param|src|type|width|height|flashvars|wmode], iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder]",
        media_strict: false,
        file_browser_callback : "ajaxfilemanager",
        paste_use_dialog : false,
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : true,
        apply_source_formatting : true,
        force_br_newlines : true,
        forced_root_block : "div",
        force_p_newlines : false,
        relative_urls : true,
        heading_clear_tag : "p",
        content_css : "../css/style.css"
    });
} 

// Disable dialog key process
$(document).ready(function(){
    $(document).unbind('keyup');
});