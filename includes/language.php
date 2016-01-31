<?php
$change_lang = $_GET['lang'];
if($_GET['lang']) {
	$check = $lang_path.'languages/'.$change_lang.'.php';
	if(file_exists($check)) {
		setcookie("mma_lang", $change_lang, time()+30758400);
		header("Location: ./index.php");
	} else {
		header("Location: ./index.php");
	}
}

if($_COOKIE['mma_lang']) {
	$check = $lang_path.'languages/'.$_COOKIE[mma_lang].'.php';
	if(file_exists($check)) {
		include($check);
	} else {
		$redir = './index.php?lang=English';
		header("Location: $redir");
	}
} else {
	$check = $lang_path.'languages/English.php';
	if(file_exists($check)) {
		include($check);
	} else {
		die("MMA PRO FIGHTER do not detect English lang for default. Please edit <b>includes/language.php</b> and go to line <b>21</b> and replace default lang.");
	}
}
?>