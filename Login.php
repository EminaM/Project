<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log in</title>
<link rel="shortcut icon" href="images1.png" type="image/png">
<link rel="stylesheet" type="text/css" href="LoginStyle.css" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script></head>
</head>

<body>

  <form class="form-horizontal" role="form" method="post" action="Login.php">
  <img src="logo_blue_red_SSST-new.png" alt="SSST" />
  <h1>Library</h1>
  <h3>Login</h3>  
    
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {	
	
	$wrongPass=false;
    $wrongUsnm=false;

	require ('mysqli_connect.php'); 
	
	$errors = array(); 
	
	if (empty($_POST['userEmail'])) {
		$errors[] = 'Please enter your email.';
	} else {
		$em = mysqli_real_escape_string($dbc, trim($_POST['userEmail']));
	}

	if (empty($_POST['userPassword'])) {
		$errors[] = 'Please enter your password.';
	} else {
		$pa = mysqli_real_escape_string($dbc, trim($_POST['userPassword']));
	}

	if (empty($errors)) { // If everything's OK.

		$q = "SELECT * FROM users WHERE (user_email='$em')";
		$r = @mysqli_query($dbc, $q);
		$num1 = @mysqli_num_rows($r);
		$num = 0;
		if ($num1 == 1) { // Match was made.
		
		$q = "SELECT * FROM users WHERE (user_email='$em'AND user_password='$pa')";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		
		
		    if ($num == 1) { 	
			$row = mysqli_fetch_assoc($r);
			$_SESSION['user_id'] = $row['user_id'];
		    $_SESSION['user_name'] = $row['user_name'];
		    $_SESSION['user_surname'] = $row['user_surname'];
    		$_SESSION['user_type'] = $row['user_type'];
			$_SESSION['user_email'] = $row['user_email'];
			$_SESSION['user_password'] = $row['user_password'];
			$_SESSION['loggedin'] = true;	
			
			if($row['user_type'] == 'admin'){
				header('Location: AdminHome.php');
				exit();
			}
			
			else{
				header('Location: UserHome.php');
				exit();
			}
			
		}else {
			$wrongPass=true;
			echo '<p class="redWar">Wrong password!</p>';
			}			
	}else {
		
		$q = "SELECT * FROM users WHERE (user_password='$pa')";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		
		if ($num == 1) { 
		$wrongUsnm=true;
			 echo '<p class="redWar">Wrong email!</p>';

		 }
		 else  {
 			echo '<p class="redWar">Wrong email and password!</p>';
			 
		 }
	}
				
	} else { // Report the errors.	
	     
		foreach ($errors as $msg) { // Print each error.
			echo "<p class='redWar'>$msg</p><br />\n";
		}
				
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
  
  
  <div class="form-group">
    <div class="col-sm-10">
      <input type="email" name="userEmail" class="form-control" id="inputEmail4" placeholder="Email" autofocus required value="<?php if (isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>" />
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" name="userPassword" class="form-control" id="inputPassword4" placeholder="Password" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Log in</button>
    </div>
  </div>
</form>

</body>
</html>