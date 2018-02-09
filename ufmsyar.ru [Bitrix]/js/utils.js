/*
 *	��������� ����������� �������
 */
	var
		isOpera = (document.opera || (document.attachEvent && document.addEventListener) ? true : false),
		isIE = (!isOpera && document.attachEvent ? true : false);

	// �������, ������������ ��� ����������� ����������� ������� � ������, ����� ���������� �������� ������� ������.
	// this � ���� ������ ������ ������ ����� ��������� �� �����, � �� �� ������ �������
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

	// ������� ��� ������ ������������� �������� � �������� ��������� ����� ����
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
 *	������� ��� ��������� ������� (�����-����������)
 */

	// ���������� ����������, �������� ������ �������
	var
		UtilsEventHolder = null;
	
	// �������, ������� ������� � ����������� ��� � UtilsEventHolder
	function utilsCatchEvent(oEvent)
	{
		UtilsEventHolder = oEvent;
		UtilsEventHolder.srcElement = oEvent.target;
	}
	
	// �������, ������������ ���������� ��� �������, sEvent - ��� ������� (� ������� IE),
	// oSrc - ������, ��� ������� �������� ������������ ����������,
	// oHandler - ���������� �������
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

