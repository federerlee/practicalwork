<?php
require 'config.php';
require 'lib/Slim/Slim.php';
require 'dbsql.php';
//require_once 'passwordHash.php';
//only get method can display the data on the page

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

//echo 'Just for echo';
// User id from db - Global Variable
//$user_id = NULL;

$app->get('/products','getProducts');//function of getproducts is in dbsql.php

$app->post('/products',function() use ($app) {
    
    $request = $app->request->getBody();
	//header("Content-Type: text/json");
    $mandatory = array('name');
    $data = json_decode($request);//
	
   
    //var_dump($params);

   $rows =insertproducts("products",$data, $mandatory);//function of insertproducts is in dbsql.php
   if($rows["status"]=="success")
        $rows["message"] = "Product added successfully.";
    echoResponse(200, $rows);
});




$app->put('/products/:id',function($id) use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
    
    updateProducts($id, $params);//function of updateProducts is in dbsql.php
    
});


$app->delete('/products/:id',function($id) {
    deleteProducts($id);
});








//codes for authentication system


$app->get('/session', function() {
    
    $session = getSession();//function of getSession() is in dbsql.php
    $response["uid"] = $session['uid'];
    $response["email"] = $session['email'];
    $response["name"] = $session['name'];
	
	//echo  'SESSION UID='.$_SESSION['uid'];
	//echo  'SESSION NAME='.$_SESSION['name'];
	//echo 'SESSION EMAIL='.$_SESSION['email'];
	//echo 'br';
	//echo  'SESS UID='.$sess["uid"];
	//echo 'SESS NAME='.$sess["name"];
	//echo  'SESS EMAIL='.$sess["email"];
	
    echoResponse(200, $session);
});


$app->post('/login', function() use ($app) {
    $response = array();
	require_once 'passwordHash.php';
	//echo 'login...';
    $r = json_decode($app->request->getBody());
	//echo '$r';
    verifyRequiredParams(array('email', 'password'),$r->customer);
  
 
    $password = $r->customer->password;
    $email = $r->customer->email;
	//get the record which contain email 
    //$user = getOneRecord("select uid,name,password,email,created from customers_auth where phone='$email' or email='$email'");//function of getOneRecord is in dbsql.php
	 $user = getOneRecord("select uid,name,password,email,created from customers_auth where email='$email'");//function of getOneRecord is in dbsql.php
	//$response['password'] = $user['password'];
	//$response['name'] = $user['name'];
		echo '$user';
    if ($user != NULL){
		
          if(passwordHash::check_password($user['password'],$password)){
		//if($user['password']==$password){
			$response['status'] = "success";
			$response['message'] = 'Logged in successfully';
			$response['name'] = $user['name'];
			$response['uid'] = $user['uid'];
			$response['email'] = $user['email'];
			$response['createdAt'] = $user['created'];
		  
			// if the user has been authenticated, then session variables are stored in the current users
			if (!isset($_SESSION)) {
				session_start();
        
				$_SESSION['uid'] = $user['uid'];
				$_SESSION['email'] = $email;
				$_SESSION['name'] = $user['name'];
				} 
			
			
			echoResponse(200, $response);
		}
		else {
            //$response['status'] = $user['password'];
			$response['status'] = "error login";
            //  $response['message'] =  $password;

			  $response['message'] = 'Login failed. Incorrect credentials,please input again  '; 
		   	echoResponse(201, $response);
			   }
			   
	}
	else {
            
			
			$response['status'] = "error";
            $response['message'] = 'Login failed. user invalid  '; 
	
			//$response['password'] = $user['password'];
			//$response['name'] = $response['name'];
					echoResponse(201, $response);
        }	
   
	 //} one more '}' can cause http 500 server error	
		
	//echo 'login success';
   // echoResponse(200, $response);
	
	

});



