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
<title>Edit user</title>
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
  <li id="nav-lt"><a href="AddUser.php">Add user</a></li>
  <li><a href="SearchUser.php">Search user</a></li>
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="AllUsers.php">All users</a></li>
  <li><a href="IssueBook.php">Issue book</a></li>
  <li id="nav-rt"><a href="IssuedBooks.php">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>
    

<?php
	echo '<form id="addUserForm" action="EDIT_USER.php" method="post">
	<h3 id="addNewUser"><a href="AllUsers.php"><img id="add" src="edit.png" /></a>Edit user</h3>
	      <a href="AllUsers.php" title="Back"><img style="float:right;" src="back _small.png"></a><br />
';

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else { 
	echo '<p class="error">This page has been accessed in error.</p>';
	exit();
}

	require ('mysqli_connect.php'); 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$fn = mysqli_real_escape_string($dbc, trim($_POST['user_name']));
		$ln = mysqli_real_escape_string($dbc, trim($_POST['user_surname']));
		$sid = mysqli_real_escape_string($dbc, trim($_POST['student_id']));
		$dob = mysqli_real_escape_string($dbc, trim($_POST['user_dob']));
		$addr = mysqli_real_escape_string($dbc, trim($_POST['user_address']));
		$ct = mysqli_real_escape_string($dbc, trim($_POST['user_city']));
		$mob = mysqli_real_escape_string($dbc, trim($_POST['user_mobile']));
		$yr = mysqli_real_escape_string($dbc, trim($_POST['user_year']));
		$dpt = mysqli_real_escape_string($dbc, trim($_POST['user_department']));
		$t = mysqli_real_escape_string($dbc, trim($_POST['user_type']));
		$e = mysqli_real_escape_string($dbc, trim($_POST['user_email']));
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'User password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	
		$q = "SELECT user_id FROM users WHERE user_email='$e' AND user_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {
			
			$q = "UPDATE users SET user_name='$fn', user_surname='$ln', student_id='$sid', user_dob='$dob', user_address='$addr', user_city='$ct', user_department='$dpt', user_mobile='$mob', user_year='$yr', user_type='$t', user_email='$e', user_password='$p' WHERE user_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { 

				echo '<p class="greenP">The user has been edited.</p><br /><br />';	
				
			} else { 
				echo '<p class="error">You did not change anything.</p>'; 				
			}
				
		} else { 
			echo '<p class="error">The email address has already been registered.</p>';
		}
		
	}
      $q = "SELECT user_name, user_surname, student_id, user_dob, user_address, user_city, user_mobile, user_type, user_email, user_year, user_department, user_password FROM users WHERE user_id=$id";		
      $r = @mysqli_query ($dbc, $q);

      if (mysqli_num_rows($r) == 1) { 

	  $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
	
echo'	  
<label>Name: <input type="text" name="user_name" size="30" maxlength="40" autofocus value="' . $row['user_name'] . '" /></label> <br />
	<label>Surname: <input type="text" name="user_surname" size="30" maxlength="40" value="' . $row['user_surname'] . '" /></label> <br />
    <label>Student ID: <input type="text" name="student_id" size="20" placeholder="xxxx-xx-xxxx" maxlength="40" value="' . $row['student_id'] . '" /></label> <br />
    <label>Date of Birth: <input type="date" name="user_dob" size="20" maxlength="40" value="' . $row['user_dob'] . '" /></label> <br />
    <label>Address: <input type="text" name="user_address" size="30" maxlength="40" value="' . $row['user_address'] . '" /></label> <br />
    <label>City: <input type="text" name="user_city" size="30" maxlength="40" value="' . $row['user_city'] . '" /></label> <br />
    <label>Mobile Phone: <input type="tel" name="user_mobile" size="15" placeholder="xxx-xxx-xxx" pattern="\d{3}-\d{3}-\d{3}" maxlength="20" value="' . $row['user_mobile'] . '" /></label> <br />'?>
<legend><p id="year">Year:</p> 
<input id="1" type="radio" name="user_year" value="1" <?php if ($row['user_year'] == 1) {echo 'checked';} ?> />
<label for="1" style="user_year: 1">1</label> 
<input id="2" type="radio" name="user_year" value="2" <?php if ($row['user_year'] == 2) {echo 'checked';} ?> /> 
<label for="2" style="user_year: 2">2</label>
<input id="3" type="radio" name="user_year" value="3" <?php if ($row['user_year'] == 3) {echo 'checked';} ?> /> 
<label for="3" style="user_year: 3">3</label>
<input id="4" type="radio" name="user_year" value="4" <?php if ($row['user_year'] == 4) {echo 'checked';} ?>/> 
<label for="4" style="user_year: 4">4</label>
<input id="5" type="radio" name="user_year" value="5" <?php if ($row['user_year'] == 5) {echo 'checked';} ?> /> 
<label for="5" style="user_year: 5">5</label></legend>

<legend>Department:</legend> 
<input id="CSIS" type="radio" name="user_department" value="CSIS" <?php if ($row['user_department'] == 'CSIS') {echo 'checked';} ?> /> 
<label for="CSIS" style="user_department: CSIS">CSIS</label> 
<input id="ECON" type="radio" name="user_department" value="ECON" <?php if ($row['user_department'] == 'ECON') {echo 'checked';} ?> /> 
<label for="ECON" style="user_department: ECON">ECON</label>
<input id="PS" type="radio" name="user_department" value="PS" <?php if ($row['user_department'] == 'PS') {echo 'checked';} ?> /> 
<label for="PS" style="user_department: PS">PS</label>
<input id="SFA" type="radio" name="user_department" value="SFA" <?php if ($row['user_department'] == 'SFA') {echo 'checked';} ?> /> 
<label for="SFA" style="user_department: SFA">SFA</label>
<input id="LANG" type="radio" name="user_department" value="LANG" <?php if ($row['user_department'] == 'LANG') {echo 'checked';} ?> /> 
<label for="LANG" style="user_department: LANG">LANG</label><br />
<legend><p id="year">Type:</p> 
<input id="user" type="radio" name="user_type" value="user" <?php if ($row['user_type'] == 'user') {echo 'checked';} ?> />  
<label for="user" style="user_type: user">User</label> 
<input id="admin" type="radio" name="user_type" value="admin" <?php if ($row['user_type'] == 'admin') {echo 'checked';} ?> />  
<label for="admin" style="user_type: admin">Admin</label><br />
<?php echo '
<label>Email: <input type="text" name="user_email" size="40" maxlength="60" value="' . $row['user_email'] . '" /></label> <br />
<label>Password: <input type="password" name="pass1" size="20" maxlength="20" value="' . $row['user_password'] . '" /></label> <br />
<label>Confirm Password: <input type="password" name="pass2" size="20" maxlength="20" value="' . $row['user_password'] . '" /></label> <br />	
<button type="submit" id="user_submit">Change</button><br />
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { 
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
?>

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