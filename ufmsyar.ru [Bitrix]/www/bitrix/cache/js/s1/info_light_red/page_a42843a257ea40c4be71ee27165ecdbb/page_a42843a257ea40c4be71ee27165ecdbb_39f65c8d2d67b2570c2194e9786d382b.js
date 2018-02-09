
; /* Start:/bitrix/components/api/main.feedback/js/_fn.js*/
/**
 * Created by Tuning-Soft on 16.02.2014
 */
(function($){

    // значение по умолчанию
    var defaults = { color:'#FB4D4D' };

    // актуальные настройки, глобальные
    var options;

    $.fn.validateMainFeedback = function(params){
        // при многократном вызове функции настройки будут сохранятся, и замещаться при необходимости
        options = $.extend({}, defaults, options, params);
        //console.log(this); // jQuery
        //console.log(this.length); // число элементов

        var formObj = this;
        var error = false;
        var ts_field = '[class*="ts-field-"]';
        var ts_field_error = '<span class="ts-field-error"></span>';
        var ts_field_saccess = '<span class="ts-field-saccess"></span>';
        var input_required = 'input.required';

        //Проверка отправки формы
        $(formObj).find(':submit').click(function(e){

            //input[type="text"]
            $(formObj).find(input_required).each(function(){

                if( $(this).val() == '')
                {
                    $(this).next(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }
                else
                {
                    $(this).next(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }


                if(error)
                    e.preventDefault();
            });
            //Проверка при изменении полей
            $(formObj).find('input.required').on('keyup change', function(e){
                if($(this).val() != '')
                {
                    $(this).next(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }
                else
                {
                    $(this).next(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }

                if(error)
                    e.preventDefault();
            });
            //\\input[type="text"]

            //textarea
            $(formObj).find('textarea.required').each(function(){
                if($(this).val() == '')
                {
                    //css('border-color', options.color)
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }
                else
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }

                if(error)
                    e.preventDefault();

            });
            //Проверка при изменении полей
            $(formObj).find('textarea.required').on('keyup click change',function(e){
                if($(this).val() != '')
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }
                else
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }

                if(error)
                    e.preventDefault();
            });
            //\\textarea

            //select
            $(formObj).find('select.required').each(function(){
                if($(this).find('option:selected').length == 0)
                {
                    //css('border-color', options.color)
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }
                else
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }

                if(error)
                    e.preventDefault();

            });
            //Проверка при изменении полей
            $(formObj).find('select.required').change(function(e){
                if($(this).find('option:selected').length)
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }
                else
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }

                if(error)
                    e.preventDefault();
            });
            //\\select


            ////////////////////////////////////////////////////////////
            //                          v1.2.9                       //
            ///////////////////////////////////////////////////////////

            //input[type="checkbox"]
            $(formObj).find('.option-qroup.required').each(function(){

                if( !$(this).find('input:checked').length)
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }
                else
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }


                if(error)
                    e.preventDefault();
            });
            //Проверка при изменении полей
            $(formObj).find('.option-qroup.required').on('keyup change', function(e){
                if($(this).find('input:checked').length)
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_saccess);
                    error = false;
                }
                else
                {
                    $(this).parent().find(ts_field).remove();
                    $(this).after(ts_field_error);
                    error = true;
                }

                if(error)
                    e.preventDefault();
            });
            //\\input[type="checkbox"]


        });

        //$(this).click(function(){
          //  $(this).css('color', options.color);
        //});

        return this;
    };

})(jQuery);
/* End */
;
; /* Start:/bitrix/components/api/main.feedback/js/jquery.modal.js*/
/*!
 * CSS Modal
 * http://drublic.github.com/css-modal
 *
 * @author Hans Christian Reinl - @drublic 
 * @version 1.0.3
 */

(function (global) {

	'use strict';

	// Storage variable
	var modal = {};

	// Store for currently active element
	modal.lastActive = undefined;
	modal.activeElement = undefined;

	// Polyfill addEventListener for IE8 (only very basic)
	modal._addEventListener = function (element, event, callback) {
		if (element.addEventListener) {
			element.addEventListener(event, callback, false);
		} else {
			element.attachEvent('on' + event, callback);
		}
	};

	// Hide overlay when ESC is pressed
	modal._addEventListener(document, 'keyup', function (event) {
		var hash = window.location.hash.replace('#', '');

		// If hash is not set
		if (hash === '' || hash === '!') {
			return;
		}

		// If key ESC is pressed
		if (event.keyCode === 27) {
			window.location.hash = '!';

			if (modal.lastActive) {
				return false;
			}

			// Unfocus
			modal.removeFocus();
		}
	}, false);

	// Convenience function to trigger event
	modal._dispatchEvent = function (event, modal) {
		var eventTigger;

		if (!document.createEvent) {
			return;
		}

		eventTigger = document.createEvent('Event');

		eventTigger.initEvent(event, true, true);
		eventTigger.customData = { 'modal': modal };

		document.dispatchEvent(eventTigger);
	};


	// When showing overlay, prevent background from scrolling
	modal.mainHandler = function () {
		var hash = window.location.hash.replace('#', '');
		var modalElement = document.getElementById(hash);
		var htmlClasses = document.documentElement.className;
		var modalChild;
		var oldModal;

		// If the hash element exists
		if (modalElement) {

			// Get first element in selected element
			modalChild = modalElement.children[0];

			// When we deal with a modal and body-class `has-overlay` is not set
			if (modalChild && modalChild.className.match(/modal-inner/)) {
				if (!htmlClasses.match(/has-overlay/)) {

					// Set an html class to prevent scrolling
					document.documentElement.className += ' has-overlay';
				}

				// Unmark previous active element
				if (modal.activeElement) {
					oldModal = modal.activeElement;
					oldModal.className = oldModal.className.replace(' is-active', '');
				}
				// Mark modal as active
				modalElement.className += ' is-active';
				modal.activeElement = modalElement;

				// Set the focus to the modal
				modal.setFocus(hash);

				// Fire an event
				modal._dispatchEvent('cssmodal:show', modal.activeElement);
			}
		} else {
			document.documentElement.className =
					htmlClasses.replace(' has-overlay', '');

			// If activeElement is already defined, delete it
			if (modal.activeElement) {
				modal.activeElement.className =
						modal.activeElement.className.replace(' is-active', '');

				// Fire an event
				modal._dispatchEvent('cssmodal:hide', modal.activeElement);

				// Reset active element
				modal.activeElement = null;

				// Unfocus
				modal.removeFocus();
			}
		}
	};

	modal._addEventListener(window, 'hashchange', modal.mainHandler);
	modal._addEventListener(window, 'load', modal.mainHandler);

	/*
	 * Accessibility
	 */

	// Focus modal
	modal.setFocus = function () {
		if (modal.activeElement) {

			// Set element with last focus
			modal.lastActive = document.activeElement;

			// New focussing
			modal.activeElement.focus();
		}
	};

	// Unfocus
	modal.removeFocus = function () {
		if (modal.lastActive) {
			modal.lastActive.focus();
		}
	};

	// Export CSSModal into global space
	global.CSSModal = modal;

}(window));

/* End */
;; /* /bitrix/components/api/main.feedback/js/_fn.js*/
; /* /bitrix/components/api/main.feedback/js/jquery.modal.js*/
