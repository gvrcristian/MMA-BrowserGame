<?php
function protect($string) {
	$protection = htmlspecialchars(trim($string), ENT_QUOTES);
	return $protection;
}

function success($text) {
	echo '<br><div style="font-weight:bold;color:green;">'.$text.'</div><br>';
}

function error($text) {
	echo '<br><div style="font-weight:bold;color:red;">'.$text.'</div><br>';
}

function isValidUsername($str) {
    return preg_match('/^[a-zA-Z0-9-_]+$/',$str);
}

function isValidEmail($str) {
	return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function percent($num_amount, $num_total) {
		$count1 = $num_amount / $num_total;
		$count2 = $count1 * 100;
		$count = number_format($count2, 0);
		return $count;
}

function timeago($datefrom) {
	global $lang;
	$date = $datefrom-time();
	$minutes = floor($date/60);
	if($minutes == 1) {
		return '1 '.$lang[minute];
	} elseif($minutes == 0) {
		return floor($minutes/60).' '.$lang[seconds]; 
	} else {
		return $minutes.' '.$lang[minutes];
	}
}

function expire($datefrom) {
	global $lang;
	$date = $datefrom-time();
	$days = floor($date / 60 / 60 / 24);
	$hours = floor($date / 60 / 60);
	$minutes = floor($date / 60 / 10);
	if($days > 0) { if($days == 1) { $string_days = '1 '.$lang[day].', '; } else { $string_days = $days.' '.$lang[days].', '; } } else { $string_days = ''; }
	if($hours > 0) { if($hours == 1) { $string_hours = '1 '.$lang[hour].', '; } else { $string_hours = $hours.' '.$lang[hours].', '; } } else { $string_hours = ''; }
	if($minutes > 0) { if($minutes == 1) { $string_minutes = '1 '.$lang[minute]; } else { $string_minutes = $minutes.' '.$lang[minutes]; } } else { $string_minutes = ''; }
	return $string_days.$string_hours.$string_minutes;
}

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 $expl = explode("/?",$pageURL);
 return $expl[0];
}

function get_requests($user_id) {
	$query = mysql_query("SELECT * FROM requests WHERE request_id='$user_id'");
		$subs[] = $user_id;
		while($row = mysql_fetch_array($query)) {
			$subs[] = $row['user_id'];
		}
	return implode(',', $subs);
}

function tour_players($id) {
	$query = mysql_query("SELECT * FROM tournaments_players WHERE tour_id='$id'");
		while($row = mysql_fetch_array($query)) {
			$subs[] = $row['user_id'];
		}
	return implode(',', $subs);
}
?>