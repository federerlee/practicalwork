<?php

require_once 'dbsql.php';



function getProducts() {
$sql = "SELECT id,sku,name,price,mrp,description,packing,image,category,stock,status FROM products ORDER BY id DESC";
    try {
        $db = getDB();//getDB is a function from config.php?
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"products": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}



//function createProducts($id, $sku, $name, $mrp, $description, $packing, $image, $category, $stock, $status) {
function createProducts($params) {
    
$sql = "INSERT into products (id,sku,name,price,mrp,description,packing,image,category,stock,status) values (:id, :sku, :name, :price, :mrp, :description, :packing, :image, :category, :stock, :status)";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $params->id);//set the value of id into :id
        $stmt->bindParam(':sku', $params->sku);
        $stmt->bindParam(':name', $params->name);
		$stmt->bindParam(':price', $params->price);
        $stmt->bindParam(':mrp', $params->mrp);
        $stmt->bindParam(':description', $params->description);
        $stmt->bindParam(':packing', $params->packing);
        $stmt->bindParam(':image', $params->image);
        $stmt->bindParam(':category', $params->category);
        $stmt->bindParam(':stock', $params->stock);
       
        $stmt->bindParam(':status', $params->status);
        
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteProducts($id) {
    
$sql = "DELETE from products where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function updateProducts($id, $params) {
    
$sql = "UPDATE products SET id = :id, sku = :sku, name = :name, price = :price, mrp = :mrp, description= :description, packing = :packing, image = :image, category = :category, stock = :stock, status = :status where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 

		 
		$stmt->bindParam(':id', $params->id);
        $stmt->bindParam(':sku', $params->sku);
        $stmt->bindParam(':name', $params->name);
		$stmt->bindParam(':price', $params->price);
        $stmt->bindParam(':mrp', $params->mrp);
        $stmt->bindParam(':description', $params->description);
        $stmt->bindParam(':packing', $params->packing);
        $stmt->bindParam(':image', $params->image);
        $stmt->bindParam(':category', $params->category);
        $stmt->bindParam(':stock', $params->stock);
       
        $stmt->bindParam(':status', $params->status);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getUsers() {
$sql = "SELECT id, username,email, created_at, updated_at FROM user ORDER BY id DESC ";
    try {
        $db = getDB();
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"users": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function getUserById($id) {
$sql = "SELECT id, username, email, created_at, updated_at FROM user WHERE id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $object = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo '{"user": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function createUser($params) {
    
$sql = "INSERT into user (username, password, email) values (:username, :password, :email)";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':username', $params->username);
        $stmt->bindParam(':password', $params->password);
        $stmt->bindParam(':email', $params->email);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteUser($id) {
    
$sql = "DELETE from user where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateUser($id, $params) {
    
$sql = "UPDATE user set username= :username, email = :email where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':username', $params->username);
        $stmt->bindParam(':email', $params->email);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}








function getCompanyStatuses() {
$sql = "SELECT id, status FROM company_status ORDER BY id DESC";
    try {
        $db = getDB();
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"company_statuses": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function createCompanyStatus($params) {   
$sql = "INSERT into company_status (status) values (:status)";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':status', $params->status);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateCompanyStatus($id, $params) {   
$sql = "UPDATE company_status SET status = :status where id = :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $params->status);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteCompanyStatus($id) {
$sql = "DELETE from company_status where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}




function getCompanyDomains() {
$sql = "SELECT id, domain FROM company_domain ORDER BY id DESC";
    try {
        $db = getDB();
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"company_domains": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function createCompanyDomain($params) {   
$sql = "INSERT into company_status (domain) values (:domain)";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':domain', $params->domain);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateCompanyDomain($id, $params) {   
$sql = "UPDATE company_domain SET domain = :domain where id = :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':domain', $params->domain);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteCompanyDomain($id) {
$sql = "DELETE from company_domain where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function getContacts() {
$sql = "SELECT id, company_id, title, name, phone_number, email, created_at, updated_at, active  FROM company_contact ORDER BY id DESC";
    try {
        $db = getDB();
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"company_contacts": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function createContact($params) {  
$sql = "INSERT into company_contact (company_id, title, name, phone_number, email, created_at, updated_at, active) values (:company_id, :title, :name, :phone_number, :email, :created_at, :updated_at, :active)";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':company_id', $params->company_id);
        $stmt->bindParam(':title', $params->title);
        $stmt->bindParam(':name', $params->name);
        $stmt->bindParam(':phone_number', $params->phone_number);
        $stmt->bindParam(':email', $params->email);
        $stmt->bindParam(':created_at', $params->created_at);
        $stmt->bindParam(':updated_at', $params->updated_at);
        $stmt->bindParam(':active', $params->active);
    
        
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateContact($id, $params) {   
$sql = "UPDATE company_contact SET company_id= :company_id, title= :title, name= :name, phone_number= :phone_number, email= :email, created_at= :created_at, updated_at= :updated_at, active= :active where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':company_id', $params->company_id);
        $stmt->bindParam(':title', $params->title);
        $stmt->bindParam(':name', $params->name);
        $stmt->bindParam(':phone_number', $params->phone_number);
        $stmt->bindParam(':email', $params->email);
        $stmt->bindParam(':created_at', $params->created_at);
        $stmt->bindParam(':updated_at', $params->updated_at);
        $stmt->bindParam(':active', $params->active);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteContact($id) {
$sql = "DELETE from company_contact where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}




function getActivities() {
$sql = "SELECT id, company_contact_id, subject, memo, person_responsible, created_at, updated_at, status, next_contact_date FROM activity ORDER BY id DESC";
    try {
        $db = getDB();
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"activities": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function createActivity($params) {  
$sql = "INSERT into activity (company_contact_id, subject, memo, person_responsible, created_at, updated_at, status, next_contact_date) values (:company_contact_id, :subject, :memo, :person_responsible, :created_at, :updated_at, :status, :next_contact_date)";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':company_contact_id', $params->company_contact_id);
        $stmt->bindParam(':subject', $params->subject);
        $stmt->bindParam(':memo', $params->memo);
        $stmt->bindParam(':person_responsible', $params->person_responsible);
        $stmt->bindParam(':created_at', $params->created_at);
        $stmt->bindParam(':updated_at', $params->updated_at);
        $stmt->bindParam(':status', $params->status);
        $stmt->bindParam(':next_contact_date', $params->next_contact_date);
    
        
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function updateActivity($id, $params) {   
$sql = "UPDATE activity SET company_contact_id= :company_contact_id, subject= :subject, memo= :memo, person_responsible= :person_responsible, created_at= :created_at, updated_at= :updated_at, status= :status, next_contact_date= :next_contact_date where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':company_contact_id', $params->company_contact_id);
        $stmt->bindParam(':subject', $params->subject);
        $stmt->bindParam(':memo', $params->memo);
        $stmt->bindParam(':person_responsible', $params->person_responsible);
        $stmt->bindParam(':created_at', $params->created_at);
        $stmt->bindParam(':updated_at', $params->updated_at);
        $stmt->bindParam(':status', $params->status);
        $stmt->bindParam(':next_contact_date', $params->next_contact_date);
        
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteActivity($id) {
$sql = "DELETE from activity where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}





function getActivityStatuses() {
$sql = "SELECT id, status FROM activity_status ORDER BY id DESC";
    try {
        $db = getDB();
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"activity_statuses": ' . json_encode($object) . '}';
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function createActivityStatus($params) {   
$sql = "INSERT into activity_status (status) values (:status)";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':status', $params->status);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}


function updateActivityStatus($id, $params) {   
$sql = "UPDATE  activity_status SET status= :status where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':status', $$params->status);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
       
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}

function deleteActivityStatus($id) {
$sql = "DELETE from activity_status where id= :id";
    try {
        $db = getDB();
        $stmt = $db->prepare($sql); 
        $stmt->bindParam(':id', $id);
        $result = $stmt->execute();
        
        if($result){
            return true;
        }
        
    } catch(PDOException $e) {
    //error_log($e->getMessage(), 3, 'phperror.log'); //Write error log
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
}
