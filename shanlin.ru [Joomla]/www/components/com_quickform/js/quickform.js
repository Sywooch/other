/* @Copyright ((c) bigemot.ru
 */
window.addEvent('domready', function() {
	var int='qfrut',h={};
	$$('.qfblock form').each(function(el){
		h[el]=el.qfcod.value;
		if(el.start){
			el.addEvent('change', function() {
				qfsumBox(el,int,h[el]);
			});
		}
		qfGetReq(el,int,h[el]);
		cloneClass(el);
	});
});



function qfEvents(f) {
	if(!f.option)return;
	f.getElements('input[name="qfctext[]"]').each(function(el){
		var Num=function(){
			el.value=strNum(el.value);
		}
		el.addEvents({
			'keyup': Num,
			'change': Num
		});
	});
	
//	f.getElements('input[name="qftext[]"]').each(function(el){
//		if(el.previousSibling.innerHTML=='И. Фамилия'){
//			var Num=function(){
//				el.value=el.value.toUpperCase();
//			}
//			el.addEvents({
//				'keyup': Num,
//				'change': Num
//			});
//		}
//	});
	
}
function strNum(x) {
	var r = ""; 
	for(var n=0; n<x.length; n++) {
		var base= x.charAt(n);
		if ((base!=' '&&isNaN(base)==false)||base==','||base=='.')
			r = r + base;
	}
	return r.replace(/,/g,".");
}

function cloneClass(x) {
	if (x)x.getElements('.qfcloneone').each(function(el){
		if (el.className.charAt(15)<2)return;
		var i=1; for (var childItem in el.childNodes){
			if(!(['qfclonep', 'qfclonem', 'qfclonesum'].join('').indexOf(el.childNodes[childItem].className)>=0)
			&& typeof el.childNodes[childItem]=='object')el.childNodes[childItem].addClass('qfc_'+i);i++;
		}
	});
}
function qfsumBox(form,c,h) {
	qfEvents(form);
	if(!form.start)return;
	var start = parseFloat(form.start.value.replace(",",".")),q='qfbig',add,qq=1;
	var el=form.elements;c=c.slice(2,4);
	oldprice=q.slice(2)+(qq?'em':'');clflags(form);
	if(form.formul.value==1)price=qfCalculator1(el,start);
	else if(form.formul.value==2)price=qfCalculator2(el,start);
	else price=qfCalculator(el,start);
	oldprice+='key[ot.'.slice(4);
	if(parseInt(price)!=(price*1))price=parseFloat(price).toFixed(2);
	form.getElement('.qfpriceinner').innerHTML=qfstrPrice(price,c,h);
}

function qfstrPrice(x,c,h) {
	x = x.toString();var qfstr=oldprice+c,q='.qflin'+'k a',y = x.charAt(0);
	var qf=$$(q).length?($$(q)[0].href.slice(7,17)==qfstr):0,qf_h=h;
	for(var n=1; n<x.length; n++) {
		if (Math.ceil((x.length-n)/3) == (x.length-n)/3) y = y + " ";
		y =(!$$(q).length||!$$(q)[0].rel)? y + x.charAt(n):'';
	}
	return((!qf&&''+h!=qfel())?'':y.replace(" .",","));
}

function checClon(f) {
		var els=f.getElements('.qfclone');
		if(els.length<1) return;
		var str='';
		els.each(function(x){
			var ferst=x.childNodes[0],n=1;
			while(ferst.nextSibling&&'qfcloneone'.indexOf(ferst.nextSibling.className)){
				ferst=ferst.nextSibling;
				n++;
			}
			str+=','+n;
		});
		var fl=document.createElement("input");
		fl.type = 'hidden';fl.name ='clonStr';fl.value =str.slice(1);
		f.appendChild(fl);
	
		els=f.getElements('.qflong');
		if(els.length<1) return;
		n=0;str='';
		while(n<els.length) {
			var hits=els[n].parentNode.getElements('.qflong').length;
			str+=','+hits;
			n+=hits;
		}
		var fl=document.createElement("input");
		fl.type = 'hidden';fl.name ='qffl';fl.value =str.slice(1);
		f.appendChild(fl);
}
function qfsubmit(x) {
	var a=1,f=x.form;
	f.getElements('.validat').each(function(el){
		if(!checkfild(el)){qfanimat(el);a=null;}
	});
	if(a)
	{
		checClon(f);
		var ch=document.createElement("input");
		ch.type = 'hidden';ch.name =qfCh().slice(1);ch.value =1;
		f.appendChild(ch);f.submit();
	}
	else{
		var div = document.createElement("div");
		div.className='alertvalidat';
		div.innerHTML=allthefieldsare;
		f.getElement('.qfsubmit').insertBefore(div, f.getElement('.qfsubmit label'));
		setTimeout(function(){animHtml(div,'')}, 3000);
	}
}

function checkfild(el) {
	if(!el.value) return null;
	else if(el.name=='email[]'&&!isValidEmail(el.value)) return null;
	else if(el.type === 'checkbox'&&!el.checked) return null;
	return true;
}

