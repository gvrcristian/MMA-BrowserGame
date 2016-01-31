<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
ob_start();
session_start(); 
if(file_exists("./install.php")) {
	header("Location: ./install.php");
} 
include("includes/config.php");
$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));

function success($text) {
	echo '<div class="alert alert-success">'.$text.'</div>';
}

function error($text) {
	echo '<div class="alert alert-danger">'.$text.'</div>';
}

function protect($string) {
	$protection = htmlspecialchars(trim($string), ENT_QUOTES);
	return $protection;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="FightMMA">

    <title>MMA PRO FIGHTER - Admin panel</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
	<link href="assets/css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<script src="assets/js/jquery.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.js" type="text/javascript"></script>
	<script src="assets/js/jquery-ui.js" type="text/javascript"></script>
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <?php
		  if($_SESSION['ausern']) {
			if(!empty($_GET['m'])) { echo '<li class="active"><a href="./admin.php">Dashboard</a></li>'; }
			echo '<li><a href="./admin.php?m=logout">Logout</a></li>';
		  }
          ?>
        </ul>
        <h3 class="text-muted">ADMIN PANEL</h3>
      </div>

	  <div class="row marketing">
      <?php
	  if($_SESSION['ausern']) {
		$m = protect($_GET['m']);
		switch($m) {
			case "users": include("source/admin/users.php"); break;
			case "tournaments": include("source/admin/tournaments.php"); break;
			case "ads": include("source/admin/ads.php"); break;
			case "premium_bonuses": include("source/admin/premium_bonuses.php"); break;
			case "premium_settings": include("source/admin/premium_settings.php"); break;
			case "game_settings": include("source/admin/game_settings.php"); break;
			case "create_tournament": include("source/admin/create_tournament.php"); break;
			case "edit": include("source/admin/edit.php"); break;
			case "delete": include("source/admin/delete.php"); break;
			case "logout": 
				unset($_SESSION['ausern']);
				session_unset();
				session_destroy();
				header("Location: ./admin.php");
				break;
			default: include("source/admin/dashboard.php");
		}
	  } else {
	  
	  if(isset($_POST['do_login'])) {
		$ausern = protect($_POST['ausern']);
		$apasswd = md5(protect($_POST['apasswd']));
		
		$check = mysql_query("SELECT * FROM admins WHERE usern='$ausern' and passwd='$apasswd'");
		if(mysql_num_rows($check)>0) {
			$_SESSION['ausern'] = $ausern;
			header("Location: ./admin.php");
		} else {
			echo error("Wrong admin username or password.");
		}
	  }
	  ?>
	  <form role="form" action="" method="POST">
		  <div class="form-group">
			<label>Admin username</label>
			<input type="text" class="form-control" name="ausern">
		  </div>
		  <div class="form-group">
			<label>Admin password</label>
			<input type="password" class="form-control" name="apasswd">
		  </div>
		  <button type="submit" name="do_login" class="btn btn-default">Login</button>
		</form>
	  <?php
	  }
	  ?>
	        </div>

      <div class="footer">
        <p>Copyright &copy; by <a href="http://fightmma.net/" target="_blank">FightMMA</a></p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
