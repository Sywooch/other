function Ajax()
{
	this.xmlHTTPRequest = null;

	this.oReciever = null;

	this.init = function()
	{
		if(window.XMLHttpRequest)
		{
			this.xmlHTTPRequest = new XMLHttpRequest();

			if(this.xmlHTTPRequest.overrideMimeType)
			{
				this.xmlHTTPRequest.overrideMimeType('text/xml');
			}
		}
		else if(window.ActiveXObject)
		{
			try
			{
				this.xmlHTTPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			} 
			catch(e)
			{
				try
				{
					this.xmlHTTPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} 
				catch (e)
				{
				}
			}
		}
	}

	this.stateChange = function()
	{
		if(!this.xmlHTTPRequest)
		{
			return false;
		}

		if(this.xmlHTTPRequest.readyState == 4)
		{
			if(!this.xmlHTTPRequest.responseXML.documentElement && this.xmlHTTPRequest.responseStream)
			{
				this.xmlHTTPRequest.responseXML.load(this.xmlHTTPRequest.responseStream);
			}
			this.oReciever(this.xmlHTTPRequest.responseXML);
			delete this.xmlHTTPRequest;
		}
	}

	this.getData = function(sUrl, oReciever)
	{
		this.init();

		if(!this.xmlHTTPRequest)
		{
			return false;
		}

		this.oReciever = oReciever;

		this.xmlHTTPRequest.onreadystatechange = utilsMakeDelegate(this, this.stateChange);
        this.xmlHTTPRequest.open('GET', sUrl, true);
        this.xmlHTTPRequest.send(null);
	}
}
