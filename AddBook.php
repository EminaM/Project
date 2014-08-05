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
<title>Add book</title>
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
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;" id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>
    
  <form id="addUserForm" action="AddBook.php" method="post">
      <h3 id="addNewUser"><a href="AddBook.php"><img id="add" src="add.png" /></a>Add book</h3> 
      
      <?php 
	  	require ('mysqli_connect.php'); 
	  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$errors = array(); 
		
	if (empty($_POST['ISBN'])) {
		$errors[] = 'You forgot to enter user book ISBN.';
	} else {
		$isbn = mysqli_real_escape_string($dbc, trim($_POST['ISBN']));
	}
	
	if (empty($_POST['book_title'])) {
		$errors[] = 'You forgot to enter book title.';
	} else {
		$tit = mysqli_real_escape_string($dbc, trim($_POST['book_title']));
	}
	
	$stit = mysqli_real_escape_string($dbc, trim($_POST['book_subtitle']));;	
	
	$edit = mysqli_real_escape_string($dbc, trim($_POST['book_edition']));	
			
	if (empty($_POST['book_publisher'])) {
		$errors[] = 'You forgot to enter book publisher.';
	} else {
		$bp = mysqli_real_escape_string($dbc, trim($_POST['book_publisher']));
	}
	
	if (empty($_POST['year_published'])) {
		$errors[] = 'You forgot to enter user year published.';
	} else {
		$yp = mysqli_real_escape_string($dbc, trim($_POST['year_published']));
	}
		
	if (empty($_POST['number_of_pages'])) {
		$errors[] = 'You forgot to enter number of pages.';
	} else {
		$nop = mysqli_real_escape_string($dbc, trim($_POST['number_of_pages']));
	}
	
	if (empty($_POST['number_of_copies'])) {
		$errors[] = 'You forgot to enter number of copies.';
	} else {
		$noc = mysqli_real_escape_string($dbc, trim($_POST['number_of_copies']));
	}
	
	if (empty($_POST['book_field'])) {
		$errors[] = 'You forgot to enter book field.';
	} else {
		$fld = mysqli_real_escape_string($dbc, trim($_POST['book_field']));
	}	
	
	if (empty($_POST['number_of_authors'])) {
		$errors[] = 'You forgot to enter number of authors.';
	} else {
		$noa = mysqli_real_escape_string($dbc, trim($_POST['number_of_authors']));
	}
	
		if (empty($errors)) { 

	$q1 = "INSERT INTO books (ISBN, book_title, book_subtitle, book_edition, book_publisher, year_published, number_of_pages, number_of_copies, book_field, number_of_authors, date_registered) VALUES ('$isbn', '$tit', '$stit', '$edit', '$bp', '$yp', '$nop', '$noc', '$fld', '$noa', NOW())";
	
    $result1 = mysqli_query($dbc, $q1); 
	
	$q2 = "SELECT book_id FROM books WHERE ISBN='$isbn' AND book_title='$tit'";
    $result2 = mysqli_query($dbc, $q2); 
	$num = mysqli_num_rows($result2);
	
	if($num = 1){
		
		echo '<p class="greenP"><strong>'. $tit . ' ' . ' </strong>  added as a new book.</p><p><br /></p>';
		    
   } else{
			echo '<p class="error"><strong>Book could not be registered due to a system error. Please try later.</strong></p>'; 			
   }
   
	}else{
			
		echo '<p class="errorP">';
		foreach ($errors as $msg) { 
			echo " $msg<br />\n";
		}
		echo '</p><p class="errorP"><strong><a class="errorP" href="AddBook.php">Please try again.</a></strong></p><p><br /></p>';
	}
	 	}
	?>      
      
      <label>ISBN: <input type="text" name="ISBN" size="30" maxlength="40" autofocus value="<?php if (isset($_POST['ISBN'])) echo $_POST['ISBN']; ?>" /></label><br />
      <label>Title: <input style="width:280px;" type="text" name="book_title" size="30" maxlength="50" value="<?php if (isset($_POST['book_title'])) echo $_POST['book_title']; ?>" /></label><br />
      <label>Subtitle: <input type="text" name="book_subtitle" size="40" maxlength="100" value="<?php if (isset($_POST['book_subtitle'])) echo $_POST['book_subtitle']; ?>" /></label><br />
      <label>Edition: <input type="text" name="book_edition" size="30" maxlength="40" placeholder="first" value="<?php if (isset($_POST['book_edition'])) echo $_POST['book_edition']; ?>" /></label><br />
      <label>Publisher: <input type="text" name="book_publisher" size="30" maxlength="40" value="<?php if (isset($_POST['book_publisher'])) echo $_POST['book_publisher']; ?>" /></label><br />
      <label>Year Published: <input type="text" name="year_published" size="10" maxlength="40" value="<?php if (isset($_POST['year_published'])) echo $_POST['year_published']; ?>" /></label><br />
      <label>Number of Pages: <input type="text" name="number_of_pages" size="5" maxlength="40" value="<?php if (isset($_POST['number_of_pages'])) echo $_POST['number_of_pages']; ?>" /></label><br />
      <label>Number of Copies: <input type="text" name="number_of_copies" size="5" maxlength="40" value="<?php if (isset($_POST['number_of_copies'])) echo $_POST['number_of_copies']; ?>" /></label><br />
      <label>Field: <input type="text" name="book_field" size="30" maxlength="40" value="<?php if (isset($_POST['book_field'])) echo $_POST['book_field']; ?>" /></label><br />
      <label>Number of Authors: <input type="text" name="number_of_authors" size="5" maxlength="40" value="<?php if (isset($_POST['number_of_authors'])) echo $_POST['number_of_authors']; ?>" /></label><br />        
           
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