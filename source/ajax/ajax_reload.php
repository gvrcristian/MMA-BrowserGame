<?php
ob_start();
session_start();
include("../../includes/config.php");
include("../../includes/functions.php");
// get web settings 
$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
$url = $web['url'];
if(!$_SESSION['usern']) { die("Hacking attempt!"); }
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE usern='$_SESSION[usern]'"));
$type = protect($_GET['type']);

if($type == "reload_force") {
	?><div class="progress" title="<?php echo $user['power']; ?>/<?php echo $web['player_max_force']; ?>" style="width:<?php echo percent($user['power'],$web['player_max_force']); ?>%;"></div><button type="button" onclick="add_force()" class="add_btn"></button><?php
} elseif($type == "reload_agility") {
	?><div class="progress" title="<?php echo $user['agility']; ?>/<?php echo $web['player_max_agility']; ?>" style="width:<?php echo percent($user['agility'],$web['player_max_agility']); ?>%;"></div><button type="button" onclick="add_agility()" class="add_btn"></button><?php
} elseif($type == "reload_endurance") {
	?><div class="progress" title="<?php echo $user['endurance']; ?>/<?php echo $web['player_max_endurance']; ?>" style="width:<?php echo percent($user['endurance'],$web['player_max_endurance']); ?>%;"></div><button type="button" onclick="add_endurance()" class="add_btn"></button><?php
} elseif($type == "reload_fastness") {
	?><div class="progress" title="<?php echo $user['fastness']; ?>/<?php echo $web['player_max_fastness']; ?>" style="width:<?php echo percent($user['fastness'],$web['player_max_fastness']); ?>%;"></div><button type="button" onclick="add_fastness()" class="add_btn"></button><?php
} elseif($type == "reload_energy") {
	?><div class="progress" title="<?php echo $user['energy']; ?>/100" style="width:<?php echo $user['energy']; ?>%;"></div><button type="button" onclick="add_energy()" class="add_btn"></button></div><?php
} elseif($type == "reload_money") {
	echo "$".number_format($user['money']);
} elseif($type == "reload_points") {
	echo number_format($user['points']);
} elseif($type == "reload_players") {
	$tid = protect($_GET['tid']);
	$sql = mysql_query("SELECT * FROM tournaments WHERE id='$tid'");
	$nums = mysql_num_rows(mysql_query("SELECT * FROM tournaments_players WHERE tour_id='$tid'"));
	$row = mysql_fetch_array($sql);
	echo $nums.'/'.$row[max_players];
} else {
	die("Hacking attempt!");
}
?>