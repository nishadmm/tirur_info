<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
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
      $user = "<div class='login-show'><span class='primary-head'>Login By : </span>$usr</div>";
      $user1 = "<div class='login-show'><span>Login By : </span>$usr</div>";
    } 
    mysql_close($con);
?>

<?php
  // define variables and set to empty values
	$usernameErr = $shopnameErr = $shopcatErr = $passErr =  $locErr = $mobileErr = "";
	$username = $shopname = $shopcat = $pass = $loc = $mob = "";
	$error = $starerr = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$password=$_POST["password"];
		$mobile=$_POST["mobile"];

		//  for check usernames
		$un=$_POST["username"];
		$con = mysql_connect("sql210.epizy.com","epiz_28028131","SqVAZ3d6gRX");
		mysql_select_db ( "epiz_28028131_tirurinfo" , $con );
		$sql = "select username from usertable";
		$result = mysql_query($sql);

		while($row=mysql_fetch_array($result)){
			if($row['username'] == $un) {
				$error = "This username is already used... !";
			}
		} 
		mysql_close($con);

    //  Empty checking
		if ( empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["shopname"]) || empty($_POST["shopcategory"]) || empty($_POST["location"]) || empty($_POST["mobile"])) {
      $error = "Please Fill All The Fields !";
      $starerr = "*";
  }elseif (strlen($password) < '8') {

    // Password checking
      $passErr = " * Your Password Must Contain At Least 8 Characters!";
  }elseif(!preg_match("#[0-9]+#",$password) || !preg_match("#[A-Z]+#",$password) || !preg_match("#[a-z]+#",$password)) {
      $passErr = " * Your Password Must Contain At Least 1 Number, 1 Capital Letter, 1 Lowercase Letter !";          
  } elseif(strlen($mobile) != '10') {

    // Phone number checking
    $moblen = strlen($mobile);

    $mobileErr = " * Your Mobile Number has $moblen Letters, Please check";
  }elseif($error == "This username is already used... !") {
      echo"Used Username";
  }else {
    $un=$_POST["username"];
    $pd=$_POST["password"];
    $sn=$_POST["shopname"];
    $ln=$_POST["location"];
    $sc=$_POST["shopcategory"];
    $mb=$_POST["mobile"];

    $con = mysql_connect("sql210.epizy.com","epiz_28028131","SqVAZ3d6gRX");
	mysql_select_db ( "epiz_28028131_tirurinfo" , $con );
    $sql="insert into usertable (username,password) values ('$un','$pd')";
    mysql_query($sql,$con);
    mysql_close($con);

    $con = mysql_connect("sql210.epizy.com","epiz_28028131","SqVAZ3d6gRX");
	mysql_select_db ( "epiz_28028131_tirurinfo" , $con );
    $sql1="insert into shoptable (shopname,shopcategory,location,mobile) values ('$sn','$sc','$ln','$mb')";
    mysql_query($sql1,$con);
    mysql_close($con);
    
    session_start();
    $_SESSION["profilesignin"] = true;
    $_SESSION["login"] = true;
    $_SESSION["reset"] = false;
    $_SESSION["update"] = false;

    header('Location: profile_login.php');
  }
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
  <title>Tirur_Info_SignIn</title>
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
  <div class="mob-drop-down">
    <ul>
    <li><a href="#">
          <div class="show-us">
            <?php echo $user1; ?>
          </div> Sigin <i class="fas fa-angle-down"></i>
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
  <div class="profile-grid dark-text">
    <div class="side-menu">
      <h2 class="uppercase">Your <span class="primary-head"> Profile <i class="fas fa-user"></i></span></h2>
      <?php echo $user; ?>
      <a href="profile_login.php" class="a"> <span>Login </span> <i class="fas fa-sign-in-alt"></i></a>
      <a href="profile_signin.php" class="side-selected">SignUp <i class="fas fa-user-plus"></i></a>
      <a href="profile_profile.php" class="a">Profile <i class="fas fa-address-card"></i></a>
      <a href="profile_update.php" class="a">Update <i class="fas fa-pen-square"></i></a>
      <a href="profile_resetpassword.php" class="a">Reset Password <i class="fas fa-key"></i></a>
      <a href="profile_report.php" class="a">Report <i class="fas fa-book-open"></i></a>
      <a href="profile_logout.php" class="a">LogOut <i class="fas fa-user-slash"></i></a>
    </div>
    <div class="signin-form reg-form">
      <div class="form-container box-shadow">
        <h2 class="center uppercase pbt-1"><i class="fas fa-store"></i> shop <span class="primary-head"> registration
            form</span></h2>
        <div class="bottom-line"></div>
        <p class="center pbt-1 lead signin-lead form-link">You have no Shop ? <a href="profile_signup_noshop.php">SignUp
            without
            shop</a></p>

        <!-- Form -->
        <form action="profile_signin.php" method="POST" id="reg-form">
          <div class="message mbt-1 center">
            <?php echo $error; ?>
          </div>
          <div class="input-container">
            <label>User Name <span class="star-error error">
                <?php echo"$starerr";?>
              </span></label>
            <input class="profile-input" name="username" type="text">
          </div>
          <div class="input-container">
            <label>Shop Name <span class="star-error error">
                <?php echo"$starerr";?>
              </span></label>
            <input class="profile-input" type="text" name="shopname">
          </div>
          <div class="input-container">
            <label>Select Shop Category</label>
            <select name="shopcategory">
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
          <div class="input-container">
            <label>Password <span class="star-error error">
                <?php echo"$starerr";?>
              </span></label>
            <input class="profile-input" type="password" name="password">
            <div class="input-error error">
              <?php echo"$passErr";?>
            </div>
          </div>
          <div class="input-container">
            <label>Select Location</label>
            <select name="location" class="">
              <option value="BP Angadi">BP Angadi</option>
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
          <div class="input-container">
            <label>Mobile Number <span class="star-error error">
                <?php echo"$starerr";?>
              </span></label>
            <input class="profile-input" type="number" name="mobile">
            <div class="input-error error">
              <?php echo"$mobileErr";?>
            </div>
          </div>
          <input type="submit" name="submit" class="profile-btn" value="Register Shop &#9930;">
        </form>
        <div>
          <p class="lead center mbt-1 form-link">Already have a account? <a href="profile_login.php"> Log In</a></p>
        </div>
      </div>
    </div>
    <!-- right side bar -->
    <div class="right-sidebar pbt-3">
      <!-- contact box -->
      <div class="contact-box white-text p-2">
        <h2 class="center uppercase pb-1">Contact <i class="fas fa-id-card-alt"></i></h2>
        <p class="lead center pb-1"> <span id="contact-sub-para">The one of the most important is you get whole report
            of shops in tirur and get PDF of shops
            details.If you have no account in tirur
            info then SignUp.</span> You have any Doubt about this particular page ? for our help please contact with
          US.
        </p>
        <a href="contact.html" class="profile-btn">Conatct</a>
      </div>
      <div class="slide-container box-shadow">
        <div class="box">
          <!-- slide-5 -->
          <div class="slide slide-5 flex-center">
            <div class="p-2 join-box white-text">
              <a href="index.html" class="header">
                <img src="img/icon.png" alt="Logo" class="logo">
                <h1 class="text-shadow">Tirur Info</h1>
              </a>
            </div>
          </div>
          <!-- slide-4 -->
          <div class="slide slide-4 flex-center">
            <div class="p-2 join-box white-text">
              <img src="img/dev.jpeg" alt="owner">
              <h3 class="uppercase pb-1 center">Developer <i class="fas fa-laptop-code"></i></h3>
              <p class="mbt-1">I Am Nishad Specialized In Programming, Web developing, Designing...</p>
              <a href="aboutOwner.html" class="btn">Know More <i class="fas fa-angle-double-right"></i></a>
            </div>
          </div>
          <!-- slide-1 -->
          <div class="slide slide-1 p-1 flex-center">
            <h2 class="center pbt-1">TIRUR INFO</h2>
            <h3 class="badge">Best site <i class="fas fa-check-circle"></i></h3>
            <p class="mbt-1">You get any shop deatils with phone number, location...you can get this facilities when
              you login your
              account...If you have alrady an account in tirur info then SignUp</p>
            <a href="profile_login.php" class=" dark-btn btn">Log in <i class="fas fa-sign-in-alt"></i></a>
          </div>
          <!-- slide-2 -->
          <div class="slide slide-2 flex-center">
            <div class="p-2 join-box white-text">
              <h3 class="uppercase pb-1 center">Join With US</h3>
              <p>you want the shops information in tirur ? then just join with us to get all information to make your
                life easy...</p>
              <a href="profile_login.php" class="btn">Jion Now <i class="fas fa-link"></i></a>
            </div>
          </div>
          <!-- slide-3 -->
          <div class="slide slide-3 flex-center">
            <div class="p-2 join-box white-text">
              <h3 class="uppercase pb-1 center">What We Do</h3>
              <p>Actually we are collect all public datas of Tirur and store it...Then we provide that to you If you
                want that.</p>
              <a href="aboutorg.html" class="btn">About US <i class="fas fa-globe"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- index sectios -->
  <!-- Section d -->
  <div class="section-d">
    <div class="what-do">
      <h1><span class="primary-head"> What</span> We Do <i class="fas fa-door-open"></i></h1>
      <div class="what-do-grid">
        <div>
          <h2><i class="fas fa-folder-open"></i></h2>
          <div id="about-us">
            <h4>Store Tirur Datas</h4>
            <p>Actually we are collect all public datas of Tirur and store it...Then we provide that to you If you
              want
              that.</p>
          </div>
        </div>
        <div>
          <h2><i class="fas fa-shopping-cart"></i></h2>
          <div>
            <h4>Make easy Your Pusrchase</h4>
            <p>Now we all are in panic situation. So we give the whole information of shops to make your purchase easy
              like home delivery.</p>
          </div>
        </div>
        <div>
          <h2><i class="fas fa-hands"></i></h2>
          <div>
            <h4>All in Your Hand</h4>
            <p>You get any shop deatils with phone number, location...you can get this facilities when you login your
              account.</p>
          </div>
        </div>
      </div>
      <div class="who-we">
        <img src="img/wecps5.jpg" alt="Team">
        <div id="who-we-text">
          <h1><span class="primary-head">Who</span> We Are <i class="fas fa-spa"></i></h1>
          <p> Now We are SSM polytechnic Computer Engineering final year students.This is our one of the most Project
            based on Tirur location. The idea of this is from our Ziyad Sir.Actually we are collect all public datas
            of
            Tirur and store it.Then we provide that to you If you want.</p>
          <div>
            <h3>Our Team <i class="fas fa-users"></i></h3>
            <ul>
              <li><a href="aboutOwner.html">Nishad.m.m : Developer</a></li>
              <li> Johnsan : Manager</li>
              <li> Mark smith : Assistant Dev</li>
              <li> Jackson : Lead Accountant</li>
            </ul>
          </div>
        </div>
      </div>
    </div>


    <!-- Section-c -->
    <div class="section-c">
      <h2>Gallery <i class="far fa-images"></i></h2>
      <p>Check out some Photos of Tirur</p>
      <div class="items">
        <div class="item">
          <div class="item-image">
            <img src="img/shop-img/okkashi-cakecafe-coffee-shops-.jpg" alt="photo">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">Okkashi</p>
              <h2 class="item-text-title">cakecafe-coffee-shops</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/shop-img/shiza-fashion-centre-readymade.jpg" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">shiza-fashion</p>
              <h2 class="item-text-title">Textile-Readymade</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/shop-img/Robesta-restaurent.jpg" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">Robesta</p>
              <h2 class="item-text-title">Five Start Restaurent</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/shop-img/thunjan-paramb.jpg" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">Historical Area</p>
              <h2 class="item-text-title">Thunjan Paramb</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/shop-img/malabar-gold.jpg" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">Malabar Gold</p>
              <h2 class="item-text-title">Gold & Diamonds</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/shop-img/mobile-mate.webp" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">Mobile course institute</p>
              <h2 class="item-text-title">Mobile Mate</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/shop-img/aak mall.png" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">Tirur Mall</p>
              <h2 class="item-text-title">AAK Mall</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/items/item8.png" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">web applications</p>
              <h2 class="item-text-title">restaurant app</h2>
            </div>
          </div>
        </div>
        <div class="item">
          <div class="item-image">
            <img src="img/items/item9.png" alt="">
          </div>
          <div class="item-text">
            <div class="item-text-wrap">
              <p class="item-text-category">social network concept</p>
              <h2 class="item-text-title">friend feed</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Section e -->
    <div class="section-e">
      <div class="section-e-header">
        <h1><span class="primary-head">About</span> Tirur <i class="fas fa-city"></i></h1>
        <div class="bottom-line"></div>
      </div>
      <div>
        <h4>Colleges <i class="fas fa-graduation-cap"></i></h4>
        <div class="progress">
          <div style="width: 90%;"></div>
        </div>
      </div>
      <div>
        <h4>Schools <i class="fas fa-school"></i></h4>
        <div class="progress">
          <div style="width: 95%;"></div>
        </div>
      </div>
      <div>
        <h4>Shops <i class="fas fa-shopping-bag"></i></h4>
        <div class="progress">
          <div style="width: 80%;"></div>
        </div>
      </div>
      <div>
        <h4>Crimes <i class="fas fa-skull-crossbones"></i></h4>
        <div class="progress">
          <div style="width: 40%;"></div>
        </div>
      </div>
      <div>
        <h4>Naturality <i class="fas fa-dungeon"></i></h4>
        <div class="progress">
          <div style="width: 90%;"></div>
        </div>
      </div>
      <div>
        <h4>Villages <i class="fas fa-home"></i> </h4>
        <div class="progress">
          <div style="width: 70%;"></div>
        </div>
      </div>
      <div class="btns">
        <a href="feedback.html" class="btn">send Feedback <i class="fas fa-comments"></i></a>
        <a href="aboutOwner.html" class="btn">About Developer <i class="fas fa-user-shield"></i></a>
        <a href="aboutorg.html" class="btn">About Oraganisation <i class="fas fa-globe"></i></a>
      </div>
    </div>

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