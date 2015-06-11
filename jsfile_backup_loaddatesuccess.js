// script.js

    // create the module and name it mainhApp
        // also include ngRoute for all our routing needs
    var mainApp = angular.module("mainApp", ["ngRoute"]);
	
	
	
	// var weatherurl = "http://api.openweathermap.org/data/2.5/weather?q=Tampere,fi";
	 //var weatherurl = "http://api.openweathermap.org/data/2.5/weather?q=London,uk&callback=test";
	 var weatherurl = "http://api.openweathermap.org/data/2.5/weather?q=Tampere,fi&units=metric";
	 // var weatherurl = "http://api.openweathermap.org/data/2.5/forecast/city?id=524901&APPID=9e2f6ea17c4afdfc211f1e21a624ce3a";
	     
 
   //console.log("weatherurl value 1:" +  weatherurl);
   
   
   

   

    // configure our routes
    mainApp.config(function($routeProvider) {
        $routeProvider

            // route for the home page
            .when('/', {
                templateUrl : 'home.html',
                controller  : 'mainController'
            })

            // route for the about page
            .when('/about', {
                templateUrl : 'about.html',
                controller  : 'aboutController'
            })

            // route for the contact page
            .when('/contact', {
                templateUrl : 'contact.html',
                controller  : 'contactController'
            });
    });

    // create the controller and inject Angular's $scope
    mainApp.controller('mainController', function($scope) {
        // create a message to display in our view
       $scope.message = 'This is main page from main.html';
	  

   });
   
   



   //Controller for contact page
    mainApp.controller('contactController', function($scope) {
        $scope.message = 'This is contact page from contact.html';
    });
	
	  //Controller for about page
	   mainApp.controller('aboutController', function($scope) {
        $scope.message = 'This is about page from about.html';
    });
 

  mainApp.controller('headController', function($scope,weatherService) {
        // create a message to display in our view
       $scope.message = 'This is main page from main.html';
	   
	   
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
 
 
 
  mainApp.controller('productsCtrl', function($scope,productService) {
    
	  $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Name",predicate:"name",sortable:true},
                    {text:"Price",predicate:"price",sortable:true},
                    {text:"Stock",predicate:"stock",sortable:true},
                    {text:"Packing",predicate:"packing",reverse:true,sortable:true,dataType:"number"},
                    {text:"Description",predicate:"description",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Action",predicate:"",sortable:false}
                ];  
	 
	 
	 
	 
		  
	  
	var promiseOfResults = productService.all();
 
	
	promiseOfResults.then(function(data){
		$scope.products = data;
		console.log(" products taken"+$scope.products);
	},
	function(error){
		console.log(error);
		console.log("Products are not got");
	});
	
	
	
	
	
	
	

   });
 

  mainApp.factory("productService", function($http, $q){
  
  
	 producturl='http://home.tamk.fi/~e4lguoli/practicalwork/app/index.php/products';
	 console.log("products control:" + producturl);
	
	var factoryObject = {};
	
	factoryObject.all = function() {
		
		var deferred = $q.defer();
		
	
		$http.get(producturl).success(function(responseData){
			deferred.resolve(responseData);
		})
		.error(function(reason){
			deferred.reject("This error happened: " + reason);
		});
		
		return deferred.promise;
	};
	
	return factoryObject;
});





mainApp.directive('focus', function() {
    return function(scope, element) {
        element[0].focus();
    }      
});

mainApp.directive('animateOnChange', function($animate) {
  return function(scope, elem, attr) {
      scope.$watch(attr.animateOnChange, function(nv,ov) {
        if (nv!=ov) {
              var c = 'change-up';
              $animate.addClass(elem,c, function() {
              $animate.removeClass(elem,c);
          });
        }
      });  
  }  
}); 
 
 
 /*
 
   mainApp.controller('productsCtrl', function ($scope, $modal, $filter, Data) {
   
    $scope.product = {};
	
    Data.get('products').then(function(data){
        $scope.products = data.data;
    });
    $scope.changeProductStatus = function(product){
        product.status = (product.status=="Active" ? "Inactive" : "Active");
        Data.put("products/"+product.id,{status:product.status});
    };
    $scope.deleteProduct = function(product){
        if(confirm("Are you sure to remove the product")){
            Data.delete("products/"+product.id).then(function(result){
                $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));
            });
        }
    };
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'partials/productEdit.html',
          controller: 'productEditCtrl',
          size: size,
          resolve: {
            item: function () {
              return p;
            }
          }
        });
        modalInstance.result.then(function(selectedObject) {
            if(selectedObject.save == "insert"){
                $scope.products.push(selectedObject);
                $scope.products = $filter('orderBy')($scope.products, 'id', 'reverse');
            }else if(selectedObject.save == "update"){
                p.description = selectedObject.description;
                p.price = selectedObject.price;
                p.stock = selectedObject.stock;
                p.packing = selectedObject.packing;
            }
        });
    };
    
 $scope.columns = [
                    {text:"ID",predicate:"id",sortable:true,dataType:"number"},
                    {text:"Name",predicate:"name",sortable:true},
                    {text:"Price",predicate:"price",sortable:true},
                    {text:"Stock",predicate:"stock",sortable:true},
                    {text:"Packing",predicate:"packing",reverse:true,sortable:true,dataType:"number"},
                    {text:"Description",predicate:"description",sortable:true},
                    {text:"Status",predicate:"status",sortable:true},
                    {text:"Action",predicate:"",sortable:false}
                ];

});


mainApp.factory("Data", ['$http', '$location',
    function ($http, $q, $location) {

        var serviceBase = 'app/';

        var obj = {};

        obj.get = function (q) {
            return $http.get(serviceBase + q).then(function (results) {
                return results.data;
            });
        };
        obj.post = function (q, object) {
            return $http.post(serviceBase + q, object).then(function (results) {
                return results.data;
            });
        };
        obj.put = function (q, object) {
            return $http.put(serviceBase + q, object).then(function (results) {
                return results.data;
            });
        };
        obj.delete = function (q) {
            return $http.delete(serviceBase + q).then(function (results) {
                return results.data;
            });
        };
        return obj;
}]);


*/