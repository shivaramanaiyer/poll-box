<?php 
//Set permission level threshold for this page remove if page is good for all levels
include"facebook_auth.php";
?>	

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<title>Poll Box Home</title>
<style type="text/css">
      body {
	    background-color: #dedede;
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
	<style type="text/css">
.result9047400 {
	text-align: left;
  border:0;
  }
</style>
	<link href="activitypage.css" rel="stylesheet">
	<link href="bootstrap-responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen">	

</head>

<body>
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
	    <div class="container">
          <a class="brand" href="#"><img src="logo1.png"></a>
          <div class="nav-collapse">
            <ul class="nav">
		      <li class="active"><a href="#">Home</a></li>
              <li><a href="aboutus.html">About Us</a></li>
              <li><a href="contactus.html">Contact Us</a></li>
              <li><a href="<?php echo $logoutUrl; ?>">Log out </a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
</div>
<div id="wrapper1">
<div class="hero-unit2">
<!--<div class="hero-unit">-->
	<div><img src="https://graph.facebook.com/<?php echo $user; ?>/picture"><b><?PHP	echo "&nbsp;&nbsp;&nbsp; Welcome ".$user_profile['name'];?></b>
	<a href="./create_poll/form.php" target="blank"><img src="cooltext674610090.png" onmouseover="this.src='cooltext674610090MouseOver.png';" onmouseout="this.src='cooltext674610090.png';"/></a>
	<a href="./my_poll.php" target="blank"><img class="result9047400"	width="105" height="35"
	onmouseover = "this.src = 'mph.png'"
	onmouseout =  "this.src = 'mp.png'"
	src="mp.png"></a></div>
	<div class="bar"></div>
	<?php
  //always
  $ch = curl_init();
  $timeout = 5;
  //curl_setopt($ch,CURLOPT_URL,'http://10.100.70.53:3000/api/poll/get_recent_polls_by_date/10');
  
  curl_setopt($ch,CURLOPT_URL,'http://10.100.97.179:3000/api/poll/get_recent_polls_by_date/10');
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  //always ended.. 

 /*print "without decoding whole data---- ";
 print $data;
 print "<br/>"; 
 print "<br/>"; 
 */
 $val = json_decode($data); //always

 foreach ($val as $x)
 { ?><div  style="left:250px; width:900px; height:210px; border-style:solid; border-bottom-width:2px;"><a href="./polldetails.php?poll=<?php
	echo $x->_id; ?>"><?php
  //print "Author is : ".$x->who."<br/>";
  $main = $x->poll;
  echo "<table> <tr><td>";
 print "<b> Title:</b>" .$main->title."<br/>";
 echo "</td><td>";
 print "<b>Created on:</b> ".substr($x->when,0,10)."&nbsp;&nbsp;&nbsp;";
 if($x->expiry_date == "2020-12-20T18:30:00.000Z")
 {
  }
  else
 {
	print "<b>Expires on :</b> ".substr($x->expiry_date,0,10)."<br/>";
 }
 echo "</td></tr><tr><td>";
 print "<b> Details:</b>".$main->description."</td><td>";
 		$l=0;$d=0;
 	  foreach ( $main->options_list as $option)
	  {
		if($option->who_likes)
		{
		  foreach ( $option->who_likes as $like)
		  {
			$l++;
		  }
		}
		if($option->who_dislikes)
		{
		  foreach ( $option->who_dislikes as $dislike)
		  {
			$d++;
		  }
		}
	  }
	  echo "<b>Likes</b> ".$l.". <b>Dislikes</b> ".$d.". </td></tr></table></a></div>";?>
	 <?php
 }
 
  curl_close($ch);
?>
</div>
</div>
</body>
</html>
