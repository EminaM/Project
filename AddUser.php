<?php session_start();

if($_SESSION['loggedin'] !== true){
	 header('Location:Login.php');
		 exit();		
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add user</title>
<link rel="shortcut icon" href="images1.png" type="image/png">
<link rel="stylesheet" type="text/css" href="ProjectStyle.css" />
</head>

<body style="background-image:url(logo4.png); background-repeat:no-repeat;">

<div id="wrapper">
  <div id="header">
    <div id="logins">
      <div style="display:inline;" id="UserLogin"><?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_surname'] ?></div>
      <a id="AdministratorLogin" href="logout.php">Log out</a>
    </div>
  </div>
  
  <div id="glyphicons">
  <a href="https://www.facebook.com/pages/SSST-Univerzitet-Sarajevo-School-of-Science-and-Technology/153196561412429" target="_blank"><img id="facebook" src="glyphicons_social_30_facebook.png" title="Facebook"/></a>
  <a href="#" target="_blank"><img id="twitter" src="glyphicons_social_31_twitter.png" title="Twitter"/></a>  
  </div>
  
  <table id="belowHeader">
  <tr>
  <th><a href="http://www.ssst.edu.ba/" target="_blank"><img id="logo" src="logo_blue_red_SSST.jpg" alt="SSST logo" title="SSST" /></a></th>
  <th><a id="title1" href="index.html"><h1 id="title">Library</h1></a></th>
  </tr>
  </table>   
  
  <ul id="adminMenu">
  <li  style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;" id="nav-lt"><a href="AddUser.php" target="_blank">Add user</a></li>
  <li><a href="SearchUser.php">Search user</a></li>
  <li><a href="AllUsers.php">All users</a></li>
  <li><a href="IssueBook.php">Issue book</a></li>
  <li id="nav-rt"><a href="IssuedBooks.php">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>    
      
    <form id="addUserForm" action="AddUser.php" method="post">
    
     <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); 
		
	$errors = array(); 
	
	// Check for a name:
	if (empty($_POST['user_name'])) {
		$errors[] = 'You forgot to enter user name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['user_name']));
	}
	
	// Check for a surname:
	if (empty($_POST['user_surname'])) {
		$errors[] = 'You forgot to enter user surname.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['user_surname']));
	}
	
	// Check for a student ID:
	if (empty($_POST['student_id'])) {
		$errors[] = 'You forgot to enter student ID.';
	} else {
		$id = mysqli_real_escape_string($dbc, trim($_POST['student_id']));
	}
	
	// Check for a date of birth:
	if (empty($_POST['user_dob'])) {
		$errors[] = 'You forgot to enter user date of birth.';
	} else {
		$dob = mysqli_real_escape_string($dbc, trim($_POST['user_dob']));
	}
	
	// Check for an address:
	if (empty($_POST['user_address'])) {
		$errors[] = 'You forgot to enter user address.';
	} else {
		$addr = mysqli_real_escape_string($dbc, trim($_POST['user_address']));
	}
	
	// Check for a city:
	if (empty($_POST['user_city'])) {
		$errors[] = 'You forgot to enter user city.';
	} else {
		$ct = mysqli_real_escape_string($dbc, trim($_POST['user_city']));
	}
	
	// Check for a mobile:
	if (empty($_POST['user_mobile'])) {
		$errors[] = 'You forgot to enter user mobile.';
	} else {
		$mob = mysqli_real_escape_string($dbc, trim($_POST['user_mobile']));
	}
	
	// Check for a year:
	if (empty($_POST['user_year'])) {
		$errors[] = 'You forgot to enter user year of study.';
	} else {
		$yr = mysqli_real_escape_string($dbc, trim($_POST['user_year']));
	}
	
	// Check for a department:
	if (empty($_POST['user_department'])) {
		$errors[] = 'You forgot to enter user department.';
	} else {
		$dpt = mysqli_real_escape_string($dbc, trim($_POST['user_department']));
	}
	
	// Check for a type:
	if (empty($_POST['user_type'])) {
		$errors[] = 'You forgot to enter user type.';
	} else {
		$t = mysqli_real_escape_string($dbc, trim($_POST['user_type']));
	}
	
	// Check for an email:
	if (empty($_POST['user_email'])) {
		$errors[] = 'You forgot to enter user email.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['user_email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'User password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}	
	} else {
		$errors[] = 'You forgot to enter user password.';
	}
	
	if (empty($errors)) { 
	
		$q = "CALL `DodajKorisnika` ('$fn', '$ln', '$id', '$dob', '$addr', '$ct', '$mob', '$yr', '$dpt', '$t', '$e', '$p');";		
		$r = @mysqli_query ($dbc, $q);
		if ($r) { 
		
		echo '<p class="greenP"><strong>'. $fn . ' ' . $ln . ' </strong>  added as a new user.</p><p><br /></p>';
				
		} else { 			
			echo '<p class="error"><strong>User could not be registered due to a system error. Please try later.</strong></p>'; 									
		} 
		
		mysqli_close($dbc); 		
		
	} else { 
	
		echo '<p class="errorP">';
		foreach ($errors as $msg) { 
			echo " $msg<br />\n";
		}
		echo '<br />';
} 	
	//mysqli_close($dbc); // Close the database connection.
} 
?>
    
      <h3 id="addNewUser"><a href="AddUser.php"><img id="add" src="add.png"/></a>Add user</h3>  

	<label>Name: <input type="text" name="user_name" size="30" maxlength="40" autofocus value="<?php if (isset($_POST['user_name'])) echo $_POST['user_name']; ?>" /></label><br />
	<label>Surname: <input type="text" name="user_surname" size="30" maxlength="40" value="<?php if (isset($_POST['user_surname'])) echo $_POST['user_surname']; ?>" /></label><br />
    <label>Student ID: <input type="text" name="student_id" size="20" placeholder="xxxx-xx-xxxx" maxlength="40" value="<?php if (isset($_POST['student_id'])) echo $_POST['student_id']; ?>" /></label><br />
    <label>Date of Birth: <input type="date" name="user_dob" size="20" maxlength="40" value="<?php if (isset($_POST['user_dob'])) echo $_POST['user_dob']; ?>" /></label><br />
    <label>Address: <input type="text" name="user_address" size="30" maxlength="40" value="<?php if (isset($_POST['user_address'])) echo $_POST['user_address']; ?>" /></label><br />
    <label>City: <input type="text" name="user_city" size="30" maxlength="40" value="<?php if (isset($_POST['user_city'])) echo $_POST['user_city']; ?>" /></label><br />
    <label>Mobile Phone: <input type="tel" name="user_mobile" size="15" placeholder="xxx-xxx-xxx" pattern="\d{3}-\d{3}-\d{3}" maxlength="20" value="<?php if (isset($_POST['user_mobile'])) echo $_POST['user_mobile']; ?>" /></label><br />
      <legend><p id="year">Year:</p> 
