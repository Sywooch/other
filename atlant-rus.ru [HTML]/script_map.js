

function city(n){
	
	if(n=="Москва"){n="Москву"}
	else if(n=="Уфа"){n="Уфу"}
	else if(n=="Чита"){n="Читу"};
	
	
	
	
	document.getElementById('dostavka').innerHTML="Доставка в<br><span style='color:#fcc436;'>"+n+"</span> от";
	if(n=="Сахалин"){ document.getElementById('dostavka').innerHTML="Доставка на<br><span style='color:#fcc436;'>"+n+"</span> от"; }
	if(n=="Камчатка"){ n="Камчатку"; document.getElementById('dostavka').innerHTML="Доставка на<br><span style='color:#fcc436;'>"+n+"</span> от";  };
	
	
	var s_list = new Object();
	
	s_list["Краснодар"] = "1";
	s_list["Москва"] = "2";
	s_list["Казань"] = "3";
	s_list["Уфа"] = "4";
	s_list["Екатеринбург"] = "5";
	s_list["Тюмень"] = "6";
	s_list["Ханты-Мансийск"] = "5";
	s_list["Новосибирск"] = "4";
	s_list["Абакан"] = "3";
	s_list["Иркутск"] = "1";
	s_list["Улан-Удэ"] = "2";
	s_list["Чита"] = "3";
	s_list["Якутск"] = "6";
	s_list["Магадан"] = "3";
	s_list["Хабаровск"] = "2";
	s_list["Владивосток"] = "9";
	s_list["Сахалин"] = "7";
	s_list["Камчатка"] = "1";
	
	for (var x in s_list){
		
  		if(n==x){ document.getElementById('days').innerHTML=s_list[x]; break; }
	}
}