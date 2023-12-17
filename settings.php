<?php error_reporting(E_ERROR | E_PARSE );  ?>
<?php session_start();?>
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
return FALSE;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php if($_SESSION["user"]==""){echo "<script>window.location='login.htm';</script>";} ?>
<title> SocNet - Settings </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
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
</head>
<body>
<header>
<div class="jumbotron">
<center><h1>SocNet Settings</h1></center><br/><center><h5> &lt; <a href="/default.php">Home</a> | <a href="/login.htm">Login</a> | <a href="/logout.php">Logout</a> | <a href="/dashboard.php">Dashboard</a> &gt;</h5></center>
</div>
</header><br/>
<div class="container">
<form class="form-group" method="post" action="settingsapply.php">
	<b>Stream Sharing:</b><br/><textarea name="share" placeholder="The stream will be shared with these people. Comma seperated."> <?php echo read("users/". loggedin(). "/stream/accesslist.inf") ?> </textarea><br/>
	<b>New Password: (To keep password the same, don't edit)</b><br/><input name="password" value="<?php echo read("users/". loggedin(). "/password.inf") ?>" placeholder="Your New Password"> <br/>
	<b>Subscriptions:</b><br/><textarea name="subscriptions" placeholder="You are subscribed to these people. This list is comma seperated"> <?php echo read("users/". loggedin(). "/subscriptions.inf") ?> </textarea><br/>
<input type="submit" class="btn btn-success" value="Save">
	<script>
         var hash = window.location.hash;
		 hash=hash.replace("#", "");
		 hash=hash.replace("s", "S");
		 hash=hash.replace("a", "A");
		 hash=hash.replace("-", " ");
		 hash="<code>" + hash + "</code>";
		 document.writeln(hash);
	</script>
	</form>
<br/><hr/>
</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<footer style="width:100%; height:500px;">
<hr/><center>
All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
	</center>
</footer>
</body>
</html>