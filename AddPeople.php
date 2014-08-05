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
<title>Add book people</title>
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
  <li><a href="AllUsers.php">All users</a></li>
  <li><a href="IssueBook.php">Issue book</a></li>
  <li id="nav-rt"><a href="IssuedBooks.php">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>
      
    <form id="addUserForm" action="AddPeople.php" method="post">
    
     <?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); 
		
	$errors = array(); 
	
	// Check for a name:
	if (empty($_POST['person_name'])) {
		$errors[] = 'You forgot to enter person name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['person_name']));
	}
	
	// Check for a surname:
	if (empty($_POST['person_surname'])) {
		$errors[] = 'You forgot to enter user surname.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['person_surname']));
	}
	
	if (empty($errors)) { 
	
	$q = "SELECT person_id FROM people WHERE person_name='$fn' AND person_surname='$ln'";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {
	
		$q = "CALL `DodajLjude` ('$fn', '$ln');";		
		$r = @mysqli_query ($dbc, $q); 
		if ($r) {
		
		echo '<p class="greenP"><strong>'. $fn . ' ' . $ln . ' </strong>  added to book people.</p><p><br /></p>';
				
		} else { 
			
			echo '<p class="error">Book person could not be added right now. Please try later.</p>'; 			
									
		} 
		}else { 
			echo '<p class="error">The book person already exists.</p>';
		}
		
		
		mysqli_close($dbc); 		
		
	} else { 
	
		echo '<p class="errorP">';
		foreach ($errors as $msg) { 
			echo " $msg<br />\n";
		}
		echo '</p><p class="errorP"><strong><a class="errorP" href="AddPeople.php">Please try again.</a></strong></p><p><br /></p>';		
	} 	
} 
?>
    
      <h3 id="addNewUser"><a href="AddUser.php"><img id="add" src="add.png"/></a>Add book person</h3>  

	<label>Name: <input type="text" name="person_name" size="30" maxlength="40" autofocus value="<?php if (isset($_POST['person_name'])) echo $_POST['person_name']; ?>" /></label><br />
	<label>Surname: <input type="text" name="person_surname" size="30" maxlength="40" value="<?php if (isset($_POST['person_surname'])) echo $_POST['person_surname']; ?>" /></label><br />

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