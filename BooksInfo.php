<?php session_start();

if($_SESSION['loggedin'] !== true){
	 header('Location:Login.php');
		 exit();	
}

?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="device=device-width, initial-scale=1.0, max-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<title>SSST Library - Books</title>
<link rel="shortcut icon" href="images1.png" type="image/png">
<link rel="shortcut icon" href="images1.jpg" type="image/jpg">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="galleria/galleria-1.3.3.min.js"></script>
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
  <th><a href="http://www.ssst.edu.ba/" target="_blank"><img id="logo" src="logo_blue_red_SSST.jpg" alt="SSST logo" title="Home" /></a></th>
  <th><a id="title1" href="#"><h1 id="title">Library</h1></a></th>
  </tr>
  </table>
  
  <ul id="userMenu">
  <li id="home"><a id="home1" href="UserHome.php">Home</a></li>
  <li><a href="AboutUs.php">About Us</a></li>
  <li><a href="Services.php">Services</a></li>
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="Books.php">Books</a></li>
  <li><a href="Gallery.php">Gallery</a></li>
  <li><a href="Contact.php">Contact</a></li>
  </ul> 
   
  <div id="left">
  
  <div class="nav-user">
	    <ul>
	        
	        <li><a href="Account.php" id= "nav-first">Account</a></li>
	        <li><a href="SearchBookUser.php" id="nav-second">Search book</a></li>
	        <li><a href="ReserveBook.php"id="nav-fourth" >Reserve book</a></li>
	        <li><a href="ChangePassword.php"id="nav-fift">Change password</a></li>
	        <li><a id="nav-last" href="logout.php">Log out</a></li>
	        
	    </ul>
        </div>
        
        <div style="margin-top:50px;" id="together">
        <p style="display:inline; font-size:25px; letter-spacing:5px;">NEW BOOKS</p>
        <div class="galleria">
        
            <img src="Knjige za biblioteku/Calculus.jpg" data-title="Calculus Early Transcendentals" data-description="Mathematics">
            <img src="Knjige za biblioteku/DatabasePrinciples.jpg" data-title="Database Principles" data-description="Databases">
            <img src="Knjige za biblioteku/DiscreteMathematics.JPG" data-title="Discrete Mathematics" data-description="Mathematics">
            <img src="Knjige za biblioteku/HTML5andCSS3.jpg" data-title="HTML5 and CSS3" data-description="Web">
            <img src="Knjige za biblioteku/IntroToComputingSystems.jpg" data-title="Introduction to Computing Systems" data-description="Computer Architecture">
            <img src="Knjige za biblioteku/IntroToProgrammingWithC++.jpg" data-title="Introduction to Programming with C++" data-description="Programming">
            <img src="Knjige za biblioteku/Java.jpg" data-title="Java" data-description="Programming">
            <img src="Knjige za biblioteku/LinearAlgebra.jpg" data-title="Linear Algebra and Its Applications" data-description="Mathematics">
            <img src="Knjige za biblioteku/PHPForTheWeb.jpg" data-title="PHP for the Web" data-description="Web">
            <img src="Knjige za biblioteku/PrinciplesOfInformationSystems.JPG" data-title="Principles of Information Systems" data-description="Information Systems">
            <img src="Knjige za biblioteku/SchritteInternational1.jpg" data-title="Schritte International 1" data-description="Language">
            <img src="Knjige za biblioteku/SchritteInternational2.jpg" data-title="Schritte International 2" data-description="Language">
            <img src="Knjige za biblioteku/SchritteInternational3.jpg" data-title="Schritte International 3" data-description="Language">            
            
        
        <script>
            Galleria.loadTheme('galleria/themes/classic/galleria.classic.min.js');
			Galleria.configure({
    transition: 'fade',
    imageCrop: true,
	lightbox: true,
	
});
            Galleria.run('.galleria', {
    autoplay: 6000});
        </script>    
  
  </div>      
	</div>
    
    </div>
    
    <div id="right">
   <h1 style="padding:0px;" id="welcome">Book information</h1>   

<div style="border:1px #BDC5CD solid; padding:30px; margin-top:15px; border-radius:10px; font-size:22px; line-height:40px;">
      	<a href="Books.php" title="Back"><img style="float:right;" src="back _small.png"></a><br />


    
    <?php 

$id = $_GET['id'];

require ('mysqli_connect.php');
	
		$q = "SELECT ISBN, book_title, book_subtitle, book_edition, book_publisher, year_published, number_of_pages, number_of_copies, book_field, number_of_authors, DATE_FORMAT(date_registered, '%d %M %Y') FROM books WHERE book_id=$id ";		
		$r = @mysqli_query ($dbc, $q);
		$num = mysqli_num_rows($r);
		if ($num == 1) {
			$row = mysqli_fetch_array($r);

			 echo '<p><div><strong>ISBN:</strong> ' . $row[0] . '<br /></div><strong>Title:</strong> ' . $row[1] . '<br /><strong>Subtitle: </strong>' . $row[2] . '<br /><strong> Edition:</strong> ' . $row[3] . '<br /><strong>Publisher:</strong> ' . $row[4] . '<br /><strong>Year Published:</strong> ' . $row[5] . '<br /><strong>Number of Pages:</strong> ' . $row[6] . '<br/><strong>Number of Copies (available):</strong> ' . $row[7] . '<br /><strong>Field: </strong>' . $row[8] . '<br /><strong>Number of Authors: </strong>' . $row[9] . '<br /><div><strong>Date Registered: </strong>' . $row[10] . '</div>';
			 			 
		$q1="SELECT bbp.book_people_id as id, CONCAT( p.person_name,  ' ', p.person_surname ) AS editor FROM book_by_people AS bbp, books AS b, people AS p WHERE bbp.book_id = b.book_id AND bbp.person_id = p.person_id AND bbp.person_type = 'editor' AND b.book_id = $id";
	    $r1 = @mysqli_query ($dbc, $q1);
		$num1 = mysqli_num_rows($r1);
		if ($num1 == 1) {
			$row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC);
		echo '<div><strong>Editor:</strong> ' . $row1['editor'] . '<br /></div></p>';
		}
		
		$q2="SELECT bbp.book_people_id as id, CONCAT( p.person_name,  ' ', p.person_surname ) AS author FROM book_by_people AS bbp, books AS b, people AS p WHERE bbp.book_id = b.book_id AND bbp.person_id = p.person_id AND bbp.person_type = 'author' AND b.book_id = $id";
	    $r2 = @mysqli_query ($dbc, $q2);
		$num2 = mysqli_num_rows($r2);
		if ($num2 >= 1) {
			echo '<strong>Author(s): </strong>';
			while ($row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
		echo '<p>'. $row2['author'] . '</a></p> ';
			}
			echo '</p>';
		}
	} 
		
mysqli_close($dbc);
		
?>
    
  </div>
  </div>
  </div>
  
  <div id="footer">
    <div id="footer-inner">
      <a href="http://www.ssst.edu.ba/" target="_blank"><img id="logo2" src="2-new.png" alt="SSST Logo" /></a>
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
