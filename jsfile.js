// script.js

    // create the module and name it mainhApp
        // also include ngRoute for all our routing needs
    var mainApp = angular.module("mainApp", ['ngRoute','ui.bootstrap','ngAnimate','toaster']);// only add ui.bootstrip, then $modal can been added into the variables list of productsCtrl controller
	
	
	
	// var weatherurl = "http://api.openweathermap.org/data/2.5/weather?q=Tampere,fi";
	 //var weatherurl = "http://api.openweathermap.org/data/2.5/weather?q=London,uk&callback=test";
	 var weatherurl = "http://api.openweathermap.org/data/2.5/weather?q=Tampere,fi&units=metric";
	 // var weatherurl = "http://api.openweathermap.org/data/2.5/forecast/city?id=524901&APPID=9e2f6ea17c4afdfc211f1e21a624ce3a";
	     
 
   //console.log("weatherurl value 1:" +  weatherurl);
   
   
   

   
	/*
    // configure our routes
    mainApp.config(
	function($routeProvider) {
        $routeProvider

            // route for the home page
            .when('/home', {
                templateUrl : 'home.html',
                controller  : 'productsCtrl'
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
            })
			
			
			  .when('/login', {
				title: 'Login',
                templateUrl : 'authenticat/login.html',
                controller  : 'loginController'
            })
			
			  .when('/signup', {
				title: 'Signup',
                templateUrl : 'authenticat/signup.html',
                controller  : 'signupController'
            })
			  .when('/dashboard', {
                templateUrl : 'authenticat/dashboard.html',
                controller  : 'signupController'
            })
			
			.otherwise({
                redirectTo: '/'
            });
			
	  });  
		

 */
	
	
	
	
	mainApp.config(['$routeProvider',
  function ($routeProvider) {
        $routeProvider
		            // route for the home page
            .when('/home', {
                templateUrl : 'home.html',
                controller  : 'productsCtrl'
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
            })
			
			
			  .when('/login', {
				title: 'Login',
                templateUrl : 'authenticat/login.html',
                controller  : 'loginController'
            })
			
			  .when('/signup', {
				title: 'Signup',
                templateUrl : 'authenticat/signup.html',
                controller  : 'signupController'
            })
			
			  .when('/logout', {
				title: 'lougt',
                templateUrl : 'authenticat/logout.html',
                controller  : 'authCtrl'
            })
			  .when('/dashboard', {
                templateUrl : 'authenticat/dashboard.html',
                controller  : 'authCtrl'
           // })
			
			//.otherwise({
             //   redirectTo: '/'
            });
       
  }])
  
  .run(function ($rootScope, $location, Dataservice) {// run this whenever page is clicked or refleshed everytime
        $rootScope.$on("$routeChangeStart", function (event, next, current) {
            $rootScope.authenticated = false;
			console.log("Try to login?" );
			
            Dataservice.get('session').then(function (authresults) {
					var sessionresult=authresults.data;
					console.log("session uid:"+sessionresult.uid );
					console.log("session name:"+sessionresult.name );
					console.log("session email:"+sessionresult.email );
					
                if (sessionresult.uid) {
                    $rootScope.authenticated = true;
                    $rootScope.uid = sessionresult.uid;
                    $rootScope.name = sessionresult.name;
                    $rootScope.email = sessionresult.email;
					
					console.log("you have login successfully!" );
                } else {
				
				//$location.path("/");//if not login in , url turns to login or sign up page
                    var nextUrl = next.$$route.originalPath;
                     if (nextUrl == '/signup' || nextUrl == '/login') {

                     } else {
                         $location.path("/login");//if not logined in , url turns to login page or signup page
                     }
                }
            });
        });
    });
    
  
  
 
  
  
    // create the controller and inject Angular's $scope

    mainApp.controller('mainController', function($scope) {
        // create a message to display in our view
       $scope.message = 'This is main page from main.html';
	  

   });
   
  



   //Controller for contact page
    mainApp.controller('contactController', function($scope,$location,toaster,Dataservice) {
		$scope.contactSummit={};
		$scope.clearform={};
	/*	
		$scope.contactSummit = function (contactInformation) {
		contactInformation:contactInformation
        Dataservice.get('contactSubmission').then(function (results) {
		
	
					var formResult=results.data;
					console.log("session status:"+formResult.status );
					console.log("session message:"+formResult.message );
					toaster.pop('Summit','You have summitted successfully : '+formResult.message,'See you!','5000','toast-top-full-width');
            
            $location.path('/');
        });
		}
		
	*/	
		
	$scope.clearform = function () {
		$scope.contact='';

	}
		
    $scope.contactSummit = function (contactInformation) {
	
		if($scope.contact.Comment.length<5){
			toaster.pop('Warning','Please input more than 5 words!','Add more comment please!','5000','toast-top-full-width');
		}
		else if($scope.contact.cal!="2"){
			toaster.pop('Warning','Are you robot?!','Calculate and input again please!','5000','toast-middle-full-width');
		}
		else{
	
        Dataservice.post('contactSubmission', {
            contactInformation: contactInformation
        }).then(function (results) {
            //Dataservice.toast(results);
			console.log(results);
            if (results.status == "200") {
                $location.path('/');
				console.log(results);
				console.log("You have summitted successfully!");
				toaster.pop('success','You have summitted successfully','Thanks for your comment!','5000','toast-top-full-width');
            }
			//else
			  if (results.status == "201") {
                //$location.path('dashboard');
				toaster.pop('Summit Fail','Soory, erros happenned : '+results.data,'Please comment again!','5000','toast-top-full-width');
				console.log(results);
				console.log("Please comment again! !");
            }
        });
		}
				
		
    };
	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        $scope.message = 'This is contact page from contact.html';
    });
	
	  //Controller for about page
	   mainApp.controller('aboutController', function($scope) {
        $scope.message = 'This is an application for fulfilling of practical work for web programming';
    });
	
	   //Controller for contact page
    mainApp.controller('loginController', function($scope) {
        $scope.message = 'This is contact page from contact.html';
    });
	
	  //Controller for about page
	 mainApp.controller('signupController', function($scope) {
        $scope.message = 'This is an application for fulfilling of practical work for CMD and web programming ';
    });
 

 	 mainApp.controller('dashboardController', function($rootScope,$scope) {
        $scope.message = 'You  can logout here';
		
		 //$scope.uid= $rootScope.uid;//if use like this, it will only display the former uid and former name
        // $scope.name=$rootScope.name;
        // $scope.email=$rootScope.name;
		

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
 
 
 
 
 
 mainApp.controller('productsCtrl', function ($scope, $modal,$filter,$route, Dataservice) {
 
	console.log("Products are being processed");
	
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
 
 
	$scope.product = {};
	$scope.productready=0;
    Dataservice.get('products').then(function(data){
      
		$scope.products = data.data;
			//var object=$scope.products;
			
			//$productcount = Object.keys(object).length
			console.log(" products have been taken now");
			console.log($scope.products);
			//console.log($productcount);
			console.log($scope.products.products.length);
			$scope.productready=1;
    });
	
	
    $scope.changeProductStatus = function(product){
        product.status = (product.status=="Active" ? "Inactive" : "Active");// if status of the product is active, change to active, if not, change to inactive
		console.log(" stop here 1?");
        //Dataservice.put("products/"+product.id,{status:product.status});
		Dataservice.put("products/"+product.id,product);// Send the entire record instead of just column status, otherwise, nothing happens
		console.log(" stop here 2?");
    };
	
	
    $scope.deleteProduct = function(product){
        if(confirm("Are you sure to remove the product?")){
            Dataservice.delete("products/"+product.id).then(function(result){ // delete id for the database
			console.log(" stop here 3?");
			  $scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));// dump execution for the database, just for display, 
			  $route.reload();// reflash the page
                //$scope.products = _.without($scope.products, _.findWhere($scope.products, {id:product.id}));
					console.log(" stop here 4?");
            });
        }
    };
	
	 //$scope.deleteProduct();
	 
	 
    $scope.open = function (p,size) {
        var modalInstance = $modal.open({
          templateUrl: 'app/productEdit.html',
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
              //  $scope.products.push(selectedObject); //add a new selectedOject to the products array
                $scope.products = $filter('orderBy')($scope.products, 'id', 'reverse');// Orders products  array by the id in the reverse order.
				
            }else if(selectedObject.save == "update"){ // update dialog 
                p.description = selectedObject.description;// store the  data in the dialog
                p.price = selectedObject.price;
                p.stock = selectedObject.stock;
                p.packing = selectedObject.packing;
            }
        });
	
    };
	
	
    

 

});
 
 
 
 
mainApp.controller('productEditCtrl', function ($scope, $modalInstance, $route, item, Dataservice) {

  $scope.product = angular.copy(item);
        
        $scope.cancel = function () {
            $modalInstance.dismiss('Close');//cancle button
        };
        $scope.title = (item.id > 0) ? 'Edit Product' : 'Add Product'; // decide wheather edit product or add product
        $scope.buttonText = (item.id > 0) ? 'Update Product' : 'Add New Product';

        var original = item;
        $scope.isClean = function() {
            return angular.equals(original, $scope.product);//Determines if two objects or two values are equivalent.
        }
		
        $scope.saveProduct = function (product) {
            product.uid = $scope.id; //It has to be uid but not product.id = $scope.id; otherwise, it can not fresh the page automatically
			//And It $scope.uid has to be $scope.idu; otherwise, it will confused with the $scope.uid in the authenticate variables and make the uid has value and then can not insert the record into the database.
            if(product.id > 0){
                Dataservice.put('products/'+product.id, product).then(function (result) {// put method to modify the item to update the database
                    if(result.status != 'error'){
                        var x = angular.copy(product);//Copy oject product to x
                        x.save = 'update';
                        $modalInstance.close(x);
						//$route.reload();// reflash the page
                    }else{
                        console.log(result);
                    }
                });
            }else{
                product.status = 'Active';
				console.log(" stop here 5?");
                Dataservice.post('products', product).then(function (result) {// post method to add one item to insert into the database
				
				console.log(" stop here 6?");
                    if(result.status != 'error'){
                        var x = angular.copy(product);
                        x.save = 'insert';
                        x.id = result.data;
                        $modalInstance.close(x);
							$route.reload();// reflash the page
                    }else{
                        console.log(result);
                    }
                });
            }
        };
});

 
 
 
 
 mainApp.factory("Dataservice", ['$http', '$location',// $location is uselss here?
    function ($http, $q,$location) {

        var serviceBase = 'http://home.tamk.fi/~e4lguoli/practicalwork/app/index.php/';

        var obj = {};
		
	
		//obj.toast = function (data) {
         //   toaster.pop(data.status, "", data.message, 10000, 'trustedHtml');
			//toaster.info('Page Loaded!');
       // }
		
		
        obj.get = function (q) {
		console.log("get are being Taken please show"+serviceBase + q);
		return $http.get(serviceBase + q);
            //return $http.get(serviceBase + q).then(function (results) {
              //  return results.data;
			//});	
           
        };
		

		

        obj.post = function (q, object) {
		//JSON.stringify(q);
		console.log("Products are being post please wait"+serviceBase + q);
		var myString = '{"name":"nomad"}';
		console.log(JSON.parse(myString));
		console.log(object);
		return $http.post(serviceBase + q, object);// q is 'products', object is 'product'
            //return $http.post(serviceBase + q, object).then(function (results) {
                //return results.data;
            //});
        };
        obj.put = function (q, object) {
		console.log("Products are being put please wait"+serviceBase + q+object);
		console.log(object);
          return  $http.put(serviceBase + q, object);
			//return $http.put(serviceBase + q, object).then(function (results) {
                //return results.data;
            //});
        };
        obj.delete = function (q) {
		return $http.delete(serviceBase + q)
            //return $http.delete(serviceBase + q).then(function (results) {
              //  return results.data;
            //});
        };
        return obj;
}]);

 
 
 
 
 
 mainApp.controller('authCtrl',function ($scope, $rootScope, $routeParams, $location, $http,toaster,Dataservice) {
    //initially set those objects to null to avoid undefined error
    $scope.login = {};
    $scope.signup = {};
	

	
	
    $scope.doLogin = function (customer) {
	
		
	
        Dataservice.post('login', {
            customer: customer
        }).then(function (results) {
            //Dataservice.toast(results);
            if (results.status == "200") {
                $location.path('/dashboard');
				console.log(results);
				console.log("You have loggin into the system successfully!");
				toaster.pop('success','You have login','Welcome back!','5000','toast-top-full-width');
            }
			//else
			  if (results.status == "201") {
                //$location.path('dashboard');
				toaster.pop('Authentication Fail','Soory, You cannot login : '+results.data,'Please input the right email or password!','5000','toast-top-full-width');
				console.log(results);
				console.log("You cannt loggin into the system !");
            }
        });
		
		
		
		//Dataservice.get('login').then(function (results) {
           
				//console.log(results.data);
				//console.log("display the login service!");
            
        //});
	
		
		
		
    };
	
	
	
	
	
	
	$scope.logout = function () {
        Dataservice.get('logout').then(function (results) {
		
	
					var sessionresult=results.data;
					console.log("session status:"+sessionresult.status );
					console.log("session message:"+sessionresult.message );
					toaster.pop('Logout','You have logout : '+sessionresult.message,'See you!','5000','toast-top-full-width');
            
            $location.path('/login');
        });
		}
		
   // $scope.signup = {email:'',password:'',name:'',phone:'',address:''};
    $scope.signUp = function (customer) {
	
	console.log("Signup are being process please wait");
        Dataservice.post('signUp', {
		
            customer: customer
        }).then(function (results) {
		
			console.log("Signup have been post please wait");
			console.log(results);
            //Dataservice.toast(results);
            if (results.status == "200") {
                console.log(results);
				$location.path('/login');
				console.log("Turn to login page");
				toaster.pop('SignUpsuccess','Your account has been created! '+result.data,'Please use you new account to login!','5000','toast-top-full-width');
            }
			if (results.status == "201") {
                console.log(results);
				//$location.path('/login');
				console.log("error happens");
				toaster.pop('SignUpfail','Fail to creat your account! '+result.data,'Please use creat your new account to again!','5000','toast-top-full-width');
            }
        });
    };
	
	

});
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 // directive for products 
mainApp.directive('formElement', function() {
    return {
        restrict: 'E',
        transclude: true,
        scope: {
            label : "@",
            model : "="
        },
        link: function(scope, element, attrs) {
            scope.disabled = attrs.hasOwnProperty('disabled');
            scope.required = attrs.hasOwnProperty('required');
            scope.pattern = attrs.pattern || '.*';
        },
        template: '<div class="form-group"><label class="col-sm-3 control-label no-padding-right" >  {{label}}</label><div class="col-sm-7"><span class="block input-icon input-icon-right" ng-transclude></span></div></div>'
      };
        
});

mainApp.directive('onlyNumbers', function() { // for the input dialog pop up by insert form
    return function(scope, element, attrs) {
        var keyCode = [8,9,13,37,39,46,48,49,50,51,52,53,54,55,56,57,96,97,98,99,100,101,102,103,104,105,110,190];
        element.bind("keydown", function(event) {
            if($.inArray(event.which,keyCode) == -1) {
                scope.$apply(function(){
                    scope.$eval(attrs.onlyNum);
                    event.preventDefault();
                });
                event.preventDefault();
            }

        });
    };
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
 
 // directives for authenticate


mainApp.directive('passwordMatch', [function () {
    return {
        restrict: 'A',
        scope:true,
        require: 'ngModel',
        link: function (scope, elem , attrs,control) {
            var checker = function () {
 
                //get the value of the first password
                var e1 = scope.$eval(attrs.ngModel); 
 
                //get the value of the other password  
                var e2 = scope.$eval(attrs.passwordMatch);
                if(e2!=null)
                return e1 == e2;
            };
            scope.$watch(checker, function (n) {
 
                //set the form control to valid if both 
                //passwords are the same, else invalid
                control.$setValidity("passwordNoMatch", n);
            });
        }
    };
}]);

  




 
