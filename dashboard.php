<?php error_reporting(E_ERROR | E_PARSE );?>
<?php session_start();?>
<?php
function countfilelines($file)
	{
$linecount = 0;
$handle = fopen($file, "r");
while(!feof($handle)){
  $line = fgets($handle);
  $linecount++;
}
fclose($handle);
return $linecount;
}


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
if($password == "" || $user== "")
{
	$password=$_COOKIE["password"];
	$user=$_COOKIE["user"];
}
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
<title><?php echo loggedin(); ?>'s Dashboard</title>
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
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script>
function go() {
	var totaliframes=document.getElementsByName("iframe").length;
	var n=0;
		while(n<totaliframes)
			{
	var Iframe = document.getElementsByName('iframe')[n];
    Iframe.contentWindow.scrollTo(10,250);
	n++;
}
}

function showresult(stuff, e) {
document.getElementById("stuff").innerHTML = stuff;
var code = (e.keyCode ? e.keyCode : e.which);
//if (code == 13) {
//document.form.posttext.value += "<br/>";
//}
	// taken care of backend
}
	</script>
</head>
<body onmousemove="go()">
<header>
<div class="jumbotron">
<center><h1>Dashboard</h1></center><br/><center><h5>&lt;<a href="/default.php">Home</a> | <a href="logout.php">Logout</a> | <a href="streamedit.php">Edit Stream</a> | <a href="settings.php">Settings</a> | <a href="streamviewdirect.php">View Stream</a> &gt;</h5></center>
</div>
</header><br/>
<div class="container">
<center>
<div class="row">
	<div class="col-xs-6 col-md-4"><b>Currunt Subscriptions:</b><br/>
	<?php echo read("users/". loggedin(). "/subscriptions.inf");?></div>
<!--	<div class="col-xs-6 col-md-4"><b>Posts from people you follow</b> (MiNiBrOwSeR Stream View) <br/>
	<?php 
// Buggy Code
	/*$stuff= explode(", ", read("users/". loggedin(). "/subscriptions.inf"));
	$n=0;
	//echo var_dump($stuff);
	//echo $stuff[0];
	while(array_count_values($stuff)>$n)
  		{
  		echo "<iframe style='border:none;' name='iframe' width='275' height='150' src='streamview.php?streamowner=". $stuff[n]. "'></iframe><br/><br/>";
		$n++;
  		}
	  */
	  ?>
	</div>-->
	<div class="col-xs-6 col-md-4"><b>Quick Post</b><br/>
	<form name="form" action="streameditor.php" method="post" class="form-group">
	Title:<br/> <input class="form-control" type="text" name="postname" placeholder="Title"><br/>
	<abbr onclick="window.location='htmlguide.htm';" title="Supports HTML. Click to see HTML guide."><br/>Body:<br/></abbr>
	<textarea onkeydown="showresult(value, event)" onkmousemove="showresult(value, event)" onload="showresult(value, event)" placeholder="Text" style="width:75%; height:250px;" name="posttext" class="form-control"></textarea><br/>
	<input class="btn btn-success" type="submit" value="Stream Post"/>
	</form>
		<br/><br/>Rendered:<br/><div id="stuff"></div>
	</div>	
</div>

<br/><hr/>
</center>
</div>
<footer>
	Logged in as <?php echo $_SESSION["user"]; ?>. <?php if($_SESSION["user"]==""){echo "<script>window.location='login.htm';</script>";} ?>
All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
	<hr/>
</footer>
</body>
</html>