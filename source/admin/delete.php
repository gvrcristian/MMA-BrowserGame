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
	<h2>Delete user</h2>
	
	<?php
	if($_GET['s'] == 1) {
		$delete = mysql_query("DELETE FROM users WHERE id='$id'");
		$delete = mysql_query("DELETE FROM tournaments_players WHERE user_id='$id'");
		echo success("$row[usern] was deleted successfully.");
	} else {
	?>
	
	<h3>Are you sure you want delete <?php echo $row['usern']; ?>?</h3>
	<a href="./admin.php?m=delete&t=user&id=<?php echo $row['id']; ?>&s=1" class="btn btn-success">Yes</a> <a href="./admin.php?m=users" class="btn btn-danger">No</a> 
	
	<?php 
	}
	?>
<?php
} elseif($t == "tournament") {
$sql = mysql_query("SELECT * FROM tournaments WHERE id='$id'");
if(mysql_num_rows($sql)==0) { header("Location: ./admin.php?m=tournaments"); }
$row = mysql_fetch_array($sql);
?>
	<h2>Delete tournament</h2>
	
	<?php
	if($_GET['s'] == 1) {
		$delete = mysql_query("DELETE FROM tournaments WHERE id='$id'");
		$delete = mysql_query("DELETE FROM tournaments_players WHERE tour_id='$id'");
		echo success("The tournament was deleted successfully.");
	} else {
	?>
	
	<h3>Are you sure you want delete this tournament?</h3>
	<a href="./admin.php?m=delete&t=tournament&id=<?php echo $row['id']; ?>&s=1" class="btn btn-success">Yes</a> <a href="./admin.php?m=tournaments" class="btn btn-danger">No</a> 
	
	<?php 
	}
	?>
<?php
} else {
	header("Location: ./admin.php");
}
?>