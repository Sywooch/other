var WarehouseItemsPage = Backbone.View.extend({
    "el": "#warehouse-product",
    "events": {
        "click #add-product": "checkCategorySelected",
        "mousedown #CategoryName": "showCategoryHint",
        "click #submit_btn": "saveProduct"
    },
    saveProduct: function(ev, reloadPage)
    {
        ev.preventDefault();
        
        var price = $('#Price').val();
        var qty = $('#Quantity').val();
        var cid = $('#CategoryId').val();
        
        price = parseFloat(price);
        qty = parseFloat(qty);
        cid = parseInt(cid); 
        
        var errorMessage = '';
        if ( isNaN(price) || (!isNaN(price) && price<=0) ) {
        	errorMessage += trans.get('Price_must_be_positive') + '<br>';
        }
        if ( isNaN(qty) || (!isNaN(qty) && qty<=0) ) {
        	errorMessage += trans.get('Incorrect_quantity') + '<br>';
        }
        if ( isNaN(cid) || (!isNaN(cid) && cid<=0) ) {
        	errorMessage += trans.get('Category_not_selected') + '<br>';
        }
        
        if (errorMessage.length > 0) {
        	showError(errorMessage);
        	return false;
        }
       
        var btn = this.$('#submit_btn');
        btn.button('loading').siblings('button, a').addClass('disabled');
        btn.closest('form').ajaxSubmit({
            url     :   $(this).attr('action'),
            type    :   'POST',
            dataType:   'json',
            success :   function(data) {
                if (! data.error) {
                    showMessage(trans.get('Data_save_success'));
                } else {
                    showError(data);
                }
                if ('undefined' !== typeof reloadPage) {
                    window.location.reload();
                    return;
                }
                if (data.redirect) {
                    window.location.replace(data.redirect);
                    return;
                }
                btn.button('reset').siblings('button, a').removeClass('disabled');
             }
        });
        return false;
    },
    checkCategorySelected: function()
    {
        var selectedCategory = this.$('#ex-tree').tree('selectedItems');
        var categoryId = 0;
        if (selectedCategory.length) {
            categoryId = selectedCategory[0].additionalParameters.Id;
        }
        var url = this.$('#add-product').attr('href');
        this.$('#add-product').attr('href', url + '&category=' + categoryId);

        return true;
    },
    setSelectedCategory: function(categoryInfo)
    {
        this.$('#CategoryName').val(categoryInfo[0].additionalParameters.Name);
        this.$('#CategoryId').val(categoryInfo[0].additionalParameters.Id);
    },
    setUnselectedCategory: function()
    {
        this.$('#CategoryName').val(trans.get('Category_not_selected'));
        this.$('#CategoryId').val(0);
    },
    showCategoryHint: function(e)
    {
        if ($(e.target).attr('disabled')) {
            showMessage(trans.get('Choose_category_in_the_list'));
        }
    },
    openCurrentItem: function()
    {
        var that = this;
        that.$('#ex-tree').off('loaded');

        if (typeof currentItem === 'undefined') {
            return;
        }

        if (currentItem.type == 'item') {
            var elem = that.$('div.tree-item-name:contains("'+ currentItem.data.Name +' ('+ currentItem.data.Id +')")').parent();
            that.$('#ex-tree').tree("selectItem", elem);
        }
        else{
            var elem = that.$('div.tree-folder-name:contains("'+ currentItem.data.Name +' ('+ currentItem.data.Id +')")').parent();
            that.$('#ex-tree').tree("selectFolder", elem);
        }
    },
    openCategory: function()
    {
        var that = this;
        that.$('#ex-tree').off('loaded');

        if (categoryPath && categoryPath.length) {
            var folder = categoryPath.pop();
            var elem = that.$('div.tree-folder-name:contains("'+ folder.Name +' ('+ folder.Id +')")').parent();
            that.$('#ex-tree').tree("selectFolder", elem);

            this.$('#ex-tree').on('loaded', function(e){
                that.openCategory();
            });
        }
        else{
            that.openCurrentItem();
        }
    },
    initGetItemInfoField: function()
    {

        var that = this;
        this.$('.get-item-info').editable().on('save', function(e, data){
            if (data.error) {
                showError(data);
                return;
            }
            var json = data.response;            
            if(! that.$('#Name').val())
                that.$('#Name').val(json.Name);
            if(! that.$('#Vendor').val())
                that.$('#Vendor').val(json.Vendor);
            if(! that.$('#Price').val())
                that.$('#Price').val(json.Price);
            if(! that.$('#Quantity').val() || that.$('#Quantity').val() == "1")
                that.$('#Quantity').val(json.Quantity);
            console.log(json);    
            if(! that.$('#Weight').val())
                that.$('#Weight').val(json.Weight);

            var body = '';
            if (json.Config.length) {
                if (! that.$('#MainImageUrl').val()) {
                    if (json.Config[0].ImageUrl) {
                        that.$('#MainImageThumb').attr('src', json.Config[0].ImageUrlThumb);
                        that.$('#ExistingMainImageUrl').val(json.Config[0].ImageUrl);
                    }
                    else{
                        that.$('#MainImageThumb').attr('src', json.MainImageUrlThumb);
                        that.$('#ExistingMainImageUrl').val(json.MainImageUrl);
                    }
                }
                for (var i in json.Config) {
                    body += json.Config[i].Name + ": " + json.Config[i].Value + "<br />";
                }
            }
            else{
                if (! that.$('#MainImageUrl').val()) {
                    that.$('#MainImageThumb').attr('src', json.MainImageUrlThumb);
                    that.$('#ExistingMainImageUrl').val(json.MainImageUrl);
                }
            }

            if (!tinyMCE.editors[0].getContent()) {
                $.get('../index.php?p=itemdescription&itemid='+json.Id)
                    .success(function(data){
                        body += data;
                        tinyMCE.editors[0].setContent(body);
                    })
                    .error(function(xhr, ajaxOptions, thrownError){
                        handleAjaxError(xhr.responseText, thrownError);
                    });
            }
        });
    },
    render: function()
    {
        var self = this;

        this.initGetItemInfoField();
            $('.confirmDialog .mceEditor').remove();
        tinyMCE.init({
            mode : "exact",
            elements : "Description",
            theme : "advanced",
            height: 500,
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
            content_css : "../css/style.css"
        });

        setTimeout(function(){
            tinyMCE.get('Description').setContent($('#item-description').html());
        }, 2000);

        return this;
    },
    getPreparedCategories: function (categories)
    {
        var self = this;
        var preparedCategories = [];
        _.each(categories, function (item) {
            var category = item.attributes ? item.attributes : item;
            var prepared = {
                "data" : {
                    "title" : category.Name,
                },
                "attr" : category
                // `state` and `children` are only used for NON-leaf nodes
                //"state" : "", // or "open", defaults to "closed"
            };
            if (category.IsParent == 'true') {
                prepared.icon = 'folder';
                prepared.children = self.getPreparedCategories(category.children);
            } else {
                prepared.icon = 'folder';
            }
            preparedCategories.push(prepared);
        });
        return preparedCategories;
    },
    initialize: function(){
        var self = this;
        this.render();

        $('#tree-modal .btn-primary').click(function() {
            var categoryId = $('#tree-modal #categoryId').val();
            var categoryName = $('#tree-modal #categoryName').val();
            if (categoryId > 0) {
                $('.ot_form #CategoryId').attr('value', categoryId);
                $('.ot_form #CategoryName').attr('value', categoryName);

                $('#tree-modal').modal('hide');
            }
            else {
                showError(trans.get('Choose_category_in_the_list'));
            }
        });

        $("#jstree")
        .jstree({
            "plugins" : ["themes","json_data","ui","crrm","search","types"], //,'contextmenu',"dnd"
            "themes" : {
                            "theme" : "classic",
                            "dots" : true,
                            "icons" : true
                        },
            "json_data" : {
                "data" : self.getPreparedCategories(WarehouseCategories.models),
                'correct_state': true,
                'progressive_render': true,
                'progressive_unload': true,
                "ajax" : {
                    "url" : 'index.php?cmd=Warehouse&do=getCategories',
                    // the `data` function is executed in the instance's scope
                    // the parameter is the node being loaded
                    // (may be -1, 0, or undefined when loading the root nodes)
                    "data" : function (node)
                    {
                        // the result is fed to the AJAX request `data` option
                        return {
                            "parentId" : node.attr ? node.attr("id") : 0
                        };
                    },
                    "success" : function (data)
                    {
                        if (data.categories) {
                            if (data.categories.length) {
                                return self.getPreparedCategories(data.categories);
                            } else if (self.lastLoadedNode) {
                                self.lastLoadedNode.removeClass('jstree-open').addClass('jstree-leaf');
                            }
                        } else {
                            showError(data.message ? data.message : trans.get('Notify_error'));
                        }
                    }
                }
            }
        })
        .one("reopen.jstree", function (event, data) {
        })
        // 3) but if you are using the cookie plugin or the UI `initially_select` option:
        .one("reselect.jstree", function (event, data) {
        })
        .bind("loaded.jstree", function(e, data){
        })
        .bind("select_node.jstree", function (event, data) {
            var id =data.rslt.obj.attr('id');
            var name = $('a:first', data.rslt.obj).text();
            if (id) {
                $('#tree-modal #categoryId').val(id);
                $('#tree-modal #categoryName').val(name);
            }
            else {
                $('#tree-modal #categoryId').val('0');
                $('#tree-modal #categoryName').val(name);
            }
        })
        .bind("loaded.jstree", function (event, data) {
             $("#jstree").jstree('open_all');
        })
        .bind("load_node.jstree", function (event, data) {
            self.lastLoadedNode = data.rslt.obj;
        });
        $('#tree-modal').on('shown', function () {
            var categoryName = $('.ot_form #CategoryName').val();
            var categoryId = $('.ot_form #CategoryId').val();
            $('#tree-modal #categoryId').val(categoryId);
            $('#tree-modal #categoryName').val(categoryName);
            $("#jstree").jstree("select_node","#"+categoryId);
        });
        $(".input_numeric_only").keydown(function(event) {
            if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
                (event.keyCode == 65 && event.ctrlKey === true) ||
                (event.keyCode >= 35 && event.keyCode <= 39)) {
                     return;
            }
            else {
                if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                    event.preventDefault();
                }
            }
        });
    }
});

$(function(){
    new WarehouseItemsPage();
});
