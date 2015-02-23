<!-- Note that you can type html in a php file, it will render as normal, only difference is that you can have php in here too-->
<!--Remember to NEVER change the ID or CLASS or NAME or any of those type of params in any html, it may cause other code to fail. There are several ways around this. Ask in wiki.-->
<html>
  <head>
    <!--META tags and Favicon-->
    <!--No more META tags and Favicon-->
    <script src="jsforindex.js"></script><!--Keep as much JS in that file as possible - this is to prevent clutter-->
    <style src="stylesforindex.css"></style><!--Keep as much CSS in that file as possible - this is to prevent clutter-->
  </head>
  <body>
    <header>
      <?php include 'universalheader.php';?><!--TODO: Alternatively put iframe if it dosnt work.-->
    </header>
    <div id="middle">
      <?php include 'recentPosts.php' ?>
    </div>
    <footer>
    <b>Developed By Dhruv Gramopadhye and many other hyper diaper wipers. To see other contributers, go to <a href="http://git.io/N4wM">http://git.io/N4wM</a>. This is an open source project. All Rights Reserved By Dhruv Gramopadhye</b>    </footer> 
  </body>
</html>
