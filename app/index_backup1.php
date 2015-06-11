<?php
require 'config.php';
require 'lib/Slim/Slim.php';
require 'dbsql.php';


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


$app->get('/products','getProducts');//function of getproducts is in dbsql.php

$app->post('/products',function() use ($app) {
    
    $request = $app->request->getBody();
	header("Content-Type: text/json");
    
    $params = json_decode($request);
   
    //var_dump($params);

    createproducts($params);//function of creatproducts is in dbsql.php
    
});

$app->put('/products/:id',function($id) use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
    
    updateProducts($id, $params);
    
});


$app->delete('/products/:id',function($id) {
    deleteProducts($id);
});





$app->run();