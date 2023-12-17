<?php error_reporting(E_ERROR | E_PARSE );  ?>
<?php 
session_start();

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> <?php echo $_GET["streamowner"]; ?>'s Stream </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script>
    $('html, body').animate({
        scrollTop: $("#"+window.location.hash).offset().top
    }, 2000);
});
	</script>
</head>
<body>
<header>
<div class="jumbotron">
<center><h1><?php echo $_GET["streamowner"]; ?>'s Stream</h1></center><br/><center><h5>&lt; <a href="/default.php">Home</a> | <a href="dashboard.php"> Dashboard</a> | <a href="subscribeto.php?subscribeme=<?php echo $_GET["streamowner"]; ?>">Subscribe to <?php echo $_GET["streamowner"]; ?> (<?php echo substr_count(read("users/". $_GET["streamowner"]. "/stream/subscribers.inf"), ","); /* -1 because first sub takes 2 lines */ ?> Subscribers)</a> | <a href="unsubscribe.php?unsubscribeme=<?php echo $_GET["streamowner"]; ?>">Unsubscribe</a> &gt;</h5><br/>Newest at top. Jump to post: <input onfocus="window.location.hash='';" onblur="window.location.hash=this.value;">. To restream, use jump to post, then copy the URL.</center>
</div>
</header><br/>
<div class="container">
<center>
<?php
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
//GET parameter user is for the user that is making the request
// "users/". $_GET["streamowner"]. "/stream/accesslist.inf" -- is the file with list of users that are allowed to access $_GET["streamowner"] 's stream
//Bugged Code:
//$file = fopen("users/". $_GET["streamowner"]. "/stream/accesslist.inf", "r") or die(" <META http-equiv='refresh' content='0;URL=/nostream.php'>");
//if(read("users/". $_GET["streamowner"]. "/stream/accesslist.inf"))
//$n=0;
//while(! feof($file))
//{
//if(fgets($file)==loggedin(). "\n" || fgets($file)=="all\n" || $_GET["streamowner"]==loggedin())
//{
//$file = fopen("users/". $_GET["streamowner"]. "/stream/stream.htm", "r") or die("<META http-equiv='refresh' content='0;URL=/nostream.php'>");
//$streamcontents = fread($file, 1000000); // Reads 1 MB or so of data.
//fclose($file);
$file = fopen("users/". $_GET["streamowner"]. "/stream/accesslist.inf", "r") or die(" <META http-equiv='refresh' content='0;URL=/nostream.php'>");
$accesscontents=fread($file, filesize($file));
$access=explode(", ",$accesscontents);
fclose($file);
if(array_search(loggedin(),$access)!==FALSE || array_search("all",$access)!==FALSE || $_GET["streamowner"]==loggedin() || "dhruv"==loggedin())
{
echo read("users/". $_GET["streamowner"]. "/stream/stream.htm");
}
else
{
echo "You are not permited to see this users stream because it isn't shared with you.";
}
//TODO:
//
//Dashboard where people login and see first post made by all following
//Get emails of users during signup and allow stream view requests.
?>
<br/><hr/>
</center>
</div>
<footer>
	Logged in as <?php echo $_SESSION["user"]; ?>.
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
alert("Not Logged In");
}

	</script>
<hr/>
	All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
</footer>
</body>
</html>