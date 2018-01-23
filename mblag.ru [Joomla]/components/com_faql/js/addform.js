window.addEvent('domready', function() {

	var parWindowDoc = window.parent.document;
	var count = parWindowDoc.getElementById('count').value;
	var start = parWindowDoc.getElementById('start');
	
	$('cancel').addEvent('click', function() {
		/* Close iframe */
		parWindowDoc.getElementById('sbox-btn-close').fireEvent('click');
	});
	
	/* count char */
	$('t1').value=count;
	$('question').addEvent('keyup', function(e) {
		a=$('question').value.length;
		if((a)>count)$('question').value=$('question').value.substring(0,count);
		$('t1').value=count-a;
	});
	
	/* update captcha */
	if ($('updatecaptcha') != null) {
		$('updatecaptcha').addEvent('click', function() {
			$('captchaimg').set({src: $('captchaimg').src.replace(/&ac=\d+/g, '&ac='+new String(Math.floor(Math.random()*100000)))})
		})
	}
	
	/* send form */
	start.style.display="none";
	$('QuestionForm').addEvent('submit', function(e) {
		new Event(e).stop();
		var box = $('box');
		box.empty().addClass('ajax-loading');
		box.style.display="block";
		var form = document.QuestionForm;
		
		/* create sting json */
		var strjson = '';
		for (var i = 0; i < form.length; i++) {
			if (form[i].tagName == 'INPUT' || form[i].tagName == 'TEXTAREA' || form[i].tagName == 'SELECT') {
				if (form[i].name) strjson += form[i].name+'='+form[i].value;
			}
			if (i+1 < form.length) strjson += '&';
		}
	
		new Request.JSON({
			url: 'index.php?option=com_faql&task=sendquest&format=raw',
			method: 'post',
			data: strjson,
			onComplete: function(res) {
				box.style.display="none";
				box.removeClass('ajax-loading');
				
				/* validate form */
				res.items.each(function(field) {
					if(field.status)
						$(field.name).removeClass('error');
					else {
						var desc = new Element('div').set('html', field.msg).injectAfter(box);
						desc.addClass('errmsg');
						var fx = new Fx.Morph(desc, {transition: Fx.Transitions.Quint.easeOut});
						fx.start({
						}).chain(function() {
							this.start.delay(4000, this, {'opacity': 0});
							$(field.name).addClass('error');
						}).chain(function() {
							desc.style.display="none";
							this.start.delay(0100, this, {'opacity': 1});
							desc.destroy();
						});
					}
				});
				
				/* result ok */
				if(res.valid) {
					var message = new Element('div').set('html', res.msg).injectAfter(box);
					message.addClass('okmsg');
					var fx = new Fx.Morph(message, {transition: Fx.Transitions.Quint.easeOut});
					fx.start({
					}).chain(function() {
						this.start.delay(4000, this, {'opacity': 0});
					}).chain(function() {
						this.start.delay(0100, this, {'opacity': 1});
						message.destroy();
						start.style.display="inline";
						/* reload parent window */
						if(res.reload) {
							window.parent.location.reload();
						}
					});
				}
			}
		}).send();

	});
				
}); 

function faqlNoSend(el)
{
	var email = $('email');
	var flemail = $('flemail');
	var cremail = $('created_email');
	if (!el.checked) {
		flemail.value = '';
		email.value = '';
		cremail.style.display="none";
	}
	else {
		flemail.value = '1';
		email.value = '';
		cremail.style.display="block";
	}
}
