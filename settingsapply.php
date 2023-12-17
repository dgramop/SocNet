<?php
//file_put_contents
if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
}

function file_add_contents($file, $contents)
	{
	$old=read($file);
	$new=$old. $contents;
	file_put_contents($file, $new);
}

function read($filename)
{
$file=fopen($filename, "r");
return fread($file, filesize($filename));
fclose($file);
}

function loggedin()
{
$passwordcontent=read("users/". $_SESSION["user"]. "/password.inf");
$password=$_SESSION["password"];
$user=$_SESSION["user"];
if($passwordcontent==$password)
{
return $user;
}
else
{
return false;
}
}
?>
<?php
session_start();
file_put_contents("users/". loggedin(). "/stream/accesslist.inf", $_POST["share"]);
file_put_contents("users/". loggedin(). "/password.inf",$_POST["password"]);
file_put_contents("users/". loggedin(). "/stream/subscriptions.inf", $_POST["subscriptions"]);
echo '<meta http-equiv="refresh" content="0; URL=/settings.php#settings-applied">';
?>
<script>
		function getCookie(cname) {
   		 var name = cname + "=";
  		 var ca = document.cookie.split(';');
   		 for(var i=0; i<ca.length; i++) {
         var c = ca[i];
      	 while (c.charAt(0)==' ') c = c.substring(1);
        	if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    		}
   		 return "";
	}

		
if(getCookie("PHPSESSID") == "")
{
window.location="login.htm";
}
</script><?php session_start(); if($_SESSION["user"]==""){echo "<script>window.location='login.htm';</script>";} ?><br/>All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!