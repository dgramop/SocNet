<?php error_reporting(E_ERROR | E_PARSE );  ?>
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
$array=explode(", ",read("users/". loggedin(). "/subscriptions.inf"));
$replacer=read("users/". loggedin(). "/subscriptions.inf");
$replacer=str_replace(", ". $_GET["unsucscribeme"], "", $replacer);
file_put_contents("users/". loggedin(). "/subscriptions.inf", $replacer);
$replacer=read("users/". $_GET["subscribeme"]. "/stream/subscribers.inf");
$replacer=str_replace(", ". loggedin(), "", $replacer);
file_put_contents("users/". $_GET["unsubscribeme"]. "/stream/subscribers.inf", $replacer);
echo '<meta http-equiv="refresh" content="0; URL=/settings.php#subscription-anulled">';
?>