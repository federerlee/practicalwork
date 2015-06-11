<?php
require 'config.php';
require 'lib/Slim/Slim.php';
require 'dbsql.php';


\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


$app->get('/products','getproducts');//function of getproducts is in dbsql.php

$app->post('/products',function() use ($app) {
    
    $request = $app->request->getBody();
    
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


$app->get('/products-statuses','getProductsStatuses');

$app->post('/products-statuses',function() use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
   
    createProductsStatus($params);
    
});

$app->put('/products-statuses/:id',function($id) use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
   
    updateproductsStatus($id, $status);
    
});


$app->delete('/products-statuses/:id',function($id) {
    deleteProductsStatus($id);
});





$app->get('/users','getUsers');

$app->post('/users',function() use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
   
    createUsers($params);
    
});

$app->put('/users/:id',function($id) use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
   
    updateUsers($id, $params);
    
});

$app->delete('/users/:id',function($id) {
    deleteUsers($id);
});




$app->get('/contacts','getContacts');

$app->post('/contacts',function() use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
    
    createContact($params);
    
});

$app->put('/contacts/:id',function($id) use ($app) {
    
    $request = $app->request->getBody();
    
    $params = json_decode($request);
    
    //var_dump($params);
    
    updateContact($id, $params);
    
});

$app->delete('/contacts/:id',function($id) {
    deleteContact($id);
});





$app->run();