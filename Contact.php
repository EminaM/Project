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
<title>SSST Library - Services</title>
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
  <li><a href="UserHome.php">Home</a></li>
  <li><a href="AboutUs.php">About Us</a></li>
  <li><a href="Services.php">Services</a></li>
  <li><a href="Books.php">Books</a></li>
  <li><a href="Gallery.php">Gallery</a></li>
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="Contact.php">Contact</a></li>
  </ul> 
  
  
  <div id="left">
  
  <div class="nav-user">
	    <ul>
	        
	        <li><a href="Account.php" id= "nav-first">Account</a></li>
	        <li><a href="SearchBookUser.php" id="nav-second">Search book</a></li>
	        <li><a href="Books.php"id="nav-fourth" >Collections</a></li>
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
    <h1 style="padding:0px;" id="welcome">Contact</h1> 
    
    <p style="text-align:center; background-image:url(logo.png); background-position:center; background-repeat:no-repeat; font-size:18px; line-height:30px; font-family:Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif; font-weight:lighter;" id="lib">University Sarajevo School of Science and Technology<br />
Hrasnička cesta 3a<br />
Sarajevo, 71 000<br />
Bosnia and Herzegovina<br />
+387 33 975 000<br />
Admissions: +387 33 975 001<br />
Reception: +387 33 975 004<br />
Fax: +387 33 975 030<br />
administration@ssst.edu.ba<br />
admissions@ssst.edu.ba<br /></p>
     
    
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
