/**
 * Diafan.CMS
 *
 * @author     diafan.ru
 * @version    5.1
 * @license http://cms.diafan.ru/license.html
 * @copyright  Copyright (c) 2003-2012 OOO "Диафан". (http://diafan.ru)
 */

(function() {
	tinymce.create('tinymce.plugins.DiafanImages', {
		init : function(ed, url) {
			// Register commands
			ed.addCommand('mceDiafanImages', function() {
				ed.windowManager.open({
					file : images_str_replace('adm/htmleditor/tiny_mce/plugins/diafanimages', 'images/editor/', url, 1) + '?'+Math.random(),
					width : 710 + parseInt(ed.getLang('diafanimages.delta_width', 0)),
					height : 500 + parseInt(ed.getLang('diafanimages.delta_height', 0)),
					inline: true,
					popup_css : false
				}, {
					plugin_url : url
				});
			});
			// Register buttons
			ed.addButton('diafanimages', {
				title : 'Diafan Images Plugin',
				cmd : 'mceDiafanImages',
				image : url + '/img/icon.gif'
			});
		 
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('diafanimages', n.nodeName == 'IMG');
			});
		},
		getInfo : function() {
			return {
				longname : 'Diafan Images Plugin',
				author : 'cms.diafan.ru',
				authorurl : 'http://cms.diafan.ru',
				infourl : 'http://cms.diafan.ru/',
				version : '5.1'
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('diafanimages', tinymce.plugins.DiafanImages);
})();

function images_str_replace(search, replace, subject, count) {
    f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = r instanceof Array, sa = s instanceof Array;
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }
    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }
        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {
                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];
}