<?php
ob_start();
session_start();
include("../../includes/config.php");
include("../../includes/functions.php");
include("language.php");
// get web settings 
$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
$url = $web['url'];
if(!$_SESSION['usern']) { die("Hacking attempt!"); }
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE usern='$_SESSION[usern]'"));
$id = protect($_GET['rid']);

if(!empty($id)) {	
		$delete = mysql_query("DELETE FROM requests WHERE id='$id' and user_id='$user[id]'");
		echo '<div style="font-weight:bold;color:green;">'.$lang[request_rejected].'</div>';
} else {
	die("Hacking attempt!");
}
?>