function qfanimat(el) {
	el.getParent().setStyles({'color':'#F00','font-weight':'700'});
	if(typeof(Fx.Morph)=='function'){
		new Fx.Morph(el.getParent(), {duration: 3000}).start({'color': '#666'}).chain(function(){
			el.addEvent('keyup', function() {
				if(checkfild(el))
					el.getParent().setStyle('font-weight','normal');
				else el.getParent().setStyle('font-weight','700');
			});
			el.addEvent('click', function() {
				if(checkfild(el))
					el.getParent().setStyle('font-weight','normal');
				else el.getParent().setStyle('font-weight','700');
			});
		});
		var nsw=function() {
			var effect = new Fx.Morph(el.getParent().getElement('label'), {duration: 1500});
			effect.start({'opacity': 0.1}).chain(function() {
				effect.start({'opacity': 1});
			});
			if(el.getParent().style.fontWeight=='700') var timeout_id = setTimeout(nsw, 3000);
			el.form.getElement('.qfsubmit').addEvent('click', function() {clearTimeout(timeout_id);});
		 }
		setTimeout(nsw, 3000);
	}
}



function isValidEmail (email, strict){
 if ( !strict ) email = email.replace(/^\s+|\s+$/g, '');
 return (/^([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,4}$/i).test(email);
}

function qfel() {
	var ue = function (inArr){
		var uniHash={}, outArr=[], i=inArr.length;
		while(i--) uniHash[inArr[i]]=i;
		for(i in uniHash) outArr.push(i);
		return outArr
	}
	var a=(ue(window.location.hostname.replace(/[w|.|-]/g,'').split(''))),c=[],i=a.length;
	while(i--)
		c[i]=a[i]+a[a.length-i-1];
	return c.join('').slice(a.length);
}
//Object.prototype.clone2 = function(obj) {
//    var newObj = (this instanceof Array) ? [] : {};
//    for (i in this)  {
//
//        if (obj[i] && typeof obj[i] == "object")
//            newObj[i] = Object.clone(obj[i]);
//        else 
//            newObj[i] = obj[i]
//    } 
//    return newObj;
//};
function qfclonep(x,m){
	x=x.parentNode;
	if(m&&m<=x.parentNode.parentNode.getElements('.qfcloneone').length)return;
	var d=insertAfter(x.parentNode.clone(), x.parentNode);
	var ds=d.getElements('select');
	ds.each(function(el){
		el.selectedIndex=0;
	});
	qfGetReq2(ds.concat(d.getElements('input[type="radio"]')));
	showLabel(d);
	var z=d.getElement('label')
	qfsumBox(z.form,'htrut',z.form.qfcod.value);
//		animSum(d.getElement('.qfclonesum'));
}
function qfclonem(x){
	x=x.parentNode;
	var row = x.parentNode,clon=row.getParent('.qfclone');
	if(clon.getElements('.qfcloneone').length-row.getElements('.qfcloneone').length>1){
		animHtml(row,'');
	}
	var f=clon.getParent('form');
	qfsumBox(f,'htrut',f.qfcod.value);
	(function(){showLabel(clon.getElement('.qfcloneone'))}).delay(800);
}
function showLabel(x){
	var z=x.className.charAt(15),a=0;
	if(z<2)return;
	var divs=x.getParent().getElements('.len_'+z);
	divs.each(function(el){
		var leb=el.getElements('label');
		if(leb){
			if(a)leb.setStyle('height',0);
			else leb.setStyle('height','auto');
			a=1;
		}
	});
}
function noClon(x) {
	while(true){
		x=x.parentNode;
		if(x.className.indexOf('qflong')>0)return null;
		if(x.getElement('form'))return true;
	}
}
function clflags(form){
	form.getElements('.qfclone').setStyle('display','');
}
function getClasterSum(x) {
	var clon=x.parentNode.parentNode.parentNode;
	if(clon.style.display=='block')return 0;
	clon.setStyle('display','block');
	var clonSum=0;
	clon.getElements('.qfcloneone').each(function(el){
		var els=el.getElements('select').concat(el.getElements('input'));
		var price=qfCalculatorClone(els,0);
		if(parseInt(price)!=price)price=price.toFixed(2);
		clonSum+=price;
		el.getElement('.qfclonesum').innerHTML=qfstrPrice(price,'ot.ru',x.form.qfcod.value);
	});
	return clonSum;
}
//function animSum(d){
//	var old=x=d.innerHTML,i=30;
//	while(i--){(function(){
//		for(var n=0; n<=old.length; n++) {
//			if (isNaN(x[n])==false)x=x.replace(x[n],Math.floor(Math.random() *9));
//		}
//		d.innerHTML=x;
//	}).delay(100);}
//	(function(){d.innerHTML=old;}).delay(500);
//}


function qfGetReq(form,c,h){
	var el=form.elements,cn='.'+c.slice(2,4);
	var qf=$$('.qfli'+'nk a').length?($$('.qfli'+'nk a')[0].href):null,qf_h='ot'+cn;
	if(qf&&qf.slice(12,17)!=qf_h) animHtml(form,'');
	else if(!qf||qf.rel)h!=qfel()?animHtml(form,''):'';qfGetReq2(el);
	qfsumBox(form,c,h);
}
function qfGetReq2(el){
	for(var n=0; n<el.length; n++) {	
		if(el[n].type==='select-one'){qfGetReqEL(el[n],'s');el[n].addEvent('change', function(){
			qfGetReqEL(this,'s');});}
		else if(el[n].type === 'radio'){qfGetReqEL(el[n],'r');el[n].addEvent('change', function(){
			qfGetReqEL(this,'r');});}
		qfEvents(el[n]);
	}
}
function qfGetReqEL(el,t){
	if(t=='s'&&el.options[el.selectedIndex].className.length>6){
		var a=el.options[el.selectedIndex].className;
		var req=a.slice(a.indexOf("_")+1);
		qfReqInner(el,req);
	}else if(t=='r'&&el.className.length>6 && el.checked){
		req=el.className.slice(el.className.indexOf("_")+1);
		qfReqInner(el,req);
	}else if(el.getParent().getNext()&&el.getParent().getNext().className=='qfblockch'){
		animHtml(el.getParent().getNext(),'');
	}
}
function qfReqInner(el,req){
	new Request({url: '/index.php?option=com_quickform', onSuccess: function(html){
		if(el.getParent().getNext()&&el.getParent().getNext().className=='qfblockch')animHtml(el.getParent().getNext(),html);
		else {
			var div=document.createElement('div');
			div.className='qfblockch';
			insertAfter(div,el.getParent());
			animHtml(div,html);
		}
		qfsumBox(el.form,'htrul',el.form.qfcod.value);
		cloneClass(el.getParent('.qfcloneone'));
	}}).get({'formreq':req});
}
function insertAfter(elem, refElem) {
	return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
}
function animHtml(el,html) {
	if(html){
		el.innerHTML=html;
		if(typeof(Fx.Morph)=='function'){
			el.setStyles({'overflow':'hidden'});
			new Fx.Morph(el, {duration: 600}).start({'opacity': [0, 1]});
		}
		var s = el.getElements('select');qfGetReq2(s);
		var r = el.getElements('input[type="radio"]');qfGetReq2(r);
	}else{
		if(typeof(Fx.Morph)=='function')new Fx.Morph(el, {duration: 600}).start({'opacity': [0.6, 0]}).chain(function(){
			var f=el.parentNode.getElement('label').form;
			el.parentNode.removeChild(el);qfsumBox(f,'htrul',f.qfcod.value);});
		else el.parentNode.removeChild(el);
	}
}
function getAdd(el) {
	var add;
	if(el.type==='select-one'){add=el.options[el.selectedIndex].value;add=add.slice(add.indexOf("_")+1);}
	else if(el.type === 'radio' && el.checked)add=el.value.slice(el.value.indexOf("_")+1);
	else if(el.type === 'checkbox' && el.checked)add=el.value.slice(el.value.indexOf("_")+1);
	else if(el.name === 'qfctext[]'){
			el.removeEvents('keyup');
			el.addEvent('keyup', function() {
				qfsumBox(el.form,'htrul',el.form.qfcod.value);
			});
		var next=el.getNext().value;
		add=next.slice(0,1)+(el.value.replace(",",".")*next.slice(1));
	}
	else add='';
	return add;
}
function qfCalculator(el,start) {
	var price=start;
	for(var n=0; n<el.length; n++) {	
		if(noClon(el[n])){
			var add=getAdd(el[n]);
			if(add.length>1){	
				var modifer=add.slice(0,1);
				var val=add.slice(1);
				if(modifer=='=') price=val*1;
				else if(modifer=='*') price*=val;
				else if(modifer=='-') price-=val*1;
				else price=(price+val*1);
			}
		}
		else price+=getClasterSum(el[n]);
	}
	return price;
}

function qfCalculatorClone(el,start) {
	var price=start;
	for(var n=0; n<el.length; n++) {	
		var add=getAdd(el[n]);
		if(add.length>1){	
			var modifer=add.slice(0,1);
			var val=add.slice(1);
			if(modifer=='=') price=val*1;
			else if(modifer=='*') price*=val;
			else if(modifer=='-') price-=val*1;
			else price=(price+val*1);
		}
	}
	return price;
}
function qfCalculator1(el,start) {
	var price='';
	for(var n=0; n<el.length; n++) {	
		var add=getAdd(el[n]);
		if(add.length>1){	
			var modifer=add.slice(0,1);
			var val=add.slice(1);
			if(modifer=='=') start=val;
			else if(modifer=='*') start*=val;
			else price=(price+add);
		}
	}
	return eval(start+price);
}
function qfCalculator2(el,start) {
	var price=start,mul=1;
	for(var n=0; n<el.length; n++) {	
		var add=getAdd(el[n]);
		if(add.length>1){	
			var modifer=add.slice(0,1);
			var val=add.slice(1);
			if(modifer=='=') price=val*1;
			else if(modifer=='*') mul*=val;
			else if(modifer=='-') price-=val*1;
			else if(modifer=='+') price+=val*1;
		}
	}
	return price*mul;
}
