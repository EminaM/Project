<?php 

session_start(); 

if (!isset($_SESSION['user_id'])) {

     header('Location: Login.php');
	
} else {
	$_SESSION = array(); 
	session_destroy(); 
}

?>

<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log out</title>
<link rel="shortcut icon" href="images1.png" type="image/png">
<link rel="stylesheet" type="text/css" href="ProjectStyle.css" />
</head>

<body style="background-image:url(logo5.png); background-repeat:no-repeat;">

<div id="loggedOut">
<img src="logo_blue_red_SSST-new.png" alt="SSST" /> 
<p style="margin-top:25px; letter-spacing:0.7px;">You are logged out!<a href="Login.php"> (Log in)</a> <br /><br /><a href="index.html"><img title= "Home" alt="Back" style="margin-right:15px;" src="back.png"></a>Home</p>

</div> 
  

</body>
</html>