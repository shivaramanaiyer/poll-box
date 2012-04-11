<html>
<head>
</head>
<body>
<?php
   $username="aakriti";
  //always
  $ch = curl_init();
  $timeout = 5;
  //curl_setopt($ch,CURLOPT_URL,'http://10.100.70.53:3000/api/poll/get_recent_polls_by_author/rms/'."5");
  
  curl_setopt($ch,CURLOPT_URL,'http://10.100.70.53:3000/api/poll/get_recent_polls_by_author/'.$username."/5");
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
  //always ended.. 

 print "without decoding whole data---- ";
 print $data;
 print "<br/>"; 
 print "<br/>"; 
 
 $val = json_decode($data); //always
  
 foreach ($val as $x)
	 { ?> <p>****</p><?php
	  print "Author is : ".$x->who."<br/>";
	  $main = $x->poll;
	  print "Title is : " .$main->title."<br/>";
	  print "Description is : ".$main->description."<br/>";
	  print "Option-Type is : ".$main->options_type."<br/>";
	  print "Poll - Method is : " .$main->poll_method."<br/>";
	  if ( $main->comments_enabled == 1 )
	  {
	  print "Comments Enabled is : True <br/>";
	  }
	  else
	  {
	  print "Comments Enabled is : False <br/>";
	  }
	  $l=0;
	  $d=0;
	  foreach ( $main->options_list as $option)
	  {
	  print "content is : ". $option->content."<br/>";
	  print "People who like are : ";
	  
	  foreach ( $option->who_likes as $like)
	  {
	  print $like. ",";
	  $l++;
	  }
	       	  
	  print "<br/>";
	  print "People who dislike are : ";
     foreach ( $option->who_dislikes as $dislike)
	  {
	  print $dislike.",";
	  $d++;
	  }
	  
	  print "<br/>";
	  }
	  Print "The number of like are :". $l."<br/>";
	  Print "The number of dislike are :". $d."<br/>";
	  print "Visibility is : ".$x->visibility."<br/>";
	  print "Creation of poll was done on is : ".$x->when."<br/>";
	  print "Expiry Date is : ".$x->expiry_date."<br/>";
	  print "Description content type is : ".$main->des_content_type."<br/>";

	  foreach ($main->tags as $option)
	  {
	  print "Tag is : ". $option. "<br/>";
	  }
	 
	   print "</br></br>";
 }
 
  curl_close($ch);
?>