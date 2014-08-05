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
<title>Search user</title>
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
  <li id="nav-lt"><a href="AddUser.php" target="_blank">Add user</a></li>
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="SearchUser.php" target="_blank">Search user</a></li>
  <li><a href="AllUsers.php">All users</a></li>
  <li><a href="IssueBook.php">Issue book</a></li>
  <li id="nav-rt"><a href="IssuedBooks.php">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>   
    
    <form id="addUserForm" action="SearchUser.php" method="post">
      <h3 id="addNewUser"><a href="SearchUser.php"><img id="search" src="search.png"/></a>Search user</h3>  

	<label>Name: <input type="text" name="user_name" size="30" maxlength="40" autofocus value="<?php if (isset($_POST['user_name'])) echo $_POST['user_name']; ?>" /></label><br />
	<label>Surname: <input type="text" name="user_surname" size="30" maxlength="40" value="<?php if (isset($_POST['user_surname'])) echo $_POST['user_surname']; ?>" /></label><br />
	
	<button type="submit" id="user_submit">Search</button><br />    
    
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
	
	if (empty($errors)) { 
		
		$q = "SELECT user_id as id, user_name as name, user_surname as surname, student_id as sid, user_dob as dob, user_address as address, user_city as city, user_mobile as mobile, user_year as year, user_department as dept, user_password as password, DATE_FORMAT(registration_date, '%d %m %Y') AS dr FROM users WHERE upper(user_name) = upper('$fn') AND upper(user_surname) = upper('$ln')";	
		
$r = @mysqli_query ($dbc, $q); 
		
        $num = mysqli_num_rows($r);

if ($num > 0) { 

	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<p id = "srch"><div id="top"><strong>ID NUMBER:</strong> ' . $row['id'] . '<br /></div><strong>NAME:</strong> ' . $row['name'] . '<br /><strong>SURNAME: </strong>' . $row['surname'] . '<br /><strong> ID:</strong> ' . $row['sid'] . '<br /><strong>DATE OF BIRTH:</strong> ' . $row['dob'] . '<br /><strong>ADDRESS:</strong> ' . $row['address'] . '<br /><strong>CITY:</strong> ' . $row['city'] . '<br/><strong>MOBILE PHONE:</strong> ' . $row['mobile'] . '<br /><strong>YEAR: </strong>' . $row['year'] . '<br /><strong>DEPARTMENT: </strong>' . $row['dept'] . '<br /><strong>PASSWORD: </strong>' . $row['password'] . '<br /><div id="bottom"><strong>DATE REGISTERED: </strong>' . $row['dr'] . '</div></p>';
	}
	
	mysqli_free_result ($r); 

} else { 
	echo '<p class="errorP">Searched user does not exist.</p>';

}				
	} else { 
	
		echo '<p class="errorP">';
		foreach ($errors as $msg) { 
			echo " $msg<br />\n";
		}
	} 
	
	//mysqli_close($dbc); // Close the database connection.

} 
?>   
    
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