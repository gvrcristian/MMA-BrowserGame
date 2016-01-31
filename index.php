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
include("includes/language.php");
include("includes/functions.php");
// get web settings 
$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
$url = $web['url'];
if($_SESSION['usern']) {
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE usern='$_SESSION[usern]'"));
}

include("source/header.php");
$m = protect($_GET['m']);
switch($m) {
	case "register": include("source/register.php"); break;
	case "statistics": include("source/statistics.php"); break;
	case "hall": include("source/hall.php"); break;
		case "hall1": include("source/hall1.php"); break;
	case "profile": include("source/profile.php"); break;
	case "fight": include("source/fight.php"); break;
	case "tournaments": include("source/tournaments.php"); break;
	case "rankings": include("source/rankings.php"); break;
	case "premium": include("source/premium.php"); break;
	case "buy_premium": include("source/buy_premium.php"); break;
	case "check_payment": include("source/check_payment.php"); break;
	case "stat": include("source/pl_list.php"); break;
	case "mes": include("source/new_pm.php"); break;
	case "f": include("source/f.php"); break;
	case "listmes": include("source/list_pm.php"); break;
	case "read": include("source/read_pm.php"); break;
	
		case "shop": include("source/shop.php"); break;
	case "item": include("source/equiped_items.php"); break;
	case "shorts": include("source/shorts.php"); break;
	case "gloves": include("source/gloves.php"); break;
	case "city": include("source/generalcity.php"); break;
	case "quest": include("source/quest.php"); break;
	case "logout": 
		unset($_SESSION['usern']);
		unset($_SESSION['user_id']);
		session_unset();
		session_destroy();
		header("Location: ./");
		break;
	default: include("source/home.php");
}
include("source/footer.php");
?>