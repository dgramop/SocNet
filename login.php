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
if($passwordcontent == $password)
{
return $user;
}
else
{
return "false";
}
}

function file_add_contents_to_top($file, $contents)
	{
	$old=read($file);
	$new=$contents. $old;
	file_put_contents($file, $new);
}
?>
<?php
session_unset();
session_start();
$_SESSION["user"] = $_POST["user"];
$_SESSION["password"] = $_POST["password"];
$present=loggedin();
if($present == "false" && read("users/". $_SESSION["user"]. "/login.inf")!=="")
{
echo "Not logged in, either your password was incorrect, or your account dosn't exist";
setcookie('PHPSESSID', null, -1, '/');
session_destroy();
unset($_COOKIE['PHPSESSID']);
session_unset();
echo '<meta http-equiv="refresh" content="0; URL=/login.htm#password-incorrect-Or-Your-Account-Dosnt-Exist">';
}
else
{
echo "Logged in as: ". $present;
echo '<meta http-equiv="refresh" content="0; URL=/dashboard.php">';
file_add_contents_to_top("users/". $_SESSION["user"]. "/login.inf", time(). "\n");
}
?><br/>All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!