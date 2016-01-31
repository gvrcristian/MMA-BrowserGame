		<h2>Game settings</h2>
		
		<?php
	/**
	* @author FightMMA
	* @copyright 2015 FightMMA All rights reserved.
	*/
		if(isset($_POST['do_save'])) {
			$title = protect($_POST['title']);
			$description = protect($_POST['description']);
			$keywords = protect($_POST['keywords']);
			$web_email = protect($_POST['web_email']);
			$start_points = protect($_POST['start_points']);
			$player_max_force = protect($_POST['player_max_force']);
			$player_max_agility = protect($_POST['player_max_agility']);
			$player_max_endurance = protect($_POST['player_max_endurance']);
			$player_max_fastness = protect($_POST['player_max_fastness']);
			$update = mysql_query("UPDATE settings SET title='$title',description='$description',keywords='$keywords',web_email='$web_email',player_max_force='$player_max_force',player_max_agility='$player_max_agility',player_max_endurance='$player_max_endurance',player_max_fastness='$player_max_fastness'");
			echo success("Your changes was saved successfully.");
			$web = mysql_fetch_array(mysql_query("SELECT * FROM settings ORDER BY id DESC LIMIT 1"));
		}
		?>
		
		<form role="form" action="" method="POST">
		  <div class="form-group">
			<label>Title</label>
			<input type="text" class="form-control" name="title" value="<?php echo $web['title']; ?>">
		  </div>
		  <div class="form-group">
			<label>Description</label>
			<textarea class="form-control" rows="3" name="description"><?php echo $web['description']; ?></textarea>
		  </div>
		  <div class="form-group">
			<label>Keywords</label>
			<textarea class="form-control" rows="3" name="keywords"><?php echo $web['keywords']; ?></textarea>
		  </div>
		  <div class="form-group">
			<label>Game email address (for forgot password)</label>
			<input type="text" class="form-control" name="web_email" value="<?php echo $web['web_email']; ?>">
		  </div>
		  <div class="form-group">
			<label>New players start points</label>
			<input type="text" class="form-control" name="start_points" value="<?php echo $web['start_points']; ?>">
		  </div>
		  <div class="form-group">
			<label>Player max force</label>
			<input type="text" class="form-control" name="player_max_force" value="<?php echo $web['player_max_force']; ?>">
		  </div>
		  <div class="form-group">
			<label>Player max agility</label>
			<input type="text" class="form-control" name="player_max_agility" value="<?php echo $web['player_max_agility']; ?>">
		  </div>
		  <div class="form-group">
			<label>Player max endurance</label>
			<input type="text" class="form-control" name="player_max_endurance" value="<?php echo $web['player_max_endurance']; ?>">
		  </div>
		  <div class="form-group">
			<label>Player max fastness</label>
			<input type="text" class="form-control" name="player_max_fastness" value="<?php echo $web['player_max_fastness']; ?>">
		  </div>
		  <button type="submit" name="do_save" class="btn btn-default">Save changes</button>
		</form>