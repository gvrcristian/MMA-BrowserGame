<?php
/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
$id = protect($_GET['id']);
$t = protect($_GET['t']);

if($t == "user") {
$sql = mysql_query("SELECT * FROM users WHERE id='$id'");
if(mysql_num_rows($sql)==0) { header("Location: ./admin.php?m=users"); }
$row = mysql_fetch_array($sql);
?>
	<h2>Edit user</h2>
	
	<?php
	if(isset($_POST['do_save'])) {
		$usern = protect($_POST['usern']);
		$email = protect($_POST['email']);
		$points = protect($_POST['points']);
		$power = protect($_POST['power']);
		$agility = protect($_POST['agility']);
		$endurance = protect($_POST['endurance']);
		$fastness = protect($_POST['fastness']);
		$status = protect($_POST['status']);
		
		if($row['usern'] !== $usern) { 
			$check = mysql_query("SELECT * FROM users WHERE usern='$usern'");
			if(empty($usern) or empty($email) or empty($points) or empty($power) or empty($agility) or empty($endurance) or empty($fastness)) { echo error("All fields are required."); }
			elseif(mysql_num_rows($check)>0) { echo error("This username is already used by another user."); }
			else {
				$total_stats = $power+$agility+$endurance+$fastness;
				$update = mysql_query("UPDATE users SET usern='$usern',email='$email',status='$status',points='$points',power='$power',agility='$agility',endurance='$endurance',fastness='$fastness',total_stats='$total_stats' WHERE id='$id'");
				echo success("Your changes was saved successfully.");
				$row = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id'"));
			}
		} else {
			if(empty($usern) or empty($email) or empty($points) or empty($power) or empty($agility) or empty($endurance) or empty($fastness)) { echo error("All fields are required."); }
			else {
				$total_stats = $power+$agility+$endurance+$fastness;
				$update = mysql_query("UPDATE users SET usern='$usern',email='$email',status='$status',points='$points',power='$power',agility='$agility',endurance='$endurance',fastness='$fastness',total_stats='$total_stats' WHERE id='$id'");
				echo success("Your changes was saved successfully.");
				$row = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id'"));
			}
		}
	}
	?>
	
	<form role="form" action="" method="POST">
		  <div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" name="usern" value="<?php echo $row['usern']; ?>">
		  </div>
		  <div class="form-group">
			<label>Email address</label>
			<input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
		  </div>
		  <div class="form-group">
			<label>Points</label>
			<input type="text" class="form-control" name="points" value="<?php echo $row['points']; ?>">
		  </div>
		  <div class="form-group">
			<label>Force</label>
			<input type="text" class="form-control" name="power" value="<?php echo $row['power']; ?>">
		  </div>
		  <div class="form-group">
			<label>Agility</label>
			<input type="text" class="form-control" name="agility" value="<?php echo $row['agility']; ?>">
		  </div>
		  <div class="form-group">
			<label>Endurance</label>
			<input type="text" class="form-control" name="endurance" value="<?php echo $row['endurance']; ?>">
		  </div>
		  <div class="form-group">
			<label>Fastness</label>
			<input type="text" class="form-control" name="fastness" value="<?php echo $row['fastness']; ?>">
		  </div>
		  <button type="submit" name="do_save" class="btn btn-default">Save changes</button>
	</form>
<?php
} elseif($t == "tournament") {
$sql = mysql_query("SELECT * FROM tournaments WHERE id='$id'");
if(mysql_num_rows($sql)==0) { header("Location: ./admin.php?m=tournaments"); }
$row = mysql_fetch_array($sql);
?>
	<script type="text/javascript">
	  $(document).ready(function() {
		$("#start_time").datepicker();
		$("#end_time").datepicker();
	  });
	</script>
	<h2>Edit tournament</h2>
	
	<?php
	if(isset($_POST['do_save'])) {
		$name = protect($_POST['name']);
		$poster = protect($_POST['poster']);
		$start_time = protect($_POST['start_time']);
		$end_time = protect($_POST['end_time']);
		$max_players = protect($_POST['max_players']);
		$date = new DateTime($start_time);
		$start_time = $date->getTimestamp();
		$date = new DateTime($end_time);
		$end_time = $date->getTimestamp();
		$rewards = protect($_POST['rewards']);
		
		if(empty($name) or empty($poster) or empty($start_time) or empty($end_time) or empty($max_players)) { echo error("All fields are required."); }
		else {
			$update = mysql_query("UPDATE tournaments SET name='$name',poster='$poster',start_time='$start_time',end_time='$end_time',max_players='$max_players',rewards='$rewards' WHERE id='$id'");
			echo success("Your changes was saved successfully.");
			$row = mysql_fetch_array(mysql_query("SELECT * FROM tournaments WHERE id='$id'"));
		}
	}
	?>
	
	<form role="form" action="" method="POST">
		  <div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>">
		  </div>
		  <div class="form-group">
			<label>Poster</label>
			<input type="text" class="form-control" name="poster" value="<?php echo $row['poster']; ?>">
		  </div>
		  <div class="form-group">
			<label>Start date</label>
			<input type="text" class="form-control" name="start_time" id="start_time" value="<?php echo date("m/d/Y",$row['start_time']); ?>">
		  </div>
		  <div class="form-group">
			<label>End date</label>
			<input type="text" class="form-control" name="end_time" id="end_time" value="<?php echo date("m/d/Y",$row['end_time']); ?>">
		  </div>
		  <div class="form-group">
			<label>Max players</label>
			<input type="text" class="form-control" name="max_players" value="<?php echo $row['max_players']; ?>">
		  </div>
		  <div class="form-group">
			<label>Rewards</label>
			<textarea class="form-control" name="rewards"><?php echo $row['rewards']; ?></textarea>
		  </div>
		  <button type="submit" name="do_save" class="btn btn-default">Save changes</button>
	</form>
<?php
} elseif($t == "give_reward") {
	$sql = mysql_query("SELECT * FROM tournaments WHERE id='$id'");
	$row = mysql_fetch_array($sql);
	$update = mysql_query("UPDATE tournaments SET winner_rewarded='1' WHERE id='$id'");
	$redirect = './admin.php?m=edit&t=user&id='.$row[winner];
	header("Location: $redirect");
} else {
	header("Location: ./admin.php");
}
?>