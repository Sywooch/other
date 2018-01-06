(function($) {
    function _isJson(string) {
      try {
        $.parseJSON(string);
      } catch (e) {
        return false;
      }
      return true;
    }

    function _showSuccess($form, message) {
      $form.find('.info')
        .addClass('success')
        .html(message);
      
      try {
        ga('send', 'event', 'Online', 'Lead');
      } catch(e) {}
      
      try {
        yaCounter30789151.reachGoal('callback_form_success');
      } catch(e) {}
      
      var allforms = $('form');
      
      allforms.parent().find('.form_text .title').html('Спасибо!');
      allforms.parent().find('.form_text .subtitle').slideUp();
      allforms.find('fieldset').slideUp();
      allforms.find('.js-submit-callback-form').slideUp();
      $(document).find('.js-show-callback-form, .js-show-showcases-form').slideUp();
      
    }

    function _showErrors($form, errors) {
      var
        $infoField = $form.find('.info').addClass('errors').html(''),
        errorMessages = {
          name: 'Поле "Имя" не может быть пустым',
          phone: 'Поле "Телефон" не может быть пустым'
        };

      $.each(errors, function(index, error) {
        $infoField.append($('<div>').html(errorMessages[error.name]));
        $form.find('input[name='+error.name+']').addClass('with-error');
      });
    }

    function _sendRequest($form) {
      $.ajax({
        url: $form.attr('action'),
        type: 'POST',
        contentType: 'application/x-www-form-urlencoded; charset=utf-8',
        data: $form.serialize(),
        error: function(jqXHR, textStatus, errorThrown) {
          window.console && console.log(jqXHR, textStatus, errorThrown);
        },
        success: function(response) {
          if (_isJson(response)) {
            _showErrors($form, $.parseJSON(response));
          } else {
            _showSuccess($form, 'Менеджер свяжется с вами');
          }
        }
      });
    }

    function _showForm() {
      $('.js-callback-form-wrapper').dialog({
        modal: true,
        resizable: false,
        draggable: false,
        show: 200,
        hide: 200,
        dialogClass: 'callback-form-popup',
        /*title: 'Заявка на звонок',*/
        open: function() {
          /*$('.js-dialog-popup').dialog('close');*/
        },
        close: _resetForm
      });
    }
    
    function _showFormShowcases() {
      $('.js-showcases-form-wrapper').dialog({
        modal: true,
        resizable: false,
        draggable: false,
        show: 200,
        hide: 200,
        dialogClass: 'showcases-form-popup',
        /*title: 'Заявка на звонок',*/
        open: function() {
          /*$('.js-dialog-popup').dialog('close');*/
        },
        close: _resetForm
      });
    }

    function _resetForm($form) {
      $('.callback_form')
        .find('.info').removeClass('success errors').html('').end()
        .find('.with-error').removeClass('with-error');
    }
    
    function _validate($form) {      
      var empty = 0;
      $form.find('.required').each(function() {
          if( !$(this).val() ) {
                $(this).addClass('with-error');
                /*$form.parents('td').addClass('warning');*/
                empty++;
          } else if ($(this).val()) {
                $(this).removeClass('with-error');
                /*$(this).parents('td').removeClass('warning');*/
          }   
      });
      var $infoField = $form.find('.info');
      if(empty > 0){
        $infoField.addClass('errors').html('');
        $infoField.append($('<div>').html('Заполните все поля'));
        /*$infoField.append($('<div>').html('Заполните все поля');*/
        /*var $infoField = $form.find('.info').addClass('errors').html('');
        $infoField.append($('<div>').html('Заполните все поля');
        /*$form.info.text("Заполните все поля");*/
        return false;
      } else {
        $infoField.removeClass('errors').html('');
      }
        return true;
      /*success*/
    }

    $(document)
      .on('click', '.js-show-callback-form', function() {
        _showForm();
        /*try {
          yaCounter30789151.reachGoal('callback_form_show');
        } catch(e) {}*/
        return false;
      })
      
      .on('click', '.js-show-showcases-form', function() {
        _showFormShowcases();
        /*try {
          yaCounter26547033.reachGoal('callback_form_show');
        } catch(e) {}*/
        return false;
      })
      
      .on('submit', 'form', function(e) {
        e.preventDefault();
        if ( _validate($(this)) ) { 
          _sendRequest($(this));
        } 
        else return false;
        _resetForm($(this));
        return false;
      })
      /*.on('click', '.callback-form-popup + .ui-widget-overlay', function() {
        $('.js-callback-form-wrapper').dialog('close');
      })*/
      /*.on('click', '.js-submit-callback-form', function() {
        $('#callback_form').submit();
      })*/
      .on("click", "div.ui-widget-overlay:visible", function() {
        $(".ui-dialog:visible").find(".ui-dialog-content").dialog("close");
    });
      
 })(jQuery);