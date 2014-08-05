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
<title>Issue book</title>
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
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="IssueBook.php">Issue book</a></li>
  <li id="nav-rt"><a href="IssuedBooks.php">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php">Add book</a></li>
  <li><a href="SearchBook.php">Search book</a></li>
  <li><a href="AllBooks.php">All books</a></li>  
  <li><a href="AddPeople.php">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php">All people</a></li>
  </ul>
    
  <form id="addUserForm" action="IssueBook.php" method="post">
      <h3 id="addNewUser"><a href="IssueBook.php"><img id="add" src="down.png" /></a>Issue book</h3> 
      
      
      <?php 
	  	require ('mysqli_connect.php'); 	 
	  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$date = mysqli_real_escape_string($dbc, trim($_POST['date']));
	
		if (empty($errors)) { 
		
		$user_id=$_POST['user'];
    	$book_id=$_POST['book'];

	$q = "INSERT INTO borrowings (user_id, book_id, date_issued) VALUES ('$user_id', '$book_id', '$date')";	
    $result = mysqli_query ($dbc, $q); 
		
	if($result){	
		echo '<p class="greenP">Book successfuly isssued.</p><p><br /></p>';  
   }
    else{
			echo '<p style="display:inline;" class="error">Please choose a date.</p><br /><br />'; 			
   }
   }
	}
	
	 	
	?>       

   User:
   <select required style="height:38px;" name="user">
   <option value="">Choose user</option>
      <?php  
	  	  
	  $q = "SELECT user_id, user_name, user_surname FROM users WHERE user_type != 'admin'";
      $result = mysqli_query($dbc, $q);
	  while ($row = mysqli_fetch_assoc($result)) 
     {
	  $id=$row['user_id'];
      $name=$row['user_name'];
	  $surname=$row['user_surname'];
	  	 	  
      echo "<option value=\"" . $id ."\">" . $name . ' ' . $surname.'</option>';
	 	  
      }
     ?>
   </select><br />
   
   Book:   
   <select required value="0" style="height:38px;" name="book">
      <option value="">Choose book</option>

      <?php  
	  
	  $q = "SELECT book_id, book_title FROM books";
      $result = mysqli_query($dbc, $q);
	  while ($row = mysqli_fetch_assoc($result)) 
     {
	  $bid=$row['book_id'];
      $title=$row['book_title'];
	  	 	  
      echo "<option value=\"" . $bid ."\">" . $title .'</option>';
	 	  
      }
     ?>
   </select><br />
    
   <label>Date Issued: <input required type="date" name="date" size="20" maxlength="40" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>" /></label><br />
      
    <button type="submit" id="user_submit">Issue</button><br />    
    
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