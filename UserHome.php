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
<title>SSST Library - Welcome</title>
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
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="UserHome.php">Home</a></li>
  <li><a href="AboutUs.php">About Us</a></li>
  <li><a href="Services.php">Services</a></li>
  <li><a href="Books.php">Books</a></li>
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
    <h1 style="padding:0px;" id="welcome">Dear <?php echo $_SESSION['user_name']?>, welcome to the Library of SSST</h1> 
    
    <div style="border:1px #BDC5CD solid; padding:20px; margin-top:15px; border-radius:10px; font-size:22px; line-height:40px;">
    
<?php
  	require ('mysqli_connect.php'); 

	$id = $_SESSION['user_id'];
		
		$q = "SELECT user_id as id, user_name as name, user_surname as surname, student_id as sid, user_dob as dob, user_address as address, user_city as city, user_mobile as mobile, user_year as year, user_department as dept, user_password as password, DATE_FORMAT(registration_date, '%d %m %Y') AS dr FROM users WHERE user_id = '$id'";	
		
        $r = @mysqli_query ($dbc, $q);		
        $num = mysqli_num_rows($r);

if ($num = 1) { 
	
	$q1 = "SELECT TO_DAYS(br.date_deadline)-TO_DAYS (NOW()) as remain, b.book_title as title, DATE_FORMAT(br.date_deadline, ' %d %M %Y') AS deadline FROM users  as u, borrowings as br, books as b WHERE u.user_id = br.user_id AND br.book_id = b.book_id AND u.user_id = '$id' AND br.date_returned IS NULL";
	
	$r1 = @mysqli_query ($dbc, $q1);		
        $num1 = mysqli_num_rows($r1);

if ($num1 > 0) { 

	while ($row1 = mysqli_fetch_array($r1, MYSQLI_ASSOC)) {
		echo '<p><img style="margin-right:10px;" src="comment.png" /><strong style="color:green;">TAKEN BOOKS:</strong> ' . $row1['title'] . '  <strong> (DEADLINE: </strong>' . $row1['deadline'] . ')<br />
		You have <strong>' . $row1['remain'] . '</strong> days to return book ' . $row1['title'] . '</p>';		
	} 	
	
	mysqli_free_result ($r1); 

} else {
	echo '<p><img style="margin-right:10px;" src="comment.png" /><strong style="color:green;">You have no issued books currently.</strong></p>';
}

$q2 = "SELECT b.book_title AS title, DATE_FORMAT(r.reservation_date, '%d %M %Y') AS date FROM reservations as r, books as b, users as u WHERE u.user_id = r.user_id AND r.book_id = b.book_id AND u.user_id = '$id'";
	
	$r2 = @mysqli_query ($dbc, $q2);		
        $num2 = mysqli_num_rows($r2);

if ($num2 > 0) { 

	while ($row2 = mysqli_fetch_array($r2, MYSQLI_ASSOC)) {
		echo '<p><img style="margin-right:10px;" src="comment.png" />You have reserved book <strong> ' . $row2['title'] . '</strong> on date ' . $row2['date'] . '.</p>';		
	} 
	}else {
	echo '<p><img style="margin-right:10px;" src="comment.png" /><strong style="color:green;">You have no reserved books currently.</strong></p>';
	}

}

echo '<br /><br /><p id="abcd" style="border-radius:10px; display:inline; margin-left:170px; padding:10px 44px 10px 44px; background-color:#DC6264; box-shadow: 0 0 3px #F4E4E5 inset;"><a  href="Account.php"><strong style="color:white;">Check your account</strong></a></p><br/><br />';
	
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
