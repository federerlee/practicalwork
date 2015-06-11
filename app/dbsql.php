<?php

//require_once 'dbsql.php';



function getProducts() {
$sql = "SELECT id,sku,name,price,mrp,description,packing,image,category,stock,status FROM products ORDER BY id DESC";
    try {
        $db = getDB();//getDB is a function from config.php?
        $stmt = $db->query($sql); 
        $object = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"products": ' . json_encode($object) . '}';// show the data in the form of json.
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


// reconstruct the orignial one because the  format of data got from insert dialog is not suitable for the existing one,otherwise,it will exist errors like 'SyntaxError: Unexpected token S
 //   at Object.parse (native)' or ' $.parseJSON error - SyntaxError: JSON.parse: unexpected character at line 1 column 18 of the JSON data '
function insertproducts($table, $columnsArray, $requiredColumnsArray) {
        
        //check required colum is missing or not
		/*
		$error = false;
        $errorColumns = "";
        foreach ($requiredColumns as $field) {
        // strlen($inArray->$field);
            if (!isset($inArray->$field) || strlen(trim($inArray->$field)) <= 0) {
                $error = true;
                $errorColumns .= $field . ', ';
            }
        }

        if ($error) {
            $response = array();
            $response["status"] = "error";
            $response["message"] = 'Required field(s) ' . rtrim($errorColumns, ', ') . ' is missing or empty';
            echoResponse(200, $response);
            exit;
        }
    
		
		
		
		echo 'just for testing';
		
		
		*/
		
		
		
		
		
		
		
		
		
		
        try{
		
			
            $a = array();
            $c = "";
            $v = "";
            foreach ($columnsArray as $key => $value) {
                $c .= $key. ", ";
                $v .= ":".$key. ", ";
                $a[":".$key] = $value;
            }
            $c = rtrim($c,', ');
            $v = rtrim($v,', ');
			
			$db = getDB();
            $stmt =  $db->prepare("INSERT INTO $table($c) VALUES($v)");
            $stmt->execute($a);
            $affected_rows = $stmt->rowCount();
            $lastInsertId = $db->lastInsertId();
            $response["status"] = "success";
            $response["message"] = $affected_rows." row inserted into database";
            $response["data"] = $lastInsertId;
        }catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'Insert Failed: ' .$e->getMessage();
            $response["data"] = 0;
        }
        return $response;
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





    /**
     * Fetching single record
     */
    function getOneRecord($sql) {
		//$request = json_decode($app->request->getBody());
		//$a=array();
		 try{
		$db = getDB();
           // $stmt =  $db->prepare($sql);
           // $stmt->execute($a);
		  // $stmt = $db->query($sql); 
		   
		   
		       // $stmt = $db->prepare($sql); 
				// $stmt->bindParam(':email', $params->email);
				  
       // $stmt->bindParam(':id', $id);
        //$result = $stmt->execute();
	
		//$stmt=$db->query($sql.' LIMIT 1');
		//$result=$db->query($sql.' LIMIT 1');
        //$row = $result->fetchColumn(); 
		//$row = $result->fetch_assoc();
		//$row = $result->fetch_row();
		//$result = $db->query($sql);
		//$row=$result->fetch(PDO::FETCH_ASSOC);
	
		//$row = $result->fetch_assoc($result);
	
		
		
            $stmt =  $db->prepare($sql);
			$stmt->execute();
			// $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
			
			 // set the resulting array to associative
			 $result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		//echo '$result ' ;// show the data in the form of json.		
		//print_r($result);
		//	$response['password'] = $result['password'];
		//	$response['name'] = $result['name'];
		
		//return $result;
		return $result;	
		
		}
		catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'Select Failed: ' .$e->getMessage();
            }
	$db= null;
    }
	

	
	
	
	
	
	 function insertIntoTable($obj, $column_names, $table_name) {
        
		
		  try{
		
			

		$c = (array) $obj;
        $keys = array_keys($c);
        $columns = '';
        $values = '';
        foreach($column_names as $desired_key){ // Check the obj received. If blank insert blank into the array.
           if(!in_array($desired_key, $keys)) {
                $$desired_key = '';
            }else{
                $$desired_key = $c[$desired_key];
            }
            $columns = $columns.$desired_key.',';
            $values = $values."'".$$desired_key."',";
        }
			 $sql = "INSERT INTO ".$table_name."(".trim($columns,',').") VALUES(".trim($values,',').")";
			//$sql = "INSERT INTO customers_auth (`uid`, `name`, `email`, `phone`, `password`, `address`, `city`, `created`) VALUES(178, 'AngularCode Administrator', 'admin11@angularcode.com', '000000110000', '1$2a$10$72442f3d7ad44bcf1432cuAAZAURj9dtXhEMBQXMn9C8SpnZjmK1S', 'C/1052, Bangalore', '', '2014-08-31 21:00:26');"

			
			
			
			
			
			
			$db = getDB();
            $stmt =  $db->prepare($sql);
			$stmt->execute($a);
           // $stmt->execute($sql);// IF excute this, error will happen:the server responded with a status of 500 (Internal Server Error)
            $affected_rows = $stmt->rowCount();
            $lastInsertId = $db->lastInsertId();
          
			
			if ($stmt) {
            $new_row_id = $lastInsertId ;
            return $new_row_id;
            } else {
            return NULL;
			
			}
		}catch(PDOException $e){
            $response["status"] = "error";
            $response["message"] = 'Insert Failed: ' .$e->getMessage();
            }
		
	}
      
   
