// script.js

    // create the module and name it mainhApp
        // also include ngRoute for all our routing needs
    var mainApp = angular.module("mainApp",[]);
	
	
	
	var weatherurl = "http://api.openweathermap.org/data/2.5/weather?q=Tampere,fi&units=metric";
	  //var weatherurl = "http://api.openweathermap.org/data/2.5/forecast/city?id=524901&APPID=9e2f6ea17c4afdfc211f1e21a624ce3a";
	   
 
   console.log("weatherurl value 1:" +  weatherurl);
   
   
   

   
/*
    // create the controller and inject Angular's $scope
    mainApp.controller('mainController', function($scope, $http) {
        // create a message to display in our view
       
	console.log("weatherurl value 2:" +  weatherurl);
	
	$http.post(weatherurl)
    .success(function (response) {$scope.currentweather= response;});
	 $scope.message = 'This is home page from home.html';
    });

*/	

mainApp.controller('mainController', function($scope, weatherService) {
        $scope.message = 'This is about page from about.html';
		  console.log("weatherurl value 3:" +  weatherurl);
		  
	  
	var promiseOfResults = weatherService.all();
 
	
	promiseOfResults.then(function(data){
		$scope.currentweather = data;
		console.log(" weather services is running"+$scope.currentweather);
	},
	function(error){
		console.log(error);
		console.log("weather services not run");
	});
 
    });

	
  mainApp.factory("weatherService", function($http, $q){
	
	var factoryObject = {};
	
	factoryObject.all = function() {
		
		var deferred = $q.defer();
		
	
		$http.get(weatherurl).success(function(responseData){
			deferred.resolve(responseData);
		})
		.error(function(reason){
			deferred.reject("This error happened: " + reason);
		});
		
		return deferred.promise;
	};
	
	return factoryObject;
});