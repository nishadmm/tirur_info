<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
	$con = mysql_connect("sql210.epizy.com","epiz_28028131","SqVAZ3d6gRX");
	if (!$con)
	{
		die('Could Not Connect..' . mysql_error() );
  	}
	mysql_select_db ( "epiz_28028131_tirurinfo" , $con );
		if($_SESSION["un"]==false)
    {
      $user = "";
    } else {
      $usr=$_SESSION["un"];
      $user = "<div class='login-show'><span class='primary-head'>Login By : </span>$usr</div>";;
    } 
    mysql_close($con);
?>

<?php
  session_start();              
  if($_SESSION["un"]==false){
    $_SESSION["reportlogin"] = true;
    header('location:profile_login.php');
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Hammersmith+One&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/profile.css">
  <link rel="stylesheet" href="css/mobile.css">
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
  <title>Tirur_Info_Report</title>
</head>

<body>
  <div class="secondary-container">
    <!-- section-a -->
    <div class="section-a">
      <nav id="navbar">
        <a href="index.html" class="header">
          <img src="img/icon.png" alt="Logo" class="logo">
          <h1 class="text-shadow">Tirur Info</h1>
        </a>
        <div class="secondary-nav">
          <ul>
            <li><a href="index.html" class="unselected"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="" class="selected">Your Profile <i class="fas fa-user-circle"></i></a></li>
          </ul>
        </div>
      </nav>
    </div>
  </div>

  <!-- section b -->
  <!-- Drop down menu for mobile -->
  <div class="mob-drop-down repo-drop">
    <ul>
      <li><a href="#">
          <div class="show-us">
            <div class='login-show'><span>Login By : </span>
              <?php echo $usr; ?>
            </div>
          </div> Report <i class="fas fa-angle-down"></i>
        </a>
        <ul>
          <li><a href="profile_login.php"> <span>Login </span> <i class="fas fa-sign-in-alt"></i></a>
          </li>
          <li> <a href="profile_signin.php">SignUp <i class="fas fa-user-plus"></i></a></li>
          <li><a href="profile_profile.php">Profile <i class="fas fa-address-card"></i></a></li>
          <li><a href="profile_update.php">Update <i class="fas fa-pen-square"></i></a></li>
          <li> <a href="profile_resetpassword.php">Reset Password <i class="fas fa-key"></i></a></li>
          <li><a href="profile_report.php">Report <i class="fas fa-book-open"></i></a></li>
          <li><a href="profile_logout.php">LogOut <i class="fas fa-user-slash"></i></a></li>
        </ul>
      </li>
    </ul>
  </div>
  <div class="report-grid dark-text">
    <div class="side-menu repo-side-menu">
      <h2 class="uppercase">Your <span class="primary-head"> Profile <i class="fas fa-user"></i></span></h2>
      <?php echo $user; ?>
      <a href="profile_login.php" class="a"> <span>Login </span> <i class="fas fa-sign-in-alt"></i></a>
      <a href="profile_signin.php" class="a">SignUp <i class="fas fa-user-plus"></i></a>
      <a href="profile_profile.php" class="a">Profile <i class="fas fa-address-card"></i></a>
      <a href="profile_update.php" class="a">Update <i class="fas fa-pen-square"></i></a>
      <a href="profile_resetpassword.php" class="a">Reset Password <i class="fas fa-key"></i></a>
      <a href="profile_report.php" class="side-selected">Report <i class="fas fa-book-open"></i></a>
      <a href="profile_logout.php" class="a">LogOut <i class="fas fa-user-slash"></i></a>
    </div>
    <div>
      <h2 id="table-heading" class="mbt-1 center"><span class="primary-head">Tirur All Shop Information <i
            class="fas fa-book-open"></i></span></h2>
      <div class="bottom-line"></div>

      <form method="POST" action="profile_create_pdf.php">
        <input type="submit" class="profile-btn pdf-btn" value="Generate PDF &#9851;" name="create_pdf">
        <p class="pdf-message">You can't Generate PDF on this device...Please use a computer to generate PDF.</p>
      </form>

      <form action="profile_report.php" method="POST" class="filter-form">
        <div class="filter-area">
          <div class="filter-item">
            <label class="filter-label">Select Location</label>
            <select name="location" class="filter">
              <option value="Tirur">All Place</option>
              <option value="BP Angadi">BP Angadi</option>
              <option value="tirur">Tirur</option>
              <option value="Payyanangadi">Payyanangadi</option>
              <option value="Thalakadathur">Thalakadathur</option>
              <option value="Vailathur">Vailathur</option>
              <option value="Pookayil">Pookayil</option>
              <option value="Moochikkal">Moochikkal</option>
              <option value="Moolakkal">Moolakkal</option>
              <option value="Ezhur">Ezhur</option>
              <option value="Pullur">Pullur</option>
              <option value="Thuvakkad">Thuvakkad</option>
              <option value="kalpakanjeri">kalpakanjeri</option>
              <option value="Alathiyur">Alathiyur</option>
              <option value="Pariyapuram">Pariyapuram</option>
              <option value="Vettom">Vettom</option>
              <option value="Thazhepalam">Thazhepalam</option>
              <option value="Thrikandiyoor">Thrikandiyur</option>
              <option value="Chembra">Chembra</option>
              <option value="Gulf market">Gulf market</option>
              <option value="Palakkavalppil">Palakkavalppil</option>
              <option value="Naduvilangadi">Naduvilangadi</option>
              <option value="Vakkad">Vakkad</option>
              <option value="Thirunavaya">Thirunavaya</option>
              <option value="Triprangode">Triprangode</option>
              <option value="Chamravattam">Chamravattam</option>
              <option value="Purathur">Purathur</option>
              <option value="Kavanchery">Kavanchery</option>
              <option value="Ashupathripadi">Ashupathripadi</option>
              <option value="Vengad">Vengad</option>
              <option value="Paravanna">Paravanna</option>
              <option value="Pachattiri">Pachattiri</option>
              <option value="Pookkayil">Pookkayil</option>
              <option value="Moochikel">Moochikel</option>
              <option value="Tanalur">Tanalur</option>
              <option value="Pakara">Pakara</option>
              <option value="Vattathani">Vattathani</option>
              <option value="Ozhur">Ozhur</option>
              <option value="Kaattilanagadi">Kaattilanagadi</option>
              <option value="Panagattur">Panagattur</option>
              <option value="Kodinhi">Kodinhi</option>
              <option value="Palathingal">Palathingal</option>
              <option value="Keeranallur">Keeranallur</option>
              <option value="Pantharangadi">Pantharangadi</option>
              <option value="Moonniyur">Moonniyur</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="filter-item">
            <label class="filter-label">Select Shop Category</label>
            <select name="shopcategory" class="filter">
              <option value="all">All Category</option>
              <option value="Textiles">Textiles</option>
              <option value="Mobile shop">Mobile shop</option>
              <option value="Fancy shop">Fancy shop</option>
              <option value="Ornaments shop">Ornaments shop</option>
              <option value="Bakery">Bakery</option>
              <option value="Hotel">Hotel</option>
              <option value="Hardaware Shop">Hardaware Shop</option>
              <option value="Cool bar">Cool bar</option>
              <option value="Woodwork shop">Woodwork shop</option>
              <option value="Medical shop">Medical shop</option>
              <option value="Gold & Dialmonds">Gold & Dialmonds</option>
              <option value="Workshop">Workshop</option>
              <option value="Super market">Super market</option>
              <option value="Aryavaydhya Shala">Aryavaydhya Shala</option>
              <option value="Akshaya Center">Akshaya Center</option>
              <option value="Sports shop">Sports shop</option>
              <option value="Footwear shop">Footwear shop</option>
              <option value="Beauty parler">Beauty parler</option>
              <option value="Vegitable shop">Vegitable shop</option>
              <option value="Meal shop">Meal shop</option>
              <option value="Haircut shop">Haircut shop</option>
              <option value="LIC">LIC</option>
              <option value="Rent shop">Rent shop</option>
              <option value="Vehicle rent shop">Vehicle rent shop</option>
              <option value="Tailoring shop">Tailoring shop</option>
              <option value="Tea shop">Tea shop</option>
              <option value="Hyper Market">Hyper Market</option>
              <option value="Electronic shop">Electronic shop</option>
              <option value="Electronic Repair">Electronic Repair</option>
              <option value="Book stall">Book stall</option>
              <option value="Lottery Shop">Lottery Shop</option>
              <option value="GYM">GYM</option>
              <option value="Chicken stall">Chicken stall</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <input type="submit" name="search" value="Search &#10148;" class="btn search-btn">
        </div>
      </form>

      <table id="table">
        <thead>
          <tr>
            <th>SHOPS</th>
            <th>Shop name</th>
            <th>Shop category</th>
            <th>Location</th>
            <th>Phone number</th>
          </tr>
        </thead>
</body>

</html>

<?php

if (isset($_POST["search"])) {

		$location=$_POST["location"];
		$category=$_POST["shopcategory"];
    $noshop= "No shop";

		$con = mysql_connect("sql210.epizy.com","epiz_28028131","SqVAZ3d6gRX");
	    mysql_select_db ( "epiz_28028131_tirurinfo" , $con );

		if($location == "Tirur" && $category == "all") {

			$result = mysql_query ( "SELECT * FROM shoptable where shopcategory!='".$noshop."'" );
			
		}else{

			if($location == "Tirur") {

				$result = mysql_query ( "SELECT * FROM shoptable where shopcategory='".$category."' and shopcategory!='".$noshop."'");

			}else{

				if($category == "all") {

					$result = mysql_query ( "SELECT * FROM shoptable where location='".$location."' and shopcategory!='".$noshop."'" );

				}else {

					$result = mysql_query ( "SELECT * FROM shoptable where location='".$location."' and shopcategory='".$category."' and shopcategory!='".$noshop."'" );
				}	
			}
		}	

		while ( $row = mysql_fetch_array ( $result ) )	
		{
			echo "<tbody>";	
			echo "<tr>";	
				echo "<td>";
						echo "&#8680";
				echo "</td>";
				echo "<td>";
						echo $row['shopname'];
				echo "</td>";
				echo "<td>";
					echo $row['shopcategory'];
				echo "</td>";
				echo "<td>";
					echo $row['location'];
				echo "</td>";
				echo "<td>";
					echo $row['mobile'];
				echo "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>"; 
		
	mysql_close($con);
	
}else {

	$con = mysql_connect("sql210.epizy.com","epiz_28028131","SqVAZ3d6gRX");
	mysql_select_db ( "epiz_28028131_tirurinfo" , $con );
  $noshop= "No shop";

	$result = mysql_query ( "SELECT * FROM shoptable where shopcategory!='".$noshop."'" );

	while ( $row = mysql_fetch_array ( $result ) )
	{
		echo "<tbody>";	
		echo "<tr>";	
			echo "<td>";
					echo "&#8680";
			echo "</td>";
			echo "<td>";
					echo $row['shopname'];
			echo "</td>";
			echo "<td>";
				echo $row['shopcategory'];
			echo "</td>";
			echo "<td>";
				echo $row['location'];
			echo "</td>";
			echo "<td>";
				echo $row['mobile'];
			echo "</td>";
		echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";

	mysql_close($con);
}
echo"</div>";
echo"</div>";
?>

<html>

<body>
  <!-- footer -->
  <footer class="section-f" id="main-footer">
    <div class="social-media">
      <a href="https://www.facebook.com/" target="_blank"> <i class="fab fa-facebook-square"></i> Facebook</a>
      <a href="https://twitter.com/NISHADMM5" target="_blank"> <i class="fab fa-twitter"></i> Twitter</a>
      <a href="https://www.youtube.com/" target="_blank"> <i class="fab fa-youtube"></i> Youtube</a>
      <a href="https://www.instagram.com/nishad_amigoz/" target="_blank"> <i class="fab fa-instagram"></i>
        Instagram</a>
    </div>
    <div>
      <h3>Email Newsletter</h3>
      <p>If you want to get notifications of tirurinfo then just enter your email...</p>
      <input type="email" placeholder="Enter Email...">
      <p class="footer-btn">Subscribe</p>
    </div>
    <div>
      <h3>Site links</h3>
      <div class="site-links">
        <a href="profile_login.php">Login</a>
        <a href="aboutOwner.html">About Owner</a>
        <a href="contact.html">Contact</a>
        <a href="profile_report.php">Shop Report</a>
      </div>
    </div>
    <div id="join-footer-box">
      <h3>Join our club</h3>
      <p>you want the shops information in tirur ? then just join with us to get all information to make your life
        easy...</p>
      <a href="profile_login.php" class="footer-btn">Jion Now</a>
    </div>
    <div>
      <h6>Copyright &copy; 2021, All Rights Reserved</h6>
    </div>
  </footer>

</body>

</html>