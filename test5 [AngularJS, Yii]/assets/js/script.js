

'use strict';


angular.module('test-app', [])
   .controller('ctrlForm', function($scope) {
       $scope.greeting = "";
	   
});

var app = angular.module('test-app', ['ui.utils']);
app.controller('ctrlForm',function($scope, $http) {
    $scope.user = {};
    $scope.submit = function() {
		
		$scope.greeting = "Авторизация";
		
		
        if ( $scope.form.$valid ) {
			
            $http.post( window.location+'/site/githublogin/', $scope.user ).success(function( res ){
				
				
				console.log(res);
				
				if(res.res.indexOf('200 OK') + 1){
                	
				    $scope.user = {};
                    $scope.form.$setPristine();
                    $scope.greeting = "Авторизация успешна";
					$scope.h1=true;
					$scope.h2=true;
					
					
					var tmp_M=res.res.split("["); 
					res.res="["+tmp_M[1];
					
					var result = JSON.parse( res.res );
					
					var repo = angular.element(document.querySelector("body"));
					var repoH = repo.find('.repo');
					var navigation=repo.find('.btn-group__graph');
					$scope.greeting = "Список репозиториев";
					for(var i=0;i<(result.length);i++){
						//alert(result[i].name+" == "+result[i].url);	
						var newDiv = angular.element("<div>");
						//prepend('<div>'+result[i].name+'  '+result[i].url+'</div>');
						newDiv.text(''+result[i].name+'   '+result[i].url+'');
						newDiv.addClass("btn");
						newDiv.addClass("btn-default");
						newDiv.attr("data-commits", result[i].url);
						newDiv.attr("data-owner", result[i].owner.login);
						newDiv.attr("data-repo", result[i].name);
						
						var newDiv2 = angular.element("<button>");
						newDiv2.text(result[i].name);
						newDiv2.addClass("btn");
						newDiv2.addClass("btn-default");
						newDiv2.attr("data-commits", result[i].url);
						newDiv2.attr("data-owner", result[i].owner.login);
						newDiv2.attr("data-repo", result[i].name);
						newDiv2.attr("type", "button");
						
						
						repoH.append(newDiv);
						navigation.append(newDiv2);
						
					};
					
					
					$('.btn').on('click', function(){
  						var url=$(this).attr("data-commits");
						var owner=$(this).attr("data-owner");
						var repo=$(this).attr("data-repo");
						
						
						$http.post( window.location+'/site/githubcommits/', { 'url' : url, 'owner' : owner, 'repo' : repo } ).success(function( res ){
							
							
							if(res.indexOf('200 OK') + 1){
								
								$scope.h3_graph=true;
								var tmp_M=res.split("\n["); 
								res="["+tmp_M[1];
								
								var result = JSON.parse(res);
								var all_commit_messages="";
								
								for(var i=0;i<(result.length) && i<50;i++){
									all_commit_messages=all_commit_messages+result[i].commit.message;
									
								}
								//alert(all_commit_messages);
								
								//подсчитать статистику
								var M_stat=Array();// M_stat['a']=10; массив со статистикой
								var M_result=Array();
								
								var mas=Array(['Символ', 'Число вхождений']);
								var i2=1;
								for(var i=0; i<all_commit_messages.length; i++){
									//если элемент с ключом в массиве существует, то увеличиваем его значение на еденицу
									//если не существует - создаём со значением = 1
									
									if(M_stat[all_commit_messages[i]]!=undefined && M_stat[all_commit_messages[i]]!=NaN){
										
										M_stat[all_commit_messages[i]]=M_stat[all_commit_messages[i]]/1+1;
										
										//alert(all_commit_messages[i]+" -- "+(M_stat[all_commit_messages[i]]-1));	
										//var index=mas.indexOf( [all_commit_messages[i], (M_stat[all_commit_messages[i]]-1)] );
										
										//if(index != -1){
										//	mas[index]=[all_commit_messages[i],  M_stat[all_commit_messages[i]]];
										//}
									}else{
										M_stat[all_commit_messages[i]]=1;	
										//mas[i2]=[all_commit_messages[i],  M_stat[all_commit_messages[i]]];
										//i2++;
										
									}
									//alert(all_commit_messages[i]+" -- "+M_stat[all_commit_messages[i]]);
										
								}
								
								
								//M_stat.forEach(function(entry) {
								//	alert("===");
								//}
								
								for (var key in M_stat) {
									//alert(key+" -- "+M_stat[key]);
									mas[i2]=[key, M_stat[key]];
									i2++;
								}
								
								
								//mas[1]=["q", 100];
								//mas[2]=["w", 200];
								//mas[3]=["e", 300];
								
								
								
								
								console.log("---");
								console.log(mas);
								console.log("---");
								
								
								$scope.h2=false;
								$scope.h3=true;
								$scope.greeting = "Статистика по репозиторию "+repo;
						
								//сделать кнопку текущего репозитория неактивной
								$('.btn-group__graph button').removeClass("disabled");
								$('[data-repo="'+repo+'"]').addClass("disabled");
						
						
									 google.charts.load('current', {'packages':['corechart']});
									  google.charts.setOnLoadCallback(drawChart);
								
									  function drawChart() {
										var data = google.visualization.arrayToDataTable(
										  mas
										);
								
										var options = {
										  title: '',
										  hAxis: {title: 'Символы',  titleTextStyle: {color: '#333'}},
										  vAxis: {minValue: 0}
										};
								
										var chart = new google.visualization.AreaChart(document.getElementById('graph'));
										chart.draw(data, options);
									  }
															
								
								
								console.log(M_stat);
								console.log(result);	
							}else{
								$scope.h2=false;
								$scope.h3=true;
								$scope.greeting = "Ошибка. Возможно репозиторий "+repo+" пуст";	
								$scope.h3_graph=false;
								
								//сделать кнопку текущего репозитория неактивной
								$('.btn-group__graph button').removeClass("disabled");
								$('[data-repo="'+repo+'"]').addClass("disabled");
								
							}
							
							
							
						}).error(function(err){
                			$scope.greeting = err;
				
            			});
						
						
					});
					
					
					console.log(result);
					
                } else {
                    $scope.greeting = "Ошибка авторизации. Неверный токен.";
                }
            }).error(function(err){
                $scope.greeting = err;
				
            });
        }
		
		

		
		
    }
	
	
	
	
	//$scope.commits_repo = function (url){
    // 	alert("111");
    //};	

	
	
	
});

