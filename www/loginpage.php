<!-- This html file contains the form to login: username and password
If the username and password are correct, they are redirected to the account page.

If not, an error message appears
-->
<?php 
session_start();
if(isset($_SESSION['user_name'])){
    header('Location: account_page.php');
  }
?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUMdeal - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Rammetto+One|Yanone+Kaffeesatz:700" rel="stylesheet">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- JQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/index.js"></script>
    <script src="js/style.js"></script>
 </head>
    <header class="header">
        <div>
            <a href="index.html"><h1 id='heading1'>YUM</h1><h1 id='heading2'>deal</h1></a>
       </div>
         <ul class="topnav" id ="myTopnav">
            <li class='head'><a href="http://www.twitter.com" target="_blank" id="socialGap" title='Twitter'><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="http://www.facebook.com" target="_blank" id="socialGap" title='Facebook'><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="http://www.instagram.com" id="socialGap" title='Instagram'><i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a>|</a></li>
            <li class='head'>
                <nav>
                  <ul>
                    <li id="login">
                      <a id="login-trigger" href="#">
                        Log in
                      </a>
                      <div id="login-content">
                        <form action="login.php" method="post">
                          <fieldset id="inputs">
                            <input id="user_name" type="text" name="user_name" placeholder="Your username" required>
                            <input id="password" type="password" name="password" placeholder="Password" required>
                          </fieldset>
                          <fieldset id="actions">
                            <input type="submit" id="submit" class='button' value="Submit">
                          </fieldset>
                        </form>
                      </div>                     
                    </li>
                  </ul>
                </nav>
             </li>            
             <li class='head'><a href="about.html" id="colorChange">About Us</a></li>  
        </ul>
    </header>
<body>


    <div class="row">
      <div class="small-8 large-6 columns">
      <br />
      <h3>Login</h3>
      <?php
        if(isset($_SESSION['login_error'])){
          echo "<p>".$_SESSION['login_error'].'</p>';
        }
      ?>      
  		<section id="login"><br />
  		<form action="login.php" method="post">
  		<label for="user_name">User Name: </label><input type="text" name="user_name" id="user_name"/><br /><br />
  		<label for="password">Password: </label><input type="password" name="password" id="password"/><br /><br />
  		<input type="submit" class ="button" value="Submit" />
  		</form>
  		</section>



	
	</div>
</body>
</html>
