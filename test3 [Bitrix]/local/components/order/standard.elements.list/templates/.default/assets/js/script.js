

'use strict';


angular.module('test-app', [])
   .controller('ctrlForm', function($scope) {
       $scope.greeting = "Заполните форму";
	   
});


var id=0, price=0, discount_price=0, measure=0, count=0, name="", name_product="";


var app = angular.module('test-app', ['ui.utils']);
app.controller('ctrlForm',function($scope, $http) {
    $scope.user = {};
	$scope.user.sec="";

    $scope.$watch('selectProduct',function(){
		
		if($scope.selectProduct!=""){
			var m=$scope.selectProduct.split(":");
			id=m[0];
			price=m[1];
			discount_price=m[2];  
			measure=m[3];
			name_product=m[4];
			
			//alert(id+" -- "+price+" -- "+discount_price+" -- "+measure);
			$scope.measure=measure;
			$scope.Count=0;
			updateSum();
			
			
			
		}
    });
	
	$scope.$watch('Count',function(){
		
		updateSum();
		
		
    });
	
	function updateSum(){
		count=$scope.Count;
		var m=price.split(" ");
		var priceN=m[0];
		
		if(priceN/1 == discount_price/1){
			//нет скидки
			$scope.sum=priceN*count+" "+m[1];
			
		}else{
			//скидка есть
			$scope.sum=discount_price*count+" "+m[1]+" (вместо "+priceN*count+" "+m[1]+")";
				
		}
		
		
		
	}
	
	
    $scope.submit = function() {
		
		
	
        if ( $scope.form.$valid ) {
			$scope.greeting = "Отправка...";		
			
			$scope.user.name_product=name_product;
			$scope.user.count=count;
			$scope.user.sum=$scope.sum;
			$scope.user.id=id;
			
			console.log("+++++++++");
			console.log($scope.user);
			console.log("+++++++++");
			
			
			
			$http.post( $scope.hidden+'/send.php', $scope.user ).success(function( res ){
				//alert(res);
				console.log("--------");
				console.log(res);
				console.log("--------");
				
				if(res){
			  		
			  		
					
					$scope.h1=true;
					$scope.h2=true;
					$scope.greeting = "Отправлено успешно.";
				} else {
                	$scope.greeting = "Ошибка отправки. Вероятно некорректно заполнены одно или несколько полей.";
            	}
            
			}).error(function(err){
            	$scope.greeting = err;
				
        	});	
			
				
		}else{
			$scope.greeting = "Ошибка отправки. Вероятно некорректно заполнены одно или несколько полей.";
			
		}
			
			
			
	 	
		
    }
	
	

	
	
	
	
});

