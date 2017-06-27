<!--account_page.php
This file contains the account page for the owners of the restaurant. It is composed of 
- a section with the information of the owner and the restaurant
- a log out button
- a section with the current deals 
- a button to add new deal.
-->
<?php
    include ('connectDBclaire.php');
    session_start();
    if(!isset($_SESSION['user_name'])){
    header('Location: loginpage.php');
  }
?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUMdeal - Registration</title>
     
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- JQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     
    <script src="js/index.js"></script>
    <script src="js/style.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Rammetto+One|Yanone+Kaffeesatz:700" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">
    
    <link rel="stylesheet" href="css/google.css">
    <link rel="stylesheet" href="css/loginmenu.css">
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
                <?php if(isset($_SESSION['user_name'])): ?>
                    <a href="logout.php" id="colorChange">logout</a>
             <?php else: ?>
                
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
                <?php endif; ?>
                
             </li>            
             <li class='head'><a href="about.html" id="colorChange">About Us</a></li>  
        </ul>
    </header>
<body>

    <h3>Manager Information</h3>
    <div class="row">
    <div class="small-10 large-10 columns">

    <section id="user_information">
        
            <?php
            if (isset($_SESSION['user_name'])){
                echo '<p class="welcome">Welcome '.$_SESSION['user_name']." !</p>";
                $session_user_name=$_SESSION['user_name'];
                $db = connect();
                $query = "SELECT business_name, business_type, user_name, filesize, filepath, business_address FROM Owner WHERE user_name='$session_user_name'";
                if ($result=mysqli_query($db,$query)) {
                    while ($row = mysqli_fetch_assoc($result)){
                        echo "<div class='sectionBorder'><p>Your ".$row["business_type"].":<br />".$row["business_name"]."<br />".$row["business_address"]."</p>";
                        if ($row["filesize"] != 0){
                        $path = 'images/'.$row["filepath"];
                        echo '<a href="'.$path.'"data-lightbox="'.$path.'"><img src="'.$path.'" width="200"/><br /></a><br /></div>';
                        }
                    }
                }
            }

            ?>

          

    </section>
        </div>
    </div>
    <h3>Current deals for your business</h3>
    <div class="row">
    <div class="small-8 large-8 columns">
    <section id="deals">
        
            <!--display the deals with end_date superior to today
            -->
            <div class="content_wrapper">
            <?php
            if (isset($_SESSION['user_name'])){
                $session_user_name=$_SESSION['user_name'];
                $db = connect();
                $today = date("Y-m-d");
                $query = "SELECT deal_id, description, user_id, start_date, end_date FROM deal NATURAL JOIN Owner WHERE deal.user_id=Owner.user_id AND user_name='$session_user_name' AND end_date > $today";
                if ($result=mysqli_query($db,$query)) {
                    if (mysqli_num_rows($result) > 0){
                    echo "<table id='responds'><tr><th>Deal description</th><th>Starts on</th><th>Ends on</th><th>Delete deal</th>";
                    while ($row = mysqli_fetch_assoc($result)){
                        echo '<tr id="item_'.$row["deal_id"].'">';
                        echo '<td>'.$row["description"].'</td>';
                        echo '<td>'.$row["start_date"]. '</td> <td>'.$row["end_date"]."</td>";
                         echo '<td><div class="del_wrapper"><a href="#" class="del_button" id="del-'.$row["deal_id"].'">';
                        echo '<img src="images/icon_del.gif" border="0" />';
                        echo '</a></div></td></tr>';

                    }
                    
                    }   
                }
            }
                    
            ?>
                    

                    
                    

            <?php

            mysqli_free_result($result);

            mysqli_close($db);


            ?>
            </table>
            </div>
            <br><br>
            <a href="add_deal_page.html" class="button">Add a new deal</a>
            

    </section>
    </div>
    </div>

    <script src="lightbox2-master/src/js/lightbox.js"></script>
    <script>
            lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
            })
    </script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    


</body>
</html>
