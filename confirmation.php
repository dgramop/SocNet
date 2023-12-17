<?php error_reporting(E_ERROR | E_PARSE );  ?>
<?php error_reporting(E_ERROR | E_PARSE );  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title> SocNet - Verification </title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</head>
<body>
<header>
<div class="jumbotron">
<center><h1>SocNet - Verification</h1></center><br/><center><h5> &lt; <a href="/default.php">Home</a> | <a href="/login.htm">Login</a> | <a href="/logout.php">Logout</a> | <a href="/newuser.php">Create Account</a> | <a href="/dashboard.php">Dashboard</a> | <a href="streamviewdirect.php">View Stream</a> &gt;</h5></center>
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
session_start();
if($_POST["verificationcode"]===$_SESSION["confirmation"])
{
	file_add_contents_to_top("users/". $_SESSION["user"]. "/login.inf", "Account Created\n");
	echo "Correct Verification!"
}
else
{
	session_start();
	echo "Incorrect verification";
	echo $_POST["verificationcode"]. "<br/>";
	echo $_SESSION["confirmation"];
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