function getSession(){
    if (!isset($_SESSION)) {
        session_start();
    }
    $sess = array();
    if(isset($_SESSION['uid']))
    {
        $sess["uid"] = $_SESSION['uid'];
        $sess["name"] = $_SESSION['name'];
        $sess["email"] = $_SESSION['email'];
    }
    else
    {
        $sess["uid"] = '';
        $sess["name"] = 'Guest';
        $sess["email"] = '';
    }
    
	
	
	
	
	return $sess;
}



   
function destroySession(){
    if (!isset($_SESSION)) {
    session_start();
    }
    if(isSet($_SESSION['uid']))
    {
        unset($_SESSION['uid']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        $info='info';
        if(isSet($_COOKIE[$info]))
        {
            setcookie ($info, '', time() - $cookie_time);
        }
        $msg="Logged Out Successfully...";
    }
    else
    {
        $msg = "Not logged in...";
    }
    return $msg;
}


function getContactFormData($formInformation){

 $formstore = array();

 //echo $_GET["contactUserName"];
  //echo $_GET["contactEmail"];

	if (1) {
		$userid=$_SESSION['uid'];
		$name =$_SESSION['name'];
		$email = $_SESSION['email'];
		$message = $formInformation;
	
		$from = $email; 
		$to = 'li.guoliang@eng.tamk.fi'; 
		$subject = "From: $name\n E-Mail: $email\n Message:\n $message";
		
		$body =$message;
		
// If there are no errors, send the email

	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success"><br>Send successful !Thank You ! I will be in touch! And I have saved it on my local file! But I will save your email file for twice,when sending more than three times and previous email of the last email will not be saved in my file. Meanwhile Feed back email has been resend to you to confirm automatically<br></div>';
		
		echo "<br>Dear". " ".$name. ": ";
		
		//Note: Keep in mind that even if the email was accepted for delivery, it does NOT mean the email is actually sent and received!
		if(mail ($email , 'email has been resend to you to confirm automatically', 'just for confirming that I have received your email,. I will reply it soon', 'li.guoliang@eng.tamk.fi'))
		{
			echo "<br>Reply your email automatically, if you have provided a fake email address,you won't receive it!";
			$formstore["message"] = "Comment received!" ;
			$formstore["status"] = "200" ;
		}
		else{
		echo "<br>Fail to Reply your email automatically";
		$formstore["status"] = "201" ;
		;
		} 
		
		/*
		echo $result;
		
		$myfilename=$name;
		if(file_exists($myfilename))
		{
			$myfilename="1".$name;
			//echo "You can only comment twice at the most!";
		}
		$myfile = fopen($myfilename, "w") or die("Unable to open file!");
	$txt =$name ;
	fwrite($myfile, $txt);
	$txt = "\n";
	fwrite($myfile, $txt);
	$txt = $email;
	fwrite($myfile, $txt);
	$txt = "\n";
	fwrite($myfile, $txt);
	$txt = $message;
	fwrite($myfile, $txt);
	$txt = "\n";
	fwrite($myfile, $txt);
	fclose($myfile);
		
		
		
		
	
	//http_redirect("http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/contact", array("name" => "value"), true, HTTP_REDIRECT_PERM);
	
	
	
	}
	//header("Location: http://home.tamk.fi/~e4lguoli/practicalwork/main.html#");
	//http_redirect("http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/contact");
	
	
	 */
	
    $formstore["contactEmail"] = $email;
    $formstore["contactName"] = $name;
	//$formstore["status"] = 'Comment successful';
	$formstore["status"] = $formInformation;
	
	/*
	if (!headers_sent())
     {  
          //If headers not sent yet... then do php redirect
          header('Location: http://home.tamk.fi/~e4lguoli/practicalwork/main.html# '); exit;
     }
     else
     {     
	echo '	<h2>Prepare to be redirected!</h2>';
	 echo '<br><br>It will be redirect to main page in 8 seconds!';
	 echo '<script type="text/javascript">';
          echo 'function delayer(){window.location.href="http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/";}';
          echo '</script>';
          //echo '<noscript>';
          //echo '<meta http-equiv="refresh" content="0;url='http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/'" />';
          //echo '</noscript>'; 
		  exit;
		  */
	}

return $formstore;

	}	

}	
	

?>
