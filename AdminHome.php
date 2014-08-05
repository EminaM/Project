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
<title>Library Options</title>
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
  
  <div id="adminMain">
    <h1 id="dearAdmin">Dear administrator, welcome to the Library of SSST</h1> 
    <h2 id="allowed">You are allowed to change and modify data about the users and content of the library.</h2>             
  </div>
  
  
  <ul id="adminMenu">
  <li id="nav-lt"><a href="AddUser.php" target="_blank">Add user</a></li>
  <li><a href="SearchUser.php" target="_blank">Search user</a></li>
  <li><a href="AllUsers.php" target="_blank">All users</a></li>
  <li><a href="IssueBook.php" target="_blank">Issue book</a></li>
  <li id="nav-rt"><a href="IssuedBooks.php" target="_blank">Issued books</a></li><br /><br />
  <li id="nav-lb"><a href="AddBook.php" target="_blank">Add book</a></li>
  <li><a href="SearchBook.php" target="_blank">Search book</a></li>
  <li><a href="AllBooks.php" target="_blank">All books</a></li>  
  <li><a href="AddPeople.php" target="_blank">Add people</a></li>
  <li id="nav-rb"><a href="AllPeople.php" target="_blank">All people</a></li>
  </ul>  
  
  <table id="optionTable">
  <tr>
  <td class="adminOptionsCells"><a href="AddUser.php" target="_blank"><img src="add_user.png" title="Add user"></a></td>
  <td class="adminOptionsCells"><a href="SearchUser.php" target="_blank"><img src="search_user.png" title="Search user"></a></td>
  <td class="adminOptionsCells"><a href="AllUsers.php" target="_blank"><img src="all_users.png" title="All users"></a></td>
  <td class="adminOptionsCells"><a href="IssueBook.php" target="_blank"><img src="issue_book.png" title="Issue book"></a></td>
  <td class="adminOptionsCells"><a href="IssuedBooks.php" target="_blank"><img src="issued_books.png" title="Issued books"></a></td>
  </tr>  
  <tr>
  <td class="adminOptionsCells"><a href="AddBook.php" target="_blank"><img src="add_book.png" title="Add book"></a></td>
  <td class="adminOptionsCells"><a href="SearchBook.php" target="_blank"><img src="search_book.png" title="Search book"></a></td>
  <td class="adminOptionsCells"><a href="AllBooks.php" target="_blank"><img src="all_books.png" title="All books"></a></td>
  <td class="adminOptionsCells"><a href="AddPeople.php" target="_blank"><img src="add_people.png" title="Add people"></a></td>
  <td class="adminOptionsCells"><a href="AllPeople.php" target="_blank"><img src="all_people.png" title="All people"></a></td>
  </tr> 
  </table>
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