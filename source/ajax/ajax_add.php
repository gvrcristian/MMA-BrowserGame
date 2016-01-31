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

if($type == "add_force") {
	if($user['points'] > 0) {
		if($user['power'] !== $web['player_max_force']) {
			if($user['power'] < $web['player_max_force']) {
				$update = mysql_query("UPDATE users SET power=power+1,total_stats=total_stats+1,points=points-1 WHERE id='$user[id]'");
				echo '<div style="font-weight:bold;color:green;">'.$lang[plus_force].'</div>';
			} else {
				echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_force].'</div>';
			}
		} else {
			echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_force].'</div>';
		}
	} else {
		echo '<div style="font-weight:bold;color:red;">'.$lang[no_points].'</div>';
	}
} elseif($type == "add_agility") {
	if($user['points'] > 0) {
		if($user['agility'] !== $web['player_max_agility']) {
			if($user['agility'] < $web['player_max_agility']) {
				$update = mysql_query("UPDATE users SET agility=agility+1,total_stats=total_stats+1,points=points-1 WHERE id='$user[id]'");
				echo '<div style="font-weight:bold;color:green;">'.$lang[plus_agility].'</div>';
			} else {
				echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_agility].'</div>';
			}
		} else {
			echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_agility].'</div>';
		}
	} else {
		echo '<div style="font-weight:bold;color:red;">'.$lang[no_points].'</div>';
	}
} elseif($type == "add_endurance") {
	if($user['points'] > 0) {
		if($user['endurance'] !== $web['player_max_endurance']) {
			if($user['endurance'] < $web['player_max_endurance']) {
				$update = mysql_query("UPDATE users SET endurance=endurance+1,total_stats=total_stats+1,points=points-1 WHERE id='$user[id]'");
				echo '<div style="font-weight:bold;color:green;">'.$lang[plus_endurance].'</div>';
			} else {
				echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_endurance].'</div>';
			}
		} else {
			echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_endurance].'</div>';
		}
	} else {
		echo '<div style="font-weight:bold;color:red;">'.$lang[no_points].'</div>';
	}
} elseif($type == "add_fastness") {
	if($user['points'] > 0) {
		if($user['fastness'] !== $web['player_max_fastness']) {
			if($user['fastness'] < $web['player_max_fastness']) {
				$update = mysql_query("UPDATE users SET fastness=fastness+1,total_stats=total_stats+1,points=points-1 WHERE id='$user[id]'");
				echo '<div style="font-weight:bold;color:green;">'.$lang[plus_fastness].'</div>';
			} else {
				echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_fastness].'</div>';
			}
		} else {
			echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_fastness].'</div>';
		}
	} else {
		echo '<div style="font-weight:bold;color:red;">'.$lang[no_points].'</div>';
	}
} elseif($type == "add_energy") {
	if($user['points'] > 100) {
		if($user['energy'] !== 100) {
			if($user['energy'] < 100) {
				$update = mysql_query("UPDATE users SET energy='100',points=points-100 WHERE id='$user[id]'");
				echo '<div style="font-weight:bold;color:green;">'.$lang[plus_energy].'</div>';
			} else {
				echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_energy].'</div>';
			}
		} else {
			echo '<div style="font-weight:bold;color:red;">'.$lang[have_max_energy].'</div>';
		}
	} else {
		echo '<div style="font-weight:bold;color:red;">'.$lang[no_points].'</div>';
	}
} else {
	die("Hacking attempt!");
}
?>