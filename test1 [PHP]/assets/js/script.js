'use strict';

/*
angular.module('test-app', [])
   .controller('ctrlForm1', function($scope) {
       $scope.greeting1 = "1111";
	  // $scope.greeting2 = "2222";
});
angular.module('test-app', [])
   .controller('ctrlForm2', function($scope) {
      	$scope.greeting2 = "2222";
});
*/


var app = angular.module('test-app', ['ui.utils']);

app.controller('ctrlForm1',function($scope, $http) {
	$scope.greeting1="";
	
    $scope.user = {};
    $scope.submit = function() {
		
		if(!($scope.user.phone.match(/^\d+$/))){
			alert("Некорректно задан номер телефона");
			
		}else{
		
			if ( $scope.form.$valid ) {
				
				$scope.greeting1 = "Отправка...";
		
				$http.post( window.location+'/ajax/send1.php', $scope.user ).success(function( res ){
					
					$scope.greeting1 = res;
					console.log(res);
					
					
				}).error(function(err){
					$scope.greeting = err;
					
				});
			}
		
		}
		
    }
	
	
});


app.controller('ctrlForm2',function($scope, $http) {
	$scope.greeting2="";
	
    $scope.user = {};
    $scope.submit = function() {
		
		$scope.greeting2 = "Отправка...";
		
		
        if ( $scope.form.$valid ) {
			
            $http.post( window.location+'/ajax/send2.php', $scope.user ).success(function( res ){
				
				
				console.log(res);
				$scope.greeting2 = res;
				
				/*
				if(res.res.indexOf('200 OK') + 1){
                	
				    $scope.user = {};
                    $scope.form.$setPristine();
                    $scope.greeting = "Отправка успешна.";
					$scope.h1=true;
					$scope.h2=true;
					
					
                } else {
                    $scope.greeting = "Ошибка отправки.";
                }
				*/
				
            }).error(function(err){
                $scope.greeting = err;
				
            });
        }
		
		
    }
	
	
});


/*
angular.module('test-app', [])
   .controller('ctrlForm2', function($scope) {
       $scope.greeting = "";
	   
});



var app = angular.module('test-app', ['ui.utils']);
app.controller('ctrlForm2',function($scope, $http) {
    $scope.user = {};
    $scope.submit = function() {
		
		$scope.greeting = "Отправка...";
		
		
        if ( $scope.form.$valid ) {
			
            $http.post( window.location+'/ajax/send2.php', $scope.user ).success(function( res ){
				
				
				console.log(res);
				
				if(res.res.indexOf('200 OK') + 1){
                	
				    $scope.user = {};
                    $scope.form.$setPristine();
                    $scope.greeting = "Отправка успешна.";
					$scope.h1=true;
					$scope.h2=true;
					
					
                } else {
                    $scope.greeting = "Ошибка отправки.";
                }
            }).error(function(err){
                $scope.greeting = err;
				
            });
        }
		
		
    }
	
	
});

*/

