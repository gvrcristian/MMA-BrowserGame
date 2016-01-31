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
$id = protect($_GET['uid']);
$u = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id'"));

if(!empty($id)) {	
		$insert = mysql_query("INSERT requests (user_id,request_id) VALUES ('$u[id]','$user[id]')");
		echo '<div style="font-weight:bold;color:green;">'.$lang[request_was_sent].' '.$u[usern].'.</div>';
} else {
	die("Hacking attempt!");
}
?>