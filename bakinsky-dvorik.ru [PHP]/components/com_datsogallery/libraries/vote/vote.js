
function vote(id,i,total,total_count,counter){
	var currentURL = window.location;
	var live_site = currentURL.protocol+'//'+currentURL.host+sfolder;
	var lsXmlHttp;

	var div = document.getElementById('vote_'+id);
	div.innerHTML='<img src="'+live_site+'/components/com_datsogallery/libraries/vote/loading.gif" border="0" align="absmiddle" /> '+vote_msg[1];
	try	{
		lsXmlHttp=new XMLHttpRequest();
	} catch (e) {
		try	{ lsXmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try { lsXmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				alert(vote_msg[0]);
				return false;
			}
		}
	}
	lsXmlHttp.onreadystatechange=function() {
		var response;
		if(lsXmlHttp.readyState==4){
			setTimeout(function(){
				response = lsXmlHttp.responseText;
				if(response=='thanks') div.innerHTML='<span class="vote-msg-thanks">'+vote_msg[2]+'</span>';
				if(response=='voted') div.innerHTML='<span class="vote-msg-voted">'+vote_msg[3]+'</span>';
			},1000);
			setTimeout(function(){
				if(response=='thanks'){
					var newtotal = total_count+1;
					var percentage = ((total + i)/(newtotal));
					document.getElementById('rating_'+id).style.width=parseInt(percentage*20)+'%';
				}
				if(counter!=0){
					if(response=='thanks'){
						if(newtotal!=1)
                            var newvotes=vote_msg[4]+': '+newtotal;
						else
							var newvotes=vote_msg[5]+': '+newtotal;
						div.innerHTML='<span class="vote-msg">( '+newvotes+' )</span>';
					} else {
						if(total_count!=0 || counter!=-1) {
							if(total_count!=1)
                                var votes=vote_msg[4]+': '+total_count;
							else
								var votes=vote_msg[5]+': '+total_count;
							div.innerHTML='<span class="vote-msg">( '+votes+' )</span>';
						} else {
							div.innerHTML='';
						}
					}
				} else {
					div.innerHTML='';
				}
			},2000);
		}
	}
	lsXmlHttp.open("GET",live_site+"/index.php?option=com_datsogallery&func=vote&rating="+i+"&id="+id,true);
	lsXmlHttp.send(null);
}