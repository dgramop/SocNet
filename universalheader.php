<!-- Note that you can type html in a php file, it will render as normal, only difference is that you can have php in here too-->
<!--Remember to NEVER change the ID or CLASS or NAME or any of those type of params in any html, it may cause other code to fail. There are several ways around this. Ask in wiki.-->
<!--This is where most of our Header Stuff will go. Thank you for using this file to destroy clutter on our main page-->
<html>
  <head>
    <!--META tags and Favicon-->
    <!--No more META tags and Favicon-->
    <script src="jsforunivheader.js"></script><!--Keep as much JS in that file as possible - this is to prevent clutter-->
    <style src="stylesforunivheader.css"></style><!--Keep as much CSS in that file as possible - this is to prevent clutter-->
  </head>
  <body>
    <header>
      <?php include 'universalheader.php';?><!--TODO: Alternatively put iframe if it dosnt work.-->
    </header>
    <footer>
    </footer>
  </body>
</html>