<input id="1" type="radio" name="user_year" value="1" <?php if (isset($_POST['user_year'])) { if($yr == 1) echo 'checked'; }?> /> 
<label for="1" style="user_year: 1">1</label> 
<input id="2" type="radio" name="user_year" value="2" <?php if (isset($_POST['user_year'])) { if($yr == 2) echo 'checked'; }?> /> 
<label for="2" style="user_year: 2">2</label>
<input id="3" type="radio" name="user_year" value="3" <?php if (isset($_POST['user_year'])) { if($yr == 3) echo 'checked'; }?> />
<label for="3" style="user_year: 3">3</label>
<input id="4" type="radio" name="user_year" value="4" <?php if (isset($_POST['user_year'])) { if($yr == 4) echo 'checked'; }?> /> 
<label for="4" style="user_year: 4">4</label>
<input id="5" type="radio" name="user_year" value="5" <?php if (isset($_POST['user_year'])) { if($yr == 5) echo 'checked'; }?> />
<label for="5" style="user_year: 5">5</label></legend>
    <legend>Department:</legend> 
<input id="CSIS" type="radio" name="user_department" value="CSIS" <?php if (isset($_POST['user_department'])) { if($dpt == 'CSIS') echo 'checked';} ?> /> 
<label for="CSIS" style="user_department: CSIS">CSIS</label> 
<input id="ECON" type="radio" name="user_department" value="ECON" <?php if (isset($_POST['user_department'])) { if($dpt == 'ECON') echo 'checked';} ?> /> 
<label for="ECON" style="user_department: ECON">ECON</label>
<input id="PS" type="radio" name="user_department" value="PS" <?php if (isset($_POST['user_department'])) { if($dpt == 'PS') echo 'checked';} ?> /> 
<label for="PS" style="user_department: PS">PS</label>
<input id="SFA" type="radio" name="user_department" value="SFA" <?php if (isset($_POST['user_department'])) { if($dpt == 'SFA') echo 'checked';} ?> /> 
<label for="SFA" style="user_department: SFA">SFA</label>
<input id="LANG" type="radio" name="user_department" value="LANG" <?php if (isset($_POST['user_department'])) { if($dpt == 'LANG') echo 'checked';} ?> /> 
<label for="LANG" style="user_department: LANG">LANG</label>
     <legend><p id="year">Type:</p> 
<input id="user" type="radio" name="user_type" value="user" <?php if (isset($_POST['user_type'])) { if($t == 'user') echo 'checked';} ?> /> 
<label for="user" style="user_type: user">User</label> 
<input id="admin" type="radio" name="user_type" value="admin" <?php if (isset($_POST['user_type'])) { if($t == 'admin') echo 'checked';} ?> />  
<label for="admin" style="user_type: admin">Admin</label><br />
	<label>Email: <input type="text" name="user_email" size="40" maxlength="60" value="<?php if (isset($_POST['user_email'])) echo $_POST['user_email']; ?>"  /></label><br />
	<label>Password: <input type="password" name="pass1" size="20" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></label><br />
	<label>Confirm Password: <input type="password" name="pass2" size="20" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></label><br />
	<button type="submit" id="user_submit">Add</button><br />
</form>  
</div>      
  
  <div id="footer">
    <div id="footer-inner">
      <img id="logo2" src="2-new.png" alt="SSST Logo" />
      <div id="contact">
        <h4>University Sarajevo School of Science and Technology</h4>
        <p>Hrasnička cesta 3a</br>71 000 Sarajevo</br>Bosnia and Herzegovina</br></br>+387 33 975 000</p>
      </div>
    </div>
  </div>
  
  <div id="footer-gray">
    <a id="impressum" href="http://www.ssst.edu.ba/menu/about-ssst/contact-us/impressum/232" target="_blank" title="Impressum">Impressum</a> | Copyright © 2012 Sarajevo School of Science and Technology
  </div>
  
  <div id="footer-last">
  </div>
  
</body>
</html>