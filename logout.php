<?php error_reporting(E_ERROR | E_PARSE );  ?>
<?php
// Four way session destruction just in case
setcookie('PHPSESSID', null, -1, '/');
session_destroy();
unset($_COOKIE['PHPSESSID']);
session_unset();
echo '<meta http-equiv="refresh" content="0; URL=/login.htm">';
?>Loading... <br/>All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
