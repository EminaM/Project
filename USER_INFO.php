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
<title>User info</title>
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
  <li  style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="AllUsers.php">All users</a></li>
  <li><a href="IssueBook.php">Issue book</a></li>
  <li id="nav-rt"><a href="IssuedBooks.php">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>    

 <form style="width:500px; padding-bottom:10px; font-size:23px;" id="addUserForm" action="BOOK_INFO.php" method="post">
      <h3 id="addNewUser"><a href="AllBooks.php"><img id="delete" src="info.png" /></a> User information </h3>  
      <a href="AllUsers.php" title="Back"><img style="float:right;" src="back _small.png"></a>
   
<?php 

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else {
	echo '<p class="error">This page has been accessed in error.</p>';	
}

require ('mysqli_connect.php');
	
		$q = "SELECT user_name, user_surname, student_id, DATE_FORMAT(user_dob, '%d %M %Y'), user_address, user_city, user_mobile, user_year, user_department, user_type, user_email, user_password, DATE_FORMAT(registration_date, '%d %M %Y') FROM users WHERE user_id=$id ";		
		$r = @mysqli_query ($dbc, $q);
		$num = mysqli_num_rows($r);
		if ($num == 1) {
			$row = mysqli_fetch_array($r);

			 echo '<p id = "srch"><div><strong>Name:</strong> ' . $row[0] . '<br /></div><strong>Surname:</strong> ' . $row[1] . '<br /><strong>Student ID: </strong>' . $row[2] . '<br /><strong> Date of Birth:</strong> ' . $row[3] . '<br /><strong>Address:</strong> ' . $row[4] . '<br /><strong>City:</strong> ' . $row[5] . '<br /><strong>Mobile Phone:</strong> ' . $row[6] . '<br/><strong>Year:</strong> ' . $row[7] . '<br /><strong>Department: </strong>' . $row[8] . '<br /><strong>Type: </strong>' . $row[9] . '<br /><strong>Email: </strong>' . $row[10] . '<br /><strong>Password: </strong>' . $row[11] . '<br /><div><strong>Date Registered: </strong>' . $row[12] . '</div>';
		
		$q2="SELECT b.book_title AS title FROM borrowings AS br, books AS b, users AS u WHERE br.book_id = b.book_id AND br.user_id = u.user_id  AND u.user_id = $id AND br.date_returned IS NULL";
	    $r2 = @mysqli_query ($dbc, $q2);
		$num2 = mysqli_num_rows($r2);
		if ($num2 >= 1) {
			echo '<strong>Taken book(s): </strong>';
			while ($row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
		echo '<p>'. $row2['title'] . '</p> ';
			}
			echo '</p>';
		}
	} 
		
mysqli_close($dbc);
		
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