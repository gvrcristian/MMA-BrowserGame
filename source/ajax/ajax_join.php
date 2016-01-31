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
$tid = protect($_GET['tid']);
$time_now = time();
if(!empty($tid)) {
	$sql = mysql_query("SELECT * FROM tournaments WHERE id='$tid'");
	$nums = mysql_num_rows($sql);
	$row = mysql_fetch_array($sql);
	if(($nums+1) > $row['max_players']) {
		echo '<div style="font-weight:bold;color:red;">'.$lang[tour_error_1].'</div>';
	} else {
		if($time_now > $row['end_time']) {
			echo '<div style="font-weight:bold;color:red;">'.$lang[tour_error_2].' '.date("d/m/Y",$row[end_time]).'.</div>';
		} else {
			echo '<div style="font-weight:bold;color:green;">'.$lang[tour_success].'</div>';
			$insert = mysql_query("INSERT tournaments_players (user_id,tour_id) VALUES ('$user[id]','$row[id]')");
		}
	}
} else {
	die("Hacking attempt!");
}
?>