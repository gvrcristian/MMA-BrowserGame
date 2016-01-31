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
include("includes/functions.php");
// get web settings 
$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));

function check_premium_expire() {
	$time_now = time();
	$sql = mysql_query("SELECT * FROM premium_history ORDER BY id") or die(mysql_error());
	if(mysql_num_rows($sql)>0) {
		while($row = mysql_fetch_array($sql)) {
			if($time_now > $row['premium_expire']) {
				$update = mysql_query("UPDATE users SET premium='0' WHERE id='$row[user_id]'") or die(mysql_error());
				$delete = mysql_query("DELETE FROM premium_history WHERE id='$row[id]'") or die(mysql_error());
			}
		}
	}
}

function check_tournaments_end() {
	$time_now = time();
	$sql = mysql_query("SELECT * FROM tournaments WHERE $time_now > end_time and winner='0' ORDER BY id") or die(mysql_error());
	if(mysql_num_rows($sql)>0) {
		while($row = mysql_fetch_array($sql)) {
			$tour_players = tour_players($row['id']);
			$get_winner = mysql_query("SELECT * FROM users WHERE id IN ($tour_players) ORDER BY total_stats DESC LIMIT 1") or die(mysql_error());
			$get_winner = mysql_fetch_array($get_winner);
			$winner = $get_winner['id'];
			$update = mysql_query("UPDATE users SET tournaments_won=tournaments_won+1 WHERE id='$winner'");
			$update = mysql_query("UPDATE tournaments SET winner='$winner' WHERE id='$row[id]'") or die(mysql_error());
		}
	}
}

check_premium_expire();
check_tournaments_end();
?>