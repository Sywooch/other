// -----------------------------------------------------------------------------
// views/inputbox/photo
// -----------------------------------------------------------------------------

// dependencies
// ------------
define([
	'sandbox',
	'views/inputbox/status',
	'utils/language'
],

// definition
// ----------
function( $, InputboxView, language ) {

	return InputboxView.extend({

		template: joms.jst[ 'html/inputbox/photo' ],

		initialize: function() {
			InputboxView.prototype.initialize.apply( this, arguments );
			this.hint = {
				single: language.get('status.photo_hint') || '',
				multiple: language.get('status.photos_hint') || ''
			};
		},

		reset: function() {
			InputboxView.prototype.reset.apply( this, arguments );
			this.single();
		},

		single: function() {
			this.hint.current = this.hint.single;
			if ( this.$textarea.attr('placeholder') )
				this.$textarea.attr( 'placeholder', this.hint.current );
		},

		multiple: function() {
			this.hint.current = this.hint.multiple;
			if ( this.$textarea.attr('placeholder') )
				this.$textarea.attr( 'placeholder', this.hint.current );
		},

		updateAttachment: function( mood ) {
			var attachment = [];

			this.mood = mood || mood === false ? mood : this.mood;
			if ( this.mood ) {
				attachment.push(
					'<i class="joms-emoticon joms-emo-' + this.mood + '"></i> ' +
					'<b>' + ( this.language[ this.mood ] || this.mood ) + '</b>'
				);
			}

			if ( !attachment.length ) {
				this.$attachment.html('');
				this.$textarea.attr( 'placeholder', this.hint.current );
				return;
			}

			this.$attachment.html( ' &nbsp;&mdash; ' + attachment.join(' and ') + '.' );
			this.$textarea.removeAttr('placeholder');
		},

		getTemplate: function() {
			var html = this.template({ placeholder: this.hint.current = this.hint.single });
			return $( html );
		}

	});

});
