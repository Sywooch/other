var BASE64 = {
	_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	encode : function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
		input = BASE64._utf8_encode(input);
		while (i < input.length) {
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
		}
		return output;
	},
	decode : function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");
		while (i < input.length) {
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
			output = output + String.fromCharCode(chr1);
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
		}
		output = BASE64._utf8_decode(output);
		return output;
	},
	_utf8_encode : function (string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
		for (var n = 0; n < string.length; n++) {
			var c = string.charCodeAt(n);
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
		}
		return utftext;
	},
	_utf8_decode : function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;
		while ( i < utftext.length ) {
			c = utftext.charCodeAt(i);
			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i+1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i+1);
				c3 = utftext.charCodeAt(i+2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
		}
		return string;
	}
}
jQuery.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    jQuery.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
function FilterResults(str,cbrowse,inrow,inmodal){
	jQuery.ajax({
		url:'index.php?option=com_ajax&module=dmsfilter&format=raw&'+str
	}).done(function(data){
		data = JSON.parse(BASE64.decode(data));
		var html = '';
		var product_template = jQuery('#product_template');
		for(var i=0;i<data.length;i++){
			if(i==0||i%inrow==0){
				html += '<div class="row">';
			}
			product_template = jQuery('#product_template');
			product_template.find('.img').html('<img src="'+data[i].file_url+'" />');
			product_template.find('.name').html(data[i].product_name);
			product_template.find('.mfname').html(data[i].mf_name);
			product_template.find('a').attr('href',data[i].product_url);
			product_template.find('.product-price').attr('id','productPrice'+data[i].virtuemart_product_id);
			product_template.find('.product-price .PricesalesPrice span').html(data[i].product_price);
			if(data[i].product_tax_id>0){
				product_template.find('.product-price .PricepriceWithoutTax').show().find('span').html(data[i].product_price);
				product_template.find('.product-price .PricesalesPrice span').html(data[i].product_tax_price);
			}
			else{
				product_template.find('.product-price .PricepriceWithoutTax').hide();
			}
			if(parseInt(data[i].product_action)){
				product_template.find('.sale').show();
			}
			else{
				product_template.find('.sale').hide();
			}
			html += product_template.html();
			if((i+1)%inrow==0){
				html += '</div>';
			}
		}
		jQuery(cbrowse).html('').html(html);
		if(inmodal){
			jQuery('a.modal').click(function(){
				SqueezeBox.open(jQuery(this).attr('href'),{size: {x: 1024, y: 650},classOverlay:'over'});
				return false
			});
		}
	}).error(function(jqXHR,textStatus,errorThrown ){
		console.log(jqXHR,textStatus,errorThrown );
	});
}

