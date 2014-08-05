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
<title>Return book</title>
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
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;" id="nav-rt"><a href="IssuedBooks.php">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>
   
   <form id="addUserForm" action="RETURN_BOOK.php" method="post">
      <h3 id="addNewUser"><a href="IssuedBooks.php"><img id="delete" src="return_book_small.png" /></a> Return book</h3> 
      	<a href="IssuedBooks.php" title="Back"><img style="float:right;" src="back _small.png"></a><br />
 
   
<?php 

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else { 
	echo '<p class="error">This page has been accessed in error.</p>';	
}

require ('mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { 

		$q = "UPDATE borrowings SET date_returned = NOW() WHERE borrowing_id=$id LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { 

			echo '<p>The book has been returned.</p>';	

		} else { 
			echo '<p class="error">The book could not be returned due to a system error.</p>'; 
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; 
		}
	
	} else { 
		echo '<p>The book has NOT been returned.</p>';	
	}

} else {

	$q = "SELECT * FROM borrowings WHERE borrowing_id=$id";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { 

		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		echo "Do you want to return the book? <br />";
		
		echo '<form id="confirm" action="RETURN_BOOK.php" method="post" color="black">
	<input id="yes" type="radio" name="sure" value="Yes" > Yes </input>
	<input type="radio" name="sure" value="No" checked="checked" > No</input> <br />
	<button type="submit" id="user_submit">Confirm</button><br />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} else { 
		echo '<p class="error">This page has been accessed in error.</p>';
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