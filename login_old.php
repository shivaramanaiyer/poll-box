<?php

require 'src/facebook.php';

$facebook = new Facebook(array(
  'appId'  => '176273535785674',
  'secret' => '2b2d67285efad199c051ddbd6db153cf',
));

// See if there is a user from a cookie
$user = $facebook->getUser();

if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
    $user = null;
  }
  
 if (!$user) {
    $loginUrl = $facebook->getLoginUrl();
}
}

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>

<meta charset="utf-8">
    <title>Poll Box Demo1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="bootstrap-responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="themes\default\default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="themes\pascal\pascal.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="orman\orman.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
	
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId: '176273535785674',
          cookie: true,
          xfbml: true,
          oauth: true
        });
        FB.Event.subscribe('auth.login', function(response) {
          window.location = "http://localhost/poll-box/voteweb/activity_page.php";
        });
		FB.Event.subscribe("auth.logout", function() {window.location = 'http://localhost/poll-box/voteweb/login.php'});
		{$callback}
};
        });
      };
      (function() {
        var e = document.createElement('script'); e.async = true;
        e.src = document.location.protocol +
          '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=176273535785674";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
	    <div class="container">
          <a class="brand" href="#"><img src="1.jpg"><img src="logo1.png"></a>
          <div class="nav-collapse">
            <ul class="nav">
		      <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About Us</a></li>
              <li><a href="#contact">Contact Us</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
	  </div>
    <div class="navbar1">


	 <p><b> Just Sign in</b></p>
	<?php if ($user) { 
		Header("Location: ./activity_page.php");
	}
	else 
	{ ?>
      <fb:login-button></fb:login-button>
	  
    <?php }/*?>
	OR
	 </br>
	 
	 <form action="checklogin.php" method="post" name="form" id="form">
 Username:<input type="text" name="username" value = '<?php //echo $username; ?>' /></br>
</br>
 Password:<input type="password" name="password" value = '<?php //echo $password; ?>' />
</br>
<input name="submit" type="submit" value="Login" />
 <p class="submit"><a href="user_add.php">Create a new account </a></p>
 <p class="submit"><a href="email_password.php">Forgot Password </a></p>
          <p class="submit"><a href="agent_add_form.php"></a></p>
         
      </form>
	  <?php */ ?>
</div>

<div id="slider-wrapper">
        <div class="slider-wrapper theme-default"></div>
            
            <div id="slider" class="nivoSlider">
                <img src="1a.jpg" alt="" />
                <img src="1b.bmp" alt="" />
				<img src="1c.png" alt="" />
				<img src="1d.jpg" alt="" />
            </div>
            
        </div>
	   	
    <script type="text/javascript" src="scripts\jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

	  <div class="hero-unit">
        <p><i>Its an era of engagement, where we try to be best in our presentation, be it clothing or our way of coding, even selection of ideas, basically </p><p>decision-making. But not all can be accomplished by self and chances are quite high that we are not with our friends and family whose opinions</p><p> really value us. Feel the need of friends help urgently? Our app is the answer. The strategy is to pay off an attempt to friends. Here you can find</p><p> out a quick solution to what you really think is a problem on large range of subjects. All you have to do is login through Facebook, create a poll, </p><p>select your friends and leave the rest to the site. It will notify your friends about the poll and they will be there for your rescue.</i></p>
        <!--<a href="">More..</a></p>-->
      
      <!-- Main hero unit for a primary marketing message or call to action -->
      <!-- Example row of columns -->
      <div class="row">
        <div class="span3">
		   <!--<a href="C:/Documents%20and%20Settings/compaq/Desktop/SEn%20PROJECT/website2/attempt.html"><img src="s1.png"></img></a>-->
          <p><img src="bfb.png"><b><i>Login to the website Poll-Box</i></b></p><p>Enter your facebook id and password. And say goodbye to any type of confusion!!</p>
          
        </div>
        <div class="span3">
          <!--<img src="s2.png"></img>-->
           <p><img src="bcp.jpg"><b><i>Create your own poll</i></b></p><p>Fill in the details about your Poll, upload the texts, images or vedios and publish it with your friends!</p>
          
       </div>
        <div class="span3">
          <!--<img src="s3.png"></img>-->
          <p><img src="btck.jpg"><b><i>Share your poll with your friends</i></b></p><p>Select the friends from your friend list from whom you want to take an opinion!</p>
          
        </div>
		<div class="span3">
          <!--<img src="s4.png"></img>-->
           <p><img src="bvr.png"><b><i>View the results of the poll.</i></b></p><p>Get the clear picture of the results that have been posted by your friends!</p>
          
       </div>
	  </div>
		</div>
      

      <div class="footer">
	  <div class="footer-inner">
	  Our aim is to help people everywhere to make a decision in their state of confusion. Help them connect with their friends and family and be more sure of what they want!
	  <h2>@2012 PollBox.com<h1>
	  </div>
	  <table><tr><th>
        <a href="aboutus.html">About us</a></th><th>Contact Us</th><th> FAQs</th></tr></table>
	</div>

     <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>





	  
 </body>
 
</html>
