<?php error_reporting(E_ERROR | E_PARSE );  ?>
<?php session_start(); ?>
<?php //file_put_contents
if (!function_exists('file_put_contents')) {
	function file_put_contents($filename, $data)
	{
		$f = @fopen($filename, 'w');
		if (!$f) {
			return false;
		}
		else {
			$bytes = fwrite($f, $data);
			fclose($f);
			return $bytes;
		}
	}
}

function file_add_contents($file, $contents)
{
	$old = read($file);
	$new = $old . $contents;
	file_put_contents($file, $new);
}

function read($filename)
{
	$file = fopen($filename, "r");
	return fread($file, filesize($filename));
	fclose($file);
}

function loggedin()
{
	$passwordcontent = read("users/" . $_SESSION["user"] . "/password.inf");
	$password = $_SESSION["password"];
	$user = $_SESSION["user"];
	if ($passwordcontent == $password) {
		return $user;
	}
	else {
		return false;
	}
}
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
			<?php if($_SESSION["user"]==""){echo "<script>window.location='login.htm';</script>";} ?>
            <title>Stream Editor</title>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css ">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
                    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
                        <script>
                            function getCookie(cname) {
                                var name = cname + "=";
                                var ca = document.cookie.split(';');
                                for (var i = 0; i < ca.length; i++) {
                                    var c = ca[i];
                                    while (c.charAt(0) == ' ') c = c.substring(1);
                                    if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
                                }
                                return "";
                            }


                            if (getCookie("PHPSESSID") == "") {
                                window.location = "login.htm";
                            }

                            function showresult(stuff, e) {
                                document.getElementById("stuff").innerHTML = stuff;
                                var code = (e.keyCode ? e.keyCode : e.which);
                                //if (code == 13) {
                                //    document.form.posttext.value += "<br/>";
                                //}
								//Taken Care of backend
                            }
                        </script>
                        </head>

                        <body>
                            <header>
                                <div class="jumbotron">
                                    <center>
                                        <h1> New Post </h1></center > <br/> <center> <h5> <a href="/default.php">Home</a> | <a href="dashboard.php">Dashboard</a></h5></center>
</div>
</header><br/>
<div class="container">
<center>
<form action="streameditor.php" method="post">
  <div class="form-group">
    <label for="postname">Post Name</label>
    <input type="text" class="form-control" name="postname" id="postname" placeholder="The name of your post.">
  </div>
  <div class="form-group">
    <label for="posttext">Post Text <a href="htmlguide.htm">More Info on HTML</a></label>  
    <textarea class="form-control" name="posttext" id="posttext" placeholder="Text in Post">Supports HTML</textarea>
  </div>
  <input type="submit" value="Submit" class="btn btn-default">
</form>

	</div>
	<br/>NOTE: To make <strike>our</strike><i> your</i> life easier, when you hit enter, we insert a next line tag that allows your post to be interpreted by the browser. (HTML)
<br/><hr/>
	</center>
</div>
<footer>
<hr/>
	All rights reserved by Dhruv Gramopadhye<br/>Servers have feelings t00!
</footer>
</body>
</html>
