BX.namespace('BX.Sale.component.location.selector');


if (typeof BX.Sale.component.location.selector.steps == 'undefined' && typeof BX.ui != 'undefined' && typeof BX.ui.widget != 'undefined') {

    BX.Sale.component.location.selector.steps = function (opts, nf) {

        this.parentConstruct(BX.Sale.component.location.selector.steps, opts);

        BX.merge(this, {
            opts: {
                bindEvents: {
                    'after-select-item': function (value) {

                        if (typeof this.opts.callback == 'string' && this.opts.callback.length > 0 && this.opts.callback in window)
                            window[this.opts.callback].apply(this, [value, this]);
                    }
                },
                disableKeyboardInput: false,
                dontShowNextChoice: false,
                pseudoValues: [], // values that can be only displayed as selected, but not actually selected
                provideLinkBy: 'id'
            },
            vars: {
                cache: {nodesByCode: {}}
            },
            sys: {
                code: 'slst'
            }
        });

        this.handleInitStack(nf, BX.Sale.component.location.selector.steps, opts);
    };
    BX.extend(BX.Sale.component.location.selector.steps, BX.ui.chainedSelectors);
    BX.merge(BX.Sale.component.location.selector.steps.prototype, {

        // member of stack of initializers, must be defined even if does nothing
        init: function () {
            this.pushFuncStack('buildUpDOM', BX.Sale.component.location.selector.steps);
            this.pushFuncStack('bindEvents', BX.Sale.component.location.selector.steps);
        },

        // add additional controls
        buildUpDOM: function () {
        },

        bindEvents: function () {

            var ctx = this,
                so = this.opts;

            if (so.disableKeyboardInput) { //toggleDropDown
                this.bindEvent('after-control-placed', function (adapter) {

                    var control = adapter.getControl();

                    BX.unbindAll(control.ctrls.toggle);
                    // spike, bad idea to access fields directly
                    BX.bind(control.ctrls.scope, 'click', function (e) {
                        control.toggleDropDown();
                    });
                });
            }

            // quick links
            BX.bindDelegate(this.getControl('quick-locations', true), 'click', {tag: 'a'}, function () {
                ctx.setValueByLocationId(BX.data(this, 'id'));
            });
        },

        ////////// PUBLIC: free to use outside

        setValueByLocationId: function (id) {

            BX.Sale.component.location.selector.steps.superclass.setValue.apply(this, [id]);
        },

        setValueByLocationCode: function (code) {

            var sv = this.vars;

            // clean
            if (code == null || code == false || typeof code == 'undefined' || code.toString().length == 0) { // deselect
                this.displayRoute([]);
                this.setValueVariable('');
                this.setTargetValue('');
                this.fireEvent('after-clear-selection');
                return;
            }

            // set
            this.fireEvent('before-set-value', [code]);

            var d = new BX.deferred();
            var ctx = this;

            d.done(BX.proxy(function (route) {

                this.displayRoute(route);

                var value = sv.cache.nodesByCode[code].VALUE;
                sv.value = value;
                this.setTargetValue(this.checkCanSelectItem(value) ? value : this.getLastValidValue());

            }, this));

            d.fail(function (type) {
                if (type == 'notfound') {

                    ctx.displayRoute([]);
                    ctx.setValueVariable('');
                    ctx.setTargetValue('');
                    ctx.showError({errors: [ctx.opts.messages.nothingFound], type: 'server-logic', options: {}});
                }
            });

            this.hideError();

            this.getRouteToNodeByCode(code, d);
        },

        setValue: function (value) {

            if (this.opts.provideLinkBy == 'id')
                BX.Sale.component.location.selector.steps.superclass.setValue.apply(this, [value]);
            else
                this.setValueByLocationCode(value);
        },

        setTargetValue: function (value) {

            this.setTargetInputValue(this.opts.provideLinkBy == 'code' ? (value ? this.vars.cache.nodes[value].CODE : '') : value);
            this.fireEvent('after-select-item', [value]);
        },

        getValue: function () {

            if (this.opts.provideLinkBy == 'id')
                return this.vars.value === false ? '' : this.vars.value;
            else {
                return this.vars.value ? this.vars.cache.nodes[this.vars.value].CODE : '';
            }
        },

        getNodeByLocationId: function (value) {

            return this.vars.cache.nodes[value];
        },

        getSelectedPath: function () {

            var sv = this.vars,
                result = [];

            if (typeof sv.value == 'undefined' || sv.value == false || sv.value == '')
                return result;

            if (typeof sv.cache.nodes[sv.value] != 'undefined') {

                var node = sv.cache.nodes[sv.value];
                while (typeof node != 'undefined') {
                    var item = BX.clone(node);
                    var parentId = item.PARENT_VALUE;

                    delete(item.PATH);
                    delete(item.PARENT_VALUE);
                    delete(item.IS_PARENT);

                    if (typeof item.TYPE_ID != 'undefined' && typeof this.opts.types != 'undefined')
                        item.TYPE = this.opts.types[item.TYPE_ID].CODE;

                    result.push(item);

                    if (typeof parentId == 'undefined' || typeof sv.cache.nodes[parentId] == 'undefined')
                        break;
                    else
                        node = sv.cache.nodes[parentId];
                }
            }

            return result;
        },

        ////////// PRIVATE: forbidden to use outside (for compatibility reasons)

        setInitialValue: function () {

            if (this.opts.selectedItem !== false) // there will be always a value as ID, no matter what this.opts.provideLinkBy is equal to
                this.setValueByLocationId(this.opts.selectedItem);
            else if (this.ctrls.inputs.origin.value.length > 0) // there colud be eiter ID or CODE
            {
                if (this.opts.provideLinkBy == 'id')
                    this.setValueByLocationId(this.ctrls.inputs.origin.value);
                else
                    this.setValueByLocationCode(this.ctrls.inputs.origin.value);
            }
        },

        // get route for nodeId and resolve deferred with it
        getRouteToNodeByCode: function (code, d) {

            var sv = this.vars,
                ctx = this;

            if (typeof code != 'undefined' && code !== false && code.toString().length > 0) {

                var route = [];

                if (typeof sv.cache.nodesByCode[code] != 'undefined')
                    route = this.getRouteToNodeFromCache(sv.cache.nodesByCode[code].VALUE);

                if (route.length == 0) { // || (sv.cache.nodes[nodeId].IS_PARENT && typeof sv.cache.links[nodeId] == 'undefined')){

                    // no way existed or item is parent without children downloaded

                    // download route, then try again
                    ctx.downloadBundle({
                        request: {CODE: code}, // get only route
                        callbacks: {
                            onLoad: function (data) {

                                // mark absent as incomplete, kz we do not know if there are really more items of that level or not
                                for (var k in data) {
                                    if (typeof sv.cache.links[k] == 'undefined')
                                        sv.cache.incomplete[k] = true;
                                }

                                ctx.fillCache(data, true);

                                route = [];

                                // trying to re-get
                                if (typeof sv.cache.nodesByCode[code] != 'undefined')
                                    route = this.getRouteToNodeFromCache(sv.cache.nodesByCode[code].VALUE);

                                if (route.length == 0)
                                    d.reject('notfound');
                                else
                                    d.resolve(route);
                            },
                            onError: function () {
                                d.reject('internal');
                            }
                        },
                        options: {} // accessible in refineRequest\refineResponce and showError
                    });

                } else
                    d.resolve(route);
            } else
                d.resolve([]);
        },

        addItem2Cache: function (item) {

            this.vars.cache.nodes[item.VALUE] = item;
            this.vars.cache.nodesByCode[item.CODE] = item;
        },

        controlChangeActions: function (stackIndex, value) {

            var ctx = this,
                so = this.opts,
                sv = this.vars,
                sc = this.ctrls;

            this.hideError();

            ////////////////

            if (value.length == 0) {

                ctx.truncateStack(stackIndex);
                sv.value = ctx.getLastValidValue();
                ctx.setTargetValue(sv.value);

                this.fireEvent('after-select-real-value');

            } else if (BX.util.in_array(value, so.pseudoValues)) {

                ctx.truncateStack(stackIndex);
                ctx.setTargetValue(ctx.getLastValidValue());
                this.fireEvent('after-select-item', [value]);

                this.fireEvent('after-select-pseudo-value');

            } else {

                var node = sv.cache.nodes[value];

                if (typeof node == 'undefined')
                    throw new Error('Selected node not found in the cache');

                // node found

                ctx.truncateStack(stackIndex);

                if (so.dontShowNextChoice) {
                    if (node.IS_UNCHOOSABLE)
                        ctx.appendControl(value);
                } else {
                    if (typeof sv.cache.links[value] != 'undefined' || node.IS_PARENT)
                        ctx.appendControl(value);
                }

                if (ctx.checkCanSelectItem(value)) {
                    sv.value = value;
                    ctx.setTargetValue(value);
                    this.fireEvent('after-select-real-value');
                }
            }
        },

        // adapter to ajax page request
        refineRequest: function (request) {

            var filter = {};
            var select = {
                'VALUE': 'ID',
                'DISPLAY': 'NAME.NAME',
                '1': 'TYPE_ID',
                '2': 'CODE'
            };
            var additionals = {};

            if (typeof request['PARENT_VALUE'] != 'undefined') { // bundle request
                filter['=PARENT_ID'] = request.PARENT_VALUE;
                select['10'] = 'IS_PARENT';
            }

            if (typeof request['VALUE'] != 'undefined') { // search by id
                filter['=ID'] = request.VALUE;
                additionals['1'] = 'PATH';
            }

            if (BX.type.isNotEmptyString(request['CODE'])) { // search by code
                filter['=CODE'] = request.CODE;
                additionals['1'] = 'PATH';
            }

            if (BX.type.isNotEmptyString(this.opts.query.BEHAVIOUR.LANGUAGE_ID))
                filter['=NAME.LANGUAGE_ID'] = this.opts.query.BEHAVIOUR.LANGUAGE_ID;

            // we are already inside linked sub-tree, no deeper check for SITE_ID needed
            if (BX.type.isNotEmptyString(this.opts.query.FILTER.SITE_ID)) {

                if (typeof this.vars.cache.nodes[request.PARENT_VALUE] == 'undefined' || this.vars.cache.nodes[request.PARENT_VALUE].IS_UNCHOOSABLE)
                    filter['=SITE_ID'] = this.opts.query.FILTER.SITE_ID;
            }

            return {
                'select': select,
                'filter': filter,
                'additionals': additionals,
                'version': '2'
            };
        },

        // adapter to ajax page responce
        refineResponce: function (responce, request) {

            if (responce.length == 0)
                return responce;

            if (typeof request.PARENT_VALUE != 'undefined') { // it was a bundle request

                var r = {};
                r[request.PARENT_VALUE] = responce['ITEMS'];
                responce = r;

            } else if (typeof request.VALUE != 'undefined' || typeof request.CODE != 'undefined') { // it was a route request

                var levels = {};

                if (typeof responce.ITEMS[0] != 'undefined' && typeof responce.ETC.PATH_ITEMS != 'undefined') {

                    var parentId = 0;

                    for (var k = responce.ITEMS[0]['PATH'].length - 1; k >= 0; k--) {

                        var itemId = responce.ITEMS[0]['PATH'][k];
                        var item = responce.ETC.PATH_ITEMS[itemId];

                        item.IS_PARENT = true;

                        levels[parentId] = [item];

                        parentId = item.VALUE;
                    }

                    // add item itself
                    levels[parentId] = [responce.ITEMS[0]];
                }

                responce = levels;
            }

            return responce;
        },

        showError: function (parameters) {

            if (parameters.type != 'server-logic')
                parameters.errors = [this.opts.messages.error]; // generic error on js error
            alert(BX.util.htmlspecialchars(parameters.errors.join(', ')));
            this.ctrls.errorMessage.innerHTML = '<p><font class="errortext">' + BX.util.htmlspecialchars(parameters.errors.join(', ')) + '</font></p>';
            BX.show(this.ctrls.errorMessage);

            BX.debug(parameters);
        }
    });
}

