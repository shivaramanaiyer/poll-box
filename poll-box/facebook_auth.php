<?php

require 'src/facebook.php';
	$facebook = new Facebook(array(
	  'appId'  => '176273535785674',
	  'secret' => '2b2d67285efad199c051ddbd6db153cf',
	));

	// See if there is a user from a cookie
	$user = $facebook->getUser();
	$params = array( 'next' => 'http://10.100.94.102/finale/poll-box/voteweb/login.php' );
	if ($user) 
	{
	  $logoutUrl = $facebook->getLogoutUrl($params);
	  $user_profile = $facebook->api('/me');
	  
	} 
	else 
	{
	  		Header("Location: ./login.php");
	}
?>