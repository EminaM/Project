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
<title>Book info</title>
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
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul> 

 <form style="width:500px; padding-bottom:10px; font-size:23px;" id="addUserForm" action="BOOK_INFO.php" method="post">
      <h3 id="addNewUser"><a href="AllBooks.php"><img id="delete" src="info.png" /></a> Book information </h3>  
      <a href="AllBooks.php" title="Back"><img style="float:right;" src="back _small.png"></a>
   
<?php 

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else {
	echo '<p class="error">This page has been accessed in error.</p>';	
}

require ('mysqli_connect.php');
	
		$q = "SELECT ISBN, book_title, book_subtitle, book_edition, book_publisher, year_published, number_of_pages, number_of_copies, book_field, number_of_authors, DATE_FORMAT(date_registered, '%d %M %Y') FROM books WHERE book_id=$id ";		
		$r = @mysqli_query ($dbc, $q);
		$num = mysqli_num_rows($r);
		if ($num == 1) {
			$row = mysqli_fetch_array($r);

			 echo '<p id = "srch"><div><strong>ISBN:</strong> ' . $row[0] . '<br /></div><strong>Title:</strong> ' . $row[1] . '<br /><strong>Subtitle: </strong>' . $row[2] . '<br /><strong> Edition:</strong> ' . $row[3] . '<br /><strong>Publisher:</strong> ' . $row[4] . '<br /><strong>Year Published:</strong> ' . $row[5] . '<br /><strong>Number of Pages:</strong> ' . $row[6] . '<br/><strong>Number of Copies (available):</strong> ' . $row[7] . '<br /><strong>Field: </strong>' . $row[8] . '<br /><strong>Number of Authors: </strong>' . $row[9] . '<br /><div><strong>Date Registered: </strong>' . $row[10] . '</div>';
			 			 
		$q1="SELECT bbp.book_people_id as id, CONCAT( p.person_name,  ' ', p.person_surname ) AS editor FROM book_by_people AS bbp, books AS b, people AS p WHERE bbp.book_id = b.book_id AND bbp.person_id = p.person_id AND bbp.person_type = 'editor' AND b.book_id = $id";
	    $r1 = @mysqli_query ($dbc, $q1);
		$num1 = mysqli_num_rows($r1);
		if ($num1 == 1) {
			$row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
		echo '<div><strong>Editor:</strong> ' . $row1['editor'] . '<a href="REMOVE_PERSON.php?id=' . $row1['id'] . '">  <img style="padding-left:10px;" title="Delete" src="delete_small.png"/></a><br /></div></p>';
		}
		
		$q2="SELECT bbp.book_people_id as id, CONCAT( p.person_name,  ' ', p.person_surname ) AS author FROM book_by_people AS bbp, books AS b, people AS p WHERE bbp.book_id = b.book_id AND bbp.person_id = p.person_id AND bbp.person_type = 'author' AND b.book_id = $id";
	    $r2 = @mysqli_query ($dbc, $q2);
		$num2 = mysqli_num_rows($r2);
		if ($num2 >= 1) {
			echo '<strong>Author(s): </strong>';
			while ($row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
		echo '<p>'. $row2['author'] . ' <a href="REMOVE_PERSON.php?id=' . $row2['id'] . '">  <img style="padding-left:10px;" title="Delete" src="delete_small.png"/></a></p> ';
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