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
$u=explode(", ",read("users/". loggedin(). "/subscriptions.inf"));
$m=explode(", ",read("users/". $_GET["subscribeme"]. "/stream/subscribers.inf"));
if(in_array($_GET["subscribeme"], $u)===FALSE)
{
file_add_contents("users/". loggedin(). "/subscriptions.inf", $_GET["subscribeme"]. ", ");
}
if(in_array(loggedin(), $m)===FALSE)
{
file_add_contents("users/". $_GET["subscribeme"]. "/stream/subscribers.inf", loggedin(). ", ");
}
echo '<meta http-equiv="refresh" content="0; URL=/settings.php#subscription-added">';
//$array=explode(", ",$str)
//if(in_array(loggedin(),$array)==FALSE);
//file_add_contents($file, $contents. ", ")
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
</script>
