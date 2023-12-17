<?php error_reporting(E_ERROR | E_PARSE );  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> SocNet Account Creation </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<header>
<div class="jumbotron">
<center><h1>SocNet New User</h1></center><br/><center><h5> &lt; <a href="/default.php">Home</a> | <a href="/login.htm">Login</a> | <a href="/logout.php">Logout</a> | <a href="/newuser.php">Create Account</a> | <a href="/dashboard.php">Dashboard</a> &gt;</h5></center>
</div>
</header><br/>
<div class="container">
<center>
<?php
function read($filename)
{
	$file = fopen($filename, "r");
	return fread($file, filesize($filename));
	fclose($file);
}


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

function file_put_contentsd($filename, $contents)
	{
	$file=fopen($filename, "w");
	fwrite($file, $contents);
	fclose($file);
}

function file_add_contents_to_top($file, $contents)
	{
	$old=read($file);
	$new=$contents. $old;
	file_put_contents($file, $new);
}

function dmail($from, $to, $subject, $message)
	{
$headers = 'From: '. $from . "\r\n" .
    'Reply-To: dgramopadhye@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

return mail($to, $subject, $message, $headers);
}
?>
<?php

if(!file_exists("users/". $_POST["username"]) && !strpos(read("users/emails.inf"), $_POST["email"])) // The user dosn't exist
{
session_start();
$_SESSION["confirmation"]=crypt(rand(-9999999999999999999999999999, 999999999999999999999999999999999999999));
// Generate file structure
mkdir("users/". $_POST["username"], 0777);
file_put_contentsd("users/". $_POST["username"]. "/password.inf", $_POST["password"]);
file_put_contentsd("users/". $_POST["username"]. "/subscriptions.inf", "dhruv");
mkdir("users/". $_POST["username"]. "/stream", 0777);
file_put_contentsd("users/". $_POST["username"]. "/stream/accesslist.inf", $_POST["access"]. "\n". $_POST["username"]);
file_put_contentsd("users/". $_POST["username"]. "/login.inf", "");
file_put_contentsd("users/". $_POST["username"]. "/stream/stream.htm", "");
file_put_contentsd("users/". $_POST["username"]. "/stream/subscribers.inf", $_POST["username"]);
file_add_contents_to_top("users/emails.inf", $_POST["email"]. "  ". $_POST["username"]. "\n");
dmail("accounts@socnet.16mb.com", $_POST["email"], "Welcome to SocNet", "Welcome to SocNet. Your username is ". $_POST["username"]. ", and your password is ". $_POST["password"]. ". Your account was half way setup. To finish setup, go to http://socnet.16mb.com/confirmation.htm . You verification code is ". $_SESSION["confirmation"]);
// Log in
session_start();
$_SESSION["user"] = $_POST["username"];
$_SESSION["password"] = $_POST["password"];
echo "Your account was partially setup. Login to ". $_POST["email"]. " to continue";
}
else
{
	echo "The username is taken, or you have already created an account with your email.";
}
?>
<br/><hr/>
</center>
</div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
<footer style="width:100%; height:500px;">
<hr/><center>
All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
	</center>
</footer>
</body>
</html>