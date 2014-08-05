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
<title>See reservations</title>
<link rel="shortcut icon" href="images1.png" type="image/png">
<link rel="stylesheet" type="text/css" href="ProjectStyle.css" />

</head>

<body style="background-image:url(logo4.png); background-repeat:no-repeat;">
<div id="wrapper">
  <div id="header">
    <div id="logins">
      <div style="display:inline;" id="UserLogin"><?php echo $_SESSION['user_name'] . ' ' . $_SESSION['user_surname'] ?></div>
      <a id="AdministratorLogin" href="../logout.php">Log out</a>
    </div>
  </div>
  
  <div id="glyphicons">
  <a href="https://www.facebook.com/pages/SSST-Univerzitet-Sarajevo-School-of-Science-and-Technology/153196561412429" target="_blank"><img id="facebook" src="../glyphicons_social_30_facebook.png" title="Facebook"/></a>
  <a href="#" target="_blank"><img id="twitter" src="../glyphicons_social_31_twitter.png" title="Twitter"/></a>  
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
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>   
   
<div id="showUsers">

<?php

echo '<h3 id="addNewUserAll">Reservations</h3>';

require ('mysqli_connect.php'); 


$display = 10;

if (isset($_GET['p']) && is_numeric($_GET['p'])) { 
	$pages = $_GET['p'];
} else { 

	$q = "SELECT COUNT(reservation_id) FROM reservations";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	
	if ($records > $display) { 
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} 

if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

		
$q = "SELECT r.reservation_id as id, b.book_title AS title, concat(u.user_name, ' ', u.user_surname) as name, DATE_FORMAT(reservation_date, '%y %M %Y') AS date FROM books b, reservations r, users u WHERE u.user_id=r.user_id AND r.book_id=b.book_id ORDER BY reservation_date asc LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); 

$num = mysqli_num_rows($r);


	echo '<table align="center" cellspacing="3" cellpadding="3" width="100%">
	<tr><td align="left"><b>Book</b></td>
	<td align="left"><b>Student</b></td>
	<td align="left"><b>Date Reserved</b></td></tr>';
	
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['title'] . '</td><td align="left">' . $row['name'] . '</td><td align="left">' . $row['date'] . '</td><td align="left"><a href="DELETE_RESERVATION1.php?id=' . $row['id'] . '"><img id="edit" title="Delete reservation" src="delete.png"/></a></td></tr>';
	}

	echo '</table>'; 
	
	mysqli_free_result ($r); 
	
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	if ($current_page != 1) {
		echo '<a href="SeeReservations.php?s=' . ($start - $display) . '&p=' . $pages . '"><img src="arrow_left.png" /></a> ';
	}
	
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="SeeReservations.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} 
	
	if ($current_page != $pages) {
		echo '<a href="SeeReservations.php?s=' . ($start + $display) . '&p=' . $pages . '"><img src="arrow_right.png" /></a>';
	}
	
	echo '</p>'; 
	
} 

mysqli_close($dbc); 
?>

</div>
    </div>  
  
  <div id="footer">
    <div id="footer-inner">
      <img id="logo2" src="../2-new.png" alt="SSST Logo" />
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