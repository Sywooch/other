
; /* Start:/bitrix/templates/.default/components/bitrix/menu/vertical_multilevel3/script.js*/
var jsvhover = function()
{
	var menuDiv = document.getElementById("vertical-multilevel-menu");
	if (!menuDiv)
		return;

  var nodes = menuDiv.getElementsByTagName("li");
  for (var i=0; i<nodes.length; i++) 
  {
    nodes[i].onmouseover = function()
    {
      this.className += " jsvhover";
    }
    
    nodes[i].onmouseout = function()
    {
      this.className = this.className.replace(new RegExp(" jsvhover\\b"), "");
    }
  }
}

if (window.attachEvent) 
	window.attachEvent("onload", jsvhover); 
/* End */
;
; /* Start:/bitrix/templates/.default/components/bitrix/menu/vertical_multilevel4/script.js*/
var jsvhover = function()
{
	var menuDiv = document.getElementById("vertical-multilevel-menu");
	if (!menuDiv)
		return;

  var nodes = menuDiv.getElementsByTagName("li");
  for (var i=0; i<nodes.length; i++) 
  {
    nodes[i].onmouseover = function()
    {
      this.className += " jsvhover";
    }
    
    nodes[i].onmouseout = function()
    {
      this.className = this.className.replace(new RegExp(" jsvhover\\b"), "");
    }
  }
}

if (window.attachEvent) 
	window.attachEvent("onload", jsvhover); 
/* End */
;
; /* Start:/bitrix/templates/.default/components/bitrix/menu/vertical_multilevel5/script.js*/
var jsvhover = function()
{
	var menuDiv = document.getElementById("vertical-multilevel-menu");
	if (!menuDiv)
		return;

  var nodes = menuDiv.getElementsByTagName("li");
  for (var i=0; i<nodes.length; i++) 
  {
    nodes[i].onmouseover = function()
    {
      this.className += " jsvhover";
    }
    
    nodes[i].onmouseout = function()
    {
      this.className = this.className.replace(new RegExp(" jsvhover\\b"), "");
    }
  }
}

if (window.attachEvent) 
	window.attachEvent("onload", jsvhover); 
/* End */
;; /* /bitrix/templates/.default/components/bitrix/menu/vertical_multilevel3/script.js*/
; /* /bitrix/templates/.default/components/bitrix/menu/vertical_multilevel4/script.js*/
; /* /bitrix/templates/.default/components/bitrix/menu/vertical_multilevel5/script.js*/