/*
$app->get('/login', function() use ($app) {
    $response = array();
	require_once 'passwordHash.php';
	//echo 'login...';
    $r = json_decode($app->request->getBody());
	//echo '$r';
    verifyRequiredParams(array('email', 'password'),$r->customer);
  
 
    $password = $r->customer->password;
    $email = $r->customer->email;
	//get the record which contain email 
    //$user = getOneRecord("select uid,name,password,email,created from customers_auth where phone='$email' or email='$email'");//function of getOneRecord is in dbsql.php
	 $user = getOneRecord("select email,password from customers_auth where email='$email'");//function of getOneRecord is in dbsql.php
	//$response['password'] = $user['password'];
	//$response['name'] = $user['name'];
	echo 'user=';
		echo '$user';
    if ($user != NULL){
		
          //if(passwordHash::check_password($user['password'],$password)){
		if($user['password']==$password){
			$response['status'] = "success";
			$response['message'] = 'Logged in successfully';
			//$response['name'] = $user['name'];
			//$response['uid'] = $user['uid'];
			//$response['email'] = $user['email'];
			//$response['createdAt'] = $user['created'];
		  
		
			if (!isset($_SESSION)) {
				session_start();
        
				$_SESSION['uid'] = $user['uid'];
				$_SESSION['email'] = $email;
				$_SESSION['name'] = $user['name'];
				} 
			
			
			echoResponse(200, $response);
		}
		else {
            $response['status'] = "error";
               $response['message'] = 'Login failed. Incorrect credentials  '; 
		   	echoResponse(201, $response);
			   }
			   
	}
	else {
            $response['status'] = "error";
            $response['message'] = 'Login failed. user invalid  '; 
	
			$response['password'] = $user['password'];
			$response['name'] = $response['name'];
					echoResponse(201, $response);
        }	
   
	 //} one more '}' can cause http 500 server error	
		
	//echo 'login success';
   // echoResponse(200, $response);
	
	

});

*/

$app->post('/signUp', function() use ($app) {
    $response = array();
    $request = json_decode($app->request->getBody());
	
    verifyRequiredParams(array('email', 'name', 'password'),$request->customer);
    require_once 'passwordHash.php';
  
    $phone = $request->customer->phone;
    $name = $request->customer->name;
    $email = $request->customer->email;
    $address = $request->customer->address;
    $password = $request->customer->password;
	
	echo  $email;
	echo  $name;
    $isUserExists = getOneRecord("select * from customers_auth where phone='$phone' or email='$email'");//function of getOneRecord is in dbsql.php
	 if(!$isUserExists){
    //if(1){
        $request->customer->password = passwordHash::hash($password); // hash the password
        $tabble_name = "customers_auth";
        $column_names = array('phone', 'name', 'email', 'password', 'city', 'address');
        $result = insertIntoTable($request->customer, $column_names, $tabble_name);//function of insertIntoTable is in dbsql.php
        if ($result != NULL) {
            $response["status"] = "success";
            $response["message"] = "User account created successfully";
            $response["uid"] = $result;
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['uid'] = $response["uid"];
            $_SESSION['phone'] = $phone;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
			//echo  $email;
			//echo 'json_encode($result);';
			//return $response;
            echoResponse(200, $response);
        } else {
            $response["status"] = "error";
            $response["message"] = "Failed to create customer. Please try again";
			//echo 'json_encode( $response);';
			//return $response;
            echoResponse(201, $response);
        }            
    }else{
        $response["status"] = "error";
        $response["message"] = "An user with the provided phone or email exists!";
        echoResponse(201, $response);
    }
});

$app->get('/logout', function() {
   
    $session = destroySession();//function of destroySession() is in dbsql.php
    $response["status"] = "info";
    $response["message"] = "Logged out successfully";
    echoResponse(200, $response);
});

// Function for handling the summiting form

$app->post('/contactSubmission', function() use ($app){


	$response = array();
    $r = json_decode($app->request->getBody());
    $formInformation=$r->contactInformation->Comment;
    $contactresult = getContactFormData($formInformation);//function of getContactFormData() is in dbsql.php
    $response["message"] = $contactresult['message'];
    $response["contactEmail"] = $contactresult['contactEmail'];
    $response["contactName"] = $contactresult['contactName'];
	// $response["status"] = $contactresult['status'];
	$response["status"] = '200';
	//echo  'SESSION UID='.$_SESSION['uid'];
	//echo  'SESSION NAME='.$_SESSION['name'];
	//echo 'SESSION EMAIL='.$_SESSION['email'];
	//echo 'br';
	//echo  'SESS UID='.$sess["uid"];
	//echo 'SESS NAME='.$sess["name"];
	//echo  'SESS EMAIL='.$sess["email"];
	
    echoResponse(200, $response);
});


/**
// Verifying required params posted or not
 */

function verifyRequiredParams($required_fields,$request_params) {
    $error = false;
    $error_fields = "";
    foreach ($required_fields as $field) {
        if (!isset($request_params->$field) || strlen(trim($request_params->$field)) <= 0) {
            $error = true;
            $error_fields .= $field . ', ';
        }
    }

    if ($error) {
        // Required field(s) are missing or empty
        // echo error json and stop the app
        $response = array();
        $app = \Slim\Slim::getInstance();
        $response["status"] = "error";
        $response["message"] = 'Required field(s) ' . substr($error_fields, 0, -2) . ' is missing or empty';
        echoResponse(200, $response);
        $app->stop();
    }
}



function echoResponse($status_code, $response) {
    $app = \Slim\Slim::getInstance();
    // Http response code
    $app->status($status_code);

    // setting response content type to json
	$app->contentType('application/json');


    echo json_encode($response);
}

 

$app->run();

?>