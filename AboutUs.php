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
<title>SSST Library - About us</title>
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
  <li ><a href="UserHome.php">Home</a></li>
  <li style="background: -webkit-linear-gradient(top,#E1E9F2,white); box-shadow: 0 0 5px #ECEFF7 inset;"><a href="AboutUs.php">About Us</a></li>
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
    <h1 style="padding:0px;" id="welcome">About us</h1> 
    <p id="lib">    <img style="margin-bottom:20px;" src="DSC_0200.JPG" width="620" alt="Books"/>
The Library of Sarajevo School of Science and Technology aims to provide a personalized, high quality service to support the University's teaching and research programmes and to encourage the development of creative and independent thinking. Our goals are to promote excellence in learning, to support the information, research, and curriculum needs of the University through an effective, collaborative collection development and management program, as well as to serve as a gateway to sources of information vital for research and scholastic achievement.</br></br>
For question regarding both our on-line and in-house collections and resources please contact us every day from 10AM to 5PM.
</p> 

<div style="border:1px #BDC5CD solid; padding:20px; margin-top:15px; border-radius:10px;">
<img style="float:left; margin-right:20px;" src="Aida_Djikic.jpg" width="317" alt="Librarian" />
<p id="ab" style="margin-top:90px; font-size:20px; ">Aida Đikić <br />
Librarian <br />
+387 33 975 026 <br />
aida.djikic@ssst.edu.ba. <br /></p>
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
