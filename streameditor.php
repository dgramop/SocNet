<?php error_reporting(E_ERROR | E_PARSE ); ?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> Stream Editor </title>
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

function showresult(stuff, e)
	{
		document.getElementById("stuff").innerHTML=stuff;
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) { //Enter keycode
		document.form.posttext.value += "<br/>";
		}
	}
	</script>
</head>
<body>
<header>
<div class="jumbotron">
<center><h1>New Post</h1></center><br/><center><h5><a href="/default.php"> Home </a> | <a href="dashboard.php"> Dashboard </a></h5></center>
</div>
</header><br/>
<div class="container">
<center>
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

function file_add_contents_to_top($file, $contents)
	{
	$old=read($file);
	$new=$contents. $old;
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
//ADD: SECURITY
//or editing, use:file_put_contents()

if(loggedin() == $_SESSION["user"])
{
$abc=strlen($_POST["postname"]);
$cba=strlen($_POST["posttext"]);
 if($abc > 50 || $cba > 10000)
 {
 echo "Your total space that all your posts can add up to is 1MB. After that, to limit lag, we stop pulling old posts. But this isn't a matter of big fat files. Your post is soooo long, our servers WILL crash. How would you feel if I were to <a href='http://www.instructables.com/id/How-to-crash-your-computer/'>crash your computer</a>! Servers have feelings too!";
 }
 else
 {
 echo "Post Added";
 $formattedstring = $_POST["posttext"];
 $formattedstring=str_replace("\n","<br/>",$formattedstring);
 $formattedstring=str_replace("<script","JAVASCRIPT BLOCKED",$formattedstring);
 $formattedstring=str_replace("javascript:","JAVASCRIPT BLOCKED",$formattedstring);
 $formattedstring=str_replace("=''","JAVASCRIPT BLOCKED",$formattedstring);
 $formattedstring=str_replace('="',"JAVASCRIPT BLOCKED",$formattedstring);
 $genhtm="<div class='row' id='". $_POST["postname"]. "'><center><h4>". $_POST["postname"]. "</h4></center><hr/><p>". $formattedstring. "</p></div>"; //style='border-style: solid; border-color: grey; border-width: 1px;'
 file_add_contents_to_top("users/". $_SESSION["user"]. "/stream/stream.htm", $genhtm);
 }
 }
else
{
echo "Not logged in";
}
?>
<br/>
Logged in as <?php echo $_SESSION["user"]; ?>. <?php if($_SESSION["user"]==""){echo "<script>window.location='login.htm';</script>";} ?>

<br/><hr/>
	</center>
</div>
<footer>
<hr/>
	All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
</footer>
</body>
</html>


