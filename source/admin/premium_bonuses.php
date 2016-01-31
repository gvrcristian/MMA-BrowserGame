				<h2>Premium bonuses</h2>
		
		<?php
		/**
* @author FightMMA
* @copyright 2015 FightMMA All rights reserved.
*/
		if(isset($_POST['do_save'])) {
			$premium_bonus_force = protect($_POST['premium_bonus_force']);
			$premium_bonus_agility = protect($_POST['premium_bonus_agility']);
			$premium_bonus_endurance = protect($_POST['premium_bonus_endurance']);
			$premium_bonus_fastness = protect($_POST['premium_bonus_fastness']);
			$premium_bonus_points = protect($_POST['premium_bonus_points']);
			$update = mysql_query("UPDATE settings SET premium_bonus_force='$premium_bonus_force',premium_bonus_agility='$premium_bonus_agility',premium_bonus_endurance='$premium_bonus_endurance',premium_bonus_fastness='$premium_bonus_fastness',premium_bonus_points='$premium_bonus_points'");
			echo success("Your changes was saved successfully.");
			$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
		}
		?>
		
		<form role="form" action="" method="POST">
		  <div class="form-group">
			<label>Bonus force</label>
			<input type="text" class="form-control" name="premium_bonus_force" value="<?php echo $web['premium_bonus_force']; ?>">
		  </div>
		  <div class="form-group">
			<label>Bonus agility</label>
			<input type="text" class="form-control" name="premium_bonus_agility" value="<?php echo $web['premium_bonus_agility']; ?>">
		  </div>
		  <div class="form-group">
			<label>Bonus endurance</label>
			<input type="text" class="form-control" name="premium_bonus_endurance" value="<?php echo $web['premium_bonus_endurance']; ?>">
		  </div>
		  <div class="form-group">
			<label>Bonus fastness</label>
			<input type="text" class="form-control" name="premium_bonus_fastness" value="<?php echo $web['premium_bonus_fastness']; ?>">
		  </div>
		  <div class="form-group">
			<label>Bonus points</label>
			<input type="text" class="form-control" name="premium_bonus_points" value="<?php echo $web['premium_bonus_points']; ?>">
		  </div>
		  <button type="submit" name="do_save" class="btn btn-default">Save changes</button>
		</form>