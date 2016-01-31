<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
if($_SESSION['usern']) { header("Location: ./?m=statistics"); }
?>
<html dir="ltr" lang="en-US" xmlns="http://www.w3.org/1999/xhtml">

<head>
    
    <title>MMA PRO FIGHTER</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="css/reset.css"/> 
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic"/>
    <!--[if IEMobile]> 
    <link rel="stylesheet" type="text/css" href="css/iemobile.css"/>
    <![endif]--> 
    
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.easytabs.min.js"></script>
    <script type="text/javascript" src="assets/js/respond.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.isotope.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.carouFredSel.js"></script>
    <script type="text/javascript" src="assets/js/plugins.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>

    <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
</head>
    <body>
        <!-- Container -->
        <section id="container">
        
            <!-- Header -->
			<header> 
            	<!-- Logo -->
        
                <!-- /Logo -->
                

            </header>
            <!-- /Header -->
            
            <!-- Content -->
            <section id="content" >
            
                <!-- play -->
                <div id="play"> 
                 	<!-- About section -->
                	<div class="about">
                    	<div class="photo-inner">
                            <ul>
                                <li><img src="assets/imgs/photo.jpg" height="186" width="153" /></li>
                                <li><img src="assets/imgs/photo1.png" height="186" width="153" /></li>
                            </ul>
                        </div>
                        <h1>MMA PRO FIGHTER</h1>
                        <h3>Become a pro fighter.</h3>
                        <p>Be the first among the best players in the MMA fight without rules.</p>
                        <p>Participating in the mma/ufc events(mma underground), defeating opponents and become a top mma/ufc fighters. </p>
                    </div>
                    <!-- /About section -->
					<?php
						if(isset($_POST['do_login'])) {
                     $web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
					$url = $web['url'];
					$username = protect($_POST['username']);
					$password = protect($_POST['password']);
					$password = md5($password);

					$sql = mysql_query("SELECT * FROM users WHERE usern='$username' and passwd='$password'");
					if(mysql_num_rows($sql)>0) {
					$row = mysql_fetch_array($sql);
					if($row['status'] == 2) { echo '<span style="font-weight:bold;color:red;">'.$lang[account_blocked].'</span>'; }
					else {
					$_SESSION['usern'] = $row['usern'];
					$_SESSION['user_id'] = $row['id'];
					header("location:./?m=statistics");
				}
			} else {
					echo '<span style="font-weight:bold;color:red;">'.$lang[login_error].'</span> <a href="./#register">'.$lang[forgot_password].'</a>';
				}
				}
				?>
                    <!-- login section -->
                  <form action="" method="post">
                	    <ul class="login-info">
						    <li><label>Username:</label><span><input type="text" name="username" class="input" ></span></li>
                            <li><label>Password:</label><span><input type="password" name="password" class="input" ></span></li>
                  
                            <li><label>&nbsp;</label><span><input style="width:150px;height:40px" type="submit" name="do_login" value="submit" class="button transition"></span></li>
                        </ul>
                    </form>
                    <!-- /login section -->
                </div>        
                <!-- /play --> 
               
                <!-- Menu -->
                <nav class="menu">
                	<ul class="tabs">
                        <li class="tmenu"><a href="#play" class="tab-play"><i>&#xe0f5;</i>Play</a></li>
                        <li class="tmenu"><a href="#register"><i>&#xe17b;</i>Sign Up</a></li>
                        <li class="tmenu"><a href="#about"><i>&#xe035;</i>About</a></li>
                      
                    </ul>
                    <a class="prev" id="menu-prev" href="#">&#xe073;</a>
                    <a class="next" id="menu-next" href="#">&#xe076;</a>

                </nav>
                <!-- /Menu --> 
                
                <!-- about -->
                <section id="about">
                	 <div class="timeline-section">
                        <!-- Timeline for News  -->   
                        <h3 class="main-heading">Factions</h3>   
                        <ul class="timeline">
                            <li>
                                                   
                                <div class="timelineUnit">
								<h4>News:</h4>
                                <p>  Be the first among the best players in the MMA fight without rules. Participating in the mma/ufc events(mma underground), defeating opponents and become a top mma/ufc fighters. Train to become stronger thus increasing your chance to win fights and tournaments and get the awards announced by the administrators of the game.</p>
                        <!-- /Timeline for News  -->

                    </div>
                    <div class="skills-section">
                    
                </section>
                <!-- /about --> 
                                        
             	<?php
			if(isset($_POST['do_send'])) {
				$email = protect($_POST['email']);
				$check = mysql_query("SELECT * FROM users WHERE email='$email'");
				if(mysql_num_rows($check)>0) {
					$row = mysql_fetch_array($sql);
						$random_password=md5(uniqid(rand()));
						$emailpassword=substr($random_password, 0, 8);
						$newpassword = md5($emailpassword);
						$update = mysql_query("UPDATE users SET passwd='$newpassword' WHERE id='$row[id]'");
						$subject = 'MMA - Forgot password';
						$message = 'Your new password is as follows:
----------------------------
Username: '.$row[usern].'
Password: '.$emailpassword.'
----------------------------
Please make note this information has been encrypted into our database 
		 
This email was automatically generated.';
					mail($row['email'], $subject, $message,  "FROM: MMA - Forgot password <$web[web_email]>");
					echo success($lang['new_pass_success']);
				} else {
					echo error($lang['pass_error']);
				}
			}
			?>
			
                 
                <!-- register -->
                <section id="register">   
                    <div id="signup"             	>
                	<!-- signup Info -->
                    <div class="signup-info">
                        <h3 class="main-heading"><span>Account recovery</span></h3>
					
						<form action=""  method="POST">
						
						<h3><?php echo $lang['email_address']; ?></h3>	<br><br>
						<input type="text" class="input" name="email">
						<br><br>
						
						<input type="submit" class="button transition" name="do_send" value="<?php echo $lang['send']; ?>">

			</form>
                    </div>
                    <!-- /signup Info -->
                    
                        <!-- signup Form -->
                        <div class="signup-form">
                            <h3 class="main-heading"><span>Create an account and play for free</span></h3>
                            <div id="signup-status"></div>
							<?php
			if(isset($_POST['do_register'])) {
				$usern = protect($_POST['usern']);
				$passwd = protect($_POST['passwd']);
				$cpasswd = protect($_POST['cpasswd']);
				$email = protect($_POST['email']);
				$user_ip = $_SERVER['REMOTE_ADDR'];
				
				$check_usern = mysql_query("SELECT * FROM users WHERE usern='$usern'");
				$check_email = mysql_query("SELECT * FROM users WHERE email='$email'");
				
				if(empty($usern) or empty($passwd) or empty($cpasswd) or empty($email)) { echo error($lang['reg_error_1']); }
				elseif(mysql_num_rows($check_usern)>0) { echo error($lang['reg_error_2']); }
				elseif(mysql_num_rows($check_email)>0) { echo error($lang['reg_error_3']); }
				elseif(!isValidUsername($usern)) { echo error($lang['reg_error_4']); }
				elseif(!isValidEmail($email)) { echo error($lang['reg_error_5']); }
				elseif($passwd !== $cpasswd) { echo error($lang['reg_error_6']); }
				else {
					$total_stats = $web['player_max_force']+$web['player_max_agility']+$web['player_max_endurance']+$web['player_max_fastness'];
					$passwd = md5($passwd);
					$insert = mysql_query("INSERT users (usern,passwd,email,status,user_ip,power,agility,endurance,fastness,total_stats,energy,money) VALUES ('$usern','$passwd','$email','1','$user_ip','$web[start_points]','$web[start_points]','$web[start_points]','$web[start_points]','$total_stats','100','1000')") or die(mysql_error());
					echo success($lang['reg_success']);
				}
			}
	?>
		
                            <form action=""	method="POST" id="signupform">
                                <p>
                            	    <label for="name">Your username:</label>
                            	    <input type="text" name="usern" class="input" >
                                </p>
                                <p>
                            	    <label for="email">Your password:</label>
                            	    <input type="password" name="passwd" class="input">
                                </p>
								 <p>
                            	    <label for="email">Your password:</label>
                            	    <input type="password" name="cpasswd" class="input">
                                </p>
                                <p>
                            	    <label for="email">Your Email:</label>
                            	    <input type="text" name="email" class="input">
                                </p>
                                <input type="submit" name="do_register" value="Create game account" class="button transition">
                            </form>
                        </div>
                    <!-- /signup Form -->
                    </div>
                </section>
                <!-- /signup -->  

            </section>
            <!-- /Content -->
            
            <!-- Footer -->

            

		<!-- /Container -->

    </body>
</html>