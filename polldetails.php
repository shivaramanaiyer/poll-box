<?php
	include"facebook_auth.php";

	$id = $_GET['poll'];
  //always
  $ch = curl_init();
  $timeout = 5;
  //curl_setopt($ch,CURLOPT_URL,'http://10.100.70.53:3000/api/poll/get_poll_by_id/'.$id);
  curl_setopt($ch,CURLOPT_URL,'http://10.100.97.179:3000/api/poll/get_poll_by_id/'.$id);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  $data = curl_exec($ch);
//always ended.. 

$val = json_decode($data); //always
$date = substr($val->expiry_date,0,10);
$today = date("Y-m-d");
$status=0;
if($today > $date)
{
	$status=1;
	
}
?>

<html lang="en">
  <head>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <meta charset="utf-8">
    <title><?php echo $val->poll->title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="activitypage.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
	<link href="bootstrap-responsive.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css" type="text/css" media="screen">	
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
<script type="text/javascript">
function deacti(detail)
 {
	
		var lik="like"+detail;
		document.getElementById(lik).disabled=true;
		var dislik="dislike"+detail;
		document.getElementById(dislik).disabled=true; 
	
};
</script>
  </head>
<body>
<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
	    <div class="container">
		<a class="brand" href="#"><img src="1.jpg" style="max-width:40px; max-height:40px;"><img src="logo1.png"></a>
          <div class="nav-collapse">
            <ul class="nav">
		      <li class="active"><a href="./activity_page.php">Home</a></li>
			  
              <li><a href="aboutus.html">About Us</a></li>
              <li><a href="contactus.html">Contact Us</a></li>
              <li><a href="<?php echo $logoutUrl ?>">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
</div>

<div id="wrapper2">
<div class="hero-unit2">
  <p>Title : <?php //inside json poll
	$title = $val -> poll->title; 
	echo $title;?>  </p>
  <h1> &nbsp;&nbsp;&nbsp;Description: <?php 
	$des = $val -> poll->description;
	echo $des?> </h1>
	<?php 
	$poll1=$val -> poll;
	//optoin
	$i=0;
	foreach ($poll1->options_list as $option12)
	{
		$i++;
		
		
		//working $options = $val -> poll->options_list[0]->content;?>
		<div style="width:300px; float:left; padding-right:5px; text-align:center;">
		<div class="<?php if($poll1->options_type=="text"){print "opttext";} else{ print "hero-unit4"; }	?>">
		<?php
		if ($poll1->options_type=="text")
		{
			echo $option12->content;
		}
		else
		{
		$image = $option12->content 
		?>
		<img src="./create_poll/uploads/<?php echo $image; ?>" style="max-width:250px; max-height:250px"/><br />
		<?php		
		}
		
		?>
		</div><br />
		<?php if($val->who != $user) { ?>
		<button id="<?php echo "like".$i; ?>" name= "like" value="Like" onclick="servput('<?php echo $_GET['poll'];  ?>','<?php echo $i ?>', 'like','<?php echo $user; ?>','<?php echo $i; ?>')" >Like</button>
		<?php }$l=0;$d=0; 
			if($option12->who_likes)
			{
				foreach ( $option12->who_likes as $like)
				{
					$l++;
				}
			}
			if($option12->who_dislikes)
			{			
				foreach ( $option12->who_dislikes as $dislike)
				{
					$d++;
				}
			}
			
			  echo $l." Likes. ";
			  if($val->who != $user) {
		?>
		<button id="<?php echo "dislike".$i; ?>" name= "dislike" value="Dislike" onclick="servput('<?php echo $_GET['poll']; ?>','<?php echo $i ?>', 'dislike', '<?php echo $user; ?>','<?php echo $i; ?>')" >Dislike</button>
		<?php }echo $d." Dislikes";
		
		if($option12->who_likes)
		{
			foreach ( $option12->who_likes as $like)
			{
				if($like == $user)
				{
					echo "<SCRIPT LANGUAGE='javascript'> deacti('$i');</SCRIPT>";
				}
			}
		}
		if($option12->who_dislikes)
		{
			foreach ( $option12->who_dislikes as $dislike)
			{
				if($dislike == $user)
				{
					echo "<script language=javascript> deacti('$i');</script>" ;
				}
			}
		}
		 ?>
		</div>
		<?php
		if($i % 3==0)
		{
		?>
			<br/>
			<?php
		}
		if($status == 1)
		{
			echo "<script language=javascript> deacti('$i');</script>" ;
		}
  }
		
?>

</div>
<script>
function _ajax_request(url, data, callback, type, method) {
    if (jQuery.isFunction(data)) {
        callback = data;
        data = {};
    }
    return jQuery.ajax({
        type: method,
        url: url,
        data: data,
        success: callback,
        dataType: type
        });
}

jQuery.extend({
    put: function(url, data, callback, type) {
        return _ajax_request(url, data, callback, type, 'PUT');
    },
    delete_: function(url, data, callback, type) {
        return _ajax_request(url, data, callback, type, 'DELETE');
    }
});

function servput(pollid,option_no,value,user,detail){
	var obj;
		obj={
	      option_num : option_no,
	      choice : value,
	      id : user}
	var po = pollid;
	//var url = "http://10.100.70.53:3000/api/poll/update/" + po;
	var url = "http://10.100.97.179:3000/api/poll/update/" + po;
	$.post(url, obj);
	var lik = "like" + detail;
	document.getElementById(lik).disabled=true;
	var dislik = "dislike" + detail;
	document.getElementById(dislik).disabled=true;
	
	window.location.reload();
};

 

</script>


</body>
</html>