var locationAjax = 0;

var arCountriesWithCities = ["Россия", "Украина", "Казахстан", "США"];
//"США", "Эстония", , "Беларусь", "Азербайджан"


if(languageId == 'en') {
    arCountriesWithCities = ["Russia", "Ukraine", "Kazakhstan", "United States"];
}


function locationSelector() {

    //submitForm();
    if(languageId == "en"){
        loc = jQuery('input[name="ORDER_PROP_44"]').val();
    }else{
        loc = jQuery('input[name="ORDER_PROP_6"]').val();
    }

    var newLoc = "";
    var activeCountry = $('.bx-ui-slst-input-block:eq(0) input.bx-ui-combobox-fake').val();

    if (arCountriesWithCities.join().search(activeCountry) != -1) {



        if ($('.bx-ui-slst-input-block:eq(1) input.bx-ui-combobox-fake').val() == "") {
            var urlCountry = "/local/include/ajax-location-country.php";
            if(languageId == 'en') {
                urlCountry = '/en' + urlCountry;
            }
            //достать первый попавшийся город в стране
            $.ajax({
                url: urlCountry,
                data: "loc=" + loc,
                type: 'POST',
                async: false,
                error: function (data) {
                },
                success: function (data) {

                    newLoc = data;
                }
            });
            //loc = parseInt(loc) + 2;
            loc = newLoc;
            if(languageId == "en"){
                jQuery('input[name="ORDER_PROP_44"]').val(loc);
            }else{
                jQuery('input[name="ORDER_PROP_6"]').val(loc);
            }


            locationAjax = 0;
        }

        if ($('.bx-ui-slst-input-block:eq(2) input.bx-ui-combobox-fake').val() == "") {
            var urlRegion = "/local/include/ajax-location-region.php";
            if(languageId == 'en') {
                urlRegion = '/en' + urlRegion;
            }
            //достать первый попавшийся город в регионе
            $.ajax({
                url: urlRegion,
                data: "loc=" + loc,
                type: 'POST',
                async: false,
                error: function (data) {
                },
                success: function (data) {

                    newLoc = data;
                }
            });

            //loc = parseInt(loc) + 1;
            loc = newLoc;
            if(languageId == "en"){
                jQuery('input[name="ORDER_PROP_44"]').val(loc);
            }else{
                jQuery('input[name="ORDER_PROP_6"]').val(loc);
            }

            locationAjax = 0;
        }

    }

    if (locationAjax == 0) {

        submitForm("N");
    }
}

