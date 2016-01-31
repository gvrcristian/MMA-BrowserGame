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
$type = protect($_GET['type']);
$workout_end_time = time()+3600;

if($type == 1) {	
	if($user['workout_type'] == 0) {
		$update = mysql_query("UPDATE users SET workout_end_time='$workout_end_time',workout_type='1' WHERE id='$user[id]'");
		echo '<div style="font-weight:bold;color:red;">'.$lang[workout_end_after].' '.timeago($workout_end_time).'.</div>';
	} else {
		echo '<div style="font-weight:bold;color:red;">'.$lang[workout_end_after].' '.timeago($user[workout_end_time]).'.</div>';
	}
} elseif($type == 2) {
	if($user['workout_type'] == 0) {
		$update = mysql_query("UPDATE users SET workout_end_time='$workout_end_time',workout_type='2' WHERE id='$user[id]'");
		echo '<div style="font-weight:bold;color:red;">'.$lang[workout_end_after].' '.timeago($workout_end_time).'.</div>';
	} else {
		echo '<div style="font-weight:bold;color:red;">'.$lang[workout_end_after].' '.timeago($user[workout_end_time]).'.</div>';
	}
} else {
	die("Hacking attempt!");
}
?>