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
<title>Edit people</title>
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
  <li><a href="AddPeople.php">Add people</a></li>
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;" id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>
    

<?php
	echo '<form id="addUserForm" action="EDIT_PEOPLE.php" method="post">
	<h3 id="addNewUser"><a href="AllPeople.php"><img id="add" src="edit.png" /></a>Edit book person</h3>
	<a href="AllPeople.php" title="Back"><img style="float:right;" src="back _small.png"></a><br />
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
	
		$fn = mysqli_real_escape_string($dbc, trim($_POST['person_name']));
		$ln = mysqli_real_escape_string($dbc, trim($_POST['person_surname']));
			
			$q = "UPDATE people SET person_name='$fn', person_surname='$ln' WHERE person_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { 

				echo '<p class="greenP">The book person has been edited.</p><br /><br />';	
				
			} else { 
				echo '<p class="error">You did not change anything.</p>'; 				
			}	
} 

$q = "SELECT person_name, person_surname FROM people WHERE person_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { 

	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
echo'	  
<label>Name: <input type="text" name="person_name" size="30" maxlength="40" autofocus value="' . $row[0] . '" /></label><br />
<label>Surame: <input type="text" name="person_surname" size="30" maxlength="40" value="' . $row[1] . '" /></label><br />
	
<button type="submit" id="user_submit">Change</button><br />
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid user ID.
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