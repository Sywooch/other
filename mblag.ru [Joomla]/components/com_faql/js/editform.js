function faqlAnswDate()
{
	var frdate = $('fromdate2');
	var RegE = new RegExp(/\d{2}-\d{2}-\d{4} \d{2}:\d{2}:\d{2}/);
	var fResult = RegE.test(frdate.value);
	if (!fResult) {
		var tdate =new Date();
		var dD = tdate.getDate();
		var dM = tdate.getMonth();
		dM = dM+1;
		var dH = tdate.getHours();
		var dMin = tdate.getMinutes();
		var dS = tdate.getSeconds();
		if (dM < 10) dM = '0'+dM;
		if (dD < 10) dD = '0'+dD;
		if (dH < 10) dH = '0'+dH;
		if (dMin < 10) dMin = '0'+dMin;
		if (dS < 10) dS = '0'+dS;
		var currdate = dD+'-'+dM+'-'+tdate.getFullYear()+' '+dH+':'+dMin+':'+dS;
		frdate.value = currdate;
	}
}

function submitbtn(pressbutton)
{
	var form = document.adminForm;
	if (pressbutton == 'cancel') {
		submitform( pressbutton );
		return;
	}

	var state = form.state.value;
	var publish0 = form.published[0];
	var publish1 = form.published[1];
	var countansw = '';
	if ($('answer_parent')) {
		var mce = $('answer_ifr').contentDocument.getElementById('tinymce');
		countansw = mce.innerHTML;
		countansw = countansw.replace(/<.*?>/gi, '');
		countansw = countansw.replace(/(\&nbsp;)*/gi, '');
		countansw = countansw.replace(/\s+/gi, '');
		if (countansw.length < 2) mce.innerHTML = '';
	}
	else countansw = form.answer.value;
	var count = countansw.length;
	if (count < 2) {
		faqlAnswDate();
		form.state[0].selected = true;
		form.state[1].selected = false;
		form.state[2].selected = false;
	}
	else {
		faqlAnswDate();
		if (state == 1) {
			publish0.checked = true;
			publish1.checked = false;
		}
		else {
			var wanttxt = $('wanttxt').value;
			if (publish0.checked && confirm(wanttxt)) {
				publish0.checked = false;
				publish1.checked = true;
			}
			form.state[0].selected = false;
			form.state[1].selected = false;
			form.state[2].selected = true;
		}
	}
	var usid = $('autansw');
	if (form.state[0].selected) {
		usid.value = "";
		$('fromdate2').value = '00-00-0000 00:00:00';
	}
	else {
		usid.value = $('idman').value;
	}
	submitform( pressbutton );
}