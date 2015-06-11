<!DOCTYPE html>
<html>
<body onLoad="setTimeout('delayer()', 8000)">
<?php

 echo $_POST["user"];
  echo $_POST["email"];
 
	if ($_POST["user"]) {
		$name = $_POST['user'];
		$email = $_POST['email'];
		$message = $_POST['comment'];
	
		$from = $email; 
		$to = 'li.guoliang@eng.tamk.fi'; 
		$subject = "From: $name\n E-Mail: $email\n Message:\n $message";
		
		$body =$message;
		
// If there are no errors, send the email

	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success"><br>Send successful !Thank You ! I will be in touch! And I have saved it on my local file! But I will save your email file for twice,when sending more than three times and previous email of the last email will not be saved in my file. Meanwhile Feed back email has been resend to you to confirm automatically<br></div>';
		
		echo "<br>Dear". " ".$name. ": ";
		
		
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
		
		
		
		//Note: Keep in mind that even if the email was accepted for delivery, it does NOT mean the email is actually sent and received!
		if(mail ($email , 'email has been resend to you to confirm automatically', 'just for confirming that I have received your email,. I will reply it soon', 'li.guoliang@eng.tamk.fi'))
		{
			echo "<br>Reply your email automatically, if you have provided a fake email address,you won't receive it!";
		}
		else
		echo "<br>Fail to Reply your email automatically";
		;
	} else {
		$result='<div class="alert alert-danger"><br>Sorry,  there was an error sending your message. Please try again later.</div>';
		echo $result;	
	}
	
	//http_redirect("http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/contact", array("name" => "value"), true, HTTP_REDIRECT_PERM);
	
	
	
	}
	//header("Location: http://home.tamk.fi/~e4lguoli/practicalwork/main.html#");
	//http_redirect("http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/contact");
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
	}
?>



</body>
</html>