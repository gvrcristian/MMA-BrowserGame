<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
include("includes/config.php");
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

    <title>MMA PRO FIGHTER - INSTALL</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">

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
        <h3 class="text-muted">INSTALL</h3>
      </div>
	  
	  <div class="row marketing">
	  <?php
	  if(isset($_POST['do_install'])) {
		$mysql_host = protect($_POST['mysql_host']);
		$mysql_user = protect($_POST['mysql_user']);
		$mysql_pass = protect($_POST['mysql_pass']);
		$mysql_db = protect($_POST['mysql_base']);
		$title = protect($_POST['title']);
		$description = protect($_POST['description']);
		$keywords = protect($_POST['keywords']);
		$usern = protect($_POST['usern']);
		$passwd = protect($_POST['passwd']);
		
		if(empty($mysql_host) or empty($mysql_user) or empty($mysql_pass) or empty($mysql_db) or empty($title) or empty($description) or empty($keywords) or empty($usern) or empty($passwd)) { echo error("All fields are required."); }
		else {
				$db = mysql_connect($mysql_host,$mysql_user,$mysql_pass);

				if($db) {
				$select_db = mysql_select_db($mysql_db,$db);
					if($select_db) {
						mysql_query("SET NAMES 'utf8'");

						$sql_filename = 'sql.sql';
						$sql_contents = file_get_contents($sql_filename);
						$sql_contents = explode(";", $sql_contents);

						foreach($sql_contents as $k=>$v) {
							mysql_query($v);
						}
						
						$insert = mysql_query("INSERT settings (title,description,keywords) VALUES ('$title','$description','$keywords')");
						$passwd = md5($passwd);
						$insert = mysql_query("INSERT admins (usern,passwd) VALUES ('$usern','$passwd')");
						
						$current .= '<?php
						';
						$current .= '$sql["host"] = "'.$mysql_host.'";
						';
						$current .= '$sql["user"] = "'.$mysql_user.'";
						';
						$current .= '$sql["pass"] = "'.$mysql_pass.'";
						';
						$current .= '$sql["base"] = "'.$mysql_db.'";
						';
						$current .= '$connection = mysql_connect($sql["host"],$sql["user"],$sql["pass"]);
						';
						$current .= '$select_database = mysql_select_db($sql["base"], $connection);
						';
						$current .= 'mysql_query("SET NAMES utf8");
						';
						$current .= '?>
						';
						
						file_put_contents("includes/config.php", $current);
						
						echo success("Installation was successfully.");

					} else {
						echo error("MySQL database not exists.");
					}

				} else {
					echo error("Failed to connect to MySQL server.");
				}
		} 
	  }
	  ?>
	  
      <form action="" method="POST">
	  <h4>MySQL Connection</h3>
		<div class="form-group">
			<label>MySQL host</label>
			<input type="text" class="form-control" name="mysql_host" value="<?php if(isset($_POST['mysql_host'])) { echo $_POST['mysql_host']; } ?>">
		</div>
		<div class="form-group">
			<label>MySQL user</label>
			<input type="text" class="form-control" name="mysql_user" value="<?php if(isset($_POST['mysql_user'])) { echo $_POST['mysql_user']; } ?>">
		</div>
		<div class="form-group">
			<label>MySQL pass</label>
			<input type="text" class="form-control" name="mysql_pass" value="<?php if(isset($_POST['mysql_pass'])) { echo $_POST['mysql_pass']; } ?>">
		</div>
		<div class="form-group">
			<label>MySQL database</label>
			<input type="text" class="form-control" name="mysql_base" value="<?php if(isset($_POST['mysql_host'])) { echo $_POST['mysql_host']; } ?>">
		</div>
		<br>
		<h4>Game settings</h3>
		<div class="form-group">
			<label>Title</label>
			<input type="text" class="form-control" name="title" value="<?php if(isset($_POST['title'])) { echo $_POST['title']; } ?>">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea class="form-control" name="description"><?php if(isset($_POST['description'])) { echo $_POST['description']; } ?></textarea>
		</div>
		<div class="form-group">
			<label>Keywords</label>
			<textarea class="form-control" name="keywords"><?php if(isset($_POST['keywords'])) { echo $_POST['keywords']; } ?></textarea>
		</div>
		<div class="form-group">
			<label>Other settings complete after installation from admin panel.</label>
		</div>
		<br>
		<h4>Admin account</h3>
		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" name="usern" value="<?php if(isset($_POST['usern'])) { echo $_POST['usern']; } ?>">
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="text" class="form-control" name="passwd" value="<?php if(isset($_POST['passwd'])) { echo $_POST['passwd']; } ?>">
		</div>
		<br><br>
		<button type="submit" name="do_install" class="btn btn-default">Start install</button>
	  </form>
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