$(document).ready(function () {

    BX.addCustomEvent('onAjaxSuccess', function (e) {



        $("label").off("click");
        $("label").on("click", function () {

            if(languageId == "en"){
                loc = jQuery('input[name="ORDER_PROP_44"]').val();
            }else{
                loc = jQuery('input[name="ORDER_PROP_6"]').val();
            }


        });


        var html = $(".bx-ui-slst-pool").html();
        html = html.replace(/\s{2,}/g, '');



        if (html == "") {


            if (!window.BX && top.BX)
                window.BX = top.BX;


            BX.namespace('BX.Sale.component.location.selector');

            var defaultBundles = {
                'a': [],
                '0': [{'DISPLAY': 'Россия', 'VALUE': 19, 'CODE': '19', 'IS_PARENT': true, 'TYPE_ID': 1}],
                '19': [{
                    'DISPLAY': 'Сахалинская область',
                    'VALUE': 977,
                    'CODE': '977',
                    'IS_PARENT': true,
                    'TYPE_ID': 2
                }],
                '977': [{'DISPLAY': 'Долинск', 'VALUE': 980, 'CODE': '980', 'IS_PARENT': false, 'TYPE_ID': 3}]
            };
            var error = 'К сожалению, произошла внутренняя ошибка';
            var nothingFound = 'К сожалению, ничего не найдено';

            if(languageId == 'en') {
                defaultBundles = {
                    'a': [],
                    '0': [{'DISPLAY': 'Russia', 'VALUE': 19, 'CODE': '19', 'IS_PARENT': true, 'TYPE_ID': 1}],
                    '19': [{
                        'DISPLAY': 'Sakhalinskaya obl',
                        'VALUE': 977,
                        'CODE': '977',
                        'IS_PARENT': true,
                        'TYPE_ID': 2
                    }],
                    '977': [{'DISPLAY': 'Dolinsk', 'VALUE': 980, 'CODE': '980', 'IS_PARENT': false, 'TYPE_ID': 3}]
                };

                error = 'Sorry, there was an internal error';
                nothingFound = 'Sorry, nothing found';
            }


            new BX.Sale.component.location.selector.steps({
                'scope': 'sls',
                'source': '/bitrix/components/bitrix/sale.location.selector.steps/get.php',
                'query': {'FILTER': {'SITE_ID': 'en'}, 'BEHAVIOUR': {'SEARCH_BY_PRIMARY': '0', 'LANGUAGE_ID': languageId}},
                'selectedItem': loc,
                'knownBundles': defaultBundles,
                'provideLinkBy': 'id',
                'messages': {
                    'notSelected': '',
                    'error': error,
                    'nothingFound': nothingFound,
                    'clearSelection': '--- '
                },
                'callback': 'locationSelector',
                'useSpawn': false,
                'initializeByGlobalEvent': '',
                'globalEventScope': '',
                'rootNodeValue': 0,
                'showDefault': false,
                'bundlesIncomplete': {'a': true, '0': true, '19': true, '977': true, '980': true},
                'autoSelectWhenSingle': true,
                'types': {'1': {'CODE': 'COUNTRY'}, '2': {'CODE': 'REGION'}, '3': {'CODE': 'CITY'}},
                'disableKeyboardInput': false,
                'dontShowNextChoice': false
            });





            locationAjax = 1;

        } else {
            locationAjax = 0;

        }



        $(".js-form__preload-container").hide();
        //BX.closeWait();


        var activeCountry = $('.bx-ui-slst-input-block:eq(0) input.bx-ui-combobox-fake').val();

        if (arCountriesWithCities.join().search(activeCountry) == -1) {

            $(".ORDER_PROP_INDEX").show();
            $(".ORDER_PROP_CITY").show();
            $(".b-selector__notice").css("display", "none");

        } else {

            $(".ORDER_PROP_INDEX").hide();
            $(".ORDER_PROP_CITY").hide();

            //показать уведомление под селектором города
            $(".b-selector__notice").css("display", "block");
        }




    });

});

$(window).on("load", function () {

    var activeCountry = $('.bx-ui-slst-input-block:eq(0) input.bx-ui-combobox-fake').val();

    if (arCountriesWithCities.join().search(activeCountry) == -1) {

        $(".ORDER_PROP_INDEX").show();
        $(".ORDER_PROP_CITY").show();
        $(".b-selector__notice").css("display", "none");

    } else {

        $(".ORDER_PROP_INDEX").hide();
        $(".ORDER_PROP_CITY").hide();
        //показать уведомление под селектором города
        $(".b-selector__notice").css("display", "block");
    }


});
