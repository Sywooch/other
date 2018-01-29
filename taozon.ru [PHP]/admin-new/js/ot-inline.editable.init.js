$.fn.editable.defaults.mode = 'inline';
$(document).ready( function () {

    var XEditableFieldView = Backbone.View.extend({
        prepareXEditablePossibleValues: function(){
            var values = [];
            try{
                for(var i in this.model.get('valuesList')){
                    var key = this.model.get('name')+'_value:'+this.model.get('valuesList')[i];
                    var text = '';
                    if(trans.get(key) == key)
                        text = trans.get(this.model.get('name')+'_value:*');
                    else
                        text = trans.get(key);

                    values.push({
                        value: this.model.get('valuesList')[i],
                        text: text
                    });
                }
            }
            catch(e){
            }
            return values;
        },
        prepareXEditableInitParameters: function(){
            var model = this.model;
            var parameters = this.model.attributes;
            parameters.source = this.prepareXEditablePossibleValues();

            if (parameters.value === '' && parameters.type == 'select') {
                parameters.value = 0;
            }
            if (parameters.value === 'checked') {
                parameters.value = 1;
            }

            parameters.value = parameters.value;

            parameters.success = function(response, value)
            {
                if (typeof response === 'string' && response != '') {
                    response = JSON.parse(response);
                }
                if (! response.error) {                    
                    var dependsElement = $('.ot_show_depends[data-depends="'+model.get('name')+'"]');
                    if(dependsElement.length){
                        var showIf = dependsElement.attr('data-show-cond');
                        if(showIf == value)
                            dependsElement.show();
                        else
                            dependsElement.hide();
                    }
                } else {
                    showError(response.message);
                    var dependsElement = $('.ot_show_depends[data-depends="'+model.get('name')+'"]');
                    dependsElement.show();
                    if (response.newValue) {
                        var editable = $(this).data('editable');
                        $(editable.input.$input).val(response.newValue);
                    }
                    return false;
                }
            }
            if(parameters.processSubmit == true){
                parameters.url = function(scope, params){
                    if(window[parameters.submitHandler])
                        window[parameters.submitHandler](scope,params);
                };
            }

            return parameters;
        },
        render: function()
        {
            var self = this;

            var preparedParameters = this.prepareXEditableInitParameters();

            var randId = Date.now();
            var renderedTemplate = renderInlineEditableElement(this.model.get('type'), preparedParameters);
            var wrappedHtml = $('<div/>').attr('id', randId).html(renderedTemplate);
            $('[data-field="' + self.model.get('name') + '"]:first').replaceWith(wrappedHtml);

            $('#' + randId + ' .ot_inline_editable[data-name="' + self.model.get('name') + '"]')
                .editable(preparedParameters)
                .on('shown', function() {
                    var editable = $(this).data('editable');
                    editable.setValue(preparedParameters.value);
                    editable.input.$input.val(preparedParameters.value);
                    editable.input.$input.closest('form').parents('div:first').on('save', function(e, params){
                        if (params.newValue !== '') {
                            preparedParameters.value = params.newValue;
                            var key = self.model.get('displayValue');
                            if (key) {
                                editable.$element.text(trans.get(key));
                            }
                        }
                    });
                })
                .on('hidden', function(e, reason) {
                    if (reason === 'cancel' || reason === 'nochange') {
                        //auto-open next editable
                        //$(this).closest('tr').next().find('.editable').editable('show');
                        var editable = $(this).data('editable');
                        var key = self.model.get('displayValue');
                        if (key) {
                            editable.$element.text(trans.get(key));
                        }
                    }
                });

            return this;
        }
    });

    _.each(InlineFields.models, function(field){
        var view = new XEditableFieldView({
            model: field
        });
        view.render();
    });

} );
