/*
 *	Различные утилитарные функции
 */
	var
		isOpera = (document.opera || (document.attachEvent && document.addEventListener) ? true : false),
		isIE = (!isOpera && document.attachEvent ? true : false);

	// Функция, используемая для навешивания обработчика события в случае, когда обработчик является методом класса.
	// this в этом случае внутри метода будет указывать на класс, я не на объект события
	function utilsMakeDelegate(oObject, oMethod) 
	{
		var 
			f = function()
			{
				f.Method.call( f.Object );
			};

		f.Object = oObject;
		f.Method = oMethod;

		return f;
	}

	// Функция для поиска родительского элемента с заданным значением имени тэга
	function utilsFindParent(oNode, sTag)
	{
		if(!oNode.tagName)
			return null;

		if(oNode.tagName.toLowerCase() == sTag.toLowerCase())
		{
			return oNode;
		}
		else
		{
			return (oNode.parentNode ? utilsFindParent(oNode.parentNode, sTag) : null);
		}
	}

/*
 *	Функции для обработки событий (кросс-браузерные)
 */

	// глобальная переменная, содержит объект события
	var
		UtilsEventHolder = null;
	
	// функция, ловящая событие и сохраняющая его в UtilsEventHolder
	function utilsCatchEvent(oEvent)
	{
		UtilsEventHolder = oEvent;
		UtilsEventHolder.srcElement = oEvent.target;
	}
	
	// функция, навешивающая обработчик для события, sEvent - имя события (в формате IE),
	// oSrc - объект, для событий которого навешивается обработчик,
	// oHandler - обработчик события
	function utilsAttachEvent(sEvent, oSrc, oHandler)
	{
		if(document.addEventListener)
		{
			oSrc.addEventListener(sEvent.substr(2), utilsCatchEvent, false);
			oSrc.addEventListener(sEvent.substr(2), oHandler, false);
		}
		else
		{
			oSrc.attachEvent(sEvent, oHandler);
		}
	}

