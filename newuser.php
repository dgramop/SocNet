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
return false;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SocNet - New User</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<header>
<div class="jumbotron">
<center><h1>New User</h1></center><br/><center><h5>&lt;<a href="/default.php">Home</a> | <a href="login.htm"> Login </a>&gt;</h5></center>
</div>
</header><br/>
<div class="container">
<center>

<form name="form" action="createuser.php" method="post" class="form-group">
	Username: <input class="form-control" type="text" name="username" placeholder="Enter your username"><br/>
	Password: <input class="form-control" type="password" name="password" placeholder="Enter your password"><br/>
	Email: <input class="form-control" type="email" name="email" onblur="alert('I wont, and dont spam. I randomly check emails, so YOU dont spam ME. If your email is fake, I delete your account. We \(curruntly\) dont even have the capability to send you every single post your freinds make. And we \(curruntly\) dont plan to get it. We will use your email to help you for a forgoten password, username, username and password, password and username, and passname and userword.')" placeholder="Enter your email"><br/>
	Users that can access your stream:<br/><textarea class="form-control" name="access"> If you enter "all", then all users may access it. Note that is you enter "nobody" the user "nobody" can access your stream.
If you fail to change the information in this textarea, the users who have usernames that match words in this textarea can read your stream. The list IS comma seperated.</textarea>
	<br/>
	<input value="Create Account" class="btn btn-success" type="submit"/>
<br/><hr/>
	</center>
</div>
<footer>
<hr/>
	All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
</footer>
</body>
</html>