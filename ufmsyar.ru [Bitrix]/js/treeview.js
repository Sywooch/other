/*
 * Класс для раскрывающихся меню
 */

	function clsTreeView(oTree)
	{
		this.oTree = oTree;

		this.sClassCollapsed = 'collapsed';
		this.sClassExpanded = 'expanded';
		this.sClassEmpty = 'empty';

		this.arList = new Array();

		this.init = function()
		{
			if(!this.oTree)
			{
				alert('Не определен элемент меню');
				return;
			}

			this.arList = this.oTree.getElementsByTagName('li');

			var 
				oLi = document.getElementById('selected-treeview-item'),
				arExpandedMenus = new Array();

			if(oLi)
			{
				do
				{
					iLiIndex = this.getListIndex(oLi);
					
					if(iLiIndex == -1)
					{
						break;
					}

					arExpandedMenus[iLiIndex] = true;
				}
				while(oLi = utilsFindParent(oLi.parentNode , 'li'));
			}

			arExpandedMenus[0] = true;

			for(var i = 0; i < this.arList.length; i ++)
			{
				var arCurrentChildren = this.arList[i].childNodes;
				var iSpanIndex = this.childrenContains(arCurrentChildren, 'span');
				var iULIndex = this.childrenContains(arCurrentChildren, 'ul');

				if(iSpanIndex != -1)
				{
					if(iULIndex != -1)
					{
						if(arExpandedMenus[i] == true)
						{
							arCurrentChildren[iSpanIndex].innerHTML = '-';
							this.arList[i].className = this.sClassExpanded;
						}
						else
						{
							arCurrentChildren[iSpanIndex].innerHTML = '+';
							this.arList[i].className = this.sClassCollapsed;
						}
						this.initOneControl(arCurrentChildren[iSpanIndex]);
					}
					else
					{
						arCurrentChildren[iSpanIndex].innerHTML = '&nbsp;';
						this.arList[i].className = this.sClassEmpty;
					}
				}
			}
		}

		this.initOneControl = function(oControl)
		{
			utilsAttachEvent('onclick', oControl, utilsMakeDelegate(this, this.switchState));
		}

		this.switchState = function()
		{
			var
				oSrc = (window.event ? window.event : UtilsEventHolder).srcElement,
				oLi = utilsFindParent(oSrc, 'li'),
				bState = (oSrc.innerHTML == '+' ? 0 : 1);

			oSrc.innerHTML = (bState == 0 ? '-' : '+');
			oLi.className = (bState == 0 ? this.sClassExpanded : this.sClassCollapsed);
		}
		

		this.childrenContains = function(arObject, sTagName)
		{
			if(arObject.length)
			{
				for(var i = 0; i < arObject.length; i ++)
				{
					if(arObject[i].tagName && arObject[i].tagName.toLowerCase() == sTagName.toLowerCase())
					{
						return i;
					}
				}
			}

			return -1;
		}

		this.getListIndex = function(oListItem)
		{
			for(var i = 0; i < this.arList.length; i ++)
			{
				if(this.arList[i] == oListItem)
				{
					return i;
				}
			}

			return -1;
		}
	}
