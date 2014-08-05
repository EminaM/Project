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
<title>Add people</title>
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
    

<?php
	echo '<form id="addUserForm" action="ADD_PEOPLE.php" method="post">
	<h3 id="addNewUser"><a href="AllBooks.php"><img id="add" src="user_add.png" /></a>Add people to book</h3>
		      <a href="AllBooks.php" title="Back"><img style="float:right;" src="back _small.png"></a><br />
';

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else { 
	echo '<p class="error">The page has been accessed in error.</p>';
	exit();
}

	  	require ('mysqli_connect.php'); 	 
	  
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$type=$_POST['person_type'];
	
		if (empty($errors)) { 
		
		$person_id=$_POST['person'];
    	

	$q = "INSERT INTO book_by_people (book_id, person_id, person_type) VALUES ($id, '$person_id', '$type')";	
    $result = mysqli_query ($dbc, $q); 
		
	if($result){	
		echo '<p class="greenP">Book '. $type . ' successfuly added.</p><p><br /></p>';  
   }
    else{
			echo '<p style="display:inline;" class="error">Error.</p><br /><br />'; 			
   }
   }
	}
	
	 	
	?>       

   People:
   <select required style="height:38px;" name="person">
   <option value="">Choose people</option>
      <?php  
	  	   

	  $q = "SELECT person_id, person_name, person_surname FROM people";
      $result = mysqli_query($dbc, $q);
	  while ($row = mysqli_fetch_assoc($result)) 
     {
	  $id1=$row['person_id'];
      $name=$row['person_name'];
	  $surname=$row['person_surname'];
	  	 	  
      echo "<option value=\"" . $id1 ."\">" . $name . ' ' . $surname.'</option>';
	 	  
      }
	  
     
  echo ' </select><br />';
  ?>
   
   Type: 
<input required style="margin-left:20px;" id="author" type="radio" name="person_type" value="author" <?php if (isset($_POST['person_type'])) { if($type == 'author') echo 'checked';} ?> /> 
<label for="author" style="person_type: author">author</label>    
   <input style="margin-left:20px;" id="editor" type="radio" name="person_type" value="editor" <?php if (isset($_POST['person_type'])) { if($type == 'editor') echo 'checked';} ?> /> 
<label for="editor" style="person_type: editor">editor</label><br /> 

<?php  
  echo '<button type="submit" id="user_submit">Add</button><br />   
	 	<input type="hidden" name="id" value="' . $id . '" />
    
</form>  '

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