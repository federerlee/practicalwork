<!DOCTYPE html>
<html>
<body onLoad="setTimeout('delayer()', 2000)">


<?php
//header( "refresh:5;url=http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/" );
 /**/
 echo '<script type="text/javascript">';
          echo 'function delayer(){window.location.href="http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/";}';
          echo '</script>';
          //echo '<noscript>';
          //echo '<meta http-equiv="refresh" content="0;url='http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/'" />';
          //echo '</noscript>'; 
		  exit;





//echo “location.href=’http://home.tamk.fi/~e4lguoli/practicalwork/main.html';”;
//echo "location.href = 'http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/';";
	//header("Location: http://home.tamk.fi/~e4lguoli/practicalwork/main.html");
	//http_redirect("http://home.tamk.fi/~e4lguoli/practicalwork/main.html#/contact");
	//http_redirect("http://home.tamk.fi/~e4lguoli/practicalwork/main.html#", array("name" => "value"), true, HTTP_REDIRECT_PERM);
	//exit;
?>
</body>
</html>