<!doctype html>
<html class="no-js" lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YUMdeal - Deals straight to you</title>
      
    <link href="https://fonts.googleapis.com/css?family=Rammetto+One|Yanone+Kaffeesatz:700" rel="stylesheet">
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/loginmenu.css">


    <script src="js/index.js"></script>
  
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- JQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      
    <!-- Font Awesome Icons --> 
    <script src="https://use.fontawesome.com/5512aa1683.js"></script>
    
      
    <!-- google APIs -->  
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRRY9GzkL0XCgOBE09OoXDLAoog1MDAa8&libraries=places&callback=initAutocomplete"
        async defer></script>
    
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
      <div class="small-7 large-7 small-centered columns search">
        <h2 id='deals'>FIND THE BEST DEALS!</h2>
      </div>
      <div class="row">
      <div class="small-12 large-8 small-centered columns search">
        <form method="get" action="map.php" id='search' >
            <span><input class='mainsearch' id="business_address" type="text" name="address" placeholder="WHERE ARE YOU?"/>
            <button type="submit" class = "button mainsearching" >SEARCH</button></span>
<!--            <button type = "submit" class = "button" formaction="list.html">List View</button>-->
            <div class="columns"><p id="searchHideShow">Show advanced search</p></div>
            
            <section class="sectionBorder" id="advancedSearch">
            <div>
            <label class='advanced' for="radius">Radius:
            <select id="radius" name="radius" form="search">
                <option value="5" selected>5 km</option>
                <option value="25">25 km</option>
                <option value="50">50 km</option>
            </select>
            </label>
            </div>
            <div>
            <label class='advanced' for="restaurant-type">Establishment type:
            <input type="checkbox" checked value=checked name='bar'> Bar
            <input type="checkbox" checked value=checked name='restaurant'> Restaurant
            <input type="checkbox" checked value=checked name='cafe'> Cafe
            </label>
            </div>
            <div>
            <label class='advanced' for="date">Date<input type="date" name="date" id="date"/></label>
            </div>
            </section>
        </form>
        </div>

            
      </div>
    </div>

    <br /><br />
    <table class = "ads-table small-10 small-centered columns">
      <tbody id = "ads">
        
      </tbody>
    </table>

    <br /><br />

    <div class="row">
      <div class="small-10 small-centered large-centered columns register">
      <h3>You own a restaurant ? Register here and start adding your deals !</h3>
      </div>
    </div>
    <div class="row">
      <div class="small-3 small-centered large-centered columns register-button">
      <a href="registration.html"  class="button expand large">Register</a>
      </div>
    </div>
    <script src="js/main.js"></script>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
    <footer>
        <p id="footer"><i class="fa fa-copyright"></i>YUMdeals 2017</p>
    </footer>
</html>
